<!-- Content Wrapper. Contains page content -->
@extends('sms.layout.layout')
@section('title')
    Suggested Works -
@endsection
@section('style')
    <style>
        .comment-button {
            cursor: pointer;
        }

        .color-blue {
            color: #0275d8;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Suggested Works</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Suggested Works</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- including sub-menu --}}
                @include('sms.pages.suggested_works.header')

                @yield('page-content')

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script src="{{ url('resources/js/custom.js?v=2') }}"></script>
@endsection
