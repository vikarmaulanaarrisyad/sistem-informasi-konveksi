@extends('layouts.app')

@section('title', 'Daftar Produk')

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
                            <x-slot name="header">
                                <button onclick="addForm(`{{ route('products.store') }}`)" class="btn btn-sm btn-primary"><i
                                        class="fas fa-plus-circle"></i> Tambah
                                    Data</button>
                            </x-slot>
                            <x-table class="table_product">
                                <x-slot name="thead">
                                    <th>No</th>
                                    <th>Thumbnail Produk</th>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
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

    @include('admin.product.detail')
    @include('admin.product.form')
@endsection

@push('scripts')
    <script>
        let table;
        let modal = '#modal-form';
        let button = '#submitBtn';

        $(function() {
            $('body').addClass('sidebar-collapse sidebar-mini');

            // Initialize brand_id Select2
            $('.brand_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Brand --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: '{{ route('brands.search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        console.log(data)
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.brand_name
                                };
                            })
                        };
                    }
                }
            });

            $('.category_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Kategori --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: '{{ route('category.search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.category_name
                                };
                            })
                        };
                    }
                }
            });

            // Disable subcategory and subsubcategory dropdowns initially
            $('.subcategory_id').prop('disabled', true);
            $('.subsubcategory_id').prop('disabled', true);

            // Initialize subcategory_id Select2
            $('.subcategory_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Sub Kategori --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: function() {
                        let categoryId = $('.category_id').val(); // Get selected category
                        return categoryId ?
                            `{{ url('subcategory/search') }}/${categoryId}` :
                            ''; // Adjust route as per your application
                    },
                    dataType: 'json',
                    delay: 250,
                    processResults: function(response) {
                        console.log("Received response:", response);
                        if (!Array.isArray(response.data)) {
                            console.error("Expected an array in response.data but got:", response);
                            return {
                                results: []
                            };
                        }
                        return {
                            results: response.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.subcategory_name
                                };
                            })
                        };
                    }
                }
            });

            // Initialize subsubcategory_id Select2
            $('.subsubcategory_id').select2({
                thema: 'bootstrap-4',
                placeholder: '-- Pilih Sub Sub Kategori --',
                closeOnSelect: true,
                allowClear: true,
                ajax: {
                    url: function() {
                        let subCategoryId = $('.subcategory_id').val(); // Get selected subcategory
                        return subCategoryId ?
                            `{{ url('subsubcategory/search') }}/${subCategoryId}` :
                            ''; // Adjust route as per your application
                    },
                    dataType: 'json',
                    delay: 250,
                    processResults: function(response) {
                        if (!Array.isArray(response.data)) {
                            console.error("Expected an array in response.data but got:", response);
                            return {
                                results: []
                            };
                        }
                        return {
                            results: response.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.subsubcategory_name
                                };
                            })
                        };
                    }
                }
            });

            // Enable subcategory dropdown when category is selected
            $('.category_id').on('change', function() {
                let categoryId = $(this).val();

                if (categoryId) {
                    // Enable subcategory dropdown
                    $('.subcategory_id').prop('disabled', false).val(null).trigger('change');
                    $('.subsubcategory_id').prop('disabled', true).val(null).trigger(
                        'change'); // Keep subsubcategory disabled
                } else {
                    // Disable and reset subcategory dropdown
                    $('.subcategory_id').val(null).trigger('change').prop('disabled', true);
                    $('.subsubcategory_id').val(null).trigger('change').prop('disabled', true);
                }
            });

            // Enable subsubcategory dropdown when subcategory is selected
            $('.subcategory_id').on('change', function() {
                let subCategoryId = $(this).val();

                if (subCategoryId) {
                    // Enable subsubcategory dropdown
                    $('.subsubcategory_id').prop('disabled', false).val(null).trigger('change');
                } else {
                    // Disable and reset subsubcategory dropdown
                    $('.subsubcategory_id').val(null).trigger('change').prop('disabled', true);
                }
            });
        });

        table = $('.table_product').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '{{ route('products.data') }}'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'product_thumbnail'
                },
                {
                    data: 'product_code'
                },
                {
                    data: 'product_name'
                },
                {
                    data: 'product_qty'
                },
                {
                    data: 'selling_price'
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
            $(modal).modal('show'); // Tampilkan modal
            $(`${modal} .modal-title`).text(title); // Set judul modal
            $(`${modal} form`).attr('action', url); // Set action URL pada form
            $(`${modal} [name=_method]`).val('put'); // Gunakan method PUT untuk update data

            // Reset form sebelum mengisi data
            resetForm(`${modal} form`);

            // Ambil data dari server dan isi ke form
            $.get(url)
                .done((response) => {
                    console.log(response);
                    const {
                        brand,
                        category,
                        sub_category,
                        sub_sub_category,
                        product_code,
                        product_name,
                        product_slug,
                        product_qty,
                        product_size,
                        product_color,
                        selling_price,
                        discount_price,
                        short_descp,
                        long_descp,
                        product_thumbnail,
                        price_after_discount, // Ensure this is included
                        status
                    } = response.data;

                    // Dynamically update brand and category select options
                    updateSelectOption('#brand_id', brand.id, brand.brand_name);
                    updateSelectOption('#category_id', category.id, category.category_name);
                    updateSelectOption('#subcategory_id', sub_category.id, sub_category.subcategory_name);
                    updateSelectOption('#subsubcategory_id', sub_sub_category.id, sub_sub_category.subsubcategory_name);

                    // Update status checkbox berdasarkan nilai yang diterima
                    if (response.data.hot_deals === 1) {
                        $(`${modal} [name="hot_deals"]`).prop('checked', true);;
                    } else {
                        $(`${modal} [name="hot_deals"]`).prop('checked', false);
                    }

                    if (response.data.featured === 1) {
                        $(`${modal} [name="featured"]`).prop('checked', true);
                    } else {
                        $(`${modal} [name="featured"]`).prop('checked', false);
                    }

                    if (response.data.special_offer === 1) {
                        $(`${modal} [name="special_offer"]`).prop('checked', true);
                    } else {
                        $(`${modal} [name="special_offer"]`).prop('checked', false);
                    }

                    // Fill in the form fields
                    $(`${modal} [name="product_code"]`).val(product_code);
                    $(`${modal} [name="product_name"]`).val(product_name);
                    $(`${modal} [name="product_slug"]`).val(product_slug);
                    $(`${modal} [name="product_qty"]`).val(product_qty);
                    $(`${modal} [name="product_size"]`).val(product_size);
                    $(`${modal} [name="product_color"]`).val(product_color);
                    $(`${modal} [name="selling_price"]`).val(selling_price);
                    $(`${modal} [name="price_after_discount"]`).val(price_after_discount); // Added price_after_discount
                    $(`${modal} [name="discount_price"]`).val(discount_price);
                    $(`${modal} [name="short_descp"]`).val(short_descp);
                    $(`${modal} [name="long_descp"]`).val(long_descp);
                    $(`${modal} [name="status"]`).val(status);

                })
                .fail((errors) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Gagal mengambil data.',
                    });
                });
        }

        function detailForm(url) {
            $.get(url, function(response) {
                const data = response.data
                console.log('data', data)
                $('#product_name').val(data.product_name);
                $('#product_code').val(data.product_code || '');
                $('#short_descp').val(data.short_descp || '');
                $('#long_descp').val(data.long_descp || '');
                $('#category').val(data.category.category_name || 'N/A');
                $('#subcategory').val(data.sub_category.subcategory_name || 'N/A');
                $('#product_size').val(data.product_size || '');
                $('#product_color').val(data.product_color || '');
                $('#selling_price').val(data.selling_price || '');
                $('#discount_price').val(data.discount_price || '');
                $('#product_qty').val(data.product_qty || '');
                $('#status').val(data.status == 1 ? 'Active' : 'Inactive');

                // Tambahkan multiple images
                $('#multi_images').empty();
                $('#product_thumbnail').empty();

                $('#product_thumbnail').append('<img src="' + data.product_thumbnail +
                    '" class="img-fluid rounded" style="max-width: 150px; height: auto; margin: 5px;">'
                );
                if (data.multi_images) {
                    data.multi_images.forEach(image => {
                        $('#multi_images').append('<img src="' + image.photo_name +
                            '" class="img-fluid rounded" style="max-width: 150px; height: auto; margin: 5px;">'
                        );
                    });
                }

                $('#modalDetail').modal('show');
            })
        }

        // Function to update a select element with options
        function updateSelectOption(selector, value, text) {
            // Check if the option exists
            const optionExists = $(`${selector} option[value="${value}"]`).length > 0;

            if (!optionExists) {
                // If the option doesn't exist, create and append it
                const newOption = new Option(text, value, true, true);
                $(selector).append(newOption).trigger('change');
            } else {
                // If the option exists, update the select's value
                $(selector).val(value).trigger('change');
            }
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
        // Function to preview the thumbnail image
        function previewImage(input) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const thumbnailPreview = document.getElementById('thumbnailPreview');
                thumbnailPreview.src = e.target.result;
                thumbnailPreview.style.display = 'block'; // Show the image preview
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Function to preview multiple product images
        function previewMultipleImages(input) {
            const files = input.files;
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            imagePreviewContainer.innerHTML = ''; // Clear previous previews

            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.margin = '5px';
                    imagePreviewContainer.appendChild(img);
                };
                if (files[i]) {
                    reader.readAsDataURL(files[i]);
                }
            }
        }

        // Event listener to clear previews when the modal is closed
        $(modal).on('hidden.bs.modal', function() {
            // Clear the image previews when modal is closed
            document.getElementById('thumbnailPreview').style.display = 'none';
            document.getElementById('thumbnailPreview').src = '';
            document.getElementById('imagePreviewContainer').innerHTML = '';
            // Optionally reset the file inputs
            document.getElementById('product_thumbnail').value = '';
            document.getElementById('photo_name').value = '';
        });
    </script>

    <script>
        function calculateDiscountPrice() {
            var sellingPrice = parseFloat(document.getElementById('selling_price').value.replace(/\./g, '').replace(',',
                '.')) || 0;

            var discountPercentage = document.getElementById('discount_price').value || 0;
            // Calculate the discount amount
            var discountAmount = (sellingPrice * discountPercentage) / 100;

            // Calculate the price after discount
            var priceAfterDiscount = sellingPrice - discountAmount;

            // Format the result and display it
            document.getElementById('price_after_discount').value = formatCurrency(priceAfterDiscount);
        }

        function formatCurrency(value) {
            return value.toLocaleString('id-ID').replace(",", ".");
        }

        // Optional: Call this function if you want to display the price after discount on page load (if selling_price is pre-filled)
        calculateDiscountPrice();
    </script>
@endpush
