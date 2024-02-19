<?php $__env->startSection('content'); ?>
    <style>
        .booked_lessons_list{
            height: 110px!important;
        }
    </style>
    <?php

    //print_r($user_working_time);
    $total_hour = 0;
    if(isset($search->step_3) || auth()->user()){
        $step = json_decode( $search->step_3);
        if($step) {
            $total_hour = $step->hour;
        } else{
            $total_hour = 100;
        }
    }

    $openDrivingTestPackage=false;
    $openDrivingLessonPackage=false;
    if($search->step_2!='' || auth()->user()){
            $step_2 = json_decode($search->step_2);
            if( ($step_2 && in_array('test', $step_2))){
                $openDrivingTestPackage=true;
            }
            if( ($step_2 && in_array('lesson', $step_2))){
                $openDrivingLessonPackage=true;
            }
    }

    $userWday = array();
    foreach ($user_working_time as $key => $uWt)
    {
        $userWday[$uWt->day] = $uWt->is_enabled;
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
                    <img class="img-fluid" src="<?php echo url('frontend_assets/images/step-tabs-2.svg'); ?>" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- ---------------------- Book Now Section Start ---------------------- -->
    <section class="book_lesson add_cart_sec">
        <div class="add_cart_wrapper">
            <div class="add_cart_heading">
                <?php if($search->redirect_track==1): ?>
                <h2>Book More</h2>
                <?php else: ?>
                    <h2>Book Now</h2>
                <?php endif; ?>
            </div>

            <div class="book_lesson_wrapper">

                    <div class="booked_lessons_list mb-4 d-none" id="lesson_time_hidden">

                    </div>
                <!-- Choose driving-lesson or driving-test  -->
                <div class="added_to_cart mb-4" id="addToCartSections">
                    <div class="row">
                        <div class="col-12">
                            <div class="added_to_cart_box">
                                <?php if($search->redirect_track==1): ?>
                                <h5>Available Credit</h5>
                                <?php else: ?>
                                    <h5>Added to Cart</h5>
                                <?php endif; ?>
                                <ul class="list-unstyled mt-2">
                                    <?php if($openDrivingLessonPackage): ?>
                                    <li>
                                        <div class="list_title">Driving Lesson x <?=$total_hour?> hours</div>
                                        <div class="list_info"><span id="totalbookingHour">0</span> hours booked</div>
                                    </li>
                                    <?php endif; ?>
                                    <?php if($openDrivingTestPackage): ?>
                                    <li>
                                        <div class="list_title">Driving Test Package</div>
                                        <div class="list_info" id="testBookingStatus">Not Booked</div>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <?php if($openDrivingLessonPackage): ?>
                        <div class="col-6" id="drivingLessonWrapper">
                            <div class="lesson_test_box" id="drivingLessonPack">
                                <h5 id="addAnotherDrivingLesson">DRIVING LESSON</h5>
                                <span class="lt_arrow_right">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>
                                    </span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if($openDrivingTestPackage): ?>
                            <div class="col-6">
                                <div class="lesson_test_box" id="testPackage">
                                    <h5 id="addmoreDrivingTestPackage">DRIVING<br> TEST PACKAGE</h5>
                                    <span class="lt_arrow_right">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>
                                        </span>
                                </div>
                            </div>
                            <?php endif; ?>

                            <form id="book_time">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" id="check_search_types">
                                <input type="hidden" name="schedule_date">
                                <input type="hidden" name="start_date_slot" id="start_date_slot" value="">
                                <input type="hidden" id="total_hour" value="<?php echo $total_hour?>">
                                <input type="hidden" id="previousTotalHour" value="<?php echo $total_hour?>">
                                <input type="hidden" name="start_date_slot1" id="start_date_slot1" value="">
                                <input type="hidden" value="<?php echo e($search_id); ?>" name="search_id">
                                <input type="hidden" value="<?php echo e($instructor->id); ?>" name="instructor_id">
                                <input type="hidden" id="total_hours" value=0>

                                <div class="col-12">
                                    <?php if($search->step_2 =='' && auth()->user()): ?>
                                     <a href="javascript:void(0)" class="btn btn-primary w-100 rounded-1" id="confirmSubmitEvent">CONFIRM BOOKING(S)</a>
                                    <?php else: ?>
                                        <a href="javascript:void(0)" class="btn btn-primary w-100 rounded-1" id="confirmSubmitEvent">CONTINUE WITHOUT BOOKING</a>
                                    <?php endif; ?>
                                </div>

                            </form>
                    </div>
                </div>

                <!-- Choose driving-lesson time-date and hours-->
                <div class="driving_lesson mb-4 d-none" id="popoverDrivingLesson">
                    <div class="menu_close-btn" id="closePopover">
                        <img src="<?php echo url('frontend_assets/images/cross.png'); ?>" alt="">
                    </div>
                    <div class="dl_header text-center">
                        <h4 class="mb-0">Driving Lesson</h4>
                    </div>
                    <div class="dl_body">
                        <div class="added_to_cart_box">
                            <h5>Added to Cart</h5>
                            <ul class="list-unstyled mt-2">
                                <?php if($openDrivingLessonPackage): ?>
                                    <li>
                                        <div class="list_title">Driving Lesson x <?=$total_hour?> hours</div>
                                        <div class="list_info"><span id="drivingLessonPopoverBookedHour">0</span> hours booked</div>
                                    </li>
                                <?php endif; ?>
                                <?php if($openDrivingTestPackage): ?>
                                    <li>
                                        <div class="list_title">Driving Test Package</div>
                                        <div class="list_info" id="drivingLessonTestPackageStatus">Not Booked</div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="dl_duration">
                            <h4 class="text-center">Duration111</h4>
                            <div class="dl_hours_duration">
                                <form class="row" action="#" id="drivingLessonAddingForm">
                                    <div class="col-12 d-flex gap-3 justify-content-center align-items-center">
                                        <div class="d-flex justify-content-end">
                                            <div class="form-check" id="one_hour_div">
                                                <input class="form-check-input" id="one_hour" type="checkbox" name="hour" value="1">
                                                <label class="form-check-label" for="1">
                                                    1 hour
                                                </label>
                                            </div>
                                        </div>

                                        <?php if ($total_hour>1){ ?>
                                            <div class="d-flex justify-content-end">
                                                <div class="form-check" id="two_hour_div">
                                                    <input class="form-check-input" id="two_hour" type="checkbox" name="hour" value="2">
                                                    <label class="form-check-label" for="2">
                                                        2 hour
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="col-sm-6 col-12 mt-3  d-flex justify-content-sm-end justify-content-center">
                                        <select class="form-select availability_check" aria-label="Default select example" id="lesson_date" name="lesson_date">
                                            <option value="0" selected>Available Dates</option>
                                            <?php
                                            $currentDate = date('Y-m-d');
                                            for ($i=1; $i <=75 ; $i++)
                                            {
                                                $onlyDay = date('l', strtotime($currentDate. ' + '.$i.' days'));
                                                $toCheck = strtolower(trim($onlyDay));
                                                $toShow = date('D, d M Y', strtotime($currentDate. ' + '.$i.' days'));
                                                $toUse = date('Y-m-d', strtotime($currentDate. ' + '.$i.' days'));
                                                if( array_key_exists($toCheck, $userWday) )
                                                {
                                                    if( $userWday[$toCheck]=='yes' ){
                                                        echo "<option value='".$toUse."'>".$toShow."</option>";
                                                    }
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12 mt-3 mb-sm-0 mb-2 d-flex justify-content-sm-start justify-content-center disable-timing" id="show_slots">
                                        <select class="form-select availability_check" aria-label="Default select example">
                                            <option selected>Available Times</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-3 text-center">
                                        <button class="btn btn-primary" style="display: none" type="button" id="continueBtnEven" onclick="save_lesson(this)">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="available_dates_time row"></div>
                        </div>
                    </div>
                </div>

                <!-- Choose driving-test time-date and locatin  -->
                <div class="driving_lesson mb-4 d-none" id="testPackagePopover">
                    <div class="menu_close-btn" id="closeTestPackage">
                        <img src="<?php echo url('frontend_assets/images/cross.png'); ?>" alt="">
                    </div>
                    <div class="dl_header text-center">
                        <h4 class="mb-0">Driving Test Booking</h4>
                    </div>
                    <div class="dl_body">
                        <div class="added_to_cart_box">
                            <h5>Added to Cart</h5>
                            <ul class="list-unstyled mt-2">
                                <?php if($openDrivingLessonPackage): ?>
                                    <li>
                                        <div class="list_title">Driving Lesson x <?=$total_hour?> hours</div>
                                        <div class="list_info"><span id="testPackageHourBook">0</span> hours booked</div>
                                    </li>
                                <?php endif; ?>
                                <?php if($openDrivingTestPackage): ?>
                                    <li>
                                        <div class="list_title">Driving Test Package</div>
                                        <div class="list_info" id="testPackageBookingStatusCount">Not Booked</div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="dl_duration test_booking">
                            <h4 class="text-center">Allan’s test location & availabilty displayed</h4>
                            <div class="dl_hours_duration">
                                <form class="row" action="">
                                    <div class="col-12">
                                        <select class="form-select availability_check choose_location mx-auto" aria-label="Default select example" name="test_location" id="test_location">
                                            <option value="0" selected>Choose your test location</option>
                                            <?php

                                            if($search->step_2!='' || auth()->user()){

                                            $step_2 = json_decode($search->step_2);

                                            if($step_2 && in_array('test', $step_2) || auth()->user() ){

                                            ?>
                                            <?php $__currentLoopData = $test_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($test_location->id); ?>"><?php echo e($test_location->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php } } ?>
                                        </select>
                                    </div>


                                    <div class="col-sm-6 col-12 mt-3 mb-sm-0 mb-2" style="padding-left: 41px;display: none" id="testPakcageDate">
                                        <select class="form-select availability_check" aria-label="Default select example" id="test_location_date" name="test_location_date">
                                            <option value="0">Test date</option>
                                            <?php

                                            $currentDate = date('Y-m-d');
                                            for ($i=1; $i <=75 ; $i++)
                                            {
                                                $onlyDay = date('l', strtotime($currentDate. ' + '.$i.' days'));
                                                $toCheck = strtolower(trim($onlyDay));
                                                $toShow = date('D, d M Y', strtotime($currentDate. ' + '.$i.' days'));
                                                $toUse = date('Y-m-d', strtotime($currentDate. ' + '.$i.' days'));
                                                if( array_key_exists($toCheck, $userWday) )

                                                {
                                                    if( $userWday[$toCheck]=='yes' ){
                                                        echo "<option value='".$toUse."'>".$toShow."</option>";
                                                    }
                                                }
                                            } ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-12 mt-3" id="show_slots1" style="display: none">
                                        <select class="form-select availability_check" aria-label="Default select example">
                                            <option value="">Test start time</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mt-3 text-center">
                                        <button class="btn btn-primary lt-btn" id="continueBtnEven2" style="display: none" type="button" onclick="save_lesson1(this);">Save</button>
                                    </div>
                                </form>
                            </div>
                            <div class="available_dates_time row"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>

        $('input#one_hour').change(function() {
            let _1hour_checkbox = document.getElementById("one_hour");
            let _2hour_checkbox = document.getElementById("two_hour");

            let _1hourDiv = document.getElementById("one_hour_div");
            let _2hourDiv = document.getElementById("two_hour_div");

            if(this.checked) {
                _1hour_checkbox.setAttribute("checked", "checked");
                _1hourDiv.classList.add("checked-hour");

                _2hour_checkbox.removeAttribute("checked");
                _2hourDiv.classList.remove("checked-hour");
                $('input#two_hour').prop('checked', false);
            }else {
                _1hour_checkbox.removeAttribute("checked");
                _1hourDiv.classList.remove("checked-hour");
            }

            $('select#lesson_date').trigger('change');

        });


        $('input#two_hour').change(function() {
            let _1hour_checkbox = document.getElementById("one_hour");
            let _2hour_checkbox = document.getElementById("two_hour");

            let _1hourDiv = document.getElementById("one_hour_div");
            let _2hourDiv = document.getElementById("two_hour_div");

            if(this.checked) {
                _2hour_checkbox.setAttribute("checked", "checked");
                _2hourDiv.classList.add("checked-hour");

                $('input#one_hour').prop('checked', false);
                _1hour_checkbox.removeAttribute("checked");
                _1hourDiv.classList.remove("checked-hour");
            }else {
                _2hour_checkbox.removeAttribute("checked");
                _2hourDiv.classList.remove("checked-hour");
            }

            $('select#lesson_date').trigger('change');
        });


        /* -------------------------------------------------------------------------- */
        /*                     Details page date of birth selector                    */
        /* -------------------------------------------------------------------------- */

        const monthNames = [
            "Month",
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
        let qntYears = 100;

        let selectYear = $("#year");
        let selectMonth = $("#month");
        let selectDay = $("#day");
        let currentYear = new Date().getFullYear();

        for (var y = 0; y < qntYears; y++) {
            let date = new Date(currentYear);

            let yearElem = document.createElement("option");

            yearElem.value = currentYear.toString();
            yearElem.textContent = currentYear;

            selectYear.append(yearElem);
            currentYear--;
        }

        for (var m = 0; m < 12; m++) {
            let month = monthNames[m];
            let monthElem = document.createElement("option");
            monthElem.value = m;
            monthElem.textContent = month;
            selectMonth.append(monthElem);
        }

        var d = new Date();
        var month = d.getMonth();
        var year = d.getFullYear();
        var day = d.getDate();

        selectYear.val(year);
        selectYear.on("change", AdjustDays);
        selectMonth.val(month);
        selectMonth.on("change", AdjustDays);

        AdjustDays();
        selectDay.val(day);

        function AdjustDays() {
            var year = selectYear.val();
            var month = parseInt(selectMonth.val()) + 1;
            selectDay.empty();

            //get the last day, so the number of days in that month
            var days = new Date(year, month, 0).getDate();

            //lets create the days of that month
            for (var d = 1; d <= days; d++) {
                var dayElem = document.createElement("option");
                dayElem.value = d;
                dayElem.textContent = d;
                selectDay.append(dayElem);
            }
        }


        // payment page
        var radioChecker = (el) => {
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



        $(document).on('click','div#drivingLessonPack', function(event) {
            $('button#continueBtnEven').hide()
            $('button#continueBtnEven2').hide()
            $('div#addToCartSections').addClass('d-none');
            $('div#popoverDrivingLesson').removeClass('d-none');

            $('input#one_hour').prop('checked', true);

            let _1hour_checkbox = document.getElementById("one_hour");
            let _1hourDiv = document.getElementById("one_hour_div");

            _1hour_checkbox.setAttribute("checked", "checked");
            _1hourDiv.classList.add("checked-hour");

            let summsaitonBoking=summationsofBookingLesson();
            let bookingText=$('#testBookingStatus').text();
            $('#drivingLessonPopoverBookedHour').html(summsaitonBoking);
            $('#drivingLessonTestPackageStatus').html(bookingText);
        });

        $(document).on('click','div#testPackage', function(event) {

             $('button#continueBtnEven2').hide()

            $('div#addToCartSections').addClass('d-none');
            $('div#testPackagePopover').removeClass('d-none');


            let summsaitonBoking=summationsofBookingLesson();
            let bookingText=$('#testBookingStatus').text();
            $('#testPackageHourBook').html(summsaitonBoking);
            $('#testPackageBookingStatusCount').html(bookingText);

        });


        $(document).on('click','div#closePopover', function(event) {
            $('div#addToCartSections').removeClass('d-none');
            $('div#popoverDrivingLesson').addClass('d-none');
        });

        $(document).on('click','div#closeTestPackage', function(event) {
            $('div#addToCartSections').removeClass('d-none');
            $('div#testPackagePopover').addClass('d-none');
        });


        $(document).on('change','div#show_slots select', function(event) {
            $('#continueBtnEven').show();
        });

        $(document).on('change','#lesson_date', function(event) {
            var start_date = this.value;


            document.getElementById("check_search_types").value = "lesson_schedule";

           // $("#timing").show();

            let h=$('input[name=hour]:checked').val();

            var bookly_id = '1';

            $.post('<?php echo e(url('get-slots')); ?>',
                { hour: h, start_date:start_date, instructor_id: <?php echo e($instructor->id); ?>, userid: '<?php echo e($user_id); ?>', '_token': '<?php echo e(@csrf_token()); ?>' },
                function (data) {

                    $("#show_slots").html('');
                    $("#start_date_slot").val(start_date);

                    $("#show_slots").append(data.html);

                    $("input[name='schedule_date']").val(start_date);

                });
        });


        function save_lesson(e){

            var select_hour = parseInt($('input[name=hour]:checked').val());
            var result = parseInt($('#total_hours').val()) + select_hour;
            $('#total_hours').val(result);

            if($('select[name=time_slot] option:checked').length==0)

            {
                swal('Warning', 'Please select lesson booking time.', 'warning');
            }
            else
            {

                var existing_hour = $('#total_hour').val();

                var selected_hour = $("input[name='hour']:checked").val();

                var selected_date = $('select#lesson_date option:checked').val();

                var selected_date_show = $('select#lesson_date option:checked').text();

                var selected_time = $('select[name=time_slot] option:checked').val();

                var start_time = $('select[name=time_slot] option:checked').attr('data-start');
                var end_time = $('select[name=time_slot] option:checked').attr('data-end');


                if(selected_hour>1){ var ext = 'hrs'; }

                else{ var ext = 'hr'; }

                if( parseInt(selected_hour) > parseInt(existing_hour) )
                {
                    swal('Warning', 'You do not have enough time to book more!', 'warning');
                }
                else
                {
                    var checking_array = new Array();
                    if ($('.final_date').length > 0)
                    {
                        var dt = $(".final_date");
                        var ts = $(".time_start");
                        var te = $(".time_end");

                        for(var i = 0; i < dt.length; i++)
                        {
                            const inner_arr = [];
                            inner_arr['dt'] = $(dt[i]).val();
                            inner_arr['ts'] = $(ts[i]).val();
                            inner_arr['te'] = $(te[i]).val();
                            checking_array.push(inner_arr);
                        }
                    }


                    if ($('.final_date_test').length > 0)
                    {
                        const inner_arr = [];
                        inner_arr['dt'] = $('.final_date_test').val();
                        inner_arr['te'] = $('.test_time_end').val();
                        // calculate 1 hour pickup time to block
                        var original_test_start_time = $('.test_time_start').val();
                        //var one_hour_prev = parseInt(original_test_start_time) -3600- ((parseInt("<?php echo e($instructor->lesson_travel_time); ?>"))*60);
                        var one_hour_prev = parseInt(original_test_start_time) -3600;
                        inner_arr['ts'] = one_hour_prev;
                        checking_array.push(inner_arr);
                    }

                    for (var i = 0; i < checking_array.length; i++) {

                        var date = checking_array[i]['dt'];

                        var start = checking_array[i]['ts'];

                        var end = checking_array[i]['te'];


                        if( selected_date == date && ( (start_time >= start && start_time < end) || (end_time > start && end_time <= end) || (start_time < start && end_time > start) ) ){
                            swal('oops!', 'You have already chosen this day and time. Please choose another one', 'warning');
                            return false;
                        }
                    }

                    //$('.date_md').show();

                    $('#lesson_date').prop('selectedIndex',0);

                    // $("#label-continue-without-booking").hide();

                    // $("button:disabled").prop('disabled', false);

                    $('#show_slots').html('');

                    // $('.l-btn').hide();

                    var nextCount = ($("#lesson_time_hidden .dlc").length)+1;
                    var final_text='<div class="booked-lessons_items" id="mainLessonDiv_'+nextCount+'">' +
                        '<div class="lesson_info">' + '<h4>Driving Lesson <span class="dlc">'+nextCount+'</span>: (<span class="selectedhour">'+selected_hour+'</span>'+ext+')</h4>' +
                        '<p>'+selected_date_show+','+selected_time+'</p> ' +
                        '</div> ' +
                        '<div class="delete_lesson_info"> ' +
                        '<a href="javascript:void(0)" id="deleteLesson" class="del_selected text-decoration-none" data-index="'+nextCount+'" data-hour="'+selected_hour+'" data-date="'+selected_date+'" data-time="'+selected_time+'">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>' +
                        'Delete ' +
                        '<input type="hidden" class="final_hour" value="'+selected_hour+'">' +
                        '<input type="hidden" class="final_date" value="'+selected_date+'">' +
                        '<input type="hidden" class="final_time" value="'+selected_time+'">' +
                        '<input type="hidden" class="time_start" value="'+start_time+'">' +
                        '<input type="hidden" class="time_end" value="'+end_time+'">' +
                        '</a> ' +
                        '</div> ' +
                        '</div>';


                    $('#lesson_time_hidden').append(final_text).removeClass('d-none');

                    var total_time = $('#total_hour').val();
                    var rest_time = total_time-selected_hour;
                    $('#total_hour').val(rest_time);

                    $('div#addToCartSections').removeClass('d-none');
                    $('div#popoverDrivingLesson').addClass('d-none');;

                    var summations=0;
                    $('#lesson_time_hidden .selectedhour').each(function(index) {
                        // 'this' refers to each element with class .dlc
                        var calHour =parseInt($(this).text()); // Get the text content of the element
                        summations=summations+calHour;
                    });


                    $('span#totalbookingHour').text(summations);
                    $('#confirmSubmitEvent').html('Continue');

                    let previousTotalHour=$('input#previousTotalHour').val();
                    if (summations==Number(previousTotalHour)){
                        $('div#drivingLessonWrapper').addClass('d-none');
                    }else {
                        $('div#drivingLessonWrapper').removeClass('d-none');
                    }


                    let _1hour_checkbox = document.getElementById("one_hour");
                    let _2hour_checkbox = document.getElementById("two_hour");
                    let _1hourDiv = document.getElementById("one_hour_div");
                    let _2hourDiv = document.getElementById("two_hour_div");

                    _2hour_checkbox.removeAttribute("checked");
                    _2hourDiv.classList.remove("checked-hour");
                    $('input#two_hour').prop('checked', false);

                    $('input#one_hour').prop('checked', false);
                    _1hour_checkbox.removeAttribute("checked");
                    _1hourDiv.classList.remove("checked-hour");

                    $('#show_slots').html(` <select class="form-select availability_check" aria-label="Default select example">
                                            <option selected>Available Times</option>
                                        </select>`);

                    $('#addAnotherDrivingLesson').html('Add Another Lesson');
                }

            }

        }


        $(document).on('click','a#deleteLesson', function(event) {
            let currentIndex=$(this).data('index');
            let hour=$(this).data('hour');
            $('div#mainLessonDiv_'+currentIndex+'').remove();

            var nextCount = $("#lesson_time_hidden .dlc").length;
            if (nextCount==0 && $('div#changeLessonTestPackage').length==0){
                $('#lesson_time_hidden').addClass('d-none');
            }

            var summations=0;
            $('#lesson_time_hidden .selectedhour').each(function(index) {
                // 'this' refers to each element with class .dlc
                var calHour =parseInt($(this).text()); // Get the text content of the element
                summations=summations+calHour;
            });

            $('span#totalbookingHour').text(summations);

            let previousTotalHour=$('input#previousTotalHour').val();
            if (summations==previousTotalHour){
                $('div#drivingLessonWrapper').addClass('d-none');
            }else {
                $('div#drivingLessonWrapper').removeClass('d-none');
            }

            let tHour=$('#total_hour').val();
            $('#total_hour').val(Number(tHour)+Number(hour));


            if ($("#lesson_time_hidden .dlc").length==0 && $('div#changeLessonTestPackage').length==0){
                $('a#confirmSubmitEvent').html('CONTINUE WITHOUT BOOKING')
            }

            if ($("#lesson_time_hidden .dlc").length==0){
                $('h5#addAnotherDrivingLesson').html('DRIVING LESSON');
            }

            if ($('div#changeLessonTestPackage').length==0){
                $('h5#addmoreDrivingTestPackage').html('DRIVING <br> TEST PACKAGE');
            }

        });

        function summationsofBookingLesson(){
            var summations=0;
            $('#lesson_time_hidden .selectedhour').each(function(index) {
                // 'this' refers to each element with class .dlc
                var calHour =parseInt($(this).text()); // Get the text content of the element
                summations=summations+calHour;
            });
            return summations;
        }

          $(document).on('change','div#test_location', function(event) {
            $('#continueBtnEven2').show()
        });

        $(document).on('change','select#test_location', function(event) {
            if ($(this).val()!=0){
                $('div#testPakcageDate').show();
                $('select#test_location_date').show();
            }
        });

        $(document).on('change','#test_location_date', function(event) {
            //$('#continueBtnEven2').show()
            var start_date = this.value;
            document.getElementById("check_search_types").value = "testlocation";
            let h=$('input[name=hour]:checked').val();
            var bookly_id = '1';

            $.post('<?php echo e(url('get-slots1')); ?>',
                { hour: h, start_date:start_date, instructor_id: <?php echo e($instructor->id); ?>, userid: '<?php echo e($user_id); ?>', '_token': '<?php echo e(@csrf_token()); ?>' },
                function (data) {

                    $("#test_location").addClass('d-flex');
                    $("#show_slots1").addClass('d-flex');

                    $("#show_slots1").html('');

                    if(data.html == "already_booked")
                    {
                        $("select#test_location_date").hide();
                        $("#show_slots1").append('You can not book more test on the selected day!');
                    }
                    else
                    {
                        $("#test_location").show();
                        $("#show_slots1").show();
                        $("#show_slots1").append(data.html);
                        $("#date").text(start_date);
                        $("input[name='test_schedule_date']").val(start_date);
                    }
                });
        });

        function check_availiblity1(obj)

        {
            if($(obj).val()==''){
                $('.lt-btn').hide();
            }else{
                if( $('#test_location').find(":selected").val()!='' ) {
                    $('.lt-btn').show();
                }else{
                    $('.lt-btn').hide();
                }
            }

            var start_date_slot=$("#start_date_slot").val();
            var start_date_slot1=$("#start_date_slot1").val();
            var time_slot1=$(obj).val();

            if(start_date_slot==start_date_slot1)
            {
                $("[name=time_slot][value='"+time_slot1+"']").attr('disabled');
            }
            check_time()
        }

        function check_time(){

            let lesson_date = $("input[name='schedule_date']").val();
            let test_date = $("input[name='test_schedule_date']").val();
            if( lesson_date!='' && test_date!='' && lesson_date == test_date) {
                var lesson_start = $('select[name=time_slot] option:selected').attr('data-start');
                var lesson_end = $('select[name=time_slot] option:selected').attr('data-end');
                if ($('select[name=time_slot_test_time]').length>0) {
                    if($('select[name=time_slot_test_time]').val()!='') {
                        var test_start = $('select[name=time_slot_test_time] option:selected').attr('data-start');
                        var test_end = $('select[name=time_slot_test_time] option:selected').attr('data-end');
                        if(lesson_start<=test_end) {
                            if(lesson_end>= test_start) {
                                $('select[name=time_slot]').addClass('border-red');
                                $('select[name=time_slot_test_time]').addClass('border-red');
                                swal('oops!', 'Test And Lesson date time can not be same. Please select different time', 'warning');
                                $('.fa-spinner').addClass('hidden');
                                return false;
                            }
                        }

                        if(test_start<=lesson_end) {
                            if(test_end>= lesson_start) {
                                $('select[name=time_slot]').addClass('border-red');
                                $('select[name=time_slot_test_time]').addClass('border-red');
                                swal('oops!', 'Test And Lesson date time can not be same. Please select different time', 'warning');
                                $('.fa-spinner').addClass('hidden');
                                return false;
                            }
                        }
                    }
                }
            }
        }

        function save_lesson1(e)
        {
            var selected_time = $('select[name=time_slot_test_time] option:checked').val();
            var test_location_show = $('select[name=test_location] option:checked').val();
            if(selected_time==""){
                swal('Warning', 'Please select test start time.', 'warning');
            }
            else if(test_location_show==""){
                swal('Warning', 'Please select test location.', 'warning')
            }
            else
            {
                  $('button#continueBtnEven2').hide()

                var selected_date = $('select[name=test_location_date] option:checked').val();
                var selected_date_show = $('select[name=test_location_date] option:checked').text();

                var test_location = $('select[name=test_location] option:checked').val();
                var test_location_show = $('select[name=test_location] option:checked').text();

                var start_time = $('select[name=time_slot_test_time] option:checked').attr('data-start');

                var pick_up_time = $('select[name=time_slot_test_time] option:checked').attr('pickuptime');
                var startdate = $('select[name=time_slot_test_time] option:checked').attr('startdate');

                var end_time = $('select[name=time_slot_test_time] option:checked').attr('data-end');

                //====== check same time overlap

                var checking_array = new Array();



                if ($('.final_date').length > 0)

                {
                    var dt = $(".final_date");
                    var ts = $(".time_start");
                    var te = $(".time_end");
                    for(var i = 0; i < dt.length; i++)
                    {
                        const inner_arr = [];
                        inner_arr['dt'] = $(dt[i]).val();
                        inner_arr['ts'] = $(ts[i]).val();
                        inner_arr['te'] = $(te[i]).val();
                        checking_array.push(inner_arr);
                    }
                }

                var one_hour_prev_test = parseInt(start_time) - 3600;

                for (var i = 0; i < checking_array.length; i++) {

                    var date = checking_array[i]['dt'];
                    var start = checking_array[i]['ts'];
                    var end = checking_array[i]['te'];

                    if( selected_date == date && ( (one_hour_prev_test >= start && one_hour_prev_test < end) || (end_time > start && end_time <= end) || (one_hour_prev_test < start && end_time > start) ) ){
                        swal('oops!', 'You have already chosen this day and time. Please choose another one', 'warning');
                        $('.fa-spinner').addClass('hidden');
                        return false;
                    }
                }

                var start_date_format = new Date( (parseInt(start_time)) );

                var start_time_hour = parseInt(start_date_format.getHours());

                var start_time_minute = parseInt(start_date_format.getUTCMinutes());

                if(start_time_minute<10){ start_time_minute = start_time_minute+'0'; }

                var am = "am";

                if(start_time_hour > 12) { start_time_hour -= 12; am = "pm"; }

                else if (start_time_hour === 0){ start_time_hour = 12; }

                var start_time_to_show = start_time_hour + ":" + start_time_minute + " " + am;


                var pickup_stamp = parseInt(start_time) - (3600*15);

                var pickup_date_format = new Date(pickup_stamp*1000);

                var pickup_time_hour = parseInt(pickup_date_format.getUTCHours());

                var pickup_time_minute = parseInt(pickup_date_format.getUTCMinutes());

                if(pickup_time_minute<10){ pickup_time_minute = pickup_time_minute+'0'; }

                var am = "am";

                if(pickup_time_hour > 12) { pickup_time_hour -= 12; am = "pm"; }

                else if (pickup_time_hour === 0){ pickup_time_hour = 12; }

                else if (pickup_time_hour === 12){ am = "pm"; }

                var pickup_time_to_show = pickup_time_hour + ":" + pickup_time_minute + " " + am;

                if (!$('#lesson_time_hidden div').hasClass('change-lesson')){
                    var final_text='<div class="booked-lessons_items change-lesson" id="changeLessonTestPackage"> ' +
                        '<div class="lesson_info">' +
                        '<h4>Driving Test Package: (1hr)</h4>' +
                        '<p>'+selected_date_show+', '+pick_up_time+' pickup for a '+startdate+' test star</p>' +
                        '</div>' +
                        '<div class="delete_lesson_info">' +
                        '<a href="javascript:void(0)" id="deletePackage" class="text-decoration-none del_selected">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"></path></svg>' +
                        'Delete' +
                        '</a>' +
                        '<input type="hidden" class="final_date_test" value="'+selected_date+'">' +
                        '<input type="hidden" class="final_time_test" value="'+selected_time+'">' +
                        '<input type="hidden" class="final_location_test" value="'+test_location+'">' +
                        '<input type="hidden" class="test_time_start" value="'+start_time+'">' +
                        '<input type="hidden" class="test_time_end" value="'+end_time+'">' +
                        '</div>' +
                        '</div>';

                    $('div#lesson_time_hidden').append(final_text).removeClass('d-none');

                }else {
                    var final_text='<div class="lesson_info">' +
                        '<h4>Driving Test Package: (1hr)</h4>' +
                        '<p>'+selected_date_show+', '+pick_up_time+' pickup for a '+startdate+' test star</p>' +
                        '</div>' +
                        '<div class="delete_lesson_info">' +
                        '<a href="javascript:void(0)" id="deletePackage" class="text-decoration-none del_selected">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"></path></svg>' +
                        'Delete' +
                        '</a>' +
                        '<input type="hidden" class="final_date_test" value="'+selected_date+'">' +
                        '<input type="hidden" class="final_time_test" value="'+selected_time+'">' +
                        '<input type="hidden" class="final_location_test" value="'+test_location+'">' +
                        '<input type="hidden" class="test_time_start" value="'+start_time+'">' +
                        '<input type="hidden" class="test_time_end" value="'+end_time+'">' +
                        '</div>';

                    $('div#changeLessonTestPackage').html(final_text);
                }

                //change button text

                $('#addmoreDrivingTestPackage').html('UPDATE TEST LOCATION');
                $('#testBookingStatus').html('Booked');

                $('div#testPackagePopover').addClass('d-none');
                $('div#addToCartSections').removeClass('d-none');

                $("#test_location").removeClass('d-flex');
                $("#show_slots1").removeClass('d-flex');

                $("select#test_location_date").hide();
                $("#show_slots1").hide();

                $("select#test_location").val(0).trigger('change');

                $('#confirmSubmitEvent').html('Continue');
                //==== toggle continue button

                if($("#calender-container-test-location").is(":visible")){
                    console.log('y')
                    $('.btn-lg').css('display', 'none');
                }
                else {
                    console.log('n')
                    $('.btn-lg').css('display', 'block');
                }
            }
        }

        $(document).on('click','a#deletePackage', function(event) {
            $('#testBookingStatus').html('Not Booked');
            $('div#changeLessonTestPackage').remove();

            var nextCount = $("#lesson_time_hidden .dlc").length;
            if (nextCount==0 && $('div#changeLessonTestPackage').length==0){
                $('#lesson_time_hidden').addClass('d-none');
            }

            if ($("#lesson_time_hidden .dlc").length==0 && $('div#changeLessonTestPackage').length==0){
                $('a#confirmSubmitEvent').html('CONTINUE WITHOUT BOOKING')
            }

            if ($("#lesson_time_hidden .dlc").length==0){
                $('h5#addAnotherDrivingLesson').html('DRIVING LESSON');
            }

            if ($('div#changeLessonTestPackage').length==0){
                $('h5#addmoreDrivingTestPackage').html('DRIVING <br> TEST PACKAGE');
            }
        });


        $("a#confirmSubmitEvent").click(function(){
            $('#book_time').submit();
        });

        $(document).on('submit','#book_time', function(event){
            event.preventDefault(); // Prevent the default form submission

            var final_hour = new Array();
            var final_date = new Array();
            var final_time = new Array();
            var checking_array = new Array();

            if ($('.final_date').length > 0)
            {
                var tot = $(".final_hour");
                var dt = $(".final_date");
                var tm = $(".final_time");
                for(var i = 0; i < dt.length; i++)
                {
                    final_hour.push($(tot[i]).val());
                    final_date.push($(dt[i]).val());
                    final_time.push($(tm[i]).val());
                    checking_array.push( $(dt[i]).val() + '--' + $(tm[i]).val() );
                }
            }

            if ($('.final_date_test').length > 0)
            {
                var final_date_test = $('.final_date_test').val();
                var final_time_test= $('.final_time_test').val();
                var final_location_test = $('.final_location_test').val();
                checking_array.push( $('.final_date_test').val() + '--' + $('.final_time_test').val() );
            }

            var chkArrData = checking_array.sort();
            for (var i = 0; i < chkArrData.length - 1; i++) {
                if (chkArrData[i + 1] == chkArrData[i]) {
                    swal('oops!', 'You have already chosen this day and time. Please choose another one', 'warning');
                    $('.fa-spinner').addClass('hidden');
                    return false;
                }
            }

            var data = new FormData(this);

            var get_search = $("#check_search_types").val();
            data.append("search_type", '4');
            data.append("test_or_scheduale",get_search);
            data.append("final_hour",final_hour);
            data.append("final_date",final_date);
            data.append("final_time",final_time);
            data.append("final_date_test",final_date_test);
            data.append("final_time_test",final_time_test);
            data.append("test_location_id",final_location_test);

            var search_url ='<?php echo e(Route('search')); ?>?total=' + $('#total_hours').val();
            $('#total_hours').val(0);

            $.ajax({
                url: search_url,
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {
                    if(res.success == true && res.locate=='register'){
                        let url = "<?php echo e(url("/learners/register/$search_id")); ?>";
                        window.location.href=url;
                    }else if (res.success == true && res.locate=='home'){
                        let url = "<?php echo e(url("/login")); ?>";
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
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.cart',['mainclass'=>'cart'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7.4.9\htdocs\firstpass\resources\views/search/book.blade.php ENDPATH**/ ?>