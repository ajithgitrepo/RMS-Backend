<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\weekoff;
use App\Employee_Reporting_To;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiWeekOffController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
     
    public $success_status = 200;
    public function week_off_details(Request $request)
    {
        $user  =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');

         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
        $matchThese = ['is_active' => '1'];

        $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
        ->where($matchThese)->with([
			'employee_reporting_to'  => function($query) {
				$query->select(['employee_id','first_name', 'middle_name','surname']);
			}
		 ])->pluck('employee_id');

      
        $result = DB::table('weekoff')->select('weekoff.*','employee.first_name')
         ->leftJoin('employee', 'employee.employee_id', '=', 'weekoff.employee_id')
        // ->where($matchThese)
         ->whereIn('employee.employee_id',$Merchresult);
      //  if($request->emp_id != "")
      //  $result = $result->where('employee_id', $request->emp_id);;
        $result = $result->get();
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function add_week_off(Request $request, weekoff $model)
    {
        
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
         
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation 
            $validator      =   Validator::make($request->all(), [
             'emp_id' => 'required|max:255',
             'month' => 'required|max:255',
             'day' => 'required|max:255',
             'year' => 'required|max:255',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

        $date = $request->date;
        //dd($joining_date);
        $new_date = date("Y-m-d", strtotime($date));  

        $result = false;
         
             $MatchThese = ['employee_id' => $request->emp_id, 'day' => $request->day,
             'month' => $request->month, 'year' =>  $request->year,];
             $checker = weekoff::where($MatchThese)->exists();

             if($checker == false)
             {  
                 $outlet = array(    
                     'employee_id' => $request->emp_id, //$request->employee_id,
                     //'date' => $new_date,
                     'month' => $request->month,
                     'day' => $request->day,
                     'year' =>  $request->year,
                     'is_active' => '1',
                     'created_at' => Carbon::now(),
                    // 'created_by' => Auth::user()->emp_id
                 );
                 $result =  DB::table('weekoff')->insert($outlet);
             }
        

        //  $result = $model->create($request->all());
        
          return $printReport->send_result_msg($this->success_status, $result);
      
    }
}
