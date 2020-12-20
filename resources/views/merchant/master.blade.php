<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <title>Andbaazar Merchant Panel</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/fontawesome.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick-theme.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/animate.css">

    <!-- date picker -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/datepicker.min.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/color1.css" media="screen" id="color">

    <link rel="stylesheet" type="text/css" href="/css/custom.css">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">


    <!-- <link rel="stylesheet" type="text/css" href="{{asset('/css/summernote.min.css')}}"> -->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    @stack('css')
    <style>
        .onhover-dropdown .onhover-show-div {
            top: 90px;
            background-color: #fff;
        }
    </style>

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
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo"><a href="/"><img src="/frontend/assets/images/icon/logo.png" class="img-fluid blur-up lazyload" alt=""></a></div>
                        </div>
                        <div class="menu-right pull-right">
                            <div>
                                <div class="icon-nav">
                                    <ul>
                                        <li class="onhover-div mobile-setting">
                                            <div>
{{--                                                <img src="../assets/images/icon/setting.png"--}}
{{--                                                      class="img-fluid blur-up lazyload" alt=""> <i--}}
{{--                                                    class="ti-settings"></i>--}}
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                My Account
                                            </div>
                                            <div class="show-div setting">
                                                <ul>
                                                    <li class=""><a href="/profile" data-lng="es">My Profile</a></li>
                                                    <li><a href="{{url('logout')}}" data-lng="es">Logout</a></li>
                                                </ul>
                                            </div>
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


    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>vendor dashboard</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">vendor dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->




  @yield('content')
    <!-- footer start -->
    <footer class="footer-light">
        <section class="section-b-space light-layout">
            <div class="container">
                <div class="row footer-theme partition-f">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-title footer-mobile-title">
                            <h4>about</h4>
                        </div>
                        <div class="footer-contant">
                            <div class="footer-logo"><img src="/frontend/assets/images/icon/logo.png" alt=""></div>
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
                                    <li><i class="fa fa-envelope-o"></i>Email Us: Support@Fiot.com</li>
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
                                <li><a href="#"><img src="/frontend/assets/images/icon/visa.png" alt=""></a></li>
                                <li><a href="#"><img src="/frontend/assets/images/icon/mastercard.png" alt=""></a></li>
                                <li><a href="#"><img src="/frontend/assets/images/icon/paypal.png" alt=""></a></li>
                                <li><a href="#"><img src="/frontend/assets/images/icon/american-express.png" alt=""></a></li>
                                <li><a href="#"><img src="/frontend/assets/images/icon/discover.png" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->


    <!-- tap to top -->
    <div class="tap-top">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top End -->

    <!-- latest jquery-->
    <script src="{{asset('frontend')}}/assets/js/jquery-3.3.1.min.js"></script>

    <!-- menu js-->
    <script src="{{asset('frontend')}}/assets/js/menu.js"></script>

    <!-- lazyload js-->
    <script src="{{asset('frontend')}}/assets/js/lazysizes.min.js"></script>

    <!-- popper js-->
    <script src="{{asset('frontend')}}/assets/js/popper.min.js"></script>

    <!-- slick js-->
    <script src="{{asset('frontend')}}/assets/js/slick.js"></script>

    <!-- dare picker js -->
    <script src="{{asset('frontend')}}/assets/js/date-picker.js"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('frontend')}}/assets/js/bootstrap.js"></script>



    <!-- Bootstrap Notification js-->
    <script src="{{asset('frontend')}}/assets/js/bootstrap-notify.min.js"></script>

    <!-- Theme js-->
    <script src="{{asset('frontend')}}/assets/js/script.js"></script>

    <!-- Summernote js-->

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <script src="{{ asset('/js/summernote.min.js') }}"></script>


    <script src="{{asset('/')}}js/validator.js"></script>

    <script src="{{asset('/')}}js/validatorRules.js"></script>

    @include('elements.myjs')
    @stack('js')
    <script>
        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4'
        });
        setTimeout(function(){
            $('body').removeAttr('style');
        },3000);
    </script>

</body>

</html>
