<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row registration_row">
            <div class="col-md-6 px-0 d-flex align-items-end singup_banner_img">
                <img src="<?php echo url ('frontend_assets/images/login_banner_mob.jpg'); ?>" class="img-fluid d-block d-md-none" alt="">
                <div class="content_block">
                    <h2 class="heading">Check Your Email</h2>
                    <p>To receive your reset password</p>
                    <p>If not received , Check your spam.</p>
                </div>
            </div>
            <div class="col-md-6 px-0 form_col_bg d-flex align-items-center">
                <div class="form_content_box mx-auto w-100">
                    <div class="form_header text-center">
                        <a href="<?php echo e(URL::to ('/')); ?>"><img class="site_logo mb-1" src="<?php echo url ('frontend_assets/images/site-logo.png'); ?>" alt=""></a>
                        <hr>
                        <div class="form_title">
                            <h2 class="heading">Recover Password</h2>
                        </div>
                    </div>
                    <div class="form_body">
                        <?php if(session('status')): ?>
                            <p class="alert alert-success"><?php echo e(session('status')); ?></p>
                        <?php endif; ?>

                        <form class="form-horizontal m-t-20" id="loginform" method="POST" action="<?php echo e(route('password.email')); ?>" style="display: block;">
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

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.login',['mainclass'=>'login_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>