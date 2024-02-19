@extends('frontend.layouts.app_guest')
@section('content')
    <link rel="stylesheet" href="{!! url ('frontend_assets/css/auto-complete.css') !!}">
    <section class="hero_section position-relative">
        <img src="{!! url ('frontend_assets/images/hero-bg.jpg') !!}" class="img-fluid hero-bg-mob" alt="">

        <div class="hero_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-7"></div>
                    <div class="col-xl-6 col-md-5 d-flex justify-content-end">
                        <div class="welcome_text_wrapper pe-xxl-0 pe-3">
                            <h1 class="welcome_sec_title">Find driving instructor</h1>
                            <p class="welcome_sec_subtitle">Welcome to First Pass<br>
                                Where learners become drivers</p>
                                <form class="form_section" method="post" action="" id="searchFormDesktop">
                                    @csrf
                                    <input type="hidden" name="search_type" value="1">
                                    <input type="hidden" name="type" value="auto">
                                    <input type="hidden" name="region" value="">

                                    <div class="search_tab_wrapper d-sm-inline-block d-none">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="auto-tab" data-bs-toggle="tab"  type="button" role="tab" aria-selected="true" onclick="change_toogle(0)">Auto</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="manual-tab" data-bs-toggle="tab" type="button" role="tab"  aria-selected="false" onclick="change_toogle(1)">Manual</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="auto-tab-pane" role="tabpanel" aria-labelledby="auto-tab" tabindex="0">
                                                    <div class="input-group search_input_wrapper">
                                                        <input class="form-control rounded-0 border-0"  id="suburb-input-search" name="suburb-input" type="text"/>
                                                        <ul id="suburb-list-desktop" name="suburb-list"></ul>
                                                    <button class="btn btn-primary disabled" id="searchIcon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="31" viewBox="0 0 33 31" fill="none" id="searchSvg">
                                                                <path d="M14.7927 26.4C22.1657 26.4 28.1427 20.7587 28.1427 13.8C28.1427 6.84116 22.1657 1.19995 14.7927 1.19995C7.41969 1.19995 1.44269 6.84116 1.44269 13.8C1.44269 20.7587 7.41969 26.4 14.7927 26.4Z" stroke="#17214D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M31.9571 30L24.3285 22.8" stroke="#17214D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                            <i class="fa fa-spinner fa-spin hidden"></i>
                                                        </button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="mob_search d-sm-none d-block">
            <form class="form_section" method="post" action="" id="searchFormMobile">
                @csrf
                <input type="hidden" name="search_type" value="1" id="search_type_mobile">
                <input type="hidden" name="type" value="auto">
                <input type="hidden" name="region" value="" id="regionMobile">
                <div class="search_tab_wrapper">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="auto-tab"  type="button" role="tab" onclick="change_mobile_toogle(0)" aria-selected="true">Auto</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="manual-tab" type="button" role="tab" onclick="change_mobile_toogle(1)" aria-selected="false">Manual</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="auto-tab-pane" role="tabpanel" aria-labelledby="auto-tab" tabindex="0">
                            <div class="input-group search_input_wrapper">
                                <input class="form-control rounded-0 border-0"  id="suburb-input-search-mobile" name="suburb-input" type="text"/>
                                <ul id="suburb-list-mobile" name="suburb-list"></ul>
                                     <button class="btn btn-primary disabled" id="searchIconMobile">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="31" viewBox="0 0 33 31" fill="none">
                                        <path d="M14.7927 26.4C22.1657 26.4 28.1427 20.7587 28.1427 13.8C28.1427 6.84116 22.1657 1.19995 14.7927 1.19995C7.41969 1.19995 1.44269 6.84116 1.44269 13.8C1.44269 20.7587 7.41969 26.4 14.7927 26.4Z" stroke="#17214D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M31.9571 30L24.3285 22.8" stroke="#17214D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
    <section class="our_services">
        <div class="container">
            <div class="service_wrapper mx-auto">
                <div class="row">
                    <div class="section_title">
                        <h2 class="mb-0">Let’s Get You On The Road</h2>
                        <p class="heading_description mx-auto">From the first time behind the wheel, to test day, we’ll guide you to success!</p>
                    </div>
                </div>
                <div class="row gx-3 gx-lg-4 gy-4 gy-lg-0 d-flex justify-content-center">
                    <div class="col-lg-4 col-md-6 col-12 d-flex d-md-block justify-content-center">
                        <div class="service_box service_1">
                            <div class="service_img">
                                <img src="{!! url ('frontend_assets/images/find-driving-instructor.png') !!}" class="img-fluid" alt="">
                            </div>
                            <div class="service_content">
                                <h3 class="service_content_heading">Find Driving Instructor</h3>
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        View instructor profile & availability
                                    </li>
                                    <li>
                                        Choose female or male instructor
                                    </li>
                                    <li>
                                        Change your instructor anytime
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex d-md-block justify-content-center">
                        <div class="service_box service_2">
                            <div class="service_img">
                                <img src="{!! url ('frontend_assets/images/book-driving-lessons.png') !!}" class="img-fluid" alt="">
                            </div>
                            <div class="service_content">
                                <h3 class="service_content_heading">Book Driving Lessons</h3>
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        24/7 online booking
                                    </li>
                                    <li>
                                        Reschedule your booking anytime
                                    </li>
                                    <li>
                                        Driving test & discounted packages
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex d-md-block justify-content-center">
                        <div class="service_box service_3 pt-0">
                            <div class="service_img">
                                <img src="{!! url ('frontend_assets/images/start-learning.png') !!}" class="img-fluid" alt="">
                            </div>
                            <div class="service_content">
                                <h3 class="service_content_heading">Start Learning</h3>
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        Instructor car or your own car
                                    </li>
                                    <li>
                                        Prepare for your driving test
                                    </li>
                                    <li>
                                        Complete your log book hours
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $test = \App\TestPackage::first();
    ?>
    <section class="driving_test">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center justify-content-center justify-content-md-end">
                    <div class="driving_test_img_wrapper text-end">
                        <img src="{!! url ('frontend_assets/images/driving-test-package.png') !!}" alt="">
                        <div class="priceing_box">
                            <p>Only<br>
                                <span>${{$test->price}} </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="driving_test_content">
                        <div class="section_title text-start">
                            <h2>Driving Test Package:</h2>
                        </div>
                        <ul class="list-unstyled test_list">
                            <li>
                                Pick-up 1 hour prior to test start
                            </li>
                            <li>
                                45 minute pre-test warm up lesson
                            </li>
                            <li>
                                Instructor car use for test
                            </li>
                            <li>
                                Drop-off after test result is received
                            </li>
                        </ul>
                        <a class="btn btn-primary book_test_package" href="{{route('testpack')}}">Book Test Packages Now</a>
                        <p>Test booking is not included in this package.<br>
                            You are required to book your driving test directly with your local road authority. Booking our test package will only book your instructor & vehicle.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="whay_first" id="aboutUsEctions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="whay_first_content">
                        <div class="section_title text-start">
                            <h2>Why Choose first pass?</h2>
                            <p>We make it fast & easy!</p>
                            <span>At First Pass, our priority is YOU!</span>
                        </div>
                        <p>Finding a quality driving instructor in your area can be a difficult and consuming task, that’s why we have built a comprehensive database of instructors for you to choose from.</p>
                        <p>Our reliable and trustworthy driving instructors will have you driving in no time.</p>
                        <p class="mb-0">First Pass offers the best quality services, with experienced instructors, well-maintained vehicles and flexible payment options to help you pass your test the first time.</p>
                        <a class="btn btn-primary book_now_btn" href="{{URL::to ('/driving-lessons#dlesson')}}">Book Now</a>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-center justify-content-md-start">
                    <div class="whay_first_img_wrapper text-start">
                        <img src="{!! url ('frontend_assets/images/why-choose-first-pass.png') !!}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="fun-experience">
        <div class="container-lg">
            <div class="sec-head text-center">
                <h2>Ready For A Safe, Fun Driving Experience?</h2>
                <p>At First Pass, we connect you with the best driving instructors</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="experience-card">
                        <img class="card-icon" src="{!! url ('frontend_assets/images/car-cap.png') !!}" />
                        <h3>1 hour = 3 logbook hours</h3>
                        <div class="block-desc">
                            <p>Every one hour of your daytime driving with a licensed driving instructor counts for
                                3 hours in your logbook. A maximum of 10 hours will be recorded as 30 hours in your
                                logbook.</p>
                            <p>Driving lessons at night (between sunset and sunrise) will only count<br> 1 hour of night
                                driving. The other 2 hours will be added to daytime driving hours.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="experience-card card-two">
                        <img class="card-icon" src="{!! url ('frontend_assets/images/learn-car.png') !!}" />
                        <h3>Learn in your car</h3>
                        <div class="block-desc">
                            <p>You may learn in your own car if it is registered, roadworthy and are comprehensively insured.</p>
                            <p>You should be a confident learner driver and ready for the driving<br> test.</p>
                            <p>We suggest you have one or more driving lessons in the instructor<br> car prior.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="experience-card card-three">
                        <img class="card-icon" height="74px" src="{!! url ('frontend_assets/images/drivers-licence.png') !!}" />
                        <h3>International drivers licence </h3>
                        <div class="block-desc">
                            <p>To easily convert your overseas drivers licence, simply book either a driving lesson or driving test
                                package. </p>
                            <p>There are no extra charges applied. Lessons will be<br> charged at the normal rate.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="experience-card card-four">
                        <img class="card-icon" src="{!! url ('frontend_assets/images/calendar.png') !!}" />
                        <h3>Book With Confidence </h3>
                        <div class="block-desc">
                            <p>Our mission at First Pass is to help you find the best driving<br> instructors near you offering the best quality of service and value for money.</p>
                            <p>Choose an instructor that suits your needs based on rating, gender, availability, car and transmission.</p>
                            <p>Only verified and approved instructors make it onto First Pass - no trainees.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>

        $(document).ready(function(){

            $('#suburb-input-search').keyup(function(){
                var search_key = $(this).val();

                $.ajax({
                    url: '{{ url('autocomplete-regions') }}?term='+search_key+'&_type=query&q='+search_key,
                    dataType : 'json',
                    success: function (data) {
                        $('#suburb-list-desktop').empty();
                        $('#suburb-list-desktop').addClass('suburb-list');
                        for(i=0; i<data.length; i++)
                        {
                            $('#suburb-list-desktop').append(`<li class='suburb-item' value="${data[i].id}">${data[i].title}</li>`);
                        }
                    }

                });

            });

            $('#suburb-input-search-mobile').keyup(function(){
                var search_key = $(this).val();

                $.ajax({
                    url: '{{ url('autocomplete-regions') }}?term='+search_key+'&_type=query&q='+search_key,
                    dataType : 'json',
                    success: function (data) {
                        $('#suburb-list-mobile').empty();
                        $('#suburb-list-mobile').addClass('suburb-list');
                        for(i=0; i<data.length; i++)
                        {
                            $('#suburb-list-mobile').append(`<li class='suburb-item-mobile' value="${data[i].id}">${data[i].title}</li>`);
                        }
                    }
                });
            });
        });

        $(document).on('submit', '#searchFormDesktop,#searchFormMobile', function(e){
            e.preventDefault(); // Prevent the default form submission
            $('i.fa.fa-spinner.fa-spin').removeClass('hidden');
            $('svg#searchSvg').addClass('hidden');

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
                        var search_url = "{{url('/instructors/search_id')}}/"+res.search_id;
                        window.location = search_url;
                    }else if(res.success == false){
                        swal('oops!', res.message, 'warning');
                    }
                    $('i.fa.fa-spinner.fa-spin').addClass('hidden');
                    $('svg#searchSvg').removeClass('hidden');
                },
                error: function () {
                    //$('.fa-spinner').addClass('hidden');
                }
            });

            return false;
        });

        $(document).on('click', '.suburb-item',  function(){
            var selected_keyword = $(this).text();
            var selected_id = $(this).attr('value');
            $('#suburb-input-search').val(selected_keyword);
            $('input[name=region]').val(selected_id);
            $('#suburb-list-desktop').empty();
            $('#suburb-list-desktop').removeClass('suburb-list');
             $('#searchIcon').removeClass('disabled');
        });

        $(document).on('click', '.suburb-item-mobile',  function(){
            var selected_keyword = $(this).text();
            var selected_id = $(this).attr('value');
            $('#suburb-input-search-mobile').val(selected_keyword);
            $('#regionMobile').val(selected_id);
            $('#suburb-list-mobile').empty();
            $('#suburb-list-mobile').removeClass('suburb-list');
              $('#searchIconMobile').removeClass('disabled');
        });

        function change_mobile_toogle(){
            if (child === 0) {
                $('#search_type_mobile').val('auto');
            }
            if (child === 1) {
                $('#search_type_mobile').val('manual');
            }
        }

        function change_toogle(child) {
            if (child === 0) {
                Array.from(document.querySelectorAll(".toogle-buttons")).forEach(
                    (element) => {
                        element.children[child].classList.add("btn-active");
                        element.children[child + 1].classList.remove("btn-active");
                    }
                );
                $('input[name=type]').val('auto');
            }
            if (child === 1) {
                Array.from(document.querySelectorAll(".toogle-buttons")).forEach(
                    (element) => {
                        element.children[child].classList.add("btn-active");
                        element.children[child - 1].classList.remove("btn-active");
                    }
                );
                $('input[name=type]').val('manual');
            }
        }

        /* ---------------------- input placeholder type Writer JS start ---------------------- */
        timeout_var = null;
        function typeWriter(
            selector_target,
            text_list,
            placeholder = false,
            i = 0,
            text_list_i = 0,
            delay_ms = 130
        ) {
            if (!i) {
                if (placeholder) {
                    Array.from(document.querySelectorAll(selector_target)).forEach(
                        (element) => (element.placeholder = "")
                    );
                } else {
                    Array.from(document.querySelectorAll(selector_target)).forEach(
                        (element) => (element.innerHTML = "")
                    );
                }
            }
            txt = text_list[text_list_i];
            if (i < txt.length) {
                if (placeholder) {
                    Array.from(document.querySelectorAll(selector_target)).forEach(
                        (element) => (element.placeholder += txt.charAt(i))
                    );
                } else {
                    Array.from(document.querySelectorAll(selector_target)).forEach(
                        (element) => (element.innerHTML += txt.charAt(i))
                    );
                }
                i++;
                setTimeout(
                    typeWriter,
                    delay_ms,
                    selector_target,
                    text_list,
                    placeholder,
                    i,
                    text_list_i
                );
            } else {
                text_list_i++;
                if (typeof text_list[text_list_i] === "undefined") {
                    setTimeout(
                        typeWriter,
                        delay_ms * 5,
                        selector_target,
                        text_list,
                        placeholder
                    );
                } else {
                    i = 0;
                    setTimeout(
                        typeWriter,
                        delay_ms * 3,
                        selector_target,
                        text_list,
                        placeholder,
                        i,
                        text_list_i
                    );
                }
            }
        }

        text_list = ["Enter your suburb...", " "];

        return_value = typeWriter("#suburb-input-search", text_list, true);
        return_value = typeWriter("#suburb-input-search-mobile", text_list, true);

    </script>
@endsection
