<?php

namespace App\Http\Controllers\api;

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

class ApiFieldManagerDashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public $success_status = 200;

    public function fieldmanager_dashboard(Request $request, Employee $modal)
    {
        $EmpID =  Auth::user()->emp_id;
        // $request->emp_id;
        $user  =  Auth::user();

        $userID  =  Auth::user()->emp_id;

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

       $Merchandiser = 0;  $MerchandiserPresent = 0;  $MerchandiserAbsent = 0; 
       $Total_Outlets = 0;  $Total_Completed_Outlets = 0;  $Total_Pending_Outlets = 0;
       $Today_Outlets = 0;  $Today_Completed_Outlets = 0;  $Today_Pending_Outlets = 0;
       $TotalLeaveReq = 0; $Attendace = 0; $AvailableLeave = 0;
       
        $search = "Field Manager";  $searchMer = "Merchandiser"; 
         
        $matchThese = ['is_active' => '1']; 
      //  $Employees = Employee::where($matchThese)->whereNotIn('employee_id', [$userID ])->count();
        
      $matchThese = ['is_active' => '1'];

        $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
        ->where($matchThese)->with([
      'employee_reporting_to'  => function($query) {
        $query->select(['employee_id','first_name', 'middle_name','surname']);
      }
     ])->pluck('employee_id');
           
         $Merchandiser = DB::table('employee')
          ->whereIn('employee.employee_id',$Merchresult)
          ->leftjoin('roles', 'employee.designation', 'roles.id')
          ->where('roles.name', 'like',  DB::raw("'%$searchMer%'"))->count();
//
  //       $matchThese = ['is_active' => '1'];
  
         $MerchandiserPresent = $this->query_present_absent($Merchresult,$searchMer, "Present", $Merchandiser,  $matchThese);

         $Absent = $this->query_present_absent($Merchresult,$searchMer, "Absent", $Merchandiser,  $matchThese);
           
         $MerchandiserAbsent =   $Merchandiser - $MerchandiserPresent;
         
          $Today_Outlets = $this->query_complete_pending($EmpID, "Today", "day",  $matchThese);

          $Today_Completed_Outlets = $this->query_complete_pending($EmpID, "Completed", "day",  $matchThese);

          $Today_Pending_Outlets = $this->query_complete_pending($EmpID, "Pending", "day",  $matchThese);


          $Total_Outlets = $this->query_complete_pending($EmpID, "Total", "all",  $matchThese);

          $Total_Completed_Outlets = $this->query_complete_pending($EmpID, "Completed", "all",  $matchThese);

          $Total_Pending_Outlets = $this->query_complete_pending($EmpID, "Pending", "all",  $matchThese);

        
         $leave_balance = leave_balance::where('is_active', 1) ->where('employee_id',$user)
            ->get();
         if (!empty($leave_balance[0]->Annual_Leave)) 
         $AvailableLeave = $leave_balance[0]->Annual_Leave;
        
         $currentMonth = date('m');
         $Attendace = Attendance::all();
         $Attendace = $Attendace->where('employee_id',  $userID)->count();
       
         //  ->whereRaw('MONTH(date) = ?',[$currentMonth])
        // ->where('is_present', 1)->count();

    $merchandisers = DB::table('employee')  
  ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
  ->where('employee.is_active', 1)
  ->leftjoin('roles', 'employee.designation', 'roles.id')
  //->where('designation', 6)  
  ->where('roles.name', 'like',  DB::raw("'%$searchMer%'"))
 ->where('employee_reporting_to.reporting_to_emp_id', $userID)
  ->pluck('employee_reporting_to.employee_id')->all();

  $TotalLeaveReq = Leaverequest::with('employee')
  ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
    ->whereIn('employee_id', $merchandisers)
    ->where('is_approved', 0)
    ->count();


 // $TotalLeaveReq = Leaverequest::where('is_approved', 0)
  
        return response()->json(["status" => $this->success_status, "success" => true,
        
        "Merchandiser" => $Merchandiser , "MerchandiserPresent" => $MerchandiserPresent, "MerchandiserAbsent" => $MerchandiserAbsent,
         
        "Total_Outlets" => $Total_Outlets, "Total_Completed_Outlets" => $Total_Completed_Outlets, "Total_Pending_Outlets" => $Total_Pending_Outlets, 

        "Today_Outlets" => $Today_Outlets, "Today_Completed_Outlets" => $Today_Completed_Outlets, "Today_Pending_Outlets" => $Today_Pending_Outlets, 
        
        "TotalLeaveReq" => $TotalLeaveReq,  "Attendace" => $Attendace  , "AvailableLeave" => $AvailableLeave, 

        
       ]);

    }
    public function query_complete_pending($EmpID, $Status,$Type, $matchThese)
    {
        $result = DB::table('merchant_time_sheet')
        ->where('merchant_time_sheet.created_by', $EmpID)->where($matchThese);
        
        //     if($Type == "Month")
        // $result->whereRaw('MONTH(date) = ?',[$currentMonth]);
            if($Type == "day")
        $result->whereDate('date', date('Y-m-d'));

        if($Status ==  "Completed")
        $result->where('is_completed', 1);

          if($Status ==  "Pending")
          $result->where('is_completed', 0);

          $result =  $result->count();

        return  $result;

    }


    public function query_present_absent($Merchresult,$type, $chk, $TotMerchandiser, $matchThese)
    {
        $Role = "Merchandiser";
        $result = DB::table('employee')->where('employee.is_active',1)
        ->leftjoin('roles', 'employee.designation', 'roles.id')
        ->leftjoin('attendance', 'employee.employee_id', 'attendance.employee_id')
        ->whereDate('date',date('Y-m-d'))
        ->whereIn('employee.employee_id',$Merchresult)
        ->where('roles.name', 'like',  DB::raw("'%$Role%'"))->count();
      //  $chk !=  "Present" &&
        if( $type == "Merchandiser"  )
          $result =  ( $TotMerchandiser - $result );

        return  $result;

    }
}
