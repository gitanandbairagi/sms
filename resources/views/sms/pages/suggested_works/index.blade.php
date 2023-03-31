@extends('sms.pages.suggested_works.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">

            <div class="col-md-3">
                @if (isset($data['work']))
                    <span data-toggle="tooltip" data-placement="bottom"
                        title="A work suggestion is currently posted. You can post after it expires.">
                        <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                            data-target="#addSuggestedWorkModal" disabled>
                            Add Work Suggestion
                        </button>
                    </span>
                @else
                    <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                        data-target="#addSuggestedWorkModal">
                        Add Work Suggestion
                    </button>
                @endif
            </div>

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
            @if (isset($data['work']))
            <div class="col-md-12 mt-2">
                <!-- Box Comment -->
                <div class="card card-widget">
                    <div class="card-header">
                        <div class="user-block">
                            <img class="img-circle" src="{{ url('assets/images/' . $data['work']['user']->profile_pic) }}"
                                alt="profile_pic">
                            <span class="username"><a
                                    href="#">{{ $data['work']['user']->first_name . ' ' . $data['work']['user']->last_name }}</a></span>
                            <span
                                class="description">{{ 'Shared publicly - ' . date('h:i A', strtotime($data['work']->created_at)) . ' ' . time_ago(strtotime($data['work']->created_at)) }}</span>
                            <span
                                class="description text-danger">{{ 'Last Date - ' . date('d-M-Y', strtotime($data['work']->deadline)) }}</span>
                            <input type="hidden" value="{{ $data['work']->deadline }}" id="getDate">
                        </div>
                        <div class="float-right">
                            <h6 class="text-danger mb-0">Time Left</h6>
                            <span id="cd-days">00</span> Days
                            <span id="cd-hours">00</span> Hours
                            <span id="cd-minutes">00</span> Minutes
                            <span id="cd-seconds">00</span> Seconds
                        </div>
                        <!-- /.user-block -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pb-0">
                        <!-- post text -->
                        <h5 class="text-emphasis">{{ $data['work']->title }}</h5>
                        <p>{{ $data['work']->description }}</p>

                        <!-- Social sharing buttons -->
                        <button type="button" id="{{ 'upvoteBtn'.$data['work']->id }}" class="btn btn-default btn-sm upvote"><i @if ($data['upvote_user'] == true)
                            class="far fa-thumbs-up color-blue"
                        @endif class="far fa-thumbs-up"></i><span>{{ ' '.$data['upvotes_count'] }}</span> Upvotes</button>
                    </div>
                    <!-- /.card-body -->
                    <p class="card-body py-0 text-muted comment-button mt-2 ms-1 btn-sm"><i class="fa fa-comment-o"></i>{{ ' ' . $data['comments_count'] . ' comments' }}</p>
                    <div class="card-footer card-comments comment-block">
                        @foreach ($data['comments'] as $value)
                        <div class="card-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="{{ url('assets/images/'.$value['user']->profile_pic) }}"
                                alt="profile_pic">

                            <div class="comment-text">
                                <span class="username">
                                    {{ $value['user']->first_name.' '.$value['user']->last_name }}
                                    <span class="text-muted float-right">{{ time_ago(strtotime($value->created_at)) }}</span>
                                </span><!-- /.username -->
                                {{ $value->description }}
                            </div>
                            <!-- /.comment-text -->
                        </div>
                        <!-- /.card-comment -->
                        @endforeach
                    </div>
                    <!-- /.card-footer -->
                    <div class="card-footer">
                        <form action="{{ route('suggested.works.comment') }}" method="POST">
                            @csrf
                            <img class="img-fluid img-circle img-sm"
                                src="{{ url('assets/images/'.session('profile_pic')) }}" alt="profile_pic">
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push">
                                <input type="hidden" name="work_id" value="{{ $data['work']->id }}">
                                <input type="text" name="description" class="form-control form-control-sm"
                                    placeholder="Press enter to post comment">
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            @else
                <div class="col-md-12 mt-2">
                    <h6 class="text-muted text-emphasis">No active subject</h6>
                </div>
            @endif
        </div>
    </div>

    {{-- Add Suggested Work Modal --}}
    <div class="modal fade" id="addSuggestedWorkModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="addSuggestedWorkForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Subject for Fund Raising</h5>
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
                                <input name="deadline" type="text" class="form-control datetime"
                                    placeholder="Deadline">
                            </div>
                            <div class="col-sm-12 my-1">
                                <textarea name="description" cols="30" rows="10" class="form-control">Description</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetchSuggestedWork" type="button" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Add Suggested Work Modal --}}
@endsection

@section('script')
    <script>
        let upvoteBtn = document.querySelectorAll('.upvote');
        Array.from(upvoteBtn).forEach(btn => {
            btn.addEventListener('click', (e)=> {
                upvote({
                    element: e,
                    method: "POST",
                    route: "{{ route('suggested.works.upvote') }}",
                    csrfToken: "{{ csrf_token() }}",
                }); // custom function
            })
        });

        let data = {
            0: {
                btnId: "btnFetchSuggestedWork",
                modalId: "addSuggestedWorkModal",
                formId: "addSuggestedWorkForm",
                route: "{{ route('suggested.works.add') }}"
            },
            1: {
                btnId: "btnFetchPayment",
                formId: "addPaymentForm",
                modalId: 'addPaymentModal',
                route: "{{ route('payment.cashfree.vindicate') }}"
            }
        }
        for (const key in data) {
            let btn = document.getElementById(data[key]['btnId']);
            btn.addEventListener('click', (e) => {
                let bindData = {
                    btnId: '#' + data[key]['btnId'],
                    modalId: '#' + data[key]['modalId'],
                    route: data[key]['route'],
                    method: "POST",
                    formId: "#" + data[key]['formId'],
                    csrfToken: "{{ csrf_token() }}",
                };
                server_validation(bindData);
            });
        }
    </script>
@endsection
