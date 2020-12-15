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
    <title>Andbaazar Agent Panel</title>

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

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}/css/custom.css">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

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
        <div class="top-header py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-contact">
                           <h3 class="display-5 font-weight-bold">Wellcome To Vendor Panel</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <ul class="header-dropdown">
                            <li class="mobile-wishlist"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                            </li>
                            <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i>
                                My Account
                                <ul class="onhover-show-div">
                                    @if( Auth::check())
                                    <li class=""><a href="{{ url('/dashboard') }}">My Dashboard</a></li>
                                    <li class=""><a href="{{ url('profile/') }}" data-lng="es">My Profile</a></li>
                                    <li class=""><a href="{{ url('profile/shipping') }}" data-lng="es">My Shippin Address</a></li>
                                    <li class=""><a href="{{ url('profile/billing') }}" data-lng="es">My Billing Address</a></li>
                                    <li class=""><a href="{{ url('profile/card') }}" data-lng="es">My Card</a></li>
                                    <li><a href="{{url('logout')}}" data-lng="es">Logout</a></li>
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
    </header>
    <!-- header end -->




  @yield('content')



    <!-- footer -->
    <footer class="footer-light">

        <section class="section-b-space light-layout">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="footer-end">
                            <p><i class="fa fa-copyright" aria-hidden="true"></i> 2017-18 themeforest powered by
                                pixelstrap</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 text-right" style="letter-spacing: 5px">
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
        </section>
        {{-- <div class="sub-footer">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </div> --}}
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
