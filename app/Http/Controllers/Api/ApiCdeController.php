<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product_details;
use App\Category_details; 
use App\Brand_details; 
use App\Employee; 

use App\cde_reporting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiCdeController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;

    public function add_cde(Request $request)
    {
        try {
      
        $user  =  Auth::user();  
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator  =  Validator::make($request->all(), [
            "merchandiser_id" =>  "required",
            "cde_id" =>  "required",
            "reporting_date" =>  "required",
            "reporting_end_date" =>  "required",

           ]);  

           if($validator->fails()) {  
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

        $StatrtDate =   date("Y-m-d", strtotime($request->reporting_date)); 
          $EndDate =  date("Y-m-d", strtotime($request->reporting_end_date)); 

        $array = array( 
            "merchandiser_id" =>  $request->merchandiser_id,
            "cde_id" =>  $request->cde_id,
            "reporting_date" =>  $StatrtDate,
            "reporting_end_date" =>   $EndDate,

            'created_by'=>Auth::user()->emp_id,
           // 'created_at' => date('y-m-d H:i:s'),
            'device' => "Mobile"
            );  
         
        $check = DB::table('cde_reporting')
        ->where("merchandiser_id", $request->merchandiser_id)
        ->where("cde_id", $request->cde_id)
        ->where('is_active', 1)
        ->count();
        if($check == 0)
        {
            $data = array('created_at' => date('y-m-d H:i:s'));
            $merge_result = array_merge($array, $data);

            $result =  DB::table('cde_reporting')->insert( $merge_result ); 
        }
        else
        {
            $data = array('updated_at' => date('y-m-d H:i:s'));
            $merge_result = array_merge($array, $data);

            $result =  DB::table('cde_reporting')->where("merchandiser_id", $request->merchandiser_id)
            ->where("cde_id", $request->cde_id)->where('is_active', 1)->update( $merge_result ); 
        }
         
       return $printReport->send_result_msg($this->success_status, $result);
       }  
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function cde_reporting_to_details(Request $request, cde_reporting $modal)
    {

        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $matchThese = ['is_active' => '1'];

      //  cde_reporting::where($matchThese)->with('merchandiser')->with('cde_reporting')->get();

        $result = cde_reporting::where($matchThese)->with([
			'merchandiser'  => function($query) {
				$query->select(['employee_id','first_name','middle_name','surname']);
			}
		])->with([
			'cde_reporting'  => function($query) {
				$query->select(['employee_id','first_name','middle_name','surname']);
			}
		 ])->get();

        //  $result =  DB::table('employee')
        //  ->leftJoin('employee_reporting_to as empto', 'empto.employee_id', '=', 'employee.employee_id')
        // ->select('empto.reporting_to_emp_id' , )
        //  ->get();

        return $printReport->send_result_msg($this->success_status, $result);

    }  

    public function merchandiser_under_cde_details(Request $request, cde_reporting $modal, Employee $modal1)
    {
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg();
       // $emp_id = $request->emp_id; 
        $matchThese = ['is_active' => '1'];

      $emp_id = $request->emp_id;

   // cde_reporting::where($matchThese)->with('merchandiser')->with('cde_reporting')->get();

        $Merchresult = cde_reporting::where('cde_id', $emp_id)
        ->where($matchThese)->with([
			'cde_reporting'  => function($query) {
				$query->select(['employee_id','first_name', 'middle_name','surname']);
			}
		 ])->pluck('merchandiser_id');
         //->where('employee_id',$emp_id)
        
         $result =  Employee::select('employee_id','first_name','middle_name','surname')->whereIn('employee_id',$Merchresult)
                 ->get();

        return $printReport->send_result_msg($this->success_status, $result);

    }  
}
