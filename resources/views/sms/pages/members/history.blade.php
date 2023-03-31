@extends('sms.pages.members.layout')

@section('page-content')
    <div class="tab-content" id="custom-content-above-tabContent">
        <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel"
            aria-labelledby="custom-content-above-home-tab">

            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Moved Members</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Landlord/Tenant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['users'] as $value)
                                <tr>
                                    <td>{{ $value->first_name }}</td>
                                    <td>{{ $value->last_name }}</td>
                                    <td>{{ $value->mobile_number }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->type }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('members.profile', $value->id) }}" role="button" class="btn bg-gradient-primary">View</a>
                                        <form action="{{ route('members.restore') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $value->id }}">
                                            <button type="submit" class="btn bg-gradient-info ms-1">Restore</a>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
        @endsection
