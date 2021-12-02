<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan; 
use App\Outlet;
use App\Employee_Reporting_To;

use App\Leaverequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Services\PayUService\Exception;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController; 

class ApiOutletController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
  /*  public function show($id)
    {
	    $outlet = Outlet::find($id);
        return view('outlet.show',['outlet' => $outlet]);
    }
 */

    public $success_status = 200;
    public function outlet_details(Request $request, Outlet $modal)
    {
        $outlet_id = $request->outlet_id; 
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        if($outlet_id == "")
        $matchThese = ['is_active' => '1'];
        else
        $matchThese = ['is_active' => '1', 'outlet_id' => $outlet_id];

        $result = Outlet::where($matchThese)->with('store')->get();

         //   return response()->json($result);
            
         return $printReport->send_result_msg($this->success_status, $result);

    }

    public function add_outlet(Request $request, Outlet $model)
    {
        
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
           "outlet_name" =>  "required",
           'outlet_lat'=>'required',
           'outlet_long'=>'required',
           'outlet_area'=>'required',
           'outlet_city'=>'required',
           'outlet_state'=>'required',
           'outlet_country'=>'required',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

        //  $result = $model->create($request->all());
        
            $result =   DB::table('outlet')->insert(
            array(
            'outlet_name'   => $request->outlet_name,
            'outlet_lat'   => $request->outlet_lat,
            'outlet_long'   => $request->outlet_long,
            'outlet_area'   => $request->outlet_area,
            'outlet_city'   => $request->outlet_city,
            'outlet_state'   =>  $request->outlet_state,
            'outlet_country'   =>  $request->outlet_country,
            'created_at' => date('y-m-d H:i:s')
            )); 

            $notify = new ApiNotificationController();
		     $add_notify =  $notify->add_audit_trails("Outlet Created", "outlet");

            return $printReport->send_result_msg($this->success_status, $result);
      
      
    }

    public function update_outlet(Request $request, Outlet $model)
    {
        $user  =  Auth::user();
	   $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
           "outlet_id" =>  "required",
           "outlet_name" =>  "required",
           'outlet_lat'=>'required',
           'outlet_long'=>'required',
           'outlet_area'=>'required',
           'outlet_city'=>'required',
           'outlet_state'=>'required',
           'outlet_country'=>'required',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

        //  $result = $model->create($request->all());
        
            $result = DB::table('outlet')
            ->where('outlet_id',  $request->outlet_id)
            ->update([
            'outlet_name' => $request->outlet_name,
            'outlet_lat' => $request->outlet_lat,
            'outlet_long' => $request->outlet_long,
            'outlet_area' => $request->outlet_area,
            'outlet_city' => $request->outlet_city,
            'outlet_state' => $request->outlet_state,
            'outlet_country' => $request->outlet_country,
            'updated_at' => date('y-m-d H:i:s')
           ]);

           $notify = new ApiNotificationController();
           $add_notify =  $notify->add_audit_trails("Outlet Updated", "outlet");

            return $printReport->send_result_msg($this->success_status, $result);
      
    }

    public function check_in_out(Request $request, Leaverequest $modal)
    {
        $input          =           $request->all();
        $user           =           Auth::user();
        $id             =           $request->id;
        //$request->type  =           "";
        if(!is_null($user)) {

            // validation
            $validator      =       Validator::make($request->all(), [
                "id"           =>      "required",
            ]);

            if($validator->fails()) {
                return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
            }

            if($request->checkin_time != "")
             {
            // update post
            
          //  $check =  DB::table('merchant_time_sheet')->where('id', $id)->whereNull('checkin_time')->count();
           // if($check == 0 || $request->type == "change")
           // {
                    $update       =      DB::table('merchant_time_sheet')
                    ->where('id', $id)
                    ->update([//'employee_id' => $request->employee_id,
                    'checkin_time' => $request->checkin_time,
                    "checkin_location"   =>  $request->checkin_location,
                    'updated_at'=>date('y-m-d H:i:s')]); 

                    $notify = new ApiNotificationController();
                    $ReportToID = "Emp5906"; 
                    $user = Auth::user()->emp_id; 
                    $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
                    if( $ReportTo != "")
                    $ReportToID = $ReportTo->reporting_to_emp_id; 
                    $title = "Merchandiser CheckIn In Outlet";
                    $user_type = "merchandiser";
                    $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);
              //  }

              $timesheet_outlet_id =   DB::table('merchant_time_sheet')
              ->where('id', $id)->get();
       
              $stores_outlet_id =   DB::table('outlet')
              ->select('store_details.*')
              ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
              ->where('outlet_id', $timesheet_outlet_id[0]->outlet_id)
              ->get();
       
              $storename = $stores_outlet_id[0]->store_name;     

            $notify = new ApiNotificationController();
		$description = "Check_In -> " .$request->checkin_time . " - " .$storename. ". Timesheet ID : " .$id. " & Location :" .$request->checkin_location ;
		$add_notify =  $notify->add_audit_trails($description, "Check_In");
        
          }   
          if($request->checkout_time != "")
          {
            // update post 
           // $check =  DB::table('merchant_time_sheet')->where('id', $id)
           // ->whereNull('checkout_time')->count();
           // if($check == 0 || $request->type == "change")
           // {
                $update       =   DB::table('merchant_time_sheet')
                ->where('id', $id)
                ->update([//'employee_id' => $request->employee_id,
                'checkout_time' => $request->checkout_time,
                "checkout_location"  =>  $request->checkout_location,
                "is_completed" => '1',
                'updated_at'=>date('y-m-d H:i:s')]); 
    
                $notify = new ApiNotificationController();
                $ReportToID = "Emp5906";
                $user = Auth::user()->emp_id;
                $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
                if( $ReportTo != "")
                $ReportToID = $ReportTo->reporting_to_emp_id; 
                $title = "Merchandiser CheckOut In Outlet";
                $user_type = "merchandiser";
                $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

                $timesheet_outlet_id =   DB::table('merchant_time_sheet')
                ->where('id', $id)->get();
         
                $stores_outlet_id =   DB::table('outlet')
                ->select('store_details.*')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                ->where('outlet_id', $timesheet_outlet_id[0]->outlet_id)
                ->get();
         
                $storename = $stores_outlet_id[0]->store_name;   

            $notify = new ApiNotificationController();
		$description = "Check_Out -> " .$request->checkout_time . " - " .$storename. ". Timesheet ID : " .$id. " & Location :" .$request->checkout_location;
		$add_notify =  $notify->add_audit_trails($description, "Check_Out");
           // }
       }  

     
    //Outlet::with('store')->where('outlet_id', $timesheet_outlet_id[0]->outlet_id)->get();

   // $storename =  $stores->store[0]->store_name;


       return response()->json(["status" =>  $this->success_status, "success" => true]);

    }
    else {
        return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    }  
}   

   
         


  // }


   /* public function merchant_time_sheet(Request $request)

    {
    
    	
        $user           =           Auth::user();

        if(!is_null($user)) { 
            $validator      =           Validator::make($request->all(),
                [
                    "date"         =>      "required",
                    "employee_id"   =>      "required",
                    "outlet_id"   =>      "required",
                    "checkin_time"   =>      "required",
                  
                ]
            );

            if($validator->fails()) {
                return response()->json(["validation_errors" => $validator->errors()]);
            }

            $post_array         =      
             array(
                "date"         =>      $request->date,
                "employee_id"   =>      $request->employee_id,
                "outlet_id"       =>      $user->outlet_id,
                "checkin_time"       =>      $user->checkin_time
            );
  


            $post           =	DB::table('merchant_time_sheet')->insert(
                array(
                    "date"         =>      $request->date,
                    "employee_id"   =>      $request->employee_id,
                    "outlet_id"       =>      $user->outlet_id,
                    "checkin_time"       =>      $user->checkin_time,
                );
	);
   

   // $post               =       Post::create($post_array);
    if(!is_null($post)) {
        return response()->json(["status" => $this->success_status, "success" => true, "data" => $post]);
    }

    else {
        return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! post not created."]);
    }

}

else {
    return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
}                     
}  */

}
