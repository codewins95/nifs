<!DOCTYPE html>
<html lang="zxx" dir="lrt">

<head>
    <script>
        const setTheme = (theme) => {
            theme ??= localStorage.theme || "light";
            document.documentElement.dataset.theme = theme;
            localStorage.theme = theme;
        };
        setTheme();
    </script>
    <meta logo="{{ static_asset('assets/images/logo/logo.png') }}">
    <meta white-logo="{{ static_asset('assets/images/logo/logo.png') }}">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="NIFS - ">
    <meta name="keywords" content="travel">
    <meta name="author" content="inittheme">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="website">
    <meta property="og:title" content="">
    <meta property="og:site_name" content="NIFS">
    <meta property="og:url" content="https://inittheme.com">
    <meta property="og:image" content="https://inittheme.com/images/selfie.jpg">
    <meta property="og:description" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="https://twitter.com/inittheme/photo">
    <meta name="twitter:card" content="summary">
    <!-- Google site verification -->
    <meta name="google-site-verification" content="...">
    <meta name="facebook-domain-verification" content="...">
    <meta name="csrf-token" content="...">
    <meta name="currency" content="$">
    <!-- Title -->
    <title>NIFS Travel & Tour Booking </title>
    <link rel="icon" type="image/x-icon" sizes="20x20" href="{{ static_asset('assets/images/icon/favicon.png') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/bootstrap-5.3.0.min.css') }}">
    <!-- Fonts & icon -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/remixicon.css') }}">
    <!-- Plugin -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/plugin.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ static_asset('common/css/toastr.min.css')}}">
    @stack('custom_css')
    
</head>

<body>
    <div id="preloader">
        <div id="loader" class="loader">
            <div class="loader-container">
                <div class="loader-icon">
                    <img src="{{static_asset('assets/images/loader.gif')}}" alt="Preloader">
                </div>
            </div>
        </div>
    </div>

    <main>

        <!--=====================================-->
        <!--=        Header Area Start       	=-->
        <!--=====================================-->
        @include('frontend.inc.header')
        <!--=====================================-->
        <!--=       Hero Banner Area Start      =-->
        <!--=====================================-->

        @yield('content')

        <!--=====================================-->
        <!--=        Footer Area Start       	=-->
        <!--=====================================-->
        <!-- Start Footer Area  -->
        @include('frontend.inc.footer')
        <!-- End Footer Area  -->

    </main>


    <!-- Scroll Up  -->
    <div class="progressParent" id="back-top">
        <svg class="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Add an search-overlay element -->
    <div class="search-overlay"></div>
    <!-- jquery-->
    <script src="{{ static_asset('assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ static_asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ static_asset('assets/js/bootstrap-5.3.0.min.js') }}"></script>
    <!-- Plugin -->
    <script src="{{ static_asset('assets/js/plugin.js') }}"></script>
    <!-- Main js-->
    <script src="{{ static_asset('assets/js/main.js') }}"></script>
    <script src="{{ static_asset('common/js/toastr.min.js')}}"></script>
    {!! Toastr::message() !!}
    @stack('custom_js')
    <script>
        $(window).on('load', function() {
            preloader();
        });

        function preloader() {
            $('#preloader').delay(0).fadeOut();
        };
    </script>
</body>

</html>
