@extends('layouts.app')

@section('title', 'Custom Order')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">@yield('title')</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <x-card>
                            <x-table>
                                <x-slot name="thead">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nomor Hp</th>
                                    <th>Bahan Kain</th>
                                    <th>Size</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </x-slot>
                            </x-table>
                        </x-card>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('admin.customorder.form')
    @include('admin.customorder.detail')
@endsection

@push('scripts')
    <script>
        let table;
        let modal = '#modal-form';
        let modalDetail = '#modalDetail'
        let button = '#submitBtn';

        table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('admin.customorders.data') }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'order_date'
                },
                {
                    data: 'name'
                },
                {
                    data: 'user.numberphone'
                },
                {
                    data: 'fabric_type'
                },
                {
                    data: 'size'
                },
                {
                    data: 'qty'
                },
                {
                    data: 'price'
                },
                {
                    data: 'total_price'
                },
                {
                    data: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // fungsi update Status
        function updateStatus(url, title = 'Update Data') {
            $.get(url) // Perform a GET request to the specified URL
                .done(response => {
                    $(modal).modal('show'); // Show the modal
                    $(`${modal} .modal-title`).text(title); // Set the modal title
                    $(`${modal} form`).attr('action', url); // Set the form action to the URL
                    $(`${modal} [name=_method]`).val('put'); // Set the HTTP method to PUT

                    resetForm(`${modal} form`); // Reset the form fields
                    loopForm(response.data); // Populate the form fields with the response data
                })
                .fail(errors => { // Handle any errors from the GET request
                    $('#spinner-border').hide(); // Hide the spinner
                    $(button).prop('disabled', false); // Enable the button
                    Swal.fire({ // Show an error message
                        icon: 'error',
                        title: 'Oops! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    if (errors.status == 422) {
                        $('#spinner-border').hide();
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors); // Handle validation errors
                    }
                });
        }

        // fungsi detail
        function detailData(url, title = 'Detail Data') {
            $.get(url) // Perform a GET request to the specified URL
                .done(response => {
                    $(modalDetail).modal('show'); // Show the modal
                    $(`${modalDetail} .modal-title`).text(title); // Set the modal title
                    $(`${modalDetail} form`).attr('action', url); // Set the form action to the URL
                    $(`${modalDetail} [name=_method]`).val('put'); // Set the HTTP method to PUT

                    resetForm(`${modalDetail} form`); // Reset the form fields
                    loopForm(response.data); // Populate the form fields with the response data

                    // Populate modal fields with response data
                    $('#name').val(response.data.name);
                    $('#file_design').val(response.data.file_design);
                    $('#design_description').val(response.data.design_description);
                    $('#fabric_type').val(response.data.fabric_type);
                    $('#size').val(response.data.size);
                    $('#total_price').val(response.data.total_price);
                    $('#dp_paid').val(response.data.dp_paid);
                    $('#remaining_payment').val(response.data.remaining_payment);
                    $('#order_date').val(response.data.order_date);
                    $('#completion_date').val(response.data.completion_date);
                    $('[name=status]').val(response.data.status);

                    // Display the file design as an image
                    const fileDesignPath = `/storage/${response.data.file_design}`; // Adjust the path accordingly
                    $('#file_design').html(`<img src="${fileDesignPath}" class="img-fluid" alt="Desain">`);
                })
                .fail(errors => { // Handle any errors from the GET request
                    $('#spinner-border').hide(); // Hide the spinner
                    $(button).prop('disabled', false); // Enable the button
                    Swal.fire({ // Show an error message
                        icon: 'error',
                        title: 'Oops! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    if (errors.status == 422) {
                        $('#spinner-border').hide();
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors); // Handle validation errors
                    }
                });
        }

        // fungsi kirim data inputan
        function submitForm(originalForm) {
            const submitBtn = $('#submitBtn'); // Reference to the button
            $(button).prop('disabled', true);
            $('#spinner-border').show();
            submitBtn.addClass('btn-progress');

            $.post({
                    url: $(originalForm).attr('action'),
                    data: new FormData(originalForm),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false
                })
                .done(response => {
                    $(modal).modal('hide');
                    if (response.status = 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        }).then(() => {
                            $(button).prop('disabled', false);
                            $('#spinner-border').hide();
                            submitBtn.removeClass('btn-progress');
                            table.ajax.reload();
                        })
                    }
                })
                .fail(errors => {
                    $('#spinner-border').hide();
                    submitBtn.removeClass('btn-progress');
                    $(button).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Opps! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });
                    if (errors.status == 422) {
                        $('#spinner-border').hide()
                        submitBtn.removeClass('btn-progress')
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors);
                        return;
                    }
                });
        }

        function downlodDesain(url) {
            alert(url)
            window.location.href = url;
        }
    </script>

    {{--  <script>
        function showStatusModal(orderId) {
            // Set order ID ke dalam input hidden
            $('#orderId').val(orderId);

            // Tampilkan modal
            $('#statusModal').modal('show');
        }

        $(document).ready(function() {
            $('#saveStatusButton').on('click', function() {
                let orderId = $('#orderId').val();
                let status = $('#status').val();
                let price = $('#price').val();

                $.ajax({
                    url: `/admin/customorders/${orderId}`, // Pastikan route sesuai
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: status,
                        price: price
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#statusModal').modal('hide');
                        // Reload datatable
                        $('#customOrderTable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>  --}}
@endpush
