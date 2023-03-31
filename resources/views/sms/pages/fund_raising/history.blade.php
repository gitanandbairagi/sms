@extends('sms.pages.fund_raising.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">
            <form action="" method="get">
                <div class="row mt-2">
                    <div class="col-md-3">
                        <input type="text" name="keywords" class="form-control" placeholder="Search" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="from" class="form-control date" placeholder="From Date" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="to" class="form-control date" placeholder="To Date" />
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            @if (actual_link() != url('fund-raising/history'))
                <div class="col-md-12 mt-2">
                    <h6 class="text-emphasis">{{ $data['message'] }}</h6>
                </div>
                @foreach ($data['works'] as $value)
                    <div class="col-md-12 mt-2 mb-1">
                        <!-- Box Comment -->
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" src="{{ url('assets/images/' . $value['user']->profile_pic) }}"
                                        alt="profile_pic">
                                    <span class="username"><a
                                            href="#">{{ $value['user']->first_name . ' ' . $value['user']->last_name }}</a></span>
                                    <span
                                        class="description">{{ 'Shared publicly - ' . date('d-M-Y h:i A', strtotime($value->created_at)) . ' ' . time_ago(strtotime($value->created_at)) }}</span>
                                </div>
                                <div class="user-block float-right">
                                    <p class="description mb-0">Closed On</p>
                                    <span
                                        class="description text-danger">{{ date('d-M-Y h:i A', strtotime($value->updated_at)) . ' ' . time_ago(strtotime($value->updated_at)) }}</span>
                                </div>
                                <!-- /.user-block -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pb-0">
                                <!-- post text -->
                                <h5 class="text-emphasis">{!! $value->title !!}</h5>
                                <p>{!! $value->description !!}</p>

                                <!-- Social sharing buttons -->
                                <span class="text-success">Collected Amount: Rs.60,000.00</span>
                                <span class="float-right text-success">45 Members Helped</span>
                            </div>
                            <!-- /.card-body -->
                            <p class="card-body py-0 text-muted comment-button mt-2 ms-1 btn-sm"><i
                                    class="fa fa-comment-o"></i>{{ ' ' . $value->comments_count . ' comments' }}</p>
                            <div class="card-footer card-comments comment-block">
                                @foreach ($value['comments'] as $val)
                                    <div class="card-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm"
                                            src="{{ url('assets/images/' . $val['user']->profile_pic) }}" alt="profile_pic">

                                        <div class="comment-text">
                                            <span class="username">
                                                {{ $val['user']->first_name . ' ' . $val['user']->last_name }}
                                                <span
                                                    class="text-muted float-right">{{ time_ago(strtotime($val->created_at)) }}</span>
                                            </span><!-- /.username -->
                                            {{ $val->description }}
                                        </div>
                                        <!-- /.comment-text -->
                                    </div>
                                    <!-- /.card-comment -->
                                @endforeach
                            </div>
                            <div class="card-footer card-comments comment-block">
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm"
                                        src="{{ url('assets/adminlte3/dist/img/user3-128x128.jpg') }}" alt="User Image">

                                    <div class="comment-text">
                                        <span class="username">
                                            Maria Gonzales
                                            <span class="text-muted float-right">8:03 PM Today</span>
                                        </span><!-- /.username -->
                                        It is a long established fact that a reader will be distracted
                                        by the readable content of a page when looking at its layout.
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                <!-- /.card-comment -->
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm"
                                        src="{{ url('assets/adminlte3/dist/img/user5-128x128.jpg') }}" alt="User Image">

                                    <div class="comment-text">
                                        <span class="username">
                                            Nora Havisham
                                            <span class="text-muted float-right">8:03 PM Today</span>
                                        </span><!-- /.username -->
                                        The point of using Lorem Ipsum is that it hrs a morer-less
                                        normal distribution of letters, as opposed to using
                                        'Content here, content here', making it look like readable English.
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                <!-- /.card-comment -->
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                @endforeach
            @else
                <div class="col-md-12 mt-2">
                    <h6 class="text-muted text-emphasis">Please search with any field to get data</h6>
                </div>
            @endif
        </div>
    </div>
@endsection
