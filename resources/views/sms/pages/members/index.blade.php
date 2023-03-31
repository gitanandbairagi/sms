@extends('sms.pages.members.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">
                Add Member
            </button>
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Active Members</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Profile Pic</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['users'] as $value)
                                <tr>
                                    <td><img src="{{ url('assets/images/'.$value->profile_pic) }}" alt="profile_pic" height="100px" width="100px"></td>
                                    <td>{{ $value->first_name }}</td>
                                    <td>{{ $value->last_name }}</td>
                                    <td>{{ $value->mobile_number }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->type }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('members.profile', $value->id) }}" role="button" class="btn bg-gradient-primary">View</a>
                                        <form action="{{ route('members.move') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                            <button type="submit" class="btn bg-gradient-danger ms-1">Move</a>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Profile Pic</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    {{-- Add Member Modal --}}
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="addMemberForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-6 my-1">
                                <input name="first_name" type="text" class="form-control" placeholder="First name">
                            </div>
                            <div class="col-sm-6 my-1">
                                <input name="last_name" type="text" class="form-control" placeholder="Last name">
                            </div>
                            <div class="col-sm-6 my-1">
                                <input name="email" type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col-sm-6 my-1">
                                <select name="gender" class="custom-select">
                                    <option value="{{ false }}" selected>Choose Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-6 my-1">
                                <input name="dob" type="text" class="form-control date" placeholder="Date of Birth">
                            </div>
                            <div class="col-sm-6 my-1">
                                <input name="mobile_number" type="text" class="form-control" placeholder="Mobile Number">
                            </div>
                            <div class="col-sm-6 my-1">
                                <input name="aadhaar_number" type="text" class="form-control"
                                    placeholder="Aadhaar Number">
                            </div>
                            <div class="col-sm-6 my-1">
                                <input name="profile_pic" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose picture</label>
                            </div>
                            <div class="col-sm-6 my-1">
                                <select name="type" class="custom-select" id="inlineFormCustomSelectPref">
                                    <option value="{{ false }}" selected>Choose Type</option>
                                    <option value="landlord">Landlord</option>
                                    <option value="tenant">Tenant</option>
                                </select>
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
    {{-- /.Add Member Modal --}}
@endsection

@section('script')
    <script>
        let btn = document.getElementById('btnFetch');
        btn.addEventListener('click', (e)=> {
            let bindData = {
                btnId: '#'+btn.id,
                modalId: '#addMemberModal',
                route: "{{ route('members.add') }}",
                method: "POST",
                formId: "#addMemberForm",
                csrfToken: "{{ csrf_token() }}",
            };
            server_validation(bindData);
        });
    </script>
@endsection
