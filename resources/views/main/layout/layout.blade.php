<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Society Management System</title>
    <link rel="icon" href="{{ url('assets/images/sms_tansparent_logo.png') }}" sizes="128x128" type="image/ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/dist/css/adminlte.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('style')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        @include('main.partials.header')

        @yield('content')

        @include('main.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ url('assets/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('assets/adminlte3/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ url('assets/adminlte3/dist/js/demo.js') }}"></script> --}}
    {{-- Custom JS --}}
    <script src="{{ url('resources/js/custom.js?v=11') }}"></script>
    <script>
        $.each($('*'), function() {
            if ($(this).width() > $('body').width()) {
                console.log("Wide Element: ", $(this), "Width: ", $(this).width());
            }
        });
    </script>

    {{-- Custom JS --}}
    <script src="{{ url('resources/js/custom.js?v=15') }}"></script>
    @yield('script')
</body>

</html>
