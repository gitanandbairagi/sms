@extends('main.layout.layout')

@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Contact Us Section --}}
        <div class="container pt-4" id="sectionCheckPrices">
            <div class="row">
                <div class="col-sm-12 px-4">
                    {{-- session flash success and error alerts --}}
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h5 class="card-header text-primary">Create Admin Account</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <form id="addMemberForm" action="{{ route('admin.signup.post') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm-12 my-1">
                                            <label>Personal Information</label>
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="first_name" type="text" class="form-control"
                                                placeholder="First name" value="{{ old('first_name') }}">
                                            @error('first_name')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="last_name" type="text" class="form-control"
                                                placeholder="Last name" value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="email" type="email" class="form-control" placeholder="Email"
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <select name="gender" class="custom-select">
                                                <option value="" selected>Choose Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('gender')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="dob" type="text" class="form-control date"
                                                placeholder="Date of Birth" value="{{ old('dob') }}">
                                            @error('dob')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="mobile_number" type="text" class="form-control"
                                                placeholder="Mobile Number" value="{{ old('mobile_number') }}">
                                            @error('mobile_number')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="aadhaar_number" type="text" class="form-control"
                                                placeholder="Aadhaar Number" value="{{ old('aadhaar_number') }}">
                                            @error('aadhaar_number')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="profile_pic" type="file" class="custom-file-input"
                                                id="customFile" value="{{ old('profile_pic') }}">
                                            <label class="custom-file-label" for="customFile">Choose picture</label>
                                            @error('profile_pic')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <select name="type" class="custom-select" id="inlineFormCustomSelectPref">
                                                <option value="" selected>Choose Type</option>
                                                <option value="landlord">Landlord</option>
                                            </select>
                                            @error('type')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="password" type="password" class="form-control"
                                                placeholder="Password | Minimum 8 characters" value="{{ old('password') }}">
                                            @error('password')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="password_confirmation" type="password"
                                                class="form-control" placeholder="Confirm Password"
                                                value="{{ old('password_confirmation') }}">
                                            @error('password_confirmation')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <label>Society Information</label>
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="name" type="text" class="form-control"
                                                placeholder="Society Name" value="{{ old('name') }}">
                                            @error('name')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="maintenance_amount" type="number" class="form-control"
                                                placeholder="Maintenance Amount | Don't Worry, You Can Change it Later" value="{{ old('maintenance_amount') }}" min="1">
                                            @error('maintenance_amount')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <label>Society Address</label>
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="area" type="text" class="form-control" placeholder="Area"
                                                value="{{ old('area') }}">
                                            @error('area')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="landmark" type="text" class="form-control"
                                                placeholder="Landmark" value="{{ old('landmark') }}">
                                            @error('landmark')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="city" type="text" class="form-control" placeholder="City"
                                                value="{{ old('city') }}">
                                            @error('city')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <input name="state" type="text" class="form-control"
                                                placeholder="State" value="{{ old('state') }}">
                                            @error('state')
                                                <label class="text-danger mt-1 mb-1">{{ $message }}</label>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 my-1">
                                            <button type="submit" class="btn btn-primary w-100">Create Account</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{ url('assets/images/clay-elliot-mpDV4xaFP8c-unsplash.jpg') }}"
                                    alt="admin_picture" class="img-fluid" style="border-radius: 5px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
