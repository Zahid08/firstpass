<?php $__env->startSection('content'); ?>
    <style>
        .hidden-show {
            display: none;
        }
        .cart_body {
            max-height: 164px;
            overflow-y: scroll;
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

    if ($search->step_3){
        $search_step_3 = json_decode($search->step_3);
        $previousRate   =$search_step_3->hourly_rate;
        $discount       =$search_step_3->discount;
        $total          =$search_step_3->total;
        $hour           = @$search_step_3->hour;
    }



    if( ($search_step_2 && in_array('test', $search_step_2))){
        $checkTestPackageStatus=true;
    }

    $startingIndex=1;
    if ($search->start_lesson){
        $startingIndex=$search->start_lesson;
    }
    ?>
    <style>
        button.disable {
            pointer-events: none;
            background: #ae9b9b30!important;
        }
        input#searchTextField {
            pointer-events: none;
            background: #8080800d;
        }
    </style>
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
                    <img class="img-fluid" src="<?php echo url('frontend_assets/images/payment-tabs.svg'); ?>" alt="">
                </div>
            </div>
        </div>
        <div class="payment_wrapper">

            
            <div class="payment_pkg_row">
                <div class="payment_stats_box_wrapper">
                    <div class="col-md-12">
                        <div class="your_cart_box">
                            <div class="cart_header">
                                <!-- <i class="fas fa-shopping-cart"></i> -->
                                <img src="<?php echo url('frontend_assets/images/payment-cart-icon.svg'); ?>" alt="">
                                <?php
                                $checkLesson=$checkTest='';
                                if ($search->step_2){
                                $search_step_2 = json_decode($search->step_2);
                                $checkLesson=in_array("lesson",$search_step_2);
                                $checkTest=in_array("test",$search_step_2);
                                }
                                ?>
                                <p id="packageAddingMessage">
                                    <?php if($checkLesson): ?>
                                        You have added <?php echo e($hour); ?> lessons
                                    <?php endif; ?>
                                    <?php if($checkTest): ?>
                                        and a driving test package to your cart.
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div class="cart_body" style="min-height: 195px;">
                               <?php if($instructor): ?> <h5>Your booking with <?php echo e(($instructor)?ucfirst( $instructor->name ):''); ?>:</h5><?php else: ?> <h5 style="text-transform:none">You are adding new credit to your wallet.</h5> <?php endif; ?>
                                <ul class="list-unstyled">
                                    <?php
                                    $explodeLesson='';
                                    if ($search->step_4){
                                        $search_step_2 = json_decode($search->step_4);
                                        $explodeLesson=$search_step_2->lesson_hour;
                                    }

                                    $resultLesson = [];
                                    if ($explodeLesson){
                                        if (strpos($explodeLesson, ',') !== false) {
                                            $resultLesson = explode(',', $explodeLesson);
                                        } else {
                                            $resultLesson = [$explodeLesson];
                                        }
                                    }

                                    $explodelesson_schedule_date='';
                                    if ($search->step_4){
                                         $explodelesson_schedule_date=$search_step_2->lesson_schedule_date;
                                    }
                                    $resultLessonScheduleDate = [];

                                    if ($search->step_4){
                                        if ($search_step_2->lesson_schedule_date){
                                            if (strpos($explodelesson_schedule_date, ',') !== false) {
                                                $resultLessonScheduleDate = explode(',', $explodelesson_schedule_date);
                                            } else {
                                                $resultLessonScheduleDate = [$explodelesson_schedule_date];
                                            }
                                        }
                                    }

                                    $explodeLessonTimeSlot='';
                                    if ($search->step_4){
                                     $explodeLessonTimeSlot=$search_step_2->lesson_time_slot;
                                    }
                                    $resultTimeSLot = [];
                                    if ($search->step_4){
                                        if ($search_step_2->lesson_time_slot){
                                            if (strpos($explodeLessonTimeSlot, ',') !== false) {
                                                $resultTimeSLot = explode(',', $explodeLessonTimeSlot);
                                            } else {
                                                $resultTimeSLot = [$explodeLessonTimeSlot];
                                            }
                                        }
                                    }
                                    $totalBookingHour=0;
                                    ?>
                                    <?php if($checkLesson): ?>
                                    <?php $__currentLoopData = $resultLesson; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $totalBookingHour+=$item; ?>
                                        <li class="<?php if($key>2): ?> hidden-show <?php endif; ?>"><?php echo e($item); ?> Hour Lesson <?php echo e(date('d-m-Y',strtotime($resultLessonScheduleDate[$key]))); ?>, <?php echo e($resultTimeSLot[$key]); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>

                                       <?php $existTest=false;?>
                                        <?php if($search->step_4 && $search_step_2->test_schedule_date && $search_step_2->test_schedule_date!='undefined' && $checkTest): ?>
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
                                            <li id="drivingTestPackage">Driving Test Package: <?php echo e(date('d-m-Y',strtotime($search_step_2->test_schedule_date))); ?>, <?php echo e($startTime->format('h:i a')); ?> pickup for <?php echo e($endTime->format('h:i a')); ?> a test start</li>
                                        <?php endif; ?>

                                        <?php if(count ($resultLesson)==0 && $existTest==false && (isset($_REQUEST['type']) && $_REQUEST['type']!='wallet')): ?>
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
                </div>
                <div class="payments_two_box_wrapper">
                    <div class="h-100 payments_two_box">
                        <div class="payments_box">
                            <div class="payment_lessons_box h-100">
                                <div class="paymenttest_pkg_col">
                                    <div class="diving_lessons_checkbox">
                                        <label class="dl-container-checkbox">
                                            <input onclick="checkTheBox('test')" id="d_test" type="checkbox" <?=($checkTestPackageStatus==true)?'checked':''?>/>
                                            <span class="dl_checkmark"></span>
                                        </label>
                                        <span class="paymenttest_pkg_title">Test Package</span>
                                    </div>
                                    <div class="payment_pkg_list">
                                        <h2>$<span id="testpackge_price"><?php echo e($test_package->price); ?></span></h2>
                                        <div class="driving_testpack_list">
                                            <ul>
                                                <li>Pick up &amp; drop off</li>
                                                <li>Warm up lesson</li>
                                                <li>Use instructor car</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payments_box">
                            <div class="dl_selection_box payment_dl_box">
                                <div class="pack_price_list">
                                    <div class="dl_pkg_price">
                                        <h4 class="detail_sub_heading">Add More To Save</h4>
                                        <div class="pack_price_select">
                                            <select name="" id="lessongChange">
                                                <?php if(!$checkLesson): ?>
                                                    <option value="0">Select</option>
                                                <?php endif; ?>
                                                <?php for ($i=$startingIndex;$i<=100;$i++){?>
                                                <option value="<?=$i?>" <?php if($i==$hour){echo "selected";}?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="pkg_lesson_tag">Lessons</span>
                                        </div>
                                    </div>
                                    <div class="dl_pkg_total">
                                        <button class="pkg_save_btn d-none" id="savingsPercentage">Save 5% OFF</button>
                                        <div class="pkg_price_total">
                                            <span>Total</span>
                                            <input type="hidden" value="<?php echo e($previousRate); ?>" id="drivingLessonPrice">
                                            <span>$<span id="totalPriceCalculations"><?php echo e($total); ?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="learners_details_form">
                <div class="learners_form_wrapper overflow-hidden">
                    <div class="learners_form_header text-center">
                        <h4>Payment Details</h4>
                    </div>
                    <div class="form_body payment_form_body">
                        <?php if(auth()->user()): ?>
                            <?php if(auth()->user()->type !='learner'): ?>
                                <div class="alert alert-danger">
                                    <p><strong class="text-white">Alert!</strong> You haven't permission to proceed! </p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <form class="row g-3" method="post" id="payment-form">
                            <?php echo csrf_field(); ?>
                            <?php
                            $step_5 = $search->step_5;
                            $s = json_decode($step_5);
                            $address = '';
                            if( is_object($s) ){
                                $address = $s->address;
                                $address_detail = $s->address_detail;
                            }
                            ?>

                            <input type="hidden" value="" name="test_package_adding_status" id="test_package_adding_status">
                            <input type="hidden" value="<?php echo e($total); ?>" name="total" id="totalAmount">
                            <input type="hidden" value="<?php echo e($discount); ?>" name="dis" id="discountAMount">
                            <input type="hidden" value="<?php echo e($hour); ?>" name="hr" id="totalQtyHour">
                            <input type="hidden" value="<?php echo e($previousRate); ?>" name="hourly_rate" id="hourly_rate">
                            <input type="hidden" value="<?php echo e($test_package->price); ?>" name="test_price" id="test_price">
                            <input type="hidden" value="<?php echo e($totalBookingHour); ?>" name="current_booking_hour" id="current_booking_hour">


                            <input type="hidden" name="search_id" value="<?php echo e($search_id); ?>">
                            <input type="hidden" value="<?php echo e(@$address_detail->city); ?>" id="truecity" name="address_detail[city]">
                            <input type="hidden" value="<?php echo e(@$address_detail->state); ?>" id="administrative_area_level_1" name="address_detail[state]">
                            <input type="hidden" value="<?php echo e(@$address_detail->country); ?>" id="country" name="address_detail[country]">
                            <input type="hidden" value="<?php echo e(@$address_detail->lat); ?>" id="lat" name="address_detail[lat]">
                            <input type="hidden" value="<?php echo e(@$address_detail->lng); ?>" id="lng" name="address_detail[lng]">
                            <input type="hidden" value="<?php echo e(@$address_detail->country_code); ?>" id="countryCode" name="address_detail[country_code]"/>
                            <input type="hidden" value="<?php echo e(@$address_detail->query); ?>" id="query" name="address_detail[query]"/>
                            <input type="hidden" value="<?php echo e(@$address_detail->postcode); ?>" id="postcode" name="address_detail[postcode]"/>
                            <input type="hidden" value="<?php echo e(@$address_detail->suburb); ?>" id="suburb" name="address_detail[suburb]"/>

                            <input type="hidden" value="<?php echo e(isset($_REQUEST['type'])?$_REQUEST['type']:''); ?>" id="type" name="type"/>


                            <div class="col-md-6 col-6">
                                <label for="fname" class="form-label">First Name*</label>
                                <input style="pointer-events: none;  background: #8080800d;" class="form-control" type="text" name="name" <?php if($user): ?> value="<?php echo e($user->name); ?>" <?php endif; ?>>
                            </div>
                            <div class="col-md-6 col-6">
                                <label for="lname" class="form-label">Last Name*</label>
                                <input style="pointer-events: none;  background: #8080800d;" class="form-control" type="text" name="lname" <?php if($user): ?> value="<?php echo e($user->lname); ?>" <?php endif; ?>>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address*</label>
                                <input id="searchTextField" class="form-control" type="text" name="address" value="<?php echo e($address); ?>" >
                                <small class=" address_hint" data-original-title="" data-toggle="tooltip" data-title="Address details"> <i class="fa fa-address-book"></i> <strong> Detail: </strong> city: <?php echo e(@$address_detail->city); ?>, suburb: <?php echo e(@$address_detail->suburb); ?> </small>
                            </div>

                            <div class="col-md-12">
                                <div class="custome-radio-wrapper d-flex justify-content-between payment-cards-row">
                                    <div class="form-check form-check-inline mt-0">
                                        <label class="mb-0 form-check-label form-label" onclick="paymentChecker(this)" for="credit_debit_card">
                                            <span>Credit or Debit Card</span>
                                            <input class="form-check-input custom-radio" type="radio" name="paymentOption" id="credit_debit_card" value="stripe" checked>
                                        </label>
                                    </div>
                                    <img src="<?php echo url('frontend_assets/images/payment-cards-img.png'); ?>" height="22" alt="" class="ms-auto">
                                </div>

                                <div id="card-element"class="form-control" style="width: 100%;display: block;padding: 15px; height: 50px; border-radius: 5px;">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <div id="card-errors" role="alert" style="color: red"></div>
                            </div>
                            <div class="col-md-12 payment-options">
                                <label class="col-12 mb-2 form-check-label form-label">Buy Now Pay Later</label>
                                <div class="row gx-3">
                                    <div class="col-lg-4 col-md-4 paypal_options mb-md-0 mb-3">
                                        <div class="custome-radio-wrapper">
                                            <div class="form-check form-check-inline mt-0">
                                                <label class="mb-0 form-check-label form-label" onclick="paymentChecker(this)" for="paypal_pay">
                                                    <img src="<?php echo url('frontend_assets/images/logos/paypal.png'); ?>" alt="" class="paypal">
                                                    <input class="form-check-input custom-radio" type="radio" name="paymentOption" id="paypal_pay" value="paypal">
                                                    <span class="opacity-50">Pay in 4</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 after_options mb-md-0 mb-3">
                                        <div class="custome-radio-wrapper">
                                            <div class="form-check form-check-inline mt-0">
                                                <label class="mb-0 form-check-label form-label" onclick="paymentChecker(this)" for="after_pay">
                                                    <img src="<?php echo url('frontend_assets/images/logos/afterPay-1.png'); ?>" alt="" class="afterpay_icon">
                                                    <input class="form-check-input custom-radio" type="radio" name="paymentOption" id="after_pay" value="after_pay">
                                                    <span>Afterpay</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 zip_options mb-md-0 mb-3">
                                        <div class="custome-radio-wrapper zip_icon">
                                            <div class="form-check form-check-inline mt-0">
                                                <label class="mb-0 form-check-label form-label" onclick="paymentChecker(this)" for="zip_pay">
                                                    <img src="<?php echo url('frontend_assets/images/logos/zip-pay-1.png'); ?>" alt="">
                                                    <input class="form-check-input custom-radio" type="radio" name="paymentOption" id="zip_pay" value="zip_pay">
                                                    <span>Zip - Buy now, pay later</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-0" id="submitBtn">
                                    <img class="mr-2 d-none" id="submit-img" class="d-none" src="" alt=""/>
                                    <span id="submit-span">PAY NOW</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
    function paymentChecker(el){
        var submit_img = document.getElementById("submit-img");
        var submit_span = document.getElementById("submit-span");
        if (
            el.children[1].id === "paypal_pay" ||
            el.children[1].id === "after_pay" ||
            el.children[1].id === "zip_pay"
        ) {
            if (el.children[1].checked) {
                submit_img.classList.remove("d-none");
                if (el.children[1].id === "paypal_pay") {
                    var img_source = el.children[0].getAttribute("src");
                    submit_img.setAttribute("src", img_source);
                } else {
                    var img_source = el.children[0].getAttribute("src");
                    submit_img.setAttribute("src", img_source);
                }
                submit_span.innerHTML = "CONTINUE";
            }
        } else {
            if (el.children[1].checked) {
                submit_img.classList.add("d-none");
                submit_span.innerHTML = "PAY NOW";
            }
        }
    };

</script>

<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.16.6"></script>
<script>
    (function() {
        var placesAutocomplete = places({
            appId: 'plDAML4GXDMT',
            apiKey: '384c249023210b735270be1a32b31358',
            minLength: 3,
            container: document.querySelector('#searchTextField'),
            templates: {
                value: function(suggestion) {
                    return suggestion.name;
                }
            }
        }).configure({
            type: 'address',
            language: 'en',
            countries: ['au'],
        });
        placesAutocomplete.on('change', function resultSelected(e) {
            console.log(e);
            document.querySelector('#truecity').value = e.suggestion.city || '';
            document.querySelector('#country').value = e.suggestion.country || '';
            document.querySelector('#administrative_area_level_1').value = e.suggestion.administrative || '';
            document.querySelector('#countryCode').value = e.suggestion.countryCode || '';
            document.querySelector('#lat').value = e.suggestion.latlng.lat || '';
            document.querySelector('#lng').value = e.suggestion.latlng.lng || '';
            document.querySelector('#query').value = e.query || '';
            document.querySelector('#postcode').value = e.suggestion.postcode || '';
            document.querySelector('#suburb').value = e.suggestion.suburb || '';
            $('.address_hint').html(e.query+ '<strong> Detail: </strong> city: '+ e.suggestion.city+ ', postcode: '+e.suggestion.postcode+ ', suburb: '+ e.suggestion.suburb).removeClass('hidden');

        });
    })();

    $(document).ready(function (){

        <?php if(auth()->user()): ?>
        <?php
            $dob = explode('-',$user->dob);
        ?>
        $('select[name=year]').val(<?php echo e(@$dob[0]); ?>);
        $('select[name=month]').val(<?php echo e(@$dob[1]); ?>);
        $('select[name=day]').val(<?php echo e(@$dob[2]); ?>);
        <?php endif; ?>



        //=== sticky continue click
        $(".button_fix_area .btn").click(function(){
            $('#payment-form').submit();
        });
        //===========

    });
</script>

<!-- stripe -->
<script src="https://js.stripe.com/v3/"></script>
<script>

    var stripe = Stripe('pk_test_gjQoaidxLor1i8VqysmJJ1zk');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var selectedValue = $('input[type="radio"]:checked').val();
        if(selectedValue=='stripe'){
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        }else{

           $('#submitBtn').addClass('disable');
            // Insert the token ID into the form so it gets submitted to the server
          //  var form = document.getElementById('payment-form');

            var data = new FormData(form);

            $.ajax({
                url: "<?php echo e(route('stripe_payment')); ?>",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(res){
                    $('#loading').hide();

                    if(res.success == true && res.method=='paypal' || res.method=='after_pay' || res.method=='zip_pay')
                    {
                        swal("Good!", res.message, "success");
                        $('#submitBtn').removeClass('disable');
                        window.location.href=res.redirect_link;
                    }else
                    {
                        swal("Success Alert!", res.message, "warning");
                    }
                },
                error: function (res) {
                    swal("Note!", res.message, "warning");
                }
            });
            return false;

        }
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        $('#submitBtn').addClass('disable');
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        var data = new FormData(form);

        $.ajax({
            url: "<?php echo e(route('stripe_payment')); ?>",
            data: data,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(res){
                $('#submitBtn').removeClass('disable');

                if(res.success == true)
                {
                    swal("Good!", res.message, "success");
                    let url = "<?php echo e(url("/home")); ?>";
                    window.location.href=url;
                }else
                {
                    swal("Note!", res.message, "warning");
                }
            },
            error: function (res) {
                swal("Note!", res.message, "warning");
            }
        });
        return false;
    }

    function checkTheBox(type) {
        summationsOfTotal();
    }

    $(document).on('change', 'select#lessongChange', function () {
        summationsOfTotal(true);
    });

    summationsOfTotal();
    function summationsOfTotal(trigger=false){
        var pricingQty                       =$('select#lessongChange').val()||0;
        let currentTotalBookinghour         =$('input#current_booking_hour').val()||0;

        if (Number(currentTotalBookinghour)>Number(pricingQty) && trigger==true){
            swal("Note!", 'You have already booked 2 hour', "warning");
        }else {
            var originalPrice   =$('input#drivingLessonPrice').val()||0;
            var totalAmount=0;
            var pricingQty       =$('select#lessongChange').val()||0;
            totalAmount          =pricingQty*parseInt(originalPrice);

            var valueCurrent       =$('select#lessongChange').val()||0;
            $('#totalQtyHour').val(valueCurrent);
            if(valueCurrent<6) {
                totalAmount = parseInt(originalPrice) * valueCurrent;
                $('#is_lesson').val('');
                $('#discountAMount').val(0);
                $('button#savingsPercentage').addClass('d-none');
            }else if(valueCurrent >5 && valueCurrent < 10 ){

                $('#is_lesson').val('yes');

                let calcualtedData = parseFloat(originalPrice) * valueCurrent;
                let pkg = Math.round( (calcualtedData*5)/100);
                totalAmount = calcualtedData-pkg;

                $('#discountAMount').val(5);
                $('button#savingsPercentage').text('5% OFF').removeClass('d-none');
            }else if(valueCurrent >=10 && valueCurrent < 20 ){

                $('#is_lesson').val('yes');

                let calcualtedData = parseFloat(originalPrice) * valueCurrent;
                let pkg = Math.round( (calcualtedData*10)/100);
                totalAmount = calcualtedData-pkg;

                $('#discountAMount').val(10);
                $('button#savingsPercentage').text('10% OFF').removeClass('d-none');
            }else if(valueCurrent >=20 && valueCurrent < 50 ){

                let calcualtedData = parseFloat(originalPrice) * valueCurrent;
                let pkg = Math.round( (calcualtedData*12.5)/100);
                totalAmount = calcualtedData-pkg;

                $('#is_lesson').val('yes');

                $('#discountAMount').val(12);
                $('button#savingsPercentage').text('12.5% OFF').removeClass('d-none');
            }else if(valueCurrent >=50 && valueCurrent < 75 ){

                let calcualtedData = parseFloat(originalPrice) * valueCurrent;
                let pkg = Math.round( (calcualtedData*15)/100);
                totalAmount = calcualtedData-pkg;

                $('#is_lesson').val('yes');

                $('#discountAMount').val(15);
                $('button#savingsPercentage').text('15% OFF').removeClass('d-none');
            }else if(valueCurrent >=75 && valueCurrent <= 100 ){

                let calcualtedData = parseFloat(originalPrice) * valueCurrent;
                let pkg = Math.round( (calcualtedData*20)/100);
                totalAmount = calcualtedData-pkg;

                $('#is_lesson').val('yes');

                $('#discountAMount').val(20);
                $('button#savingsPercentage').text('20% OFF').removeClass('d-none');
            }

            if ($('#d_test').is(':checked')){
                var packagePrice       =$('span#testpackge_price').text()||0;
                totalAmount            =parseInt(packagePrice)+parseInt(totalAmount);
                $('input#test_package_adding_status').val('on');

                $('p#packageAddingMessage').html('You have added '+pricingQty+' lessons and a driving test package to your cart.');
                $('li#drivingTestPackage').show();
            }else {
                $('input#test_package_adding_status').val('off');
                $('p#packageAddingMessage').html('You have added '+pricingQty+' lessons');
                $('li#drivingTestPackage').hide()
            }

            $('span#totalPriceCalculations').text(totalAmount);
            $('input#totalAmount').val(totalAmount);
        }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.cart',['mainclass'=>'cart'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/learner/payment.blade.php ENDPATH**/ ?>