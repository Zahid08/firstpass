<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="shortcut icon" href="<?php echo url ('frontend_assets/images/favicon.png'); ?>" type="image/x-icon">
    <link href="<?php echo url ('frontend_assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
          integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo url ('frontend_assets/css/style.css'); ?>">
    <link href="<?php echo e(url('assets/libs/sweetalert2/dist/sweetalert2.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo url ('frontend_assets/css/devStyle.css'); ?>">
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
                    <img class="img-center" src="<?php echo url ('frontend_assets/images/favicon.png'); ?>" alt="loader">
                </div>
            </div>
        </div>
    </div>
</div>


<div class="layout-wrapper">

    <!-- main-container -->
    
    <main class="registration_bg <?php echo e($mainclass); ?>">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php if($mainclass=='faq_page'): ?>
        <?php echo $__env->make('frontend.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="<?php echo url ('frontend_assets/js/intlInputPhone.min.js'); ?>"></script>
<script src="<?php echo url ('frontend_assets/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo e(url('assets/libs/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo url ('frontend_assets/js/custom.js'); ?>"></script>
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
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\xampp7.4.9\htdocs\firstpass\resources\views/frontend/layouts/login.blade.php ENDPATH**/ ?>