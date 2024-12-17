@extends('frontend.main_master')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Detail</li>
                    <li class='active'>Order</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div>
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    @include('frontend.common.user_sidebar')
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-10">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Alamat</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->notes }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p>
                        <strong class="text-danger">Catatan : {{ $order->notes }}</strong>
                    </p>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Neme</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ Storage::url($item->product->product_thumbnail) }}"
                                                        alt="" style="width: 60px; height:60px">
                                                </td>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>{{ $item->color }}</td>
                                                <td>{{ $item->size }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>Rp. {{ format_uang($item->price) }}</td>
                                                <td>Rp. {{ format_uang($item->price * $item->qty) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
