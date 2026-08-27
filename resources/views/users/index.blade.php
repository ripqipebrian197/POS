@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<div class="container py-4">
    <!-- Header & Tombol Create -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Halaman Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-sm px-4">
            <i class="bi bi-plus-circle me-1"></i> Create
        </a>
    </div>

    <!-- Card Container untuk Konten -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            
            <!-- Form Search -->
            <form action="{{ route('admin.users') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search username or email"
                    >
                    <button class="btn btn-outline-secondary" type="submit">
                        Search
                    </button>
                </div>
            </form>

            <!-- Tabel Data Users -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-center" style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                        {{ $user->role->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning text-white">
                                            Edit Akun
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Tidak ada data user ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 d-flex justify-content-end">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</div>

@endsection