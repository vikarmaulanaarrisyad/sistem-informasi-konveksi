@extends('layouts.app')

@section('title', 'List Orders')

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
                                    <th>Invoice</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Nomor Hp</th>
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
    @include('admin.order.form')
@endsection

@push('scripts')
    <script>
        let table;
        let modal = '#modal-form';
        let button = '#submitBtn';

        table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('admin.orders.data') }}'
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
                    data: 'invoice_no'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone'
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

        // fungsi edit data
        function editForm(url, title = 'Edit Data Kategori') {
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
    </script>
@endpush