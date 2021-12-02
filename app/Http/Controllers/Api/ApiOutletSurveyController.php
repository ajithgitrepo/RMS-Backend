<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\availability;
use App\merchant_timesheet;
use App\Outlet_stockexpiry;
use App\competition;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Services\PayUService\Exception;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiOutletSurveyController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
  
    public $success_status = 200;

    public function add_outlet_survey(Request $request)
    {
        try {
      
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator  =  Validator::make($request->all(), [
            "timesheet_id" =>  "required",
           /// 'employee_id'=>'required',
            ]);  

           if($validator->fails()) {   
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 
          
      //    $StatrtDate = date("Y-m-d", strtotime($request->date)); 
      $current_date = \Carbon\Carbon::now();
      $current_time = date('H:i:s');

            $chk = DB::table('oulet_survey')->where('timeshet_id', $request->timesheet_id)->count();
            if($chk == 0)
            {
                $result =  DB::table('oulet_survey')->insert(
                array(
                "timeshet_id" =>  $request->timesheet_id,
                'date'=>$current_date,
                'time'=>$current_time,

                'availability'=>$request->availability,
                'visibility'=>$request->visibility,
                'shareofself'=>$request->shareofself,
                'promotioncheck'=>$request->promotioncheck,
                'planogramcheck'=>$request->planogramcheck,
                'compitetorinfo'=>$request->compitetorinfo,
                'stockexpiry'=>$request->stockexpiry,
                
                'is_active'=>'1',
                'employee_id'=>Auth::user()->emp_id,
                'created_at' => date('y-m-d H:i:s'),
                'device' => "Mobile"
                ));  
            }
            else
            {
                $result =  DB::table('oulet_survey')->where('timeshet_id', $request->timesheet_id)->update(
                    array(
                   
                    'date'=>$current_date,
                    'time'=>$current_time,
                     'availability'=>$request->availability,
                    'visibility'=>$request->visibility,
                    'shareofself'=>$request->shareofself,
                    'promotioncheck'=>$request->promotioncheck,
                    'planogramcheck'=>$request->planogramcheck,
                    'compitetorinfo'=>$request->compitetorinfo,
                    'stockexpiry'=>$request->stockexpiry,
                    
                    'is_active'=>'1',
                    'employee_id'=>Auth::user()->emp_id,
                    'updated_at' => date('y-m-d H:i:s'),
                    'device' => "Mobile"
                    ));  

            }
            return $printReport->send_result_msg($this->success_status, $result);
       }
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }
    public function outlet_survey_details(Request $request)
    {
        $user  =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');
         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation 
            $validator      =   Validator::make($request->all(), [
               'time_sheet_id' =>'required', ]);

        if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  

       $date = date('Y-m-d');

       $matchThese = ['oulet_survey.is_active' => '1'];

       $result = DB::table('oulet_survey')
       ->where('timeshet_id', $request->time_sheet_id ) 
       ->where($matchThese) 
       ->get();

       return $printReport->send_result_msg($this->success_status, $result);

    }
    
    public function outlet_journey_check_in_out(Request $request)
    {
        $input          =           $request->all();
        $user           =           Auth::user();
        $id             =           $request->timesheet_id;
        $split_id             =           $request->journey_time_id;
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

            // validation
            $validator    =    Validator::make($request->all(), [
                "type"           =>      "required",
                "timesheet_id"   =>      "required",
              //  "date"           =>      "required",
               // "checkin_time"           =>      "required",
              //  "checkout_time"           =>      "required",
            ]);

            if($validator->fails()) {
                return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
            }

            $check = DB::table('outlet_journey_time')
            ->where('is_active', '1')
            ->where('type', $request->type)
            ->where('employee_id',Auth::user()->emp_id)
            ->where('timesheet_id',$id)
            ->whereNull('checkout_time')
            ->count();
          //  $result = "yes";
               if( $split_id == null  ||  $split_id == "")
                {
                    if($request->checkin_time == "") {
                        return response()->json(["status" => "failed", "error" => "No check in time available for this data"]);
                    }

                    $result =   DB::table('outlet_journey_time')->insert(
                        array(
                        'type'   => $request->type,
                        'timesheet_id'   => $id,
                        'employee_id'   => Auth::user()->emp_id,
                        'date'   => $date,
                        'checkin_time'   => $request->checkin_time,
                        'checkout_time'   =>  $request->checkout_time,
                        'created_at' => date('y-m-d H:i:s')
                        )); 
                }   
             else
                {
                   if($request->checkout_time != "")
                   {
                        $result  =  DB::table('outlet_journey_time')
                        ->where('timesheet_id', $id)
                        ->where('type', $request->type)
                        ->where('employee_id', Auth::user()->emp_id)
                        ->where('id', $split_id)
                      //  ->whereNull('checkout_time')
                        ->update([
                        'checkout_time' => $request->checkout_time,
                        'updated_at'=>date('y-m-d H:i:s')]); 
                    }
                    else
                    return response()->json(["status" => "failed", "error" => "Check out time shoule not be empty"]);

                }  
      
                return $printReport->send_result_msg($this->success_status, $result);
   
}  

public function outlet_journey_time_details(Request $request)
{
    $timesheet_id  = $request->timesheet_id ; 
    $user   =  Auth::user();
    $date = \Carbon\Carbon::now()->format('Y-m-d');

    $printReport = new ApiJourneyPlanController();
    $chk =  $printReport->chech_auth($user);
    
    if($chk == false)
    return $printReport->auth_error_msg();
    
    $validator      =   Validator::make($request->all(), [
        "timesheet_id" =>  "required",
    ]);

        if($validator->fails()) {
         return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
     } 

    $matchThese = ['is_active' => '1', 'timesheet_id' => $timesheet_id ];

    $result = DB::table('outlet_journey_time')->where($matchThese)->get();

     return $printReport->send_result_msg($this->success_status, $result);

}

public function add_force_checkin(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            'time_sheet_id' =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

        $matchThese = ['is_active' => '1'];

        $id = $request->time_sheet_id;
     
        $result = merchant_timesheet::where('id', $id)
        ->update(['checkin_type' => $request->checkin_type, 'reason' => $request->reason]);

        return $printReport->send_result_msg($this->success_status, $result);

    }


    public function add_unfinished_outlet_reason(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            'time_sheet_id' =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

        $matchThese = ['is_active' => '1'];

        $id = $request->time_sheet_id;
     
        $result = merchant_timesheet::where('id', $id)
        ->update(['not_finish_reason' => $request->reason]);

        return $printReport->send_result_msg($this->success_status, $result);

    }



}
