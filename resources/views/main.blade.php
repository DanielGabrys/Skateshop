@extends('layouts.index')

@section('center')

<!-- start main content -->
<main class="main-container">

<!-- new collection directory -->
<section id="content-block" class="slider_area">

            <div class="row">

                    <div class="header_slider">
                        <article class="boss_slider">
                            <div class="tp-banner-container">
                                <div class="tp-banner tp-banner0">
                                    <ul>
                                        <!-- SLIDE  -->

                                        @foreach($custom_images as $custom_img)

                                        <li data-link="#" data-target="_self" data-transition="flyin" data-slotamount="7" data-masterspeed="500" data-saveperformance="on">
                                            <!-- MAIN IMAGE --><img src="{{Storage::disk('local')->url('other_images/'.$custom_img->image)}}" alt="slidebg1" data-lazyload={{Storage::disk('local')->url('other_images/'.$custom_img->image)}}" data-bgposition="left center" data-kenburns="off" data-duration="14000" data-ease="Linear.easeNone" data-bgpositionend="right center" />
                                                                                     <!-- LAYER NR. 3 -->
                                            <div class="tp-caption large_white_text randomrotate customout rs-parallaxlevel-0" data-x="355" data-y="363" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="1200" data-end="4800" data-endspeed="300" data-easing="easeInOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> ROLKI </div>
                                        </li>

                                        @endforeach

                                    </ul>
                                    <div class="slideshow_control"></div>
                                </div><!-- /.tp-banner -->
                            </div>



                        </article>
                    </div><!-- /.header_slider -->

                    <div class="clear"></div>




    </div>
</section>
<!-- end new collection directory -->


<!-- Shop Filter
=============================================
<

<section id="shop" class="shop-4 pt-0">
    <div class="container">
        <div class="row">
            <-- Projects Filter
            ============================================= --
            <div class="col-xs-12 col-sm-12 col-md-12 shop-filter">
                <ul class="list-inline">

                    <li>
                        <a href="#" data-filter=".filter-best">TRENDY </a>
                    </li>
                    <li>
                        <a href="#" data-filter=".filter-featured">NOWOŚĆI</a>
                    </li>
                    <li>
                        <a href="#" data-filter=".filter-sale">PROMOCJA</a>
                    </li>
                </ul>
            </div>
            <-- .projects-filter end --
        </div>
        <-- .row end --
        <-- Projects Item
        ============================================= ->
        <div id="shop-all" class="row">
            <-- Product Items (PRODUKTY) --
            @foreach($products as $product)

                @if($loop->index<8)

                    @if($product->is_on_sale==1)
                    <div class="col-xs-12 col-sm-6 col-md-3 product-item filter-sale">
                    @elseif($product->is_new==1)
                    <div class="col-xs-12 col-sm-6 col-md-3 product-item filter-featured">
                    @else
                    <div class="col-xs-12 col-sm-6 col-md-3 product-item">
                    @endif


                        <a href="{{route('ProductView',['id'=>$product->id])}}">

                            @foreach($product->products_images as $images )
                                <div class="product-img">
                                    <img src="{{Storage::disk('local')->url('product_images/'.$images->image)}}"  width="270" height="343" alt="product">

                                        @if($product->is_on_sale==1)
                                        <div class="product-sale">
                                            sale
                                        </div>
                                        @endif


                                        @if($product->is_new==1)
                                        <div class="product-new">
                                            new
                                        </div>
                                        @endif


                                            <div class="product-cart">
                                                <a class="btn btn-secondary btn-block" href="">Do Koszyka</a>
                                            </div>


                                </div>
                            @endforeach
                        </a>



                        <-- .product-img end --
                        <div class="product-bio">

                            <h4>
                                <a href="#">{{$product->name}}</a>
                            </h4>
                            @if($product->is_on_sale==1)
                            <p class="product-price">
                                <span>{{$product->price}}</span>
                                {{$product->sale_price}}
                            </p>
                            @endif

                        </div>
                        -- .product-bio end --
                    </div>


                @endif

            @endforeach

        </div>
        <-- .row end --

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a class="btn btn-secondary" href="#">more products <i class="fa fa-plus ml-xs"></i></a>
            </div>
            <-- .col-md-12 end --
        </div>
        <-- .row End --
    </div>
    <-- .container end --
</section> -->



<!-- Start Our Shop Items -->


<!--new items  -->
<section id="recent-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="recent-items">

                    <!-- Block heading two -->
                    <div class="block-heading-two">
                        <h3><span>NOWE ARTYKUŁY</span></h3>
                    </div>


                    <!-- Owl carousel block starts -->
                    <!-- Change values of data-items, data-auto-play, data-pagination & data-single-item based on your needs -->
                    <div class="owl-carousel" data-items="4" data-auto-play="true" data-pagination="true" data-single-item="false">

                    @foreach($products_new as $product)
                    <!-- Carousel item -->
                        <div class="owl-content">
                            <!-- Product Item #8 -->
                            <div class=" product-item filter-new">
                                <div class="product-img">
                                    @foreach($product->products_images as $images)
                                    <img src="{{Storage::disk('local')->url('product_images/'.$images->image)}}"  width="270" height="343" alt="product">
                                    @endforeach
                                        <div class="product-new">
                                            new
                                        </div>

                                    <div class="product-hover">
                                        <div class="product-cart">
                                        <a class="btn btn-secondary btn-block" href="{{route('ProductView',['id'=>$product->id])}}">SZCZEGÓŁY</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- .product-img end -->
                                <div class="product-bio">
                                    <h4>
                                        <a href="{{route('ProductView',['id'=>$product->id])}}">{{$product->name}}</a>
                                    </h4>
                                    <p class="product-price">

                                    {{$product->price}}</p>
                                </div>
                                <!-- .product-bio end -->

                            </div>
                            <!-- .product-item end -->
                        </div>
                         @endforeach

                    </div>
                    <!-- Owl carousel block ends -->

                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-secondary" href="#">zobacz więcej <i class="fa fa-plus ml-xs"></i></a>
                    </div>

                </div>



            </div>
        </div>
    </div>
</section>


<section id="recent-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="recent-items">

                    <!-- Block heading two -->
                    <div class="block-heading-two">
                        <h3><span>PROMOCJE</span></h3>
                    </div>


                    <div class="owl-carousel" data-items="4" data-auto-play="true" data-pagination="true" data-single-item="false">
                    @foreach($products_sale as $product)

                        <div class="owl-content">
                            <!-- Product Item #8 -->
                            <div class=" product-item filter-best">
                                <div class="product-img">
                                    @foreach($product->products_images as $images)
                                    <img src="{{Storage::disk('local')->url('product_images/'.$images->image)}}"  width="270" height="343" alt="product">
                                    @endforeach
                                        <div class="product-sale">
                                            sale
                                        </div>

                                    <div class="product-hover">
                                        <div class="product-cart">
                                        <a class="btn btn-secondary btn-block" href="{{route('ProductView',['id'=>$product->id])}}">SZCZEGÓŁY</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- .product-img end -->
                                <div class="product-bio">
                                    <h4>
                                        <a href="{{route('ProductView',['id'=>$product->id])}}">{{$product->name}}</a>
                                    </h4>
                                    <p class="product-price">
                                    <span>{{$product->price}}</span>
                                    {{$product->sale_price}}</p>
                                </div>
                                <!-- .product-bio end -->

                            </div>
                            <!-- .product-item end -->
                        </div>
                         @endforeach

                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-secondary" href="#">zobacz więcej <i class="fa fa-plus ml-xs"></i></a>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</section>

<section id="recent-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="recent-items">

                    <!-- Block heading two -->
                    <div class="block-heading-two">
                        <h3><span>ALL</span></h3>
                    </div>


                    <div class="owl-carousel" data-items="4" data-auto-play="true" data-pagination="true" data-single-item="false">
                    @foreach($products as $product)

                        <div class="owl-content">
                            <!-- Product Item #8 -->

                            <div class=" product-item">
                                <div class="product-img">
                                    @foreach($product->products_images as $images)
                                    <img src="{{Storage::disk('local')->url('product_images/'.$images->image)}}"  width="270" height="343" alt="product">
                                    @endforeach
                                        @if($product->is_on_sale==1)
                                            <div class="product-sale">
                                                sale
                                            </div>
                                        @endif

                                        @if($product->is_new==1)
                                            <div class="product-new">
                                                new
                                            </div>
                                        @endif


                                    <div class="product-hover">
                                        <div class="product-cart">
                                            <a class="btn btn-secondary btn-block" href="{{route('ProductView',['id'=>$product->id])}}">SZCZEGÓŁY</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- .product-img end -->
                                <div class="product-bio">
                                    <h4>
                                        <a href="{{route('ProductView',['id'=>$product->id])}}">{{$product->name}}</a>
                                    </h4>
                                    <p class="product-price">
                                    @if($product->is_on_sale==1)
                                        <span>{{$product->price}}</span>
                                        {{$product->sale_price}}</p>
                                    @elseif($product->is_new==1)
                                         {{$product->price}}
                                    @else
                                    @endif
                                </div>
                                <!-- .product-bio end -->

                            </div>
                            <!-- .product-item end -->
                        </div>
                         @endforeach

                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-secondary" href="#">zobacz więcej <i class="fa fa-plus ml-xs"></i></a>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</section>





<div class="bt-block-home-parallax" style="background-image: url(public/images/block_parallax.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="lookbook-product">
                    <h2><a href="#" title="">Collection 2016 </a></h2>
                    <ul class="simple-cat-style">
                        <li><a href="#" title="">Dresses</a></li>
                        <li><a href="#" title="">Coats & Jackets</a></li>
                        <li><a href="#" title="">Jeans</a></li>
                    </ul>
                    <a href="#" title="">read more</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.bt-block-home-parallax -->

<!-- Start Our Clients -->

<section id="Clients" class="light-wrapper">
    <div class="container inner">
        <div class="row">
            <div class="Last-items-shop col-md-3">

                <!-- Block heading two -->
                <div class="block-heading-two block-heading-three">
                    <h3><span>Special Offer</span></h3>
                </div>
                <!--<div class="Top-Title-SideBar">
                    <h3>Special Offer</h3>
                </div>-->
                <div class="Last-post">
                    <ul class="shop-res-items">
                        <li>
                            <a href="#"><img src="{{asset('images/small/50.jpg')}}" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$28.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="images/small/51.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$40.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="img/small/52.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$150.00</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="Last-items-shop col-md-3">
                <!-- Block heading two -->
                <div class="block-heading-two block-heading-three">
                    <h3><span>Best Sellers</span></h3>
                </div>
                <!--<div class="Top-Title-SideBar">
                    <h3>Best Sellers</h3>
                </div>-->
                <div class="Last-post">
                    <ul class="shop-res-items">
                        <li>
                            <a href="#"><img src="img/small/53.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$28.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="img/small/54.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$40.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="img/small/55.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$150.00</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="Last-items-shop col-md-3">
                <!-- Block heading two -->
                <div class="block-heading-two block-heading-three">
                    <h3><span>NOWE</span></h3>
                </div>
                <!--<div class="Top-Title-SideBar">
                    <h3>Featured</h3>
                </div>-->
                <div class="Last-post">
                    <ul class="shop-res-items">
                        <li>
                            <a href="#"><img src="img/small/56.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$28.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="img/small/57.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$40.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="img/small/55.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$150.00</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="Last-items-shop col-md-3">
                <!-- Block heading two -->
                <div class="block-heading-two block-heading-three">
                    <h3><span>Sales</span></h3>
                </div>
                <!--<div class="Top-Title-SideBar">
                    <h3>Sales</h3>
                </div>-->
                <div class="Last-post">
                    <ul class="shop-res-items">
                        <li>
                            <a href="#"><img src="img/small/55.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$28.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="img/small/58.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$40.00</span>
                        </li>
                        <li>
                            <a href="#"><img src="img/small/50.jpg" alt=""></a>
                            <h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
                            <span class="sale-date">$150.00</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- End Our Clients  -->


<section class="block gray no-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box no-margin go-simple">
                    <div class="mini-service-sec">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mini-service">
                                    <i  class="fa fa-paper-plane"></i>
                                    <div class="mini-service-info">
                                        <h3>Worldwide Delivery</h3>
                                        <p>unc tincidunt, on cursusau gmetus, lorem Hore</p>
                                    </div>
                                </div><!-- Mini Service -->
                            </div>
                            <div class="col-md-3">
                                <div class="mini-service">
                                    <i  class="fa  fa-newspaper-o"></i>
                                    <div class="mini-service-info">
                                        <h3>Worldwide Delivery</h3>
                                        <p>unc tincidunt, on cursusa ugmetus, lorem Hore</p>
                                    </div>
                                </div><!-- Mini Service -->
                            </div>
                            <div class="col-md-3">
                                <div class="mini-service">
                                    <i  class="fa fa-medkit"></i>
                                    <div class="mini-service-info">
                                        <h3>Friendly Stuff</h3>
                                        <p>unc tincidunt, on cursusau gmetus, lorem Hore</p>
                                    </div>
                                </div><!-- Mini Service -->
                            </div>
                            <div class="col-md-3">
                                <div class="mini-service">
                                    <i  class="fa  fa-newspaper-o"></i>
                                    <div class="mini-service-info">
                                        <h3>24/h Support</h3>
                                        <p>unc tincidunt, on cursusa ugmetus, lorem Hore</p>
                                    </div>
                                </div><!-- Mini Service -->
                            </div>
                        </div>
                    </div><!-- Mini Service Sec -->
                </div>
            </div>
        </div>
    </div>
</section>
</main>

@endsection
