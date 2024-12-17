<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
            @php
                $brands = \App\Models\Brand::all();
            @endphp

            @foreach ($brands as $brand)
                <div class="item m-t-15"> <a href="#" class="image"> <img
                            data-echo="{{ Storage::url($brand->brand_image) }}"
                            src="{{ Storage::url($brand->brand_image) }}" alt=""> </a>
                </div>
                <!--/.item-->
            @endforeach
            <!--/.item-->
        </div>
        <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

</div>
