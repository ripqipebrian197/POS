@extends('layouts.app')

@section('title', 'produk')

@section('content')
    
@include('layouts.navbar')

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

    <h1>Halaman Produk</h1>

    @can('create', App\Models\Produk::class)
        <a href="{{ route('produk.create') }}" method="GET" class="btn btn-primary mb-3">create</a>
    @endcan
    <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="" class="form-control" placeholder="Search nama produk">
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->user->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->foto) }}" width="100" class="img-thumbnail">
                    </td>
                    <td>{{ $product->nama }}</td>
                    <td>{{ $product->harga_beli }}</td>
                    <td>{{ $product->harga_jual }}</td>
                    <td>{{ $product->stok }}</td>
                    <td class="d-flex gap-1">
                        @can('update', $product)
                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        ||
                        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apa anda yakin akan menghapus produk ini')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <h1>Data tidak tersedia.</h1>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $produk->links() }}
@endsection
</table>
