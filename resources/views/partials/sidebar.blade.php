<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="{{ route('layanan.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Data
                        Layanan</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Produk</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a></li>
                    <li><a class="nav-link" href="{{ route('produk.index') }}">Stok Produk</a></li>
                </ul>
            </li>
            {{--  <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Pesanan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="#">Custom Pesanan</a></li>
                    <li><a class="nav-link" href="#l">Pesanan</a></li>
                </ul>
            </li>  --}}

            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank
                        Page</span></a></li>
            <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i>
                    <span>Credits</span></a></li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
