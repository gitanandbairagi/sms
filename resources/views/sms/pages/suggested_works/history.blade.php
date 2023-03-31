@extends('sms.pages.suggested_works.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">
            <form action="{{ route('suggested.works.history') }}" method="get">
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
            @if (actual_link() != url('suggested-works/history'))
                <div class="col-md-12 mt-2">
                    <h6 class="text-emphasis">{{ $data['message'] }}</h6>
                </div>
                @foreach ($data['works'] as $value)
                    <div class="col-md-12 mt-2">
                        <!-- Box Comment -->
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" src="{{ url('assets/images/' . $value['user']->profile_pic) }}"
                                        alt="profile_pic">
                                    <span class="username"><a
                                            href="#">{{ $value['user']->first_name . ' ' . $value['user']->last_name }}</a></span>
                                    <span
                                        class="description">{{ 'Shared publicly - ' . date('h:i A', strtotime($value->created_at)) . ' ' . time_ago(strtotime($value->created_at)) }}</span>
                                    <span
                                        class="description text-danger">{{ 'Post Closed On - ' . date('d-M-Y h:i A', strtotime(($value->deadline))) }}</span>
                                </div>
                                {{-- <div class="float-right">
                            <h6 class="mb-0">Status</h6>
                            <span class="text-success">Success</span>
                        </div> --}}
                                <!-- /.user-block -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pb-0">
                                <!-- post text -->
                                <h5 class="text-emphasis">{!! $value->title !!}</h5>
                                <p>{!! $value->description !!}</p>

                                <!-- Social sharing buttons -->
                                <button type="button" class="btn btn-default btn-sm"><i @if ($value['upvotes']->count() > 0)
                                    class="far fa-thumbs-up color-blue"
                                @endif class="far fa-thumbs-up"></i><span>{{ ' '.$value['upvotes']->count() }}</span> Upvotes</button>
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
    @endsection
