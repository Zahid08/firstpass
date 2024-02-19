@extends('frontend.layouts.login',['mainclass'=>'login_form'])
@section('content')
    <div class="container-fluid">
        <div class="row registration_row">
            <div class="col-md-6 px-0 d-flex align-items-end singup_banner_img">
                <img src="{!! url ('frontend_assets/images/login_banner_mob.jpg') !!}" class="img-fluid d-block d-md-none" alt="">
                <div class="content_block">
                    <h2 class="heading">Check Your Email</h2>
                    <p>To receive your reset password</p>
                    <p>If not received , Check your spam.</p>
                </div>
            </div>
            <div class="col-md-6 px-0 form_col_bg d-flex align-items-center">
                <div class="form_content_box mx-auto w-100">
                    <div class="form_header text-center">
                        <a href="{{URL::to ('/')}}"><img class="site_logo mb-1" src="{!! url ('frontend_assets/images/site-logo.png') !!}" alt=""></a>
                        <hr>
                        <div class="form_title">
                            <h2 class="heading">Recover Password</h2>
                        </div>
                    </div>
                    <div class="form_body">
                        @if (session('status'))
                            <p class="alert alert-success">{{ session('status') }}</p>
                        @endif

                        <form class="form-horizontal m-t-20" id="loginform" method="POST" action="{{ route('password.email') }}" style="display: block;">
                            @csrf
                            <div class="col-md-12 mt-0">
                                <label for="emailaddress" class="form-label">Email Address*</label>
                                <input type="email"  name="email" class="form-control email_icon @error('email') is-invalid @enderror" id="emailaddress" placeholder="demo232@gmail.com"  autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert" style="display: block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
