@extends('frontend.main_master')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class='active'>History Order</li>
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
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Invoce</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->payment_type }} </td>
                                        <td>{{ $item->invoice_no }} </td>
                                        <td>
                                            @if ($item->status == 'Pending')
                                                <span class="badge badge-pill badge-warning">{{ $item->status }}</span>
                                            @else
                                                <span class="badge badge-pill badge-success">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.order.detail', $item->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>
                                                View</a>

                                            <a href="{{ route('user.order.invoice', $item->id) }}"
                                                class="btn btn-sm btn-danger" target="_blank"><i class="fa fa-download"></i>
                                                Invoice</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
