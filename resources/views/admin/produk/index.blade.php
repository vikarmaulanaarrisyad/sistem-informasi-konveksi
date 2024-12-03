@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <x-card>
                            <x-slot name="header">
                                <button onclick="addForm(`{{ route('produk.store') }}`)" class="btn btn-sm btn-primary"><i
                                        class="fas fa-plus-circle"></i> Tambah
                                    Data</button>
                            </x-slot>
                            <x-table>
                                <x-slot name="thead">
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                    <th>Foto Produk</th>
                                    <th>Aksi</th>
                                </x-slot>
                            </x-table>
                        </x-card>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('admin.produk.form')
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
                url: '{{ route('produk.data') }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_produk'
                },
                {
                    data: 'kategori.nama_kategori'
                },
                {
                    data: 'qty'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'foto_produk'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // fungsi tambah data baru
        function addForm(url, title = 'Tambah Data Produk') {
            $(modal).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('post');
            // Hide the filename display
            resetForm(`${modal} form`);

            $('#btn-add-field button').show();
        }

        // Fungsi edit data
        function editForm(url, title = 'Edit Data Produk') {
            $.get(url) // Melakukan permintaan GET ke URL yang ditentukan
                .done(response => {
                    $('#btn-add-field button').hide();

                    // Menampilkan modal
                    $(modal).modal('show');
                    // Menetapkan judul modal
                    $(`${modal} .modal-title`).text(title);
                    // Menetapkan URL aksi form dan metode
                    $(`${modal} form`).attr('action', url);
                    $(`${modal} [name=_method]`).val('put');

                    // Reset form dan mengisinya dengan data respons
                    resetForm(`${modal} form`);
                    loopForm(response.data);

                    // Mengisi form dengan detail produk
                    $('#kode_produk').val(response.data.slug); // Menggunakan slug sebagai kode produk
                    $('#nama_produk').val(response.data.nama_produk); // Set nama produk
                    let kategoriId = response.data.kategori.id;

                    // Jika kategori belum ada di Select2, tambahkan secara dinamis
                    if ($('#kategori option[value="' + kategoriId + '"]').length === 0) {
                        let newOption = new Option(response.data.kategori.nama_kategori, kategoriId, true, true);
                        $('#kategori').append(newOption).trigger('change');
                    } else {
                        // Set kategori yang ada
                        $('#kategori').val(kategoriId).trigger('change');
                    }

                    // Menghapus field dinamis lama
                    let dynamicFieldsContainer = $('#dynamic-fields-container');
                    dynamicFieldsContainer.empty();

                    // Menambahkan field dinamis berdasarkan response.data.produk_details
                    if (Array.isArray(response.data.produk_details) && response.data.produk_details.length > 0) {
                        response.data.produk_details.forEach((detail, index) => {
                            const fieldHTML = `
                        <div class="row dynamic-fields">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="size[]">Size</label>
                                    <input type="text" class="form-control" name="size[]" value="${detail.size}" placeholder="Masukkan Size" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="harga_produk[]">Harga</label>
                                    <input type="text" class="form-control" name="harga_produk[]" value="${detail.harga_produk}" placeholder="Masukkan Harga" onkeyup="format_uang(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity[]">Quantity</label>
                                    <input type="number" class="form-control" name="quantity[]" value="${detail.quantity}" placeholder="Masukkan Quantity" min="1" required>
                                </div>
                            </div>
                        </div>
                    `;
                            dynamicFieldsContainer.append(fieldHTML); // Menambahkan field dinamis ke kontainer
                        });
                    } else {
                        console.log("Tidak ada detail produk untuk ditampilkan.");
                    }
                })
                .fail(errors => {
                    // Menangani jika permintaan GET gagal
                    $('#spinner-border').hide();
                    $(button).prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops! Gagal',
                        text: errors.responseJSON.message,
                        showConfirmButton: true,
                    });

                    if (errors.status == 422) {
                        $('#spinner-border').hide();
                        $(button).prop('disabled', false);
                        loopErrors(errors.responseJSON.errors); // Menangani error validasi
                    }
                });
        }

        // fungsi delete data
        function deleteData(url, name) {
            Swal.fire({
                title: 'Hapus Data!',
                text: 'Apakah Anda yakin ingin menghapus ' + name + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batalkan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            table.ajax.reload(); // Refresh tabel
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan.',
                            });
                        }
                    });
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

    <script>
        $(function() {
            $('.select2').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Kategori --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: '{{ route('kategori.search') }}',
                    dataType: 'json',
                    delay: 250, // Tambahkan delay jika perlu
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.nama_kategori
                                };
                            })
                        };
                    }
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            // Event saat modal ditutup
            $('#modal-form').on('hidden.bs.modal', function() {
                resetDynamicFields();
            });

            function resetDynamicFields() {
                var container = $('#dynamic-fields-container');
                // Kosongkan container dan tambahkan satu field default
                container.html(`
                <div class="row dynamic-fields">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="size[]">Size</label>
                            <input type="text" class="form-control" name="size[]" placeholder="Masukkan Size" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="harga_produk[]">Harga</label>
                            <input type="text" class="form-control" name="harga_produk[]" placeholder="Masukkan Harga" onkeyup="format_uang(this)">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity[]">Quantity</label>
                            <input type="number" class="form-control" name="quantity[]" placeholder="Masukkan Quantity" min="1" required>
                        </div>
                    </div>
                </div>
            `);
                attachRemoveEvent();
            }

            // Event untuk tombol tambah fields
            $('#add-fields').on('click', function() {
                var newFields = `
                <div class="row dynamic-fields">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="size[]">Size</label>
                            <input type="text" class="form-control" name="size[]" placeholder="Masukkan Size" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="harga_produk[]">Harga</label>
                            <input type="text" class="form-control" name="harga_produk[]" placeholder="Masukkan Harga" onkeyup="format_uang(this)">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="form-group">
                            <label for="quantity[]">Quantity</label>
                            <input type="number" class="form-control" name="quantity[]" placeholder="Masukkan Quantity" min="1" required>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger remove-field ml-2" style="height: 38px;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;
                $('#dynamic-fields-container').append(newFields);
                attachRemoveEvent();
            });

            function attachRemoveEvent() {
                $('.remove-field').off('click').on('click', function() {
                    if ($('.dynamic-fields').length > 1) {
                        $(this).closest('.dynamic-fields').remove();
                    } else {
                        alert('Minimal harus ada satu field!');
                    }
                });
            }

            // Attach remove event to initial fields
            attachRemoveEvent();
        });
    </script>
@endpush
