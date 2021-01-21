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
      <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/croppie.css">
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/css-loader/3.3.3/css-loader.css">
      <!-- <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/preloader.min.css> -->
      <link rel="stylesheet" type="text/css" href="/css/custom.css">
      <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
      @stack('css')
   </head>
   <body>
{{--      <header id="header-area">--}}
{{--         <div class="container">--}}
{{--            <div class="row     align-items-center">--}}
{{--               <div class="col-lg-6">--}}
{{--                  <div class="sell-logo">--}}
{{--                     <img src="/images/logo.png" alt="img">--}}
{{--                  </div>--}}
{{--               </div>--}}
{{--               <div class="col-lg-6">--}}
{{--                  <div class="sell-link-top">--}}
{{--                     <i class="fa fa-phone" aria-hidden="true"></i>--}}
{{--                     <a href="tel:+৮৮-০৯৬৩৮০০০৭৭৭">+৮৮-০৯৬৩৮০০০৭৭৭</a>--}}
{{--                  </div>--}}
{{--               </div>--}}
{{--            </div>--}}
{{--         </div>--}}
{{--      </header>--}}
      <!-- Banner Area Start -->
      <section id="sell_on_andbaazar_banner">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="seller-center-wrap">
                    <h2 class="text-uppercase">Welcome to seller center</h2>

                    <div class="selling-steps-wrap">
                        <h4>5 Simple Steps to Sell on Andbaazar</h4>
                        <div class="selling-steps d-flex">
                            <div class="step-box">
                                <img src="/images/login.png" alt="login">
                                <div class="step-content d-flex align-center"><span>1</span><p>রেজিস্ট্রেশন করুন</p></div>
                            </div>
                            <div class="step-box">
                                <img src="/images/login.png" alt="login">
                                <div class="step-content d-flex align-center"><span>1</span><p>পণ্য লিস্টিং করুন</p></div>
                            </div>
                            <div class="step-box">
                                <img src="/images/login.png" alt="login">
                                <div class="step-content d-flex align-center"><span>1</span><p>অর্ডার গ্রহন করুন</p></div>
                            </div>
                            <div class="step-box">
                                <img src="/images/login.png" alt="login">
                                <div class="step-content d-flex align-center"><span>1</span><p>রপণ্য ডেলিভারী করুন</p></div>
                            </div>
                            <div class="step-box">
                                <img src="/images/login.png" alt="login">
                                <div class="step-content d-flex align-center"><span>1</span><p>মূল্য গ্রহন করুন</p></div>
                            </div>
                        </div>
                    </div>

                    <div class="seller-features">
                        <span><img src="/images/pencil.png" alt="icon">Store Builder</span>
                        <span><img src="/images/pencil.png" alt="icon">Voucher + Bundles</span>
                        <span><img src="/images/pencil.png" alt="icon">Campaigns</span>
                    </div>
                </div>
            </div>

             <div class="col-12 col-md-4">

                 <div class="sell-register-from">
                     <div class="sell-register-form-inner">
                         @if(session('flash_notification'))
                             <div class="flash-message">
                                 @include('flash::message')
                             </div>
                         @endif
                         <form action="{{route('sellOnAndbaazarPost')}}" id="reg-from-area" class="form" method="post">

                             <h3>Register</h3>

                             @csrf
                             <div class="row">
                                 <div class="col">
                                     <input type="text" value="{{old('first_name')}}" class="form-control" name="first_name" placeholder="First name" required>
                                     <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                 </div>
                                 <div class="col">
                                     <input type="text" value="{{old('last_name')}}" class="form-control" name="last_name" placeholder="Last name" required>
                                     <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                 </div>
                             </div>
                             <div class="form-group mt-3">
                                 <div class="input-group">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text">+88</span>
                                     </div>
                                     <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="01XX-XXXXXX" id="PhoneNumberInput" autocomplete="off" required>
                                 </div>
                                 <span class="text-danger">{{ $errors->first('phone') }}</span>
                             </div>
                             <div class="form-group">
                                 <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="your email (optional)">
                                 <span class="text-danger">{{ $errors->first('email') }}</span>
                             </div>
                             <div class="form-group">
                                 <input type="password" name="password" class="form-control" placeholder="your password" required>
                                 <span class="text-danger">{{ $errors->first('password') }}</span>
                             </div>
                             <div class="reg-form-button mb-2">
                                 <button class="">Create account</button>
                             </div>
                             <a href="/login">Already have an account</a>
                         </form>
                     </div>
                 </div>
             </div>

         </div>
      </div>
      </section>
      <!-- Banner Area End -->


{{--    Test Test--}}

{{--<div class="col-lg-12 text-center">--}}
{{--    <div class="time-line-area">--}}
{{--        <ul>--}}
{{--            <li>--}}
{{--                <div class="time-line-items">--}}
{{--                    <div class="arrows">--}}
{{--                        <i class="fa fa-angle-right " aria-hidden="true"></i>--}}
{{--                    </div>--}}
{{--                    <div class="inners-text">--}}
{{--                        <i class="fa fa-edit" aria-hidden="true"></i>--}}
{{--                        <p>রেজিস্ট্রেশন করুন</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="time-line-items">--}}
{{--                    <div class="arrows">--}}
{{--                        <i class="fa fa-angle-right " aria-hidden="true"></i>--}}
{{--                    </div>--}}
{{--                    <div class="inners-text">--}}
{{--                        <i class="fa fa-th-list" aria-hidden="true"></i>--}}
{{--                        <p>পণ্য লিস্টিং করুন</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="time-line-items">--}}
{{--                    <div class="arrows">--}}
{{--                        <i class="fa fa-angle-right " aria-hidden="true"></i>--}}
{{--                    </div>--}}
{{--                    <div class="inners-text">--}}
{{--                        <i class="fa fa-address-book-o" aria-hidden="true"></i>--}}
{{--                        <p>অর্ডার গ্রহন করুন</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="time-line-items">--}}
{{--                    <div class="arrows">--}}
{{--                        <i class="fa fa-angle-right " aria-hidden="true"></i>--}}
{{--                    </div>--}}
{{--                    <div class="inners-text">--}}
{{--                        <i class="fa fa-address-book-o" aria-hidden="true"></i>--}}
{{--                        <p>পণ্য ডেলিভারী করুন</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="time-line-items">--}}
{{--                    <div class="arrows">--}}
{{--                        <i class="fa fa-angle-right " aria-hidden="true"></i>--}}
{{--                    </div>--}}
{{--                    <div class="inners-text">--}}
{{--                        <i class="fa fa-address-book-o" aria-hidden="true"></i>--}}
{{--                        <p>মূল্য গ্রহন করুন</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}

{{--    Test Test--}}

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
      <!-- <script src="/assets/js/preloader.min.js"></script> -->
      <!-- Theme js-->
      <script src="{{asset('/')}}js/validator.js"></script>

      <script src="{{asset('/')}}js/validatorRules.js"></script>
      @include('elements.myjs')
      <script>
        $('#flash-overlay-modal').modal();
        // $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        $('#PhoneNumberInput').on('keyup',function(){
          $(this).val($(this).val().replace(/[^0-9]/g,'').replace(/^(\d{5})(\d{6})/g,'$1-$2').substr(0,12));
        });
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
