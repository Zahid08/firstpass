@extends('layouts.app')
@section('content')
    <style>
        #appt_chart svg text{
            font-size:10px!important;
        }
    </style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('home') }}">Home</a>
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
                            <img src="assets/images/users/{{ auth()->user()->avatar }}" alt="user" width="60" class="rounded-circle" />
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
    <!-- ============================================================== -->
    <!-- Sales Summery -->
    <!-- ============================================================== -->
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('users',['type' => 'users']) }}">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ $total_users }}</h3>
                            <h6 class="card-subtitle">Total Users</h6>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <a href="{{ route('users',['type' => 'inst']) }}">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ $total_inst }}</h3>
                            <h6 class="card-subtitle">Total Instructors</h6>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <a href="{{ route('users',['type' => 'learner']) }}">
                    <div class="row">
                        <div class="col-12">
                        <h3>{{ $total_learners }}</h3>
                            <h6 class="card-subtitle">Total Learners</h6>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
    </div>
    <!-- ============================================================== -->
    <!-- place order / Exchange -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-4">
            <a href="javascript:void(0)">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-r-20 align-self-center">
                                <h1 class="text-white">
                                    ${{ number_format($TotalEarning)  }}
                                </h1>
                            </div>
                            <div>
                                <h4 class="card-title">Total Earning</h4>
                                <h6 class="text-white op-5">{{ \Carbon\Carbon::now()->format('F Y') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="javascript:void(0)">
                <div class="card bg-cyan text-white">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-r-20 align-self-center">
                                <h1 class="text-white">
                                    ${{ number_format($InstructorWithDraw) }}
                                </h1>
                            </div>
                            <div>
                                <h4 class="card-title" data-toggle="tooltip" data-title="instructors withdrawal amount">Withdrawal Amount</h4>
                                <h6 class="text-white op-5">{{ \Carbon\Carbon::now()->format('F Y') }}</h6>
                            </div>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="javascript:void(0)">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="m-r-20 align-self-center">
                                <h1 class="text-white">
                                    {!! $total_appt !!}
                                </h1>
                            </div>
                            <div>
                                <h4 class="card-title text-right">Total Bookings</h4>
                                <h6 class="text-white op-5">All lessons in system</h6>
                            </div>

                        </div>
                    </div>
                </div>
             </a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <h4 class="card-title">New Users</h4>
                        <div id="Instructor-chart"></div>
                    </div>
                </div>
            </div>
            <!--<div class="col-md-4">-->
            <!--    <div class="card">-->
            <!--        <div class="card-body">-->
            <!--            <div id="appt_chart"></div>-->
            <!--            <h4 class="card-title text-center">Appointments/Lessons</h4>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script>


    // Morris.Donut({
    //     element: 'appt_chart',
    //     data: [{
    //         label: "Completed",
    //         value: {{ $appt['completed'] }},

    //     }, {
    //         label: "Confirmed",
    //         value: {{ $appt['confirmed'] }},
    //     }, {
    //         label: "Unconfirmed",
    //         value: {{ $appt['unconfirmed'] }},
    //     }],
    //     resize: true,
    //     colors:['#2962FF', '#55ce63', '#2f3d4a']
    // });

    // high chart for Service Provider
    Highcharts.chart('Instructor-chart', {
        chart: {
            height: 250,
        },
        title: {
            text: 'Registered in Last 12 Months',
            align: 'center'
        },
        legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                month: '%b',
                year: '%Y'
            }
        },
        exporting: {
            enabled: false
        },
        credits: {
            enabled: false
        },
        series: [
            {
                data: {!! htmlspecialchars(json_encode($InstructorGraph), ENT_QUOTES, 'UTF-8') !!},
                name: 'Instructor',
                color: '#1B53B7',
                pointStart: Date.UTC({{date('Y')}}, 0),
                pointIntervalUnit: 'month'
            },
            {
                data: {!! htmlspecialchars(json_encode($LearnerGraph), ENT_QUOTES, 'UTF-8') !!},
                name: 'Learner',
                color: '#3ad010',
                pointStart: Date.UTC({{date('Y')}}, 0),
                pointIntervalUnit: 'month'
            }
        ],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 1000,
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>
@endsection
