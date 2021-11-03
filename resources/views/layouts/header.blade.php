<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <title> Skateshop </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fav icon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,900,700,700italic,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700%7CDancing+Script%7CMontserrat:400,700%7CMerriweather:400,300italic%7CLato:400,700,900' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Cantata+One' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700' rel='stylesheet' type='text/css'>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Magnific Popup -->
    <link href="{{asset('css/magnific-popup.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/skin-lblue.css')}}">

    <link rel="stylesheet" href="{{asset('css/ecommerce.css')}}">

    <!-- Owl carousel -->
    <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/revolutionslider_settings.css')}}" media="screen" />
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <script src="{{asset('js/vendor/modernizr-2.6.2.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" />
    <!--lightbox stylesheet-->
    <link rel="stylesheet" href="{{asset('css/image-light-box.css')}}" />

    <link rel="stylesheet" href="{{asset('css/setting.css')}}">






</head>

<body class="style-14 index-2">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Start Loading -->
<!--<section class="loading-overlay">
    <div class="Loading-Page">
        <h1 class="loader">Loading...</h1>
    </div>
</section>-->
<!-- End Loading  -->

<!-- start header -->
<header>
    <!-- Top bar starts -->
    <div class="top-bar">
        <div class="container">

            <!-- Contact starts -->
            <div class="tb-contact pull-left">
                <!-- Email -->
                <i class="fa fa-envelope color"></i> &nbsp; <a href="mailto:contact@domain.com">contact@domain.com</a>
                &nbsp;&nbsp;
                <!-- Phone -->
                <i class="fa fa-phone color"></i> &nbsp; +1 (342)-(323)-4923
            </div>
            <!-- Contact ends -->

            <!-- Shopping kart starts -->
            <div class="tb-shopping-cart pull-right">
                <!-- Link with badge -->
                <a class="btn btn-white btn-xs b-dropdown">
                    <i class="fa fa-shopping-cart"></i>
                    <i class="fa fa-angle-down color"></i>
                    </a>
                <!-- Dropdown content with item details -->
                <div class="b-dropdown-block">
                    <!-- Heading -->
                    <h4><i class="fa fa-shopping-cart color"></i> Koszyk</h4>
                    <ul class="list-unstyled">
                        <!-- Items -->
                        @if($cart)
                        @foreach($cart->items as $item)
                            <li>
                                <!-- Item image -->
                                <div class="cart-img">
                                    <a href="{{route('ProductView',['id'=>$item['data']['id']])}}"><img src="{{Storage::disk('local')->url('product_images/'.$item['image'])}}" alt="" class="img-responsive" /></a>
                                </div>
                                <!-- Item heading and price -->
                                <div class="cart-title">
                                    <h5><a href="{{route('ProductView',['id'=>$item['data']['id']])}}">{{$item['data']['name'].' '.$item['quantity'].'x'}}</a></h5>
                                    <!-- Item price -->
                                    <span class="label label-color label-sm">{{$item['data']['price'].' '.'/szt.'}}</span>

                                </div>
                                <div class="clearfix"></div>
                            </li>
                        @endforeach
                        @endif

                    </ul>
                    <a href="{{route('cartproducts')}}" class="btn btn-white btn-sm">Koszyk</a> &nbsp; <a href="#" class="btn btn-color btn-sm">Zamów</a>
                </div>
                <a href="{{route('cartproducts')}}" class="btn btn-white btn-xs">
                    @if($cart)
                        <span class="badge badge-color">{{$cart->totalPrice.' zł'}}</span>
                    @else
                        <span class="badge badge-color">0</span>
                    @endif
                </a>
            </div>
            <!-- Shopping kart ends -->

            <!-- Langauge starts -->
            <div class="tb-language dropdown pull-right">
                <a href="#" data-target="#" data-toggle="dropdown"><i class="fa fa-globe"></i> English <i class="fa fa-angle-down color"></i></a>
                <!-- Dropdown menu with languages -->
                <ul class="dropdown-menu dropdown-mini" role="menu">
                    <li><a href="#">Germany</a></li>
                    <li><a href="#">France</a></li>
                    <li><a href="#">Brazil</a></li>
                </ul>
            </div>
            <!-- Language ends -->

            <!-- Search section for responsive design -->
            <div class="tb-search pull-left">
                <a href="#" class="b-dropdown"><i class="fa fa-search square-2 rounded-1 bg-color white"></i></a>
                <div class="b-dropdown-block">
                    <form>
                        <!-- Input Group -->
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Type Something">
                            <span class="input-group-btn">
										<button class="btn btn-color" type="button">Search</button>
									</span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Search section ends -->

            <!-- Social media starts -->
            <div class="tb-social pull-right">
                <div class="brand-bg text-right">
                    <!-- Brand Icons -->
                    <a href="#" class="facebook"><i class="fa fa-facebook square-2 rounded-1"></i></a>
                    <a href="#" class="twitter"><i class="fa fa-twitter square-2 rounded-1"></i></a>
                    <a href="#" class="google-plus"><i class="fa fa-google-plus square-2 rounded-1"></i></a>
                </div>
            </div>
            <!-- Social media ends -->

            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Top bar ends -->

    <!-- Header One Starts -->
    <div class="header-1">

        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <!-- Logo section -->
                    <div class="logo">
                        <h1><a href="{{route('main')}}"><i class="fa fa-bookmark-o"></i> SKATESHOP</a></h1>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-2 col-sm-5 col-sm-offset-3 hidden-xs">
                    <!-- Search Form -->
                    <div class="header-search">
                        <form>
                            <!-- Input Group -->
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type Something">
                                <span class="input-group-btn">
											<button class="btn btn-color" type="button">Search</button>
										</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation starts -->

        <div class="navi">
            <div class="container">
                <div class="navy">
                    <ul>
                        @foreach($categories as $category)

                                <li><a href="single-product.html"><span>{{$categories[$loop->index]['category']}}</span></a>

                                @if(!$loop->last)

                                    @if($categories[$loop->index+1]['level']>$categories[$loop->index]['level'])

                                            <ul>
                                    @endif


                                    @if($categories[$loop->index+1]['level']==$categories[$loop->index]['level'])

                                            </li>
                                    @endif


                                    @if($categories[$loop->index+1]['level']<$categories[$loop->index]['level'])

                                        @for($j=$categories[$loop->index]['level'];$j>$categories[$loop->index+1]['level'];$j--)

                                            </ul>
                                         </li>
                                        @endfor

                                    @endif

                                    @if($categories[$loop->index+1]['level']==0 && $categories[$loop->index]['level']==0)
                                        </li>
                                    @endif

                                @else

                                    @for($j=$categories[($loop->index)]['level'];$j>0;$j--)
                                        </ul>
                                        </li>
                                    @endfor

                                @endif


                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

        <!-- Navigation ends -->

    </div>

    <!-- Header one ends -->

</header>
<!-- end header -->

















































