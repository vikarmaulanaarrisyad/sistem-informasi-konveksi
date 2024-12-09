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
                <a href="{{ route('layanan.index') }}" class="nav-link"><i class="fas fa-concierge-bell"></i><span>Data
                        Layanan</span></a>
            </li>
            <li>
                <a href="{{ route('brands.index') }}" class="nav-link"><i class="fas fa-tags"></i><span>Data
                        Brand</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-list"></i>
                    <span>Manajemen Kategori</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('category.index') }}">Kategori</a></li>
                    <li><a class="nav-link" href="{{ route('subcategory.index') }}">Sub Kategori</a></li>
                    <li><a class="nav-link" href="{{ route('subsubcategory.index') }}">Sub Sub Kategori</a></li>
                </ul>
            </li>


            <li><a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-box"></i> <span>Manajemen
                        Produk</span></a></li>
            <li>
                <a class="nav-link" href="{{ route('sliders.index') }}"><i class="fas fa-box"></i> <span>Manajemen
                        Slider</span>
                </a>
            </li>


            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-shopping-cart"></i>
                    <span>Pesanan</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('pesanan.index') }}">Custom Pesanan</a></li>
                    <li><a class="nav-link" href="{{ route('pembelian.index') }}">Pesanan</a></li>
                </ul>
            </li>

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
