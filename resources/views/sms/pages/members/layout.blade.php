<!-- Content Wrapper. Contains page content -->
@extends('sms.layout.layout')
@section('title')
    Members -
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
                        <h1 class="m-0 text-dark">Members</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                {{-- session flash success and error alerts --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{-- including sub-menu --}}
                @include('sms.pages.members.header')

                @yield('page-content')

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    {{-- Custom JS --}}
    <script src="{{ url('resources/js/custom.js?v=11') }}"></script>
@endsection
