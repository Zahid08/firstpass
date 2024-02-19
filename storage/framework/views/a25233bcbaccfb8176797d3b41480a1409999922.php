
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row registration_row">
            <div class="col-md-6 px-0 d-flex align-items-end singup_banner_img">
                <img src="<?php echo url('frontend_assets/images/login_banner_mob.jpg'); ?>" class="img-fluid d-block d-md-none" alt="">
                <div class="content_block">
                    <h2 class="heading">We Are Here To Help</h2>
                    <p>Our team would be pleased to assist you with<br>
                        any questions you may have.</p>
                </div>
            </div>
            <div class="col-md-6 px-0 form_col_bg d-flex align-items-center">
                <div class="form_content_box contact_box mx-auto w-100">
                    <div class="form_header text-center position-relative">
                        <a href="<?php echo e(URL::to ('/')); ?>"><img class="site_logo mb-1" src="<?php echo url('frontend_assets/images/site-logo.png'); ?>" alt=""></a>
                    </div>
                    <div class="form_body">
                        <div class="form_header text-center">
                            <div class="form_title">
                                <h2 class="heading">Contact Our Team</h2>
                            </div>
                        </div>
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                        <form class="row gx-4 gx-md-5 contact-form" id="contact-form" action="<?php echo e(route('save-contact-form')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="col-md-6 col-6 mt-0">
                                <label for="full-name" class="form-label">Full Name*</label>
                                <input type="text" class="form-control" id="full-name" placeholder="Your full name" name="f_name" required>
                            </div>
                            <div class="col-md-6 col-6 mt-0">
                                <label for="mobile-num" class="form-label">Mobile*</label>
                                <input type="tel" class="form-control" id="mobile-num" placeholder="04" name="mobile_number" required>
                            </div>
                            <div class="col-md-6 col-6">
                                <label for="fname" class="form-label">Email address*</label>
                                <input type="email" class="form-control" id="fname" placeholder="Your email address" name="email" required>
                            </div>
                            <div class="col-md-6 col-6">
                                <label for="post_code" class="form-label">Postcode*</label>
                                <input type="text" class="form-control" id="post_code" placeholder="Postcode" name="postcode" required>
                            </div>
                            <div class="col-md-12">
                                <label for="i_am_a" class="form-label">I am a</label>
                                <select class="form-control form-select form-select-lg" aria-label="Large select example" name="user_type" required>
                                    <option value="learner_driver">Learner Driver</option>
                                    <option value="driving_instructor">Driving Instructor</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="lname" class="form-label">Subject*</label>
                                <select class="form-control form-select form-select-lg" aria-label="Large select example" name="subject" required>
                                    <option selected>Select</option>
                                    <option value="general-enquiry">General Enquiry</option>
                                    <option value="prices-and-packages">Prices and Packages</option>
                                    <option value="driving-lessons">Driving Lessons</option>
                                    <option value="driving-test-packages">Driving Test Packages</option>
                                    <option value="reschedule-a-booking">Reschedule a Booking</option>
                                    <option value="overseas-licence">Overseas Licence</option>
                                    <option value="3">Cancel a booking</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Leave A Message</label>
                                <textarea class="form-control" placeholder="Tell us how we can help" required name="message"></textarea>
                            </div>
                            <div class="col-12 form_submit_button">
                                <button type="submit" class="btn btn-primary w-100 text-uppercase">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('#contact-form').submit(function (){
                alert("asdsad");
                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "<?php echo e(route('save-contact-form')); ?>",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success')
                                .then(function() {
                                    location.reload();
                                });
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });

            $('form').submit(function () {
                $("button.btn.btn-primary.w-100.text-uppercase").addClass('disable');
            })

        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layouts.login',['mainclass'=>'contact_form'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/frontend/contact/index.blade.php ENDPATH**/ ?>