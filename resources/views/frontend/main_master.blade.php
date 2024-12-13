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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <input type="number" class="form-control" name="" id="" value="1"
                                    min="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Add to Cart</button>
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


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

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
</body>

</html>
