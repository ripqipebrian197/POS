<nav class="navbar navbar-expand-lg border-bottom shadow-sm" style="background-color: #4338CA;">
    <div class="container-fluid px-4">

        <a class="navbar-brand text-white fw-bold me-4" href="#">POS</a>

        <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('dashboard') ? 'fw-bold border-bottom border-2 border-white' : 'opacity-75' }}" 
                       href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/users') ? 'fw-bold border-bottom border-2 border-white' : 'opacity-75' }}"
                        href="{{ route('admin.users') }}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/produk') ? 'fw-bold border-bottom border-2 border-white' : 'opacity-75' }}" 
                       href="{{ route('admin.produk.index') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ Request::is('admin/penjualan') ? 'fw-bold border-bottom border-2 border-white' : 'opacity-75' }}" 
                       href="{{ route('admin.penjualan.index') }}">Penjualan</a>
                </li>
            </ul>

            <form method="POST" action="{{ route('logout') }}" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm px-3 rounded-2 fw-semibold">Logout</button>
            </form>
        </div>
    </div>
</nav>