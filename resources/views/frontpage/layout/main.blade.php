
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    <link rel="shortcut icon" href="{{ asset('frontpage/images/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('frontpage/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontpage/css/responsive.css') }}">
    @yield('css')
    @livewireStyles
    <script src="/rappasoft/laravel-livewire-tables/core.min.js"  ></script>
    <script src="/rappasoft/laravel-livewire-tables/thirdparty.min.js"  ></script>
</head>
<body>
<style>
    .nice-select.open .list {
        width: 100% !important;
    }
</style>
@include("frontpage.layout.header")

@yield('content')
@if(isset($slot))
    {{ $slot }}
@endif

@include("frontpage.layout.footer")
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
@livewireScripts
@filepondScripts
<script src="{{ asset('frontpage/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontpage/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('frontpage/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontpage/js/slick.min.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontpage/js/waypoints.min.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.nice-number.min.js') }}"></script>
<script src="{{ asset('frontpage/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontpage/js/validator.min.js') }}"></script>
<script src="{{ asset('frontpage/js/ajax-contact.js') }}"></script>
<script src="{{ asset('frontpage/js/main.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
<script src="{{ asset('frontpage/js/map-script.js') }}"></script>
<script src="https://js.paystack.co/v2/inline.js"></script>
@yield('js')
</body>
</html>
