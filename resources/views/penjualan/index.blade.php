@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container py-4">
    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Halaman Penjualan</h2>
        <a href="{{ route('admin.penjualan.create') }}" class="btn btn-primary btn-sm">
            + Transaksi Baru
        </a>
    </div>

    {{-- Form Pencarian --}}
    <form action="{{ route('admin.penjualan.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4 ms-auto">
                <div class="input-group input-group-sm">
                    <input type="text" name="search" value="{{ request()->search }}" class="form-control" placeholder="Cari penjualan...">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </div>
        </div>
    </form>

    {{-- Tabel Penjualan --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 50px;">#</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Kasir</th>
                    <th scope="col">Total Pembayaran</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center" style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    <tr>
                        <th scope="row">{{ $sales->firstItem() + $loop->index }}</th>
                        <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td class="fw-bold">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ strtoupper($sale->metode_pembayaran) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if(strtoupper($sale->status) == 'COMPLETED')
                                <span class="badge bg-success">COMPLETED</span>
                            @elseif(strtoupper($sale->status) == 'OPEN')
                                <span class="badge bg-warning text-dark">OPEN</span>
                            @else
                                <span class="badge bg-secondary">{{ strtoupper($sale->status) }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.penjualan.show', $sale->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <span class="text-muted">Data penjualan tidak ditemukan.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end mt-3">
        {{ $sales->links() }}
    </div>
</div>
@endsection