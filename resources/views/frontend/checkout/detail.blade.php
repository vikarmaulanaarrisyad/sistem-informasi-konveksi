@extends('frontend.main_master')

@section('title', 'Checkout Detail')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class='active'>@yield('title')</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">
                    <div class="col-md-8">

                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Detail Order</h4>
                                    </div>

                                    @foreach ($carts as $cart)
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img src="{{ $cart->options->image }}" alt="" style="width: 100%">
                                            </div>
                                            <div class="col-md-8">
                                                <h4 class="unicase-checkout-title">{{ $cart->name }}</h4>
                                                <hr>
                                                <p class="unicase-checkout-title">Quantity: {{ $cart->qty }} | Color:
                                                    {{ $cart->options->color }} | Size: {{ $cart->options->size }}</p>
                                                <hr>
                                                <p class="unicase-checkout-title">Price:Rp. {{ format_uang($cart->price) }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>

                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Shipping Address</h4>
                                    </div>
                                    <div class="">
                                        <strong>Name: {{ $name }}</strong>
                                        <hr>
                                        <strong>Phone: {{ $phone }}</strong>
                                        <hr>
                                        <strong>Provinsi : {{ $province->name }}</strong>
                                        <hr>
                                        <strong>Kab/Kota : {{ $regence->name }}</strong>
                                        <hr>
                                        <strong>Kecamatan : {{ $regence->name }}</strong>
                                        <hr>
                                        <strong>Desa : {{ $village->name }}</strong>
                                        <hr>
                                        <strong>Address: {{ $address }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="checkout-progress-sidebar ">

                            <div class="panel-group">
                                <div class="panel panel-default checkout-step-02">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">
                                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion"
                                                href="#collapseTwo">
                                                <span></span>Lihat Catatan
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            {{ $notes }}
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="">
                                        <Strong>Grand Total : {{ $total }} </Strong>
                                        <hr>
                                        <button class="btn btn-primary">Pay Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>

                </div>
            </div>
        </div>
    @endsection
