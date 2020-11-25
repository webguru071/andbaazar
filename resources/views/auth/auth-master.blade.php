<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Multikart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('frontend')}}/assets/images/favicon/fav.png" type="image/x-icon">
    <title>Andbaazar Merchant</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/fontawesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/themify.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/slick-theme.css">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/jsgrid.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend')}}/assets/css/admin.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

     <!-- Custom css-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}/css/custom.css">

    @stack('css')
</head>
<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">
    <div class="authentication-box" style="background: url({{asset('images/auth-banar.jpg')}}); background-size: cover; background-color:#4841412b">
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>


<!-- latest jquery-->
<script src="{{asset('frontend')}}/assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap js-->
<script src="{{asset('frontend')}}/assets/js/popper.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/bootstrap.js"></script>

<!-- feather icon js-->
<script src="{{asset('frontend')}}/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="{{asset('frontend')}}/assets/js/sidebar-menu.js"></script>
<script src="{{asset('frontend')}}/assets/js/slick.js"></script>

<!-- Jsgrid js-->
<script src="{{asset('frontend')}}/assets/js/jsgrid/jsgrid.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/jsgrid/griddata-invoice.js"></script>
<script src="{{asset('frontend')}}/assets/js/jsgrid/jsgrid-invoice.js"></script>

<!-- lazyload js-->
<script src="{{asset('frontend')}}/assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="{{asset('frontend')}}/assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="{{asset('frontend')}}/assets/js/admin-script.js"></script>
<script src="{{asset('/')}}js/validator.js"></script>
<script src="{{asset('/')}}js/validatorRules.js"></script>
@include('elements.myjs')

<script>
    $('.single-item').slick({
            arrows: false,
            dots: true
        }
    );
</script>
@stack('js')
</body>
</html>
