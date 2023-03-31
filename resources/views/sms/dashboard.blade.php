<!-- Content Wrapper. Contains page content -->
@extends('sms.layout.layout')
@section('title')
    Dashboard -
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>Account</h3>

                            <p>{{ 'Available Balance: ' . $data['available_balance'] . ' INR' }}</p>
                        </div>
                        <a href="{{ route('account') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                    @if (session('role') == 'admin')
                  <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                          <div class="inner">
                              <h3>Members</h3>

                              <p>{{ 'Total Members per Flat: ' . $data['members_count'] }}</p>
                          </div>
                          <a href="{{ route('members') }}" class="small-box-footer">More info <i
                                  class="fas fa-arrow-circle-right"></i></a>
                      </div>
                  </div>
                    @endif
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">Notice Board</h3>
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
                <div class="row">
                    @if (isset($data['notice']))
                        <div class="col-md-12 mt-2">
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">
                                        <img class="img-circle"
                                            src="{{ url('assets/images/' . $data['notice']['user']->profile_pic) }}"
                                            alt="User Image">
                                        <span class="username"><a
                                                href="#">{{ $data['notice']['user']->first_name . ' ' . $data['notice']['user']->last_name }}</a></span>
                                        <span
                                            class="description">{{ 'Shared publicly - ' . date('h:i A', strtotime($data['notice']->created_at)) . ' ' . time_ago(strtotime($data['notice']->created_at)) }}</span>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body pb-0">
                                    <!-- post text -->
                                    <h5 class="text-emphasis">{{ $data['notice']->title }}</h5>
                                    <p>{{ $data['notice']->description }}</p>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    @else
                        <div class="col-md-12 mt-2">
                            <h6 class="text-muted text-emphasis">No active notice</h6>
                        </div><!-- /.col -->
                        @if (session('role') == 'admin')
                            <div class="col-md-12 mt-2">
                                <a href="{{ route('notice.board') }}" role="button"
                                    class="btn btn-default bg-gradient-primary">
                                    Take me to Notice Section
                                </a>
                            </div><!-- /.col -->
                        @endif
                    @endif
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
