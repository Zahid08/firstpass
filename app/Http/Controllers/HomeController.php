<?php



namespace App\Http\Controllers;



use App\AppointmentCompleted;

use App\Appointments;

use App\PaymentResponse;

use App\TestLocations;

use App\User;

use App\UserRatings;

use App\Wallet;

use App\Withdraw;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Search;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller

{

    public function index()

    {

        $user = auth()->user();

        if ($user->type == 'admin'){

            $total_users = User::where('type', '!=', 'admin')->count('id');

            $total_inst = User::where('type', 'inst')->count('id');

            $total_appt = Appointments::count();

            $total_learners = User::where('type', 'learner')->count('id');

            $TotalEarning = PaymentResponse::sum('converted_amount') - Withdraw::sum('withdraw_amount');

            $InstructorWithDraw = Withdraw::sum('withdraw_amount');

            $InstructorGraph = $this->InstructorStats();

            $LearnerGraph = $this->LearnerStats();

            $appt['completed'] = Appointments::where('status', 'completed')->count();

            $appt['confirmed'] = Appointments::where('status', 'confirmed')->count();

            $appt['unconfirmed'] = Appointments::where('status', 'unconfirmed')->count();

            return view('admin.home', compact('appt','total_appt','total_users', 'total_inst', 'total_learners', 'TotalEarning', 'InstructorWithDraw', 'InstructorGraph', 'LearnerGraph'));

        }elseif ($user->type == 'inst'){



            $appointments = DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.user_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.gender')

                ->where([['appointments.instructor_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'asc')

                ->get();
            foreach($appointments as $row){
                $get_type  = Search::select('t_type')->where('id',$row->search_id)->first();
                $row->t_type = $get_type->t_type;
            }


            $UpcomingAppointment =  DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.user_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type', 'users.gender')

                ->where([['appointments.instructor_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'asc')

                ->first();

            if (!empty($UpcomingAppointment)){
                $get_types  = Search::select('t_type')->where('id',$UpcomingAppointment->search_id)->first();
                if($get_types->t_type!=""){
                    $UpcomingAppointment->t_type = $get_types->t_type;
                } else{
                    $UpcomingAppointment->t_type = '';
                }
            }



            $UpcomingAppointments = DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.user_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type', 'users.gender')

                ->where([['appointments.instructor_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'asc')

                ->groupBy('appointments.instructor_id')

                ->get();
            foreach($UpcomingAppointments as $row){
                $get_type  = Search::select('t_type')->where('id',$row->search_id)->first();
                $row->t_type = $get_type->t_type;
            }


            $UpcomingAppointmentsId = [];



            for($i = 0; $i < count($UpcomingAppointments); $i++) {

                $UpcomingAppointmentsId[] = $UpcomingAppointments[$i]->instructor_id;

            }



            $BookingHistory = DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.user_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')

                ->where([['appointments.instructor_id', '=', $user->id],['appointments.schedule_date', '<', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'desc')

                ->get();

            foreach($BookingHistory as $row){
                $get_type  = Search::select('t_type')->where('id',$row->search_id)->first();
                $row->t_type = $get_type->t_type;
            }


            //print_r($appointments);exit();

            $TotalLearner = DB::table('appointments')

            ->where('instructor_id', $user->id)

            ->where('is_private', 0)

            ->distinct()

            ->count('user_id');

            $TotalLesson = Appointments::where('instructor_id', $user->id)->where('is_private', 0)->count();

            $TotalLessonCompleted = AppointmentCompleted::where('instructor_id', $user->id)->count();

            $report = \App\Search::leftJoin('payment_responses', 'search.id', '=', 'payment_responses.search_id')
                ->where('payment_responses.status', 'succeeded')
                ->where('search.instructor_id',$user->id)
                ->selectRaw('SUM(search.final_selected_price) as total_earn_price,SUM(search.final_selected_hour) as total_purchase, SUM(search.final_selected_test) as total_test , SUM(search.final_booking) as final_booking')
                ->first();

            $TotalAmount = Wallet::where('user_id', $user->id)->value('withdrawable');

            //  $TotalAmount = PaymentResponse::where('user_id', $user->id)->sum('converted_amount');
//            $TotalAmount=0;
//            $totalLearnerPurchase=0;
//            if ($report){
//                $TotalAmount= $report->total_earn_price;
//                $totalLearnerPurchase= $report->total_purchase;
//            }

            $GetCompletedAmount = AppointmentCompleted::where('instructor_id', $user->id)->sum('amount');

            $GetWithDrawAmount = Withdraw::where('instructor_id', $user->id)->sum('withdraw_amount');

            $GetCompletedAppointmentsAmount = $GetCompletedAmount - $GetWithDrawAmount;

            return view('instructor.home', compact('appointments', 'UpcomingAppointment','UpcomingAppointmentsId','BookingHistory', 'TotalAmount', 'GetCompletedAppointmentsAmount', 'TotalLesson', 'TotalLessonCompleted', 'GetCompletedAmount', 'TotalLearner'));

        }elseif ($user->type == 'learner'){



            $appointments = DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.instructor_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.gender')

                ->where([['appointments.user_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'asc')

                ->get();
            foreach($appointments as $row){
               $get_type  = Search::select('t_type')->where('id',$row->search_id)->first();
               $row->t_type = $get_type->t_type;
           }


            $UpcomingAppointment =  DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.instructor_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type', 'users.gender')

                ->where([['appointments.user_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'asc')

                ->first();

            if (!empty($UpcomingAppointment)){
                $get_types  = Search::select('t_type')->where('id',$UpcomingAppointment->search_id)->first();
                if($get_types->t_type!=""){
                    $UpcomingAppointment->t_type = $get_types->t_type;
                } else{
                    $UpcomingAppointment->t_type = '';
                }
            }



            $UpcomingAppointments = DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.instructor_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type', 'users.gender')

                ->where([['appointments.user_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'asc')

                ->groupBy('appointments.instructor_id')

                ->get();
            foreach($UpcomingAppointments as $row){
               $get_type  = Search::select('t_type')->where('id',$row->search_id)->first();
               $row->t_type = $get_type->t_type;
           }


            $UpcomingAppointmentsId = [];



            for($i = 0; $i < count($UpcomingAppointments); $i++) {

                $UpcomingAppointmentsId[] = $UpcomingAppointments[$i]->instructor_id;

            }



            $BookingHistory = DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.instructor_id')

                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')

                ->where([['appointments.user_id', '=', $user->id],['appointments.schedule_date', '<', Carbon::now()]])

                ->where('appointments.is_private', 0)

                ->where('appointments.schedule_date', '!=', '')

                ->orderBy('appointments.schedule_date', 'desc')

                ->get();

            foreach($BookingHistory as $row){
               $get_type  = Search::select('t_type')->where('id',$row->search_id)->first();
               $row->t_type = $get_type->t_type;
           }

            $instructors = DB::table('appointments')

                ->join('users', 'users.id', '=', 'appointments.instructor_id')

                ->select('users.name', 'users.lname', 'users.id','users.email', 'users.phone', 'users.avatar', 'users.gender', 'appointments.instructor_id','appointments.status' )

                ->where('appointments.user_id', Auth::user()->id)

                ->where('appointments.is_private', 0)

                ->groupBy('users.id')

                ->get();

                $search_check = Search::join('appointments', 'appointments.search_id', 'search.id')

            ->where(['search.learner_id' => Auth::id()])

            ->where('search.region_id', '!=', '')

            ->orderBy('appointments.id', 'desc')

            ->first();

            if (Session::get('prev_url')){
                return redirect(Session::get('prev_url'));
            }
            return view('learner.home', compact('instructors','appointments', 'UpcomingAppointment', 'UpcomingAppointmentsId', 'search_check', 'BookingHistory'));

        }

    }



    public function instructorRequest()

    {

        return view('instructor.registered');

    }



    function InstructorStats()

    {

        $year = date('Y');

        // $data = 26;

        $data=array();

        for($i=1; $i<13; $i++){



            $stats = DB::table('users');

            $stats = $stats->select

            (DB::raw('count(id) as `total`'),

                DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),

                DB::raw('YEAR(created_at) year, MONTH(created_at) month'));

            $stats = $stats->whereYear('created_at', $year);

            $stats = $stats->whereMonth('created_at', $i);

            $stats = $stats->where('type', 'inst');

            $stats = $stats->groupby('year', 'month');

            $stats = $stats->get();

            if(count($stats)>0){

                $data[] = (int)$stats[0]->total;

            }else{

                $data[] = 0;

            }

        }



        return $data;

    }



    function LearnerStats()

    {

        $year = date('Y');

        // $data = 26;

        $data=array();

        for($i=1; $i<13; $i++){



            $stats = DB::table('users');

            $stats = $stats->select

            (DB::raw('count(id) as `total`'),

                DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),

                DB::raw('YEAR(created_at) year, MONTH(created_at) month'));

            $stats = $stats->whereYear('created_at', $year);

            $stats = $stats->whereMonth('created_at', $i);

            $stats = $stats->where('type', 'learner');

            $stats = $stats->groupby('year', 'month');

            $stats = $stats->get();

            if(count($stats)>0){

                $data[] = (int)$stats[0]->total;

            }else{

                $data[] = 0;

            }

        }



        return $data;

    }



    function get_review_pages(Request $request){

        if($request->ajax())

        {

            $rating = UserRatings::join('users', 'users.id', 'user_rating.by_user')

                ->select('user_rating.score', 'user_rating.review', 'users.name', 'users.lname')

                ->where('user_rating.user_id', $request->intructor)

                ->paginate(2);

            return view('search.review_pagination', compact('rating'))->render();

        }else{



        }

    }



}

