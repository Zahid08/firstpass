@extends('layouts.app')

@section('content')
    <?php
    $report = \App\Search::leftJoin('payment_responses', 'search.id', '=', 'payment_responses.search_id')
        ->where('payment_responses.status', 'succeeded')
        ->where('payment_responses.user_id',auth()->user()->id)
        ->selectRaw('SUM(search.final_selected_price) as total_earn_price,SUM(search.final_selected_hour) as total_purchase, SUM(search.final_selected_test) as total_test , SUM(search.final_booking) as final_booking')
        ->first();

    $useCredit =\App\Appointments::leftJoin('search', 'search.id', '=', 'appointments.search_id')
        ->where('appointments.schedule_date', '!=', '')
        ->where('search.use_credit', 1)->where('search.learner_id',auth()->user()->id)->count();

    ?>
    <style>
        .stat-heading {
            font-weight: 500;
            color: #1F2A37;
            line-height: 1.3;
            font-size: 16px;
        }
        .stat-body {
            font-weight: 700;
            text-align: center;
        }
    </style>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="tab-pane fade active show" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <div style="display: flex;justify-content: space-between;">
                                    <h4>Purchase & Booking Summary</h4>
                                    <a class="btn btn-success tiny small-width-100px" href="{{ route('buy_more_credit') }}" style="border-radius: 5px;">Buy More</a>
                                </div>

                                <div style="display: flex;justify-content: space-around;margin-top: 34px;">
                                    <div class="small-6 columns">
                                        <div class="stat-heading">Total Lesson hours</div>
                                        <div class="stat-body">{{$report->total_purchase-$useCredit}}</div>
                                    </div>

                                    <div class="small-6 columns">
                                        <div class="stat-heading">Test Packages</div>
                                        <div class="stat-body">
                                            {{$report->total_test}}
                                        </div>
                                    </div>

                                    <div class="small-6 columns">
                                        <div class="stat-heading">Total Paid</div>
                                        <div class="stat-body">
                                            ${{$report->total_earn_price}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
        </div>
    </div>
@endsection
