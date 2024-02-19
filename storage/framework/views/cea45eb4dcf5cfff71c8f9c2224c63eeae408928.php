<?php $__env->startSection('content'); ?>

    <?php

    $cancelHour = \App\Appointments::where('user_id', auth()->user()->id)
        ->whereIn('status', ['cancelled','cancelled_payment_wave'])
        ->sum('lesson_hour');

    if ($cancelHour){
        $cancelHour=$cancelHour;
    }

    $report = \App\Search::leftJoin('payment_responses', 'search.id', '=', 'payment_responses.search_id')
        ->where('payment_responses.status', 'succeeded')
        ->where('payment_responses.user_id',auth()->user()->id)
        ->selectRaw('SUM(search.final_selected_hour) as total_purchase, SUM(search.final_selected_test) as total_test , SUM(search.final_booking) as final_booking')
        ->first();

    $useCredit =\App\Appointments::leftJoin('search', 'search.id', '=', 'appointments.search_id')
        ->where('appointments.schedule_date', '!=', '')
        ->where('search.use_credit', 1)->where('search.learner_id',auth()->user()->id)->sum('lesson_hour');

    $search_check = \App\Search::where(['learner_id' => Auth::id()])->get();

    $dataCheck =  \App\Search::join('appointments', 'appointments.search_id', 'search.id')

        ->where(['search.learner_id' => Auth::id()])

        ->where('search.region_id', '!=', '')

        ->orderBy('appointments.id', 'desc')

        ->first();

    $totalPurchase=0;
    $discount=0;
    $totalBookingData=0;
    $originalPurchase=0;

    if (is_object($report)){
        $totalPurchase=$report->total_purchase-$useCredit;
        $totalBookingData=$report->final_booking;
        $originalPurchase=$report->total_purchase;
    }

    if($search_check){
        foreach ($search_check as $key=>$item){
            if (isset($item->step_3) && !empty($item->step_3)){
                $jsonDecode=json_decode($item->step_3);
                $discount +=$jsonDecode->discount;
            }
        }
    }

    ?>

    <link href="<?php echo e(url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('assets/js/calendar/packages/core/main.css')); ?>" rel='stylesheet' />
    <link href="<?php echo e(url('assets/js/calendar/packages/daygrid/main.css')); ?>" rel='stylesheet' />
    <style>
        .swal2-icon.swal2-info {
            border-color:  #f4a640!important;
            color: #0a0951!important;
        }

        button.swal2-confirm.swal2-styled{
            background-color: #f4a640!important;
            font-weight: 800!important;
            font-size: 16px!important;
            color: #0a0951!important;
        }

        a.btn.btn-warning.book-inst,
        a.pull-right.btn.btn-success{
            border-radius: 6px;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding-bottom: 5px;
        }
        .fc-row.fc-widget-header {
            padding: 10px;
            font-size: 13px;
            color: #0A0951 !important;
            background: #F4A640!important;
        }
        select.form-select.availability_check {
            /*padding: 7px;*/
            width: 100%;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .refresh-btn{
            position: absolute;
            top: 13px;
            right: 22px;
        }
        .buttons-csv.buttons-html5{margin-bottom: 10px}

        #show_slots .btn-switch{
            margin-right: 3px;
            width: 96px !important;
            float: left;
        }
        .btn-switch label
        {
            width: 100%;
            margin-bottom: 0px !important;
            margin-top: 6px !important;
            background: #ffcb00;
            border-color: #ffcb00;
        }
        .btn-switch
        {
            width: 100px;
            margin-right: 7px;
        }
        .btn-switch > input[type="radio"] + .btn {
            background-color: transparent !important;
            border-color: #4BB543;
            color: #4BB543 !important;
        }

        .btn-switch > input[type="radio"] + .btn > em {
            display: inline-block;
            border: 1px solid #4BB53F;
            border-radius: 50%;
            padding: 2px;
            margin: 0 4px 0 0;
            top: 1px;
            font-size: 10px;
            text-align: center;
        }
        .btn-switch input[type=radio]{display: none}
        .input[type="radio"] + label:before{
            content: none !important;
        }
        .btn-switch strong{ font-weight: normal !important; }
        table thead td{
            color: #2b2b2b;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding-bottom: 5px;
        }

        #calendar td, #calendar th, #calendar tr, #calendar table{
            border: 0 !important;
            margin: 0;
        }
        .fc-row.fc-week div > table{
            border-spacing: 1px!important;
            border-collapse: initial !important;
        }

        .fc-dayGrid-view .fc-body .fc-row{
            min-height:0!important;
        }

        .fc-row.fc-week div > table .fc-day{
            border-spacing: 15px;

        }
        .fc-ltr .fc-dayGrid-view .fc-day-top .fc-day-number{
            float: none!important;
        }
        .fc .fc-row .fc-content-skeleton td{
            text-align: center;
        }
        .fc-nonbusiness{
            background: none;
        }
        .fc-dayGridMonth-view > table{
            border: none;
        }
        th.fc-day-header{
            border: 0;
            border-color: white!important;
        }
        .fc-bgevent-skeleton td{
            background: #ddd !important;
            border-radius: 10px !important;
            border-collapse: initial;
            cursor: pointer;
        }
        td{ cursor: pointer;}

        .fc-unthemed td.fc-today a{
            color: #ff761f !important;
        }
        .fc-slats table td, .fc-row.fc-widget-header th{
            border: 1px solid #dddddd !important;
        }
        .fc-row .fc-content-skeleton td{ padding-top: 18px }
        .fc-scroller{height: auto!important; overflow: unset!important;}
        .fc-row .fc-content-skeleton{padding-bottom: 0!important;}
        .fc-head{background: #ffcb00}
        h5.title .badge{ font-size: 50% }

        /* -------------------------------------------------------------------------- */
        /*                            Book Now Page Section                           */
        /* -------------------------------------------------------------------------- */
        .book_lesson{
            margin:0px auto;
        }
        .book_lesson_wrapper{
            max-width:510px;
            margin:0px auto;
        }
        .booked_lessons_list {
            padding: 0px 12px;
            height: 200px;
            overflow-y: scroll;
            max-width: 90%;
            margin: 0 auto;
        }
        .booked-lessons_items {
            display: flex;
            align-items: center;
            border: 1px solid #f4a640;
            width: fit-content;
            border-radius: 4px;
            width: 100%;
            height: 100%;
            max-height: 110px;
            margin-bottom: 10px;
            overflow: hidden;
        }
        .booked-lessons_items:last-child{
            margin-bottom: 0;
        }
        .lesson_info{
            padding:15px;
            background: #fff7ed;
            width: 100%;
            height: 100%;
        }
        .booked_lessons_list .lesson_info h4,
        .added_to_cart_box h5{
            font-size: 20px;
            line-height:22px;
            color: #17214d;
            margin-bottom: 5px;
        }
        .booked_lessons_list .lesson_info p{
            font-size: 18px;
            line-height:22px;
            color: #555185;
        }
        .delete_lesson_info{
            display: flex;
            height: 100%;
        }
        .delete_lesson_info a{
            color:#eb5757;
            display: flex;
            padding:8px;
            gap:5px;
            align-items:center;
            background-color:#feebd4;
            height: 100%;
            transition: all 0.2s ease-in-out;
        }
        .delete_lesson_info a:hover{
            background-color:#f4ddc0;
            transition: all 0.2s ease-in-out;
        }
        .delete_lesson_info svg{
            fill:#eb5757;
        }

        .added_to_cart {
            background: #ffffff;
            border: 1px solid #d3d3d3;
            border-radius: 5px;
            padding: 31px;
        }
        .added_to_cart_box {
            border: 1px solid #d3d3d3;
            border-radius: 5px;
            padding: 13px 21px;
            height: 122px;
        }
        .added_to_cart_box ul li{
            display: flex;
            justify-content:space-between;
            gap:15px;
        }
        .added_to_cart_box ul li .list_title,
        .added_to_cart_box ul li .list_info{
            font-size: 18px;
            line-height: 30px;
            color: #17214D;
        }
        .added_to_cart_box ul li .list_info{
            color: #555185;
        }
        .lesson_test_box {
            background: #17214d;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height: 150px;
            padding: 20px 30px;
            cursor: pointer;
            margin:20px 0px;
            transition: all 0.3s;
        }
        .lesson_test_box:hover{
            transform:scale(1.04);
            transition: all 0.3s;
        }
        .lesson_test_box h5{
            font-size: 18px;
            line-height: 24px;
            color:#FFFFFF;
            text-align: center;
        }
        .lesson_test_box span.lt_arrow_right {
            width: 35px;
            height: 35px;
            display: inline-block;
            background: #eda533;
            line-height: 32px;
            text-align: center;
            border-radius: 100px;
        }

        .driving_lesson{
            background: #ffffff;
            border: 1px solid #d3d3d3;
            border-radius: 5px;
            position: relative;
        }
        .dl_header {
            background: #e2eff1;
            display: flex;
            justify-content: center;
            padding: 14px 0px;
            border-radius: 5px 5px 0 0;
        }
        .dl_body{
            padding:20px 30px 30px;
        }
        .dl_duration{
            margin-top: 20px;
        }
        .dl_hours_duration{
            margin-top: 20px;
        }
        .dl_hours_duration .form-check {
            background: #e2eff1;
            border: 1px solid #000000;
            border-radius: 4px;
            color: #17214d;
            width: 102px;
            padding:15px 10px;
            display: flex;
            flex-direction: column;
        }
        .checked-hour{
            background: #17214d !important;
            color: white !important;
            border: 1px solid #f4a640 !important;
        }
        .checked-hour input[type="checkbox"]{
            background-color: #ffffff !important;
            border: 1px solid #f4a640 !important;
        }
        .dl_hours_duration .form-check input {
            margin: 0;
            margin-bottom: 10px;
            border-color: #17214d;
        }
        .dl_hours_duration .form-check label{
            font-weight: 400;
            font-size: 24px;
            line-height: 29px;
        }
        .menu_close-btn {
            width: fit-content;
        }
        .menu_close-btn > img {
            background: rgb(238, 111, 111);
            padding: 4px;
            border-radius: 100%;
            cursor: pointer;
            transition: 0.2s all;
            position: absolute;
            right: -13px;
            top: -14px;
        }
        .test_booking .choose_location {
            max-width: 385px;
            background: #17214d;
            color: #ffffff;
            border-radius: 2px;
            background-image: url('/frontend_assets/images/right-white.svg') !important;
        }
        .availability_check,
        .test_booking .choose_location{
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
            outline: none;
            background-image: url("/frontend_assets/images/right-black-arrow.svg") !important;
            background-size: 8px !important;
            background-position: calc(100% - 14px) center !important;
            background-repeat: no-repeat !important;
            background: #fff7ed;
            border: 1px solid #f4a640;
            border-radius: 2px;
            font-family: "Product Sans";
            font-style: normal;
            font-weight: 400;
            font-size: 17px;
            line-height: 26px;
            color: #17214d;
            width: 100%;
            padding: 4px 23px 4px 11px;
            margin-bottom: 10px;
        }
        .availability_check:focus{
            box-shadow:none;
            border: 1px solid #f4a640;
        }
        .dl_hours_duration button[type="submit"]{
            font-family: "Product Sans";
            font-size: 14px;
            font-weight: 700;
            color: #0a0951;
            background: #f4a640;
            text-transform: capitalize;
            border-radius: 4px;
            transition:all 0.3s;
            padding: 12px 20px;
            width: 100%;
            max-width:224px;
        }
        .test_booking h4{
            font-size: 18px;
        }
        .test_booking .choose_location{
            max-width: 385px;
            background: #17214d;
            color: #ffffff;
            border-radius:2px;
            background-image: url("/frontend_assets/images/right-white.svg") !important;
        }
        .form-check-input[type=checkbox] {
            width: 18px;
            height: 18px;
            margin-top: 1px;
        }
        .gender_check_list .form-check-input:checked ~ .form-check-label {
            border: 1px solid #f4a640 ;
        }

        .form-check-input[type=checkbox]{
            width: 20px;
            height: 20px;
            margin-top: 1px;
        }
        .password_reset a{
            font-family:'Product Sans';
            font-size: 16.5px;
            line-height:22px;
        }
        .form-check-input[type=checkbox]:focus{
            outline: 0;
        }
        .form-check-input[type=checkbox]{
            background-color: transparent !important;
            border-color: #E5E1DC;
            cursor: pointer;
        }
        .form-check-input:checked[type=checkbox] {
            background-image: url('/frontend_assets/images/check.png');
            background-size: 10px;
            background-repeat: no-repeat;
            background-position:center;
        }
        .checked-hour{
            background: #17214d !important;
            color: white !important;
            border: 1px solid #f4a640 !important;
        }
        .checked-hour input[type="checkbox"]{
            background-color: #ffffff !important;
            border: 1px solid #f4a640 !important;
        }
    </style>

    <style>

        .fa-star{color: #ece10d;}

        .fa-star-o{color: #cccccc;}

         .googel-btn {    font-size: 18px;    border-radius: 12px; }

        .rating {
            font-size: 40px;
        }

        .star {
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star:hover,
        .star.active {
            color: #ffa500;
        }
        .form-check{
            min-height: 1.5rem;
            margin-bottom: 0.125rem;
        }
        label {
            display: inline-block;
        }
        .form-check-input {
            position: unset;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <div class="page-breadcrumb">

        <div class="row">

            <div class="col-5 align-self-center">

                <!-- <h4 class="page-title">Dashboard</h4> -->

                <div class="d-flex align-items-center">



                </div>

            </div>

            <div class="col-7 align-self-center">

                <div class="d-flex no-block justify-content-end align-items-center">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">

                                <a href="<?php echo e(url('home')); ?>">Home</a>

                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>



<?php $learner_id = auth()->user()->id; ?>



    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <div class="card  bg-light no-card-border">

                    <?php if(\Illuminate\Support\Facades\Session::get('success')): ?>
                    <div class="alert-box success">
                        <div class="alert alert-success">
                            <small><?php echo e(\Illuminate\Support\Facades\Session::get('success')); ?></small>
                            <?php echo e(\Illuminate\Support\Facades\Session::put('success','')); ?>

                        </div>
                    </div>
                    <?php endif; ?>


                    <div class="card-body">


                        <?php if($dataCheck!=''): ?>

                            <a href="<?php echo e(url('/search/instructors/all')); ?>" class="pull-right btn btn-success">Find an instructor</a>

                        <?php endif; ?>



                        <div class="d-flex align-items-center">

                            <div class="m-r-10">

                            <?php if( auth()->user()->avatar == ''): ?>

                                <?php if( auth()->user()->gender == 'male'): ?>

                                <img src="<?php echo e(url('assets/images/users/default.png')); ?>" alt="user" class="image_preview rounded-circle" width="31">

                                <?php else: ?>

                                <img src="<?php echo e(url('assets/images/users/default-female.png')); ?>" alt="user" class="image_preview rounded-circle" width="31">

                                <?php endif; ?>

                            <?php else: ?>

                            <img src="<?php echo e(url('assets/images/users/'.auth()->user()->avatar)); ?>" alt="user" class="image_preview rounded-circle" width="31">

                            <?php endif; ?>

                            </div>

                            <div class="pull-left">

                                <h3 class="m-b-0">Welcome back!</h3>

                                <span><?php echo e(\Carbon\Carbon::now()->format('l jS \of F Y')); ?></span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="row">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Your Instructors</h4>

                        <div class="d-flex align-items-center flex-row m-t-30">

                            <div class="table-responsive" >

                                <table class="table table-bordered table-striped">

                                    <thead>

                                    <tr>

                                        <th>Name</th>

                                        <th data-toggle="tooltip" title="Total completed lessons">Completed</th>

                                        <th data-toggle="tooltip" title="Total purchased lessons">Booked</th>

                                        <th></th>

                                        <th>Review</th>

                                        <th>Rating</th>

                                        <th></th>

                                    </tr>

                                    </thead>

                                    <tbody>

                                    <?php $totalComplete=$totalBooked=$total=0; ?>
                                    <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                        $rating = \App\UserRatings::select('review', \Illuminate\Support\Facades\DB::raw('count(score) as total, AVG(score) as avg'))

                                            ->where('user_id', $inst->instructor_id)

                                            ->first();


                                        /*compled appointments*/

                                        $completed = \App\Appointments::where('instructor_id', $inst->instructor_id)

                                            ->where('user_id', auth()->user()->id)

                                            ->where('status', 'completed')

                                            ->count();


                                           $total = \App\Appointments::where('instructor_id', $inst->instructor_id)

                                               ->where('user_id', auth()->user()->id)
                                               ->where('appointments.schedule_date', '!=', '')
                                               ->where('appointments.status', '!=', 'cancelled')
                                               ->sum('lesson_hour');





                                        $userMeta = \App\UserMeta::where('user_id', $inst->instructor_id)->select('vehicle_auto_id','vehicle_manual_id')->first();



                                        if($userMeta){

                                            $vehicle_auto_id = \App\InstructerVehicle::where('id',$userMeta->vehicle_auto_id)->first();

                                            if($vehicle_auto_id){

                                                $vehicle_id_image = $vehicle_auto_id->vehicle_image;

                                            }

                                            $vehicle_manual_id = \App\InstructerVehicle::where('id',$userMeta->vehicle_manual_id)->first();

                                            if($vehicle_manual_id){

                                                $vehicle_id_image = $vehicle_manual_id->vehicle_image;

                                            }

                                        }

                                        $vehicle_image = $vehicle_id_image ?? '';

                                        $totalComplete+=$completed;
                                         $totalBooked+=$total;

                                        ?>

                                        <tr>

                                            <td>

                                                <div class="d-flex align-items-center">

                                                    <div class="m-r-10">

                                                        <?php if( $inst->avatar == ''): ?>

                                                            <?php if($inst->gender == 'male'): ?>

                                                            <img src="<?php echo e(url('assets/images/users/default.png')); ?>" alt="user" class="img-circle" width="60">

                                                            <?php else: ?>

                                                            <img src="<?php echo e(url('assets/images/users/default-female.png')); ?>" alt="user" class="img-circle" width="60">

                                                            <?php endif; ?>

                                                        <?php else: ?>

                                                            <img src="<?php echo e(url('assets/images/users/'.$inst->avatar)); ?>" alt="user" class="img-circle rounded-circle" width="60">

                                                        <?php endif; ?>

                                                    </div>

                                                    <div class="">

                                                        <h4 class="m-b-0 font-16"><?php echo e($inst->name); ?> <?php echo e($inst->lname); ?></h4>

                                                        <?php /*<span>{{$inst->email}}</span><br>*/ ?>

                                                        <span><?php echo e($inst->phone); ?></span>

                                                    </div>

                                                </div>

                                            </td>

                                            <td><?php echo e($completed); ?></td>

                                            <td><?php echo e($total); ?></td>

                                            <td><a data-fancybox="gallery" href="<?php echo e(asset('assets/images/cars/'.$vehicle_image)); ?>"><img src="<?php echo e(asset('assets/images/cars/'.$vehicle_image)); ?>" alt="" height="60"></a></td>

                                            <td><?php echo e($rating->review); ?></td>

                                            <td>


                                                    <?php if(floor($rating->avg)>0 && floor($rating->avg)==1): ?>
                                                        <span class="star active" data-value="1" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star " data-value="2" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star " data-value="3" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star " data-value="4" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star " data-value="5" style="font-size: 18px;">&#9733;</span>
                                                    <?php elseif(floor($rating->avg)==2): ?>
                                                        <span class="star active" data-value="1" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="2" style="font-size: 18px;">&#9733;</span>
                                                    <span class="star " data-value="3" style="font-size: 18px;">&#9733;</span>
                                                    <span class="star " data-value="4" style="font-size: 18px;">&#9733;</span>
                                                    <span class="star " data-value="5" style="font-size: 18px;">&#9733;</span>
                                                    <?php elseif(floor($rating->avg)==3): ?>
                                                        <span class="star active" data-value="1" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="2" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="3" style="font-size: 18px;">&#9733;</span>
                                                    <span class="star " data-value="4" style="font-size: 18px;">&#9733;</span>
                                                    <span class="star " data-value="5" style="font-size: 18px;">&#9733;</span>
                                                    <?php elseif(floor($rating->avg)==4): ?>
                                                        <span class="star active" data-value="1" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="2" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="3" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="4" style="font-size: 18px;">&#9733;</span>
                                                       <span class="star " data-value="5" style="font-size: 18px;">&#9733;</span>
                                                    <?php elseif(floor($rating->avg)==5): ?>
                                                        <span class="star active" data-value="1" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="2" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="3" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="4" style="font-size: 18px;">&#9733;</span>
                                                        <span class="star active" data-value="5" style="font-size: 18px;">&#9733;</span>
                                                    <?php endif; ?>

                                                <?php if($completed == 1): ?>
                                                <?php if($rating->review==""): ?>
                                                <div class="btn btn-success" onclick="reviewPop('<?php echo e($inst->instructor_id); ?>')" > Feedback </div>
                                                <?php endif; ?>

                                                <?php endif; ?>

                                            </td>

                                            <td>

                                                <a data-instructor="<?php echo e($inst->id); ?>" href="javascript:void(0)" type="button" data-credit="<?php echo e($totalPurchase); ?>" class="btn btn-warning book-inst"> <?php echo e(in_array($inst->id, $UpcomingAppointmentsId)  ? 'BOOK MORE' : 'BOOK NOW'); ?> </a>

                                            </td>

                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">Purchase & Booking</h4>
                        <h4 style="font-size: 14px;">Purchases</h4>
                        <p><?php echo e($originalPurchase); ?> lesson hr</p>
                        <h4 style="font-size: 14px;">Booked</h4>
                        <p><?php echo e($totalBooked); ?> lesson hr</p>
                        <h4 style="font-size: 14px;">Completed</h4>
                        <p><?php echo e($totalComplete); ?> lesson hr</p>
                        <h4 style="font-size: 14px;">Available booking credit</h4>
                        <p><?php echo e($totalPurchase-$totalComplete); ?> lesson hr</p>
                    </div>
                    <?php if($originalPurchase): ?>
                    <div>
                        <a class="btn btn-success tiny small-width-100px" href="<?php echo e(route('buy_more_credit')); ?>" style="border-radius: 5px;    border-radius: 5px;
    width: 80%;
    margin-left: 28px;
    margin-right: 28px;
    margin-bottom: 18px;">Buy More</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-md-8">
                <div class="card">

                    <div class="card-body p-b-0">

                        <?php if(isset($UpcomingAppointment->avatar)): ?>

                            <?php
                                $s = date('Y-m-d H:i:s');
                                //echo $appointment->schedule_date;
                                $future = strtotime($UpcomingAppointment->schedule_date);
                                $now = time();
                                $today_time = date("Y-m-d H:i:s");
                                $timeleft = $future-$now;
                                $daysleft = round((($timeleft/24)/60)/60);

                                $expiry_date = $UpcomingAppointment->schedule_date;
                               $today = date('d-m-Y',time());
                               $exp = date('d-m-Y',strtotime($expiry_date));
                               $expDate =  date_create($exp);
                               $todayDate = date_create($today);
                               $diff =  date_diff($todayDate, $expDate);

                               $get_result_date = $diff->format("%a days");
                               if($diff->format("%R%a")>0){
                                 $days = ' in '.$diff->format("%a days");
                               } else{
                                 $days = "is today";
                               }

                                 ?>
                                <h4 class="card-title" style="font-weight: 700;">Your lesson <?php echo e($days); ?><!-- <?php echo e(\Carbon\Carbon::parse($UpcomingAppointment->schedule_date)->format('j F Y')); ?> --></h4>

                                <hr>

                            <div class="row <?php if($UpcomingAppointment->time_slot == ''): ?> bg-danger text-white <?php endif; ?>" <?php if($UpcomingAppointment->time_slot == ''): ?> data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" <?php endif; ?>>

                                <div class="col-md-6">



                                    <div class="d-flex align-items-center">

                                        <div class="m-r-10">

                                            <?php if( $UpcomingAppointment->avatar == ''): ?>

                                                <?php if($UpcomingAppointment->gender == 'male'): ?>

                                                <img src="<?php echo e(url('assets/images/users/default.png')); ?>" alt="user" class="img-circle" width="60">

                                                <?php else: ?>

                                                <img src="<?php echo e(url('assets/images/users/default-female.png')); ?>" alt="user" class="img-circle" width="60">

                                                <?php endif; ?>

                                            <?php else: ?>

                                                <img src="<?php echo e(url('assets/images/users/'.$UpcomingAppointment->avatar)); ?>" alt="user" class="img-circle" width="60">

                                            <?php endif; ?>

                                        </div>

                                        <div>

                                            <h3 class="m-b-0"><?php echo e(ucwords($UpcomingAppointment->name .' '. $UpcomingAppointment->lname)); ?></h3>

                                            <span> <i class="fa fa-phone"></i> <a href="tel:<?php echo e($UpcomingAppointment->phone); ?>"><?php echo e($UpcomingAppointment->phone); ?></a> </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <p>

                                        <?php
                                         if($UpcomingAppointment->apptype == 'test'){
                                  if($UpcomingAppointment->t_type=="manual"){
                                   $title = 'Manual Driving Test';
                                  } else if($UpcomingAppointment->t_type=="both")    {
                                   $title = 'Auto Driving Test';
                                  } else{
                                   $title = 'Auto Driving Test';
                                  }

                                }else{

                                  if($UpcomingAppointment->t_type=="manual"){
                                   $title = 'Manual Lesson - '.$UpcomingAppointment->lesson_hour.' hour';
                                  }else if($UpcomingAppointment->t_type=="both") {
                                   $title = 'Auto Lesson  - '.$UpcomingAppointment->lesson_hour.' hour';
                                  } else{
                                   $title = 'Auto Lesson  - '.$UpcomingAppointment->lesson_hour.' hour';
                                  }
                                }
                                  ?>


                                            <span style="font-weight: 600; font-size: 18px;"><?php echo e($title); ?><?php echo e($UpcomingAppointment->lesson_hour > 1 ? "s" : ""); ?></span>

                                            <br>

                                    <?php //echo $UpcomingAppointment->apptype;

                                    if($UpcomingAppointment->apptype=="test")

                                    {

                                        $start_date = $UpcomingAppointment->start_date;

                                        $pickup = strtotime($start_date)-3600;

                                        $pickuptime = date('h:i a', $pickup);

                                        $startT = date('h:i a', strtotime($UpcomingAppointment->start_date));

                                        ?>

                                        <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($UpcomingAppointment->schedule_date));?> <br>

                                        Pickup time: <?php echo e($pickuptime); ?><br>Start time: <?php echo e($startT); ?></span><br> <?php

                                    }

                                    else{?>

                                        <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($UpcomingAppointment->schedule_date)); ?> &emsp; <?php echo e($UpcomingAppointment->time_slot); ?></span><br> <?php

                                    } ?>



                                    <?php

                                    $address = "";

                                    if(is_object($UpcomingAppointment)){

                                        // echo $UpcomingAppointment->address;

                                        $ad = @json_decode($UpcomingAppointment->address);

                                        if(json_last_error() == JSON_ERROR_NONE){

                                            if(@$ad->address_detail->country == 'Australia') {

                                                 $address = $ad->address .', '. @$ad->address_detail->country;

                                            } else {

                                                $address = $ad->address .', '. @$ad->address_detail->city. ', '. @$ad->address_detail->country;

                                            }

                                        }



                                    }

                                    ?>



                                    <?php if(isset($address)): ?>

                                    <span style="font-weight: 600; line-height: 35px;"><?php echo e($address); ?></span>

                                    <?php endif; ?>

                                    <?php if($UpcomingAppointment->status!='cancelled'): ?>
                                        <?php
                                        $startDateUp= date("Y-m-d H:i:s",strtotime($UpcomingAppointment->start_date));
                                        $sixHourTimeUp = date("Y-m-d H:i:s", strtotime($startDateUp . " -6 hours"));
                                        $twelveHourUp = date("Y-m-d H:i:s", strtotime($startDateUp . " -12 hours"));
                                        $today_time = date("Y-m-d H:i:s");
                                        ?>
                                        <div style="margin-bottom: 20px">
                                            <?php if(strtotime($today_time)<=strtotime($twelveHourUp)): ?>
                                                <?php if($UpcomingAppointment->status=='confirmed'): ?>
                                                    <?php if(strtotime($today_time)<=strtotime($twelveHourUp)): ?>
                                                        <a data-toggle="tooltip" data-title="Cancel booking" href="javascript:;" onclick="AppointmentComplete(this)" data-appointment-id="<?=$UpcomingAppointment->id?>" data-instructor-id="<?=$UpcomingAppointment->instructor_id?>" data-lesson-hour="<?=$UpcomingAppointment->lesson_hour?>"  class="btn btn-danger pull-right" style="margin-bottom: 20px;border-radius: 8px;"><i class="fa fa-times"></i> Cancel</a>
                                                    <?php endif; ?>
                                                    <?php if(strtotime($today_time)<=strtotime($sixHourTimeUp)): ?>
                                                        <a  href="javascript:;" onclick="ShowTimeSlots(this)" data-type="<?php echo e($UpcomingAppointment->type); ?>" data-id="<?=$UpcomingAppointment->id?>" data-search-id="<?=$UpcomingAppointment->search_id?>" data-lesson-hour="<?=$UpcomingAppointment->lesson_hour?>" data-instructor-id="<?=$UpcomingAppointment->instructor_id?>" data-start-date="<?=$UpcomingAppointment->schedule_date?>" class="pull-right btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-calendar"></i> Reschedule</a>
                                                    <?php endif; ?>
                                                <?php elseif($UpcomingAppointment->status=='cancelled_payment_wave'): ?>
                                                    <div>
                                                        <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled & Payment Wave</span>
                                                    </div>
                                                <?php elseif($UpcomingAppointment->status=='cancelled'): ?>
                                                    <div>
                                                        <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                                    </div>
                                                <?php elseif($UpcomingAppointment->status=='no_charge'): ?>
                                                    <div>
                                                        <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">No charge added By Instructor</span>
                                                    </div>
                                                <?php elseif($UpcomingAppointment->status=='completed'): ?>
                                                    <div>
                                                        <span style="background: #22c6ab; padding: 4px;font-weight: 500;padding-right: 12px; padding-left: 12px;border-radius: 10px;color: white;">Payment Authorized (Completed)</span>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if(strtotime($today_time)>=strtotime($twelveHourUp)): ?>
                                                    <a data-toggle="tooltip" data-title="Cancel booking" href="javascript:;" onclick="CanNotCancel(this)"  class="btn btn-danger pull-right" style="margin-bottom: 20px;border-radius: 8px;"><i class="fa fa-times"></i> Cancel</a>
                                                <?php endif; ?>
                                                <?php if(strtotime($today_time)>=strtotime($sixHourTimeUp)): ?>
                                                    <a  href="javascript:;" onclick="CanNotResecudle(this)"  class="pull-right btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-calendar"></i> Reschedule</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php elseif($UpcomingAppointment->status=='cancelled'): ?>
                                        <div style="margin-bottom: 28px">
                                            <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        <?php else: ?>

                            <h4 class="card-title">Upcoming lesson not found!</h4>

                            <hr>

                        <?php endif; ?>

                    </div>

                </div>
                <div class="card">

                    <div class="card-body">
                    <h4 class="card-title">Upcoming Lesson</h4>
                       <!--  <button class="refresh-btn btn btn-xs m-b-5 btn-primary pull-right m-b-5" data-toggle="tooltip" data-title="Refresh data" ><i class="fas fa-sync-alt"></i></button> -->

                        <br><br>





                        <?php if($appointments->isNotEmpty()): ?>

                            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                               <?php
                                $s = date('Y-m-d H:i:s');
                                //echo $appointment->schedule_date;
                                $future = strtotime($appointment->schedule_date);
                                $now = time();
                                $today_time = date("Y-m-d H:i:s");
                                $timeleft = $future-$now;
                                $daysleft = round((($timeleft/24)/60)/60);

                                $expiry_date = $appointment->schedule_date;
                               $today = date('d-m-Y',time());
                               $exp = date('d-m-Y',strtotime($expiry_date));
                               $expDate =  date_create($exp);
                               $todayDate = date_create($today);
                               $diff =  date_diff($todayDate, $expDate);

                               $get_result_date = $diff->format("%a days");
                               if($diff->format("%R%a")>0){
                                 $days = ' in '.$diff->format("%a days");
                               } else{
                                 $days = "is today";
                               }

                                 ?>
                                <h4 class="card-title">Your lesson <?php echo e($days); ?><!-- <?php echo e(\Carbon\Carbon::parse($appointment->schedule_date)->format('j F Y')); ?> --></h4>

                                <hr>

                                <div class="row">

                                    <div class="col-md-6">



                                        <div class="d-flex align-items-center">

                                            <div class="m-r-10">

                                                 <?php if( $appointment->avatar == ''): ?>

                                                    <?php if($appointment->gender == 'male'): ?>

                                                    <img src="<?php echo e(url('assets/images/users/default.png')); ?>" alt="user" class="img-circle" width="60">

                                                    <?php else: ?>

                                                    <img src="<?php echo e(url('assets/images/users/default-female.png')); ?>" alt="user" class="img-circle" width="60">

                                                    <?php endif; ?>

                                                <?php else: ?>

                                                <img src="<?php echo e(url('assets/images/users/'.$appointment->avatar)); ?>" alt="user" class="img-circle" width="60">

                                                <?php endif; ?>

                                            </div>

                                            <div>

                                                <h3 class="m-b-0"><?php echo e($appointment->name); ?> <?php echo e($appointment->lname); ?></h3>

                                                <span> <i class="fa fa-phone"></i> <a href="tel:<?php echo e($appointment->phone); ?>"><?php echo e($appointment->phone); ?></a> </span>

                                            </div>

                                        </div>



                                    </div>

                                    <div class="col-md-6">

                                        <?php

                                        // echo "<pre/>";

                                        // print_r($UpcomingAppointment->address);

                                        // exit;

                                        ?>



                                        <?php

                                        $address = "";

                                        if(is_object($appointment)){

                                            // echo $appointment->address;

                                            $ad = @json_decode($appointment->address);

                                            if(json_last_error() == JSON_ERROR_NONE){

                                                $address = $ad->address .', '. @$ad->address_detail->country;

                                            }



                                        }

                                        ?>

                                        <p>

                                        <?php
                                         if($appointment->apptype == 'test'){
                                  if($appointment->t_type=="manual"){
                                   $title = 'Manual Driving Test';
                                  } else if($appointment->t_type=="both")    {
                                   $title = 'Auto Driving Test';
                                  } else{
                                   $title = 'Auto Driving Test';
                                  }

                                }else{

                                  if($appointment->t_type=="manual"){
                                   $title = 'Manual Lesson - '.$appointment->lesson_hour.' hour';
                                  }else if($appointment->t_type=="both") {
                                   $title = 'Auto Lesson  - '.$appointment->lesson_hour.' hour';
                                  } else{
                                   $title = 'Auto Lesson  - '.$appointment->lesson_hour.' hour';
                                  }
                                }
                                         ?>

                                            <!-- <span style="font-weight: 600; font-size: 18px;"><?php echo e($appointment->apptype == "test" ? "Auto Driving Test" : "Auto Lesson - ".$appointment->lesson_hour." hour"); ?><?php echo e($appointment->lesson_hour > 1 ? "s" : ""); ?></span><br> -->
                                            <span style="font-weight: 600; font-size: 18px;"><?php echo e($title); ?><?php echo e($appointment->lesson_hour > 1 ? "s" : ""); ?></span>
                                            <br>


                                            <?php if($appointment->apptype=="test")

                                            {

                                                $start_date = $appointment->start_date;

                                                $pickup = strtotime($start_date)-3600;

                                                $pickuptime = date('h:i a', $pickup);

                                                $startT = date('h:i a', strtotime($appointment->start_date));

                                                ?>

                                                <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?> <br>Pickup time: <?php echo e($pickuptime); ?><br>Start time: <?php echo e($startT); ?></span><br> <?php

                                            }

                                            else{ ?>

                                                <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?>&emsp;<?php echo e($appointment->time_slot); ?></span><br> <?php

                                            } ?>



                                            <?php if(isset($address)): ?>

                                            <span style="font-weight: 600; line-height: 35px;"><?php echo e($address); ?></span>

                                            <?php endif; ?>

                                        </p>


                                            <?php if($appointment->status!='cancelled'): ?>
                                                <?php
                                                $startDate= date("Y-m-d H:i:s",strtotime($appointment->start_date));
                                                $sixHourTime = date("Y-m-d H:i:s", strtotime($startDate . " -6 hours"));
                                                $twelveHour = date("Y-m-d H:i:s", strtotime($startDate . " -12 hours"));
                                                $today_time = date("Y-m-d H:i:s");
                                                ?>
                                                <div>
                                                    <?php if(strtotime($today_time)<=strtotime($twelveHour)): ?>
                                                        <?php if($appointment->status=='confirmed'): ?>
                                                            <?php if(strtotime($today_time)<=strtotime($twelveHour)): ?>
                                                                <a data-toggle="tooltip" data-title="Cancel booking" href="javascript:;" onclick="AppointmentComplete(this)" data-appointment-id="<?=$appointment->id?>" data-instructor-id="<?=$appointment->instructor_id?>" data-lesson-hour="<?=$appointment->lesson_hour?>"  class="btn btn-danger pull-right" style="margin-bottom: 20px;border-radius: 8px;"><i class="fa fa-times"></i> Cancel</a>
                                                            <?php endif; ?>
                                                            <?php if(strtotime($today_time)<=strtotime($sixHourTime)): ?>
                                                                <a  href="javascript:;" onclick="ShowTimeSlots(this)" data-type="<?php echo e($appointment->type); ?>" data-id="<?=$appointment->id?>" data-search-id="<?=$appointment->search_id?>" data-instructor-id="<?=$appointment->instructor_id?>" data-lesson-hour="<?=$appointment->lesson_hour?>" data-start-date="<?=$appointment->schedule_date?>" class="pull-right btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-calendar"></i> Reschedule</a>
                                                            <?php endif; ?>
                                                        <?php elseif($appointment->status=='cancelled_payment_wave'): ?>
                                                            <div>
                                                                <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled & Payment Wave</span>
                                                            </div>
                                                        <?php elseif($appointment->status=='cancelled'): ?>
                                                            <div>
                                                                <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                                            </div>
                                                        <?php elseif($appointment->status=='no_charge'): ?>
                                                            <div>
                                                                <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">No charge added By Instructor</span>
                                                            </div>
                                                        <?php elseif($appointment->status=='completed'): ?>
                                                            <div>
                                                                <span style="background: #22c6ab; padding: 4px;font-weight: 500;padding-right: 12px; padding-left: 12px;border-radius: 10px;color: white;">Payment Authorized (Completed)</span>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else: ?>

                                                        <?php if(strtotime($today_time)>=strtotime($twelveHour)): ?>
                                                            <a data-toggle="tooltip" data-title="Cancel booking" href="javascript:;" onclick="CanNotCancel(this)"  class="btn btn-danger pull-right" style="margin-bottom: 20px;border-radius: 8px;"><i class="fa fa-times"></i> Cancel</a>
                                                        <?php endif; ?>
                                                        <?php if(strtotime($today_time)>=strtotime($sixHourTime)): ?>
                                                            <a  href="javascript:;" onclick="CanNotResecudle(this)"  class="pull-right btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-calendar"></i> Reschedule</a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php elseif($appointment->status=='cancelled'): ?>
                                                <div style="margin-bottom: 28px">
                                                    <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                                </div>
                                            <?php endif; ?>


                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>



        <div class="row">

                <div class="col-md-8">
                    <div class="card">

                        <div class="card-body p-b-0">

                            <h4 class="card-title">Booking History</h4>



                            <div class="d-flex align-items-center flex-row m-t-30">

                                <div class="w-100" >

                                    <?php if($BookingHistory->isNotEmpty()): ?>

                                        <?php $__currentLoopData = $BookingHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



                                        <hr>

                                        <div style="    margin-bottom: 20px;" class="row <?php if($appointment->time_slot == ''): ?> bg-danger text-white <?php endif; ?>" <?php if($appointment->time_slot == ''): ?> data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" <?php endif; ?>>

                                            <div class="col-md-6">



                                                <div class="d-flex align-items-center">

                                                    <div class="m-r-10">

                                                        <?php if( $appointment->avatar == ''): ?>

                                                            <img src="<?php echo e(url('assets/images/users/default.png')); ?>" alt="user" class="img-circle" width="60">

                                                        <?php else: ?>

                                                            <img src="<?php echo e(url('assets/images/users/'.$appointment->avatar)); ?>" alt="user" class="img-circle" width="60">

                                                        <?php endif; ?>

                                                    </div>

                                                    <div>

                                                        <h3 class="m-b-0"><?php echo e(ucwords($appointment->name .' '. $appointment->lname)); ?></h3>

                                                        <span> <i class="fa fa-phone"></i> <a href="tel:<?php echo e($appointment->phone); ?>"><?php echo e($appointment->phone); ?></a> </span>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <p>

                                                    <?php
                                         if($appointment->apptype == 'test'){
                                  if($appointment->t_type=="manual"){
                                   $title = 'Manual Driving Test';
                                  } else if($appointment->t_type=="both")    {
                                   $title = 'Auto Driving Test';
                                  } else{
                                   $title = 'Auto Driving Test';
                                  }

                                }else{

                                  if($appointment->t_type=="manual"){
                                   $title = 'Manual Lesson - '.$appointment->lesson_hour.' hour';
                                  }else if($appointment->t_type=="both") {
                                   $title = 'Auto Lesson  - '.$appointment->lesson_hour.' hour';
                                  } else{
                                   $title = 'Auto Lesson  - '.$appointment->lesson_hour.' hour';
                                  }
                                }
                                  ?>


                                            <span style="font-weight: 600; font-size: 18px;"><?php echo e($title); ?><?php echo e($appointment->lesson_hour > 1 ? "s" : ""); ?></span>
                                                        <br>

                                                <?php //echo $appointment->apptype;

                                                if($appointment->apptype=="test")

                                                {

                                                    $start_date = $appointment->start_date;

                                                    $pickup = strtotime($start_date)-3600;

                                                    $pickuptime = date('h:i a', $pickup);

                                                    $startT = date('h:i a', strtotime($appointment->start_date));

                                                    ?>

                                                    <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?> <br>Pickup time: <?php echo e($pickuptime); ?><br>Start time: <?php echo e($startT); ?></span><br> <?php

                                                }

                                                else{?>

                                                    <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?> &emsp; <?php echo e($appointment->time_slot); ?></span><br> <?php

                                                } ?>





                                                <?php

                                                $address = "";

                                                if(is_object($appointment)){

                                                    // echo $appointment->address;

                                                    $ad = @json_decode($appointment->address);

                                                    if(json_last_error() == JSON_ERROR_NONE){

                                                        if(@$ad->address_detail->country == 'Australia') {

                                                         $address = $ad->address .', '. @$ad->address_detail->country;

                                                        } else {

                                                            $address = $ad->address .', '. @$ad->address_detail->city. ', '. @$ad->address_detail->country;

                                                        }

                                                    }



                                                }

                                                ?>



                                                <?php if(isset($address)): ?>

                                                <span style="font-weight: 600; line-height: 35px;"><?php echo e($address); ?></span>

                                                <?php endif; ?>


                                                <?php if($appointment->status!='cancelled'): ?>
                                                    <?php
                                                    $startDateHistory= date("Y-m-d H:i:s",strtotime($appointment->start_date));
                                                    $sixHourTime3 = date("Y-m-d H:i:s", strtotime($startDateHistory . " -6 hours"));
                                                    $twelveHour3 = date("Y-m-d H:i:s", strtotime($startDateHistory . " -12 hours"));
                                                    $today_time3 = date("Y-m-d H:i:s");
                                                    ?>
                                                    <div>
                                                        <?php if(strtotime($today_time3)<=strtotime($twelveHour3)): ?>
                                                            <?php if($appointment->status=='confirmed'): ?>
                                                                <?php if(strtotime($today_time3)<=strtotime($twelveHour3)): ?>
                                                                    <a data-toggle="tooltip" data-title="Cancel booking" href="javascript:;" onclick="AppointmentComplete(this)" data-appointment-id="<?=$appointment->id?>" data-instructor-id="<?=$appointment->instructor_id?>" data-lesson-hour="<?=$appointment->lesson_hour?>"  class="btn btn-danger pull-right" style="margin-bottom: 20px;border-radius: 8px;"><i class="fa fa-times"></i> Cancel</a>
                                                                <?php endif; ?>
                                                                <?php if(strtotime($today_time3)<=strtotime($sixHourTime3)): ?>
                                                                    <a  href="javascript:;" onclick="ShowTimeSlots(this)" data-type="<?php echo e($appointment->type); ?>" data-id="<?=$appointment->id?>" data-search-id="<?=$appointment->search_id?>" data-instructor-id="<?=$appointment->instructor_id?>" data-lesson-hour="<?=$appointment->lesson_hour?>" data-start-date="<?=$appointment->schedule_date?>" class="pull-right btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-calendar"></i> Reschedule</a>
                                                                <?php endif; ?>
                                                            <?php elseif($appointment->status=='cancelled_payment_wave'): ?>
                                                                <div>
                                                                    <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled & Payment Wave</span>
                                                                </div>
                                                            <?php elseif($appointment->status=='cancelled'): ?>
                                                                <div>
                                                                    <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                                                </div>
                                                            <?php elseif($appointment->status=='no_charge'): ?>
                                                                <div>
                                                                    <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">No charge added By Instructor</span>
                                                                </div>
                                                            <?php elseif($appointment->status=='completed'): ?>
                                                                <div>
                                                                    <span style="background: #22c6ab; padding: 4px;font-weight: 500;padding-right: 12px; padding-left: 12px;border-radius: 10px;color: white;">Payment Authorized (Completed)</span>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <?php if(strtotime($today_time3)>=strtotime($twelveHour3)): ?>
                                                                <a data-toggle="tooltip" data-title="Cancel booking" href="javascript:;" onclick="CanNotCancel(this)"  class="btn btn-danger pull-right" style="margin-bottom: 20px;border-radius: 8px;"><i class="fa fa-times"></i> Cancel</a>
                                                            <?php endif; ?>
                                                            <?php if(strtotime($today_time)>=strtotime($sixHourTime3)): ?>
                                                                <a  href="javascript:;" onclick="CanNotResecudle(this)"  class="pull-right btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-calendar"></i> Reschedule</a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                <?php elseif($appointment->status=='cancelled'): ?>
                                                    <div style="margin-bottom: 28px">
                                                        <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                                    </div>
                                                <?php endif; ?>

                                            </div>

                                        </div>





                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php else: ?>

                                        <tr>

                                            <h4 class="card-title">Record Not Found</h4>

                                        </tr>

                                    <?php endif; ?>



                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

    </div>



    <!-- Modal -->

    <div class="modal fade" id="AppointmentDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document" style="width: 80%; max-width: none!important;">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Lesson Details</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="table-responsive">

                        <div id="appointments_detail">



                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>



    <!-- Modal -->

    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Review Instructor</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">



                    <form action="" id="review_form">

                        <input type="hidden" name="score" id="user_score">

                        <input type="hidden" name="id" id="rate_id">

                        <input type="hidden" name="user_id" id="inst_id">

                        <div class="form-group">
                            <label for="">Select Rating</label>
                            <div class="rating" data-rating="0">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Descriptions</label>
                            <textarea required class="form-control user_review_text" name="review"  rows="4" placeholder="Say something about instructor services"></textarea>
                        </div>


                        <div class="form-group">

                            <div data-toggle="tooltip" id="readOnly" data-score="5" class="" ></div>

                        </div>

                    </form>



                </div>

                <div class="modal-footer">

                    <button type="submit" form="review_form" class="btn btn-success">save</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>

    </div>


    <!-- Google review Modal -->

    <div class="modal fade" id="googleModal" tabindex="-1" role="dialog" aria-labelledby="googleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Leave A Google Review</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">



                    <form action="" id="google_review_form">

                        <input type="hidden" name="score" id="google_review_user_score">

                        <input type="hidden" name="id" id="rate_id">

                        <input type="hidden" name="user_id" id="inst_id">

                        <div class="form-group">
                        <p class="google_review_text">It's great to hear you had a positive experience. You can help us to get even more bookings by leaving a Google review, it only takes a few second.
                        </p>

                        </div>

                        <div class="form-group">

                            <div data-toggle="tooltip" id="readOnly" data-score="5" class="" ></div>

                        </div>

                    </form>

                     <a target="_blank" href="https://g.page/r/CS4pXTlcUcckEAI/review" class="btn btn-success pull-left googel-btn">Submit Google Review</a>


                </div>



            </div>

        </div>

    </div>

    <div class="modal fade" id="TimeSlotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form id="book_time">
                <input type="hidden" name="schedule_date">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;width: 100%">Booking Update Lesson</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 50px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="text" class="form-control" name="search_id" id="search_id">
                        <input type="text" class="form-control" name="id" id="appt_id">
                        <input type="text" class="form-control" name="instructor_id" id="instructor_id">
                        <input type="text" class="form-control" name="type" id="typePackage">

                        <section class="book_lesson add_cart_sec">
                            <div class="add_cart_wrapper">
                                <div class="book_lesson_wrapper">
                                    <!-- Choose driving-lesson time-date and hours-->
                                    <div class="driving_lesson mb-4">
                                        <div class="dl_body">
                                            <div class="dl_duration">
                                                <h4 class="text-center">Duration</h4>
                                                <div class="dl_hours_duration">
                                                    <form class="row" action="#" id="drivingLessonAddingForm">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="col-6 d-flex justify-content-end">
                                                                <div class="form-check checked-hour" id="one_hour_div">
                                                                    <input  class="form-check-input" id="one_hour" type="checkbox">
                                                                    <label class="form-check-label" for="1">
                                                                        1 hour
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-check" id="two_hour_div">
                                                                    <input class="form-check-input" id="two_hour" type="checkbox">
                                                                    <label class="form-check-label" for="2">
                                                                        2 hour
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex justify-content-center">
                                                            <div class="col-sm-6 col-12 mt-3  d-flex justify-content-sm-end justify-content-center" id="lesonDivContent">

                                                            </div>
                                                            <div class="col-sm-6 col-12 mt-3 mb-sm-0 mb-2 d-flex justify-content-sm-start justify-content-center">
                                                                <select class="availability_check" aria-label="Default select example">
                                                                    <option selected>Available Times</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3 text-center">
                                                            <button class="btn btn-primary" type="submit">UPDATE</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="available_dates_time row"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Choose driving-test time-date and locatin  -->

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="testPackageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form id="book_time">
                <input type="hidden" name="schedule_date">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;width: 100%">Booking Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 50px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="book_lesson add_cart_sec">
                            <div class="add_cart_wrapper">
                                <div class="book_lesson_wrapper">
                                    <!-- Choose driving-lesson time-date and hours-->
                                    <div class="driving_lesson mb-4">
                                        <div class="dl_body">
                                            <div class="dl_duration test_booking">
                                                <h4 class="text-center">Allan’s test location & availabilty displayed111</h4>
                                                <div class="row dl_hours_duration">
                                                    <form class="row" action="" id="packageForm">
                                                        <div class="col-12">
                                                            <select class="form-select availability_check choose_location mx-auto" aria-label="Default select example">
                                                                <option selected>Choose your test location</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 col-12 mt-3  d-flex justify-content-sm-end justify-content-center">
                                                            <select class="form-select availability_check" aria-label="Default select example">
                                                                <option selected>Test date</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 col-12 mt-3 mb-sm-0 mb-2 d-flex justify-content-sm-start justify-content-center">
                                                            <select class="form-select availability_check" aria-label="Default select example">
                                                                <option selected>Test start time</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 mt-3 text-center">
                                                            <button class="btn btn-primary" type="submit">UPDATE</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="available_dates_time row"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Choose driving-test time-date and locatin  -->
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/fh-3.1.4/datatables.min.js"></script>
    <script src="<?php echo e(asset('assets/js/calendar/packages/core/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/calendar/packages/interaction/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/calendar/packages/daygrid/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/calendar/packages/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/calendar/packages/timegrid/main.js')); ?>"></script>
    <!-- This Page JS -->

    <script>
        $(document).ready(function() {
            $('.star').click(function() {
                var selectedValue = parseInt($(this).data('value'));

                // Clear all stars
                $('.star').removeClass('active');

                // Fill stars up to the selected value
                for (var i = 1; i <= selectedValue; i++) {
                    $('.star[data-value="' + i + '"]').addClass('active');
                }

                // Update the data-rating attribute and display the selected rating
                $('.rating').data('rating', selectedValue);
                $('#user_score').val(selectedValue);
                $('#google_review_user_score').val(selectedValue);
            });
        });


        $(document).on('click', '.book-inst',  function(e) {

            e.preventDefault();

            var inst = $(this).attr('data-instructor');
            var credit = $(this).attr('data-credit');

            var learnerID = "<?php echo $learner_id; ?>";

            if(credit>1){
                $.post('<?php echo e(url('create-search-from-learner')); ?>',

                { learner_id: learnerID, '_token': '<?php echo e(@csrf_token()); ?>','credit':credit },

                function (data) {

                    window.location.href = "<?php echo e(url('/')); ?>/book-online/book/"+data.search_id+"/instructor/"+inst;

                });
            }else{
                  swal('Warning', 'Credit should be available', 'warning');
            }

        });







        var hint = '<?php echo e(@$rating->total); ?> votes, average <?php echo e(floor(@$rating->avg)); ?> out of 5';

        (function ($) {

            $(function () {



                $('.click').raty({

                    readOnly: function(){

                        return $(this).attr('data-read');

                    },

                    score: function () {

                        return $(this).attr('data-score');

                    },

                    half: true,

                    hints: [hint, hint, hint, hint, hint]

                });

            });

        })(jQuery);

        function CanNotCancel(){
        Swal.fire('Sorry you can not cancel now.', '', 'info')
        }

        function CanNotResecudle(){
            Swal.fire('Sorry you can not Reschedule now.', '', 'info')
        }

        $(document).ready(function (){

            $('#review_form').submit(function (){


                if( $('#user_score').val() == '' ){
                    swal('Warning', 'Rating is required', 'warning');
                    return false;
                }
                let data = new FormData(this);



                $.ajax({

                    url: "<?php echo e(route('give_review')); ?>",

                    data: data,

                    contentType: false,

                    processData: false,

                    type: 'POST',

                    success: function (res) {

                        if (res.success == true) {

                            $('#reviewModal').modal('hide');
                            $('#googleModal').modal('show');

                            // Swal.fire({
                            //     title: 'You have sumitted successfully!',
                            //     text: "Do You want to submit google review ?",
                            //     type: 'success',
                            //     showCancelButton: true,
                            //     confirmButtonColor: '#3085d6',
                            //     cancelButtonColor: '#d33',
                            //     confirmButtonText: 'Yes'
                            // }).then((result) => {
                            //     /* Read more about isConfirmed, isDenied below */
                            //     if (result.value) {
                            //
                            //     } else if (result.isDenied) {
                            //         Swal.fire('Changes are not saved', '', 'info')
                            //     }
                            // })
                        }else{

                            swal('Opps', res.message, 'error');

                        }

                    }

                });

                return false;

            });

        });





        var hint1 = 'give 1 star to instructor';

        var hint2 = 'give 2 star to instructor';

        var hint3 = 'give 3 star to instructor';

        var hint4 = 'give 4 star to instructor';

        var hint5 = 'give 5 star to instructor';



        function reviewPop(id){

            $('#inst_id').val(id);

            $.post('<?php echo e(route('get_review')); ?>',

                {id: id},

                function (res) {

                    if(res.success == false){



                        $('#readOnly').raty({

                            readOnly: function(){

                                return $(this).attr('data-read');

                            },

                            score: function () {

                                return $(this).attr('data-score');

                            },

                            click: function (score, evt)

                            {

                                $('#user_score').val(score);

                            },

                            half: false,

                            hints: [hint1, hint2, hint3, hint4, hint5]

                        });



                    }else{



                        if(res.review.review!='' && res.review.review!=null ) {

                            $('textarea[name="review"]').val(res.review.review).prop('disabled', true);

                        }

                        $('#user_score').val(res.score);

                        $('#rate_id').val(res.id);





                        $('#readOnly').raty({

                            readOnly: true,

                            score: res.review.score,

                        });

                    }

                });



            $('#reviewModal').modal('show')

        }



        function AppointmentDetailModal(e){

            $("#loading").show();

            var AppointmentID = $(e).attr('data-appointment-id');

            var UserType = $(e).attr('data-user-type');

            $.post('<?php echo e(route('get-appointment-detail')); ?>',

                {AppointmentID: AppointmentID, UserType: UserType},

                function (res) {

                    var PaymentStatus = '';

                    var LearnerAvatar = '';

                    if(res.success == true){

                        $('#appointments_detail').html(res.data);

                        $("#loading").hide();

                        $('#AppointmentDetailModal').modal('show');

                    }

                });

        }

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


        function ShowTimeSlots(e){
            var instructor_id = $(e).attr('data-instructor-id');
            var lessonHour = $(e).attr('data-lesson-hour');
            var start_date = $(e).attr('data-start-date');
            var search_id = $(e).attr('data-search-id');
            var id = $(e).attr('data-id');
            var type = $(e).attr('data-type');

            //$('#calendar').html('');
            $('#availability_modal').modal('show');
            $('#instructor_id').val(instructor_id);
            $('#appt_id').val(id);
            // $('#date_picker').val(start_date);
            $('#search_id').val(search_id);
            $('#typePackage').val(type);

            if (type=='lesson'){
                alert(lessonHour);
                if(lessonHour==1){
                    $('input#one_hour').prop('checked', true);
                }
                $('div#TimerBlockDiv').show();
                jQuery.ajax({
                    url: '<?php echo e(url('get_instructor_calendar2')); ?>',
                    type: 'POST',
                    data: {
                        id: instructor_id,
                        type:'lesson',
                    },
                    success: function(response) {
                        $('div#lesonDivContent').html(response.html);
                        $('#TimeSlotModal').modal('show');
                    }
                });

            }else {
                $('#testPackageModal').modal('show');
                
                
                
                
                
                
                
                
                
                
                
                
                
            }
        }

        $(document).on('change','select#timeHour', function(event) {
            jQuery.ajax({
                url: '<?php echo e(url('get_instructor_calendar2')); ?>',
                type: 'POST',
                data: {
                    id:  $('#instructor_id').val(),
                    type:'lesson',
                },
                success: function(response) {
                    $('div#lesonDivContent').html(response.html);
                }
            });
        });

        $(document).on('change','#lesson_date', function(event) {
            var start_date = this.value;
            if ($('select#timeHour').val()){
                $.post('<?php echo e(url('get-slots')); ?>',
                    { hour:$('select#timeHour').val(), start_date:start_date, instructor_id: $('#instructor_id').val(), userid:<?php echo e(auth()->user()->id); ?>, '_token': '<?php echo e(@csrf_token()); ?>' },
                    function (data) {
                        $("#show_slots").html('');
                        $("#show_slots").append(data.html);
                    });
            }
        });


        $(document).on('change','select#test_location_date', function(event) {
            var start_date = this.value;
            $.post('<?php echo e(url('get-slots1')); ?>',
                { hour:1, start_date:start_date, instructor_id: $('#instructor_id').val(), userid:<?php echo e(auth()->user()->id); ?>, '_token': '<?php echo e(@csrf_token()); ?>' },
                function (data) {
                    $("#show_slots").html('');
                    $("#show_slots").append(data.html);
                });
        });

        $(document).on('change','#lesson_date', function(event) {
            var start_date = this.value;
            if ($('select#timeHour').val()){
                $.post('<?php echo e(url('get-slots')); ?>',
                    { hour:$('select#timeHour').val(), start_date:start_date, instructor_id: $('#instructor_id').val(), userid:<?php echo e(auth()->user()->id); ?>, '_token': '<?php echo e(@csrf_token()); ?>' },
                    function (data) {
                        $("#show_slots").html('');
                        $("#show_slots").append(data.html);
                    });
            }
        });

        function myCalendar(data, instructor_id) {

            $('#calendar').html('');

            var mon='no',tue='no',wed='no',thu='no',fri='no',sat='no',sun='no';

            $.each(data.working_time, function(key,val){

                if(val.day == 'monday')
                    mon = val.is_enabled;

                else if(val.day == 'tuesday')
                    tue = val.is_enabled;

                else if(val.day == 'wednesday')
                    wed = val.is_enabled;

                else if(val.day == 'thursday')
                    thu = val.is_enabled;

                else if(val.day == 'friday')
                    fri = val.is_enabled;

                else if(val.day == 'saturday')
                    sat = val.is_enabled;

                else if(val.day == 'sunday')
                    sun = val.is_enabled;
            });

            var calendarEl = document.getElementById('calendar');
            var today = moment().format("YYYY-MM-DD");

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid'],

                header: {
                    left: 'prev',
                    center: 'title',
                    right: 'dayGridMonth, next'
                },

                unselectAuto: false,
                dragScroll: false,
                defaultDate: today,
                //eventLimit: true,
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: true,
                selectable: true,
                selectMirror: true,
                selectLongPressDelay: false,
                eventLongPressDelay: false,
                LongPressDelay: false,
                backgroundColor: 'red',
                /*hiddenDays: hidden_days,*/
                select: (start, end, allDay) => {
                    //console.log(start);
                    const date = moment(start.startStr);
                    const weak_day = date.day();
                    //console.log(weak_day);
                    var start_date = start.startStr;

                    if (start_date < today) {
                        swal('Warning', 'You cannot select a date prior to the current date', 'warning');
                        return false;
                    } else {

                        if (weak_day == 0 && sun == 'no') {
                            swal('Warning', 'Sunday is closed', 'warning');
                            return false;
                        } else if (weak_day == 1 && mon == 'no') {
                            swal('Warning', 'Monday is closed', 'warning');
                            return false;
                        } else if (weak_day == 2 && tue == 'no') {
                            swal('Warning', 'Tuesday is closed', 'warning');
                            return false;
                        } else if (weak_day == 3 && wed == 'no') {
                            swal('Warning', 'Wednesday is closed', 'warning');
                            return false;
                        } else if (weak_day == 4 && thu == 'no') {
                            swal('Warning', 'Thursday is closed', 'warning');
                            return false;
                        } else if (weak_day == 5 && fri == 'no') {
                            swal('Warning', 'Friday is closed', 'warning');
                            return false;
                        } else if (weak_day == 6 && sat == 'no') {
                            swal('Warning', 'Saturday is closed', 'warning');
                            return false;
                        }
                    }
                    /*time slots request*/
                    $("#show_slots").html('<center><i class="fa fa-spin fa-spinner"></i></center>');

                    $.post('<?php echo e(url('get-slots')); ?>',
                        {
                            start_date: start_date,
                            instructor_id: instructor_id,
                            '_token': '<?php echo e(@csrf_token()); ?>'
                        },
                        function (data) {
                            $("#show_slots").html('');
                            $("#loading").hide();
                            $("#show_slots").append(data.html);
                            $("#date").text(start_date);
                            $("input[name='schedule_date']").val(start_date);
                        })

                },
            });

            calendar.render();

            $(document).ready(function () {
                window.setInterval(function () {
                    //console.log('clicked')
                    $('.fc-day-number').removeAttr('data-goto');
                }, 1000);
            });

            $(document).on('click', '.fc-day-top', function () {

                setTimeout(function () {
                    $('.fc-dayGridDay-view .fc-day-grid-container').prepend('<div class="alert-box success">' +
                        '<div class="alert alert-success">' +
                        ' <small>Click anywhere on the box below to show the available timeslots. Click the month button above to return to full calendar view.</small>' +
                        '</div>' +
                        '</div>');
                }, 1);
            })

        }


        $('#date_picker').change(function() {
            $("#loading").show();
            var start_date = $(this).val();
            var instructor_id = $('#instructor_id').val();
            $.post('<?php echo e(url('get-slots')); ?>',
                { start_date:start_date, instructor_id: instructor_id, '_token': '<?php echo e(@csrf_token()); ?>' },
                function (data) {
                    if(data.html){
                        $("#show_slots").html('');
                        $("#loading").hide();
                        $("#show_slots").append(data.html);
                    }else{
                        $("#show_slots").html('');
                        $("#loading").hide();
                        $("#show_slots").html('<center><h4 class="text-danger"><strong>oops!</strong> Time Slot not Available</h4></center>');
                    }
                })
        });

        $('#book_time').submit(function (){

            var data = new FormData(this);

            $.ajax({
                url: "<?php echo e(Route('Update-book-time')); ?>",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {

                    if(res.success == true){

                        swal('Updated','This change has been saved', 'success')
                            .then(function() {
                                $('#TimeSlotModal').modal('hide');
                                location.reload();
                            });

                    }else if(res.success == false){
                        swal('oops!', res.message, 'warning');

                    }
                    // $('.fa-spinner').addClass('hidden');
                },
                error: function () {
                    // $('.fa-spinner').addClass('hidden');
                    swal('oops!', 'something went wrong', 'warning');
                }
            });

            return false;
        });

        function AppointmentComplete(e){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to cancel this booking.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText:'No'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    $("#loading").show();
                    var InstructorID = $(e).attr('data-instructor-id');
                    var AppointmentID = $(e).attr('data-appointment-id');
                    $.post('<?php echo e(route("Change-appointment-status")); ?>',{AppointmentID:AppointmentID, InstructorID:InstructorID,status:'cancelled'},function(res){
                        $("#loading").hide();

                        if(res.success==true){

                            swal("Cancelled",'Booking cancel successfully.', "success");
                            $('#lessons_table').DataTable().ajax.reload();
                            location.reload()

                        }else if(res.success==false){
                            swal("Error!",data.message, "error");
                        }

                    });

                    return false;
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7.4.9\htdocs\firstpass\resources\views/learner/home.blade.php ENDPATH**/ ?>