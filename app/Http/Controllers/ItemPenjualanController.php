<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // 1. Cek produk dan stok TERLEBIH DAHULU (di luar transaksi)
        $product = Produk::findOrFail($request->product_id);

        if ($product->stok < $request->quantity) {
            return redirect()
                ->route('admin.penjualan.create')
                ->with('error', 'Produk stok tidak mencukupi');
        }

        // 2. Jalankan transaksi database jika stok mencukupi
        DB::transaction(function () use ($request, $product) {

            $sale = Penjualan::where('user_id', Auth::id())
                ->where('status', 'OPEN')
                ->firstOrFail();

            // Kurangi stok produk
            $product->decrement('stok', $request->quantity);

            // Update / insert item penjualan
            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($item) {
                $item->kuantitas += $request->quantity;
            } else {
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id' => $product->id,
                    'kuantitas' => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                ]);
            }

            $item->subtotal = $item->kuantitas * $item->harga_satuan;
            $item->save();

            // Total Pembayaran
            $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
            $sale->save();
        });

        return back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $produk = $itempenjualan->produk;
        $selisih = $request->quantity - $itempenjualan->kuantitas;

        // Cek stok terlebih dahulu di luar transaksi jika kuantitas bertambah
        if ($selisih > 0 && $produk->stok < $selisih) {
            return redirect()
                ->route('admin.penjualan.create')
                ->with('error', 'Stok tidak mencukupi');
        }

        DB::transaction(function () use ($request, $itempenjualan, $produk, $selisih) {

            if ($selisih > 0) {
                $produk->decrement('stok', $selisih);
            } elseif ($selisih < 0) {
                $produk->increment('stok', abs($selisih));
            }

            // Update item
            $itempenjualan->update([
                'kuantitas' => $request->quantity,
                'subtotal' => $request->quantity * $itempenjualan->harga_satuan
            ]);

            // Update total penjualan
            $itempenjualan->penjualan->update([
                'total_pembayaran' => $itempenjualan->penjualan->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {

            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;

            // Kembalikan stok
            $produk->increment('stok', $itempenjualan->kuantitas);

            // Hapus item
            $itempenjualan->delete();

            // Update total penjualan
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }
}
