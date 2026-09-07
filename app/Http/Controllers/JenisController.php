<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Jenis::class);

        $keyword = $request->input('search');

        $jenis = Jenis::when($keyword, function ($query) use ($keyword) {
                $query->where('nama_jenis', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        $this->authorize('create', Jenis::class);

        $jenis = new Jenis();

        return view('jenis.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Jenis::class);

        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function edit(Jenis $jenis)
    {
        $this->authorize('update', $jenis);

        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jenis)
    {
        $this->authorize('update', $jenis);

        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis,' . $jenis->id,
        ]);

        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diupdate.');
    }

    public function destroy(Jenis $jenis)
    {
        $this->authorize('delete', $jenis);

        try {
            $jenis->delete();
            return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->route('jenis.index')->with('error', 'Gagal menghapus! Data jenis ini sedang digunakan oleh data produk.');
        }
    }
}