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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiHrDashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public $success_status = 200;

    public function hr_dashboard(Request $request, Employee $modal)
    {
        $EmpID = $request->emp_id;
        $user  =  Auth::user();

        $userID  =  Auth::user()->emp_id;

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $Employees = 0; $FieldManager = 0; $Merchandiser = 0; $TotalLeaveReq = 0; $Attendace = 0; $AvailableLeave = 0;
        $MerchandiserPresent = 0;  $MerchandiserAbsent = 0;  $LeaveBal = 0; $LeaveRequest = 0; $FieldManagerPresent = 0;
        $FieldManagerAbsent = 0; $EmployeesPresent = 0;  $EmployeesAbsent = 0;
       
        $search = "Field Manager";  $searchMer = "Merchandiser"; 
         
        $matchThese = ['is_active' => '1'];
      //  $Employees = Employee::where($matchThese)->whereNotIn('employee_id', [$userID ])->count();
        
         
         $FieldManager = DB::table('employee')->leftjoin('roles', 
         'employee.designation', 'roles.id')->where('roles.name', 'like',  DB::raw("'%$search%'"))->count();

           
         $Merchandiser = DB::table('employee')->leftjoin('roles', 
         'employee.designation', 'roles.id')->where('roles.name', 'like',  DB::raw("'%$searchMer%'"))->count();

         $Merchandiser = DB::table('employee')->leftjoin('roles', 
         'employee.designation', 'roles.id')->where('roles.name', 'like',  DB::raw("'%$searchMer%'"))->count();

        
         $MerchandiserPresent = $this->query_present_absent($searchMer, "Present", $Merchandiser,  $FieldManager);

         $MerchandiserAbsent = $this->query_present_absent($searchMer, "Absent", $Merchandiser,  $FieldManager);


         $FieldManagerPresent = $this->query_present_absent($search, "Present",  $Merchandiser, $FieldManager);

         $FieldManagerAbsent = $this->query_present_absent($search, "Absent",  $Merchandiser, $FieldManager);


         $leave_balance = leave_balance::where('is_active', 1)->where('employee_id',$user)
            ->get();
         if (!empty($leave_balance[0]->Annual_Leave)) 
         $LeaveBal = $leave_balance[0]->Annual_Leave;
        
         $currentMonth = date('m');
         $Attendace = Attendance::where('employee_id',  $userID)
         ->whereRaw('MONTH(date) = ?',[$currentMonth])
         ->where('is_present', 1)->count();

         $LeaveRequest = Leaverequest::where('is_approved', 1)
         ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
         ->count();

         $Employees = $FieldManager + $Merchandiser;

         $EmployeesPresent = $MerchandiserPresent + $FieldManagerPresent;

         $EmployeesAbsent = $MerchandiserAbsent + $FieldManagerAbsent;

        return response()->json(["status" => $this->success_status, "success" => true,
        "Employees" => $Employees , "FieldManager" => $FieldManager ,
        "Merchandiser" => $Merchandiser , "TotalLeaveReq" => $LeaveRequest, 
        "Attendace" => $Attendace , "AvailableLeave" => $LeaveBal, 
        "MerchandiserPresent" => $MerchandiserPresent, "MerchandiserAbsent" => $MerchandiserAbsent,
        "FieldManagerPresent" => $FieldManagerPresent, "FieldManagerAbsent" => $FieldManagerAbsent,
        "EmployeesPresent" => $EmployeesPresent, "EmployeesAbsent" => $EmployeesAbsent
        //"LeaveRequest" => $LeaveRequest
        
       ]);

    }
    public function query_present_absent($type, $chk, $TotMerchandiser, $TotField)
    {
        $result = DB::table('employee')
        ->leftjoin('roles', 'employee.designation', 'roles.id')
        ->leftjoin('attendance', 'employee.employee_id', 'attendance.employee_id')
        ->whereDate('date',date('Y-m-d'))
        ->where('roles.name', 'like',  DB::raw("'%$type%'"))->count();

        if($chk !=  "Present" && $type == "Merchandiser"  )
          $result = $result - $TotMerchandiser ;

          if($chk !=  "Present" && $type == "Field Manager"  )
          $result = $result - $TotField ;

        return  $result;

    }
}
