<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\competition;
use App\Notification;
use App\User;

use App\Http\Controllers\Api\ApiJourneyPlanController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Services\PayUService\Exception;
use DateTime;

class ApiNotificationController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;

    public function notification_pageurl_details($title)
    {
        $res = "";
         if($title == "Leave request from merchandiser"     ||
           $title == "Leave request from field manager"     ||
           $title == "HR accept merchandiser leave request" ||
           $title == "HR reject merchandiser leave request")
          $res = "leaves";

        else if($title == "Merchandiser CheckIn In Outlet"     ||
                 $title == "Merchandiser CheckOut In Outlet"   ||
                 $title == "Merchandiser update availability"  ||
                 $title == "Merchandiser update visibility"    ||
                 $title == "Merchandiser update shareof_shelf" ||
                 $title == "Merchandiser update planogram"     ||
                 $title == "Merchandiser update competitor"    ||
                 $title == "Merchandiser update promotion")
           $res = "defined-outlets";

        else if($title == "Merchandiser update stock export")
          $res = "stock_report";

        else if($title == "Fieldmanager added scheduled timesheet")
          $res = "timesheet";

        else if($title == "Fieldmanager added unscheduled timesheet")
          $res = "date_timesheet"; 

        else if($title == "Field Manager accept your leave request and waiting for HR approval"
             || $title == "Field Manager reject your leave request"
             || $title == "HR accept your leave request")
          $res = "leaverequest";

         return $res;  

    } 

    public function add_notification($title, $user_type, $ReportToID)
    {

      $ip = \Request::ip(); // dd($ip);
       // Use JSON encoded string and converts
      // it into a PHP variable
      $ipdat = "Not Avalilable";
      //@json_decode(file_get_contents(
        //  "http://www.geoplugin.net/json.gp?ip=" . $ip));
      

        $dt = new DateTime();
        $time =  $dt->format('H:i:s');
       // dd($time);
        $page_url = $this->notification_pageurl_details($title);

         $res =	DB::table('notifiation_details')->insert(
            array(
                'title'   =>   $title, 
                'date'   =>  date('y-m-d'),
                'time'   =>   $time,
                'created_by'   =>   Auth::user()->emp_id,
                'user_type' => $user_type,
                'created_to' => $ReportToID,
                'page_url' => $page_url,
                'read_at'   =>   1,
                'viwed_at'   =>   1,
                'is_active'   =>   1,
                'updated_at' => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s'),
                'device' => "Mobile",
              //  'ip_address' => $ip,
                'country' => "Not Found"
                ) 
        ); 

        if($page_url == "timesheet" || $page_url == "date_timesheet")
        {
          $description = "Scheduled JP Added";
          if($page_url == "date_timesheet")
          $description = "Unscheduled JP Added";
          
        //  $user = User::where('emp_id', $ReportToID)->get();
        //  $main_description = "To". "" .$user->name. " " .'('.$user->emp_id.')'. " " .$description;
         // $this->add_audit_trails($main_description, "journey_plan");
        }
   
         return  $res;
        }


        public function add_audit_trails($description, $type)
        {
    
          $ip = \Request::ip(); // dd($ip);
          $ipdat = 'Not Found'; //@json_decode(file_get_contents(
             // "http://www.geoplugin.net/json.gp?ip=" . $ip));
          
            $dt = new DateTime();
            $time =  $dt->format('H:i:s');
            
            if($description == "Logged In")
            { 

              $myarray = array($type);
              $type = $myarray[0]["type"]; 
              $name =   $myarray[0]["emp_name"];
              $role = $myarray[0]["role_name"]; 
              $role_id = $myarray[0]["role_id"]; 
              $emp_id = $myarray[0]["emp_id"]; 
              $description = $name. " " .'('.$emp_id.'/'.$role.')'. " " .$description;
            }
            else
            {

              $emp_id = Auth::user()->emp_id;
              $name = Auth::user()->name;
              $role = Auth::user()->role->name;
              $role_id = Auth::user()->role_id;
              $description = $name. " " .'('.$emp_id.'/'.$role.')'. " " .$description;

            }
            
             $res =	DB::table('audit_trial_details')->insert(
                array( 
                    
                    'date'   =>  date('y-m-d'),
                    'time'   =>   $time,
                    'type'   =>   $type,
                    'description'   =>  $description, 
                    'ip_address' => $ip,
                    'country' =>     "Not Found",
                    'device' => "Mobile",
                    'status' => "success",
                    'role_id'   =>  $role_id,
                    'created_by'   => $emp_id,
                    'is_active'   =>   1,
                    'updated_at' => date('y-m-d H:i:s'),
                    'created_at' => date('y-m-d H:i:s'),
                   // 'employee_id' => Auth::user()->emp_id,
                   
                    )
            ); 
       
             return  $res;
            }


            public function add_audit_trails_mobile(Request $request)
            {
                 
              $user  =  Auth::user();  
              $date = date('Y'); 
              $printReport = new ApiJourneyPlanController();
              $chk =  $printReport->chech_auth($user);
         
              if($chk == false) 
              return $printReport->auth_error_msg(); 
              
              $validator     =   Validator::make($request->all(), [
                "description" =>  "required",
                "ip_address" =>  "required",
                "type" =>  "required",
                "country" =>  "required",
               ]); 
    
              if($validator->fails()) {
               return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
           } 
             
              
                 $dt = new DateTime();
                 $time =  $dt->format('H:i:s');
                
                  $emp_id = Auth::user()->emp_id;
                  $name = Auth::user()->name;
                  $role = Auth::user()->role->name;
                  $role_id = Auth::user()->role_id;
               //   $description = $name.'('.$emp_id.'/'.$role.')'.$description;
                  $ip = \Request::ip();
                
                 $result =	DB::table('audit_trial_details')->insert(
                    array(
                        
                        'date'   =>  date('y-m-d'),
                        'time'   =>   $time,
                        'type'   =>    $request->type,
                        'description'   =>  $request->description, 
                        'ip_address' =>  $ip,
                        //'country' =>  $request->country,
                        'device' => "Mobile",
                        'status' => "success",
                        'role_id'   =>  $role_id,
                        'created_by'   => $emp_id,
                        'is_active'   =>   1,
                        'updated_at' => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s'),
                       // 'employee_id' => Auth::user()->emp_id,
                       
                        )
                ); 
           
                return $printReport->send_result_msg($this->success_status, $result);
                }

    public function view_notification_details(Request $request)
    {
      $user  =  Auth::user();  
      $date = date('Y'); 
      $printReport = new ApiJourneyPlanController();
      $chk =  $printReport->chech_auth($user);
 
      if($chk == false) 
      return $printReport->auth_error_msg();  

      $matchThese = ['is_active' => '1'];
    
      $result =  Notification::where($matchThese)
        ->orderBy('date', 'desc') 
        ->where('created_to', Auth::user()->emp_id)
        ->where('viwed_at', 1)
        ->select('id', 'title', 'date', 'time' , 'created_by', 'user_type', 'created_to')
        ->with([
			'employee'  => function($query) {
				$query->select(['employee_id','first_name']);
			}
      ])
      ->get(); 

   /*   $result = DB::table('notifiation_details')
      ->select(['id', 'title', 'date', 'time' , 'created_by', 'user_type', 'created_to',
      'read_at'])
            ->where($matchThese)
            ->orderBy('date', 'desc') 
           //  ->take(5) 
            ->where('created_to', Auth::user()->emp_id)
            ->where('viwed_at', 1)
            ->get();  */
      

      return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function make_notification_all_viewed(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            "notification_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->notification_id;

    $matchThese = ['is_active' => '1'];

    $id = $request->notification_id;
   // $items = (string)$id;
   // $value = rtrim($id, ',');
   $str = implode(',', $id); 
    $array = explode(',', $str);   

    $result = Notification::whereIn('id', $array)->update(['viwed_at' => '0', 'read_at' => '0', 'updated_at' => date('y-m-d H:i:s')]);

    return $printReport->send_result_msg($this->success_status, $result);

    }

    public function make_notification_viewed(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg(); 

        // validation
        $validator     =   Validator::make($request->all(), [
            "notification_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->notification_id;   // 

    $matchThese = ['is_active' => '1'];

    $result = DB::table('notifiation_details')
    ->where('id', $id)->update(['viwed_at' => '0', 'read_at' => '0', 'updated_at'   => date('y-m-d H:i:s')]);

    return $printReport->send_result_msg($this->success_status, $result);

    }

    public function view_audit_trails_details(Request $request)
    {
    $timesheet_id  = $request->timesheet_id ; 
    $user   =  Auth::user();
    $date = \Carbon\Carbon::now()->format('Y-m-d');

    $printReport = new ApiJourneyPlanController();
    $chk =  $printReport->chech_auth($user);

    if($chk == false)
    return $printReport->auth_error_msg();

    $validator      =   Validator::make($request->all(), [
        "from_date" =>  "required",
        "to_date" =>  "required",
    ]);

        if($validator->fails()) {
          return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
      } 

    $matchThese = ['is_active' => '1'];

    $from = date("Y-m-d", strtotime($request->from_date)); 
    $to = date("Y-m-d", strtotime($request->to_date)); 

    $result = DB::table('audit_trial_details')
    ->select('ip_address','country','description','status','device','created_at')
    ->whereBetween('date', [$from, $to])
    ->where($matchThese)->get();

      return $printReport->send_result_msg($this->success_status, $result);

    }
}
