<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/main.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/blue.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/owl.transitions.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/rateit.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/bootstrap-select.min.css">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/font-awesome.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('frontend.body.header')
    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.body.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong id="pname"></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card" style="width: 100%;">
                                <img id="pimage" src="..." class="card-img-top" style="width: 100%"
                                    alt="...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item">Product Price: <span id="price"></span>
                                    <del id="oldprice"></del>
                                </li>
                                <li class="list-group-item">Product Code: <span id="pcode"></span></li>
                                <li class="list-group-item">Category: <span id="pcategory"></span></li>
                                <li class="list-group-item">Brand: <span id="pbrand"></span></li>
                                <li class="list-group-item">Stock: <span id="pstock"></strong></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" id="sizeArea">
                                <label for="size">Size</label>
                                <select name="size" id="size" class="form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <select name="color" id="color" class="form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" name="qty" id="qty"
                                    value="1" min="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="product_id" id="product_id">
                    <button type="button" class="btn btn-primary" onclick="addToCart()">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('/frontend') }}/assets/js/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/echo.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/jquery.easing-1.3.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/bootstrap-slider.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="{{ asset('/frontend') }}/assets/js/lightbox.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        // function get view modal
        function productView(id) {
            $.ajax({
                type: 'GET',
                url: 'product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    console.log(data.product)

                    $('#pname').text(data.product.product_name)
                    $('#pcode').text(data.product.product_code)
                    $('#pcategory').text(data.product.category.category_name)
                    $('#pbrand').text(data.product.brand.brand_name)
                    $('#pstock').text(data.product.product_qty)
                    $('#pimage').attr('src', data.product.product_thumbnail)

                    $('#product_id').val(data.product.id)
                    $('#qty').val(1)

                    //price
                    if (data.product.discount_price == 0) {
                        $('#price').text(data.product.selling_price)
                    } else {
                        $('#price').text(data.product.selling_price)
                        $('#oldprice').text(data.product.selling_price)
                    }

                    // color
                    $('select[name="color"]').empty()
                    $.each(data.color, function(key, value) {
                        $('select[name="color"]').append('<option value="' + value + '" >' + value +
                            '</option>')
                    })

                    // size
                    $('select[name="size"]').empty()
                    $.each(data.size, function(key, value) {
                        $('select[name="size"]').append('<option value="' + value + '" >' + value +
                            '</option>')
                    })

                    // cek size
                    if (data.size == "") {
                        $('#sizeArea').hide()
                    } else {
                        $('#sizeArea').show()
                    }
                }
            })
        }
    </script>

    <script>
        // function add to cart
        function addToCart() {
            let product_name = $('#pname').text()
            let id = $('#product_id').val()
            let color = $('#color option:selected').text()
            let size = $('#size option:selected').text()
            let qty = $('#qty').val()

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    product_name: product_name,
                    color: color,
                    size: size,
                    qty: qty
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                    miniCart()
                    $('#closeModal').click()
                    Swal.fire({
                        title: "Berhasil",
                        text: data.success,
                        showConfirmButton: false,
                        timer: 3000,
                        icon: "success"
                    });
                }
            });
        }
    </script>

    <script>
        function miniCart() {
            $.ajax({
                type: "GET",
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {

                    $('span[id="cartSubTotal"]').text(response.cartTotal)
                    $('#cartQty').text(response.cartQty)

                    let miniCart = ""

                    $.each(response.carts, function(key, value) {
                        miniCart += `<div class="cart-item product-summary">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="image"> <a href=""><img src="${value.options.image}"
                                                            alt=""></a>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <h3 class="name"><a href="index.php?page-detail">${value.name}</a>
                                                </h3>
                                                <div class="price">Rp. ${value.price}</div>
                                            </div>
                                            <div class="col-xs-1 action"> <button type="submit" onclick="miniCartRemove(this.id)"  id="${value.rowId}" ><i class="fa fa-trash"></i></button> </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                `
                    });

                    $('#miniCart').html(miniCart)
                }
            })
        }

        miniCart()

        // remove mini cart
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: "/minicart/product-remove/" + rowId,
                dataType: 'json',
                success: function(data) {
                    Swal.fire({
                        title: "Berhasil",
                        text: data.success,
                        showConfirmButton: false,
                        timer: 3000,
                        icon: "success"
                    }).then(() => {
                        miniCart()
                    });

                }
            })
        }
    </script>
</body>

</html>
