<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h2>Viary <em>Store</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Home
                            {{-- <span class="sr-only">(current)</span> --}}
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('produk') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Pembelian</a>
                    </li>
                    <li class="nav-item {{ Request::is('pemesanan') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Pemesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About us</a>
                    </li>
                    <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <!-- Cart Icon -->


                    @auth

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user ml-1"></i> Hi, {{ Auth::user()->username }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->hasRole('admin'))
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                @endif
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">History pembelian</a>
                                <a class="dropdown-item" href="#">History pemesanan</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <!-- Show Login and Register links when not logged in -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                            </div>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="cart-icon">
                            <i class="fa fa-shopping-cart"></i>
                            <span id="cart-count"
                                class="badge badge-danger">{{ session('cart') ? array_sum(session('cart')) : 0 }}</span>
                        </a>
                    </li>
                    <!-- Sidebar Popup -->
                    <div id="cart-sidebar" class="cart-sidebar">
                        <div class="cart-header">
                            <h4>Keranjang saya</h4>
                            <button class="close-btn" onclick="toggleCartSidebar()">&times;</button>
                        </div>
                        <div class="cart-content">
                            <!-- Cart Item -->
                            <div class="cart-item">
                                <img src="https://via.placeholder.com/50" alt="Produk" class="product-img">
                                <div class="product-details">
                                    <p class="product-name">Robusta Brazil</p>
                                    <p class="product-price">
                                        Rp <span class="unit-price">20.000</span> ×
                                        <span class="quantity-controls">
                                            <button class="btn-minus" onclick="updateQuantity(this, -1)">−</button>
                                            <span class="quantity">3</span>
                                            <button class="btn-plus" onclick="updateQuantity(this, 1)">+</button>
                                        </span> = Rp <span class="total-price">60.000</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Overlay to close sidebar when clicking outside -->
                        <div id="cart-overlay" class="cart-overlay" onclick="toggleCartSidebar()"></div>
                </ul>
            </div>
        </div>
    </nav>
</header>



<script>
    function toggleCartSidebar() {
        const sidebar = document.getElementById('cart-sidebar');
        const overlay = document.getElementById('cart-overlay');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    document.getElementById('cart-icon').addEventListener('click', function(event) {
        event.preventDefault();
        toggleCartSidebar();
    });

    function updateQuantity(button, change) {
        const quantityElement = button.parentNode.querySelector('.quantity');
        let quantity = parseInt(quantityElement.textContent);
        const unitPrice = parseInt(button.closest('.cart-item').querySelector('.unit-price').textContent.replace('.',
            ''));
        quantity += change;
        if (quantity < 1) quantity = 1; // Minimum jumlah adalah 1
        quantityElement.textContent = quantity;

        // Update total harga per item
        const totalPriceElement = button.closest('.cart-item').querySelector('.total-price');
        totalPriceElement.textContent = (unitPrice * quantity).toLocaleString('id-ID');
    }
</script>

<style>
    .cart-sidebar {
        position: fixed;
        right: -400px;
        top: 0;
        width: 400px;
        height: 100%;
        background-color: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        transition: right 0.3s ease;
        z-index: 1050;
        overflow-y: auto;
    }

    .cart-sidebar.active {
        right: 0;
        /* Slide in */
    }

    #cart-count {
        position: relative;
        top: 5px;
        /* Adjust to position badge properly */
        right: 10px;
        /* Adjust to position badge properly */
        background-color: red;
        color: white;
        font-size: 0.55rem;
        font-weight: bold;
        border-radius: 50%;
        padding: 2px 3px;
        line-height: 1;
    }

    .cart-header {
        padding: 15px;
        background-color: #343a40;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #fff;
        cursor: pointer;
    }

    .cart-content {
        padding: 15px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
        font-family: Arial, sans-serif;
    }

    .product-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .product-details {
        flex: 1;
    }

    .product-name {
        font-weight: bold;
        margin: 0;
        display: flex
    }

    .product-price {
        font-size: 0.9rem;
        color: #555;
        display: flex;
        align-items: center;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 5px;
        margin: 0 5px;
    }

    .quantity-controls button {
        border: none;
        background-color: #000;
        /* Warna latar belakang hitam */
        color: #fff;
        /* Warna teks putih */
        width: 20px;
        height: 20px;
        border-radius: 3px;
        font-size: 0.8rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-controls .quantity {
        font-size: 0.9rem;
        text-align: center;
        width: 20px;
    }
</style>
