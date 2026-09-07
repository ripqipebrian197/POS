@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detail Transaksi #{{ $penjualan->id }}</h4>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">
            &larr; Kembali
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <strong>Tanggal Transaksi</strong>
                    <p>{{ $penjualan->created_at->format('d-m-Y H:i:s') }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Kasir</strong>
                    <p>{{ $penjualan->user->name }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Status</strong>
                    <p>
                        <span class="badge bg-{{ $penjualan->status === 'COMPLETED' ? 'success' : 'warning' }}">
                            {{ $penjualan->status }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <strong>Metode Pembayaran</strong>
                    <p>{{ $penjualan->metode_pembayaran }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Total Pembayaran</strong>
                    <p>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <h5>Daftar Barang</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penjualan->itemPenjualan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->produk->nama ?? '-' }}</td>
                    <td>{{ $item->kuantitas }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada item</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
