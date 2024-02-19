@extends('frontend.layouts.search')
@section('content')
    <?php
                            $test = \App\TestPackage::first();
                            ?>

    <link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/js/calendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/list/main.css') }}" rel='stylesheet' />
    <style>
        .yellow { background: #f8ebdb !important; border: 1px solid #ccc !important; }
        .get-ready-cards{width: 100%;}
        .no-instructor .alert {    text-align: center;    color: red;    font-size: 20px; }
        .modal-content {    background-color: #fff;}
        .fc-toolbar button {    position: relative;}
        .fc-center div h2 {    float: left;    margin-top: 6px;}
        .fc-toolbar .fc-center {    display: inline-block;}
        .fc .fc-toolbar>*>:first-child {    margin-left: 0;}
        .fc .fc-toolbar>*>* {    float: left;    margin-left: .75em;}
        .fc .fc-toolbar .fc-center h2 {    margin-top: 5px;    font-size: 1.5rem !important;}
        ul.list-inline li, ol.list-inline li {      float: none;      display: inline-block;      vertical-align: middle;      margin-left: 0.9375rem;  }
        button.fc-next-button.fc-button.fc-button-primary {    margin-left: 18px;}
        .calendar-extra ul {    display: flex;    justify-content: space-evenly;    margin-top: 10px; }
        .calendar-extra .btn {    display: inline-block;    max-width: 300px;    margin-top: 15px; }
        .pull-right {    float: right; }
        .fc-bbg.red {    background: #8a8a8a;}
        .fc-bbg {    display: inline-block;    border: 1px solid #8a8a8a;    height: 20px;    width: 20px;    border-radius: 50%;}
        a#book_btn,button.btn.btn-secondary {
            background-color: #F4A640;
            color: #212A37;
            font-size: 16px;
            font-style: normal;
            font-family: 'Gilroy';
            font-weight: 700;
        }
    </style>

    <div class="_package_page_tab" style="@if(isset($_REQUEST['type']) && $_REQUEST['type']=='package') padding-top:100px;@endif">
        @if(isset($_REQUEST['type']) && $_REQUEST['type']=='package')
        @else
            <img src="{!! url ('frontend_assets/images/package-top-banner.svg') !!}" class="img-fluid w-100" alt="">
            <!-- ------------- Choose Instructor Section Start ------------- -->
            <section class="package_instructor_sec d-none d-md-block">
                <div class="package_instructor_box">
                    <div class="pack_detail_box pack_detail_box_one">
                        <div class="pack_detail_box_head">
                            <h3>Choose Instructor</h3>
                            <p>{{ $total }} Auto Instructors Available in</p>
                            <p class="bold">@if($region) {{$region->title}} @endif </p>
                        </div>
                    </div>
                    <div class="pack_detail_box pack_detail_box_two">
                        <div class="pack_detail_inrbox">
                            <h4 class="detail_sub_heading">Add more to save</h4>
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
                            <span class="pkg_list_msg">* You can book 1 hr or 2 hr driving lessons</span>
                        </div>
                    </div>
                    <div class="pack_detail_box pack_detail_box_three">
                        <div class="test_pack_price">
                            <h4 class="detail_sub_heading">Test Package</h4>
                            <h2>${{$test->price}}</h2>
                            <div class="test_pack_price_content">
                                <ul class="list-unstyled mb-0">
                                    <li>Pick up & drop off</li>
                                    <li>Warm up lesson</li>
                                    <li>Use instructor car</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pack_detail_box pack_detail_box_four">
                        <div class="pack_price_list">
                            <h4 class="detail_sub_heading">Pricing</h4>
                            <div class="pack_price_select">
                                <select name="" id="lessongChange">
                                    <?php for ($i=1;$i<=100;$i++){?>
                                    <option value="<?=$i?>" <?php if ($i==10){echo "selected";}?>><?=$i?></option>
                                    <?php } ?>
                                </select>
                                <span class="pkg_lesson_tag">Lessons</span>
                            </div>
                            <button class="pkg_save_btn d-none" id="savingsPercentage">Save 5% OFF</button>
                            <div class="pkg_price_total">
                                <span>Total</span>
                                <input type="hidden" value="70" id="drivingLessonPrice">
                                <span>$<span id="totalPriceCalculations">70</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- ------------------- Filters Container Section Start ------------------- -->
        <section class="pkg_filter_sec d-none d-md-block">
            <div class="pkg_filter_wrapper">
                <div class="pkg_filter_row">
                    <form class="pkg_filter_form" name="form1" id="form1">
                        <div class="row justify-content-between">
                            <div class="col-md-auto col-sm-6">
                                <div class="pkg_filter_box">
                                    <p>Gender:</p>
                                    <div class="gender_check_list">
                                        <div class="form-check filter-inst-field">
                                            <input class="form-check-input" type="radio" name="gender" id="male" data-field="gender" data-val="male" value="male">
                                            <label class="form-check-label" for="male"><img src="{!! url ('frontend_assets/images/male-profile-icon.svg') !!}" alt="">Male</label>
                                        </div>
                                        <div class="form-check filter-inst-field">
                                            <input class="form-check-input" type="radio" name="gender" id="female" data-field="gender" data-val="female" value="female">
                                            <label class="form-check-label" for="female"><img src="{!! url ('frontend_assets/images/female-profile-icon.svg') !!}" alt="">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6">
                                <div class="pkg_filter_box">
                                    <p>Availability:</p>
                                    <div class="gender_check_list">
                                        <div class="form-check filter-inst-field">
                                            <input class="form-check-input" type="radio" name="availability" id="weekdays" data-field="availability" data-val="weekdays" value="weekdays">
                                            <label class="form-check-label" for="weekdays">Weekdays</label>
                                        </div>
                                        <div class="form-check filter-inst-field">
                                            <input class="form-check-input" type="radio" id="weekend" data-field="availability" data-val="weekend" name="availability" value="weekend">
                                            <label class="form-check-label" for="weekend">Weekend</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6">
                                <div class="pkg_filter_box">
                                    <p>Set Time:</p>
                                    <div class="gender_check_list ">
                                        <div class="form-check filter-inst-field">
                                            <input class="form-check-input" type="radio" name="settime" id="am" data-field="time" data-val="am" value="am">
                                            <label class="form-check-label" for="am">AM</label>
                                        </div>
                                        <div class="form-check filter-inst-field">
                                            <input class="form-check-input" type="radio" name="settime" id="pm" data-field="time" data-val="pm" value="pm">
                                            <label class="form-check-label" for="pm">PM</label>
                                        </div>
                                        <div class="form-check filter-inst-field">
                                            <input class="form-check-input" checked type="radio" name="settime" id="any" data-field="time" data-val="any" value="any">
                                            <label class="form-check-label" for="any">Any Time</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto col-sm-6 mt-auto">
                                <div class="pkg_filter_btn"><button class="btn btn-primary" type="reset"  onclick="clearFilter()">Clear Filter</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- --------------------- Choose Instructor mob Section ---------------------- -->
        <section class="d-block d-md-none package_mobile">
            <div class="container p-0">
                <div class="row m-0">
                    <div class="instructor_box_mob col-12">
                        <h3>Choose Instructor</h3>
                        <p>{{ $total }} Auto Instructors Available in<br>
                            <span>Liverpool 2170</span></p>
                    </div>
                </div>
                <div class="filter_btn_wrapper">
                    <div class="filter_btns">
                        <button id="filter" onclick="showOption('filter')" class="btn btn-primary">Filter
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>
                        </button>
                        <button id="pricing"onclick="showOption('pricing')"class="btn btn-primary">Pricing
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/></svg>
                        </button>
                    </div>
                    <!-- filter box -->
                    <div class="d-none" target="1" id="filters-mobile">
                        <form class="pkg_filter_form" name="form1" id="form1">
                            <div class="row justify-content-between">
                                <div class="col-md-auto col-sm-12">
                                    <div class="pkg_filter_box">
                                        <p>Gender:</p>
                                        <div class="gender_check_list">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male_mob" data-field="gender" data-val="male" value="male">
                                                <label class="form-check-label" for="male_mob"><img src="{!! url ('frontend_assets/images/male-profile-icon.svg') !!}" alt="">Male</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female_mob" data-field="gender" data-val="female" value="female">
                                                <label class="form-check-label" for="female_mob"><img src="{!! url ('frontend_assets/images/female-profile-icon.svg') !!}" alt="">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-auto col-sm-12">
                                    <div class="pkg_filter_box">
                                        <p>Availability:</p>
                                        <div class="gender_check_list">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="availability" id="weekdays_mob" data-field="availability" data-val="weekdays" value="weekdays">
                                                <label class="form-check-label" for="weekdays_mob">Weekdays</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="availability" id="weekend_mob" data-field="availability" data-val="weekend" value="weekend">
                                                <label class="form-check-label" for="weekend_mob">Weekend</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-auto col-sm-12">
                                    <div class="pkg_filter_box">
                                        <p>Set Time:</p>
                                        <div class="gender_check_list">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="settime" id="am_mob" data-field="time" data-val="am" value="am">
                                                <label class="form-check-label" for="am_mob">AM</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="settime" id="pm_mob" data-field="time" data-val="pm" value="pm">
                                                <label class="form-check-label" for="pm_mob">PM</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="settime" id="anytime_mob" data-field="time" data-val="any" value="any">
                                                <label class="form-check-label" for="anytime_mob">Any Time</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-auto col-sm-12 mt-auto">
                                    <div class="pkg_filter_btn"><button class="btn btn-primary" type="reset" onclick="clearFilter()">Clear Filter</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="pricing_mob d-none" target="2" id="packages-mobile">
                        <div class="package_instructor_box">
                            <div class="pack_detail_box pack_detail_box_four">
                                <div class="pack_price_list">
                                    <div class="col-sm-6 col-7">
                                        <h4 class="detail_sub_heading">Pricing</h4>
                                        <div class="pack_price_select">
                                            <select name="" id="lessongChange2">
                                                <?php for ($i=1;$i<=100;$i++){?>
                                                <option value="<?=$i?>" <?php if ($i==10){echo "selected";}?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="pkg_lesson_tag">Lessons</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-4">
                                        <button class="pkg_save_btn" id="savePercentageData">Save 5% OFF</button>
                                        <div class="pkg_price_total">
                                            <span>Total</span>
                                            <span>$<span id="totalPriceCalculations2">70</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pack_detail_box pack_detail_box_two">
                                <div class="pack_detail_inrbox">
                                    <h4 class="detail_sub_heading">Add more to save</h4>
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
                                    <span class="pkg_list_msg">* You can book 1 hr or 2 hr driving lessons</span>
                                </div>
                            </div>
                            <div class="pack_detail_box pack_detail_box_three">
                                <div class="test_pack_price">
                                    <h4 class="detail_sub_heading" data-bs-toggle="modal" data-bs-target="#packDetail">Test Package
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                            <path d="M6.00107 11.9999C2.68403 12.0005 0.00265942 9.32205 1.97048e-06 6.00685C-0.00265548 2.67942 2.68297 -0.00324742 6.01382 -5.81945e-05C9.32501 0.00313103 12.0016 2.68899 12 6.00685C11.9979 9.32205 9.31757 11.9999 6.00107 11.9999ZM5.99681 1.68598C5.40048 1.68757 4.90991 2.19094 4.95084 2.7868C5.05661 4.34101 5.16981 5.89417 5.28834 7.44732C5.32182 7.88531 5.60723 8.15108 6.00425 8.14895C6.40022 8.14682 6.67925 7.88212 6.71273 7.43988C6.83125 5.88672 6.94712 4.33357 7.05076 2.77935C7.09009 2.18297 6.59315 1.68439 5.99681 1.68598ZM6.00691 8.70388C5.53335 8.70069 5.14696 9.08499 5.14855 9.55806C5.14962 10.0083 5.54186 10.4021 5.99362 10.4064C6.44592 10.4106 6.84188 10.0258 6.85145 9.57135C6.86155 9.09934 6.47994 8.70706 6.00691 8.70388Z" fill="#F4A640"/>
                                            <path d="M5.99708 1.68555C6.59341 1.68396 7.09035 2.18201 7.05049 2.77946C6.94738 4.33367 6.83152 5.88683 6.71246 7.43998C6.67845 7.88222 6.39995 8.14693 6.00399 8.14905C5.60696 8.15118 5.32155 7.88541 5.28807 7.44742C5.17008 5.89427 5.05634 4.34058 4.95057 2.7869C4.91018 2.19104 5.40074 1.68715 5.99708 1.68555Z" fill="white"/>
                                            <path d="M6.00733 8.70412C6.48036 8.7073 6.86197 9.09905 6.85134 9.57159C6.84177 10.0255 6.44581 10.4109 5.99351 10.4066C5.54174 10.4024 5.15003 10.0085 5.14844 9.5583C5.14738 9.08576 5.53377 8.70146 6.00733 8.70412Z" fill="white"/>
                                        </svg>
                                    </h4>
                                    <h2>$<span id="testpackge_price">{{$test->price}}</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- --------------------- Instructor Profile Section ---------------------- -->
        <section class="pkg_profilebox_sec">
            <div class="pkg_profile_wrapper">
                <div class="pkg_profile_row">
                    <div class="@if(!$users->isEmpty()) pkg_profile_grid @endif" id="instructorGrid">
                        @if(!$users->isEmpty())
                        @foreach ($users as $user)
                            @php
                            $language = json_decode($user->language);
                            if($language!=''){
                                $language = array_slice($language, 0, 3);
                                $language = implode(', ', $language);
                            }

                            if($user->preferred_name!=""){ $name = $user->preferred_name; }
                            else { $name = $user->name; }
                            @endphp

                              <div class="pkg_profile_card">
                                    <div class="pkg_icard_img">
                                        @if( $user->avatar == '')
                                            <img src="{{ url('assets/images/users/default.png') }}" alt="user" >
                                        @else
                                            <img src="{{ url('assets/images/users/'.$user->avatar) }}" alt="user" >
                                        @endif
                                    </div>
                                    <div class="pkg_icard_content">
                                        <div class="pkg_icard_head">
                                            <h3 class="pkg_icard_name">{{ $name }}</h3>
                                            <span class="pkg_icard_lang">Speaks {{ $language }}
                                          </span>
                                        </div>
                                        <div class="pkg_icard_buttons">
                                            <a href="{{ url('/search/'.$search_id.'/instructors/profile/'.$user->id) }}" class="icard_button_profile">
                                                <span> View Profile </span>
                                            </a>
                                            <button class="icard_button_times" data-id="{{$user->id}}" onclick="return openCal('{{$user->id}}', '{{ $name }}', '{{ $search_id }}');">
                                                <img src="{!! url('frontend_assets/images/pro-calender-icon.svg') !!}" alt="">
                                                <span> Available Times</span>
                                            </button>
                                        </div>
                                        <a href="{{ url('book-online/'.$search_id.'/instructor/'.$user->id) }}{{isset($_REQUEST['type']) && $_REQUEST['type']=='package'?'?type='.$_REQUEST['type'].'&test_type='.$_REQUEST['test_type']:''}}" class="pkg_icard_book_btn">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                         @endforeach
                        @else
                            <div class="col-12 no-instructor">
                                <div class="alert alert-light" role="alert">
                                    No instructor available!
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="availability_modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-100" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100"> Check Instructor Availability <div class="pull-right"> <div class="fc-bbg red"></div> <small>Booked out</small> <div class="fc-bbg"></div> <small>Available</small> </div>  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="small-padding-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                            <div class="row calendar-extra">
                                <div class="col-md-12">

                                    <ul class="list-inline text-center small-margin-bottom-20 small-fontsize-12">
                                        <li>• Driving lesson duration = 1 hour or 2 hours</li>
                                        <li>• Driving test package duration = 2.5 hours</li>
                                        <!-- <li>• Booking start times are in 15 minute increments</li> -->
                                    </ul>
                                    <a id="book_btn" href="" class="btn btn-block btn-warning text-uppercase"><span id="show_name"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background:#17214d;color: white ">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/calendar/packages/core/main.js') }}"></script>
<script src="{{ asset('assets/js/calendar/packages/interaction/main.js') }}"></script>
<script src="{{ asset('assets/js/calendar/packages/daygrid/main.js') }}"></script>
<script src="{{ asset('assets/js/calendar/packages/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/calendar/packages/timegrid/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function openCal(inst_id, inst_name, search_id){
        $('div#calendar').html('');

        //let inst_id = $(this).attr('data-id');
        $('#availability_modal').modal('show');
        $('#show_name').html('Book With '+inst_name);
        $('#book_btn').attr("href", base_url+"book-online/"+search_id+"/instructor/"+inst_id+'?type={{isset($_REQUEST['type']) && $_REQUEST['type']=='package'?$_REQUEST['type']:''}}&test_type={{isset($_REQUEST['type']) && $_REQUEST['type']=='package'?$_REQUEST['test_type']:''}}');

        setTimeout(function() {
            $.ajax({
                url: '{{ url('load_events') }}',
                type: 'POST',
                data: {
                    type: 'check_availability',
                    id: inst_id,
                },
                success: function(response) {
                    myCalendar(response.events, response.avl);
                }
            });

            return false;
        }, 400);

    }

    $(document).on('click', '.openCal', function (e) {
        let inst_id = $(this).data('inst_id');
        let inst_name = $(this).data('inst_name');
        let search_id = $(this).data('search_id');
        $('#calendar').html('');

        //let inst_id = $(this).attr('data-id');
        $('#availability_modal').modal('show');
        $('#show_name').html('Book With '+inst_name);
        $('#book_btn').attr("href", "book-online/"+search_id+"/instructor/"+inst_id+'?type={{isset($_REQUEST['type']) && $_REQUEST['type']=='package'?$_REQUEST['type']:''}}&test_type={{isset($_REQUEST['type']) && $_REQUEST['type']=='package'?$_REQUEST['test_type']:''}}');

        $.ajax({
            url: '{{ url('load_events') }}',
            type: 'post',
            data: {
                type: 'check_availability',
                id: inst_id,
            },
            success: function(response) {
                myCalendar(response.events, response.avl);
            }
        });

        return false;
    });

    function myCalendar(events_ar, avl_ar){

        let ev = events_ar;
        let avl = avl_ar;
        console.log(ev);
        console.log(avl);
        //Object.assign({}, avl);
        //const myJSON = JSON.stringify(avl);

        var today = moment().format("YYYY-MM-DD");
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'timeGrid'],
            defaultView: 'timeGridWeek',
            contentHeight:"auto",
            minTime: "05:00:00",
            maxTime: "22:00:00",
            columnHeader: true,
            columnHeaderText: function(date) {
                return moment(date).format('ddd DD/M');
            },
            //viewSkeletonRender: renderViewColumns,
            header: {
                left: 'today',

                center: 'prev, title,next',

                right: 'month,agendaWeek,agendaDay'
            },
            initialView: 'timeGridWeek',
            defaultDate: today,
            events:ev,
            businessHours: avl,
        });

        calendar.render();
    }

    var search_id = "{{ $search_id }}";
    $(document).on('click', "input[name='gender'],input[name='availability'],input[name='settime']", function(){
         doFilter($(this));
    });

    $("#test_location_date-search").change(function(){
        doFilter($(this));
    });

    function doFilter(field){

        var selectedGender =  $("input[name='gender']:checked").val()||null;
        var selectedAvailability =  $("input[name='availability']:checked").val()||null;
        var selectedTime =$("input[name='settime']:checked").val()||null;

        let extraUrl='';
        @if(isset($_REQUEST['type']) && $_REQUEST['type']='package')

            extraUrl='?type={{$_REQUEST['type']}}&test_type={{$_REQUEST['test_type']}}&test_location={{$_REQUEST['test_location']}}'
        @endif

        $.ajax({
            url: "{{url('search-filter')}}/"+search_id+extraUrl,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            data: {gender:selectedGender, availability: selectedAvailability, time: selectedTime},
            // contentType: false,
            // processData: false,
            type: 'post',
            success: function (res) {
                // $('#load_results').addClass('d-none')
                $('#load_results').empty();
                $('#load_results').removeClass('d-none');
                $('div#instructorGrid').empty();

                var html;
                if(res.message.length > 0){
                    for (var a = 0; a < res.message.length; a++) {
                        if(res.message[a].avatar){
                            var user_img = res.message[a].avatar;
                        }else{
                            var user_img = 'default.png';
                        }
                        var user_id = res.message[a].id;
                        var user_name = res.message[a].name;

                        var language = jQuery.parseJSON(res.message[a].language);

                        if(language!=''){
                             language = language.slice(0, 3).join(', ');
                        }

                        html=`<div class="pkg_profile_card">
                                    <div class="pkg_icard_img">
                                                <img src="{{ url("assets/images/users/") }}/${user_img}" alt="user">
                                        </div>
                                    <div class="pkg_icard_content">
                                        <div class="pkg_icard_head">
                                            <h3 class="pkg_icard_name">${user_name}</h3>
                                            <span class="pkg_icard_lang">Speaks ${language}
                                          </span>
                                        </div>
                                        <div class="pkg_icard_buttons">
                                            <a href="{{ url("/search/".$search_id."/instructors/profile/") }}/${user_id}" class="icard_button_profile">
                                                <span> View Profile </span>
                                            </a>
                                            <button class="icard_button_times" data-id="${user_id}" onclick="return openCal('${user_id}', '${user_name}', '{{ $search_id }}');">
                                                <img src="http://localhost/firstpass/frontend_assets/images/pro-calender-icon.svg" alt="">
                                                <span> Available Times</span>
                                            </button>
                                        </div>
                                        <a href="{{ url('book-online/'.$search_id.'/instructor/') }}/${user_id}?type={{isset($_REQUEST['type']) && $_REQUEST['type']=='package'?$_REQUEST['type']:''}}&test_type={{isset($_REQUEST['type']) && $_REQUEST['type']=='package'?$_REQUEST['test_type']:''}}" class="pkg_icard_book_btn">
                                            Book Now
                                        </a>
                                    </div>
                                </div>`

                        $('div#instructorGrid').append(html);

                    }

                }
                else{
                    $('div#instructorGrid').addClass('no-data-available')
                    html = `<div class="col-12 no-instructor">
                            <div class="alert alert-light" role="alert">
                                No instructor available!
                            </div>
                          </div>`;
                    $('#instructorGrid').append(html);
                }

            }
        });
    }


    function clearFilter(){
        $("#male").removeClass('yellow');
        $("#female").removeClass('yellow');
        $("#weekdays").removeClass('yellow');
        $("#weekend").removeClass('yellow');
        $("#time-filter a").removeClass('yellow');

        $("input[name='gender']").prop('checked', false);
        $("input[name='availability']").prop('checked', false);
        $("input[name='settime']").prop('checked', false);

        doFilter();
    }

    $('#searchForm').submit(function (){

        $('.fa-spinner').removeClass('hidden');

        var data = new FormData(this);

        data.append("search_id", 1);

        $.ajax({
            url: "{{Route('search')}}",
            data: data,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (res) {

                if(res.success == true){

                    // $('.total_inst').html(res.total);
                    // $('.final_type').html(res.t_type);

                    // $('.area').text(res.title);

                    // $('#load_instructors').html(res.view);
                    // $('#search_modal').modal('show');

                    // window.history.replaceState("", "", "{{url('/')}}/"+res.search_id);
                    var search_url = "{{url('/instructors/search_id')}}/"+res.search_id;
                    window.location = search_url;

                }else if(res.success == false){
                    swal('oops!', res.message, 'warning');

                }
                $('.fa-spinner').addClass('hidden');
            },
            error: function () {
                $('.fa-spinner').addClass('hidden');
            }
        });

        return false;
    });


    $(document).on('click', "button.close,button.btn.btn-secondary", function(){
        $('div#availability_modal').modal('hide');
    });

</script>

<script>
    let filter_btn_active = false;
    let pricing_btn_active = false;

    function showOption(option) {

        const filter_btn = document.getElementById("filter");
        const pricing_btn = document.getElementById("pricing");
        const filterDoc = document.getElementById("filters-mobile");
        const pricingDoc = document.getElementById("packages-mobile");

        function activeFilterBtn() {
            filter_btn.classList.add("active_btn");
            filterDoc.classList.remove("d-none");
            filter_btn_active = true;
        }
        function restoreFilterBtn() {
            filter_btn.classList.remove("active_btn");
            filterDoc.classList.add("d-none");
            filter_btn_active = false;
        }
        function activePricingBtn() {
            pricing_btn.classList.add("active_btn");
            pricingDoc.classList.remove("d-none");
            pricing_btn_active = true;
        }
        function restorePricingBtn() {
            pricing_btn.classList.remove("active_btn");
            pricingDoc.classList.add("d-none");
            pricing_btn_active = false;
        }
        if (option === "filter") {
            if (!filter_btn_active) {
                activeFilterBtn();
                restorePricingBtn();
            } else {
                restoreFilterBtn();
            }
        }

        if (option === "pricing") {
            if (!pricing_btn_active) {
                activePricingBtn();
                restoreFilterBtn();
            } else {
                restorePricingBtn();
            }
        }
    }


    $(document).on('change', 'select#lessongChange', function () {
        summationsOfTotal();
    });

    $(document).on('change', 'select#lessongChange2', function () {
        summationsOfTotal2();
    });

    summationsOfTotal();
    summationsOfTotal2();

    function summationsOfTotal2(){

        var originalPrice   =$('input#drivingLessonPrice').val()||0;
        var totalAmount=0;
        var pricingQty       =$('select#lessongChange2').val()||0;

        totalAmount           =pricingQty*parseInt(originalPrice);
        var valueCurrent       =$('select#lessongChange2').val()||0;
        if(valueCurrent<6) {
            totalAmount = parseInt(originalPrice) * valueCurrent;
            $('button#savePercentageData').addClass('d-none');
        }else if(valueCurrent >5 && valueCurrent < 10 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*5)/100);
            totalAmount = calcualtedData-pkg;

            $('button#savePercentageData').text('5% OFF').removeClass('d-none');
        }else if(valueCurrent >=10 && valueCurrent < 20 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*10)/100);
            totalAmount = calcualtedData-pkg;

            $('button#savePercentageData').text('10% OFF').removeClass('d-none');
        }else if(valueCurrent >=20 && valueCurrent < 50 ){
            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*12.5)/100);
            totalAmount = calcualtedData-pkg;

            $('button#savePercentageData').text('12.5% OFF').removeClass('d-none');
        }else if(valueCurrent >=50 && valueCurrent < 75 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*15)/100);
            totalAmount = calcualtedData-pkg;

            $('button#savePercentageData').text('15% OFF').removeClass('d-none');
        }else if(valueCurrent >=75 && valueCurrent <= 100 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*20)/100);
            totalAmount = calcualtedData-pkg;


            $('button#savePercentageData').text('20% OFF').removeClass('d-none');
        }

        $('span#totalPriceCalculations2').text(totalAmount);
    }

    function summationsOfTotal(){

        var originalPrice   =$('input#drivingLessonPrice').val()||0;
        var totalAmount=0;
        var pricingQty       =$('select#lessongChange').val()||0;

        totalAmount           =pricingQty*parseInt(originalPrice);
        var valueCurrent       =$('select#lessongChange').val()||0;
        if(valueCurrent<6) {
            totalAmount = parseInt(originalPrice) * valueCurrent;
            $('button#savingsPercentage').addClass('d-none');
        }else if(valueCurrent >5 && valueCurrent < 10 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*5)/100);
             totalAmount = calcualtedData-pkg;

            $('button#savingsPercentage').text('5% OFF').removeClass('d-none');
        }else if(valueCurrent >=10 && valueCurrent < 20 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*10)/100);
            totalAmount = calcualtedData-pkg;

            $('button#savingsPercentage').text('10% OFF').removeClass('d-none');
        }else if(valueCurrent >=20 && valueCurrent < 50 ){
            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*12.5)/100);
            totalAmount = calcualtedData-pkg;

            $('button#savingsPercentage').text('12.5% OFF').removeClass('d-none');
        }else if(valueCurrent >=50 && valueCurrent < 75 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*15)/100);
            totalAmount = calcualtedData-pkg;

            $('button#savingsPercentage').text('15% OFF').removeClass('d-none');
        }else if(valueCurrent >=75 && valueCurrent <= 100 ){

            let calcualtedData = parseFloat(originalPrice) * valueCurrent;
            let pkg = Math.round( (calcualtedData*20)/100);
            totalAmount = calcualtedData-pkg;


            $('button#savingsPercentage').text('20% OFF').removeClass('d-none');
        }

        $('span#totalPriceCalculations').text(totalAmount);
    }

</script>
@endsection
