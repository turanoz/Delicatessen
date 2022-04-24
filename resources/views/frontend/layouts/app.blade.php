<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        {{$_site->title}}
        @yield('title')
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
          rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/assets/images/x-icon/01.png">

    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/animate.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/all.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/icofont.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/lightcase.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/swiper.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/assets/css/style.css">
    @yield('_css')
</head>

<body>


@include('frontend.layouts.data.nav')
@yield('content')
@include('frontend.layouts.data.footer')


<!-- scrollToTop start here -->
<a href="#" class="scrollToTop"><i class="icofont-swoosh-up"></i><span class="pluse_1"></span><span
            class="pluse_2"></span></a>
<!-- scrollToTop ending here -->


<script src="{{asset('frontend')}}/assets/js/jquery.js"></script>
<script src="{{asset('frontend')}}/assets/js/fontawesome.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/waypoints.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/bootstrap.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/wow.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/swiper.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/jquery.countdown.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/jquery.counterup.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/isotope.pkgd.min.js"></script>
<script src="{{asset('frontend')}}/assets/js/lightcase.js"></script>
<script src="{{asset('frontend')}}/assets/js/functions.js"></script>

@yield('_js')
</body>
</html>
