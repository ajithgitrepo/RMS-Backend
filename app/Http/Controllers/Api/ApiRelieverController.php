<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\weekoff;
use App\Reliever;
use App\Employee_Reporting_To;
use App\Http\Controllers\Api\ApiJourneyPlanController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiNotificationController;
class ApiRelieverController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
     
    public $success_status = 200;

    public function view_reliver_details(Request $request, Reliever $model)
    {
        $user  =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');

         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg(); 
        $matchThese = ['is_active' => '1'];

        $result = Reliever::where($matchThese)
        ->select('employee_id','reliever_id','from_date','to_date','reason','is_active','created_at')
        ->with([
			'employee'  => function($query) {
				$query->select(['employee_id','first_name','middle_name','surname']);
			}
            ])->with([
                'reliever'  => function($query) {
                    $query->select(['employee_id','first_name','middle_name','surname']);
                }
            ])->get();
        // DB::table('stock_expiry');
       // $result = $result->get();

        return $printReport->send_result_msg($this->success_status, $result);

    } 
    
    public function add_reliver(Request $request)
    {
        try
        {
        $user  =  Auth::user();
	    $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);

        $date = \Carbon\Carbon::now(); 
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
                'employee_id' =>'required',
                'reliever_id'  =>'required',
                'from_date' =>'required',
                'to_date'  =>'required',
                'reason' =>'required',
               
            ]);
        
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  
        
        $from_date = date("Y-m-d", strtotime($request->from_date));  
        $to_date = date("Y-m-d", strtotime($request->to_date));

       // dd($to_date);
        
        $check =  DB::table('reliever')
        ->where('reliever_id', $request->reliever_id)
        ->where('is_active', 1)
        ->whereDate('from_date','<=', $from_date)
        ->whereDate('to_date','>=', $to_date)->count();
        //->whereBetween('date', [$from_date, $to_date])->count();
   // dd($check);
    if($check == 0)
    {
        $get_timesheet =  DB::table('merchant_time_sheet')
        ->where('is_active', 1)
        ->where('employee_id', $request->employee_id)
        ->whereBetween('date', [$from_date, $to_date]);;
       
       $DummyClone = clone $get_timesheet;
       $DummyClone1 = clone $get_timesheet;
   
       $get_timesheet_id = $DummyClone->pluck('id')->toArray();
   
       $get_timesheet_data = $DummyClone1->get();
       
      
  // dd(make_deactive_timesheet);
  $time_id = "";
      foreach ($get_timesheet_data as $time)     
        {   
                 $create_timesheet = array(
                   'employee_id' => $request->reliever_id,
                   'date' =>  $time->date,
                   'outlet_id' => $time->outlet_id,
                   'scheduled_calls' => 1,
                   'is_defined' => 1, 
                   'is_active' => '1',
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
                   'created_by' => Auth::user()->emp_id,
               );
               $time_id .= $time->id. "" . ",";
               $created_timesheet_reliver =  DB::table('merchant_time_sheet')
               ->insert($create_timesheet);
        }

        $make_deactive_timesheet = DB::table('merchant_time_sheet')
        ->whereIn('id', $get_timesheet_id)
        ->update(['is_active' =>  0,
                  'updated_at' =>date('y-m-d H:i:s')]);
   
        $result =  DB::table('reliever')->insert(
                array(
                    'employee_id'   =>   $request->employee_id,
                    'role'   =>   $request->role,
                    'reliever_id' => $request->reliever_id,
                    'from_date'   =>  $from_date, 
                    'to_date'   => $to_date,
                    'reason'  => $request->reason,
                    'timesheet_id' => $time_id,
                    'updated_at' => date('y-m-d H:i:s'),
                    'created_at' => date('y-m-d H:i:s'),
                    'created_by' => Auth::user()->emp_id,
                    'device' => 'Mobile'
                )); 

            return $printReport->send_result_msg($this->success_status, $result);
        }
        else
        return response()->json(["status" => "failed", "alert" => "reliever not available beacause already asssigned for reliever"]);

          } 
          catch (\Exception $e) {
              return response()->json(['error' => $e->getmessage()], 500);
          }
      
    }

    public function search_reliver(Request $request)
    {
        try
        {
        $user  =  Auth::user();
	    $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);

        $date = \Carbon\Carbon::now(); 
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
                'emp_merch_id' =>'required',
                'from_date'  =>'required',
                'to_date' =>'required',
                
            ]);
        
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  

        $from = date("Y-m-d", strtotime($request->from_date)); 
        $to = date("Y-m-d", strtotime($request->to_date)); 

        $matchThese = ['is_active' => '1'];
        $get_timesheet =  DB::table('merchant_time_sheet')
        ->where('employee_id', $request->emp_merch_id)
        ->where($matchThese)
        ->whereBetween('date', [$from, $to])->count();

        if($get_timesheet == 0)
        return response()->json(["status" => "failed", "alert" => "No_Time_sheet allocated that date"]);
       // return response()->json("No_Time_sheet");
     
    $matchThese = ['is_active' => '1'];
    
    $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
    ->where($matchThese)->where('employee_id', '!=', $request->emp_merch_id)
    ->with([
    'employee_reporting_to'  => function($query) {
    $query->select(['employee_id','first_name', 'middle_name','surname']);
    }
    ])->pluck('employee_id')->toArray(); 

    $res =  DB::table('merchant_time_sheet')
    ->whereIn('employee_id', $Merchresult)
    ->whereBetween('date', [$from, $to])->pluck('employee_id')->toArray();

    $emp_id = array();
    foreach ($Merchresult as $Merch)
    {
        if (!in_array($Merch, $res)) 
          $emp_id[] = $Merch;
    }

    $reliver_emp =   DB::table('employee')
    ->select('employee_id','first_name','surname')
    ->whereIn('employee_id', $emp_id)
    ->where('is_active', 1)->get();

    if($reliver_emp->isEmpty())
    return response()->json(["status" => "failed", "alert" => "No merchandisers available"]);

       
    return $printReport->send_result_msg($this->success_status, $reliver_emp);
       
        } 
        catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
      
    }
    
}
