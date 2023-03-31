@extends('sms.pages.settings.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">
            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">My Profile</h3>
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
                                    <td>Profile Pic</td>
                                    <td><img src="{{ url('assets/images/'.$data['user']->profile_pic) }}" alt="profile_pic" height="100px" width="100px"></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td>{{ $data['user']->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>{{ $data['user']->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td>{{ $data['user']->mobile_number }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $data['user']->email }}</td>
                                </tr>
                                <tr>
                                    <td>Type</td>
                                    <td>{{ $data['user']->type }}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth <br> (yyyy/mm/dd)</td>
                                    <td>{{ $data['user']->dob }}</td>
                                </tr>
                                <tr>
                                    <td>Aadhaar Number</td>
                                    <td>{{ $data['user']->aadhaar_number }}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>{{ $data['user']->role }}</td>
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
@endsection

@section('script')
@endsection
