@extends('frontend.main_master')

@section('title', 'Checkout')

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
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">

                                <div id="collapseOne" class="panel-collapse collapse in">

                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">

                                            <!-- guest-login -->
                                            <div class="col-md-6 col-sm-6 guest-login">
                                                <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>
                                                <!-- radio-form  -->
                                                <form class="register-form" role="form" method="post"
                                                    action="{{ route('user.checkout.detail') }}">
                                                    @csrf


                                                    <div class="form-group">
                                                        <label for="name" class="info-title">Your Name</label>
                                                        <input id="name" class="form-control unicase-form-control"
                                                            type="text" name="name" autocomplete="off"
                                                            placeholder="Input your name" value="{{ Auth::user()->name }}"
                                                            required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email" class="info-title">Email</label>
                                                        <input id="email" class="form-control unicase-form-control"
                                                            type="email" name="email" autocomplete="off"
                                                            placeholder="Input your email" value="{{ Auth::user()->email }}"
                                                            required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone" class="info-title">Phone</label>
                                                        <input id="phone" class="form-control unicase-form-control"
                                                            type="number" name="phone" autocomplete="off"
                                                            placeholder="Input your phone"
                                                            value="{{ Auth::user()->numberphone }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="post_code" class="info-title">Post Code</label>
                                                        <input id="post_code" class="form-control unicase-form-control"
                                                            type="text" name="post_code" autocomplete="off"
                                                            placeholder="Input your post code" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="notes" class="info-title">Catatan</label>
                                                        <textarea name="notes" id="notes" cols="30" rows="5" class="form-control"></textarea>
                                                    </div>


                                            </div>
                                            <!-- guest-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <br>
                                                <br>

                                                <div class="form-group">
                                                    <label for="province_id" class="info-title">Pilih Provinsi</label>
                                                    <select name="province_id" id="province_id"
                                                        class="form-control select2 province_id" style="width: 100%;">
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="regence_id" class="info-title">Pilih Kabupaten/Kota</label>
                                                    <select name="regence_id" id="regence_id"
                                                        class="form-control select2 regence_id"
                                                        style="width: 100%;"></select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="district_id" class="info-title">Pilih Kecamatan</label>
                                                    <select name="district_id" id="district_id"
                                                        class="form-control district_id" style="width: 100%;"></select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="village_id" class="info-title">Pilih Desa</label>
                                                    <select name="village_id" id="village_id"
                                                        class="form-control village_id" style="width: 100%;"></select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="address" class="info-title">Alamat</label>
                                                    <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                                                </div>


                                            </div>

                                        </div>
                                    </div>

                                </div><!-- row -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @foreach ($carts as $item)
                                                <li>
                                                    <strong>Image: </strong>
                                                    <img src="{{ url($item->options->image) }}" alt=""
                                                        width="50px;" height="50px;">
                                                </li>
                                                <li>
                                                    <strong>Qty: </strong>
                                                    ({{ $item->qty }})
                                                    <strong>Color: </strong>
                                                    ({{ $item->options->color }})

                                                    <strong>Size: </strong>
                                                    ({{ $item->options->size }})
                                                </li>
                                                <hr>
                                            @endforeach
                                            <strong>Grand Total:</strong> Rp. {{ $total }}
                                            <hr>

                                            <button type="submit" class="btn btn-primary">Continue to Checkout</button>
                                            </form>
                                            <!-- radio-form  -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
            @include('frontend.body.brands')
        </div>
        <!-- /.container -->
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            // Initialize Select2 for provinces
            $('.province_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Provinsi --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: '{{ route('user.checkout.searchProvince') }}',
                    dataType: 'json',
                    delay: 300,
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    }
                }
            });

            // Disable subsequent dropdowns initially
            $('.regence_id, .district_id, .village_id').prop('disabled', true);

            // Initialize Select2 for regencies
            $('.regence_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Kabupaten/Kota --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: function() {
                        let provinceId = $('.province_id').val();
                        return provinceId ?
                            `{{ route('user.checkout.searchRegence', ':provinceId') }}`.replace(
                                ':provinceId', provinceId) :
                            '';
                    },
                    dataType: 'json',
                    delay: 300,
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    }
                }
            });

            // Initialize Select2 for districts
            $('.district_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Kecamatan --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: function() {
                        let regencyId = $('.regence_id').val();
                        return regencyId ?
                            `{{ route('user.checkout.searchDistrict', ':regencyId') }}`.replace(
                                ':regencyId', regencyId) :
                            '';
                    },
                    dataType: 'json',
                    delay: 300,
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    }
                }
            });

            // Initialize Select2 for villages
            $('.village_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Desa/Kelurahan --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: function() {
                        let districtId = $('.district_id').val();
                        return districtId ?
                            `{{ route('user.checkout.searchVillage', ':districtId') }}`.replace(
                                ':districtId', districtId) :
                            '';
                    },
                    dataType: 'json',
                    delay: 300,
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    }
                }
            });

            // Enable and reset subsequent dropdowns
            $('.province_id').on('change', function() {
                let provinceId = $(this).val();
                if (provinceId) {
                    $('.regence_id').prop('disabled', false).val(null).trigger('change');
                    $('.district_id, .village_id').prop('disabled', true).val(null).trigger('change');
                } else {
                    $('.regence_id, .district_id, .village_id').val(null).trigger('change').prop('disabled',
                        true);
                }
            });

            $('.regence_id').on('change', function() {
                let regencyId = $(this).val();
                if (regencyId) {
                    $('.district_id').prop('disabled', false).val(null).trigger('change');
                    $('.village_id').prop('disabled', true).val(null).trigger('change');
                } else {
                    $('.district_id, .village_id').val(null).trigger('change').prop('disabled', true);
                }
            });

            $('.district_id').on('change', function() {
                let districtId = $(this).val();
                if (districtId) {
                    $('.village_id').prop('disabled', false).val(null).trigger('change');
                } else {
                    $('.village_id').val(null).trigger('change').prop('disabled', true);
                }
            });
        });
    </script>
@endpush
