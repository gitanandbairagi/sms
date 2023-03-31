@extends('sms.pages.notice_board.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">

            @if (session('role') == 'admin')
                <div class="col-md-3 d-flex">
                    <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                        data-target="#addNoticeModal">
                        Post a Notice
                    </button>
                    @if (isset($data['notice']))
                        <form action="{{ route('notice.board.move') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data['notice']->id }}">
                            <button type="submit" class="btn btn-default bg-gradient-danger">
                                Move Notice
                            </button>
                        </form>
                    @endif
                </div>
            @endif

            <div class="col-md-12">
                {{-- session flash success and error alerts --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                        <strong>Error</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            
            @if (isset($data['notice']))
                <div class="col-md-12 mt-2">
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle"
                                    src="{{ url('assets/images/' . $data['notice']['user']->profile_pic) }}" alt="User Image">
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
                </div>
            @endif
        </div>
    </div>
    {{-- Add Notice Modal --}}
    <div class="modal fade" id="addNoticeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="addNoticeForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Notice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-12 my-1">
                                <input name="title" type="text" class="form-control" placeholder="Title">
                            </div>
                            <div class="col-sm-12 my-1">
                                <textarea name="description" cols="30" rows="10" class="form-control">Description</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetch" type="button" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Add Notice Modal --}}
@endsection

@section('script')
    <script>
        let btn = document.getElementById('btnFetch');
        btn.addEventListener('click', (e) => {
            let bindData = {
                btnId: '#' + btn.id,
                modalId: '#addNoticeModal',
                route: "{{ route('notice.board.add') }}",
                method: "POST",
                formId: "#addNoticeForm",
                csrfToken: "{{ csrf_token() }}",
            };
            server_validation(bindData);
        });
    </script>
@endsection
