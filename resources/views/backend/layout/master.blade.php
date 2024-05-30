<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>NIFS Tour Agency  | User  Dashboard</title>

    {{-- favixon  --}}

    <link rel="icon" type="image/x-icon" sizes="20x20" href="{{static_asset('assets/images/icon/favicon.png')}}">

    <!-- GLOBAL MAINLY STYLES-->

    <link href="{{ static_asset('backend_assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ static_asset('backend_assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ static_asset('backend_assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet">
    <!-- PLUGINS STYLES-->
    <link href="{{ static_asset('backend_assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet">
    <!-- THEME STYLES-->
    <link href="{{ static_asset('backend_assets/css/main.min.css') }}" rel="stylesheet">
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        @include('backend.inc.header')
        @include('backend.inc.sidebar')
        <!-- Sidebar Area End Here -->
        <div class="content-wrapper">

            {{-- Contant replate  --}}
            @yield('content')
            {{-- End Contant replate  --}}

            <footer class="page-footer">
                <div class="font-13">2024 © <b>NIFS Tour Agency</b> - All rights reserved.</div>
                <a class="px-4"
                    href=""
                    target="_blank">HOVER BUSINESS SERVICES</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>

    </div>




    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="{{ static_asset('backend_assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ static_asset('backend_assets/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ static_asset('backend_assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ static_asset('backend_assets/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ static_asset('backend_assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ static_asset('backend_assets/vendors/chart.js/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ static_asset('backend_assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ static_asset('backend_assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"
        type="text/javascript"></script>
    <script src="{{ static_asset('backend_assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js') }}"
        type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ static_asset('backend_assets/js/app.min.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ static_asset('backend_assets/js/scripts/dashboard_1_demo.js') }}" type="text/javascript"></script>
</body>

</html>
