@extends('sms.pages.settings.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Society Profile</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Fields</th>
                                <th>Values</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>
                                    {{ $data['society']->name }}
                                    <button type="button" class="btn btn-sm bg-gradient-primary float-right"
                                        data-toggle="modal" data-target="#changeNameModal">
                                        Change
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Landmark</td>
                                <td>
                                    {{ $data['society']->landmark }}
                                    <button type="button" class="btn btn-sm bg-gradient-primary float-right"
                                        data-toggle="modal" data-target="#changeLandmarkModal">
                                        Change
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Area</td>
                                <td>{{ $data['society']->area }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{ $data['society']->city }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{ $data['society']->state }}</td>
                            </tr>
                            <tr>
                                <td>You connected with us on</td>
                                <td>{{ $data['society']->created_at }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fields</th>
                                <th>Values</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    {{-- Change Name Modal --}}
    <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="changeNameForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="key" value="name">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Society's Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-12 my-1">
                                <input name="value" type="text" class="form-control"
                                    value="{{ $data['society']->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetchChangeName" type="button" class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Change Name Modal --}}

    {{-- Change Landmark Modal --}}
    <div class="modal fade" id="changeLandmarkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="changeLandmarkForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="key" value="landmark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Society's Landmark</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-12 my-1">
                                <input name="value" type="text" class="form-control"
                                    value="{{ $data['society']->landmark }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnFetchChangeLandmark" type="button" class="btn btn-primary btn-block">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /.Change Landmark Modal --}}
@endsection

@section('script')
    <script>
        let data = {
            0: {
                btnId: "btnFetchChangeName",
                modalId: "changeNameModal",
                formId: "changeNameForm",
                route: "{{ route('settings.update.society') }}"
            },
            1: {
                btnId: "btnFetchChangeLandmark",
                modalId: "changeLandmarkModal",
                formId: "changeLandmarkForm",
                route: "{{ route('settings.update.society') }}"
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
