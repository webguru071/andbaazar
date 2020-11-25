<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <title>Andbaazar</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/font-awesome.min.css"> -->

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick.css">

    
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick-theme.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/color1.css" media="screen" id="color">

    <!-- Croppie css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/croppie.css>


   <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/css-loader/3.3.3/css-loader.css">
    
    
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/preloader.min.css> -->

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}/css/custom.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    @stack('css')
</head>
<body>
    <div class="loader_skeleton">
        <!--CSS Spinner-->
        <div class="spinner-wrapper">
            <img src="{{asset('preloader.gif')}}" alt="preloader" width="300">
        </div>
    </div>


    <!-- header start -->
    <header>
        <div class="mobile-fix-option"></div>
        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-contact">
                            <ul>
                                <li>Welcome to  Andbaazar</li>
                                <li><i class="fa fa-phone" aria-hidden="true"></i>Call Us: 041 - 722 - 684</li>
                                <li><a href="{{url('sell-on-andbaazar')}}" style="color: #999999;font-size: 14px; padding-right: 25px;">Start Selling Here</a></li>
                                <li><a href="{{url('become-an-agent')}}" style="color: #999999;font-size: 14px; padding-right: 25px;">Become an Agent</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 text-right">
                        <ul class="header-dropdown">
                            <li class="mobile-wishlist"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </li>
                            <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i>
                                My Account
                                <ul class="onhover-show-div">
                                    @if( Sentinel::getUser())
                                    <li class=""><a href="{{ url('/dashboard') }}">My Dashboard</a></li>
                                    <li class=""><a href="{{ url('profile/') }}" data-lng="es">My Profile</a></li>
                                    <li class=""><a href="{{ url('profile/shipping') }}" data-lng="es">My Shippin Address</a></li>
                                    <li class=""><a href="{{ url('profile/billing') }}" data-lng="es">My Billing Address</a></li>
                                    <li class=""><a href="{{ url('profile/card') }}" data-lng="es">My Card</a></li>
                                    {{-- <li><a href="{{url('logout')}}" data-lng="es">Logout</a></li> --}}
                                    @else
                                    <li><a href="{{url('login')}}" data-lng="en">SIGN IN</a></li>
                                    <li><a href="{{url('register')}}" data-lng="en">SIGN UP</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="navbar">
                                <a href="javascript:void(0)" onclick="openNav()">
                                    <div class="bar-style">
                                    </div>
                                </a>
                              
                            </div>
                            <div class="brand-logo">
                                <a href="{{url('/')}}"><img src="{{asset('frontend')}}/assets/images/icon/logo.png"
                                        class="img-fluid blur-up lazyload" alt=""></a>
                            </div>
                        </div>
                        <div class="menu-right pull-right">
                            <div>
                                <nav id="main-nav">
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                        <li>
                                            <div class="mobile-back text-right">Back<i class="fa fa-angle-right pl-2"
                                                    aria-hidden="true"></i></div>
                                        </li>
                                        <li>
                                            <a href="{{url('/')}}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{url('/about-us')}}">About</a>
                                        </li>
                                        <li class="mega" id="hover-cls"><a href="{{url('/products')}}">Product
                                        </a>
                                        <ul class="mega-menu full-mega-menu">
                                            <li>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>women's fashion</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="{{url('/products/dress')}}">dresses</a></li>
                                                                        <li><a href="{{url('/products/skirts')}}">skirts</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">westarn wear</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">ethic wear</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">sport wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>men's fashion</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="{{url('/products/dress')}}">sport shoes</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">formal shoes</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">casual shoes</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>footwear</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="{{url('/products/dress')}}">sports wear</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">western wear</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">ethic wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>Bags</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="{{url('/products/dress')}}">shopper bags</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">laptop bags</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">clutches</a></li>
                                                                        <li> <a href="{{url('/products/dress')}}">purses</a>
                                                                            <ul>
                                                                                <li><a href="{{url('/products/dress')}}">purses</a></li>
                                                                                <li><a href="{{url('/products/dress')}}">wallets</a></li>
                                                                                <li><a href="{{url('/products/dress')}}">leathers</a></li>
                                                                                <li><a href="{{url('/products/dress')}}">satchels</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mega-box">
                                                            <div class="link-section">
                                                                <div class="menu-title">
                                                                    <h5>accessories</h5>
                                                                </div>
                                                                <div class="menu-content">
                                                                    <ul>
                                                                        <li><a href="{{url('/products/dress')}}">fashion jewellery</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">caps and hats</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">precious jewellery</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">necklaces</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">earrings</a></li>
                                                                        <li><a href="{{url('/products/dress')}}">wrist wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                        <li>
                                            <a href="{{url('/blog')}}">blog</a>
                                        </li>
                                        <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
                                            <li>
                                                <a href="{{url('/up-coming')}}">Upcoming</a>
                                                <div class="lable-nav">new</div>
                                                <ul>
                                                    <li>
                                                        <a href="{{url('/up-coming')}}">Electronics</a>
                                                        <ul>
                                                            <li><a href="{{url('/up-coming/mobile')}}">Mobile</a></li>
                                                            <li><a href="product-page(right-sidebar).html">Watches</a>
                                                            </li>
                                                            <li><a href="product-page(no-sidebar).html">Freeze</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="product-page(4-image).html">Television<span
                                                                class="new-tag">new</span></a></li>
                                                    <li><a href="product-page(vertical-tab).html">Tab</a></li>
                                                </ul>
                                            </li>
                                    </ul>
                                </nav>
                            </div>
                            <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-search">
                                        <div><img src="{{asset('frontend')}}/assets/images/icon/search.png" onclick="openSearch()"
                                                class="img-fluid blur-up lazyload" alt=""> <i class="ti-search"
                                                onclick="openSearch()"></i></div>
                                        <div id="search-overlay" class="search-overlay">
                                            <div> <span class="closebtn" onclick="closeSearch()"
                                                    title="Close Overlay">×</span>
                                                <div class="overlay-content">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <form>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputPassword1"
                                                                            placeholder="Search a Product">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-search"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-setting">
                                        <div><img src="{{asset('frontend')}}/assets/images/icon/setting.png"
                                                class="img-fluid blur-up lazyload" alt=""> <i
                                                class="ti-settings"></i></div>
                                        <div class="show-div setting">
                                            <h6>language</h6>
                                            <ul>
                                                <li><a href="#">english</a></li>
                                                <li><a href="#">french</a></li>
                                            </ul>
                                            <h6>currency</h6>
                                            <ul class="list-inline">
                                                <li><a href="#">euro</a></li>
                                                <li><a href="#">rupees</a></li>
                                                <li><a href="#">pound</a></li>
                                                <li><a href="#">doller</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="onhover-div mobile-cart">
                                        <div><img src="{{asset('frontend')}}/assets/images/icon/cart.png"
                                                class="img-fluid blur-up lazyload" alt=""> <i
                                                class="ti-shopping-cart"></i></div>
                                        <ul class="show-div shopping-cart">
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img alt="" class="mr-3"
                                                            src="{{asset('frontend')}}/assets/images/fashion/product/1.jpg"></a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4>item name</h4>
                                                        </a>
                                                        <h4><span>1 x $ 299.00</span></h4>
                                                    </div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                            aria-hidden="true"></i></a></div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="#"><img alt="" class="mr-3"
                                                            src="{{asset('frontend')}}/assets/images/fashion/product/2.jpg"></a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4>item name</h4>
                                                        </a>
                                                        <h4><span>1 x $ 299.00</span></h4>
                                                    </div>
                                                </div>
                                                <div class="close-circle"><a href="#"><i class="fa fa-times"
                                                            aria-hidden="true"></i></a></div>
                                            </li>
                                            <li>
                                                <div class="total">
                                                    <h5>subtotal : <span>$299.00</span></h5>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="buttons"><a href="cart.html" class="view-cart">view
                                                        cart</a> <a href="#" class="checkout">checkout</a></div>
                                            </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->


    @yield('content')

    <!-- footer -->
    <footer class="footer-light">
        <div class="light-layout">
            <div class="container">
                <section class="small-section border-section border-top-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="subscribe">
                                <div>
                                    <h4>KNOW IT ALL FIRST!</h4>
                                    <p>Never Miss Anything From Multikart By Signing Up To Our Newsletter.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form
                                action="https://pixelstrap.us19.list-manage.com/subscribe/post?u=5a128856334b598b395f1fc9b&amp;id=082f74cbda"
                                class="form-inline subscribe-form auth-form needs-validation" method="post"
                                id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
                                <div class="form-group mx-sm-3">
                                    <input type="text" class="form-control" name="EMAIL" id="mce-EMAIL"
                                        placeholder="Enter your email" required="required">
                                </div>
                                <button type="submit" class="btn btn-solid" id="mc-submit">subscribe</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <section class="section-b-space light-layout">
            <div class="container">
                <div class="row footer-theme partition-f">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-title footer-mobile-title">
                            <h4>about</h4>
                        </div>
                        <div class="footer-contant">
                            <a href="{{url('/')}}"><img src="{{asset('frontend')}}/assets/images/icon/logo.png"
                                class="img-fluid blur-up lazyload" alt=""></a>                       
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col offset-xl-1">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>my account</h4>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li><a href="{{url('merchant/login')}}">merchant login</a></li>
                                    <li><a href="#">mens</a></li>
                                    <li><a href="#">womens</a></li>
                                    <li><a href="#">clothing</a></li>
                                    <li><a href="#">accessories</a></li>
                                    <li><a href="#">featured</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>why we choose</h4>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li><a href="#">shipping & return</a></li>
                                    <li><a href="#">secure shopping</a></li>
                                    <li><a href="#">gallary</a></li>
                                    <li><a href="#">affiliates</a></li>
                                    <li><a href="#">contacts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>store information</h4>
                            </div>
                            <div class="footer-contant">
                                <ul class="contact-list">
                                    <li><i class="fa fa-map-marker"></i>Multikart Demo Store, Demo store India 345-659
                                    </li>
                                    <li><i class="fa fa-phone"></i>Call Us: 123-456-7898</li>
                                    <li><i class="fa fa-envelope-o"></i>Email Us: <a href="#">Support@Fiot.com</a></li>
                                    <li><i class="fa fa-fax"></i>Fax: 123456</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="footer-end">
                            <p><i class="fa fa-copyright" aria-hidden="true"></i> 2017-18 themeforest powered by
                                pixelstrap</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="payment-card-bottom">
                            <ul>
                                <li>
                                    <a href="#"><img src="{{asset('frontend')}}/assets/images/icon/visa.png" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('frontend')}}/assets/images/icon/mastercard.png" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('frontend')}}/assets/images/icon/paypal.png" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('frontend')}}/assets/images/icon/american-express.png" alt=""></a>
                                </li>
                                <li>
                                    <a href="#"><img src="{{asset('frontend')}}/assets/images/icon/discover.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- theme setting -->

    <!-- exit modal popup start-->
    <div class="modal fade bd-example-modal-lg theme-modal exit-modal" id="exit_popup" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal1">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="modal-bg">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="media">
                                        <img src="{{asset('frontend')}}/assets/images/stop.png"
                                            class="stop img-fluid blur-up lazyload mr-3" alt="">
                                        <div class="media-body text-left align-self-center">
                                            <div>
                                                <h2>wait!</h2>
                                                <h4>We want to give you
                                                    <b>10% discount</b>
                                                    <span>for your first order</span>
                                                </h4>
                                                <h5>Use discount code at checkout</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add to cart modal popup end-->

    <!-- facebook chat section start -->
    <div id="fb-root"></div>
    <div class="fb-customerchat" attribution=setup_tool page_id="2123438804574660" theme_color="#0084ff"
        logged_in_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?"
        logged_out_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?">
    </div>
    <!-- facebook chat section end -->
    <!-- tap to top -->
    <div class="tap-top top-cls">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top end -->

    <!-- latest jquery-->
    <script src="{{asset('frontend')}}/assets/js/jquery-3.3.1.min.js"></script>

    <!-- croppie jquery-->
    <script src="{{asset('frontend')}}/assets/js/croppie.min.js"></script>

    <!-- fly cart ui jquery-->
    <script src="{{asset('frontend')}}/assets/js/jquery-ui.min.js"></script>

    <!-- exitintent jquery-->
    <script src="{{asset('frontend')}}/assets/js/jquery.exitintent.js"></script>

    <script src="{{asset('frontend')}}/assets/js/exit.js"></script>

    <!-- popper js-->
    <script src="{{asset('frontend')}}/assets/js/popper.min.js"></script>

    <!-- slick js-->
    <script src="{{asset('frontend')}}/assets/js/slick.js"></script>

    <!-- menu js-->
    <script src="{{asset('frontend')}}/assets/js/menu.js"></script>

    <!-- lazyload js-->
    <script src="{{asset('frontend')}}/assets/js/lazysizes.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('frontend')}}/assets/js/bootstrap.js"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{asset('frontend')}}/assets/js/bootstrap-notify.min.js"></script>

    <!-- Fly cart js-->
    <script src="{{asset('frontend')}}/assets/js/fly-cart.js"></script>

   <script  scr ="https://cdnjs.cloudflare.com/ajax/libs/PreloadJS/1.0.1/preloadjs.min.js" ></script>

   <!-- <script src="{{asset('frontend')}}/assets/js/preloader.min.js"></script> -->

    <!-- Theme js-->
    

    @include('elements.myjs')
    <script>   
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
    </script>
    @stack('js')
</body>
</html>
