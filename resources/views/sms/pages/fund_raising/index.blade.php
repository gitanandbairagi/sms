@extends('sms.pages.fund_raising.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">

            @if (session('role') == 'admin')
                <div class="col-md-3 d-flex">
                    @if (isset($data['work']))
                        <span data-toggle="tooltip" data-placement="bottom"
                            title="A subject of fund raising is currently posted. You can post after it expires.">
                            <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                                data-target="#addFundRaisingModal" disabled>
                                Post to Get Fund
                            </button>
                        </span>
                    @else
                        <button type="button" class="btn btn-default bg-gradient-primary" data-toggle="modal"
                            data-target="#addFundRaisingModal">
                            Post to Get Fund
                        </button>
                    @endif
                    @if (isset($data['work']))
                        <form action="{{ route('fund.raising.move') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data['work']->id }}">
                            <span data-toggle="tooltip" data-placement="bottom"
                                title="Explicitly move subject before expiry.">
                                <button type="submit" class="btn btn-default bg-gradient-danger">
                                    Move Subject
                                </button>
                            </span>
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

            @if (isset($data['work']))
                <div class="col-md-12 mt-2">
                    <!-- Box Comment -->
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle"
                                    src="{{ url('assets/images/' . $data['work']['user']->profile_pic) }}" alt="User Image">
                                <span class="username"><a
                                        href="#">{{ $data['work']['user']->first_name . ' ' . $data['work']['user']->last_name }}</a></span>
                                <span
                                    class="description">{{ 'Shared publicly - ' . date('h:i A', strtotime($data['work']->created_at)) . ' ' . time_ago(strtotime($data['work']->created_at)) }}</span>
                                <span
                                    class="description text-danger">{{ 'Last Date - ' . date('d-M-Y', strtotime($data['work']->deadline)) }}</span>
                                <input type="hidden" value="{{ $data['work']->deadline }}" id="getDate">
                            </div>
                            <div class="user-block float-right">
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
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#addPaymentModal"><i class="far fa-credit-card-alt"></i> I want to
                                help</button>
                            <span class="text-success ms-2">{{ 'Collection byfar: ' . $data['collection'] }}</span>
                            <span
                                class="float-right text-success">{{ $data['members_helped'] . ' Member(s) Helped' }}</span>
                        </div>
                        <!-- /.card-body -->
                        <p class="card-body py-0 text-muted comment-button mt-2 ms-1 btn-sm"><i
                                class="fa fa-comment-o"></i>{{ ' ' . $data['comments_count'] . ' comments' }}</p>
                        {{-- comments --}}
                        <div class="card-footer card-comments comment-block">
                            @foreach ($data['comments'] as $value)
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm"
                                        src="{{ url('assets/images/' . $value['user']->profile_pic) }}" alt="profile_pic">

                                    <div class="comment-text">
                                        <span class="username">
                                            {{ $value['user']->first_name . ' ' . $value['user']->last_name }}
                                            <span
                                                class="text-muted float-right">{{ time_ago(strtotime($value->created_at)) }}</span>
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
                            <form action="{{ route('fund.raising.comment') }}" method="POST">
                                @csrf
                                <img class="img-fluid img-circle img-sm"
                                    src="{{ url('assets/images/' . session('profile_pic')) }}" alt="profile_pic">
                                <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                    <input type="hidden" name="work_id" value="{{ $data['work']->id }}">
                                    <input type="text" name="description" class="form-control form-control-sm"
                                        max="255" placeholder="Press enter to post comment">
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

    {{-- Add Fund Raising Modal --}}
    <div class="modal fade" id="addFundRaisingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="addFundRaisingForm" enctype="multipart/form-data">
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
                        <button id="btnFetchFundRaising" type="button" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Add Fund Raising Modal --}}

    {{-- Add Payment Modal --}}
    @if (isset($data['work']))
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="addPaymentForm" enctype="multipart/form-data">
                    @csrf
                    <input name="reason" type="hidden" class="form-control" value="fund_raising">
                    <input name="id" type="hidden" class="form-control" value="{{ $data['work']->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pay/Donate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-12 my-1">
                                <input name="amount" type="number" class="form-control"
                                    placeholder="Amount in INR (Indian Currency)" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetchPayment" type="button" class="btn btn-primary btn-block">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    {{-- /.Add Payment Modal --}}
@endsection

@section('script')
    <script>
        let data = {
            0: {
                btnId: "btnFetchFundRaising",
                modalId: "addFundRaisingModal",
                formId: "addFundRaisingForm",
                route: "{{ route('fund.raising.add') }}"
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
