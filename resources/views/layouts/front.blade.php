<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>VIMS | @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/frontend') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/owl.css">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include('partials.front.navbar')



    @yield('content')


    <div class="mt-5 pt-5 pb-5 footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12 about-company">
                    <h2>About us</h2>
                    <p class="pr-5 text-white-50">Following sosial media </p>
                    <p><a href="#"><i class="fa fa-facebook-square mr-1"></i></a><a href="#"><i
                                class="fa fa-linkedin-square"></i></a></p>
                </div>
                <div class="col-lg-4 col-xs-12 open-store">
                    <h4 class="mt-lg-0 mt-sm-4">Open Store</h4>
                    <p class="text-white">Monday - Wednesday <span>8.00-18.00</span></p>
                    <p class="text-white">Thursday - friday <span>9.00-20.00</span></p>
                    <p class="text-white">Saturday <span>9.00-18.30</span></p>
                    {{-- <p><a href="#"><i class="fa fa-store mr-3"></i>Visit Store</a></p> --}}
                </div>
                <div class="col-lg-4 col-xs-12 location">
                    <h4 class="mt-lg-0 mt-sm-4">Kontak</h4>
                    <p class="text-white">22, Lorem ipsum dolor, consectetur adipiscing</p>
                    <p class="mb-0 text-white"><i class="fa fa-phone mr-3"></i>0895380045741</p>
                    <p class="text-white"><i class="fa fa-envelope-o mr-3"></i>viary23@gmail.com</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col copyright">
                    <p class=""><small class="text-white-50">© 2024. All Rights Reserved.</small></p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .footer {
            background: #252525;
            color: white;

            .links {
                ul {
                    list-style-type: none;
                }

                li a {
                    color: white;
                    transition: color .2s;

                    &:hover {
                        text-decoration: none;
                        color: #4180CB;
                    }
                }
            }

            .about-company {
                i {
                    font-size: 25px;
                }

                a {
                    color: white;
                    transition: color .2s;

                    &:hover {
                        color: #4180CB
                    }
                }
            }

            .location {
                i {
                    font-size: 18px;
                }
            }

            .copyright p {
                border-top: 1px solid rgba(255, 255, 255, .1);
            }
        }
    </style>


    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('/frontend') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('/frontend') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="{{ asset('/frontend') }}/assets/js/custom.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/owl.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/slick.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/isotope.js"></script>
    <script src="{{ asset('/frontend') }}/assets/js/accordions.js"></script>


    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>
</body>

</html>
