<?php $__env->startSection('content'); ?>
    <?php
    $test = \App\TestPackage::first();
    ?>
    <style>
        .add-border {
            border: 1px solid #7f9be4;
            border-radius: 10px;
        }
        a.btn.btn-info.btn-outline-info.btn-sm{
            color: black;
        }
        .profile_btn {
            margin-top: 11px;
        }
        .col-md-12.mt-2.book_now_btn a {
            color: white;
        }
        #search_modal .col-md-12.mt-2.book_now_btn a {
            color: black;
        }
        #search_modal .profile_cont_wrap a, #load_instructors .profile_cont_wrap a {
          padding-bottom: 0px!important;
        }
        .suburb-list{
            top: 67px!important;
            min-width: 442px!important;
        }
    </style>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/bootstrap.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo url ('frontend_assets/css/auto-complete.css'); ?>">
    <!-- ---------------------- top Banner Section Start ----------------------- -->
    <section class="test_package_banner">
        <img src="<?php echo url ('frontend_assets/images/test-package-banner.jpg'); ?>" class="img-fluid" alt="">
    </section>
    <!-- ------------- Driving Test Package included Section Start ------------- -->
    <section class="driving_test_pack">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="driving_package_inc">
                        <div class="driving_package_inc_box">
                            <div class="section_title text-start">
                                <h3>$<?php echo e($test->price); ?> <span>Only</span></h3>
                                <h2>Driving test package includes:</h2>
                            </div>
                            <ul class="list-unstyled test_list mb-0">
                                <li>
                                    Pick-up 1 hour prior to test start
                                </li>
                                <li>
                                    45 minute pre-test warm up lesson
                                </li>
                                <li class="d-sm-block d-none">
                                    Use of instructors car for your practical driving test
                                </li>
                                <li class="d-sm-none d-block">
                                    Instructor’s car use for driving test
                                </li>
                                <li class="mb-0">
                                    Drop-off after test result is received
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------------- Choose one of the packages: Section Start -------------- -->
    <section class="packages_service">
        <div class="container">
            <div class="service_wrapper mx-auto">
                <div class="row">
                    <div class="section_title">
                        <h2 class="mb-0">Choose one of the packages:</h2>
                    </div>
                </div>
                <div class="row gx-3 gx-lg-4 gy-4 gy-lg-0 choose_packages">
                    <div class="col-lg-6 col-md-6 col-12 d-flex d-md-block justify-content-center" id="packages_box_packages_1">
                        <div onclick="choosePkg('driving only')" tabindex="1">
                            <div class="packages_box packages_1">
                                <div class="packages_img">
                                    <img src="<?php echo url ('frontend_assets/images/package-01.png'); ?>" class="img-fluid" alt="">
                                </div>
                                <div class="packages_content">
                                    <h3>Driving Test Only</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 d-flex d-md-block justify-content-center" id="packages_box_packages_2">
                        <div onclick="choosePkg('driving test')" tabindex="2">
                            <div class="packages_box packages_2">
                                <div class="packages_img">
                                    <img src="<?php echo url ('frontend_assets/images/package-02.png'); ?>" class="img-fluid" alt="">
                                </div>
                                <div class="packages_content">
                                    <h3 class="service_content_heading">Driving Test with lessons</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="choosed-container packages_choose_box d-none" id="packages_box_packages">
        <div class="choose-1">
            <div class="test_with_lesson test_only_driving">
                <h5>Find Driving Instructor</h5>

                <div class="search_tab_wrapper">
                    <form class="form_section" method="post" action="" id="searchFormDesktop">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="search_type" value="1">
                        <input type="hidden" name="type" value="auto">
                        <input type="hidden" name="region" value="">
                        <input type="hidden" name="selected_type" value="" id="selectedPackage">

                        <div class="search_tab_wrapper d-sm-inline-block">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="auto-tab" data-bs-toggle="tab"  type="button" role="tab" aria-selected="true" onclick="change_toogle(0)">Auto</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="manual-tab" data-bs-toggle="tab" type="button" role="tab"  aria-selected="false" onclick="change_toogle(1)">Manual</button>
                                </li>
                            </ul>
                            <div class="tab-content driving-lesson" id="myTabContent">
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

                <div class="choose_test_location" id="choseLocations" style="display: none">
                    <h3>Choose Test Location</h3>

                    <div class="select_area_container append_new">

                    </div>

                    <p>Select 'any test location' from the dropdown if your driving test has not been booked yet.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="search_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-85" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Book Instructor Online </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalClose">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div style="    background: #F4A640;
    padding: 18px 0;
    color: #0A0951 !important; padding: 18px 0">
                    <div class="col-md-12">
                        <h5 class="font-condensed small-margin-top-20 small-margin-bottom-10">
                            <small class="caps">Step 2<br></small>
                            Choose your instructor
                        </h5>
                        <p>We have <strong> <span class="total_inst">28</span> auto instructors</strong> available in <strong class="area"></strong></p>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="instructor-profile-banner small-padding-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="load_instructors"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose" style="background:#17214d;color: white ">Close</button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>

        $(document).ready(function(){


            $(window).on("resize", function (e) {
                checkScreenSize();
            });

            checkScreenSize();
            
            function checkScreenSize(){
                var newWindowWidth = $(window).width();
                if (newWindowWidth < 767) {
                    $("#packages_box_packages_1, #packages_box_packages_2").click(function() {
                $([document.documentElement, document.body]).animate({
                        scrollTop: $("#packages_box_packages").offset().top-30
                    }, 1000);
                });
                }
                else{}
            }
            

            $('#suburb-input-search').keyup(function(){
                var search_key = $(this).val();
                $.ajax({
                    url: '<?php echo e(url('autocomplete-regions')); ?>?term='+search_key+'&_type=query&q='+search_key,
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
                    url: '<?php echo e(url('autocomplete-regions')); ?>?term='+search_key+'&_type=query&q='+search_key,
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


        $(document).on('click', '#modalClose', function(e){
            $('#search_modal').modal('hide');
        });

        $(document).on('submit', '#searchFormDesktop,#searchFormMobile', function(e){
            e.preventDefault(); // Prevent the default form submission
            $('.fa-spinner').removeClass('hidden');

            var data = new FormData(this);

            data.append("search_id", 1);

            let test_type=1;
            let test_location='';
            if ($('input#selectedPackage').val()=='driving_test_only'){
                data.append("test_type",2);
                data.append("test_location", $('select#test_location').val());
                test_type=2;
                test_location=$('select#test_location').val();
            }else {
                data.append("test_type",1);
                data.append("test_location", 'any');
                test_type=1;
                test_location='any';
            }

            $.ajax({
                url: "<?php echo e(Route('search')); ?>",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {

                    if(res.success == true){

                        // $('.total_inst').html(res.total);
                        //
                        // $('.area').text(res.title);
                        //
                        // $('#load_instructors').html(res.view);
                        // $('#search_modal').modal('show');

                        // if ($('input#selectedPackage').val()=='driving_test_only'){
                        //     $('#search_modal').modal('show');
                        // }else {
                        //
                        // }

                        var search_url = "<?php echo e(url('/instructors/search_id')); ?>/"+res.search_id+'?type=package&test_type='+test_type+'&test_location='+test_location+'';
                        window.location = search_url;

                         //window.history.replaceState("", "", "<?php echo e(url('/')); ?>/"+res.search_id);

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

        $(document).on('click', '.suburb-item',  function(){
            var selected_keyword = $(this).text();
            var selected_id = $(this).attr('value');
            $('#suburb-input-search').val(selected_keyword);
            $('input[name=region]').val(selected_id);
            $('#suburb-list-desktop').empty();
            $('#suburb-list-desktop').removeClass('suburb-list');
            $('#searchIcon').removeClass('disabled');
            get_test_location(selected_id);
        });

        function get_test_location(obj)
        {
            var check_input=$('input#selectedPackage').val();
            if(check_input=='driving_test_only')
            {
                $.ajax({
                    url: "<?php echo e(Route('test_t_location')); ?>",
                    data: {id: obj},
                    type: 'get',
                    success: function (returnedData) {

                       $('#choseLocations').show();

                        if(returnedData!='')
                        {
                            $('.append_new').html(returnedData);
                            if(check_input == 2){
                                $('.append_new').show();
                            }
                            $('.btn-success').show();
                        }
                    },
                    error: function () {
                        $('.fa-spinner').addClass('hidden');
                    }
                });
            }
            else{
            }

        }


        $(document).on('click', '.suburb-item-mobile',  function(){
            var selected_keyword = $(this).text();
            var selected_id = $(this).attr('value');
            $('#suburb-input-search-mobile').val(selected_keyword);
            $('#regionMobile').val(selected_id);
            $('#suburb-list-mobile').empty();
            $('#suburb-list-mobile').removeClass('suburb-list');
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

    </script>

    <script>
        function choosePkg(packageType) {
            if (packageType === "driving only") {
                document
                    .querySelector(".choose_packages")
                    .children[0].classList.add("choose_packages-click-green");

                document
                    .querySelector(".choose_packages")
                    .children[1].classList.remove("choose_packages-click-blue");

                document.querySelector(".choosed-container").classList.remove("d-none");
                document.querySelector(".choose-1").classList.remove("d-none");

                $('input#suburb-input-search').html('');
                $('input#selectedPackage').val('driving_test_only');
                $('.packages_1').addClass('add-border');
                $('.packages_2').removeClass('add-border');
                $('#choseLocations').hide();

            }
            if (packageType === "driving test") {

                $('.packages_1').removeClass('add-border');
                $('.packages_2').addClass('add-border');
                $('input#suburb-input-search').html('');

                $('#choseLocations').hide();

                $('input#selectedPackage').val('driving_test_with_lesson_only');


                document
                    .querySelector(".choose_packages")
                    .children[1].classList.add("choose_packages-click-blue");

                document
                    .querySelector(".choose_packages")
                    .children[0].classList.remove("choose_packages-click-green");

                document.querySelector(".choosed-container").classList.remove("d-none");
                document.querySelector(".choose-2").classList.remove("d-none");
            }
        }

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

    </script>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layouts.app_guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/frontend/driving_lessons/test_packages.blade.php ENDPATH**/ ?>