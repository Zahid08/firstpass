@extends('frontend.layouts.login',['mainclass'=>'login_form'])
@section('content')
<div class="container-fluid">
    <div class="row registration_row">
        <div class="col-md-6 px-0 d-flex align-items-end singup_banner_img">
            <img src="{!! url ('frontend_assets/images/login_banner_mob.jpg') !!}" class="img-fluid d-block d-md-none" alt="">
            <div class="content_block">
                <h2 class="heading">Welcome Back</h2>
                <p>It’s great to see you again.<br>
                    Login to manage your booking.</p>
            </div>
        </div>
        <div class="col-md-6 px-0 form_col_bg d-flex align-items-center">
            <div class="form_content_box mx-auto w-100">
                <div class="form_header text-center">
                    <a href="{{URL::to ('/')}}"><img class="site_logo mb-1" src="{!! url ('frontend_assets/images/site-logo.png') !!}" alt=""></a>
                    <hr>
                    <div class="form_title">
                        <h2 class="heading">Sign in</h2>
                    </div>
                </div>
                <div class="form_body">
                    <form class="row gx-4 gx-md-5" id="loginform" method="POST" action="{{ route('login') }}">
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

                        <div class="col-md-12">
                            <label for="password" class="form-label">Password*</label>
                            <div class="position-relative">
                                <input type="password" name="password" class="form-control password_icon password_icon_none  @error('password') is-invalid @enderror" id="password" value="" placeholder="*****" required autocomplete="current-password" aria-label="Password" aria-describedby="basic-addon1">
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert" style="display: block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-12 d-flex justify-content-between w-100 mt-3 password_reset">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="remember_check">
                                <label class="form-check-label" for="remember_check">
                                    Remember me
                                </label>
                            </div>
                            <div class="form-check reset_pass">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-danger"> Forgot password?</a>
                                @endif

                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                            <p class="account-nots text-center">Want to instruct with us? <a href="{{URL::to ('/register')}}" class="text-decoration-none">Register here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        /* -------------------------------------------------------------------------- */
        /*                                 Login page                                 */
        /* -------------------------------------------------------------------------- */

    </script>
@endsection
