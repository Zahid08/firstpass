@extends('layouts.app')



@section('content')

    <div class="page-breadcrumb">

        <div class="row">

            <div class="col-5 align-self-center">

                <!-- <h4 class="page-title">Dashboard</h4>
 -->
                <div class="d-flex align-items-center">



                </div>

            </div>

            <div class="col-7 align-self-center">

                <div class="d-flex no-block justify-content-end align-items-center">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">

                                <a href="{{url('home')}}">Home</a>

                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>



    <div class="container-fluid">

        <!-- ============================================================== -->

        <!-- Welcome back  -->

        <!-- ============================================================== -->

        <div class="row">

            <div class="col-lg-12">

                <div class="card  bg-light no-card-border">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="m-r-10">

                                @if( auth()->user()->avatar == '')

                                    @if( auth()->user()->gender == 'male')

                                    <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="image_preview rounded-circle" width="31">

                                    @else

                                    <img src="{{ url('assets/images/users/default-female.png') }}" alt="user" class="image_preview rounded-circle" width="31">

                                    @endif

                                @else

                                <img src="{{ url('assets/images/users/'.auth()->user()->avatar) }}" alt="user" class="image_preview rounded-circle" width="31">

                                @endif

                            </div>

                            <div>

                                <h3 class="m-b-0">Welcome back!</h3>

                                <span>{{ \Carbon\Carbon::now()->format('l jS \of F Y') }}</span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="card-group">

            <div class="card">

                <a href="{{ url('appointments?type=total') }}">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-12">

                                <h3>{{ $TotalLesson }}</h3>

                                <h6 class="card-subtitle">Total Lessons</h6>

                            </div>

                            <div class="col-12">

                                <div class="progress">

                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"

                                        aria-valuemax="100">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- Column -->

            <!-- Column -->

            <div class="card">

                <a href="{{ url('appointments?type=completed') }}">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-12">

                                <h3>{{ $TotalLessonCompleted }}</h3>

                                <h6 class="card-subtitle">Total Completed Lessons</h6>

                            </div>

                            <div class="col-12">

                                <div class="progress">

                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"

                                        aria-valuemax="100"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- Column -->

            <!-- Column -->

            <div class="card">

                <a href="{{ url('appointments?type=learner') }}">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-12">

                                <h3>{{ $TotalLearner }}</h3>

                                <h6 class="card-subtitle">Total Learners</h6>

                            </div>

                            <div class="col-12">

                                <div class="progress">

                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"

                                        aria-valuemax="100"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

            <!-- Column -->

            <!-- Column -->



        </div>

        <!-- ============================================================== -->

        <!-- project of the month -->

        <!-- ============================================================== -->

        <div class="row">

            <div class="col-sm-12 col-lg-8">
                <div class="card">

                    <div class="card-body p-b-0">

                        @if(isset($UpcomingAppointment->avatar))

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
                            <h4 class="card-title" style="font-weight: 700;color: orangered">Your lesson {{$days}}<!-- {{\Carbon\Carbon::parse($UpcomingAppointment->schedule_date)->format('j F Y')}} --></h4>

                            <hr>

                            <div class="row @if($UpcomingAppointment->time_slot == '') bg-danger text-white @endif" @if($UpcomingAppointment->time_slot == '') data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" @endif>

                                <div class="col-md-6">



                                    <div class="d-flex align-items-center">

                                        <div class="m-r-10">

                                            @if( $UpcomingAppointment->avatar == '')

                                                @if($UpcomingAppointment->gender == 'male')

                                                    <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle" width="60">

                                                @else

                                                    <img src="{{ url('assets/images/users/default-female.png') }}" alt="user" class="img-circle" width="60">

                                                @endif

                                            @else

                                                <img src="{{ url('assets/images/users/'.$UpcomingAppointment->avatar) }}" alt="user" class="img-circle" width="60">

                                            @endif

                                        </div>

                                        <div>

                                            <h3 class="m-b-0">{{ ucwords($UpcomingAppointment->name .' '. $UpcomingAppointment->lname) }}</h3>

                                            <span> <i class="fa fa-phone"></i> <a href="tel:{{$UpcomingAppointment->phone}}">{{$UpcomingAppointment->phone}}</a> </span>

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


                                        <span style="font-weight: 600; font-size: 18px;">{{$title}}{{ $UpcomingAppointment->lesson_hour > 1 ? "s" : "" }}</span>

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

                                        Pickup time: {{$pickuptime}}<br>Start time: {{$startT}}</span><br> <?php

                                        }

                                        else{?>

                                        <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($UpcomingAppointment->schedule_date)); ?> &emsp; {{$UpcomingAppointment->time_slot}}</span><br> <?php

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



                                        @if(isset($address))

                                            <span style="font-weight: 600; line-height: 35px;">{{$address}}</span>

                                    @endif

                                    <div style="margin-bottom: 18px;">
                                    @if($UpcomingAppointment->status=='confirmed')
                                        <div>
                                            <a  href="javascript:;" onclick="ShowTimeSlots(this)" data-date="<?=date('D, d F, Y', strtotime($UpcomingAppointment->schedule_date))?>" data-time="<?=$UpcomingAppointment->time_slot?>" data-name="{{ ucwords($UpcomingAppointment->name .' '. $UpcomingAppointment->lname) }}" data-id="<?=$UpcomingAppointment->id?>" data-search-id="<?=$UpcomingAppointment->search_id?>" data-instructor-id="<?=$UpcomingAppointment->instructor_id?>" data-start-date="<?=$UpcomingAppointment->schedule_date?>" class="btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-check-square"></i> Authorize or waive Payment</a>
                                        </div>
                                    @elseif($UpcomingAppointment->status=='cancelled_payment_wave')
                                        <div>
                                            <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled (Payment waived)</span>
                                        </div>
                                    @elseif($UpcomingAppointment->status=='cancelled')
                                        <div>
                                            <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                        </div>
                                    @elseif($UpcomingAppointment->status=='no_charge')
                                        <div>
                                            <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">No show (payment completed)</span>
                                        </div>
                                    @elseif($UpcomingAppointment->status=='completed')
                                        <div>
                                            <span style="background: #22c6ab; padding: 4px;font-weight: 500;padding-right: 12px; padding-left: 12px;border-radius: 10px;color: white;">Payment authorised (Completed)</span>
                                        </div>
                                    @endif
                                    </div>

                                </div>

                            </div>

                        @else

                            <h4 class="card-title">Upcoming lesson not found!</h4>

                            <hr>

                        @endif

                    </div>

                </div>
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">Upcoming Lesson</h4>
                        <!--  <button class="refresh-btn btn btn-xs m-b-5 btn-primary pull-right m-b-5" data-toggle="tooltip" data-title="Refresh data" ><i class="fas fa-sync-alt"></i></button> -->

                        <br><br>





                        @if($appointments->isNotEmpty())

                            @foreach($appointments as $appointment)

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
                                <h4 class="card-title">Your lesson {{$days}}<!-- {{\Carbon\Carbon::parse($appointment->schedule_date)->format('j F Y')}} --></h4>

                                <hr>

                                <div class="row">

                                    <div class="col-md-6">



                                        <div class="d-flex align-items-center">

                                            <div class="m-r-10">

                                                @if( $appointment->avatar == '')

                                                    @if($appointment->gender == 'male')

                                                        <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle" width="60">

                                                    @else

                                                        <img src="{{ url('assets/images/users/default-female.png') }}" alt="user" class="img-circle" width="60">

                                                    @endif

                                                @else

                                                    <img src="{{ url('assets/images/users/'.$appointment->avatar) }}" alt="user" class="img-circle" width="60">

                                                @endif

                                            </div>

                                            <div>

                                                <h3 class="m-b-0">{{$appointment->name}} {{$appointment->lname}}</h3>

                                                <span> <i class="fa fa-phone"></i> <a href="tel:{{$appointment->phone}}">{{$appointment->phone}}</a> </span>

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

                                        <!-- <span style="font-weight: 600; font-size: 18px;">{{ $appointment->apptype == "test" ? "Auto Driving Test" : "Auto Lesson - ".$appointment->lesson_hour." hour" }}{{ $appointment->lesson_hour > 1 ? "s" : "" }}</span><br> -->
                                            <span style="font-weight: 600; font-size: 18px;">{{$title}}{{ $appointment->lesson_hour > 1 ? "s" : "" }}</span>
                                            <br>


                                            <?php if($appointment->apptype=="test")

                                            {

                                            $start_date = $appointment->start_date;

                                            $pickup = strtotime($start_date)-3600;

                                            $pickuptime = date('h:i a', $pickup);

                                            $startT = date('h:i a', strtotime($appointment->start_date));

                                            ?>

                                            <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?> <br>Pickup time: {{$pickuptime}}<br>Start time: {{$startT}}</span><br> <?php

                                            }

                                            else{ ?>

                                            <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?>&emsp;{{$appointment->time_slot}}</span><br> <?php

                                            } ?>



                                            @if(isset($address))

                                                <span style="font-weight: 600; line-height: 35px;">{{$address}}</span>

                                            @endif

                                        </p>
                                            @if($appointment->status=='confirmed')
                                                <div>
                                                    <a  href="javascript:;" onclick="ShowTimeSlots(this)" data-date="<?=date('D, d F, Y', strtotime($appointment->schedule_date))?>" data-time="<?=$appointment->time_slot?>" data-name="{{ ucwords($appointment->name .' '. $appointment->lname) }}" data-id="<?=$appointment->id?>" data-search-id="<?=$appointment->search_id?>" data-instructor-id="<?=$appointment->instructor_id?>" data-start-date="<?=$appointment->schedule_date?>" class="btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-check-square"></i> Authorize or waive Payment</a>
                                                </div>
                                            @elseif($appointment->status=='cancelled_payment_wave')
                                                <div>
                                                    <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled (Payment waived)</span>
                                                </div>
                                            @elseif($appointment->status=='cancelled')
                                                <div>
                                                    <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                                </div>
                                            @elseif($appointment->status=='no_charge')
                                                <div>
                                                    <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">No show (payment completed)</span>
                                                </div>
                                            @elseif($appointment->status=='completed')
                                                <div>
                                                    <span style="background: #22c6ab; padding: 4px;font-weight: 500;padding-right: 12px; padding-left: 12px;border-radius: 10px;color: white;">Payment authorised (Completed)</span>
                                                </div>
                                            @endif
                                    </div>

                                </div>
                            @endforeach

                        @endif
                    </div>

                </div>
                <div class="card">

                    <div class="card-body p-b-0">

                        <h4 class="card-title">Booking History</h4>



                        <div class="d-flex align-items-center flex-row m-t-30">

                            <div class="w-100" >

                                @if($BookingHistory->isNotEmpty())

                                    @foreach($BookingHistory as $appointment)



                                        <hr>

                                        <div class="row @if($appointment->time_slot == '') bg-danger text-white @endif" @if($appointment->time_slot == '') data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" @endif>

                                            <div class="col-md-6" style="margin-bottom: 15px;">



                                                <div class="d-flex align-items-center">

                                                    <div class="m-r-10">

                                                        @if( $appointment->avatar == '')

                                                            <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle" width="60">

                                                        @else

                                                            <img src="{{ url('assets/images/users/'.$appointment->avatar) }}" alt="user" class="img-circle" width="60">

                                                        @endif

                                                    </div>

                                                    <div>

                                                        <h3 class="m-b-0">{{ ucwords($appointment->name .' '. $appointment->lname) }}</h3>

                                                        <span> <i class="fa fa-phone"></i> <a href="tel:{{$appointment->phone}}">{{$appointment->phone}}</a> </span>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-6" style="margin-bottom: 15px;">

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
                                                    <span style="font-weight: 600; font-size: 18px;">{{$title}}{{ $appointment->lesson_hour > 1 ? "s" : "" }}</span>
                                                    <br>

                                                    <?php //echo $appointment->apptype;

                                                    if($appointment->apptype=="test")

                                                    {

                                                    $start_date = $appointment->start_date;

                                                    $pickup = strtotime($start_date)-3600;

                                                    $pickuptime = date('h:i a', $pickup);

                                                    $startT = date('h:i a', strtotime($appointment->start_date));

                                                    ?>

                                                    <span style="font-weight: 600; line-height: 35px;" id="gettingHourRate"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?> <br>Pickup time: {{$pickuptime}}<br>Start time: {{$startT}}</span><br> <?php

                                                    }

                                                    else{?>

                                                    <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?> &emsp; {{ $appointment->time_slot}}</span><br> <?php

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



                                                    @if(isset($address))

                                                        <span style="font-weight: 600; line-height: 35px;">{{$address}}</span>

                                                @endif


                                                <?php
                                                $startDate= date("Y-m-d H:i:s",strtotime($appointment->start_date));
                                                $sixHourTime = date("Y-m-d H:i:s", strtotime($startDate . " -6 hours"));
                                                $twelveHour = date("Y-m-d H:i:s", strtotime($startDate . " -12 hours"));
                                                $today_time = date("Y-m-d H:i:s");
                                                ?>
                                                @if(strtotime($today_time)<=strtotime($twelveHour))
                                                    @if($appointment->status=='confirmed')
                                                        <div>
                                                            <a  href="javascript:;" onclick="ShowTimeSlots(this)" data-date="<?=date('D, d F, Y', strtotime($appointment->schedule_date))?>" data-time="<?=$appointment->time_slot?>" data-name="{{ ucwords($appointment->name .' '. $appointment->lname) }}" data-id="<?=$appointment->id?>" data-search-id="<?=$appointment->search_id?>" data-instructor-id="<?=$appointment->instructor_id?>" data-start-date="<?=$appointment->schedule_date?>" class="btn btn-success" style="margin-bottom: 20px;margin-right: 10px;border-radius: 8px;"><i class="fa fa-check-square"></i> Authorize or waive Payment</a>
                                                        </div>
                                                    @elseif($appointment->status=='cancelled_payment_wave')
                                                        <div>
                                                         <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled (Payment waived)</span>
                                                        </div>
                                                    @elseif($appointment->status=='cancelled')
                                                        <div>
                                                            <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">Cancelled by Learner</span>
                                                        </div>
                                                    @elseif($appointment->status=='no_charge')
                                                        <div>
                                                            <span style="background: #8080803b; padding: 4px; font-weight: 500;padding-right: 12px;padding-left: 12px;border-radius: 10px;">No show (payment completed)</span>
                                                        </div>
                                                    @elseif($appointment->status=='completed')
                                                        <div>
                                                            <span style="background: #22c6ab; padding: 4px;font-weight: 500;padding-right: 12px; padding-left: 12px;border-radius: 10px;color: white;">Payment authorised (Completed)</span>
                                                        </div>
                                                    @endif
                                                @else
                                                    <p style="color: red">You can not change status now.Time over.</p>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach

                                @else

                                    <tr>

                                        <h4 class="card-title">Record Not Found</h4>

                                    </tr>

                                @endif



                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="TimeSlotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form id="book_time" method="post">
                        <input type="hidden" name="schedule_date">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Payment Authorisation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Has your lesson with <span style="font-weight: bold" id="learnerName">Cordner</span> scheduled for <span id="learnerDate" style="font-weight: bold">31 Aug 2020,13:00 PM</span> been completed ?</h3>
                                            <a  href="javascript:;" onclick="Yes(this)"  class="btn btn-success" style="margin-bottom: 20px; margin-right: 10px; border-radius: 8px; width: 100%;padding: 6px;font-size: 17px;"><i class="fa fa-check"></i> Yes</a>
                                            <a  href="javascript:;" onclick="No(this)"  class="btn btn-danger" style="margin-bottom: 20px; margin-right: 10px; border-radius: 8px; width: 100%;padding: 6px;font-size: 17px;"><i class="fa fa-times"></i> No</a>

                                            <input type="hidden" id="selectedPaymentOptions" value="" name="selected_options">
                                            <input type="hidden" id="canceledStatus" value="cancelled_payment_wave" name="selected_status">

                                            <input type="hidden" class="form-control" name="search_id" id="search_id">
                                            <input type="hidden" class="form-control" name="id" id="appt_id">
                                            <input type="hidden" class="form-control" name="instructor_id" id="instructor_id">

                                            <div class="" id="checkingOptionsForNo" style="padding: 10px;border: 1px solid green;border-radius: 10px;display: none">

                                                <p style=" margin-bottom: 0;font-size: 18px;font-weight: 500;">Please select from two options:</p>
                                                <p style=" margin-bottom: 0;font-size: 18px;font-weight: 500;">1. Enforce the 8 hours cancellation policy and collect full payment for the booking.</p>
                                                <p style=" margin-bottom: 0;font-size: 18px;font-weight: 500;">2. Waive the full booking payment.</p>
                                                <br/>
                                                <input style="" class="" checked type="radio" name="cancel_options" value="cancelled_payment_wave"> <span style="font-size: 16px;font-weight: 500;">Waive the booking payment</span><br/>
                                                <input style="" class="" type="radio" name="cancel_options" value="no_charge"> <span style="font-size: 16px;font-weight: 500;">Charge the learner for the booking payment</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="confirmandGetPaid" style="display: none" >Confirm and Get Paid</button>
                                <button type="submit" class="btn btn-danger" id="confirmandGetCancel" style="display: none">Confirm</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <!-- WithDraw Amount Modal -->

            <div class="modal fade" id="WithDrawAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">

                    <form id="withdraw_form">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="exampleModalLabel">WithDraw Payment</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                </button>

                            </div>

                            <div class="modal-body">

                                <input type="hidden" name="instructor_id" value="{{ Auth::user()->id  }}">

                                <div class="form-group">

                                    <label>Enter Amount</label>

                                    <div class="input-group">

                                        <input type="text" name="amount" class="form-control" placeholder="Enter Withdraw Amount">

                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type="submit" class="btn btn-success">WithDraw</button>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>



            <div class="col-sm-12 col-lg-4">

                <div class="card bg-light">

                    <div class="card-body">

                        <h4 class="card-title">Total Amount (Learners Paid)</h4>

                        <div class="d-flex align-items-center flex-row m-t-30">

                            <h2><strong>${{ (isset($TotalAmount))? $TotalAmount : '0'  }}</strong></h2>

                        </div>



                    </div>

                </div>

                <div class="card bg-light">

                    <div class="card-body">

                        <h4 class="card-title">Withdrawable Amount</h4>

                        <div class="d-flex align-items-center flex-row m-t-30">

                            <h2><strong>${{ (isset($GetCompletedAppointmentsAmount))? $GetCompletedAppointmentsAmount : '0'  }}</strong></h2>

                        </div>

                        @if(isset($GetCompletedAppointmentsAmount) && $GetCompletedAppointmentsAmount > 0 )

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#WithDrawAmountModal">Processed To Withdraw</button>

                        @endif

                    </div>

                </div>

            </div>

        </div>



    </div>

@endsection



@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/fh-3.1.4/datatables.min.js"></script>
    <script src="{{ asset('assets/js/calendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/timegrid/main.js')}}"></script>
    <script src="{{ asset('assets/js/pages/dashboards/dashboard3.js')}}"></script>

    <script>

        function ShowTimeSlots(e){
            var date = $(e).attr('data-date');
            var time = $(e).attr('data-time');
            var name = $(e).attr('data-name');
            var instructor_id = $(e).attr('data-instructor-id');
            var start_date = $(e).attr('data-start-date');
            var search_id = $(e).attr('data-search-id');
            var id = $(e).attr('data-id');

            $('span#learnerName').html(name);
            $('span#learnerDate').html(date+' '+time);

            $('#instructor_id').val(instructor_id);
            $('#appt_id').val(id);
            // $('#date_picker').val(start_date);
            $('#search_id').val(search_id);

            $('#TimeSlotModal').modal('show');

        }
        function Yes(){
            $('button#confirmandGetPaid').show();
            $('div#checkingOptionsForNo').hide();
            $('button#confirmandGetCancel').hide();
            $('input#selectedPaymentOptions').val('yes');
        }

        function No(){
            $('button#confirmandGetPaid').hide();
            $('div#checkingOptionsForNo').show();
            $('button#confirmandGetCancel').show();
            $('input#selectedPaymentOptions').val('no');
        }

        $(document).ready(function() {

            $("input[name='cancel_options']").click(function(){
                var clickedValue = $("input[name='cancel_options']:checked").val();
                $('input#canceledStatus').val(clickedValue);
            });

            $('#withdraw_form').submit(function (){



                $('#loading').show();



                var data = new FormData(this);



                $.ajax({

                    url: "{{ route('withdraw-amount') }}",

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

        });


        $('#book_time').submit(function (event){
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Confirm your response is true and correct ?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                    $("#loading").show();
                    var paymentOptions = $('input#selectedPaymentOptions').val();
                    var InstructorID = $('input#instructor_id').val();
                    var AppointmentID = $('input#appt_id').val();
                    if (InstructorID && AppointmentID){
                        let status="";
                        if (paymentOptions=='no'){
                            status=$('input#canceledStatus').val();
                        }else if (paymentOptions=='yes'){
                            status='completed';
                        }

                        if (status){
                            $.post('{{ route("Change-appointment-status")}}',{AppointmentID:AppointmentID, InstructorID:InstructorID,status:status},function(res){
                                $("#loading").hide();
                                if(res.success==true){
                                    swal("Confirmed!",'Payment was authorised successfully', "success");
                                    setTimeout(function(){
                                        location.reload();
                                    }, 2000); // 2000 milliseconds (2 seconds) delay
                                }else if(res.success==false){
                                    swal("Error!",data.message, "error");
                                }
                            });
                        }
                    }

                    return false;
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        });

    </script>

@endsection

