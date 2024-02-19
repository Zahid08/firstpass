<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo url ('frontend_assets/css/auto-complete.css'); ?>">
    <style>
        .suburb-list{
            top: 64px!important;
        }
        @media (max-width: 480px){
            .suburb-list{
                top: 44px!important;
                min-width: 246px!important;
            }
        }
    </style>
    <!-- ---------------------- top Banner Section Start ----------------------- -->
    <section class="driving_lessons_banner position-relative">
        <img src="<?php echo url ('frontend_assets/images/driving-lessons-banner.jpg'); ?>" class="img-fluid d-lg-block d-none" alt="">
        <img src="<?php echo url ('frontend_assets/images/driving-lessons-mob-new.jpg'); ?>" class="img-fluid d-lg-none d-md-block d-none tab-banner" alt="">
        <img src="<?php echo url ('frontend_assets/images/driving-lessons-mob-new.jpg'); ?>" class="img-fluid d-md-none d-block mob-banner" alt="">
        <div class="driving_lessons_banner_wrapper">
            <div class="container h-100 d-flex align-items-center">
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="driving_lessons_banner_title">
                            <h1>driving <br>lessons</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------- Booking Has Never Section Start ------------------- -->
    <section class="booking_has_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title">
                        <h2>Booking has never been easier!</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ed_content_container">
                        <div class="easy-driving_img-ctn">
                            <img class="tablet-easy-img" src="<?php echo url ('frontend_assets/images/one-way.svg'); ?>" alt="">
                        </div>
                        <div class="ed_content">
                            <div class="points_easier_list">
                                <ul>
                                    <li><img src="<?php echo url ('frontend_assets/images/easy-driving_radio.svg'); ?>" alt=""> Enter Your Subrub</li>
                                    <li><img src="<?php echo url ('frontend_assets/images/easy-driving_radio.svg'); ?>" alt=""> Find Instructor</li>
                                    <li><img src="<?php echo url ('frontend_assets/images/easy-driving_radio.svg'); ?>" alt=""> Start Learning</li>
                                </ul>
                            </div>
                            <div class="learner_dashboard">
                                <h3>From your online learner dashboard :</h3>
                                <ul class="list-unstyled mb-0">
                                    <li>Reschedule your booking</li>
                                    <li>Change your instructor</li>
                                    <li>Cancel your booking</li>
                                </ul>
                            </div>
                            <div class="book_with_confidence_list">
                                <h3>Book with confidence</h3>
                                <ul class="list-unstyled mb-0">
                                    <li>We leverage the latest technology to provide an experience you will love</li>
                                    <li>Highly qualified instructors with 5 star ANCAP rated dual controlled cars</li>
                                    <li>A wide range of secure online payment options available</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------- Add more to save! Section Start ------------------- -->
    <section class="add_more_sec">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title">
                        <h2>Add more to save!</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="add_more_img text-end">
                        <img src="<?php echo url ('frontend_assets/images/more-img.png'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ---------------- Driving Lesson Pricing Section Start ----------------- -->
    <section class="dl_pricing_sec" id="dlesson">
        <div class="container">
            <div class="row align-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="dl_pricing_box">
                        <h5>Driving Lesson Pricing</h5>
                        <form class="form_section" method="post" action="" id="searchFormDesktop">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="search_type" value="1">
                            <input type="hidden" name="type" value="auto">
                            <input type="hidden" name="region" value="">

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
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="dl_pricing_img">
                        <img class="img-fluid" src="<?php echo url ('frontend_assets/images/driving-pricing-car.svg'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>

        $(document).ready(function(){

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

        $(document).on('submit', '#searchFormDesktop,#searchFormMobile', function(e){
            e.preventDefault(); // Prevent the default form submission
            $('i.fa.fa-spinner.fa-spin').removeClass('hidden');
            $('svg#searchSvg').addClass('hidden');

            var data = new FormData(this);
            data.append("search_id", 1);

            $.ajax({
                url: "<?php echo e(Route('search')); ?>",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {
                    if(res.success == true){
                        var search_url = "<?php echo e(url('/instructors/search_id')); ?>/"+res.search_id;
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.driving_leason', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/zenstech/public_html/resources/views/frontend/driving_lessons/index.blade.php ENDPATH**/ ?>