<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\Outlet;
use App\Employee_Reporting_To;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiReportingToController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    
    public $success_status = 200;
     
    public function add_reporting(Request $request, Employee_Reporting_To $model)
    {
        try {
      
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =    Validator::make($request->all(), [
           "employee_id" =>  "required",
           'reporting_to_emp_id'=>'required',
           'reporting_date'=>'required',
           'reporting_end_date'=>'required',
           ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

          $StatrtDate =   date("Y-m-d", strtotime($request->reporting_date)); 
          $EndDate =  date("Y-m-d", strtotime($request->reporting_end_date)); 

            $result =   DB::table('employee_reporting_to')->insert(
            array(
            'employee_id'   =>   $request->employee_id,
            'reporting_to_emp_id'   =>  $request->reporting_to_emp_id,
            'reporting_date'   => $StatrtDate,
            'reporting_end_date'   => $EndDate,
            'created_at' => date('y-m-d H:i:s')
            ));
            return $printReport->send_result_msg($this->success_status, $result);
       }
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function reporting_to_details(Request $request, Employee_Reporting_To $modal)
    {

        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $matchThese = ['is_active' => '1'];

        $result = Employee_Reporting_To::where($matchThese)->with([
			'employee'  => function($query) {
				$query->select(['employee_id','first_name','middle_name','surname']);
			}
		])->with([
			'employee_reporting_to'  => function($query) {
				$query->select(['employee_id','first_name','middle_name','surname']);
			}
		 ])->get();

        //  $result =  DB::table('employee')
        //  ->leftJoin('employee_reporting_to as empto', 'empto.employee_id', '=', 'employee.employee_id')
        // ->select('empto.reporting_to_emp_id' , )
        //  ->get();

        return $printReport->send_result_msg($this->success_status, $result);

    }  
    public function merchandiser_under_fieldmanager_details(Request $request, Employee_Reporting_To $modal, Employee $modal1)
    {
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
       // $emp_id = $request->emp_id;
        $matchThese = ['is_active' => '1'];

    //   //  $emp_id = 'Emp9328'; //$request->emp_id;

        $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
        ->where($matchThese)->with([
			'employee_reporting_to'  => function($query) {
				$query->select(['employee_id','first_name', 'middle_name','surname']);
			}
		 ])->pluck('employee_id');
         //->where('employee_id',$emp_id)
        
         $result =  Employee::select('employee_id','first_name','middle_name','surname')->whereIn('employee_id',$Merchresult)
                 ->get();

        return $printReport->send_result_msg($this->success_status, $result);

    }  
        
    
    }

    
