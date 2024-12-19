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
                    <div class="col-md-12">
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row justify-content-center">
                                            <!-- Custom Order Form -->
                                            <div class="col-md-8 col-sm-10">
                                                <div class="card shadow-sm">
                                                    <div class="card-header bg-primary text-white text-center">
                                                        <h4 class="checkout-subtitle mb-0"><b>Custom Order</b></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="customOrderForm" class="register-form" role="form"
                                                            enctype="multipart/form-data">
                                                            @csrf

                                                            <!-- Hidden Input for User ID -->
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::user()->id }}">

                                                            <!-- Name Input -->
                                                            <div class="form-group">
                                                                <label for="name" class="info-title">Your Name</label>
                                                                <input id="name" class="form-control" type="text"
                                                                    name="name" autocomplete="off"
                                                                    placeholder="Input your name"
                                                                    value="{{ Auth::user()->name }}" required>
                                                            </div>

                                                            <!-- File Design Input -->
                                                            <div class="form-group">
                                                                <label for="file_design" class="info-title">Upload
                                                                    Design</label>
                                                                <input id="file_design" class="form-control" type="file"
                                                                    name="file_design" accept="image/*" required>
                                                            </div>

                                                            <!-- Design Description Input -->
                                                            <div class="form-group">
                                                                <label for="design_description" class="info-title">Design
                                                                    Description</label>
                                                                <textarea id="design_description" name="design_description" cols="30" rows="5" class="form-control"
                                                                    placeholder="Describe your design" required></textarea>
                                                            </div>

                                                            <!-- Fabric Type Input -->
                                                            <div class="form-group">
                                                                <label for="fabric_type" class="info-title">Fabric
                                                                    Type</label>
                                                                <input id="fabric_type" class="form-control" type="text"
                                                                    name="fabric_type" placeholder="Input fabric type"
                                                                    required>
                                                            </div>

                                                            <!-- Size Input -->
                                                            <div class="form-group">
                                                                <label for="size" class="info-title">Size</label>
                                                                <input id="size" class="form-control" type="text"
                                                                    name="size"
                                                                    placeholder="Input size (e.g., S, M, L, XL)" required>
                                                            </div>

                                                            <!-- Quantity Input -->
                                                            <div class="form-group">
                                                                <label for="qty" class="info-title">Quantity</label>
                                                                <input id="qty" class="form-control" type="number"
                                                                    name="qty" required>
                                                            </div>

                                                            <!-- Submit Button -->
                                                            <div class="form-group text-center">
                                                                <button type="button" id="submitCustomOrder"
                                                                    class="btn btn-primary w-50">Submit Custom
                                                                    Order</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  @include('frontend.body.brands')  --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#submitCustomOrder').on('click', function(e) {
                e.preventDefault(); // Mencegah form dikirim secara tradisional

                // Ambil data form
                let formData = new FormData($('#customOrderForm')[0]);

                // Kirim data dengan AJAX
                $.ajax({
                    url: "{{ route('user.customorder.store') }}", // URL tujuan
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF
                    },
                    beforeSend: function() {
                        // Tambahkan loader atau nonaktifkan tombol submit
                        $('#submitCustomOrder').prop('disabled', true).text('Submitting...');
                    },
                    success: function(response) {
                        // Reset form
                        $('#customOrderForm')[0].reset();

                        if ($.isEmptyObject(response.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            window.location.href = "{{ route('user.customorder.history') }}";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.error,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        if ($.isEmptyObject(response.error)) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.error,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                        // Aktifkan kembali tombol submit
                        $('#submitCustomOrder').prop('disabled', false).text(
                            'Submit Custom Order');
                    },
                    complete: function() {
                        // Aktifkan kembali tombol submit
                        $('#submitCustomOrder').prop('disabled', false).text(
                            'Submit Custom Order');
                    }
                });
            });
        });
    </script>
@endpush
