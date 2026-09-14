@extends('layouts.app')
 
@section('title', 'POS')
 
@section('content')
 
    @if (session('success'))
        <div class="alert alert-success" style="background:green; color:white; padding:10px;">
            {{ session('success') }}
        </div>
    @endif
 
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
 
    <h4 class="mb-3">
        Tambah dan Edit
    </h4>
 
    <div class="row">
 
        {{-- ================= PRODUK ================= --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="max-height:70vh; overflow:auto">
                    <div class="mb-3">
                        {{-- Perbaikan 1: Penambahan prefix admin. pada pencarian --}}
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Cari produk..." onkeyup="this.form.submit()">
                        </form>
                    </div>
 
                    @foreach ($products as $product)
                        {{-- Perbaikan 2: Penambahan prefix admin. pada itempenjualan.store --}}
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
 
                            <div class="col-7">
                                <button
                                    class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    <div class="d-flex align-items-center gap-2">
 
                                        {{-- Gambar produk --}}
                                        <img src="{{ asset('storage/' . $product->foto) }}" alt="Gambar"
                                            class="rounded-circle" style="width:45px; height:45px; object-fit:cover;">
 
                                        {{-- Nama & harga --}}
                                        <div>
                                            <div class="fw-semibold">{{ $product->nama }}</div>
                                            <small class="text-muted">Rp
                                                {{ number_format($product->harga_jual, 0, ',', '.') }}</small>
                                        </div>
 
                                    </div>
                                </button>
                            </div>
 
                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                    class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                            </div>
 
                            <div class="col-2">
                                <button class="btn btn-primary w-100"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                    +
                                </button>
                            </div>
                        </form>
                    @endforeach
 
                </div>
            </div>
        </div>
 
        {{-- ================= KERANJANG ================= --}}
        <div class="col-md-6">
            <div class="card">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sale->itemPenjualan as $item)
                            <tr>
                                <td>{{ $item->produk->nama }}</td>
                                <td>Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                <td>
                                    {{-- Perbaikan 3: Penambahan prefix admin. pada itempenjualan.update --}}
                                    <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                        @csrf @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->kuantitas }}"
                                            class="form-control form-control-sm">
                                    </form>
                                </td>
                                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                <td>
                                    @can('delete', $item)
                                        {{-- Perbaikan 4: Penambahan prefix admin. pada itempenjualan.destroy --}}
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Keranjang masih kosong</td>
                            </tr>
                        @endforelse
 
                    </tbody>
                </table>
 
                <div class="card-footer">
                    <strong>Total: Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</strong>
 
                    {{-- Perbaikan 5: Penambahan prefix admin. pada penjualan.update --}}
                    <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" class="mt-2">
                        @csrf
                        @method('PUT')
 
                        <select name="payment_method" id="payment_method" class="form-select mb-2">
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>
 
                        <div id="cash-fields" class="mb-2" style="display:none;">
                            <label class="form-label">Uang Dibayar</label>
                            <input type="text" id="uang_dibayar_display" class="form-control mb-2" placeholder="Rp 0">
                            <input type="hidden" name="uang_dibayar" id="uang_dibayar">
 
                            <label class="form-label">Kembalian</label>
                            <input type="text" id="kembalian" class="form-control" readonly value="Rp 0">
                        </div>
                        {{-- END BARU --}}
 
                        <button type="submit"
                            class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            Checkout
                        </button>
                    </form>
 
                    @can('delete', $sale)
                        {{-- Perbaikan 6: Penambahan prefix admin. pada penjualan.destroy --}}
                        <form action="{{ route('penjualan.destroy', $sale->id) }}" 
                            method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                            @csrf
                            @method('DELETE')
 
                            <button
                                class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Batalkan Transaksi
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
 
    </div>
 
    <script>
        // Total belanja diambil dari server, bukan dihardcode
        const totalBelanja = {{ $sale->total_pembayaran }};
 
        const paymentSelect = document.getElementById('payment_method');
        const cashFields = document.getElementById('cash-fields');
        const uangDisplay = document.getElementById('uang_dibayar_display');
        const uangHidden = document.getElementById('uang_dibayar');
        const kembalianInput = document.getElementById('kembalian');
 
        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }
 
        // 1. Tampilkan/sembunyikan field cash sesuai metode pembayaran
        paymentSelect.addEventListener('change', function () {
            if (this.value === 'CASH') {
                cashFields.style.display = 'block';
            } else {
                cashFields.style.display = 'none';
                uangDisplay.value = '';
                uangHidden.value = '';
                kembalianInput.value = formatRupiah(0);
            }
        });
 
        // 2 & 3. Format input uang + hitung kembalian otomatis
        uangDisplay.addEventListener('input', function () {
            let angka = this.value.replace(/[^0-9]/g, ''); // buang karakter selain angka
            this.value = angka ? formatRupiah(parseInt(angka)) : '';
 
            let uangDibayar = angka ? parseInt(angka) : 0;
            uangHidden.value = uangDibayar; // nilai polos yang dikirim ke server
 
            let kembalian = uangDibayar - totalBelanja;
            kembalianInput.value = formatRupiah(kembalian >= 0 ? kembalian : 0);
            kembalianInput.style.color = kembalian < 0 ? 'red' : 'black';
        });
    </script>
 
@endsection