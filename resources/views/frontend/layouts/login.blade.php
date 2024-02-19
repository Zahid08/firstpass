<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{--Load All Css Link--}}
    <link rel="shortcut icon" href="{!! url ('frontend_assets/images/favicon.png') !!}" type="image/x-icon">
    <link href="{!! url ('frontend_assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{!! url ('frontend_assets/css/style.css') !!}">
    <link href="{{ url('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{!! url ('frontend_assets/css/devStyle.css') !!}">
    <script>
        var base_url = "https://firstpass.com.au/new-dev/";
    </script>
</head>
<body>
<div class="preloader">
    <div id="ht-preloader">
        <div class="clear-loader">
            <div class="loader">
                <div class="loader-div">
                    <img class="img-center" src="{!! url ('frontend_assets/images/favicon.png') !!}" alt="loader">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="layout-wrapper">

    <!-- main-container -->
    {{--Main Content Area--}}
    <main class="registration_bg {{$mainclass}}">
        @yield('content')
    </main>

    @if($mainclass=='faq_page')
        @include('frontend.layouts.partials.footer')
    @endif
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="{!! url ('frontend_assets/js/intlInputPhone.min.js') !!}"></script>
<script src="{!! url ('frontend_assets/js/bootstrap.bundle.min.js') !!}"></script>
<script src="{{ url('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{!! url ('frontend_assets/js/custom.js') !!}"></script>
<script>
    $(document).ready(function() {
        $('.phone-number-input').intlInputPhone();
    });
</script>
<script>
    window.onload = function() {
        $(".preloader").delay(1600).fadeOut("slow");
    };

    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        input = $(this).parent().find("input");
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    // defult lock icon and input fill than icon change to eye icon.
    if($('.password_icon_none').val() !='' ) {
        $('.password_icon_none ~ .toggle-password').addClass('input-has-value');
        $(this).addClass('bg_none');
    }
    $('.password_icon_none').blur(function(){
        if($('.password_icon_none').val() !='' ) {
            $('.password_icon_none ~ .toggle-password').addClass('input-has-value');
            $(this).addClass('bg_none');
        }else{
            $('.password_icon_none ~ .toggle-password').removeClass('input-has-value');
            $(this).removeClass('bg_none');
        }
    });

</script>
@yield('scripts')
</body>
</html>
