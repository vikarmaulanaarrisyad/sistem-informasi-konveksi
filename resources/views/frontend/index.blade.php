@extends('frontend.main_master')

@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="row">
                <!-- ============================================== SIDEBAR ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('frontend.common.vertical_menu')
                    <!-- ================================== TOP NAVIGATION : END ================================== -->

                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('frontend.common.hotdeals_product')
                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== SPECIAL OFFER ============================================== -->

                    @include('frontend.common.specialoffer_product')
                    <!-- ============================================== SPECIAL OFFER : END ============================================== -->


                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    @include('frontend.common.product_tags')
                    <!-- ============================================== PRODUCT TAGS : END ============================================== -->


                    <!-- ============================================== SPECIAL DEALS ============================================== -->

                    @include('frontend.common.specialdeals_product')
                    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
                        <h3 class="section-title">Newsletters</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <p>Sign Up for Our Newsletter!</p>
                            <form>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Subscribe to our newsletter">
                                </div>
                                <button class="btn btn-primary">Subscribe</button>
                            </form>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                        <div id="advertisement" class="advertisement">
                            <div class="item">
                                <div class="avatar"><img
                                        src="{{ asset('/frontend') }}/assets/images/testimonials/member1.png"
                                        alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img
                                        src="{{ asset('/frontend') }}/assets/images/testimonials/member3.png"
                                        alt="Image"></div>
                                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port
                                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                            </div>
                            <!-- /.item -->

                            <div class="item">
                                <div class="avatar"><img
                                        src="{{ asset('/frontend') }}/assets/images/testimonials/member2.png"
                                        alt="Image"></div>
                                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                    mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                <!-- /.container-fluid -->
                            </div>
                            <!-- /.item -->

                        </div>
                        <!-- /.owl-carousel -->
                    </div>

                    <!-- ============================================== Testimonials: END ============================================== -->
                    @include('frontend.common.testimonial')
                </div>
                <!-- /.sidemenu-holder -->
                <!-- ============================================== SIDEBAR : END ============================================== -->

                <!-- ============================================== CONTENT ============================================== -->
                <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                    <!-- ========================================== SECTION – HERO ========================================= -->
                    @include('frontend.common.slider')

                    <!-- ========================================= SECTION – HERO : END ========================================= -->

                    <!-- ============================================== INFO BOXES ============================================== -->
                    @include('frontend.common.info_box')
                    <!-- ============================================== INFO BOXES : END ============================================== -->
                    <!-- ============================================== SCROLL TABS ============================================== -->
                    @include('frontend.common.product_tab_slider')
                    <!-- ============================================== SCROLL TABS : END ============================================== -->
                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    @include('frontend.common.wide_banner')
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    @include('frontend.common.featured_product')
                    <!-- ============================================== Category  PRODUCTS : END ============================================== -->

                    @include('frontend.common.category_product')

                    <!-- ============================================== WIDE PRODUCTS ============================================== -->
                    <div class="wide-banners wow fadeInUp outer-bottom-xs">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wide-banner cnt-strip">
                                    <div class="image"> <img class="img-responsive"
                                            src="{{ asset('/frontend') }}/assets/images/banners/home-banner.jpg"
                                            alt=""> </div>
                                    <div class="strip strip-text">
                                        <div class="strip-inner">
                                            <h2 class="text-right">New Mens Fashion<br>
                                                <span class="shopping-needs">Save up to 40% off</span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="new-label">
                                        <div class="text">NEW</div>
                                    </div>
                                    <!-- /.new-label -->
                                </div>
                                <!-- /.wide-banner -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.wide-banners -->
                    <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                    <!-- ============================================== BEST SELLER ============================================== -->

                    <div class="best-deal wow fadeInUp outer-bottom-xs">
                        <h3 class="section-title">Best seller</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p20.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p21.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p22.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p23.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p24.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p25.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p26.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> <a href="#"> <img
                                                                        src="{{ asset('/frontend') }}/assets/images/products/p27.jpg"
                                                                        alt=""> </a> </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print
                                                                    Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price">
                                                                    $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== BEST SELLER : END ============================================== -->

                    <!-- ============================================== BLOG SLIDER ============================================== -->
                    <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                        <h3 class="section-title">latest form blog</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/blog-post/post1.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Voluptatem accusantium doloremque
                                                    laudantium</a></h3>
                                            <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut
                                                labore et dolore magnam aliquam quaerat voluptatem.</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/blog-post/post2.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                    nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut
                                                labore et dolore magnam aliquam quaerat voluptatem.</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/blog-post/post1.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                    nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/blog-post/post2.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                    nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image"> <a href="blog.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/blog-post/post1.jpg"
                                                        alt=""></a> </div>
                                        </div>
                                        <!-- /.blog-post-image -->

                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas
                                                    nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit
                                                voluptatem accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a>
                                        </div>
                                        <!-- /.blog-post-info -->

                                    </div>
                                    <!-- /.blog-post -->
                                </div>
                                <!-- /.item -->

                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.blog-slider-container -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== BLOG SLIDER : END ============================================== -->

                    <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                    <section class="section wow fadeInUp new-arriavls">
                        <h3 class="section-title">New Arrivals</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/products/p19.jpg"
                                                        alt=""></a> </div>
                                            <!-- /.image -->

                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span
                                                    class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button"> <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add
                                                            to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                            title="Compare"> <i class="fa fa-signal"
                                                                aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/products/p28.jpg"
                                                        alt=""></a> </div>
                                            <!-- /.image -->

                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span
                                                    class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button"> <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add
                                                            to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                            title="Compare"> <i class="fa fa-signal"
                                                                aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/products/p30.jpg"
                                                        alt=""></a> </div>
                                            <!-- /.image -->

                                            <div class="tag hot"><span>hot</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span
                                                    class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button"> <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add
                                                            to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                            title="Compare"> <i class="fa fa-signal"
                                                                aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/products/p1.jpg"
                                                        alt=""></a> </div>
                                            <!-- /.image -->

                                            <div class="tag hot"><span>hot</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span
                                                    class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button"> <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add
                                                            to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                            title="Compare"> <i class="fa fa-signal"
                                                                aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="{{ asset('/frontend') }}/assets/images/products/p2.jpg"
                                                        alt=""></a> </div>
                                            <!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span
                                                    class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button"> <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add
                                                            to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                            title="Compare"> <i class="fa fa-signal"
                                                                aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="{{ asset('frontend/assets/images/products/p3.jpg') }}"
                                                        alt=""></a> </div>
                                            <!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span
                                                    class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button"> <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add
                                                            to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                            title="Compare"> <i class="fa fa-signal"
                                                                aria-hidden="true"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->
                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <!-- /.section -->
                    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                </div>
                <!-- /.homebanner-holder -->
                <!-- ============================================== CONTENT : END ============================================== -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->

    </div>
@endsection
