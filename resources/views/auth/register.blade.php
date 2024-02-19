@extends('frontend.layouts.login', ['mainclass' => ''])
@section('content')
    <style>
        .swal2-popup {
            display: none;
            position: relative;
            flex-direction: column;
            justify-content: center;
            width: 44em;
            max-width: 100%;
            padding: 5.25em;
        }
        div#swal2-content {
            font-size: 16px;
        }
        .swal2-popup .swal2-styled.swal2-confirm{
            font-size: 14px;
        }
        button.btn.btn-primary.w-100.disable{
            pointer-events: none;
            background: gray;
        }
    </style>
    <div class="container-fluid">
        <div class="row registration_row signup_form_main">
            <div class="col-md-6 px-0 d-flex align-items-end singup_banner_img">
                <img src="{!! url('frontend_assets/images/login_banner_mob.jpg') !!}" class="img-fluid d-block d-md-none" alt="">
                <div class="content_block">
                    <h2 class="heading">It’s Simple and easy to get started</h2>
                    <p>No contract, no exclusivity & no hidden fees.<br>
                        Please enter your details and we will be in touch Shortly.</p>
                </div>
            </div>
            <div class="col-md-6 px-0 form_col_bg d-flex align-items-center">
                <div class="form_content_box mx-auto w-100">
                    <div class="form_header text-center">
                        <a href="{{URL::to ('/')}}"><img class="site_logo mb-1" src="{!! url('frontend_assets/images/site-logo.png') !!}" alt=""></a>
                        <hr>
                        <div class="form_title">
                            <h2 class="heading">Instructor Registration</h2>
                        </div>
                    </div>
                    <div class="form_body">
                        <form class="row gx-4 gx-md-5 instructor-reg_form" id="reg_form">
                            @csrf
                            <div class="col-md-6 col-6 mt-0">
                                <label for="fname" class="form-label">First Name*</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="fname" placeholder="Your first name"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 col-6 mt-0">
                                <label for="lname" class="form-label">Last Name*</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" placeholder="Your last name"
                                       name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus
                                >
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="emailaddress" class="form-label">Email Address*</label>
                                <input type="email" class="form-control email_icon @error('email') is-invalid @enderror" id="emailaddress" placeholder="demo232@gmail.com"
                                       name="email" value="{{ old('email') }}" required autocomplete="email"
                                >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                               @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="phonenum" class="form-label">Phone*</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="+61 0433111222"
                                       name="name" value="{{ old('phone') }}"  autocomplete="phone" autofocus>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="postvode" class="form-label">Postcode*</label>
                                <input type="text" class="form-control @error('postcode') is-invalid @enderror" id="postvode" placeholder="XXXX"
                                       name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode"
                                >
                                @error('postcode')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 custome-radio-wrapper">
                                <label for="fname" class="form-label w-100">Car Transmission</label>
                                <div class="form-check form-check-inline mt-0">
                                    <input class="form-check-input custom-radio" type="radio" name="vehicle_transmissions" id="AutoOption" value="auto" checked @if(old('vehicle_transmissions') == "auto") checked @endif>
                                    <label class="mb-0 form-check-label" for="AutoOption">Auto</label>
                                </div>
                                <div class="form-check form-check-inline mt-0">
                                    <input class="form-check-input custom-radio" type="radio" name="vehicle_transmissions" id="ManualOption" value="manual" @if(old('vehicle_transmissions') == "manual") checked @endif>
                                    <label class="mb-0 form-check-label" for="ManualOption">Manual</label>
                                </div>
                                <div class="form-check form-check-inline mt-0">
                                    <input class="form-check-input custom-radio" type="radio" name="vehicle_transmissions" id="BothOption" value="both" @if(old('vehicle_transmissions') == "both") checked @endif>
                                    <label class="mb-0 form-check-label" for="BothOption">Both</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Leave A Message</label>
                                <textarea name="" class="form-control" placeholder="Message">
                                    {!! old('message') !!}
                                </textarea>
                            </div>
                            <div class="col-12 form_submit_button">
                                <button type="submit" class="btn btn-primary w-100">Get Started</button>
                                <p class="account-nots text-center">Already have an account? <a href="{{URL::to ('/login')}}" class="text-decoration-none">Sign In</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>

        $(document).ready(function(){

            $('#reg_form').submit(function (){

                $('.preloader').show();

                var data = new FormData(this);

                $.ajax({
                    url: "{{Route('register_inst')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            Swal.fire('Success', res.message, 'success');
                            $('#reg_form')[0].reset();
                        }else if(res.success == false){
                            Swal.fire('Warning!', res.message, 'error');
                        }

                        $('.preloader').hide();
                        $("button.btn.btn-primary.w-100").removeClass('disable');
                    },
                    error: function () {
                        $('.preloader').hide();
                        $("button.btn.btn-primary.w-100").removeClass('disable');
                    }

                });

                return false;
            });

        });


        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        $('form').submit(function () {
            $("button.btn.btn-primary.w-100").addClass('disable');
        })
    </script>
@endsection
