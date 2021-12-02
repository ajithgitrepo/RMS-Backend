<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\availability;
use App\merchant_timesheet;
use App\Outlet_stockexpiry;
use App\competition;
use App\Employee_Reporting_To;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Services\PayUService\Exception;
use App\Http\Controllers\Api\ApiJourneyPlanController;

class ApiExcelReportController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
     public $success_status = 200;

     public function excel_report_details(Request $request)
     {
         $user  =  Auth::user();
         // $date = \Carbon\Carbon::now()->format('Y-m-d');
          $printReport = new ApiJourneyPlanController();
          $chk =  $printReport->chech_auth($user);
         
         if($chk == false)
         return $printReport->auth_error_msg();

         $validator = Validator::make($request->all(), [
	        'time_sheet_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}
 
         $matchThese = ['is_active' => '1'];
        $result = DB::table('report_details')->where($matchThese)
        ->where('timesheet_id', $request->time_sheet_id)
        ->orderby('created_at','DESC')->get();
       
        return $printReport->send_result_msg($this->success_status, $result);
 
     } 

     public function add_excel_report(Request $request)
     {
         try {
            
         $user  =  Auth::user();
         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
         
         if($chk == false)
         return $printReport->auth_error_msg();
         
        // validation
          $validator      =   Validator::make($request->all(), [
         
             'timesheet_id' =>'required',
             'report_file' =>'required',
         ]);
 
        if($validator->fails()) {
         return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
     }  
      
          $file = $request->file('report_file');
          $format =   $file->getClientOriginalExtension();
         
          if($format != "xlsx" && $format != "xls" && $format != "csv") {
             return response()->json(["status" => "failed", "file is not (xlsx or xls or csv) format"]);
         }  
      // $nbl_names = array();
       $res = "";
       if($request->hasfile('report_file'))
       {
               $nbl_file = $request->file('report_file');
              //dd($nbl_file);  public_path
              $destinationPath = ('excel_report_file/');
              $file = $request->file('report_file');
              $filename = $file->getClientOriginalName();  //  time().'.'.
              $file->move( $destinationPath, $filename);
              $filename_to_save_in_db =  $filename;
           
                       $values = array(
                           'timesheet_id' => ($request->timesheet_id),
                           'file_name' => $filename_to_save_in_db,
                           'created_at' => Carbon::now(),
                          // 'updated_at' => Carbon::now(),
                           'created_by' => Auth::user()->emp_id,
                           'is_active' => 1,
                       );
  
                  $res =  DB::table('report_details')->insert($values);
              
             }    
         
             return $printReport->send_result_msg($this->success_status, $res);
         } catch (\Exception $e) {
             return response()->json(['error' => $e->getmessage()], 500);
         }
       
     }
}
