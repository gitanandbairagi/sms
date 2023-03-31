<!-- Content Wrapper. Contains page content -->
@extends('sms.layout.layout')
@section('title')
    Account -
@endsection
@section('style')
    <style>
        #commentButton {
            cursor: pointer;
        }
        .comment-button {
            cursor: pointer;
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
                        <h1 class="m-0 text-dark">Account</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Account</li>
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
                @include('sms.pages.account.header')
                
                @yield('page-content')
                
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    {{-- Custom JS --}}
    <script src="{{ url('resources/js/custom.js?v=18') }}"></script>
@endsection
