@extends('sms.pages.settings.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Credentials</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="updateEmailForm" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-sm-6 my-1">
                                    <input name="email" type="email" class="form-control" value="{{ $data['user']->email }}">
                                </div>
                                <div class="col-sm-6 my-1"></div>
                                <div class="col-sm-2 my-1">
                                    <button id="btnFetchUpdateEmail" type="button" class="btn btn-primary btn-block btn-sm">Update Email</button>
                                </div>
                            </div>
                    </form>
                    <form id="updatePasswordForm" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-sm-6 my-1">
                                    <input name="current_password" type="password" class="form-control" placeholder="Current Password">
                                </div>
                                <div class="col-sm-6 my-1"></div>
                                <div class="col-sm-6 my-1">
                                    <input name="password" type="password" class="form-control" placeholder="New Password | Must be grater than 8 characters">
                                </div>
                                <div class="col-sm-6 my-1"></div>
                                <div class="col-sm-6 my-1">
                                    <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="col-sm-6 my-1"></div>
                                <div class="col-sm-2 my-1">
                                    <button id="btnFetchUpdatePassword" type="button" class="btn btn-primary btn-block btn-sm">Update Password</button>
                                </div>
                            </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('script')
<script>
    let data = {
        0: {
            btnId: "btnFetchUpdateEmail",
            modalId: null,
            formId: "updateEmailForm",
            route: "{{ route('settings.update.email') }}"
        },
        1: {
            btnId: "btnFetchUpdatePassword",
            modalId: null,
            formId: "updatePasswordForm",
            route: "{{ route('settings.update.password') }}"
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
