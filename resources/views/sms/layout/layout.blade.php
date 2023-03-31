<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') SMS Society Management System</title>
    <link rel="icon" href="{{ url('assets/images/sms_tansparent_logo.png') }}" sizes="128x128" type="image/ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ url('assets/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('assets/adminlte3/plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <link rel="stylesheet"
        href="{{ url('assets/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="https://adminlte.io/themes/v3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ url('assets/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('assets/adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('style')

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: blue;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
        }
    </style>

    <style>
        .headertop {
            background: #f2f2f2;
        }
    </style>

    <style>
        .nav-tabs.flex-column {
            border-right: none;

        }

        .nav-tabs.flex-column .nav-link {
            border-bottom-left-radius: 0.25rem;
            border-top-right-radius: 0;
            margin-right: -7px;
            margin-left: -7px;
            /*border-left: 10px solid blue;*/
        }

        .nav-tabs.flex-column .nav-item.show .nav-link,
        .nav-tabs.flex-column .nav-link.active {
            border-left: 5px solid blue;
        }

        .custom-switch .custom-control-label::before {
            left: -2.25rem;
            width: 53px;
            height: 26px;
            pointer-events: all;
            border-radius: 0.5rem;
        }

        .custom-switch .custom-control-label::after {
            top: 10px;
            left: -26px;
            width: 17px;
            height: 16px;
            background-color: #adb5bd;
            border-radius: 0.5rem;
            transition: background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out;
            transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: transform .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-transform .15s ease-in-out;
        }

        .custom-control-label::after {
            position: absolute;
            top: 0.25rem;
            left: -1.5rem;
            display: block;
            width: 1rem;
            height: 1rem;
            content: "";
            background: no-repeat 50%/50% 50%;
        }
    </style>



    @include('sms.partials.header')

    @yield('content')


    <!-- Start Footer Area -->
    @include('sms.partials.footer')


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> --}}
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/f3dcd6cb6f.js" crossorigin="anonymous"></script>

    <script src="{{ url('assets/adminlte3/dist/js/adminlte.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ url('assets/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ url('assets/adminlte3/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    @yield('script')
    <script>
        let btnDel = document.querySelectorAll('.btn-del')
        Array.from(btnDel).forEach(btn => {
            console.log(btn)
            btn.addEventListener('click', (e) => {
                let con = confirm("Are you sure you want to delete?")
                if (con == false) {
                    e.preventDefault()
                }
            })
        })
    </script>
    {{-- Custom JS --}}
    <script src="{{ url('resources/js/custom.js?v=16') }}"></script>
</body>

</html>
