<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\Attendance;
use App\leave_balance;
use App\Leaverequest;
use App\Employee_Reporting_To;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiCdeDashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public $success_status = 200;

    public function cde_dashboard(Request $request, Employee $modal)
    {
        $EmpID =  Auth::user()->emp_id;
        // $request->emp_id;
        $user  =  Auth::user();

        $userID  =  Auth::user()->emp_id;

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

      //  $Merchandiser = 0;  $MerchandiserPresent = 0;  $MerchandiserAbsent = 0; 
      //  $Total_Outlets = 0;  $Total_Completed_Outlets = 0;  $Total_Pending_Outlets = 0;
      //  $Today_Outlets = 0;  $Today_Completed_Outlets = 0;  $Today_Pending_Outlets = 0;
      //  $TotalLeaveReq = 0; $Attendace = 0; $AvailableLeave = 0;
       
        $search = "Field Manager";  $searchMer = "Merchandiser"; 
         
        $matchThese = ['is_active' => '1']; 
      //  $Employees = Employee::where($matchThese)->whereNotIn('employee_id', [$userID ])->count();
        
      $emp_id = Auth::user()->emp_id;

      $total_merchandisers = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->where('employee.designation', 6)
         ->where('employee.is_active', 1)
         ->count();

      $present_merchandisers = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('attendance', 'attendance.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->whereDate('attendance.date', Carbon::today())
         ->where('employee.designation', 6)
         ->where('employee.is_active', 1)
         ->count();

      $absent_merchandisers = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('attendance', 'attendance.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->whereDate('attendance.date', Carbon::today())
         ->where('attendance.is_leave', '1')
         ->where('attendance.is_leave_approved', '1')
         ->where('employee.designation', 6)
         ->where('employee.is_active', 1)
         ->count();

//      $merchandisers = DB::table('employee')
//          ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
//          ->where('cde_reporting.cde_id', $emp_id)
//          ->where('employee.is_active', 1)
//          ->where('employee.designation', 6)
//          ->get();

    
     $total_outlets = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->where('employee.is_active', 1)
         ->where('merchant_time_sheet.is_active', 1)
         ->count();

    
     $completed_outlets = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->where('employee.is_active', 1)
         ->where('merchant_time_sheet.is_active', 1)
         ->where('merchant_time_sheet.is_completed', 1)
         ->count();

   
     $pending_outlets = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->where('employee.is_active', 1)
         ->where('merchant_time_sheet.is_active', 1)
         ->where('merchant_time_sheet.is_completed', 0)
         ->count();

     
     $today_outlets = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->where('employee.is_active', 1)
         ->where('merchant_time_sheet.is_active', 1)
         ->whereDate('merchant_time_sheet.date', Carbon::today())
         ->count();

     $today_completed = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->where('employee.is_active', 1)
         ->where('merchant_time_sheet.is_active', 1)
         ->whereDate('merchant_time_sheet.date', Carbon::today())
         ->where('merchant_time_sheet.is_completed', 1)
         ->count();

     $today_pending = DB::table('cde_reporting')
         ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
         ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
         ->where('cde_reporting.cde_id', $emp_id)
         ->where('employee.is_active', 1)
         ->where('merchant_time_sheet.is_active', 1)
         ->whereDate('merchant_time_sheet.date', Carbon::today())
         ->where('merchant_time_sheet.is_completed', 0)
         ->count();


 // $TotalLeaveReq = Leaverequest::where('is_approved', 0)
  
        return response()->json(["status" => $this->success_status, "success" => true,
        
        "total_merchandisers" => $total_merchandisers, 'present_merchandisers' => $present_merchandisers,
        
        'absent_merchandisers' => $absent_merchandisers, 'total_outlets' => $total_outlets, 
        
        'completed_outlets' => $completed_outlets, 'pending_outlets' => $pending_outlets,
        
        'today_outlets' => $today_outlets, 'today_completed' => $today_completed, 'today_pending' => $today_pending 
        
     //   'merchandisers' => $merchandisers 

        
       ]);

    }

    public function cde_timesheet_approval(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg(); 

        // validation
        $validator     =   Validator::make($request->all(), [
            "emp_id" =>  "required",
            "from_date" =>  "required",
            "to_date" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->emp_id;   // 

    $matchThese = ['is_active' => '1'];

    $from = date("Y-m-d", strtotime($request->from_date));  
    $to = date("Y-m-d", strtotime($request->to_date)); 
    
    $result = DB::table('merchant_time_sheet')->whereBetween('merchant_time_sheet.date', [$from, $to])
    ->where('employee_id', $id)->update(['cde_approval' => '1', 'cde_approve_id' =>Auth::user()->emp_id , 'updated_at'   => date('y-m-d H:i:s')]);

    return $printReport->send_result_msg($this->success_status, $result);

    }
   

    
}
