
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TheEvent - Bootstrap Event Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{asset('coverpage/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico&display=swap" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="{{asset('coverpage/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('coverpage/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('coverpage/lib/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('coverpage/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{asset('coverpage/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
      Theme Name: TheEvent
      Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
      Author: BootstrapMade.com
      License: https://bootstrapmade.com/license/
    ======================================================= -->
</head>

<body>

<!--==========================
  Header
============================-->
<header id="header">
    <div class="container">

        <div id="logo" class="pull-left">
            <!-- Uncomment below if you prefer to use a text logo -->
            <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
            <a href="#intro" class="scrollto"><img src="img/logo.png" alt="" title=""></a>
        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">

            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->
<main id="main">


@yield('content')

</main>
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">


            </div>
        </div>
    </div>

    <div class="container">

    </div>
</footer><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JavaScript Libraries -->
<script src="{{asset('coverpage/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('coverpage/lib/jquery/jquery-migrate.min.js')}}"></script>
<script src="{{asset('coverpage/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('coverpage/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('coverpage/lib/superfish/hoverIntent.js')}}"></script>
<script src="{{asset('coverpage/lib/superfish/superfish.min.js')}}"></script>
<script src="{{asset('coverpage/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('coverpage/lib/venobox/venobox.min.js')}}"></script>
<script src="{{asset('coverpage/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Contact Form JavaScript File -->
<script src="{{asset('coverpage/contactform/contactform.js')}}"></script>

<!-- Template Main Javascript File -->
<script src="{{asset('coverpage/js/main.js')}}"></script>
</body>

</html>
