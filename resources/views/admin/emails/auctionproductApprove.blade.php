{{-- 
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/multikart/front-end/email-template-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Mar 2020 05:46:54 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('frontent/assets/images/favicon/1.png" ty')}}pe="image/x-icon">
    <link rel="shortcut icon" href="{{asset('frontent/assets/images/favicon/1.png" ty')}}pe="image/x-icon">
    <title>AndBaazar | Email </title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <style type="text/css">
        body {
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: 'Lato', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            display: inline-block;
            text-decoration: unset;
        }

        a {
            text-decoration: none;
        }

        h5 {
            margin: 10px;
            color: #777;
        }

        .text-center {
            text-align: center
        }

        .main-bg-light {
            background-color: #fafafa;
        }

        .title {
            color: #444444;
            font-size: 22px;
            font-weight: bold;
            margin-top: 0px;
            margin-bottom: 10px;
            padding-bottom: 0;
            text-transform: uppercase;
            display: inline-block;
            line-height: 1;
        }

        .menu {
            width: 100%;
        }

        .menu li a {
            text-transform: capitalize;
            color: #444;
            font-size: 16px;
            margin-right: 15px
        }

        .main-logo {
            width: 180px;
            padding: 10px 20px;
            margin-bottom: -5px;
        }

        .product-box .product {
            text-align: center;
            position: relative;
        }

        .product-info {
            margin-top: 15px;
        }

        .product-info h6 {
            line-height: 1;
            margin-bottom: 0;
            padding-bottom: 5px;
            font-size: 14px;
            font-family: "Open Sans", sans-serif;
            color: #777;
            margin-top: 0;
        }

        .product-info h4 {
            font-size: 16px;
            color: #444;
            font-weight: 700;
            margin-bottom: 0;
            margin-top: 5px;
            padding-bottom: 5px;
            line-height: 1;
        }

        .footer-social-icon tr td img {
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
</head>

<body style="margin: 20px auto;">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
        style="background-color: #fff; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
        <tbody>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr class="header">
                            <td align="left" valign="top">
                                <img src="{{asset('frontent/assets/images/email-temp/logo.p')}}ng" class="main-logo">
                            </td>
                            <td class="menu" align="right">
                                <ul>
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Whishlist</a></li>
                                    <li><a href="#">my cart</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="slider" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <th align="center" width="40%"><img src="{{asset('frontent/assets/images/email-temp/e-2-slider.jpg')}}" alt=""
                                    style="margin-bottom: -5px;">
                </td>
                <th width="60%" style="background-color: #11bfff;padding: 30px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td
                                style="color:#ffffff;font-size: 16px;line-height:20px;text-transform:uppercase;text-align:left;padding-bottom: 5px;">
                                New Color</td>
                        </tr>
                        <tr>
                            <td class="h2-white left pb20"
                                style="color:#ffffff; font-family: 'Roboto', sans-serif; font-size:52px; line-height:58px; text-transform:uppercase; font-weight:bold; text-align:left; padding-bottom:20px;">
                                new <br>season</td>
                        </tr>
                        <tr>
                            <td style="">
                                <p style="font-size:13px;color:#4e54cb;text-align:left;color:#fff;">We are committed to
                                    your satisfaction with every order.</p>
                            </td>
                        </tr>

                    </table>
                    <table>
                        <tr>
                            <td class="text-button white-button"
                                style="font-size:14px; line-height:18px; text-align:center; text-transform:uppercase; padding:10px; background:#ffffff; color:#f54084; font-weight:bold;">
                                <a href="#" target="_blan" style="color:#4e54cb; text-decoration:none;"><span
                                        style="color:#f1415e; text-decoration:none;">shop now</span></a></td>
                        </tr>
                    </table>
                </th>
            </tr>
    </table>
    <h1>Hello, <p style="font-size: x-small;">{{ $name.' '.$surname }}</p></h1>

    <P>
        your profile accepted.
    </P>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <thead>
            <tr>
                <h4 class="title" style="width: 100%; text-align:center;margin-top: 50px;">trending product</h4>
                <p style="margin:0">GET EVEN 25% OFF DISCOUNT</p>
            </tr>
        </thead>
        <tr>
            <td>
                <div class="product-box hover">
                    <div class="product border-theme br-0">
                        <img src="{{asset('frontent/assets/images/email-temp/13.jpg')}}" alt="product" style="width: 100%;">
                    </div>
                    <div class="product-info">
                        <a href="#" tabindex="0">
                            <h6>When an unknown.</h6>
                        </a>
                        <h4>$45.00</h4>
                    </div>
                </div>
            </td>
            <td>
                <div class="product-box hover">
                    <div class="product border-theme br-0">
                        <img src="{{asset('frontent/assets/images/email-temp/14.jpg')}}" alt="product" style="width: 100%;">
                    </div>
                    <div class="product-info">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <a href="#" tabindex="0">
                            <h6>When an unknown.</h6>
                        </a>
                        <h4>$45.00</h4>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:30px;">
        <tbody>
            <tr align="center" class="add-with-banner">
                <td>
                    <a href="#"><img src="{{asset('frontent/assets/images/email-temp/banner.jpg')}}" alt="product"
                            style="width: 100%;"></a>
                </td>

            </tr>

        </tbody>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" align="center" style="margin-top:30px;">
        <tr>
            <td>
                <img src="{{asset('frontent/assets/images/email-temp/banner-2.jpg')}}" alt="" style="width: 100%;">
            </td>
        </tr>
    </table>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top: 30px;">
        <tr>
            <td align="center">
                <table align="center" border="0" class="display-width-inner" cellpadding="0" cellspacing="0"
                    width="100%" style="max-width:450px;">
                    <tr>
                        <td align="center" style="width: 40%;">
                            <img src="{{asset('frontent/assets/images/email-temp/10.jpg')}}" alt=""
                                style="width: 225px;margin-bottom: -4px;">
                        </td>
                        <td align="center" style="background-color: #fafafa;width: 60%;">
                            <h3 style="margin: 0;">Product One</h3>
                            <div
                                style="color:#E01931; font-weight:600; font-size:16px; line-height:27px; letter-spacing:1px;margin: 4px;">
                                <span
                                    style="color:#666666; font-weight:600; font-size:15px; line-height:25px; letter-spacing:1px;"
                                    class="txt-price1" data-color="Price1" data-size="Price1" data-min="10"
                                    data-max="35"><strike>$25.00</strike></span><span
                                    class="txt-price2">&nbsp;&nbsp;&nbsp;</span>$20.90
                            </div>
                            <div
                                style="padding: 15px 0px;text-transform: uppercase;font-size: 11px;letter-spacing: 1px;">
                                <a href="#"
                                    style="color: #ffffff;text-decoration: none;background: #000;padding: 8px 12px;">SHOP
                                    NOW</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table align="center" border="0" class="display-width-inner" cellpadding="0" cellspacing="0"
                    width="100%" style="max-width:450px;">
                    <tr>
                        <td align="center" style="background-color: #fafafa;width: 60%;">
                            <h3 style="margin: 0;">Product One</h3>
                            <div
                                style="color:#E01931; font-weight:600; font-size:16px; line-height:27px; letter-spacing:1px;margin: 4px;">
                                <span
                                    style="color:#666666; font-weight:600; font-size:15px; line-height:25px; letter-spacing:1px;"
                                    class="txt-price1" data-color="Price1" data-size="Price1" data-min="10"
                                    data-max="35"><strike>$25.00</strike></span><span
                                    class="txt-price2">&nbsp;&nbsp;&nbsp;</span>$20.90
                            </div>
                            <div
                                style="padding: 15px 0px;text-transform: uppercase;font-size: 11px;letter-spacing: 1px;">
                                <a href="#"
                                    style="color: #ffffff;text-decoration: none;background: #000;padding: 8px 12px;">SHOP
                                    NOW</a>
                            </div>
                        </td>
                        <td align="center" style="width: 40%;">
                            <img src="{{asset('frontent/assets/images/email-temp/11.jpg')}}" alt=""
                                style="width: 225px;margin-bottom: -4px;">
                        </td>
                    </tr>
                </table>

                <table align="center" border="0" class="display-width-inner" cellpadding="0" cellspacing="0"
                    width="100%" style="max-width:450px;">
                    <tr>
                        <td align="center" style="width: 40%;">
                            <img src="{{asset('frontent/assets/images/email-temp/12.jpg')}}" alt=""
                                style="width: 225px;margin-bottom: -4px;">
                        </td>
                        <td align="center" style="background-color: #fafafa;width: 60%;">
                            <h3 style="margin: 0;">Product One</h3>
                            <div
                                style="color:#E01931; font-weight:600; font-size:16px; line-height:27px; letter-spacing:1px;margin: 4px;">
                                <span
                                    style="color:#666666; font-weight:600; font-size:15px; line-height:25px; letter-spacing:1px;"
                                    class="txt-price1" data-color="Price1" data-size="Price1" data-min="10"
                                    data-max="35"><strike>$25.00</strike></span><span
                                    class="txt-price2">&nbsp;&nbsp;&nbsp;</span>$20.90
                            </div>
                            <div
                                style="padding: 15px 0px;text-transform: uppercase;font-size: 11px;letter-spacing: 1px;">
                                <a href="#"
                                    style="color: #ffffff;text-decoration: none;background: #000;padding: 8px 12px;">SHOP
                                    NOW</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
    <table class="main-bg-light text-center" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="margin-top:30px;">
        <tr>
            <td style="padding: 30px;">
                <div>
                    <h4 class="title" style="margin:0">Follow us</h4>
                </div>
                <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon" align="center"
                    class="text-center" style="margin-top:20px;">
                    <tr>
                        <td>
                            <a href="#"><img src="{{asset('frontent/assets/images/email-temp/facebo')}}ok.png" alt=""></a>
                        </td>
                        <td>
                            <a href="#"><img src="{{asset('frontent/assets/images/email-temp/youtub')}}e.png" alt=""></a>
                        </td>
                        <td>
                            <a href="#"><img src="{{asset('frontent/assets/images/email-temp/twitte')}}r.png" alt=""></a>
                        </td>
                        <td>
                            <a href="#"><img src="{{asset('frontent/assets/images/email-temp/gplus.')}}png" alt=""></a>
                        </td>
                        <td>
                            <a href="#"><img src="{{asset('frontent/assets/images/email-temp/linked')}}in.png" alt=""></a>
                        </td>
                        <td>
                            <a href="#"><img src="{{asset('frontent/assets/images/email-temp/pinter')}}est.png" alt=""></a>
                        </td>
                    </tr>
                </table>
                <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px auto 0;">
                    <tr>
                        <td>
                            <a href="#" style="font-size:13px">Want to change how you receive these emails?</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size:13px; margin:0;">2018 - 19 Copy Right by Themeforest powerd by Pixel
                                Strap</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#" style="font-size:13px; margin:0;text-decoration: underline;">Unsubscribe</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    </td>
    </tr>
    </tbody>
    </table>
</body>


<!-- Mirrored from themes.pixelstrap.com/multikart/front-end/email-template-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Mar 2020 05:47:05 GMT -->
</html>
 --}}
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <!--[if !mso]--><!-- -->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet">
    <!-- <![endif]-->

    <title>Andbaazar Product Approvement Request</title>

    <style type="text/css">
        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
        }
        
        p,
        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
        
        span.preheader {
            display: none;
            font-size: 1px;
        }
        
        html {
            width: 100%;
        }
        
        table {
            font-size: 14px;
            border: 0;
        }
        /* ----------- responsivity ----------- */
        
        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .main-header {
                font-size: 20px !important;
            }
            .main-section-header {
                font-size: 28px !important;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
            .align-center {
                text-align: center !important;
            }
            .no-bg {
                background: none !important;
            }
            /*----- main image -------*/
            .main-image img {
                width: 440px !important;
                height: auto !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 440px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 440px !important;
            }
            .container580 {
                width: 400px !important;
            }
            .main-button {
                width: 220px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 320px !important;
                height: auto !important;
            }
            .team-img img {
                width: 100% !important;
                height: auto !important;
            }
        }
        
        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .main-header {
                font-size: 18px !important;
            }
            .main-section-header {
                font-size: 26px !important;
            }
            /* ====== divider ====== */
            .divider img {
                width: 280px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 280px !important;
            }
            .container590 {
                width: 280px !important;
            }
            .container580 {
                width: 260px !important;
            }
            /*-------- secions ----------*/
            .section-img img {
                width: 280px !important;
                height: auto !important;
            }
        }
    </style>
    <!-- [if gte mso 9]><style type=”text/css”>
        body {
        font-family: arial, sans-serif!important;
        }
        </style>
    <![endif]-->
</head>


<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <!-- pre-header -->
    <table style="display:none!important;">
        <tr>
            <td>
                <div style="overflow:hidden;display:none;font-size:1px;color:#ffffff;line-height:1px;font-family:Arial;maxheight:0px;max-width:0px;opacity:0;">
                    Eamil For Auction product Approvement
                </div>
            </td>
        </tr>
    </table>
    <!-- pre-header end -->
    <!-- header -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">

                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                                <tr>
                                    <td align="center" height="70" style="height:70px;">
                                        {{-- <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="100" border="0" style="display: block; width: 100px;" src="https://mdbootstrap.com/img/logo/mdb-email.png" alt="" /></a> --}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <!-- end header -->

    <!-- big image section -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>

                        <td align="center" class="section-img">
                            {{-- <a href="" style=" border-style: none !important; display: block; border: 0 !important;"><img src="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img (67).jpg" style="display: block; width: 590px;" width="590" border="0" alt="" /></a> --}}




                        </td>
                    </tr>
                    <tr>
                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;" class="main-header">


                            <div style="line-height: 35px">

                               <span style="color: #5caad2;">Andbaazar</span>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                <tr>
                                    <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="center">
                            <table border="0" width="400" align="center" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">


                                        <div style="line-height: 24px">

                                          Dear Seller ,
                                          <p>
                                            your product has been published for auction. <br> Now all register customer can bids on your auction product.
                                          </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                    </tr>

                    {{-- <tr>
                        <td align="center">
                            <table border="0" align="center" width="160" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="">

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 26px;">


                                        <div style="line-height: 26px;">
                                            <a href="" style="color: #ffffff; text-decoration: none;">SHOP NOW</a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                </tr>

                            </table>
                        </td>
                    </tr> --}}


                </table>

            </td>
        </tr>

    </table>
    <!-- end section -->

    <!-- contact section -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">

        <tr class="hide">
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>
        <tr>
            <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
        </tr>

        <tr>
            <td height="60" style="border-top: 1px solid #e0e0e0;font-size: 60px; line-height: 60px;">&nbsp;</td>
        </tr>

        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590 bg_color">

                    <tr>
                        <td>
                            <table border="0" width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                <tr>
                                    <!-- logo -->
                                    <td align="left">
                                        {{-- <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="80" border="0" style="display: block; width: 80px;" src="https://mdbootstrap.com/img/logo/mdb-email.png" alt="" /></a> --}}
                                    </td>
                                </tr>

                                <tr>
                                    <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td align="left" style="color: #888888; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 23px;" class="text_color">
                                        <div style="color: #333333; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; font-weight: 600; mso-line-height-rule: exactly; line-height: 23px;">

                                             Any Question? Email us: <br/> <a href="mailto:" style="color: #888888; font-size: 14px; font-family: 'Hind Siliguri', Calibri, Sans-serif; font-weight: 400;">andbaazar@gmail.com</a>

                                        </div>
                                    </td>
                                </tr>

                            </table>

                            <table border="0" width="2" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <td width="2" height="10" style="font-size: 10px; line-height: 10px;"></td>
                                </tr>
                            </table>

                            <table border="0" width="200" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                <tr>
                                    <td class="hide" height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td>
                                </tr>



                                <tr>
                                    <td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td>
                                        <table border="0" align="right" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <a href="https://www.facebook.com/mdbootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Qc3zTxn.png" alt=""></a>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <a href="https://twitter.com/MDBootstrap" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/RBRORq1.png" alt=""></a>
                                                </td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <a href="https://plus.google.com/u/0/b/107863090883699620484/107863090883699620484/posts" style="display: block; border-style: none !important; border: 0 !important;"><img width="24" border="0" style="display: block;" src="http://i.imgur.com/Wji3af6.png" alt=""></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td height="60" style="font-size: 60px; line-height: 60px;">&nbsp;</td>
        </tr>

    </table>
    <!-- end section -->

    <!-- footer ====== -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">

        <tr>
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>

        <tr>
            <td align="center">

                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

                    <tr>
                        <td>
                            <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                        <div style="line-height: 24px;">

                                            <span style="color: #333333;">Choto Mirjapur,Khulna</span>

                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <table border="0" align="left" width="5" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">
                                <tr>
                                    <td height="20" width="5" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                </tr>
                            </table>

                            <table border="0" align="right" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="container590">

                                <tr>
                                    <td align="center">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    <a style="font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;" href="#">SUBSCRIBE</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>

        <tr>
            <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
        </tr>

    </table>
    <!-- end footer ====== -->

</body>

</html>