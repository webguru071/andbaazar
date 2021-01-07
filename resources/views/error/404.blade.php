<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/frontend/assets/images/favicon/1.png" type="image/x-icon" />
    <link rel="shortcut icon" href="/frontend/assets/images/favicon/1.png" type="image/x-icon" />
    <title>{{ env('APP_NAME') }}</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/fontawesome.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/slick-theme.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="/frontend/assets/css/color1.css" media="screen" id="color">


</head>

<body>

<!-- section start -->
<section class="p-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="error-section">
                    <h1>404</h1>
                    <h2>page not found</h2>
                    <a href="/" class="btn btn-solid">back to home</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->


<!-- latest jquery-->
<script src="/frontend/assets/js/jquery-3.3.1.min.js"></script>

<!-- menu js-->
<script src="/frontend/assets/js/menu.js"></script>

<!-- lazyload js-->
<script src="/frontend/assets/js/lazysizes.min.js"></script>

<!-- popper js-->
<script src="/frontend/assets/js/popper.min.js"></script>

<!-- slick js-->
<script src="/frontend/assets/js/slick.js"></script>

<!-- Bootstrap js-->
<script src="/frontend/assets/js/bootstrap.js"></script>

<!-- Bootstrap Notification js-->
<script src="/frontend/assets/js/bootstrap-notify.min.js"></script>

<!-- Theme js-->
{{--<script src="/frontend/assets/js/script.js"></script>--}}

<script>
    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
</script>

</body>

</html>
