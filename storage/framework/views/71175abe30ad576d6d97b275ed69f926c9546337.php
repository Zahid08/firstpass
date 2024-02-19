
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row registration_row">
        <div class="col-md-6 px-0 d-flex align-items-end singup_banner_img">
            <img src="<?php echo url ('frontend_assets/images/login_banner_mob.jpg'); ?>" class="img-fluid d-block d-md-none" alt="">
            <div class="content_block">
                <h2 class="heading">Welcome Back</h2>
                <p>It’s great to see you again.<br>
                    Login to manage your booking.</p>
            </div>
        </div>
        <div class="col-md-6 px-0 form_col_bg d-flex align-items-center">
            <div class="form_content_box mx-auto w-100">
                <div class="form_header text-center">
                    <a href="<?php echo e(URL::to ('/')); ?>"><img class="site_logo mb-1" src="<?php echo url ('frontend_assets/images/site-logo.png'); ?>" alt=""></a>
                    <hr>
                    <div class="form_title">
                        <h2 class="heading">Sign in</h2>
                    </div>
                </div>
                <div class="form_body">
                    <form class="row gx-4 gx-md-5" id="loginform" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12 mt-0">
                            <label for="emailaddress" class="form-label">Email Address*</label>
                            <input type="email"  name="email" class="form-control email_icon <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="emailaddress" placeholder="demo232@gmail.com"  autocomplete="email" autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                             <span class="invalid-feedback" role="alert" style="display: block">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-12">
                            <label for="password" class="form-label">Password*</label>
                            <div class="position-relative">
                                <input type="password" name="password" class="form-control password_icon password_icon_none  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" value="" placeholder="*****" required autocomplete="current-password" aria-label="Password" aria-describedby="basic-addon1">
                                <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                            </div>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert" style="display: block">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-12 d-flex justify-content-between w-100 mt-3 password_reset">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="remember_check">
                                <label class="form-check-label" for="remember_check">
                                    Remember me
                                </label>
                            </div>
                            <div class="form-check reset_pass">
                                <?php if(Route::has('password.request')): ?>
                                    <a href="<?php echo e(route('password.request')); ?>" class="text-danger"> Forgot password?</a>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                            <p class="account-nots text-center">Want to instruct with us? <a href="<?php echo e(URL::to ('/register')); ?>" class="text-decoration-none">Register here</a></p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.login',['mainclass'=>'login_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7.4.9\htdocs\firstpass\resources\views/auth/login.blade.php ENDPATH**/ ?>