<!-- Content Wrapper. Contains page content -->
@extends('sms.layout.layout')
@section('title')
    Notice Board -
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
                        <h1 class="m-0 text-dark">Notice Board</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Notice Board</li>
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
                @include('sms.pages.notice_board.header')
                
                @yield('page-content')
                
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script src="{{ url('resources/js/custom.js?v=1') }}"></script>
@endsection
