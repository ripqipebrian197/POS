<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">POS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                {{-- Pindah ke sini, di dalam ul --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}"
                        href="{{ route('admin.users') }}">User</a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ Request::is('admin/produk*') ? 'active' : '' }}" href="{{ route('admin.produk.index') }}">Produk</a>
                </li>
           
            <li class="nav-item">
                <a
                    class="nav-link {{ Request::is('admin/penjualan*') ? 'active' : '' }}" href="{{ route('admin.penjualan.index') }}">Penjualan</a>
            </li>
             </ul>

            <form method="POST" action="{{ route('logout') }}" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm"> Logout</button>
            </form>
        </div>
    </div>
</nav>