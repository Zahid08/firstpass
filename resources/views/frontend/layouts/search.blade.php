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
    <link rel="stylesheet" href="{!! url ('frontend_assets/css/style.css') !!}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{!! url ('frontend_assets/css/global.css') !!}">

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

    @include('frontend.layouts.partials.header2')

    <!-- main-container -->
    {{--Main Content Area--}}
    <main>
        @yield('content')
    </main>

    @include('frontend.layouts.partials.footer')
    @include('frontend.layouts.partials.modal')
</div>

<!-- js file link -->
<script src="{!! url ('frontend_assets/js/jquery-3.7.0.min.js') !!}"></script>
<script src="{!! url ('frontend_assets/js/bootstrap.bundle.min.js') !!}"></script>
<script>
    function show_inf(id){
        $('.intl_conv, .your_car, .logbook, .driving_test').hide();
        $('.'+id).show();
        $('#info_modal').modal('show');
    }
</script>
<script>
    window.onload = function() {
        $(".preloader").delay(1600).fadeOut("slow");
    };
</script>
@yield('scripts')
</body>
</html>
