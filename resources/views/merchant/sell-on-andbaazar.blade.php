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
      <link rel="stylesheet" type="text/css" href="/css/custom.css">
      <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
      @stack('css')
   </head>
   <body>
      <header id="header-area">
         <div class="container">
            <div class="row     align-items-center">
               <div class="col-lg-6">
                  <div class="sell-logo">
                     <img src="http://andbaazar.com/_nuxt/img/logo.362cfea.png" alt="img">
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="sell-link-top">
                     <i class="fa fa-phone" aria-hidden="true"></i>
                     <a href="tel:+৮৮-০৯৬৩৮০০০৭৭৭">+৮৮-০৯৬৩৮০০০৭৭৭</a>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- Banner Area Start -->
      <section id="sell_on_andbaazar_banner" style="background-image: url('{{asset("images/sell-banner.png")}}');">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="sell-register-from">
                  <div class="register-from-top-sell">
                     <h3>Register</h3>
                  </div>
                  <div class="sell-register-form-inner">
                    @if(session('flash_notification'))
                      <div class="flash-message">
                        @include('flash::message')
                      </div>
                    @endif
                     <form action="{{route('sellOnAndbaazarPost')}}" id="reg-from-area" class="form" method="post">
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
                           <button class="btn btn-primary p-3">Create Account</button>
                        </div>
                        <a href="/login">Already have an account</a>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-lg-12 text-center">
               <div class="time-line-area">
                  <ul>
                     <li>
                        <div class="time-line-items">
                           <div class="arrows">
                              <i class="fa fa-angle-right " aria-hidden="true"></i>
                           </div>
                           <div class="inners-text">
                              <i class="fa fa-edit" aria-hidden="true"></i>
                              <p>রেজিস্ট্রেশন করুন</p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="time-line-items">
                           <div class="arrows">
                              <i class="fa fa-angle-right " aria-hidden="true"></i>
                           </div>
                           <div class="inners-text">
                              <i class="fa fa-th-list" aria-hidden="true"></i>
                              <p>পণ্য লিস্টিং করুন</p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="time-line-items">
                           <div class="arrows">
                              <i class="fa fa-angle-right " aria-hidden="true"></i>
                           </div>
                           <div class="inners-text">
                              <i class="fa fa-address-book-o" aria-hidden="true"></i>
                              <p>অর্ডার গ্রহন করুন</p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="time-line-items">
                           <div class="arrows">
                              <i class="fa fa-angle-right " aria-hidden="true"></i>
                           </div>
                           <div class="inners-text">
                              <i class="fa fa-address-book-o" aria-hidden="true"></i>
                              <p>পণ্য ডেলিভারী করুন</p>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="time-line-items">
                           <div class="arrows">
                              <i class="fa fa-angle-right " aria-hidden="true"></i>
                           </div>
                           <div class="inners-text">
                              <i class="fa fa-address-book-o" aria-hidden="true"></i>
                              <p>মূল্য গ্রহন করুন</p>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      </section>
      <!-- Banner Area End -->
      <!-- Faqs Area Start -->
      <section id="faqs-wrappers">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 col-12">
                  <div class="faqs-inner-text">
                     <div class="text-area-faqs">
                        <h3 class="text-center">Some Common Question</h3>
                        <!--Accordion wrapper-->
                        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                           <!-- Accordion card -->
                           <div class="card">
                              <!-- Card header -->
                              <div class="card-header" role="tab" id="headingOne1">
                                 <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                                    aria-controls="collapseOne1">
                                    <h5 class="mb-0">
                                       Collapsible Group Item #1<i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </h5>
                                 </a>
                              </div>
                              <!-- Card body -->
                              <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                                 data-parent="#accordionEx">
                                 <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                    labore sustainable VHS.
                                 </div>
                              </div>
                           </div>
                           <!-- Accordion card -->
                           <!-- Accordion card -->
                           <div class="card">
                              <!-- Card header -->
                              <div class="card-header" role="tab" id="headingTwo2">
                                 <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                                    aria-expanded="false" aria-controls="collapseTwo2">
                                    <h5 class="mb-0">
                                       Collapsible Group Item #2 <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </h5>
                                 </a>
                              </div>
                              <!-- Card body -->
                              <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                                 data-parent="#accordionEx">
                                 <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                    labore sustainable VHS.
                                 </div>
                              </div>
                           </div>
                           <!-- Accordion card -->
                           <!-- Accordion card -->
                           <div class="card">
                              <!-- Card header -->
                              <div class="card-header" role="tab" id="headingThree3">
                                 <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                                    aria-expanded="false" aria-controls="collapseThree3">
                                    <h5 class="mb-0">
                                       Collapsible Group Item #3 <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </h5>
                                 </a>
                              </div>
                              <!-- Card body -->
                              <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                                 data-parent="#accordionEx">
                                 <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                    labore sustainable VHS.
                                 </div>
                              </div>
                           </div>
                           <!-- Accordion card -->
                        </div>
                        <!-- Accordion wrapper -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Faqs Area End -->
      <!-- Footer Area Start -->
      <footer id="footer_area_sell_baazar">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="footer-left-side">
                     <p>
                        <a href="#!"><img src="http://andbaazar.com/_nuxt/img/logo.362cfea.png" alt="img"></a>
                        <a href="#!">Sitemap</a>
                        <a href="#!">Our Partner </a>
                        <a href="#!">Andbaazar Blog </a>
                        <a href="#!"> Our Address</a>
                     </p>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="email_area">
                           <p><span>Email: &nbsp;<a href="mailto:demo@gmail.com">demo@gmail.com </a>,
                              <a href="mailto:demo@gmail.com">demo@gmail.com</a></span>
                           </p>
                           <p><span>Inbox: &nbsp; <a href="https://www.facebook.com">https://www.facebook.com</a></span></p>
                           <p><span>Phone: &nbsp;০৯৬৩৮11০৭৭৭, ০১৮456৫২০৮৮, ০১৮12745০৮৬</span></p>
                           <div class="social-icons">
                              <a href="#!"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                              <a href="#!"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                              <a href="#!"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="subscribe-area">
                           <p>More than 1000 products are being added every day. Subscribe now to get updates on our new products.</p>
                           <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="button">Button</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer Area End -->
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