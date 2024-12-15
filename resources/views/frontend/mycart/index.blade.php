@extends('frontend.main_master')

@section('title', 'My Cart')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class='active'>@yield('title')</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="shoping-cart">
                    <div class="shoping-cart-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name item">Image</th>
                                        <th class="cart-product-name item">Product Name</th>
                                        <th class="cart-product-name item">Product Price</th>
                                        <th class="cart-product-name item">Color</th>
                                        <th class="cart-product-name item">Size</th>
                                        <th class="cart-product-name item">Qty</th>
                                        <th class="cart-product-name item">Subtotal</th>
                                        <th class="cart-product-name item">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="getMyCart">


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.sigin-in-->
        </div><!-- /.container -->
    </div>

    @include('frontend.body.brands')
@endsection
