<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E.P Church Manager | Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ 
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
     Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/owl.transitions.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/chosen/bootstrap-chosen.css')}}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/form/all-type-forms.css')}}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/normalize.css')}}">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/meanmenu.min.css')}}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/educate-custon-icon.css')}}">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/morrisjs/morris.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/modals.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/preloader/preloader-style.css')}}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/metisMenu/metisMenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/metisMenu/metisMenu-vertical.css')}}">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/calendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/calendar/fullcalendar.print.min.css')}}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/style.css')}}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('admin/css/responsive.css')}}">
    <link href="{{asset('general/css/general_min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/alerts.css')}}" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{asset('admin/datatables/datatables.min.css')}}"/>

    <!-- modernizr JS
		============================================ -->
    <script src="{{asset('admin/js/vendor/modernizr-2.8.3.min.js')}}"></script>


</head>

<body>
@include('menunavs.main')
@include('includes.notification')
@yield('content')

<div id="cover-spin">
    <div class="preloader-single shadow-inner mt-b-30">
        <div class="ts_preloading_box">
            <div id="ts-preloader-absolute">
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
                <div class="tsperloader"></div>
            </div>
        </div>
    </div>
</div>

<!-- jquery
		============================================ -->
<script src="{{asset('admin/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- bootstrap JS
    ============================================ -->
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<!-- wow JS
    ============================================ -->
<script src="{{asset('admin/js/wow.min.js')}}"></script>
<!-- price-slider JS
    ============================================ -->
<script src="{{asset('admin/js/jquery-price-slider.js')}}"></script>
<!-- meanmenu JS
    ============================================ -->
<script src="{{asset('admin/js/jquery.meanmenu.js')}}"></script>
<!-- owl.carousel JS
    ============================================ -->
<script src="{{asset('admin/js/owl.carousel.min.js')}}"></script>
<!-- sticky JS
    ============================================ -->
<script src="{{asset('admin/js/jquery.sticky.js')}}"></script>
<!-- scrollUp JS
    ============================================ -->
<script src="{{asset('admin/js/jquery.scrollUp.min.js')}}"></script>
<!-- counterup JS
    ============================================ -->
<script src="{{asset('admin/js/counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('admin/js/counterup/waypoints.min.js')}}"></script>
<script src="{{asset('admin/js/counterup/counterup-active.js')}}"></script>
<!-- mCustomScrollbar JS
    ============================================ -->
<script src="{{asset('admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('admin/js/scrollbar/mCustomScrollbar-active.js')}}"></script>
<!-- metisMenu JS
    ============================================ -->
<script src="{{asset('admin/js/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('admin/js/metisMenu/metisMenu-active.js')}}"></script>
<!-- morrisjs JS
    ============================================ -->
<script src="{{asset('admin/js/morrisjs/raphael-min.js')}}"></script>
<script src="{{asset('admin/js/morrisjs/morris.js')}}"></script>
<script src="{{asset('admin/js/morrisjs/home3-active.js')}}"></script>
<!-- morrisjs JS


    ============================================ -->
<script src="{{asset('admin/js/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('admin/js/sparkline/jquery.charts-sparkline.js')}}"></script>
<script src="{{asset('admin/js/sparkline/sparkline-active.js')}}"></script>
<!-- calendar JS
    ============================================ -->
<script src="{{asset('admin/js/calendar/moment.min.js')}}"></script>
<script src="{{asset('admin/js/calendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('admin/js/calendar/fullcalendar-active.js')}}"></script>
<!-- plugins JS
    ============================================ -->
<script src="{{asset('admin/js/plugins.js')}}"></script>

<script type="text/javascript" src="{{asset('admin/datatables/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/datatables/pdfmakevfsfonts.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/datatables/printdatatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/datatables/buttonscolVis.min.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<script src="{{asset('general/js/customizarrr.js')}}"></script>
<script src="{{asset('general/js/datatablereporter.js')}}"></script>
<script src="{{asset('admin/js/chosen/chosen.jquery.js')}}"></script>
<script src="{{asset('admin/js/chosen/chosen-active.js')}}"></script>
<script src="{{asset('admin/js/datepicker/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin/js/datepicker/datepicker-active.js')}}"></script>
<script>
    var BaseURL  = "{{url('/')}}";

</script>
</body>

</html>


