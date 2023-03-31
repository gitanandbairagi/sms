@extends('main.layout.layout')

@section('style')
    <style>
        .bg-image {
            background-image: url('assets/images/natalya-letunova-DLclPZyS_bs-unsplash.jpg');
            opacity: 0.8;
            background-repeat: no-repeat;
            width: 100%;
            height: 85vh;
        }

        .bg-solid-black {
            width: 100%;
            height: 85vh;
            background-color: black;
            opacity: 0.6;
        }

        .bg-image-content {
            position: relative;
            bottom: 300px;
            z-index: 5;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 bg-image px-0">
                    {{-- Render BG Image Here --}}
                    <div class="col-md-12 bg-solid-black">
                        {{-- Render BG Solid Black --}}
                    </div>
                </div>
                <div class="col-md-3 bg-image-content">
                    <div class="row">
                        <div class="col-md-12 my-1">
                            <h4 class="text-light">Join SMS and Manage Your Society like a Pro</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 bg-image-content">
                    <div class="row">
                        <div class="col-md-12 my-1">
                            <a class="btn btn-sm btn-primary btn-block" href="#sectionCheckPrices" role="button">Check
                                Prices</a>
                        </div>
                        <div class="col-md-12 my-1">
                            <a class="btn btn-sm btn-success btn-block" href="{{ route('login', 'member') }}"
                                role="button">SignIn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Check Prices Section --}}
        <div class="container pt-4" id="sectionCheckPrices">
            <div class="row">
                <div class="col-sm-12 px-4">
                    <h5 class="card-header text-primary">Check Prices</h5>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                            <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm" style="border-radius: 5px;">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Basic</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1>&#8377;499<small class="text-muted fw-light">/mo</small></h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>2 GB RAM included</li>
                                            <li>5 GB of storage</li>
                                            <li><del>Priority email support</del></li>
                                            <li><del>Phone call support</del></li>
                                            <li>Help center access 10AM - 05PM</li>
                                        </ul>
                                        <a href="{{ route('admin.signup') }}" role="button"
                                            class="w-100 btn btn-lg btn-primary">Get Now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm border-primary" style="border-radius: 5px;">
                                    <div class="card-header py-3 text-bg-primary border-primary">
                                        <h4 class="my-0 fw-normal">Advanced</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1>&#8377;999<small class="text-muted fw-light">/mo</small></h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>6 GB RAM included</li>
                                            <li>Smooth Surfing</li>
                                            <li>10 GB of storage</li>
                                            <li>Phone and email support</li>
                                            <li>Help center access 24*7</li>
                                        </ul>
                                        <a href="{{ route('admin.signup') }}" role="button"
                                            class="w-100 btn btn-lg btn-primary">Grab Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- About Us and Message Us Section --}}
        <div class="container pt-4" id="sectionAboutUs">
            <div class="row">
                <div class="col-sm-12 px-4">
                    <h5 class="card-header text-primary">About Us</h5>
                    <div class="card-body">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo molestias, tenetur libero
                            veritatis
                            eos asperiores earum unde itaque, minima, perspiciatis explicabo inventore animi odio. Omnis
                            voluptatibus laboriosam, nisi sed nobis assumenda impedit officiis nihil alias. Officia
                            voluptate libero ex optio itaque in exercitationem, recusandae aut iusto necessitatibus
                            obcaecati ullam nostrum.</p>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi quisquam esse, quam temporibus
                            maiores debitis, illum eveniet ea, labore inventore nostrum ad officiis omnis ex?</p>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium a praesentium ducimus
                            labore
                            veritatis et magni quibusdam aliquid, aliquam qui maiores odit facere placeat. Consequatur
                            veniam cupiditate voluptates? Quae sunt suscipit atque tempora neque deleniti possimus est
                            repudiandae? Eaque, voluptate soluta culpa laborum praesentium deleniti consequatur.</p>
                    </div>
                </div>
            </div>
            <div class="container pt-4" id="sectionContactUs">
                <div class="row">
                    <div class="col-sm-6 px-4">
                        <h5 class="card-header text-primary">Contact Us</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <h5 class="card-title">Email: </h5>
                                    <p class="card-text text-muted">support@sms.com</p>
                                    <h5 class="card-title">Phone: </h5>
                                    <p class="card-text text-muted">+91 7845842156</p>
                                    <h5 class="card-title">Address: </h5>
                                    <p class="card-text m-0 text-muted">Ram Bagh, </p>
                                    <p class="card-text m-0 text-muted">Indore, </p>
                                    <p class="card-text m-0 text-muted">Madhya Pradesh 451010</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 px-4">
                        <h5 class="card-header text-primary">Message Us</h5>
                        <div class="card-body">
                            <form id="messageUsForm" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 mb-1">
                                        <input class="form-control" type="text" placeholder="First Name" name="first_name">
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <input class="form-control" type="text" placeholder="Last Name" name="last_name">
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <input class="form-control" type="email" placeholder="Email" name="email">
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <input class="form-control" type="text" placeholder="Mobile Number" name="mobile_number">
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <textarea name="message" class="form-control" cols="30" rows="3">Write Here</textarea>
                                    </div>
                                    <div class="col-sm-12 mb-1">
                                        <button type="button" id="btnFetchMessageUs" class="btn btn-primary btn-block">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
<script>
    let data = {
        0: {
            btnId: "btnFetchMessageUs",
            modalId: null,
            formId: "messageUsForm",
            route: "{{ route('message.us') }}"
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
