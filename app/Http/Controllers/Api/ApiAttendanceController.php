<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\Outlet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;


class ApiAttendanceController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public $success_status = 200;

    
    public function attendance_monthly(Request $request, journeyplan $modal)
    {
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
         
        if($chk == false)
        return $printReport->auth_error_msg();

        $EmpID = $request->emp_id;
        $user   =  Auth::user();
        $currentMonth = date('m');
         $date = \Carbon\Carbon::now()->format('Y-m-d');
         $timestamp = Carbon::parse($request->month);
         $Month =  $timestamp->month;
         $Year =  $timestamp->year;

      
        $post  =  DB::table('attendance')->select('attendance.*','employee.first_name')
        ->leftJoin('employee', 'employee.employee_id', '=', 'attendance.employee_id');
        if($EmpID != "")
        $post  = $post->where('employee.employee_id', $EmpID);
        $post  = $post->orderby('created_at','DESC')
        ->whereRaw('MONTH(date) = ?',[$Month])
      //  ->whereYear('date', $Year)
        ->get();   
            
            // journeyplan::where("employee_id", $id)->where("employee_id", $id)->first();
            
            return $printReport->send_result_msg($this->success_status, $post);
    }

    public function attendance_daily(Request $request, journeyplan $modal)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
         
        if($chk == false)  
        return $printReport->auth_error_msg();

        $EmpID = $request->emp_id;
        $user   =  Auth::user();
        $currentMonth = date('m');
         $date = \Carbon\Carbon::now()->format('Y-m-d');
         $timestamp = Carbon::parse($request->month);
         $Month =  $timestamp->month;
         $Year =  $timestamp->year;

            $post  =  DB::table('attendance')->select('attendance.*','employee.first_name')
            ->leftJoin('employee', 'employee.employee_id', '=', 'attendance.employee_id');
            if($EmpID != "")
            $post  = $post->where('employee.employee_id', $EmpID);
            $post  = $post->orderby('created_at','DESC')
            ->whereDate('date', date('Y-m-d'))
           // ->whereRaw('MONTH(date) = ?',[$Month])
           // ->whereYear('date', $Year)
            ->get();   
            
            // journeyplan::where("employee_id", $id)->where("employee_id", $id)->first();
            return $printReport->send_result_msg($this->success_status, $post);
            
    }



    public function attendance_in(Request $request)
    {
        
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
         
        if($chk == false)
        return $printReport->auth_error_msg();
     
     /*   $validator      =   Validator::make($request->all(), [
            'emp_id' => 'required',
           ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  */

        $date = Carbon::now();

        $time = $date->toDateTimeString();
        
       $check =  DB::table('attendance')->where('employee_id',  Auth::user()->emp_id)->whereDate('date', date('Y-m-d'))->count();
        
       $result = "already done";
      if($check == 0)
        {
            $result =	DB::table('attendance')->insert(
                array(
                    'employee_id'   => Auth::user()->emp_id,
                    'date' => date('y-m-d H:i:s'),
                    'is_present'   =>   "1" ,
                    'checkin_time' => $time,
                    'updated_at' => date('y-m-d H:i:s'),
                    'created_at' => date('y-m-d H:i:s'),
                    'device' => 'mobile'
            ));

        
       /*  else
         {

            $result =   DB::table('attendance')
        ->whereDate('date', date('Y-m-d'))
        ->where('is_present', '1')
        ->where('employee_id', Auth::user()->emp_id)
        ->update(
    	     array(
    	       'is_present'   =>   "1" ,
    		    'checkin_time' => $time,
    		    'updated_at' => date('y-m-d H:i:s')
    		));
         }  */

            $notify = new ApiNotificationController();
            $description = Auth::user()->emp_id. "_" .  Auth::user()->name. "_" ."Merchandiser Logged In";
            $user_type = "merchandiser";
    }
      //  $add_notify =  $notify->add_audit_trails($description, $user_type);
        
     return $printReport->send_result_msg($this->success_status, $result);
      
    }


    public function attendance_out(Request $request)
    {
        
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
         
        if($chk == false)
        return $printReport->auth_error_msg();
     
         /*  // validation 
            $validator      =   Validator::make($request->all(), [
             'emp_id' => 'required',
            ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }   */

        $date = Carbon::now();

        $time = $date->toDateTimeString();
       
    	$result = DB::table('attendance')
        ->whereDate('date', date('Y-m-d'))
        ->where('is_present', '1')
        ->where('employee_id', Auth::user()->emp_id)
        ->update(
    	     array(
    	       'is_present'   =>   "1" ,
    		    'checkout_time' => $time,
    		    'updated_at' => date('y-m-d H:i:s')
    		  
         ));
        
          return $printReport->send_result_msg($this->success_status, $result);
      
    }

    

}
