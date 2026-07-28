@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

@if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger mt-2">{{ session('error') }}</div>
@endif

<h1>Halaman Penjualan</h1>

    <a href="{{ route('admin.penjualan.create') }}" class="btn btn-primary mb-3">Create</a>

    <form action="{{ route('admin.penjualan.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ request()->search }}" class="form-control"
                placeholder="Search penjualan">
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal Transaksi</th>
                <th scope="col">Kasir</th>
                <th scope="col">Total Pembayaran</th>
                <th scope="col">Metode Pembayaran</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sales as $sale)
                <tr>
                    <th scope="row">{{ $sales->firstItem() + $loop->index }}</th>
                    <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                    <td>{{ $sale->user->name }}</td>
                    <td>Rp. {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                    <td>{{ $sale->metode_pembayaran }}</td>
                    <td>{{ $sale->status }}</td>
                    
                    {{-- Kolom Aksi hanya menampilkan tombol Detail --}}
                    <td>
                        <a href="{{ route('admin.penjualan.show', $sale->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $sales->links() }}
@endsection