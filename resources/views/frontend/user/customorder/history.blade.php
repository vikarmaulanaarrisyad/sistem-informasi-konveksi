@extends('frontend.main_master')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class='active'>History Custom Order</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div>


    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-0">
                    <br>
                    {{--  @include('frontend.common.user_sidebar')  --}}
                </div>
                <div class="col-md-12">
                    <a href="{{ route('user.customorder.history') }}" class="btn btn-sm btn-warning">Kembali</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Deskripsi</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customOrders as $item)
                                    <tr>
                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->total_price }}</td>
                                        <td>{{ $item->design_description }} </td>
                                        <td>{{ $item->size }} </td>
                                        <td>
                                            <span class="badge badge-pill badge-danger">{{ $item->status }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.customorder.detail', $item->id) }}"
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
