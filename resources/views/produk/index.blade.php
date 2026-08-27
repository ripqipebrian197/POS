@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

    @include('layouts.navbar')

    <div class="container py-4">
        {{-- Alert Messages --}}
        @if (session('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('errors') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Daftar Produk</h3>
                <p class="text-muted mb-0">Kelola inventaris dan kelola data barang Anda di sini.</p>
            </div>
            @can('create', App\Models\Produk::class)
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Produk
                </a>
            @endcan
        </div>

        {{-- Card Container --}}
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">

                {{-- Search Bar --}}
                <form action="{{ route('admin.produk.index') }}" method="GET" class="mb-4">
                    <div class="row g-2">
                        <div class="col-md-6 col-lg-4 ms-auto">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Cari nama produk...">
                                <button class="btn btn-outline-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">#</th>
                                <th scope="col" style="width: 80px;">Foto</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">User</th>
                                <th scope="col">Harga Beli</th>
                                <th scope="col">Harga Jual</th>
                                <th scope="col" class="text-center">Stok</th>
                                <th scope="col" class="text-end" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produk as $product)
                                <tr>
                                    <th scope="row" class="text-center text-muted fw-normal">{{ $loop->iteration }}</th>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}"
                                            class="rounded object-fit-cover" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-dark">{{ $product->nama }}</span>
                                    </td>
                                    <td class="text-muted fs-7">{{ $product->user->name }}</td>
                                    <td>Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                                    <td class="fw-semibold text-success">Rp
                                        {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $product->stok <= 5 ? 'bg-danger' : 'bg-secondary' }} rounded-pill px-3">
                                            {{ $product->stok }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            @can('update', $product)
                                                <a href="{{ route('admin.produk.edit', $product) }}"
                                                    class="btn btn-sm btn-outline-warning" title="Edit">
                                                    Edit
                                                </a>
                                            @endcan

                                            <form action="{{ route('admin.produk.destroy', $product) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                                    title="Hapus">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <p class="fs-5 mb-1">Data produk tidak ditemukan</p>
                                            <small>Coba kata kunci lain atau tambahkan produk baru.</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}    
                <div class="mt-4 d-flex justify-content-end">
                    {{ $produk->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
