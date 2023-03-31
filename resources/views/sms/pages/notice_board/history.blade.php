@extends('sms.pages.notice_board.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">
            <form action="" method="get">
                <div class="row mt-2">
                    <div class="col-md-3">
                        <input type="text" name="keywords" class="form-control" placeholder="Search" value="{{ old('keywords') }}" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="from" class="form-control date" placeholder="From Date" value="{{ old('from') }}" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="to" class="form-control date" placeholder="To Date" value="{{ old('to') }}" />
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
            @if (actual_link() != url('notice-board/history'))
                <div class="col-md-12 mt-2">
                    <h6 class="text-emphasis">{{ $data['message'] }}</h6>
                </div>
                @foreach ($data['notices'] as $value)
                    <div class="col-md-12 mt-2">
                        <!-- Box Comment -->
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" src="{{ url('assets/images/' . $value['user']->profile_pic) }}"
                                        alt="User Image">
                                    <span class="username"><a
                                            href="#">{{ $value['user']->first_name . ' ' . $value['user']->last_name }}</a></span>
                                    <span
                                        class="description">{{ 'Shared publicly - ' . date('d-M-Y h:i A', strtotime($value->created_at)) }}</span>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pb-0">
                                <!-- post text -->
                                <h5 class="text-emphasis">{!! $value->title !!}</h5>
                                <p>{!! $value->description !!}</p>
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
