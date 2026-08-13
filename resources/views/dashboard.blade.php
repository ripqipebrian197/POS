@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<div class="container py-4" style="max-width: 1100px;">

    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">
            Ringkasan Hari Ini 
            <small class="text-muted d-block d-md-inline fs-5">
                ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
            </small>
        </h2>
    </div>

    @can('viewAny', App\Models\User::class)
    <!-- Section 1: Penjualan Hari Ini -->
    <div class="mb-4">
        <h5 class="fw-bold text-secondary text-center mb-3">Today's Sales</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 text-center rounded-3">
                    <span class="text-muted small fw-medium">Total Nilai Penjualan Hari Ini</span>
                    <h2 class="fw-bold my-1" style="color: #4338CA;">
                        Rp {{ number_format($ringkasan['total_penjualan'] ?? 0, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 text-center rounded-3">
                    <span class="text-muted small fw-medium">Jumlah Transaksi Hari Ini</span>
                    <h2 class="fw-bold my-1" style="color: #4338CA;">
                        {{ $ringkasan['total_transaksi'] ?? 0 }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Status Kas & Pembayaran -->
    <div class="mb-4">
        <h5 class="fw-bold text-secondary text-center mb-3">Cash & Payment Status</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 text-center rounded-3">
                    <span class="text-muted small fw-medium">Total Pembayaran Tunai</span>
                    <h3 class="fw-bold mt-2 mb-0" style="color: #4338CA;">
                        Rp {{ number_format($ringkasan['total_cash'] ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 text-center rounded-3">
                    <span class="text-muted small fw-medium">Total Pembayaran Non-Tunai</span>
                    <h3 class="fw-bold mt-2 mb-0" style="color: #4338CA;">
                        Rp {{ number_format($ringkasan['total_non_tunai'] ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <!-- Section 3: Critical Inventory Status -->
    <div class="mb-4">
        <h5 class="fw-bold text-secondary text-center mb-3">Critical Inventory Status</h5>
        <div class="row g-3">
            
            <!-- Daftar Produk Stok Rendah -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-3 rounded-3 h-100">
                    <h6 class="fw-bold text-dark text-center mb-3">Daftar Produk Stok Rendah</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0 text-center">
                            <thead style="background-color: #EEF2FF; color: #4338CA;">
                                <tr>
                                    <th>#</th>
                                    <th class="text-start">Nama Produk</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                    <tr class="border-bottom">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $produk->nama }}</td>
                                        <td class="text-danger fw-bold">{{ $produk->stok }}</td>
                                    </tr>
                                @empty
                                    <tr class="border-bottom">
                                        <td colspan="3" class="text-muted italic py-3">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 d-flex justify-content-center">
                        {{ $produkStokRendah->links() }}
                    </div>
                </div>
            </div>

            <!-- Produk Habis Stok -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-3 rounded-3 h-100">
                    <h6 class="fw-bold text-dark text-center mb-3">Produk Habis Stok</h6>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0 text-center">
                            <thead style="background-color: #EEF2FF; color: #4338CA;">
                                <tr>
                                    <th>#</th>
                                    <th class="text-start">Nama Produk</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                    <tr class="border-bottom">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-start">{{ $produk->nama }}</td>
                                        <td class="text-danger fw-bold">0</td>
                                    </tr>
                                @empty
                                    <tr class="border-bottom">
                                        <td colspan="3" class="text-muted italic py-3">
                                            Seluruh produk tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 d-flex justify-content-center">
                        {{ $produkStokHabis->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Section 4: Best Seller Products -->
    <div>
        <h5 class="fw-bold text-secondary text-center mb-3">Best Seller Products</h5>
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #EEF2FF; color: #4338CA;">
                        <tr>
                            <th class="ps-4">Nama</th>
                            <th class="text-center">Stok</th>
                            <th class="text-center">Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkTerlaris as $produk)
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">{{ $produk->nama }}</td>
                                <td class="text-center text-muted">{{ $produk->stok }}</td>
                                <td class="text-center fw-bold" style="color: #4338CA;">{{ $produk->total_terjual }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">
                                    Belum ada data penjualan produk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection