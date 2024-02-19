
<?php $__env->startSection('content'); ?>
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
                <img src="<?php echo url('frontend_assets/images/login_banner_mob.jpg'); ?>" class="img-fluid d-block d-md-none" alt="">
                <div class="content_block">
                    <h2 class="heading">It’s Simple and easy to get started</h2>
                    <p>No contract, no exclusivity & no hidden fees.<br>
                        Please enter your details and we will be in touch Shortly.</p>
                </div>
            </div>
            <div class="col-md-6 px-0 form_col_bg d-flex align-items-center">
                <div class="form_content_box mx-auto w-100">
                    <div class="form_header text-center">
                        <a href="<?php echo e(URL::to ('/')); ?>"><img class="site_logo mb-1" src="<?php echo url('frontend_assets/images/site-logo.png'); ?>" alt=""></a>
                        <hr>
                        <div class="form_title">
                            <h2 class="heading">Instructor Registration</h2>
                        </div>
                    </div>
                    <div class="form_body">
                        <form class="row gx-4 gx-md-5 instructor-reg_form" id="reg_form">
                            <?php echo csrf_field(); ?>
                            <div class="col-md-6 col-6 mt-0">
                                <label for="fname" class="form-label">First Name*</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="fname" placeholder="Your first name"
                                       name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus
                                >
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6 col-6 mt-0">
                                <label for="lname" class="form-label">Last Name*</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="lname" placeholder="Your last name"
                                       name="lname" value="<?php echo e(old('lname')); ?>" required autocomplete="lname" autofocus
                                >
                                <?php $__errorArgs = ['lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-12">
                                <label for="emailaddress" class="form-label">Email Address*</label>
                                <input type="email" class="form-control email_icon <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="emailaddress" placeholder="demo232@gmail.com"
                                       name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email"
                                >
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                               <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-12">
                                <label for="phonenum" class="form-label">Phone*</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="phone" placeholder="+61 0433111222"
                                       name="name" value="<?php echo e(old('phone')); ?>"  autocomplete="phone" autofocus>
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-12">
                                <label for="postvode" class="form-label">Postcode*</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="postvode" placeholder="XXXX"
                                       name="postcode" value="<?php echo e(old('postcode')); ?>" required autocomplete="postcode"
                                >
                                <?php $__errorArgs = ['postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-12 custome-radio-wrapper">
                                <label for="fname" class="form-label w-100">Car Transmission</label>
                                <div class="form-check form-check-inline mt-0">
                                    <input class="form-check-input custom-radio" type="radio" name="vehicle_transmissions" id="AutoOption" value="auto" checked <?php if(old('vehicle_transmissions') == "auto"): ?> checked <?php endif; ?>>
                                    <label class="mb-0 form-check-label" for="AutoOption">Auto</label>
                                </div>
                                <div class="form-check form-check-inline mt-0">
                                    <input class="form-check-input custom-radio" type="radio" name="vehicle_transmissions" id="ManualOption" value="manual" <?php if(old('vehicle_transmissions') == "manual"): ?> checked <?php endif; ?>>
                                    <label class="mb-0 form-check-label" for="ManualOption">Manual</label>
                                </div>
                                <div class="form-check form-check-inline mt-0">
                                    <input class="form-check-input custom-radio" type="radio" name="vehicle_transmissions" id="BothOption" value="both" <?php if(old('vehicle_transmissions') == "both"): ?> checked <?php endif; ?>>
                                    <label class="mb-0 form-check-label" for="BothOption">Both</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Leave A Message</label>
                                <textarea name="" class="form-control" placeholder="Message">
                                    <?php echo old('message'); ?>

                                </textarea>
                            </div>
                            <div class="col-12 form_submit_button">
                                <button type="submit" class="btn btn-primary w-100">Get Started</button>
                                <p class="account-nots text-center">Already have an account? <a href="<?php echo e(URL::to ('/login')); ?>" class="text-decoration-none">Sign In</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script>

        $(document).ready(function(){

            $('#reg_form').submit(function (){

                $('.preloader').show();

                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo e(Route('register_inst')); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.login', ['mainclass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>