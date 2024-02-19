@extends('frontend.layouts.cart',['mainclass'=>'cart'])
@section('content')
    <?php
    $services_acc = json_decode($instructor->user_meta->services_accreditation);
    $showPopup=false;
    if (in_array(1, $services_acc)) {
        $showPopup=true;
    }
    ?>
    <style>
        /*.disbale {*/
        /*    background: #80808059;*/
        /*    pointer-events: none;*/
        /*    color: white;*/
        /*}*/
        .disable-check {
            pointer-events: none;
        }
        a.back_ancor {
            text-decoration: none;
        }
    </style>
    <!-- ---------------------- top Banner Section Start ----------------------- -->
    <section class="addtocart_top_banner">
    </section>
    <!-- ---------------------- Step choose Section Start ---------------------- -->
    <section class="step_choose-sec">
        <div class="step_choose_wrapper">
            <div class="step_choose_tab">
                <a href="javascript:history.back()" class="back_ancor"><button class="step_back_span"><img src="{!! url('frontend_assets/images/back-arrow.svg') !!}" alt="" ><span>Back    </span></button></a>
                <div class="step_tab_img">
                    <img class="img-fluid" src="{!! url('frontend_assets/images/step-tabs.svg') !!}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- ---------------------- Add To Cart Section Start ---------------------- -->
    <form id="book_form" class="w-100">
        @csrf
        <input type="hidden" value="<?=$search_id?>" name="search_id">
        <input type="hidden" value="<?=$instructor_id?>" name="instructor_id">
        <input type="hidden" value="0" name="total" id="totalAmount">
        <input type="hidden" value="0" name="dis" id="discountAMount">
        <input type="hidden" value="0" name="hr" id="totalQtyHour">
        <input type="hidden" value="no" name="is_lesson" id="is_lesson">
        <input type="hidden" value="{{ $region->price }}" name="hourly_rate">
        <input type="hidden" value="{{ $test_package->price }}" name="test_price">

        <section class="add_cart_sec">
            <div class="add_cart_wrapper">
                <div class="add_cart_heading">
                    <h2>Add to Cart</h2>
                </div>
                <div class="dl_tooltip_box dl_tooltip">
                    @if($showPopup)
                        <p id="instructor-message" class="tooltiptext">
                            <span id="instructor-name">{{ ucfirst( $instructor->name ) }}</span> only offers a Driving Test
                            Package<br />
                            to learners completing at least one Driving Lesson prior.<br />
                            Select another instructor who offers Driving Test only.
                        </p>
                    @endif
                    <div id="lesson_heading" class="driving_lessons_card checked-heading">
                        <div class="dl_heading">
                            <h3>Driving Lessons</h3>
                        </div>
                        <div class="dl_content_box">
                            <div class="dl_selection_box">
                                <div class="diving_lessons_checkbox <?=$showPopup?'disable-check':''?>">
                                    <label class="dl-container-checkbox">
                                        @if(isset($_REQUEST['test_type']) && $_REQUEST['test_type']!=2)
                                        <input onclick="checkTheBox('lessons')"  name="d_lesson" id="d_lesson" class="<?=$showPopup?'disable-check':''?>" type="checkbox" <?=(isset($_REQUEST['test_type']) && $_REQUEST['test_type']!=2)?'checked':''?>/>
                                        @else
                                        <input onclick="checkTheBox('lessons')"  name="d_lesson" id="d_lesson" class="<?=$showPopup?'disable-check':''?>" type="checkbox" checked >/>
                                        @endif
                                        <span class="dl_checkmark"></span>
                                    </label>
                                </div>
                                <div class="pack_price_list">
                                    <div class="dl_pkg_price">
                                        <h4 class="detail_sub_heading">Pricing</h4>
                                        <div class="pack_price_select">
                                            <select name="" id="lessongChange">
                                                <?php for ($i=1;$i<=100;$i++){?>
                                                <option value="<?=$i?>" <?php if ($i==10){echo "selected";}?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="pkg_lesson_tag">Lessons</span>
                                        </div>
                                    </div>
                                    <div class="dl_pkg_total">
                                        <button class="pkg_save_btn d-none" id="savingsPercentage">Save 5% OFF</button>
                                        <div class="pkg_price_total">
                                            <span>Total</span>
                                            <input type="hidden" value="{{ $region->price }}" id="drivingLessonPrice">
                                            <span>$<span id="totalPriceCalculations">{{ $region->price }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dl_packages_box">
                                <div class="pack_detail_inrbox">
                                    <h4 class="detail_sub_heading">Add more to save</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="package_list">
                                                <div class="package_plan_box">
                                                    <div class="pkg_plan">
                                                        <span>5%</span>
                                                        <span>Off</span>
                                                    </div>
                                                    <span class="pkg_plan-title">Bronze</span>
                                                </div>
                                                <div class="pkg_less">6-9 Lessons</div>
                                            </div>
                                            <div class="package_list">
                                                <div class="package_plan_box">
                                                    <div class="pkg_plan pkg_silver_plan">
                                                        <span>10%</span>
                                                        <span>Off</span>
                                                    </div>
                                                    <span class="pkg_plan-title">Silver</span>
                                                </div>
                                                <div class="pkg_less">10-19 Lessons</div>
                                            </div>
                                            <div class="package_list">
                                                <div class="package_plan_box">
                                                    <div class="pkg_plan pkg_gold_plan">
                                                        <span>12.5%</span>
                                                        <span>Off</span>
                                                    </div>
                                                    <span class="pkg_plan-title">Gold</span>
                                                </div>
                                                <div class="pkg_less">20-49 Lessons</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="package_list">
                                                <div class="package_plan_box">
                                                    <div class="pkg_plan pkg_platinum_plan">
                                                        <span>15%</span>
                                                        <span>Off</span>
                                                    </div>
                                                    <span class="pkg_plan-title">Platinum</span>
                                                </div>
                                                <div class="pkg_less">50-74 Lessons</div>
                                            </div>
                                            <div class="package_list">
                                                <div class="package_plan_box">
                                                    <div class="pkg_plan pkg_diamond_plan">
                                                        <span>20%</span>
                                                        <span>Off</span>
                                                    </div>
                                                    <span class="pkg_plan-title">Diamond</span>
                                                </div>
                                                <div class="pkg_less">75-100 Lessons</div>
                                            </div>
                                        </div>
                                    </div>


                                    <span class="pkg_list_msg">* You can book 1 hr or 2 hr driving lessons</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dl_testpack_box">
                    <div id="test_heading" class="driving_lessons_card checked-heading">
                        <div class="dl_heading">
                            <h3>Driving Test package</h3>
                        </div>
                        <div class="dl_content_box">
                            <div class="dl_selection_box">
                                <div class="diving_lessons_checkbox">
                                    <label class="dl-container-checkbox">
                                        <input onclick="checkTheBox('test')" id="d_test" type="checkbox" name="d_test" {{(isset($_REQUEST['type']) && $_REQUEST['type']=='package')?'checked':''}}/>
                                        <span class="dl_checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="dl_packages_box">
                                <div class="driving_testpack_content">
                                    <div class="driving_testpack_total">
                                        <h4 class="detail_sub_heading">Test Package</h4>
                                        <h2>$<span id="testpackge_price">{{ $test_package->price }}</span></h2>
                                    </div>
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
                </div>
                <div class="add_cart_page_btn text-end">
                    <button class="pkg_icard_book_btn" id="continueWithTotalValue">CONTINUE  (TOTAL $<span id="continueTotal"></span>)</button>
                </div>
            </div>
        </section>
    </form>
@endsection

@section('scripts')
    <script>
        //  import {parse} from "@fullcalendar/core/datelib/parsing";

        summationsOfTotal();
        function checkTheBox(type) {
            let test_checkbox = document.getElementById("d_test");
            let lesson_checkbox = document.getElementById("d_lesson");
            let lesson_heading = document.getElementById("lesson_heading");
            let test_heading = document.getElementById("test_heading");
            // let instructor_message = document.getElementById("instructor-message");

            if (type === "lessons") {
                if (!lesson_checkbox.getAttribute("checked")) {
                    lesson_checkbox.setAttribute("checked", "checked");
                    lesson_heading.classList.add("checked-heading");
                    // instructor_message.classList.remove("d-none");

                } else {
                    lesson_checkbox.removeAttribute("checked");
                    lesson_heading.classList.remove("checked-heading");
                    //   instructor_message.classList.add("d-none");
                }
            } else{
                if (!test_checkbox.getAttribute("checked")) {
                    test_checkbox.setAttribute("checked", "checked");
                    test_heading.classList.add("checked-heading");
                } else {
                    test_checkbox.removeAttribute("checked");
                    test_heading.classList.remove("checked-heading");
                }
            }
            summationsOfTotal();
        }

        $(document).on('change', 'select#lessongChange', function () {
            summationsOfTotal();
        });

        function summationsOfTotal(){
            if ($('#d_test').is(':checked') || $('#d_lesson').is(':checked')) {
                $('button#continueWithTotalValue').removeClass('disbale');
            }else {
                $('button#continueWithTotalValue').addClass('disbale');
            }

            var originalPrice   =$('input#drivingLessonPrice').val()||0;
            var totalAmount=0;
            var pricingQty       =$('select#lessongChange').val()||0;


            if ($('#d_lesson').is(':checked')){
                totalAmount           =pricingQty*parseInt(originalPrice);
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

                $('span#totalPriceCalculations').text(totalAmount);
                $('span#continueTotal').text(totalAmount);
                $('input#totalAmount').val(totalAmount);
            }else {
                totalAmount           =pricingQty*parseInt(originalPrice);
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

                $('span#totalPriceCalculations').text(totalAmount);
                $('span#continueTotal').text(totalAmount);
                $('input#totalAmount').val(totalAmount);

                $('span#continueTotal').text(0);
            }


            if ($('#d_test').is(':checked')){

                var packagePrice       =$('span#testpackge_price').text()||0;
                if ($('#d_lesson').is(':checked')){
                    totalAmount            =parseInt(packagePrice)+parseInt(totalAmount);
                    $('span#totalPriceCalculations').text(totalAmount);
                    $('span#continueTotal').text(totalAmount);
                    $('input#totalAmount').val(totalAmount);
                }else {
                    totalAmount=packagePrice;
                    $('span#continueTotal').text(totalAmount);
                    $('input#totalAmount').val(totalAmount);
                }
            }
        }


        $(document).on('submit','#book_form', function(event) {
            event.preventDefault(); // Prevent the default form submission

            if( $('#book_form').find('input[type=checkbox]:checked').length ==0 ){
                swal('Alert!', 'Please select one of the options', 'warning');
                return false;
            }

            var data = new FormData(this);

            data.append("search_type", '3');

            $.ajax({
                url: "{{Route('search')}}",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {

                    if(res.success == true){

                        let url = "{{ url("/book-online/book/$search_id/instructor/$instructor->id") }}";
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
@endsection
