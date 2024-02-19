
<?php $__env->startSection('content'); ?>
    <style>
        .hidden-show {
            display: none;
        }


        /* login form password hide & show */
        input.password_icon_none:focus{
            background-image:none;
        }
        input.password_icon_none:not([value=""]){
            background-color:#000;
        }
        .bg_none {
            background-image: none !important;
        }
        .toggle-password {
            display: none;
            color: #888d94;
            font-size: 20px;
            position: absolute;
            top: 50%;
            right: 25px;
            transform: translate(0%, -50%);
            cursor: pointer;
        }
        .toggle-password.input-has-value{
            display: block;
        }

        input.password_icon_none:focus ~ .toggle-password{
            display:block;
        }
        input[type="text"].password_icon_none {
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }

        @media  screen and (max-width:1200px) {
            .toggle-password {
                font-size: 16px;
                right: 21px;
            }
        }

        @media  screen and (max-width:992px) {
            .toggle-password {
                right: 18px;
            }
        }

        @media  screen and (max-width:767px) {
            .toggle-password {
                right: 21px;
            }
        }

        @media  screen and (max-width:575px) {
            .toggle-password {
                right: 16px;
            }
        }


    </style>
    <?php
    $total=0;
    $hour=1;
    $testPackagePricing=0;
    $search_step_2 = json_decode($search->step_2);

    $checkTestPackageStatus=false;
    $previousRate=0;
    $discount=0;

    $search_step_3 = json_decode($search->step_3);
    $previousRate   =$search_step_3->hourly_rate;
    $discount       =$search_step_3->discount;
    $total          =$search_step_3->total;
    $hour           = @$search_step_3->hour;

    if( ($search_step_2 && in_array('test', $search_step_2))){
        $checkTestPackageStatus=true;
    }
    ?>

    <!-- ---------------------- top Banner Section Start ----------------------- -->
    <section class="addtocart_top_banner">
    </section>
    <!-- ---------------------- Step choose Section Start ---------------------- -->
    <section class="step_choose-sec">
        <div class="step_choose_wrapper">
            <div class="step_choose_tab">
                <a href="javascript:history.back()" class="step_back_span back_ancor">
                    <img src="<?php echo url('frontend_assets/images/back-arrow.svg'); ?>" alt=""><span>Back</span>
                </a>
                <div class="step_tab_img">
                    <img class="img-fluid" src="<?php echo url('frontend_assets/images/step-tabs-3.svg'); ?>" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- ---------------------- Add To Cart Section Start ---------------------- -->
    <section class="add_cart_sec">
        <div class="add_cart_wrapper">
            <div class="row">
                <div class="col-md-6">
                    <div class="your_cart_box">
                        <div class="cart_header">
                            <!-- <i class="fas fa-shopping-cart"></i> -->
                            <img src="<?php echo url('frontend_assets/images/payment-cart-icon.svg'); ?>" alt="">
                            <?php
                                 $search_step_2 = json_decode($search->step_2);
                                 $checkLesson=in_array("lesson",$search_step_2);
                                 $checkTest=in_array("test",$search_step_2);
                            ?>
                            <p>
                                <?php if($checkLesson==true): ?>
                                    You have added <?php echo e($hour); ?> lessons
                                <?php endif; ?>
                                <?php if($checkTest): ?>
                                    and a driving test package to your cart.
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="cart_body" style="min-height: 195px; max-height: 164px;overflow-y: scroll;">
                            <h5>Your booking with <?php echo e(ucfirst( $instructor->name )); ?>:</h5>
                            <ul class="list-unstyled">
                                <?php
                                $total=0;
                                $search_step_2 = json_decode($search->step_4);
                                $explodeLesson=$search_step_2->lesson_hour;

                                $resultLesson = [];
                                if ($explodeLesson){
                                    if (strpos($explodeLesson, ',') !== false) {
                                        $resultLesson = explode(',', $explodeLesson);
                                    } else {
                                        $resultLesson = [$explodeLesson];
                                    }
                                }

                                $explodelesson_schedule_date=$search_step_2->lesson_schedule_date;
                                $resultLessonScheduleDate = [];
                                if ($search_step_2->lesson_schedule_date){
                                    if (strpos($explodelesson_schedule_date, ',') !== false) {
                                        $resultLessonScheduleDate = explode(',', $explodelesson_schedule_date);
                                    } else {
                                        $resultLessonScheduleDate = [$explodelesson_schedule_date];
                                    }
                                }


                                $explodeLessonTimeSlot=$search_step_2->lesson_time_slot;
                                $resultTimeSLot = [];
                                if ($search_step_2->lesson_time_slot){
                                    if (strpos($explodeLessonTimeSlot, ',') !== false) {
                                        $resultTimeSLot = explode(',', $explodeLessonTimeSlot);
                                    } else {
                                        $resultTimeSLot = [$explodeLessonTimeSlot];
                                    }
                                }
                                ?>
                                <?php $__currentLoopData = $resultLesson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php if($key>2): ?> hidden-show <?php endif; ?>"><?php echo e($item); ?> Hour Lesson <?php echo e(date('d-m-Y',strtotime($resultLessonScheduleDate[$key]))); ?>, <?php echo e($resultTimeSLot[$key]); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php $existTest=false;?>
                                <?php if($search_step_2->test_schedule_date && $search_step_2->test_schedule_date!='undefined' && $checkTest): ?>
                                        <?php
                                        $existTest=true;
                                        // Given time range
                                        $timeRange =$search_step_2->test_time_slot;

                                        // Split the time range into start and end times
                                        list($startTime, $endTime) = explode('-', $timeRange);

                                        // Convert the times to DateTime objects
                                        $startTime = new DateTime(trim($startTime));
                                        $endTime = new DateTime(trim($endTime));

                                        // Subtract 1 hour from both start and end times
                                        $startTime->sub(new DateInterval('PT1H'));
                                        $endTime->sub(new DateInterval('PT1H'));

                                        // Format the times back to the desired format
                                        $newTimeRange = $startTime->format('h:i A') . '-' . $endTime->format('h:i A');
                                        ?>
                                <li>Driving Test Package: <?php echo e(date('d-m-Y',strtotime($search_step_2->test_schedule_date))); ?>, <?php echo e($startTime->format('h:i a')); ?> pickup for <?php echo e($endTime->format('h:i a')); ?> a test start</li>
                                <?php endif; ?>

                                <?php if(count ($resultLesson)==0 && $existTest==false): ?>
                                    <p style="font-size: 16px;">No Booking Yet</p>
                                <?php endif; ?>
                            </ul>

                            <?php if(count($resultLesson)>3): ?>
                            <a class="show_all" href="javascript:void(0)" id="showMoreBtn" onclick="showMore()">Show All</a>
                            <a class="show_all hidden" href="javascript:void(0)" id="showLessBtn" onclick="showLess()">Show Less</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="have_and_ac">
                        <?php if(auth()->user()): ?>
                            <h4>[ <?php echo e(auth()->user()->name); ?> <?php echo e(auth()->user()->lname); ?> ]</h4>
                            <a href="<?php echo e(URL::to ('/login')); ?>" class="btn btn-primary">My Account</a>
                        <?php else: ?>
                            <h4>Already have an account?</h4>
                            <a href="<?php echo e(URL::to ('/login-demo')); ?>" class="btn btn-primary">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="learners_details_form">
                <div class="learners_form_wrapper overflow-hidden">

                    <?php if(auth()->guest()): ?>
                    <div class="learners_form_header text-center">
                        <h4>Please enter the learner’s details</h4>
                    </div>
                    <?php endif; ?>

                    <?php if(auth()->user()): ?>
                        <?php if(auth()->user()->type !='learner'): ?>
                            <div class="alert alert-danger">
                                <p><strong class="text-white">Alert!</strong> You haven't permission to proceed! </p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <div class="form_body">
                        <form class="row g-3" id="registerForm">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="user_id" <?php if($user): ?> value="<?php echo e($user->id); ?>" <?php endif; ?>>
                            <input type="hidden" name="search_id" value="<?php echo e($search_id); ?>">

                            <input class="address_fields" type="hidden" id="truecity" name="address_detail[city]">
                            <input class="address_fields" type="hidden" id="administrative_area_level_1" name="address_detail[state]">
                            <input class="address_fields" type="hidden" id="country" name="address_detail[country]">
                            <input class="address_fields" type="hidden" id="lat" name="address_detail[lat]">
                            <input class="address_fields" type="hidden" id="lng" name="address_detail[lng]">
                            <input class="address_fields" type="hidden" id="countryCode" name="address_detail[country_code]"/>
                            <input class="address_fields" type="hidden" id="query" name="address_detail[query]"/>
                            <input class="address_fields" type="hidden" id="postcode" name="address_detail[postcode]"/>
                            <input class="address_fields" type="hidden" id="suburb" name="address_detail[suburb]"/>

                            <div class="col-md-12">
                                <label for="inputaddress" class="form-label">Pick up address*</label>
                                <input onkeyup="$('.address_fields').val(''),$('.address_hint').addClass('hidden')" placeholder="Enter a location" id="searchTextField" class="form-control" type="text" name="address" value="">
                                <small class=" address_hint hidden" data-original-title="" data-toggle="tooltip" data-title="Address details"> <i class="fa fa-address-book"></i> </small>
                            </div>

                            <?php if(auth()->guest()): ?>
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">First Name*</label>
                                    <input class="form-control" type="text" name="name" <?php if($user): ?> value="<?php echo e($user->name); ?>" <?php endif; ?> placeholder="Your first name">
                                    <span class="error_global" id="name_error" style="color: red"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">Last Name*</label>
                                    <input class="form-control" type="text" name="last_name" <?php if($user): ?> value="<?php echo e($user->lname); ?>" <?php endif; ?> placeholder="Your last name">
                                    <span class="error_global" id="last_name_error" style="color: red"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="phonenum" class="form-label">Mobile*</label>
                                    <input class="form-control" type="text" name="phone" <?php if($user): ?> value="<?php echo e($user->phone); ?>" <?php endif; ?> placeholder="+61XXXXXXX">
                                    <span class="error_global" id="phone_error" style="color: red"></span>
                                </div>
                                <div class="col-md-6 birth_date_box">
                                    <label for="lname" class="form-label">Date Of Birth*</label>
                                    <div class="select-container d-flex flex-row">
                                        <select class="form-control" id="day" name="day">
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                echo "<option value=\"$i\">$i</option>";
                                            }
                                            ?>
                                        </select>
                                        <span class="error_global" id="day_error" style="color: red"></span>
                                        <select class="form-control" id="month" name="month">
                                            <?php
                                            $months = [
                                                1 => 'January', 2 => 'February', 3 => 'March',
                                                4 => 'April', 5 => 'May', 6 => 'June',
                                                7 => 'July', 8 => 'August', 9 => 'September',
                                                10 => 'October', 11 => 'November', 12 => 'December'
                                            ];

                                            foreach ($months as $key => $value) {
                                                echo "<option value=\"$key\">$value</option>";
                                            }
                                            ?>
                                        </select>
                                        <span class="error_global" id="month_error" style="color: red"></span>
                                        <select class="form-control" id="year" name="year">
                                            <?php
                                            $currentYear =2007;
                                            for ($i = $currentYear; $i >= $currentYear - 100; $i--) {
                                                echo "<option value=\"$i\">$i</option>";
                                            }
                                            ?>
                                        </select>
                                        <span class="error_global" id="year_error" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email address*</label>
                                    <input class="form-control" type="text" <?php if($user): ?> value="<?php echo e($user->email); ?>" disabled <?php else: ?> name="email" <?php endif; ?> placeholder="Your email address">
                                    <span class="error_global" id="email_error" style="color: red"></span>
                                </div>
                                <div class="col-md-12 pass_alert">
                                    <div class="alert alert-success" role="alert">
                                        <h6>Create a password for the learner dashboard</h6>
                                        <p>Manage & view bookings online at anytime</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password*</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control password_icon password_icon_none" id="password" value="" placeholder="•••••••••••" name="password">
                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                        <span class="error_global" id="password_error" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cpass" class="form-label">Confirm Password*</label>

                                    <div class="position-relative confirm_pass">
                                        <input type="password" class="form-control password_icon confirm_password_icon_none" id="password" value="" placeholder="•••••••••••" name="confirm_password">
                                        <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                                        <span class="error_global" id="confirm_password_error" style="color: red"></span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-6 d-flex align-items-center teams_check">
                                <div class="form-check mb-0">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="remember_check" required>
                                    <label class="form-check-label" for="remember_check">
                                        I agree to the <a href="#" class="text-decoration-none">Terms & Conditions</a>
                                    </label>
                                </div>
                            </div>

                            <div class="alert alert-danger error-alert hidden mt-4 mb-4">
                                <p><strong class="text-white">Please fix following errors</strong></p>
                                <ul class="error_body"></ul>
                            </div>

                            <div class="col-md-6 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" id="saveRecord">CONTINUE</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.16.6"></script>
    <script src="<?php echo e(asset('assets/front/js/intlTelInput.js')); ?>"></script>

    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&callback=initMap&key=AIzaSyAD3HqytidVYlVLYRCXCjuXCYeRWZDb4DA&language=en&region=AU&components=country:AU"></script>


    <script>
        var hiddenItems = document.querySelectorAll('.hidden-show');
        var showMoreBtn = document.getElementById('showMoreBtn');
        var showLessBtn = document.getElementById('showLessBtn');

        function showMore() {
            hiddenItems.forEach(function(item) {
                item.style.display = 'list-item';
            });

            showMoreBtn.style.display = 'none';
            showLessBtn.style.display = 'block';
        }

        function showLess() {
            hiddenItems.forEach(function(item) {
                item.style.display = 'none';
            });

            showMoreBtn.style.display = 'block';
            showLessBtn.style.display = 'none';
        }
    </script>

    <script>

        const input = document.getElementById("searchTextField");

        const options = {
            //bounds: defaultBounds,
            componentRestrictions: { country: "AU" },
            fields: ["address_components", "geometry", "icon", "name"],
            strictBounds: false,
        };

        const searchBox = new google.maps.places.Autocomplete(input, options);
        // Add change event listener
        searchBox.addListener('place_changed', function () {
            fillInAddress();
        });

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            const place = searchBox.getPlace();
            // const place = places[0];
             let address1 = "";
            // let postcode = "";
            // console.log(place);

            document.querySelector('#lat').value = place.geometry.location.lat();
            document.querySelector('#lng').value = place.geometry.location.lng();

            // Get each component of the address from the place details,
            // and then fill-in the corresponding field on the form.
            // place.address_components are google.maps.GeocoderAddressComponent objects
            // which are documented at http://goo.gle/3l5i5Mr
            for (const component of place.address_components) {
                // @ts-ignore remove once typings fixed
                const componentType = component.types[0];


                console.log(component);
                console.log(component);

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }

                    case "route": {
                        address1 += component.short_name;
                        break;
                    }

                    case "postal_code": {
                        postcode = `${component.long_name}${postcode}`;
                        break;
                    }

                    case "postal_code_suffix": {
                        postcode = `${postcode}-${component.long_name}`;

                        break;
                    }
                    case "locality":
                        document.querySelector('#truecity').value = component.long_name;
                        break;
                    case "administrative_area_level_1": {
                        // document.querySelector("#state").value = component.short_name;
                        document.querySelector('#administrative_area_level_1').value = component.short_name || '';
                        break;
                    }
                    case "administrative_area_level_2": {
                        // document.querySelector("#state").value = component.short_name;
                        document.querySelector('#suburb').value = component.long_name || '';
                    }
                    case "country":
                        document.querySelector('#countryCode').value = component.short_name;
                        document.querySelector('#country').value = component.long_name;
                        break;
                }
            }
            document.querySelector('#postcode').value = postcode;

            console.log(address1);
        }


        //=== sticky continue click
        $("button#saveRecord").click(function(){
          //  $('#registerForm').submit();
        });
        //==========


        $(document).on('submit','#registerForm', function(event) {
            event.preventDefault(); // Prevent the default form submission

            $('.error-alert').addClass('hidden');
            $('.error-alert .error_body').html('');

            if( $('#truecity').val() =='' ){
                swal('Please Select Address From Values');
                return false;
            }

            var data = new FormData(this);

            $.ajax({
                url: "<?php echo e(Route('register_learner')); ?>",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {
                    $('.error_global').html('');
                    let er='';
                    if( res.hasOwnProperty('error') ){
                        $.each(res.message, function(k, v) {
                           $('span#'+k+'_error').html(v[0]);
                        });
                    }

                    if(res.success == true){
                     let url = "<?php echo e(url("/learners/payment/$search_id")); ?>";
                        window.location.href=url;
                    }else if(res.success == false){
                        swal('oops!', res.message, 'warning');
                    }
                    $('.fa-spinner').addClass('hidden');
                },
                error: function () {
                    $('.fa-spinner').addClass('hidden');
                    swal('oops!', 'something went wrong', 'warning');
                }
            });

            return false;
        });

        // Confirm password defult lock icon and input fill than icon change to eye icon.
        if($('.confirm_password_icon_none').val() !='' ) {
            $('.confirm_password_icon_none ~ .toggle-password').addClass('input-has-value');
            $(this).addClass('bg_none');
        }
        $('.confirm_password_icon_none').blur(function(){
            if($('.confirm_password_icon_none').val() !='' ) {
                $('.confirm_password_icon_none ~ .toggle-password').addClass('input-has-value');
                $(this).addClass('bg_none');
            }else{
                $('.confirm_password_icon_none ~ .toggle-password').removeClass('input-has-value');
                $(this).removeClass('bg_none');
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

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            let input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.cart',['mainclass'=>'cart'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7.4.9\htdocs\firstpass\resources\views/learner/register.blade.php ENDPATH**/ ?>