<?php

namespace App\Http\Controllers;

use Afterpay\SDK\HTTP\Request\DeferredPaymentAuth;
use Afterpay\SDK\MerchantAccount;
use Afterpay\SDK\Model\Consumer;
use Afterpay\SDK\Model\Money;
use App\Appointments;

use App\CarMake;

use App\CarModel;

use App\YearModel;
use Afterpay\SDK\HTTP\Request\ImmediatePaymentCapture as AfterpayImmediatePaymentCaptureRequest;

use App\ContactForm;

use App\EmailSettings;

use App\PaymentResponse;

use App\PostalCode;

use App\Region;

use App\RegionBK;

use App\Search;

use App\ServiceRegions;

use App\Settings;

use App\State;

use App\TestLocations;

use App\TestPackage;

use App\User;

use App\UserMeta;

use App\UserTestLocations;

use App\Wallet;

use App\WorkingTime;

use App\InstructorDocs;

use Carbon\Carbon;

use Carbon\CarbonPeriod;

use DateTime;

use Faker\Provider\ar_SA\Payment;

use Afterpay\SDK\HTTP\Request\GetConfiguration as AfterpayGetConfigurationRequest;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Traits\AppTraits;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use stdClass;

use Afterpay\SDK\HTTP\Request\CreateCheckout as AfterpayCreateCheckoutRequest;
use Afterpay\SDK\HTTP\Request\DeferredPaymentAuth as AfterpayDeferredPaymentAuthRequest;

class GuestController extends Controller

{

    private $apiContext;
    private $apiUrl;
    private $merchantId;
    private $secretKey;


    public function __construct ()
    {
        $paypalConfig = config ( 'services.paypal' );

        $this->apiContext = new ApiContext( new OAuthTokenCredential(
            'AVe1vMjBEv2Y_mFNoqC9KFW5qN-FGrl6ovLVSzLJFyc9QNHPSSDWyVYMeXFVbu2yFFWegyryggkbaw9A',
            'EDuW19bWWnjo3jQk2O0rucMWR2aFjWR9aGRObKLiRQhl0IgDLVgzyTM0-QofaO9qLZDlEduk3FAl4RNJ'
        ) );

        $this->apiContext->setConfig ( [
            'mode' =>'sandbox',
        ] );

        $this->merchantId = '44689';
        $this->secretKey = '7f45a3c8ced3d53fbdcb136a4fe834475d19332952bddeba63fcd9c610f2b52cff991d2f68392e54fc4cd4c2f6482fb9011d912ba42ce3f119935d4c36832c44';

    }

    function get_model(Request $request){

        die();

        $reg_code = TestLocations::where('region', '!=', '')->groupBy('region')->pluck('region')->toArray();

        // Region::whereNotIn('id', $reg_code)->orderBy('id', 'desc')->random()->chunk(10, function ($region) {

        $region = Region::whereNotIn('id', $reg_code)->where('reg_id', '')->limit(30)->inRandomOrder()->get();

        foreach ($region as $item) {

            $id = str_replace( ' NSW', ',', $item->title );

            $id = urlencode($id);

            $url = "https://www.ezlicence.com.au/get_test_locations?region=$id&search_type=test_package&transmission=Auto";



            $res = Http::get($url);

            $res = $res->object();

            //echo '<pre>';

            if(isset($res->result)){

                //print_r($res->result);

                foreach ($res->result as $v){



                    TestLocations::updateOrCreate([

                        'region' => $item->id,

                        'title'  => $v[0],

                    ],[

                        'region' => $item->id,

                        'title'  => $v[0],

                        'code'  => $v[1]

                    ]);

                }

                $item->update([

                    'reg_id' => $id

                ]);

            }

        }

        //});

        exit;

        die();

        ini_set('max_execution_time', '0');

        Region::where('data', null)->orderBy('id', 'desc')->chunk(5, function ($region) {

            foreach ($region as $item) {

                $url = "https://www.ezlicence.com.au/map-suburb?polygon_id=$item->ez_id";

                $res = Http::get($url);

                $res = $res->body();

                Region::where('ez_id', $item->ez_id)->update(["data" => $res]);

            }

        });



        exit;

        ini_set('max_execution_time', '0');

        //get test locations

        $region = PostalCode::where('status', 0)->groupBy('postcode')->limit(10)->get();

            foreach ($region as $item) {

             echo   $url = "https://www.ezlicence.com.au/admin/suburb_mappings/get_suburb_polygon_options?search=$item->postcode&instructor_user_id=846";

                $res = Http::get($url);

                $res = $res->object();



                if(isset($res->result)){

                    foreach ($res->result as $v){



                        if(!Region::where('ez_id', $v->id)->exists()){

                            Region::create([

                                'title' => $v->text,

                                'ez_id' => $v->id,

                                'code' => $item->code

                            ]);

                        }

                    }

                }

                PostalCode::where('postcode', $item->postcode)->update(['status' => 1]);

            }

        exit;

        $reg_code = TestLocations::where('region', '!=', '')->groupBy('region')->pluck('region')->toArray();

       // Region::whereNotIn('id', $reg_code)->orderBy('id', 'desc')->random()->chunk(10, function ($region) {

        $region = Region::whereNotIn('id', $reg_code)->limit(100)->inRandomOrder()->get();

            foreach ($region as $item) {

                $id = urlencode($item->reg_id);

                $url = "https://www.ezlicence.com.au/get_test_locations?region=$id&search_type=test_package&transmission=Auto";

                $res = Http::get($url);

                $res = $res->object();

                //echo '<pre>';

                if(isset($res->result)){

                     //print_r($res->result);

                    foreach ($res->result as $v){



                        TestLocations::updateOrCreate([

                            'region' => $item->id,

                            'title'  => $v[0],

                        ],[

                            'region' => $item->id,

                            'title'  => $v[0],

                            'code'  => $v[1]

                        ]);

                    }

                }

            }

        //});

        exit;



        ini_set('max_execution_time', '0');

        echo '<pre>';



        $reg_code = Region::where('code', '!=', '')->groupBy('code')->pluck('code')->toArray();



        RegionBK::groupBy('code')->whereNotIn('code', $reg_code)->orderBy('id', 'desc')->chunk(10, function ($region) {

            foreach ($region as $item) {



                $url = "https://www.ezlicence.com.au/admin/suburb_mappings/get_suburb_polygon_options?search=$item->code&instructor_user_id=846";

                $res = Http::get($url);

                $res = $res->object();



                if(isset($res->result)){

                   // print_r($res->result);

                    foreach ($res->result as $v){

                        $regg = Region::where('ez_id', $v->id)->first();

                        if(!$regg){

                            Region::create([

                                'title' => $v->text,

                                'ez_id' => $v->id,

                                'code' => $item->code

                            ]);

                        }

                    }

                }

            }

        });



        exit;



        dd('functionality not defined');



        $context = stream_context_create(array(

            'http' => array('ignore_errors' => true),

        ));



        $region = Region::where('data', NULL)->get();



        foreach ($region as $item){



            $url = "https://www.ezlicence.com.au/map-suburb?polygon_id=$item->code";

            $data = file_get_contents($url, false, $context);

            Region::where('id', $item->id)->update(["data" => $data]);



        }



        exit;

        /*get region*/



        $datas = [ "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];



         rsort($datas);



        foreach ($datas as $data){

            $query = "https://www.ezlicence.com.au/get_available_suburbs?search=$data";

            $res = file_get_contents($query);

            $res = json_decode($res);



            foreach ($res->result as $r){

                $id = explode(',', $r->id);



                if(isset($id[0]) && isset($id[1])){



                    if( !Region::where('code', $id[1])->exists() ){

                        Region::create(["title" => $r->text, "code" => $id[1]]);

                    }

                }

            }

        }









        exit;

        $makes = [

            "Abarth", "AC", "Alfa Romeo", "Allard", "Alpina", "Alpine", "Alpine-Renault", "Alvis", "AM General", "Ariel", "Armstrong Siddeley", "Asia Motors", "Aston Martin", "Auburn", "Audi", "Austin", "Austin Healey", "Bedford", "Bentley", "Berkeley", "Bertone", "BMW", "Bolwell", "Bond", "Bristol", "Bufori", "Buick", "Bullet", "Cadillac", "Caterham", "Chery", "Chevrolet", "Chrysler", "Citroen", "Clenet", "Commer", "CSV", "Custom", "Daewoo", "Daihatsu", "Daimler", "Datsun", "DeLorean", "DeSoto", "De Tomaso", "DKW", "Dodge", "Durant", "Elfin", "Eunos", "Ferrari", "Fiat", "Ford", "Ford Performance Vehicles", "Foton", "FSM", "Fulda", "Fuso", "Galloway", "Geely", "Genesis", "GMC", "Goggomobil", "Goliath", "Graham", "Graham-Paige", "Great Wall", "Haval", "HDT", "Higer", "Hillman", "Hino", "Holden", "Holden Special Vehicles", "Honda", "Hudson", "Humber", "Hummer", "Hupmobile", "Hyundai", "Infiniti", "INFINITI", "International", "ISO", "Isuzu", "Iveco", "JAC", "Jaguar", "JBA", "Jeep", "Jensen", "JMC", "Kia", "Koenigsegg", "KTM", "Lada", "Lamborghini", "Lancia", "Land Rover", "LDV", "Lexus", "Leyland", "Lincoln", "London Taxi Company", "Lotus", "Mack", "Mahindra", "Marathon", "Marcos", "Maserati", "Matra", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mercury", "MG", "MINI", "Mitsubishi", "Morgan", "Morris", "Moskvich", "Napier", "Nash", "Nissan", "NSU", "Oldsmobile", "Opel", "Packard", "Panther", "Peugeot", "Plymouth", "Pontiac",

            "Porsche", "Prince", "Proton", "Purvis", "RAM", "Rambler", "Reliant", "Renault", "REO", "Riley", "Robnell", "Rolls-Royce", "Rover", "Saab", "Seat", "Singer", "SKODA", "smart", "SS", "SsangYong", "Standard", "Steyr-Puch", "Studebaker", "Stutz", "Subaru", "Sunbeam", "Suzuki", "Talbot", "Tata", "TD 2000", "Tesla", "Toyota",

            "TRD", "Triumph", "TVR", "U.D.", "Ultima", "Vanden Plas", "Vauxhall", "Volkswagen", "Volvo",     "Westfield", "Willys", "Wolseley", "Yutong", "ZX Auto"

        ];



        try {

            foreach ($makes as $make) {

                $data = file_get_contents('https://www.ezlicence.com.au/instructor/car_model_query?car_make=' . urlencode($make));

                $result = json_decode($data);

                if (is_object($result)) {

                    $mk = new CarMake();

                    echo $mk->title = $make;

                    if ($mk->save()) {

                        echo $make_id = $mk->id;

                        foreach ($result->result as $res) {

                            $car_model = new CarModel();

                            $car_model->make_id = $make_id;

                            $car_model->title = $res;

                            $car_model->save();

                        }

                    }

                }

            }

        }catch (\Exception $e){

            echo $e->getMessage(). $e->getLine();

        }

    }

    function index($search_id=false){

        $search = $region= false;
        if($search_id!=false){
            $search = Search::whereId($search_id)->first();
            if(!$search){
                $search_id = false;
            }else{

                $region = Region::whereId($search->region_id)->first();
            }

        }
        return view('frontend/home/index', compact('region','search_id', 'search'));
    }

    function driving_lesson(Request $request){
        return view('frontend/driving_lessons/index');
    }

    function get_test_t_location(Request $request)
    {

        $region_id=$request->id;
        $location_datas=TestLocations::all();
        $any_location = '';
        $is_result = false;
        if( count($location_datas)>0 ){
            $any_location = '<option value="any">Any Test Location</option>';
            $is_result = true;
        }

        $html="<div class='form-group'><select style='width: 100%;' class='select2 select-area' name='test_location' id='test_location' required>$any_location";

        foreach ($location_datas as $location_data) {

            $html.="<option value='$location_data->id'>$location_data->title</option>";

        }

        $html.="</select></div>";

        if($is_result) {

            echo $html;

        }else{

            echo '<p style="margin-top: 5px">No Result Found</p>';

        }

        return "";



    }

    function get_test_location(Request $request)

    {

        $region_id=$request->id;

        $location_datas=TestLocations::all();



        $any_location = '';

        $is_result = false;

        if( count($location_datas)>0 ){

            $any_location = '<option value="any">Any Test Location</option>';

            $is_result = true;

        }



        $html="<div class='form-group'><select class='select2' name='test_location' id='test_location' required>$any_location";

        foreach ($location_datas as $location_data) {

            $html.="<option value='$location_data->id'>$location_data->title</option>";

        }

        $html.="</select></div>";

        if($is_result) {

            echo $html;

        }else{

            echo '<p style="margin-top: 5px">No Result Found</p>';

        }

        return "";



    }

    function contact(Request $request){

        return view('frontend.contact.index');

    }

    function faqs(Request $request){

        return view('faqs');

    }

    function terms(Request $request){

        return view('terms');

    }

    function privacy(Request $request){

        return view('privacy');

    }

    function test_package(Request $request){

        $TestPackageDetail  =   TestPackage::first();

        return view('frontend/driving_lessons/test_packages', compact('TestPackageDetail'));

    }



    function save_contact_form(Request $request){

        $f_name            =   $request->f_name;

        $l_phone           =   $request->l_phone;

        $email             =   $request->email;

        $mobile_number     =   $request->mobile_number;

        $postcode          =   $request->postcode;

        $subject           =   $request->subject;

        $message           =   $request->message;

        $user_type         =   $request->user_type;



        $ContactForm                    =   new ContactForm();

        $ContactForm->f_name            =   $f_name;

        $ContactForm->l_phone           =   $l_phone;

        $ContactForm->email             =   $email;

        $ContactForm->mobile_number     =   $mobile_number;

        $ContactForm->postcode          =   $postcode;

        $ContactForm->subject           =   $subject;

        $ContactForm->message           =   $message;

        $ContactForm->user_type         =   $user_type;

        if($ContactForm->save()){

            return redirect('/contact')->with('success', 'Thanks for contact with us');

           // $mail   =   mail($email, $subject, $message);

//            if($mail){
//
//                return response()->json(['success' => true, 'message' => 'Mail sent successfully. Our team will contact you quickly as possible.']);
//
//            }else{
//
//                return response()->json(['success' => false, 'message' => 'Form Data saved successfully but mail mail not sent successfully.']);
//
//            }

        }else{

            return response()->json(['success' => false, 'message' => 'Something Went Wrong !!']);

        }

    }



    function autocomplete_regions_ajax(Request $request){

        $data = [];

        if($request->has('q')){

            $search = $request->q;

            $data =Region::select("id","title")

                ->where('title','LIKE',"%$search%")

                ->get();

        }

        return response()->json($data);

    }



    function autocomplete_test_locations_ajax(Request $request){

        $data = [];

        if($request->has('q')){

            $search = $request->q;

            $data =TestLocations::select("id","title")

                ->where('title','LIKE',"%$search%")

                ->get();

        }

        return response()->json($data);

    }



    function search(Request $request){

        $useCredit=0;
        if($request->search_type == 1){

            $ip = $request->getClientIp();

            $t_type = $request->type;

            $region = Region::select('title', 'id')->whereId($request->region)->first();

            if($region) {

                if($request->has('test_location') && $request->test_type == 1){

                    if($_REQUEST['test_location'] == 'any') {
                        $available_users_r = UserTestLocations::pluck('user_id');
                    }else{
                        $available_users_r = UserTestLocations::where('location_id', $_REQUEST['test_location'])->pluck('user_id');
                    }

                }else{

                    $available_users_r = ServiceRegions::where('region_id', $request->region)->pluck('user_id');

                }

                if ($available_users_r->isEmpty()) {
                    $available_users_r=[];
                }

                $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')

                    ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar', 'users.preferred_name', 'users.phone', 'users.gender')

                    ->whereIn('users.id', $available_users_r)

                    ->whereIn("user_meta.transmission_type",['both',$t_type])

                    ->where(['users.type' => 'inst', 'users.status' => 1]);


                if($request->has('test_type')){

                    $users = $users->where('user_meta.services_accreditation', 'like', '%"'.$request->test_type.'"%');

                }


                $users = $users->get();

                $total = $users->count();

                /*save search*/

                $search =  Search::create(

                    ['ip' => $ip, 't_type' => $t_type, 'region_id' => $request->region]

                );

                $search_id = $search->id;

                $view = view('search.search', compact('users', 'search_id'))->render();

                return response()->json(['success' => true, 'view' => $view, 'total' => $total, 'title' => $region->title, 'search_id' => $search_id, 't_type' => $t_type]);

            }else{

                return response()->json(['success' => false, 'message' => 'Result not found!']);

            }

        }elseif ($request->search_type == 2){

            /*course selection*/

            /*save search*/

            $search_data = json_encode($request->lesson);

            $search =  Search::where('id', $request->search_id)->update(

                ['step_2' => $search_data, 'instructor_id' => $request->instructor_id]

            );

            if($search){

                return response()->json(['success' => true]);

            }

        }elseif ($request->search_type == 3){

            $search_data =
                [
                    "total" => $request->total,
                    'discount' => $request->dis,
                    'hour' => $request->hr,
                    'hourly_rate' => $request->hourly_rate,
                    'test_price'  => $request->test_price
                ];

            $step2_data=[];

            if( $request->has('d_test') && $request->d_test =="on" ){

                array_push($step2_data, "test");

            }

            if( $request->has('d_lesson') && $request->d_lesson =="on" ){
                array_push($step2_data, "lesson");
            }

            $hourly_rate='';
            if (isset($_REQUEST['d_lesson']) && $_REQUEST['d_lesson']=='on'){
                $hourly_rate=$_REQUEST['hr'];
            }

            $addTest=0;
            if (isset($_REQUEST['d_test']) && $_REQUEST['d_test']=='on'){
                $addTest=1;
            }

            $search =  Search::where('id', $request->search_id)->update(
                [
                    'start_lesson' => $hourly_rate,
                    'start_package' => $addTest,
                    'step_3' => $search_data,
                    'step_2' => $step2_data,
                    'instructor_id' => $request->instructor_id
                ]
            );

            if($search){

                return response()->json(['success' => true]);

            }

        }elseif ($request->search_type == 4){

            $search = Search::where('id', $request->search_id)->first();

            /*save search*/

            $data = [

                'lesson_hour' => $request->final_hour,

                'lesson_schedule_date' => $request->final_date,

                'lesson_time_slot' => $request->final_time,

                'test_schedule_date' => $request->final_date_test,

                'test_time_slot' => $request->final_time_test,

                'test_location' => $request->test_location_id

            ];

            if($search->step_2 && $search->step_3) {

                $bookinTotal=0;
                if (isset($_REQUEST['final_hour'])) {
                    $explodeData = explode(',', $_REQUEST['final_hour']);

                    // Filter out non-numeric values and remove spaces
                    $numericValues = array_filter($explodeData, 'is_numeric');
                    $numericValues += array_map('trim', $numericValues);

                    $bookinTotal = array_sum($numericValues);
                }

                $search->update(
                    ['step_4' =>json_encode($data),'final_booking'=>$bookinTotal]
                );

                if ($search->redirect_track==1){
                    $useCredit=1;
                    $this->creditPaid($search);
                }

            } else {

                $step_2 = ['lesson','new'];

                $hour = $request->total;

                $hourly_rate = Region::where('status', 1)->first()->price;

                // $total = $hour * $hourly_rate + TestPackage::where('status', 1)->first()->price;

                $total = $hour * $hourly_rate;

                if($request->final_date_test != 'undefined') {

                   $total += TestPackage::where('status', 1)->first()->price;

                   $step_2[] = 'test';

                }

                $step_3 = [

                    'total' => $total,

                    'hour' => $hour,

                    'hourly_rate' => $hourly_rate,

                    'discount'=> 0,

                    'test_price' => null

                ];

                $bookinTotal=0;
                if (isset($_REQUEST['final_hour'])) {
                    $explodeData = explode(',', $_REQUEST['final_hour']);

                    // Filter out non-numeric values and remove spaces
                    $numericValues = array_filter($explodeData, 'is_numeric');
                    $numericValues += array_map('trim', $numericValues);

                    $bookinTotal = array_sum($numericValues);
                }

                $search->update(

                    ['final_booking'=>$bookinTotal,'learner_id' => auth()->user()->id , 'step_2' => $step_2, 'step_3' => $step_3, 'step_4' => json_encode($data), ]

                );

                if ($search->redirect_track==1){
                    $useCredit=1;
                    $this->creditPaid($search);
                }
            }



            if($search && $useCredit==0){
                return response()->json(['success' => true,'locate'=>'register']);
            }else{
                return response()->json(['success' => true,'locate'=>'home']);
            }

        }

    }

  public function creditPaid($search){


      /*--------Update Changes Record---------*/

      //  try{

      $learner = auth()->user();
      $user_id = $learner->id;
      $status = false;
      $appointmetObj='';

      $searchLearnderAddress = Search::where('learner_id',$user_id)->first();

      /*save search*/
      Search::where('id', $search->id)->update(
          ['step_5' => $searchLearnderAddress->step_5]
      );

      $step_3 = $search->step_3;
      $step_3 = json_decode($step_3);
      $amount = @$step_3->total;
      $step_5 = $search->step_5;
      $step_5 = json_decode($step_5);
      $step_2 = $search->step_2;
      $step_2 = json_decode($step_2);
      $sch = $search->step_4;
      $sch = json_decode($sch);

      $test_schedule_date = $test_time_slot = $test_location="";
      //Common COde Structure
      $hourly_rate = Region::whereId($search->region_id)->value('price');
      $schedule_date = $time_slot='';
      $lesson_hour = 1;

      if (isset($sch->lesson_hour)) {
          $lesson_hour = $sch->lesson_hour;
          $lesson_hour = explode(',', $lesson_hour);
      }

      if (isset($sch->lesson_schedule_date))
      {
          $schedule_date = $sch->lesson_schedule_date;
          $schedule_date = explode(',', $schedule_date);
      }

      if (isset($sch->lesson_time_slot))

      {
          $time_slot = $sch->lesson_time_slot;
          $time_slot = explode(',', $time_slot);
      }



      if(isset($sch->test_schedule_date))
      {
          $test_schedule_date = $sch->test_schedule_date;
      }

      if(isset($sch->test_time_slot))
      {
          $test_time_slot = $sch->test_time_slot;
      }

      if(isset($sch->test_location))
      {
          $test_location = $sch->test_location;
      }

      $app_ids=[];

      if (is_numeric($amount)) {
          foreach ( $step_2 as $package ) {
              if ( $package == 'test' && $test_schedule_date && $test_schedule_date != 'undefined' ) {

                  Search::where('id', $search->id)->update(
                      ['use_credit' => 1]
                  );

                  //===== to ready start & end date

                  $sdArray = explode ( '-', $test_schedule_date );

                  $newSD = $sdArray[ 2 ] . '-' . $sdArray[ 1 ] . '-' . $sdArray[ 0 ];

                  $timeslotArray = explode ( '-', $test_time_slot );


                  $timeStart = $timeslotArray[ 0 ];

                  $timeStartArray = explode ( ' ', $timeStart );

                  $timeStartRight = $timeStartArray[ 1 ];

                  if ( $timeStartRight == 'am' ) {
                      $finalStart = $timeStartArray[ 0 ];
                  } else {

                      $timeStartLeftArray = explode ( ':', $timeStartArray[ 0 ] );

                      if ( intval ( $timeStartLeftArray[ 0 ] ) == 12 ) {

                          $finalStart = $timeStartArray[ 0 ];

                      } else {

                          $lft = intval ( $timeStartLeftArray[ 0 ] ) + 12;

                          $finalStart = $lft . ':' . $timeStartLeftArray[ 1 ];

                      }

                  }


                  $timeEnd = $timeslotArray[ 1 ];

                  $timeEndArray = explode ( ' ', $timeEnd );

                  $timeEndRight = $timeEndArray[ 1 ];

                  if ( $timeEndRight == 'am' ) {
                      $finalEnd = $timeEndArray[ 0 ];
                  } else {

                      $timeEndLeftArray = explode ( ':', $timeEndArray[ 0 ] );

                      if ( intval ( $timeEndLeftArray[ 0 ] ) == 12 ) {
                          $finalEnd = $timeEndArray[ 0 ];
                      } else {
                          $lft = intval ( $timeEndLeftArray[ 0 ] ) + 12;

                          $finalEnd = $lft . ':' . $timeEndLeftArray[ 1 ];
                      }
                  }

                  $final_start_date = $newSD . " " . $finalStart;

                  $final_end_date = $newSD . " " . $finalEnd;

                  //=========================================================

                  if (isset($_REQUEST['type']) && $_REQUEST['type']=='wallet'){

                  }else{
                      $appointmetObj = new Appointments();

                      $appointmetObj->user_id = \auth()->user()->id;

                      $appointmetObj->schedule_date = $test_schedule_date;

                      $appointmetObj->time_slot = $test_time_slot;

                      $appointmetObj->status = "confirmed";

                      $appointmetObj->instructor_id = $search->instructor_id;

                      $appointmetObj->payment_status =1;

                      $appointmetObj->search_id = $search->id;

                      $appointmetObj->type = 'test';

                      $appointmetObj->start_date = $final_start_date;

                      $appointmetObj->end_date = $final_end_date;

                      $appointmetObj->is_private = 0;
                      
                       $appointmetObj->lesson_hour =1;

                      $appointmetObj->amount = $step_3->test_price;

                      // if(isset($sch->test_location) && $sch->test_location!='' && is_numeric($sch->test_location) ){

                      //     $appointmetObj->test_location = $sch->test_location;

                      // }

                      //$appointmetObj->test_location = $test_location;
                      $appointmetObj->address =$searchLearnderAddress->step_5;


                      /*print_r($appointmetObj);

                      exit;*/

                      if ( $appointmetObj->save () ) {

                          $app_ids[] = $appointmetObj->id;

                      }
                  }

              } elseif ( $package == 'lesson' ) {

                  $hour = $step_3->hour; // total booking hours

                  if ( isset( $step_3->hourly_rate ) ) {

                      $hourly_rate = @$step_3->hourly_rate;

                  }


                  $total_les_hr = 0;

                  if ( is_array ( $lesson_hour ) ) {

                      foreach ( $lesson_hour as $lsn_hr ) {

                          $total_les_hr = $total_les_hr + $lsn_hr;

                      }

                  }


                  $rest_hr = $hour - $total_les_hr;


                  if ( $rest_hr > 0 ) {

                      $price = $hourly_rate * $rest_hr;

                      if (isset($_REQUEST['type']) && $_REQUEST['type']=='wallet'){

                      }else{
                          $appointmetObj = new Appointments();

                          $appointmetObj->user_id = \auth()->user()->id;

                          $appointmetObj->status = "confirmed";

                          $appointmetObj->instructor_id = $search->instructor_id;

                          $appointmetObj->payment_status =1;

                          $appointmetObj->is_private = 0;

                          $appointmetObj->search_id = $search->id;

                          $appointmetObj->type = 'lesson';

                          $appointmetObj->hourly_rate = $hourly_rate;

                          $appointmetObj->lesson_hour = $rest_hr;

                          $appointmetObj->address =$searchLearnderAddress->step_5;

                          $appointmetObj->amount = $price;

                          if ( $appointmetObj->save () ) {

                              $app_ids[] = $appointmetObj->id;

                          }
                      }
                  }


                  //print_r($schedule_date);


                  if ( !empty( $schedule_date ) ) {

                      Search::where('id', $search->id)->update(
                          ['use_credit' => 1]
                      );

                      foreach ( $schedule_date as $key => $sd ) {


                          //===== to ready start & end date

                          $sdArray = explode ( '-', $sd );

                          $newSD = $sdArray[ 2 ] . '-' . $sdArray[ 1 ] . '-' . $sdArray[ 0 ];

                          $timeslotArray = explode ( '-', $time_slot[ $key ] );


                          $timeStart = $timeslotArray[ 0 ];

                          $timeStartArray = explode ( ' ', $timeStart );

                          $timeStartRight = $timeStartArray[ 1 ];

                          if ( $timeStartRight == 'am' ) {
                              $finalStart = $timeStartArray[ 0 ];
                          } else {

                              $timeStartLeftArray = explode ( ':', $timeStartArray[ 0 ] );

                              if ( intval ( $timeStartLeftArray[ 0 ] ) == 12 ) {

                                  $finalStart = $timeStartArray[ 0 ];

                              } else {

                                  $lft = intval ( $timeStartLeftArray[ 0 ] ) + 12;

                                  $finalStart = $lft . ':' . $timeStartLeftArray[ 1 ];

                              }

                          }


                          $timeEnd = $timeslotArray[ 1 ];

                          $timeEndArray = explode ( ' ', $timeEnd );

                          $timeEndRight = $timeEndArray[ 1 ];

                          if ( $timeEndRight == 'am' ) {
                              $finalEnd = $timeEndArray[ 0 ];
                          } else {

                              $timeEndLeftArray = explode ( ':', $timeEndArray[ 0 ] );

                              if ( intval ( $timeEndLeftArray[ 0 ] ) == 12 ) {

                                  $finalEnd = $timeEndArray[ 0 ];

                              } else {

                                  $lft = intval ( $timeEndLeftArray[ 0 ] ) + 12;

                                  $finalEnd = $lft . ':' . $timeEndLeftArray[ 1 ];

                              }

                          }


                          $final_start_date = $newSD . " " . $finalStart;

                          $final_end_date = $newSD . " " . $finalEnd;

                          //=========================================================


                          $price = $hourly_rate * $lesson_hour[ $key ];

                          if (isset($_REQUEST['type']) && $_REQUEST['type']=='wallet'){

                          }else{
                              $appointmetObj = new Appointments();

                              $appointmetObj->user_id =\auth()->user()->id;

                              $appointmetObj->schedule_date = $sd;

                              $appointmetObj->time_slot = $time_slot[ $key ];

                              $appointmetObj->status = "confirmed";

                              $appointmetObj->instructor_id = $search->instructor_id;

                              $appointmetObj->payment_status =1;

                              $appointmetObj->is_private = 0;

                              $appointmetObj->search_id = $search->id;

                              $appointmetObj->type = 'lesson';

                              $appointmetObj->hourly_rate = $hourly_rate;

                              $appointmetObj->lesson_hour = $lesson_hour[ $key ];

                              $appointmetObj->start_date = $final_start_date;

                              $appointmetObj->end_date = $final_end_date;

                              $appointmetObj->address =$searchLearnderAddress->step_5;

                              $appointmetObj->amount = $price;

                              if ( $appointmetObj->save () ) {

                                  $app_ids[] = $appointmetObj->id;

                              }
                          }
                      }

                  }

              }

          }

          return 1;
      }

    }



    function instructor_profile($search_id, $instructor_id){



        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();

        if(!$instructor){

            return back()->with('error', 'Please make a new search');

        }

        $search = Search::find($search_id);

        if(!$search){

            return back()->with('error', 'Please make a new search');

        }

        if($this->check_search_status($search_id)){

            return redirect('/')->with('error', 'Please make a new search');

        }



        /*instructors*/

        $t_type = $search->t_type;

        $users=[];

        $available_users_r = ServiceRegions::where('region_id', $search->region_id)->pluck('user_id');

        if(count($available_users_r)>0) {

            $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')

                ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar')

                ->whereIn('users.id', $available_users_r)

                ->whereRaw(" users.status=1 and ( user_meta.transmission_type = 'both' OR user_meta.transmission_type = '$t_type' )")

                ->get();

        }



        $user_regions = ServiceRegions::where('user_id', $instructor_id)->get();



        //if(isset($instructor->user_meta->vehicle_image)){ $car_image = YearModel::where('id', $instructor->user_meta->vehicle_image)->first(); }



        // $instructor_detail = InstructorDocs::where('user_id', $instructor_id)->first();



        //return view('search.profile', compact( 'user_regions','instructor', 'search', 'users', 'search_id','t_type', 'car_image'));



        // instructor_profile

        //$events = "";

        $events=[];

        $appointments = Appointments::where('instructor_id', $instructor_id)

            ->select('id', 'schedule_date', 'time_slot', 'type')

            ->where('time_slot', '!=', '')

            ->where('status', '!=', 'cancelled')

            ->whereDate('schedule_date','>=', Carbon::now()->format('Y-m-d'))

            ->get();

        foreach ($appointments as $appointment)

        {

            $lesson_hr = $appointment->lesson_hour;



            $timeSlot_start = explode('-', $appointment->time_slot);



            if($appointment->type=="test") {

                $date_start = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_start[0])->subHour();



            } else {

                $date_start = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_start[0]);

            }



            $start = $date_start->format('Y-m-d H:i');





            $timeSlot_end = explode('-', $appointment->time_slot);

            $date_end = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_end[1]);

            $end = $date_end->format('Y-m-d H:i');



            //$end = $date->addHours($lesson_hr)->format('Y-m-d H:i');



            $events[] = [

                "groupId" => "testGroupId",

                "start" => $start,

                "end" => $end,

                "rendering" => "background",

                "color" => $appointment->is_private == 1 ? "#ef6e6e" : "#4798e8",

            ];

        }



        $avl = [];

        $get_timess = WorkingTime::where(['user_id' => $instructor_id, 'is_enabled' => 'yes'])->get();



        foreach($get_timess as $get_times)

        {

            if($get_times->day=='sunday'){ $num = 0; }

            elseif($get_times->day=='monday'){ $num = 1; }

            elseif($get_times->day=='tuesday'){ $num = 2; }

            elseif($get_times->day=='wednesday'){ $num = 3; }

            elseif($get_times->day=='thursday'){ $num = 4; }

            elseif($get_times->day=='friday'){ $num = 5; }

            elseif($get_times->day=='saturday'){ $num = 6; }



            $av_time = json_decode($get_times->data);

            foreach ($av_time as $v) {

                $start_time = $v->start_hour . ':' . $v->start_min;

                $end_time = $v->end_hour . ':' . $v->end_min;

            }



            $avl[] = [

                'dow' => [$num],

                'start' => $start_time,

                'end' => $end_time,

            ];

        }
        //echo "string";exit;

         $web_events = Appointments::where('instructor_id', $instructor_id)

            ->where('time_slot', '!=', '')

            ->where('schedule_date', '!=', '')

            //->whereIN('status', ['confirmed', 'completed'])

            ->where('is_private', 0)

            ->where('instructor_id', $instructor_id)

            ->get();

            foreach($web_events as $row){
                $get_user = User::where('id',$row->user_id)->first();
                $row->user_detail = $get_user;
                $get_type = Search::select('t_type')->where('id',$row->search_id)->first();
                $row->t_type = $get_type;
            }

         //print_r($web_events);exit();

        $private_events = Appointments::where('instructor_id', Auth::id())

            ->where('is_private', 1)

            ->where('instructor_id', $instructor_id)

            ->get();





        return view('search.profile', compact( 'user_regions','instructor', 'search', 'users', 'search_id','t_type', 'events','avl','web_events','private_events'));

    }



    function book_online($search_id, $instructor_id){

        $user_id = auth()->user();



        // echo $user_id;die();

        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();

        if(!$instructor){

            return back()->with('error', 'Please make a new search');

        }

        $search = Search::find($search_id);

        if(!$search){

            return back()->with('error', 'Please make a new search');

        }

        if($this->check_search_status($search_id)){

            return redirect('/')->with('error', 'Please make a new search');

        }

        $test_package = TestPackage::where('status', 1)->first();

        $region = Region::find($search->region_id);

        return view('search.book_online', compact('instructor', 'search', 'search_id','instructor_id', 'region', 'test_package'));


        if(!empty($user_id))

        {

            $user_id = auth()->user()->id;

            $get_appointment_count=DB::table('appointments')->where('user_id','=',$user_id)->where('instructor_id','=',$instructor_id)->count();



            return view('search.book_online', compact('instructor', 'search', 'search_id','user_id','get_appointment_count'));

        }

        else

        {

            $get_appointment_count=0;

            return view('search.book_online', compact('instructor', 'search', 'search_id','user_id','get_appointment_count'));

        }



    }





    function book_online_cart($search_id, $instructor_id){

        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();

        if(!$instructor){

            return back()->with('error', 'Please make a new search');

        }

        $search = Search::find($search_id);

        if(!$search){

            return back()->with('error', 'Please make a new search');

        }

        if($this->check_search_status($search_id)){

            return redirect('/')->with('error', 'Please make a new search');

        }

        $test_package = TestPackage::where('status', 1)->first();

        $region = Region::find($search->region_id);

        return view('search.cart', compact('instructor', 'search', 'search_id', 'region', 'test_package'));

    }



    function book_online_book($search_id, $instructor_id){



        $user_id = "";

        $user = auth()->user();

        if($user){ $user_id = $user->id; }





        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();

        if(!$instructor){

            return back()->with('error', 'Please make a new search');

        }

        $search = Search::find($search_id);

        if(!$search){

            return back()->with('error', 'Please make a new search');

        }

        if(!$search->instructor_id) {

            $search->instructor_id = $instructor_id;

            $search->save();

        }

        if($this->check_search_status($search_id)){

            return redirect('/')->with('error', 'Please make a new search');

        }

        $test_package = TestPackage::where('status', 1)->first();

        $region = Region::find($search->region_id);

        $user_working_time = WorkingTime::where('user_id', $instructor_id)->get();

        $test_locations = UserTestLocations::join('test_locations', 'test_locations.id', 'user_test_locations.location_id')

            ->select('test_locations.title', 'test_locations.id')

            ->where('user_test_locations.user_id', $instructor_id)

            ->get();

            // echo "<pre>";print_r($test_locations);die();

        return view('search.book', compact('test_locations','user_working_time','instructor', 'search', 'search_id', 'region', 'test_package', 'user_id'));

    }



    private function createTimeSlot($lesson_travel_time, $start_time, $end_time, $lesson_time, $boobkly_appts, $start_date, $learner_id=null)

    {

        // $period = new CarbonPeriod($start_time, $interval.' minutes', $end_time); // for create use 24 hours format later change format

        // $slots = [];

        // foreach($period as $item){



        //     $slots[]=[

        //         'start' => $item->format("h:i a"),

        //         'end' => $item->addMinutes($interval)->format('h:i a'),

        //         ];

        // }

        $original_lesson_travel_time = $lesson_travel_time;

        $slots = [];

        $slot_start_time = $start_time;

        do {

            $lesson_travel_time = $original_lesson_travel_time;

            $slot_end_time = strtotime('+' . $lesson_time . ' minutes', $slot_start_time);

            $occupied = 0;

            $occupied_id = 0;

            foreach($boobkly_appts as $appt)

            {

                $appts_array = explode('-', $appt->time_slot);

                $appt_start_time = $appts_array[0];

                $appt_end_time = $appts_array[1];



                $appt_start = strtotime($start_date.' '.$appt_start_time);

                $appt_end = strtotime($start_date.' '.$appt_end_time);



                if ($appt->type == 'test') {

                    $appt_start = strtotime('-60 minutes', $appt_start);

                    $appt_end = strtotime('+30 minutes', $appt_end);

                }

                // if($appts->type=="test")

                //     { $start = $start-3600; }



                if( ($slot_start_time >= $appt_start && $slot_start_time < $appt_end) ||

                    ($slot_end_time > $appt_start && $slot_end_time <= $appt_end)

                ) {

                    $occupied = $appt_end;

                    $occupied_id = $appt->user_id;

                }

            }

            if ($occupied) {

                if ($learner_id && $learner_id == $occupied_id) {

                    $lesson_travel_time = 0;

                }

                $slot_start_time = strtotime('+' . $lesson_travel_time . ' minutes', $occupied);

                $slots[] = [

                    'start' => date('h:i a', strtotime('-' . $lesson_time . ' minutes', $occupied)),

                    'end' => date('h:i a', $occupied),

                    'occupied' => 1

                ];

            } else {

                $occupied1 = 0;

                $occupied1_id = 0;

                foreach($boobkly_appts as $appt)

                {

                    $appts_array = explode('-', $appt->time_slot);

                    $appt_start_time = $appts_array[0];

                    $appt_end_time = $appts_array[1];



                    $appt_start = strtotime($start_date.' '.$appt_start_time);

                    $appt_end = strtotime($start_date.' '.$appt_end_time);



                    if ($appt->type == 'test') {

                        $appt_start = strtotime('-60 minutes', $appt_start);

                        $appt_end = strtotime('+30 minutes', $appt_end);

                    }



                    if ($learner_id && $learner_id == $appt->user_id) {

                        $lesson_travel_time = 0;

                    }

                    $prev_appt_slot_end_time = strtotime('-' . $lesson_travel_time . ' minutes', $appt_start);

                    $prev_appt_slot_start_time = strtotime('-' . $lesson_time . ' minutes', $prev_appt_slot_end_time);



                    if( ($slot_start_time >= $prev_appt_slot_start_time && $slot_start_time <= $prev_appt_slot_end_time) ||

                        ($slot_end_time > $prev_appt_slot_start_time && $slot_end_time <= $prev_appt_slot_end_time)

                    ) {

                        $occupied1 = $appt_end;

                        $occupied1_id = $appt->user_id;

                    }

                    $lesson_travel_time = $original_lesson_travel_time;

                }

                if ($occupied1) {

                    if ($learner_id && $learner_id == $occupied1_id) {

                        $lesson_travel_time = 0;

                    }

                    $prev_appt_slot_start_time = 0;

                    $prev_appt_slot_end_time = 0;



                    $prev_appt_slot_start_time = $appt->type == 'test' ? strtotime('-' . (2 * $lesson_time + $lesson_travel_time + 90) . ' minutes', $occupied1) : $prev_appt_slot_start_time = strtotime('-' . (2 * $lesson_time + $lesson_travel_time) . ' minutes', $occupied1);

                    $prev_appt_slot_end_time = $appt->type == 'test' ? strtotime('-' . ($lesson_time + $lesson_travel_time + 90) . ' minutes', $occupied1) : strtotime('-' . ($lesson_time + $lesson_travel_time) . ' minutes', $occupied1);



                    $slots[] = [

                        'start' => date('h:i a', $prev_appt_slot_start_time),

                        'end' => date('h:i a', $prev_appt_slot_end_time),

                        'occupied' => 0

                    ];

                    $slots[] = [

                        'start' => $appt->type == 'test' ? date('h:i a', strtotime('-' . ($lesson_time + 90) . ' minutes', $occupied1)) : date('h:i a', strtotime('-' . $lesson_time . ' minutes', $occupied1)),

                        'end' => date('h:i a', $occupied1),

                        'occupied' => 1

                    ];

                    $slot_start_time = strtotime('+' . $lesson_travel_time . ' minutes', $occupied1);

                } else {

                    $slots[] = [

                        'start' => date('h:i a', $slot_start_time),

                        'end' => date('h:i a', $slot_end_time),

                        'occupied' => 0

                    ];

                    $slot_start_time = strtotime('+' . $lesson_travel_time . ' minutes', $slot_start_time);

                }

            }

        } while(strtotime('+' . $lesson_travel_time . ' minutes', $slot_start_time) < $end_time);



        return $slots;

    }



    private function createTimeSlot1($interval, $start_time, $end_time)

    {

        $period = new CarbonPeriod($start_time, $interval.' minutes', $end_time); // for create use 24 hours format later change format

        $slots = [];

        foreach($period as $item){



            $slots[]=[

                'start' => $item->format("h:i a"),

                'end' => $item->addMinutes($interval)->format('h:i a'),

                ];

        }



        return $slots;

    }



    function get_slots(Request $request){



        $instructor = User::where('id', $request->instructor_id)->first();

        if($instructor) {

            $start_date = $request->start_date;

            $day = Carbon::parse($start_date)->format('l');

            $get_times = WorkingTime::where(['user_id' => $request->instructor_id, 'is_enabled' => 'yes', 'day' => $day])->first();

            if ($get_times) {



                /*appointment settings*/

                $lesson_travel_time = $instructor->lesson_travel_time;

                $av_time = json_decode($get_times->data);



                /*get appointments of selected date*/

                $boobkly_appts = Appointments::where('instructor_id', $request->instructor_id)

                    ->where('status', '!=', 'cancelled')

                    ->whereDate('schedule_date', $start_date)

                    //->where('is_private', 0)

                    //->pluck('time_slot')

                    //->toArray();

                    ->get();



                $lesson_time = 60;

                if ($request->hour == 2) {

                    $lesson_time = 120;

                }



                if (is_array($av_time)) {

                    $html = "<select required class='form-select availability_check' name='time_slot' onchange='check_availiblity(this)'><option value=''>Select lesson time</option>";

                    foreach ($av_time as $v) {

                        $start_time = strtotime($start_date . ' ' . $v->start_hour . ':' . $v->start_min);

                        $end_time = strtotime($start_date . ' ' . $v->end_hour . ':' . $v->end_min);

                        $slots = $this->createTimeSlot($lesson_travel_time, $start_time, $end_time, $lesson_time, $boobkly_appts, $start_date, $request->userid);



                        foreach ($slots as $i => $slot) {

                            $endtimestring = $slot['end'];

                            if ($slot['occupied']) {

                                $html .= '<option disabled value="' . $slot['start'].'-'.$endtimestring. '">' . $slot['start'].'-'.$endtimestring. '</option>';

                            } else {

                                $html .= '<option data-start="'.strtotime($start_date.' '.$slot['start']).'" data-end="'.strtotime($start_date.' '.$slot['end']).'" value="' . $slot['start'].'-'.$endtimestring. '" >' . $slot['start'].'-'.$endtimestring. '</option>';

                            }

                        }

                    }

                }

                return response()->json(['html' => $html, 'date'=>date( 'l, F d, ', strtotime($request->start_date)), 'boobkly_appts' => $boobkly_appts, 'av_time' => $av_time]);

            }

        }else{

            return response()->json(['html' => 'invalid request']);

        }

    }



    function get_slots1(Request $request){





        $instructor = User::where('id', $request->instructor_id)->first();

        if($instructor)

        {

            $start_date = $request->start_date;



            $test_appts_today = Appointments::where('user_id',$request->userid)

                    ->where('status', '!=', 'cancelled' )

                    ->where('type', '=', 'test' )

                    ->whereDate('schedule_date', $start_date)

                    ->first();



            if( ($test_appts_today) && $request->userid!="")

            {

                return response()->json(['html' => 'already_booked']);

            }

            else

            {

                $day = Carbon::parse($start_date)->format('l');

                $get_times = WorkingTime::where(['user_id' => $request->instructor_id, 'is_enabled' => 'yes', 'day' => $day])->first();

                if ($get_times) {

                    $lesson_travel_time = $instructor->lesson_travel_time;

                    $av_time = json_decode($get_times->data);



                    /*get appointments of selected date*/

                    $boobkly_appts = Appointments::where('instructor_id', $request->instructor_id)

                        ->where('status', '!=', 'cancelled')

                        ->whereDate('schedule_date', $start_date)

                        //->where('is_private', 0)

                        //->pluck('time_slot')

                        //->toArray();

                        ->get();



                    $lesson_time = 60;

                    if ($request->hour == 2) {

                        $lesson_time = 120;

                    }



                    if (is_array($av_time)) {

                        $html = "<select name='time_slot_test_time' class='form-select availability_check' onchange='check_availiblity1(this)'><option value=''>Select test start time</option>";

                        foreach ($av_time as $v) {

                            $start_time = strtotime($start_date . ' ' . $v->start_hour . ':' . $v->start_min);

                            $end_time = strtotime($start_date . ' ' . $v->end_hour . ':' . $v->end_min);

                            // $start_time = $v->start_hour . ':' . $v->start_min;

                            // $end_time = $v->end_hour . ':' . $v->end_min;

                            // $start_carb = Carbon::parse($start_time)->addMinutes($instructor->lesson_travel_time)->format('H:i');

                            // $end_carb = Carbon::parse($end_time)->addMinutes($instructor->lesson_travel_time)->format('H:i');

                            // $slots = $this->createTimeSlot($time_interval, $start_carb, $end_carb);

                            $slots = $this->createTimeSlot($lesson_travel_time, $start_time, $end_time, $lesson_time, $boobkly_appts, $start_date);

                            // $slots = $this->createTimeSlot1($lesson_travel_time, $start_time, $end_time);

                            foreach ($slots as $i => $slot) {

                                $endtimestring = $slot['end'];

                                if ($slot['occupied']) {

                                    $html .= '<option disabled value="' . $slot['start'].'-'.$endtimestring. '">' . $slot['start'].'</option>';

                                } else {
                                        $new_timestamp = strtotime($start_date.' '.$slot['start']);

                                        $start_date_new = new DateTime();
                                        $start_date_new->setTimestamp($new_timestamp);
                                        $last_date = $start_date_new->format('Y-m-d H:i:s');

                                        $pickup_time = strtotime($last_date) - 3600;
                                         $pickup_time = date('h:i a', $pickup_time);
                                    $html .= '<option pickuptime = "'.$pickup_time.'" startdate="'.$start_date_new->format('h:i a').'" data-start="'.strtotime($start_date.' '.$slot['start']).'" data-end="'.strtotime($start_date.' '.$slot['end']).'" value="' . $slot['start'].'-'.$endtimestring.'" >' . $slot['start'].'</option>';

                                }

                            }



                            // $time_interval = $lesson_travel_time;

                            // $slots = $this->createTimeSlot1($time_interval, $start_time, $end_time);

                            // foreach ($slots as $i => $slot) {

                            //     $add_time = 60 - $time_interval;

                            //     $endtime = strtotime('+'.$add_time.' minutes',strtotime($start_date.' '.$slot['end']));

                            //     $endtimestring = date('h:i a', $endtime);



                            //     if(empty($boobkly_appts)) {

                            //         $html .= '<option data-start="'.strtotime($start_date.' '.$slot['start']).'" data-end="'.$endtime.'" value="' . $slot['start'].'-'.$endtimestring . '" >' . $slot['start'] . '</option>';

                            //     }

                            //     else {

                            //         $start_time = (strtotime($start_date.' '.$slot['start']))-(3600+($instructor->lesson_travel_time*60));



                            //         $is_blocked = 0;

                            //         foreach($boobkly_appts as $appts) {

                            //             $appts_array = explode('-', $appts->time_slot);

                            //             $start_1 = $appts_array[0];

                            //             $end_1 = $appts_array[1];



                            //             $start = strtotime($start_date.' '.$start_1);

                            //             //echo $start = $start-3600; die;

                            //             $end = strtotime($start_date.' '.$end_1);



                            //             if( ($start_time >= $start && $start_time < $end) || ($endtime > $start && $endtime <= $end) || ($start_time < $start && $endtime > $start) ) {

                            //                 $html .= '<option disabled value="' . $slot['start'].'-'.$endtimestring . '">' . $slot['start'] . '</option>';

                            //                 $is_blocked = 1;

                            //             }

                            //         }



                            //         if($is_blocked == 0) {

                            //             $html .= '<option data-start="'.strtotime($start_date.' '.$slot['start']).'" data-end="'.$endtime.'" value="' . $slot['start'].'-'.$endtimestring . '" >' . $slot['start'] . '</option>';

                            //         }

                            //     }

                            // }

                        }

                    }



                    return response()->json( [ 'html' => $html, 'date'=>date( 'l, F d, ', strtotime($request->start_date) ) ] );

                }

            }

        }

        else

        {

            return response()->json(['html' => 'invalid request']);

        }

    }

    function learner_register($search_id){

        Session::put('prev_url','');

        $search = Search::find($search_id);

        if(!$search){

            return back()->with('error', 'Please make a new search');

        }

        $instructor = User::whereId($search->instructor_id)->where('type', 'inst')->first();

        $test_package = TestPackage::where('status', 1)->first();

        $regions = Region::where('status', 1)->get();

        $user = false;

        if( Auth::check() ){

            $user = User::find(auth()->user()->id);

        }

        return view('learner.register', compact('regions','user','instructor', 'search', 'search_id', 'test_package'));

    }



    function register_learner(Request $request){

        try {

            if( Auth::guest() ){

                $rules = [
                    'name'              => ['required', 'string', 'max:255'],
                    'last_name'         => ['required', 'string', 'max:255'],
                    'phone'             => ['required', 'string', 'max:14', 'min:10'],
                    'address'           => ['required'],
                    'year'              => ['required'],
                    'day'               => ['required'],
                    'month'             => ['required'],
                ];

            }else{
                $rules = [
                    'address'           => ['required'],
                ];
            }

            if( auth()->guest() ){
                $user_id = false;
                unset($rules['email']);
                $rules= array_merge($rules, [
                    'email'             => 'required|email|unique:users,email,'.$user_id,
                    'phone'             => ['required', 'string', 'max:12', 'min:10'],
                    'password'          => ['required', 'min:6', 'required_with:confirm_password', 'same:confirm_password'],
                    'confirm_password'  => ['required', 'min:6'],
                ]);
            }else{
                if(auth()->user()->type !='learner'){
                    return response()->json(['success' => false, 'message' => "You haven't permission to proceed!" ]);
                }
                unset($rules['email']);
                $user_id = auth()->user()->id;

            }

            $validator = Validator::make($request->all(), $rules,

            [
                'year.required' => 'please select year of birthday.',
                'day.required' => 'please select day of birthday.',
                'month.required' => 'please select month of birthday.',
            ]
            );

            if ($validator->fails()) {

                $err = $validator->errors();

                return response()->json(['error' => true, 'message' => $err]);

            }else {

                $user = new User();

                if ($request->user_id != '') {

                    $user = $user->findOrFail($request->user_id);

                }

                $user->fill($request->except(['password']));

                if(auth()->guest()){

                    $user->password = Hash::make($request->password);

                }

                $user->dob = $request->year . '-' . $request->month . '-' . $request->day;

                $user->lname = $request->last_name;

                $user->type = "learner";
                $user->status =1;



                if ($user->save()) {

                    if(auth()->guest()) {

                        //$request->user()->sendEmailVerificationNotification();

                        Auth::loginUsingId($user->id);

                    }

                    $user_date = [

                        'learner_id' => $user->id,

                        'address' => $request->address,

                        'address_detail' => $request->address_detail,

                    ];

                    /*save search*/

                    Search::where('id', $request->search_id)->update(

                        ['step_5' => $user_date, 'learner_id' => $user->id,]

                    );

                    return response()->json(['success' => true]);

                }

            }

        }catch (\Exception $e){

            return response()->json(['success' => false, 'message' => 'something went wrong! '. $e->getMessage().$e->getLine()]);

        }

    }



    function learner_payment($search_id){



        if(auth()->guest()) {

            return back()->with('error', 'Please make a new search')->with('error', 'invalid request');

        }

        $search = Search::where('id',$search_id)->where('learner_id', auth()->user()->id)->first();

        if(!$search){

            return back()->with('error', 'Please make a new search');

        }

        $instructor = User::whereId($search->instructor_id)->where('type', 'inst')->first();

        $test_package = TestPackage::where('status', 1)->first();

        $regions = Region::where('status', 1)->get();

        $user = false;

        if( Auth::check() ){

            $user = User::find(auth()->user()->id);

        }

        return view('learner.payment', compact('test_package', 'regions','user','instructor', 'search', 'search_id'));

    }



    public function process_appointment(Request $request)
    {
        /*--------Update Changes Record---------*/
        $step2_data=[];
        if (isset($_REQUEST['hr']) && $_REQUEST['hr']>0){
            array_push($step2_data, "lesson");
        }

        if (isset($_REQUEST['test_package_adding_status']) && $_REQUEST['test_package_adding_status']=='on'){
            array_push($step2_data, "test");
        }

        $step3_data =
            [
                "total" => $request->total,
                'discount' => $request->dis,
                'hour' => $request->hr,
                'hourly_rate' => $request->hourly_rate,
                'test_price'  => $request->test_price
            ];

        $hourly_rate=$_REQUEST['hr'];
        $addTest=0;
        if (isset($_REQUEST['test_package_adding_status']) && $_REQUEST['test_package_adding_status']=='on') {
            $addTest = 1;
        }

       Search::where('id', $request->search_id)->update(
            [
                'step_3' => $step3_data,
                'final_selected_hour'=>$hourly_rate,
                'final_selected_test'=>$addTest,
                'final_selected_price'=>$request->total,
            ]
        );

        if ($step2_data){
            Search::where('id', $request->search_id)->update(
                ['step_2' => $step2_data,]
            );
        }

        /*--------Update Changes Record---------*/

      //  try{

            $learner = auth()->user();
            $user_id = $learner->id;
            $status = false;
        $appointmetObj='';

            if ($_REQUEST['paymentOption']=='stripe') {
                if ( isset( $request->stripeToken ) ) {
                    $stripeToken = $request->stripeToken;
                } else {
                    die( "Request Failed!" );
                }
            }

            /*update address*/
            $user_date = [
                'learner_id' => $user_id,
                'address' => $request->address,
                'address_detail' => $request->address_detail,
            ];

            /*save search*/
            Search::where('id', $request->search_id)->update(
                ['step_5' => $user_date]
            );

         $test_schedule_date = $test_time_slot = $test_location="";
            $search = Search::whereId($request->search_id)->first();
            if($search) {

                // check payment if already done
                if(PaymentResponse::where(['search_id'=> $search->id, 'user_id' => $user_id, 'status' =>'succeeded'])->exists() ){
                    return response()->json(['success' => false, 'message' => 'Appointment already registered with this search. please make new search OR contact with support in case of any problem.']);
                }

                $step_3 = $search->step_3;
                $step_3 = json_decode($step_3);
                $amount = @$step_3->total;
                $step_5 = $search->step_5;
                $step_5 = json_decode($step_5);
                $step_2 = $search->step_2;
                $step_2 = json_decode($step_2);
                $sch = $search->step_4;
                $sch = json_decode($sch);

                //print_r($sch); die;

                // if(isset($step_3->hour) && isset($step_3->hourly_rate) && isset($step_3->total) && isset($step_5->address) && is_array($step_2) && count($step_2)>0 && $sch->lesson_hour){

                if(isset($step_3->hour) && isset($step_3->hourly_rate) && isset($step_3->total) && isset($step_5->address) && is_array($step_2) && count($step_2)>0){

                    //

                }else{

                    return response()->json(['success' => false, 'message' => 'Invalid search data. please try again']);

                }

                //Common COde Structure
                $hourly_rate = Region::whereId($search->region_id)->value('price');
                $schedule_date = $time_slot='';
                $lesson_hour = 1;

                if (isset($sch->lesson_hour)) {
                    $lesson_hour = $sch->lesson_hour;
                    $lesson_hour = explode(',', $lesson_hour);
                }

                if (isset($sch->lesson_schedule_date))
                {
                    $schedule_date = $sch->lesson_schedule_date;
                    $schedule_date = explode(',', $schedule_date);
                }

                if (isset($sch->lesson_time_slot))

                {
                    $time_slot = $sch->lesson_time_slot;
                    $time_slot = explode(',', $time_slot);
                }



                if(isset($sch->test_schedule_date))
                {
                    $test_schedule_date = $sch->test_schedule_date;
                }

                if(isset($sch->test_time_slot))
                {
                    $test_time_slot = $sch->test_time_slot;
                }

                if(isset($sch->test_location))
                {
                    $test_location = $sch->test_location;
                }


                $app_ids=[];

                if (is_numeric($amount)) {
                    foreach ( $step_2 as $package ) {
                        if ( $package == 'test' && $test_schedule_date && $test_schedule_date != 'undefined' ) {
                            //===== to ready start & end date

                            $sdArray = explode ( '-', $test_schedule_date );

                            $newSD = $sdArray[ 2 ] . '-' . $sdArray[ 1 ] . '-' . $sdArray[ 0 ];

                            $timeslotArray = explode ( '-', $test_time_slot );


                            $timeStart = $timeslotArray[ 0 ];

                            $timeStartArray = explode ( ' ', $timeStart );

                            $timeStartRight = $timeStartArray[ 1 ];

                            if ( $timeStartRight == 'am' ) {
                                $finalStart = $timeStartArray[ 0 ];
                            } else {

                                $timeStartLeftArray = explode ( ':', $timeStartArray[ 0 ] );

                                if ( intval ( $timeStartLeftArray[ 0 ] ) == 12 ) {

                                    $finalStart = $timeStartArray[ 0 ];

                                } else {

                                    $lft = intval ( $timeStartLeftArray[ 0 ] ) + 12;

                                    $finalStart = $lft . ':' . $timeStartLeftArray[ 1 ];

                                }

                            }


                            $timeEnd = $timeslotArray[ 1 ];

                            $timeEndArray = explode ( ' ', $timeEnd );

                            $timeEndRight = $timeEndArray[ 1 ];

                            if ( $timeEndRight == 'am' ) {
                                $finalEnd = $timeEndArray[ 0 ];
                            } else {

                                $timeEndLeftArray = explode ( ':', $timeEndArray[ 0 ] );

                                if ( intval ( $timeEndLeftArray[ 0 ] ) == 12 ) {
                                    $finalEnd = $timeEndArray[ 0 ];
                                } else {
                                    $lft = intval ( $timeEndLeftArray[ 0 ] ) + 12;

                                    $finalEnd = $lft . ':' . $timeEndLeftArray[ 1 ];
                                }
                            }

                            $final_start_date = $newSD . " " . $finalStart;

                            $final_end_date = $newSD . " " . $finalEnd;

                            //=========================================================

                            if (isset($_REQUEST['type']) && $_REQUEST['type']=='wallet'){

                            }else{
                                $appointmetObj = new Appointments();

                                $appointmetObj->user_id = $user_id;

                                $appointmetObj->schedule_date = $test_schedule_date;

                                $appointmetObj->time_slot = $test_time_slot;

                                $appointmetObj->status = "confirmed";

                                $appointmetObj->instructor_id = $search->instructor_id;

                                $appointmetObj->payment_status = 0;

                                $appointmetObj->lesson_hour = 1;

                                $appointmetObj->search_id = $search->id;

                                $appointmetObj->type = 'test';

                                $appointmetObj->start_date = $final_start_date;

                                $appointmetObj->end_date = $final_end_date;

                                $appointmetObj->is_private = 0;

                                $appointmetObj->amount = $step_3->test_price;

                                // if(isset($sch->test_location) && $sch->test_location!='' && is_numeric($sch->test_location) ){

                                //     $appointmetObj->test_location = $sch->test_location;

                                // }

                                //$appointmetObj->test_location = $test_location;

                                $appointmetObj->address = json_encode ( $step_5 );


                                /*print_r($appointmetObj);

                                exit;*/

                                if ( $appointmetObj->save () ) {

                                    $app_ids[] = $appointmetObj->id;

                                }
                            }

                        } elseif ( $package == 'lesson' ) {

                            $hour = $step_3->hour; // total booking hours

                            if ( isset( $step_3->hourly_rate ) ) {

                                $hourly_rate = @$step_3->hourly_rate;

                            }


                            $total_les_hr = 0;

                            if ( is_array ( $lesson_hour ) ) {

                                foreach ( $lesson_hour as $lsn_hr ) {

                                    $total_les_hr = $total_les_hr + $lsn_hr;

                                }

                            }


                            $rest_hr = $hour - $total_les_hr;


                            if ( $rest_hr > 0 ) {

                                $price = $hourly_rate * $rest_hr;

                                if (isset($_REQUEST['type']) && $_REQUEST['type']=='wallet'){

                                }else{
                                    $appointmetObj = new Appointments();

                                    $appointmetObj->user_id = $user_id;

                                    $appointmetObj->status = "confirmed";

                                    $appointmetObj->instructor_id = $search->instructor_id;

                                    $appointmetObj->payment_status = 0;

                                    $appointmetObj->is_private = 0;

                                    $appointmetObj->search_id = $search->id;

                                    $appointmetObj->type = 'lesson';

                                    $appointmetObj->hourly_rate = $hourly_rate;

                                    $appointmetObj->lesson_hour = $rest_hr;

                                    $appointmetObj->address = json_encode ( $step_5 );

                                    $appointmetObj->amount = $price;

                                    if ( $appointmetObj->save () ) {

                                        $app_ids[] = $appointmetObj->id;

                                    }
                                }
                            }


                            //print_r($schedule_date);


                            if ( !empty( $schedule_date ) ) {

                                foreach ( $schedule_date as $key => $sd ) {


                                    //===== to ready start & end date

                                    $sdArray = explode ( '-', $sd );

                                    $newSD = $sdArray[ 2 ] . '-' . $sdArray[ 1 ] . '-' . $sdArray[ 0 ];

                                    $timeslotArray = explode ( '-', $time_slot[ $key ] );


                                    $timeStart = $timeslotArray[ 0 ];

                                    $timeStartArray = explode ( ' ', $timeStart );

                                    $timeStartRight = $timeStartArray[ 1 ];

                                    if ( $timeStartRight == 'am' ) {
                                        $finalStart = $timeStartArray[ 0 ];
                                    } else {

                                        $timeStartLeftArray = explode ( ':', $timeStartArray[ 0 ] );

                                        if ( intval ( $timeStartLeftArray[ 0 ] ) == 12 ) {

                                            $finalStart = $timeStartArray[ 0 ];

                                        } else {

                                            $lft = intval ( $timeStartLeftArray[ 0 ] ) + 12;

                                            $finalStart = $lft . ':' . $timeStartLeftArray[ 1 ];

                                        }

                                    }


                                    $timeEnd = $timeslotArray[ 1 ];

                                    $timeEndArray = explode ( ' ', $timeEnd );

                                    $timeEndRight = $timeEndArray[ 1 ];

                                    if ( $timeEndRight == 'am' ) {
                                        $finalEnd = $timeEndArray[ 0 ];
                                    } else {

                                        $timeEndLeftArray = explode ( ':', $timeEndArray[ 0 ] );

                                        if ( intval ( $timeEndLeftArray[ 0 ] ) == 12 ) {

                                            $finalEnd = $timeEndArray[ 0 ];

                                        } else {

                                            $lft = intval ( $timeEndLeftArray[ 0 ] ) + 12;

                                            $finalEnd = $lft . ':' . $timeEndLeftArray[ 1 ];

                                        }

                                    }


                                    $final_start_date = $newSD . " " . $finalStart;

                                    $final_end_date = $newSD . " " . $finalEnd;

                                    //=========================================================


                                    $price = $hourly_rate * $lesson_hour[ $key ];

                                    if (isset($_REQUEST['type']) && $_REQUEST['type']=='wallet'){

                                    }else{
                                        $appointmetObj = new Appointments();

                                        $appointmetObj->user_id = $user_id;

                                        $appointmetObj->schedule_date = $sd;

                                        $appointmetObj->time_slot = $time_slot[ $key ];

                                        $appointmetObj->status = "confirmed";

                                        $appointmetObj->instructor_id = $search->instructor_id;

                                        $appointmetObj->payment_status = 0;

                                        $appointmetObj->is_private = 0;

                                        $appointmetObj->search_id = $search->id;

                                        $appointmetObj->type = 'lesson';

                                        $appointmetObj->hourly_rate = $hourly_rate;

                                        $appointmetObj->lesson_hour = $lesson_hour[ $key ];

                                        $appointmetObj->start_date = $final_start_date;

                                        $appointmetObj->end_date = $final_end_date;

                                        $appointmetObj->address = json_encode ( $step_5 );

                                        $appointmetObj->amount = $price;

                                        if ( $appointmetObj->save () ) {

                                            $app_ids[] = $appointmetObj->id;

                                        }
                                    }
                                }

                            }

                        }

                    }
                }


                $appIds = implode(',', $app_ids);

                $stripe_key ='sk_test_nrV6AS7Io2Rnyt7dEd5dxMRO';
                if($stripe_key!='' && $_REQUEST['paymentOption']=='stripe'){
                    if (is_numeric($amount)) {


                            /* calculate first appointment */

                            \Stripe\Stripe::setApiKey($stripe_key); // this is Secret key

                            $total_amount = $amount * 100;

                            $charge = \Stripe\Charge::create([

                                'amount' => $total_amount,

                                'currency' => 'usd',

                                'source' => $stripeToken,

                                'description' => 'appointment for instructor =' . $search->instructor_id . ' from user =' . $user_id . ' appointment id =',

                            ]);

                           /*Stripe Payment*/
                            if ($charge['paid'] == 1) {

                                $status = true;

                                if ($app_ids) {
                                    Appointments::whereIn('id', $app_ids)->update(['payment_status' => 1]);
                                }

                                $converted = $charge['amount'] / 100;

                                $payment_response = new PaymentResponse();

                                $payment_response->charge_id = $charge['id'];

                                $payment_response->balance_transaction_id = $charge['balance_transaction'];

                                $payment_response->amount = $charge['amount'];

                                $payment_response->converted_amount = $converted;

                                $payment_response->currency = $charge['currency'];

                                $payment_response->created = $charge['created'];

                                $payment_response->status = $charge['status'];

                                $payment_response->method = "Stripe";

                                $payment_response->appointment_id = $appIds;

                                $payment_response->response = json_encode($charge);

                                $payment_response->user_id = \auth()->user()->id;

                                $payment_response->search_id = $search->id;

                                if ($payment_response->save()) {

                                    /*send email to instructor*/

                                    $instructor = User::where('id', $search->instructor_id)->first();

                                    if ($instructor) {

                                        Session::put('success','Your payment successfully completed.');
                                        /* Wallet For Admin and Instructor User */

                                        $GetAdminRecord = User::where('type', 'admin')->first();

                                        $AdminCommission = 5;

                                        $calculated = ($amount * $AdminCommission) / 100;

                                        $ToInstructor = $amount - $calculated;

                                        $ToAdmin = $calculated;

                                        /* Admin Wallet */

                                        $GetAdminBalance = Wallet::where('user_id', $GetAdminRecord->id)->first();

                                        if ($GetAdminBalance) {

                                            $UpdateBalance = $GetAdminBalance->withdrawable + $ToAdmin;

                                            Wallet::updateOrCreate(
                                                ['user_id' => $GetAdminRecord->id],
                                                [
                                                    'user_id' => $GetAdminRecord->id,
                                                    'withdrawable' => $UpdateBalance,
                                                ]);

                                        } else {
                                            Wallet::updateOrCreate(
                                                ['user_id' => $GetAdminRecord->id],
                                                [
                                                    'user_id' => $GetAdminRecord->id,
                                                    'withdrawable' => $ToAdmin,
                                                ]);
                                        }

                                        /* Instructor Wallet */
                                        $GetInstructorBalance = Wallet::where('user_id', $search->instructor_id)->first();

                                        if ($GetInstructorBalance) {

                                            $UpdateBalance = $GetInstructorBalance->withdrawable + $ToInstructor;

                                            Wallet::updateOrCreate(

                                                ['user_id' => $search->instructor_id],

                                                [

                                                    'user_id' => $search->instructor_id,

                                                    'withdrawable' => $UpdateBalance,

                                                ]);
                                        } else {
                                            Wallet::updateOrCreate(
                                                ['user_id' => $search->instructor_id],
                                                [
                                                    'user_id' => $search->instructor_id,
                                                    'withdrawable' => $ToInstructor,
                                                ]);
                                        }


                                        /* send confirmation SMS */
                                        if($time_slot!=''){
                                            $schedule_date = $schedule_date[0].' '. $time_slot[0];
                                        }

                                        $twilio = new TwilioController();
                                        /* message to constructor */
                                        if($instructor->phone!=''){
                                            $inst_message = 'Hi '. ucfirst($instructor->name);
                                            $inst_message .= ' We received new appointment request from' . ucfirst($learner->name). " \n ";
                                            $inst_message .= 'Appointment date is '.$schedule_date. " \n";
                                            $inst_message .= 'Please visit '.url('/login').' to confirm';
                                            //$twilio->sendMessage($inst_message, $instructor->phone);
                                        }

                                        if($learner->phone!=''){
                                            $inst_message = 'This is Payment confirmation message from FirstPass' ."\n";
                                            $inst_message .= 'appointment confirmation message will be sent to you.  '. "\n";
                                            $inst_message .= 'Please visit '.url('/login').' to check status';
                                            // $twilio->sendMessage($inst_message, $learner->phone);
                                        }

                                        $email_settings = EmailSettings::find(1);
                                        $settings = Settings::find(1);
                                        /*email to instructor about appointment*/
                                        $s = array('%FIRST_NAME%', '%LAST_NAME%', '%EMAIL%', '%PHONE%', '%ADDRESS%', '%BOOK_DATE%');
                                        $r = array($instructor->name, $instructor->lname, $instructor->email, $instructor->phone, $step_5->address, $schedule_date);
                                        $email_body = str_replace($s, $r, $email_settings->appt_body);
                                        if ($settings->email_type == 'api') {
                                            if ($settings->email_api == 'send_grid') {
                                                // sending email to super admin
                                                AppTraits::SendgridEmail($email_body, $instructor->email, $email_settings->appt_subject, 'FirstPass', $instructor->name, $settings->sg_email, $settings->sg_apikey);
                                            }
                                        } else {
                                            AppTraits::SmtpEmail($email_body, $instructor->email, $email_settings->appt_subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
                                        }
                                    }
                                }
                            }
                            /*close stripe actions*/
                    }
                }elseif ($_REQUEST['paymentOption']=='paypal'){
                    if (is_numeric($amount)) {

                        $originalAmount=$amount;
                        $payer = new Payer();
                        $payer->setPaymentMethod ( 'paypal' );

                        $item = new Item();
                        $item->setName ( $learner->name)
                            ->setCurrency ( 'USD' )
                            ->setQuantity ( 1 )
                            ->setPrice ( $originalAmount);

                        $itemList = new ItemList();
                        $itemList->setItems ( [$item] );

                        $details = new Details();
                        $details->setSubtotal ( $originalAmount );

                        $setUpTotalAmount = new Amount();
                        $setUpTotalAmount->setCurrency ( 'USD' )
                            ->setTotal ( $originalAmount )
                            ->setDetails ( $details );

                        $appointId='';
                        if ($appointmetObj){
                            $appointId=$appointmetObj->id;
                        }
                        $transaction = new Transaction();
                        $transaction->setAmount ( $setUpTotalAmount )
                            ->setItemList ( $itemList )
                            ->setDescription (  'appointment for instructor =' . $search->instructor_id . ' from user =' . $user_id . ' appointment id =' .$appointId.' appIds='.$appIds)
                            ->setInvoiceNumber ( uniqid () );

                        $redirectUrls = new RedirectUrls();
                        $redirectUrls->setReturnUrl ( url ( '/paypal/success?appsIds='.$appIds.'&searchId='.$search->id.'&instructor_id='.$search->instructor_id.'&appointment_id='.$appointId))
                            ->setCancelUrl ( url ( '/paypal/cancel?appsIds='.$appIds.'&searchId='.$search->id.'&instructor_id='.$search->instructor_id.'&appointment_id='.$appointId));

                        $payment = new \PayPal\Api\Payment();
                        $payment->setIntent ( 'sale' )
                            ->setPayer ( $payer )
                            ->setRedirectUrls ( $redirectUrls )
                            ->setTransactions ( [$transaction] );

                        try {
                            $payment->create ( $this->apiContext );
                        } catch ( \Exception $e ) {
                            return redirect ()->route ( 'paypal.cancel' )->withErrors ( 'Payment failed' );
                        }

                        $approvalUrl = $payment->getApprovalLink ();
                        return response()->json(['success' => true,'method' =>$_REQUEST['paymentOption'],'redirect_link'=>$approvalUrl, 'message' => 'Saved successfully.'], 200);

                        //  self::callingPaypalCheckout ();
                    }
                }elseif ($_REQUEST['paymentOption']=='zip_pay'){

                    $origanlbalnce=$amount;
                    $redirectConfirmUrl     = url ( '/zippay/success?appsIds='.$appIds.'&searchId='.$search->id.'&instructor_id='.$search->instructor_id.'&balance='.$origanlbalnce.'&appointment_id='.$appointmetObj->id);

                    $private_key = 'MSdWDxhMDcBRh1LzU0mLoiISOt0Vduru';

                    $url = 'https://global-api.sand.au.edge.zip.co/merchant/checkouts';
                    $apiKey =$private_key;

                    $randomNumber = mt_rand(1000, 9999); // You can adjust the range based on your requirements

                    $data = array(
                        'shopper' => array(
                            'title' => 'Mr',
                            'first_name' =>$learner->name,
                            'last_name' =>'',
                            'middle_name' =>'',
                            'phone' =>$learner->phone, // //0400000000
                            'email' =>$learner->email,   // 'zp_1699830737429@mailinator.com',
                            'birth_date' => '2017-10-10',
                            'gender' => 'Male',
                        ),
                        'order' => array(
                            'reference' =>self::generateRandomOrderID(),
                            'amount' =>$amount,
                            'currency' => 'AUD',
                            'shipping' => array(
                                'pickup' => false,
//                                'address' => array(
//                                    'line1' => '10 Test st',
//                                    'city' => 'Sydney',
//                                    'state' => 'NSW',
//                                    'postal_code' => '2000',
//                                    'country' => 'AU'
//                                )
                            )
                        ),
                        'config' => array(
                            'redirect_uri' => $redirectConfirmUrl
                        ),
                    );

                    $headers = array(
                        'authorization: Bearer ' . $apiKey,
                        'content-type: application/json',
                        'idempotency-key: 1'
                    );

                    $ch = curl_init ();
                    curl_setopt ( $ch, CURLOPT_URL, $url );
                    curl_setopt ( $ch, CURLOPT_POST, 1 );
                    curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode ( $data ) );
                    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
                    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );

                    $response = curl_exec ( $ch );
                    curl_close ( $ch );

                   $object  =json_decode ($response);
                    if($object->uri) {
                        return response ()->json ( ['success' => true, 'method' => $_REQUEST[ 'paymentOption' ], 'redirect_link' => $object->uri, 'message' => 'Saved successfully.'], 200 );
                    }

                }elseif ($_REQUEST['paymentOption']=='after_pay'){

                    $merchant = new MerchantAccount();
                    $merchant->setMerchantId('44689');
                    $merchant->setSecretKey('7f45a3c8ced3d53fbdcb136a4fe834475d19332952bddeba63fcd9c610f2b52cff991d2f68392e54fc4cd4c2f6482fb9011d912ba42ce3f119935d4c36832c44');

                    $createCheckoutRequest = new AfterpayCreateCheckoutRequest();
                    $createCheckoutRequest->setMerchantAccount($merchant);

                    $origanlbalnce =$amount;
                    $amount = new Money($amount, 'AUD');
                    $consumer = new Consumer();
                    $consumer->setPhoneNumber($learner->phone)
                        ->setGivenNames($learner->name)
                        ->setSurname($learner->name)
                        ->setEmail($learner->email);

                    $redirectConfirmUrl     = url ( '/afterpay/success?appsIds='.$appIds.'&searchId='.$search->id.'&instructor_id='.$search->instructor_id.'&balance='.$origanlbalnce.'&appointment_id='.$appointmetObj->id);
                    $redirectCancelUrl     = url ( '/afterpay/success?appsIds='.$appIds.'&searchId='.$search->id.'&instructor_id='.$search->instructor_id.'&balance='.$origanlbalnce.'&appointment_id='.$appointmetObj->id);
                    //$redirectCancelUrl      = url ( '/afterpay/cancel?appsIds='.$appIds.'&searchId='.$search->id.'&instructor_id='.$search->instructor_id.'&appointment_id='.$appointmetObj->id);

                    // Assuming $startDate and $endDate are your date range variables
                    $startDate = '2023-01-01';
                    $endDate = '2023-12-31';
                    $createCheckoutRequest
                        ->setRequestBody('{"amount":' . json_encode($amount) . ',"consumer":' . json_encode($consumer) . ',"merchant":{"redirectConfirmUrl":"'.$redirectConfirmUrl.'","redirectCancelUrl":"'.$redirectCancelUrl.'"},' .
                            '"dateRange": {"start": "'.$startDate.'", "end": "'.$endDate.'"}}')
                        ->send();

                    $createCheckoutResponse = $createCheckoutRequest->getResponse();
                    $obj = $createCheckoutResponse->getParsedBody();

                   if ($createCheckoutResponse->isSuccessful()) {
                       return response()->json(['success' => true,'method' =>$_REQUEST['paymentOption'],'redirect_link'=>$obj->redirectCheckoutUrl, 'message' => 'Saved successfully.'], 200);
                    } else {
                        $error = $obj;
                    }
                }
            }

            if($status == true){
                return response()->json(['method' =>$_REQUEST['paymentOption'],'redirect_link'=>'','success' => true, 'message' => 'Saved successfully.'], 200);
            }else{
                return response()->json(['success' => false, 'message' => 'Something Went Wrong with payment process. please refresh page and try again!!']);
            }
    }

    function generateRandomOrderID($prefix = 'FIRSTPASS-', $length = 18) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // You can customize the characters as needed
        $randomString = $prefix;

        for ($i = 0; $i < $length - strlen($prefix); $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    function successZipPayRequest(Request $request){
        $learner = auth()->user();

        if (isset($_REQUEST['result']) && $_REQUEST['result']=='approved') {

            $paymentId       =$_REQUEST['checkoutId'];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://global-api.sand.au.edge.zip.co/merchant/checkouts/'.$paymentId.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            $headers = [
                'Authorization: Bearer MSdWDxhMDcBRh1LzU0mLoiISOt0Vduru',
                'Zip-Version: 2021-08-25',
                'Accept: application/json',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);

            $getCheckoutObject  =json_decode ($result);

            $prepareData=[];
            if (is_object($getCheckoutObject)){
                $prepareData=[
                    'authority'=>[
                        'type'=>'checkout_id',
                        'value'=>$paymentId,
                    ],
                    'capture'=>true,
                    'shopper'=>get_object_vars($getCheckoutObject->shopper),
                    'Order'=>[
                        'shipping'=>[
                            'pickup'=>1
                        ]
                    ],
                    'reference'=>$getCheckoutObject->order->reference,
                    'amount'=>$getCheckoutObject->order->amount,
                    'currency'=>$getCheckoutObject->order->currency,
                ];
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://global-api.sand.au.edge.zip.co/merchant/charges');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, '{"authority":{"type":"checkout_id","value":"au-co_7ITRaAhCQ1QCAd7wNXuPAW"},"capture":true,"Order":{"shipping":{"pickup":true}},"reference":"testOrderReference01","amount":"10","currency":"AUD"}');
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($prepareData));

           // curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode ( $object ) );

            $headers = [
                'Authorization: Bearer MSdWDxhMDcBRh1LzU0mLoiISOt0Vduru',
                'Zip-Version: 2021-08-25',
                'Accept: application/json',
                'Content-Type: application/json',
            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response2 = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }

            curl_close($ch);

            $chargeSuccessRequest  =json_decode ($result);

          if (is_object($chargeSuccessRequest)){
              $amount         =$_REQUEST['balance'];
              $app_ids='';
              $searchId = $_REQUEST['searchId'];
              $instructor_id = $_REQUEST['instructor_id'];
              if ($_REQUEST['appsIds']) {
                  $app_ids = explode(',', $_REQUEST['appsIds']);
                  Appointments::whereIn('id', $app_ids)->update(['payment_status' => 1]);
                  $app_ids = $_REQUEST['appsIds'];
              }

              $app_ids        =$_REQUEST['appsIds'];

              $converted = $amount;

              $payment_response = new PaymentResponse();

              $payment_response->charge_id = $paymentId;

              $payment_response->balance_transaction_id =$paymentId;

              $payment_response->amount = $amount;

              $payment_response->converted_amount = $converted;

              $payment_response->currency ='usd';

              $payment_response->created =date('d-m-Y');

              $payment_response->status ='succeeded';

              $payment_response->method = "AfterPay";

              $payment_response->appointment_id = $app_ids;

              $payment_response->response = json_encode($chargeSuccessRequest);

              $payment_response->user_id = \auth()->user()->id;

              $payment_response->search_id =$searchId;

              if ($payment_response->save()) {

                  /*send email to instructor*/

                  $instructor = User::where('id', $instructor_id)->first();

                  if ($instructor) {

                      /* Wallet For Admin and Instructor User */

                      $GetAdminRecord = User::where('type', 'admin')->first();

                      $AdminCommission = 5;

                      $calculated = ($amount * $AdminCommission) / 100;

                      $ToInstructor = $amount - $calculated;

                      $ToAdmin = $calculated;

                      /* Admin Wallet */

                      $GetAdminBalance = Wallet::where('user_id', $GetAdminRecord->id)->first();

                      if ($GetAdminBalance) {

                          $UpdateBalance = $GetAdminBalance->withdrawable + $ToAdmin;

                          Wallet::updateOrCreate(
                              ['user_id' => $GetAdminRecord->id],
                              [
                                  'user_id' => $GetAdminRecord->id,
                                  'withdrawable' => $UpdateBalance,
                              ]);

                      } else {
                          Wallet::updateOrCreate(
                              ['user_id' => $GetAdminRecord->id],
                              [
                                  'user_id' => $GetAdminRecord->id,
                                  'withdrawable' => $ToAdmin,
                              ]);
                      }

                      /* Instructor Wallet */
                      $GetInstructorBalance = Wallet::where('user_id', $instructor_id)->first();

                      if ($GetInstructorBalance) {

                          $UpdateBalance = $GetInstructorBalance->withdrawable + $ToInstructor;

                          Wallet::updateOrCreate(

                              ['user_id' => $instructor_id],

                              [

                                  'user_id' => $instructor_id,

                                  'withdrawable' => $UpdateBalance,

                              ]);
                      } else {
                          Wallet::updateOrCreate(
                              ['user_id' => $instructor_id],
                              [
                                  'user_id' => $instructor_id,
                                  'withdrawable' => $ToInstructor,
                              ]);
                      }


                      $twilio = new TwilioController();
                      /* message to constructor */
                      if($instructor->phone!=''){
                          $inst_message = 'Hi '. ucfirst($instructor->name);
                          $inst_message .= ' We received new appointment request from' . ucfirst($learner->name). " \n ";
                          $inst_message .= 'Appointment date is '.date ('d/m/Y'). " \n";
                          $inst_message .= 'Please visit '.url('/login').' to confirm';
                          //$twilio->sendMessage($inst_message, $instructor->phone);
                      }

                      if($learner->phone!=''){
                          $inst_message = 'This is Payment confirmation message from FirstPass' ."\n";
                          $inst_message .= 'appointment confirmation message will be sent to you.  '. "\n";
                          $inst_message .= 'Please visit '.url('/login').' to check status';
                          // $twilio->sendMessage($inst_message, $learner->phone);
                      }

                      $email_settings = EmailSettings::find(1);
                      $settings = Settings::find(1);
                      /*email to instructor about appointment*/
                      $s = array('%FIRST_NAME%', '%LAST_NAME%', '%EMAIL%', '%PHONE%', '%ADDRESS%', '%BOOK_DATE%');
                      $r = array($instructor->name, $instructor->lname, $instructor->email, $instructor->phone, '', date ('d/m/Y'));
                      $email_body = str_replace($s, $r, $email_settings->appt_body);
                      if ($settings->email_type == 'api') {
                          if ($settings->email_api == 'send_grid') {
                              // sending email to super admin
                              AppTraits::SendgridEmail($email_body, $instructor->email, $email_settings->appt_subject, 'FirstPass', $instructor->name, $settings->sg_email, $settings->sg_apikey);
                          }
                      } else {
                          AppTraits::SmtpEmail($email_body, $instructor->email, $email_settings->appt_subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
                      }
                  }

                  Session::put('success','Your payment successfully completed.');
                  return redirect('/home')->with('success', 'Your payment successfully completed.');
              }
          }
        }
    }

    function successAfterPayRequest(Request $request){
        $learner = auth()->user();

        if (isset($_REQUEST['status']) && $_REQUEST['status']=='SUCCESS') {

            $paymentId = $request->input ( 'orderToken' );

            $merchant = new MerchantAccount();
            $merchant->setMerchantId('44689');
            $merchant->setCountryCode('AU');
            $merchant->setSecretKey('7f45a3c8ced3d53fbdcb136a4fe834475d19332952bddeba63fcd9c610f2b52cff991d2f68392e54fc4cd4c2f6482fb9011d912ba42ce3f119935d4c36832c44');



            $deferredPaymentAuthRequest = new AfterpayDeferredPaymentAuthRequest([
                'token' => urlencode($_GET['orderToken'])
            ]);

            if (!is_null($merchant)) {
                $deferredPaymentAuthRequest
                    ->setMerchantAccount($merchant)
                ;
            }

            $deferredPaymentAuthRequest->send();

            $deferredPaymentAuthResponse = $deferredPaymentAuthRequest->getResponse();
            $obj = $deferredPaymentAuthResponse->getParsedBody();

            $order='';
            if ($deferredPaymentAuthResponse->isSuccessful()) {
                $order = $obj;
            } else {
            }

            if ($order && $order->status=='APPROVED'){

                $amount         =$_REQUEST['balance'];

                $app_ids='';
                $searchId = $_REQUEST['searchId'];
                $instructor_id = $_REQUEST['instructor_id'];
                if ($_REQUEST['appsIds']) {
                    $app_ids = explode(',', $_REQUEST['appsIds']);
                    Appointments::whereIn('id', $app_ids)->update(['payment_status' => 1]);
                    $app_ids = $_REQUEST['appsIds'];
                }

                $app_ids        =$_REQUEST['appsIds'];

                $converted = $amount;

                $payment_response = new PaymentResponse();

                $payment_response->charge_id = $paymentId;

                $payment_response->balance_transaction_id =$paymentId;

                $payment_response->amount = $amount;

                $payment_response->converted_amount = $converted;

                $payment_response->currency ='usd';

                $payment_response->created =date('d-m-Y');

                $payment_response->status ='succeeded';

                $payment_response->method = "AfterPay";

                $payment_response->appointment_id = $app_ids;

                $payment_response->response = json_encode($order);

                $payment_response->user_id = \auth()->user()->id;

                $payment_response->search_id =$searchId;

                if ($payment_response->save()) {

                    /*send email to instructor*/

                    $instructor = User::where('id', $instructor_id)->first();

                    if ($instructor) {

                        /* Wallet For Admin and Instructor User */

                        $GetAdminRecord = User::where('type', 'admin')->first();

                        $AdminCommission = 5;

                        $calculated = ($amount * $AdminCommission) / 100;

                        $ToInstructor = $amount - $calculated;

                        $ToAdmin = $calculated;

                        /* Admin Wallet */

                        $GetAdminBalance = Wallet::where('user_id', $GetAdminRecord->id)->first();

                        if ($GetAdminBalance) {

                            $UpdateBalance = $GetAdminBalance->withdrawable + $ToAdmin;

                            Wallet::updateOrCreate(
                                ['user_id' => $GetAdminRecord->id],
                                [
                                    'user_id' => $GetAdminRecord->id,
                                    'withdrawable' => $UpdateBalance,
                                ]);

                        } else {
                            Wallet::updateOrCreate(
                                ['user_id' => $GetAdminRecord->id],
                                [
                                    'user_id' => $GetAdminRecord->id,
                                    'withdrawable' => $ToAdmin,
                                ]);
                        }

                        /* Instructor Wallet */
                        $GetInstructorBalance = Wallet::where('user_id', $instructor_id)->first();

                        if ($GetInstructorBalance) {

                            $UpdateBalance = $GetInstructorBalance->withdrawable + $ToInstructor;

                            Wallet::updateOrCreate(

                                ['user_id' => $instructor_id],

                                [

                                    'user_id' => $instructor_id,

                                    'withdrawable' => $UpdateBalance,

                                ]);
                        } else {
                            Wallet::updateOrCreate(
                                ['user_id' => $instructor_id],
                                [
                                    'user_id' => $instructor_id,
                                    'withdrawable' => $ToInstructor,
                                ]);
                        }


                        $twilio = new TwilioController();
                        /* message to constructor */
                        if($instructor->phone!=''){
                            $inst_message = 'Hi '. ucfirst($instructor->name);
                            $inst_message .= ' We received new appointment request from' . ucfirst($learner->name). " \n ";
                            $inst_message .= 'Appointment date is '.date ('d/m/Y'). " \n";
                            $inst_message .= 'Please visit '.url('/login').' to confirm';
                            //$twilio->sendMessage($inst_message, $instructor->phone);
                        }

                        if($learner->phone!=''){
                            $inst_message = 'This is Payment confirmation message from FirstPass' ."\n";
                            $inst_message .= 'appointment confirmation message will be sent to you.  '. "\n";
                            $inst_message .= 'Please visit '.url('/login').' to check status';
                            // $twilio->sendMessage($inst_message, $learner->phone);
                        }

                        $email_settings = EmailSettings::find(1);
                        $settings = Settings::find(1);
                        /*email to instructor about appointment*/
                        $s = array('%FIRST_NAME%', '%LAST_NAME%', '%EMAIL%', '%PHONE%', '%ADDRESS%', '%BOOK_DATE%');
                        $r = array($instructor->name, $instructor->lname, $instructor->email, $instructor->phone, '', date ('d/m/Y'));
                        $email_body = str_replace($s, $r, $email_settings->appt_body);
                        if ($settings->email_type == 'api') {
                            if ($settings->email_api == 'send_grid') {
                                // sending email to super admin
                                AppTraits::SendgridEmail($email_body, $instructor->email, $email_settings->appt_subject, 'FirstPass', $instructor->name, $settings->sg_email, $settings->sg_apikey);
                            }
                        } else {
                            AppTraits::SmtpEmail($email_body, $instructor->email, $email_settings->appt_subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
                        }
                    }
                    Session::put('success','Your payment successfully completed.');
                }
            }else{
                Session::put('success','Your payment decliend.');
            }
            return redirect('/home')->with('success', 'Your payment successfully completed.');
        }else{
            return redirect('/home')->with('error', 'Cancel Payment');
        }
    }

    function successPaypalRequest(Request $request){
        $learner = auth()->user();

        $paymentId = $request->input ( 'paymentId' );
        $payerId = $request->input ( 'PayerID' );

        $payment = \PayPal\Api\Payment::get ( $paymentId, $this->apiContext );
        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId ( $payerId );

        try {
            $result = $payment->execute ( $execution, $this->apiContext );
        } catch ( \Exception $e ) {
            return redirect ()->route ( 'paypal.cancel' )->withErrors ( 'Payment failed' );
        }

        if ( $result->getState () == 'approved' ) {

            $createTime = $payment->getCreateTime();
            $transactions   =$payment->getTransactions();
            $transaction    =$transactions[0]; // Assuming there's only one transaction
            $amount         = $transaction->getAmount()->getTotal();

            $app_ids='';
            $searchId = $_REQUEST['searchId'];
            $instructor_id = $_REQUEST['instructor_id'];
            if ($_REQUEST['appsIds']) {
                $app_ids = explode(',', $_REQUEST['appsIds']);
                Appointments::whereIn('id', $app_ids)->update(['payment_status' => 1]);
                $app_ids = $_REQUEST['appsIds'];
            }

            $converted = $amount;

            $payment_response = new PaymentResponse();

            $payment_response->charge_id = $paymentId;

            $payment_response->balance_transaction_id = $result->id;

            $payment_response->amount = $amount;

            $payment_response->converted_amount = $converted;

            $payment_response->currency ='usd';

            $payment_response->created = $createTime;

            $payment_response->status ='succeeded';

            $payment_response->method = "Paypal";

            $payment_response->appointment_id = $app_ids;

            $payment_response->response = json_encode($result);

            $payment_response->user_id = \auth()->user()->id;

            $payment_response->search_id =$searchId;

            if ($payment_response->save()) {

                $instructor = User::where('id', $instructor_id)->first();

                if ($instructor) {

                    /* Wallet For Admin and Instructor User */

                    $GetAdminRecord = User::where('type', 'admin')->first();

                    $AdminCommission = 5;

                    $calculated = ($amount * $AdminCommission) / 100;

                    $ToInstructor = $amount - $calculated;

                    $ToAdmin = $calculated;

                    /* Admin Wallet */

                    $GetAdminBalance = Wallet::where('user_id', $GetAdminRecord->id)->first();

                    if ($GetAdminBalance) {

                        $UpdateBalance = $GetAdminBalance->withdrawable + $ToAdmin;

                        Wallet::updateOrCreate(
                            ['user_id' => $GetAdminRecord->id],
                            [
                                'user_id' => $GetAdminRecord->id,
                                'withdrawable' => $UpdateBalance,
                            ]);

                    } else {
                        Wallet::updateOrCreate(
                            ['user_id' => $GetAdminRecord->id],
                            [
                                'user_id' => $GetAdminRecord->id,
                                'withdrawable' => $ToAdmin,
                            ]);
                    }

                    /* Instructor Wallet */
                    $GetInstructorBalance = Wallet::where('user_id', $instructor_id)->first();

                    if ($GetInstructorBalance) {

                        $UpdateBalance = $GetInstructorBalance->withdrawable + $ToInstructor;

                        Wallet::updateOrCreate(

                            ['user_id' => $instructor_id],

                            [

                                'user_id' => $instructor_id,

                                'withdrawable' => $UpdateBalance,

                            ]);
                    } else {
                        Wallet::updateOrCreate(
                            ['user_id' => $instructor_id],
                            [
                                'user_id' => $instructor_id,
                                'withdrawable' => $ToInstructor,
                            ]);
                    }


                    /* send confirmation SMS */
//                    if($time_slot!=''){
//                        $schedule_date = $schedule_date[0].' '. $time_slot[0];
//                    }

                    $twilio = new TwilioController();
                    /* message to constructor */
                    if($instructor->phone!=''){
                        $inst_message = 'Hi '. ucfirst($instructor->name);
                        $inst_message .= ' We received new appointment request from' . ucfirst($learner->name). " \n ";
                        $inst_message .= 'Appointment date is '.date ('d/m/Y'). " \n";
                        $inst_message .= 'Please visit '.url('/login').' to confirm';
                        //$twilio->sendMessage($inst_message, $instructor->phone);
                    }

                    if($learner->phone!=''){
                        $inst_message = 'This is Payment confirmation message from FirstPass' ."\n";
                        $inst_message .= 'appointment confirmation message will be sent to you.  '. "\n";
                        $inst_message .= 'Please visit '.url('/login').' to check status';
                        // $twilio->sendMessage($inst_message, $learner->phone);
                    }

                    $email_settings = EmailSettings::find(1);
                    $settings = Settings::find(1);
                    /*email to instructor about appointment*/
                    $s = array('%FIRST_NAME%', '%LAST_NAME%', '%EMAIL%', '%PHONE%', '%ADDRESS%', '%BOOK_DATE%');
                    $r = array($instructor->name, $instructor->lname, $instructor->email, $instructor->phone, '', date ('d/m/Y'));
                    $email_body = str_replace($s, $r, $email_settings->appt_body);
                    if ($settings->email_type == 'api') {
                        if ($settings->email_api == 'send_grid') {
                            // sending email to super admin
                            AppTraits::SendgridEmail($email_body, $instructor->email, $email_settings->appt_subject, 'FirstPass', $instructor->name, $settings->sg_email, $settings->sg_apikey);
                        }
                    } else {
                        AppTraits::SmtpEmail($email_body, $instructor->email, $email_settings->appt_subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
                    }


                }

                Session::put('success','Your payment successfully completed.');
                return redirect('/home')->with('success', 'Your payment successfully completed.');
            }
        }
    }



    function check_search_status($search_id){

        if( Appointments::where('search_id', $search_id)->exists() ){

            return true;

        }

        return false;

    }



    function load_events(Request $request){



        if($request->type == 'check_availability'){

            $appointments = Appointments::where('instructor_id', $request->id)

                ->select('id', 'schedule_date', 'time_slot', 'type')

                ->where('status', '!=', 'cancelled')

                ->where('time_slot', '!=', '')

                //->where('is_private', 0)

                ->whereDate('schedule_date','>=', Carbon::now()->format('Y-m-d'))

                ->get();

            $events=[];

            foreach ($appointments as $appointment)

            {

                $lesson_hr = $appointment->lesson_hour;



                $timeSlot_start = explode('-', $appointment->time_slot);

                $timeSlot_end = explode('-', $appointment->time_slot);

                if($appointment->type=="test")

                { $date_start = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_start[0])->subHour();
                 $date_end = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_end[1])->addMinutes(30);

                }

                else{
                 $date_start = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_start[0]);
                 $date_end = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_end[1]);
                 }



                $start = $date_start->format('Y-m-d H:i');









                $end = $date_end->format('Y-m-d H:i');
                //exit;


                //$end = $date->addHours($lesson_hr)->format('Y-m-d H:i');



                $events[] = [

                    "groupId" => "testGroupId",

                    "start" => $start,

                    "end" => $end,

                    "rendering" => "background",

                    "color" => "#000000",

                ];

            }



            $avl = [];

            $get_timess = WorkingTime::where(['user_id' => $request->id, 'is_enabled' => 'yes'])->get();



            foreach($get_timess as $get_times)

            {

                if($get_times->day=='sunday'){ $num = 0; }

                elseif($get_times->day=='monday'){ $num = 1; }

                elseif($get_times->day=='tuesday'){ $num = 2; }

                elseif($get_times->day=='wednesday'){ $num = 3; }

                elseif($get_times->day=='thursday'){ $num = 4; }

                elseif($get_times->day=='friday'){ $num = 5; }

                elseif($get_times->day=='saturday'){ $num = 6; }



                $av_time = json_decode($get_times->data);

                foreach ($av_time as $v) {

                        $start_time = $v->start_hour . ':' . $v->start_min;

                        $end_time = $v->end_hour . ':' . $v->end_min;

                    }



                $avl[] = [

                            'daysOfWeek' => [$num],

                            'startTime' => $start_time,

                            'endTime' => $end_time,

                        ];

            }





            //echo "<pre>";

            //print_r($get_times); die;



            return response()->json(['events' => $events, 'avl' => $avl]);

        }

    }



    public function view_instructors(Request $request, $id=false){

        $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')

            ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.preferred_name', 'users.phone', 'users.gender', 'users.avatar')

            ->where(['users.type' => 'inst', 'users.status' => 1]);

        if($id){

            $users = $users->where('users.id',$id);

        }

        $users= $users->get();

        $total = $users->count();

        /*save search*/

        $ip = $request->getClientIp();

        $prev = url()->previous();



        $search_check = Search::join('appointments', 'appointments.search_id', 'search.id')

            ->where(['search.learner_id' => Auth::id()])

            ->where('search.region_id', '!=', '')

            ->orderBy('appointments.id', 'desc')

            ->first();

        if( $search_check){

            $search =  Search::create(

                ['ip' => $ip, 't_type' => 'both', 'region_id' => $search_check->region_id, 'learner_id' => Auth::id()]

            );

            $search_id = $search->id;

            $region = Region::find($search_check->region_id);

            return redirect('instructors/search_id/'.$search_id.'')->with('success', 'Thanks for contact with us');

          //  return $view = view('search.book_more', compact('region','search_id', 'search','users', 'total'));

        }else{

            abort('404');

        }

    }



    public function create_search_from_learner(Request $request)

    {

        if ($_REQUEST['credit']>0){
            $ip = $request->getClientIp();

            $learner = $request->learner_id;

            $search_check = Search::join('appointments', 'appointments.search_id', 'search.id')

                ->where(['search.learner_id' => $learner])

                ->where('search.region_id', '!=', '')

                ->orderBy('appointments.id', 'desc')

                ->first();

            $showPopup=false;

            $startPackage=0;
            $selectionType=["lesson"];
            if ($_REQUEST['credit']>4){
                $selectionType=["lesson","test"];
                $startPackage=1;
            }

            $getCalcuatedData=$this->calcuateSum($_REQUEST['credit'],70);

            $test = \App\TestPackage::first();

            $search_data =
                [
                    "total" =>$getCalcuatedData['total'],
                    'discount' =>$getCalcuatedData['discount'],
                    'hour' => $_REQUEST['credit'],
                    'hourly_rate' =>70,
                    'test_price'  =>$test->price
                ];

            $search =  Search::create(

                ['ip' => $ip,
                   'step_2' =>json_encode($selectionType),
                   'step_3' =>json_encode($search_data),
                    'start_package' =>$startPackage,
                    't_type' => 'both',
                    'instructor_id'=>$search_check->instructor_id,
                    'region_id' => $search_check->region_id,
                    'learner_id' => $learner,
                    'redirect_track'=>1
                ]
            );

            $search_id = $search->id;

            return response()->json(['search_id' => $search_id]);
        }else{
            return response()->json(['error' => '']);
        }



    }

    public function calcuateSum($qty,$price){
        $totalAmount           =$qty*$price;
        $discount=0;

        if($qty<6) {
            $totalAmount = $price*$qty;
        }else if($qty >5 && $qty < 10 ){
             $calcualtedData =$price*$qty;
             $pkg = floor( ($calcualtedData*5)/100);
             $totalAmount = $calcualtedData-$pkg;
             $discount=5;
        }else if($qty >=10 && $qty < 20 ){
            $calcualtedData =$price*$qty;
            $pkg = floor( ($calcualtedData*10)/100);
            $totalAmount = $calcualtedData-$pkg;
            $discount=10;
        }else if($qty >=20 && $qty < 50 ){
            $calcualtedData =$price*$qty;
            $pkg = floor( ($calcualtedData*12.5)/100);
            $totalAmount = $calcualtedData-$pkg;
            $discount=12.5;
        }else if($qty >=50 && $qty < 75 ){
            $calcualtedData =$price*$qty;
            $pkg = floor( ($calcualtedData*15)/100);
            $totalAmount = $calcualtedData-$pkg;
            $discount=15;
        }else if($qty >=75 && $qty <= 100 ){
            $calcualtedData =$price*$qty;
            $pkg = floor( ($calcualtedData*20)/100);
            $totalAmount = $calcualtedData-$pkg;
            $discount=20;
        }
        $data=[
            'total'=>$totalAmount,
            'discount'=>$discount,
        ];

        return $data;
    }




    public function register_inst(Request $request)

    {

        $email_settings = DB::table('email_settings')->where("id",1)->first();

        $settings = Settings::where('id',1)->first();

        $admin = DB::table('users')->where("type",'admin')->first();





        $body = '

        <p class="p1"><span class="s1">Hi '.$request->name.',</span></p>

        <p class="p1"><span class="s1"><br />Welcome to FirstPass!</span></p>

        <p class="p1"><span class="s1">Your credentials has been sent to admin for review. You will get notification as soon as possible.</span></p>

        <p class="p1"><span class="s1">&nbsp;</span></p>

        <p class="p1"><span class="s1">Thanks,</span></p>

        <p>&nbsp;</p>

        <p class="p1"><span class="s1">Need support help? Email us: '.$admin->email.'</span></p>

        ';



        $body1 = '

        <p class="p1"><span class="s1">Hi admin,</span></p>

        <p class="p1"><span class="s1"><br />A new user has been registered as Instructor.</span></p>

        <p class="p1"><span class="s1">See the details in below.</span></p>

        <p class="p1"><span class="s1">&nbsp;</span></p>

        <p class="p1"><span class="s1">First Name: '.$request->name.'</span></p>

        <p class="p1"><span class="s1">Last Name: '.$request->lname.'</span></p>

        <p class="p1"><span class="s1">Email: '.$request->email.'</span></p>

        <p class="p1"><span class="s1">Phone: '.$request->phone.'</span></p>

        <p class="p1"><span class="s1">Post Code: '.$request->postcode.'</span></p>

        <p class="p1"><span class="s1">Vehicle transmission/s: '.$request->vehicle_transmissions.'</span></p>

        <p class="p1"><span class="s1">Message: '.$request->message.'</span></p>

        <p class="p1"><span class="s1">&nbsp;</span></p>

        <p class="p1"><span class="s1">Thanks,</span></p>

        <p>&nbsp;</p>

        <p class="p1"><span class="s1">Need support help? Email us: '.$admin->email.'</span></p>

        ';



        if($settings->email_type=='api')

        {

            if($settings->email_api=='send_grid'){

                //$body,$to,$subject,$from_name,$to_name,$from_email,$apikey // sending email to user

                AppTraits::SendgridEmail($body,

                   $request->email,

                    $email_settings->confirm_subject,'FirstPass',

                    $request->name.' '. $request->lname, $settings->sg_email,$settings->sg_apikey);



                /* to super admin */

                AppTraits::SendgridEmail($body1,

                    $admin->email,

                    $email_settings->newuser_subject,'FirstPass',

                    $request->name.' '. $request->lname, $settings->sg_email,$settings->sg_apikey);



            }

        }

        else

        {

            // sending email to user

            AppTraits::SmtpEmail(

                $body,

                $request->email,

                $email_settings->confirm_subject,

                $settings->smtp_from_name,

                $request->name.' '. $request->lname,

                $settings->smtp_username,

                $settings->smtp_password,

                $settings->smtp_host,

                $settings->smtp_port,

                $settings->smtp_femail,

                $settings->use_ssl



            ); /// sending email to user



            // sending email to super admin

           AppTraits::SmtpEmail(

                $body1,

                "theitobjects@gmail.com",

                $email_settings->confirm_subject,

                $settings->smtp_from_name,

                "super admin",

                $settings->smtp_username,

                $settings->smtp_password,

                $settings->smtp_host,

                $settings->smtp_port,

                $settings->smtp_femail,

                $settings->use_ssl

            );  // sending email to super admin

        }



        return response()->json(['success' => true, 'message' => 'Successfully sent your data to review.']);

    }



    public function searchInstructors($search_id)

    {

        $search_data = Search::findOrFail($search_id);

        $region = Region::select('title', 'id')->whereId($search_data->region_id)->first();

        if($region) {


            if (isset($_REQUEST['type']) && $_REQUEST['type']=='package'){
                if($_REQUEST['test_location'] == 'any') {
                    $available_users_r = UserTestLocations::pluck('user_id');
                }else{
                    $available_users_r = UserTestLocations::where('location_id', $_REQUEST['test_location'])->pluck('user_id');
                }
            }else{
                $available_users_r = ServiceRegions::where('region_id', $search_data->region_id)->pluck('user_id');
            }


            if ($available_users_r->isEmpty()) {
                $available_users_r=[];
            }


            $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')

                ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar', 'users.preferred_name', 'users.phone', 'users.gender')

                ->whereIn('users.id', $available_users_r)

                ->whereIn("user_meta.transmission_type",['both',$search_data->t_type])

                ->where(['users.type' => 'inst', 'users.status' => 1]);

            //   echo "<pre>";print_r($users->get());die();

            if (isset($_REQUEST['type']) && $_REQUEST['type']=='package') {
                if (isset($_REQUEST['test_type'])) {
                    if ($_REQUEST['test_type']==1){
                        $users = $users->where('user_meta.check_test_with_cust',1);
                    }else{
                        $users = $users->where('user_meta.check_test_with_cust',0);
                    }

                }
            }


            $users = $users->get();

            $total = $users->count();

            $title = $region->title;

            $t_type = $search_data->t_type;

            return view('search.result', compact('users','region','search_id','total','title','t_type'));

        }else{

            return response()->json(['success' => false, 'message' => 'Result not found!']);

        }

    }



    public function searchFilter($search_id, Request $request){

        // return response()->json(['success' => $request->all]);

        $search_data = Search::findOrFail($search_id);

        $region = Region::select('title', 'id')->whereId($search_data->region_id)->first();

        if($region) {

            if (isset($_REQUEST['type']) && $_REQUEST['type']=='package'){
                if($_REQUEST['test_location'] && $_REQUEST['test_type']==1){
                    if($_REQUEST['test_location'] == 'any') {
                        $available_users_r = UserTestLocations::pluck('user_id');
                    }else{
                        $available_users_r = UserTestLocations::where('location_id', $_REQUEST['test_location'])->pluck('user_id');
                    }
                }else{
                    $available_users_r = ServiceRegions::where('region_id', $search_data->region_id)->pluck('user_id');
                }
            }else{
                $available_users_r = ServiceRegions::where('region_id', $search_data->region_id)->pluck('user_id');
            }

            $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')

                ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar', 'users.preferred_name', 'users.phone', 'users.gender')

                ->whereIn('users.id', $available_users_r)

                ->whereIn("user_meta.transmission_type",['both',$search_data->t_type])

                ->where(['users.type' => 'inst', 'users.status' => 1]);


            if($request->gender){
                $users = $users->where('users.gender', $request->gender);
            }

            if (isset($_REQUEST['type']) && $_REQUEST['type']=='package') {
                if (isset($_REQUEST['test_type'])) {
                    if ($_REQUEST['test_type']==1){
                        $users = $users->where('user_meta.check_test_with_cust',1);
                    }else{
                        $users = $users->where('user_meta.check_test_with_cust',0);
                    }

                }
            }


            if($request->availability!="" || $request->time != ""){
                $users = $users->rightJoin('working_time', 'working_time.user_id', '=', 'users.id');
            }


            if($request->availability){
                $availableDays = [];
                if($request->availability == "weekdays"){
                    $availableDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
                }
                else{
                    $availableDays = ['sunday', 'saturday'];
                }

                $users = $users->where(function($qry) use ($request, $availableDays){
                    $qry->whereIn('working_time.day', $availableDays);
                    $qry->where('working_time.is_enabled', 'yes');
                });
            }

            if($request->time != "" && $request->time != "any"){
                if($request->time == "am"){
                    // $users = $users->where(DB::raw("JSON_EXTRACT(data '$.start_hour')", '<', 12);
                    $users = $users->whereRaw("CAST(TRIM(BOTH '\"' FROM left(right(JSON_EXTRACT(`working_time`.`data`, '$[*].start_hour'),5),4)) AS UNSIGNED)<12");
                }
                else{
                    // $users = $users->where(DB::raw("JSON_EXTRACT(data '$.start_hour')", '<', 12);
                    $users = $users->whereRaw("CAST(TRIM(BOTH '\"' FROM left(right(JSON_EXTRACT(`working_time`.`data`, '$[*].end_hour'),5),4)) AS UNSIGNED)>=12");
                }
                //whereJsonContains('to', [['emailAddress' => ['address' => 'test@example.com']]]);
            }


            if($request->date != ""){

            }

            $users->groupBy('users.id');
            $users = $users->get();
            return response()->json(['success' => true, 'message' => $users]);


        }else{

            return response()->json(['success' => false, 'message' => 'Result not found!']);

        }

    }

    public function relogin(Request $request)
    {
        $currentUrl = url()->previous();
        Session::put('prev_url',$currentUrl);
        return redirect('/login');
    }

}

