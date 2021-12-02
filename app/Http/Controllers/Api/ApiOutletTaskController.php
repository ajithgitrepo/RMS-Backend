<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

use App\Outlet_Task;
use App\journeyplan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Services\PayUService\Exception;

use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;



class ApiOutletTaskController extends Controller
{
    //

    public function __construct() {
        $this->middleware('auth');
    }
    public $success_status = 200;

    public function outlet_task_details(Request $request, Outlet_Task $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

           // validation
           $validator      =   Validator::make($request->all(), [
            'outlet_id' =>'required',
            ]);

       if($validator->fails()) 
        return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);

        $matchThese = ['is_active' => '1'];

        $result = Outlet_Task::where($matchThese)
        ->where('outlet_id', $request->outlet_id )->get();
        
        
            
         return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function de_active_outlet_task(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            "task_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->task_id;

    $matchThese = ['is_active' => '1'];

    $result = Outlet_Task::where('id', $id)->update(['is_active' => '0']);

    return $printReport->send_result_msg($this->success_status, $result);

    }

    public function active_outlet_task(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            "task_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->task_id;

    $matchThese = ['is_active' => '1'];

    $result = Outlet_Task::where('id', $id)->update(['is_active' => '1']);

    return $printReport->send_result_msg($this->success_status, $result);

    }

    public function add_outlet_task(Request $request)
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
                'outlet_id' =>'required',
                'task_list'  =>'required',
            ]);
        
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  
        
     
       //dd($someArray);
      $date = \Carbon\Carbon::now(); 
        $tes = "";
        for($i = 0; $i<count($request->task_list); $i++)
        {
           $tes .= $request->task_list[$i];
        // 	dd($someArray[$i]['journy_date']);
          $output = array(
               'date' =>$date,
                'outlet_id' => $request->outlet_id,
                 'task_list' => $request->task_list[$i],
                 'created_by' => Auth::user()->emp_id,
                  'is_active' => '1', 
                  'created_at' => Carbon::now(),
                   'device' => "Mobile"
               //  'updated_at' => Carbon::now()
             ); 
                
          $result = DB::table('task_details')->insert($output);  
           
        }  
       
            return $printReport->send_result_msg($this->success_status, $result);
          } 
          catch (\Exception $e) {
              return response()->json(['error' => $e->getmessage()], 500);
          }
      
    }

    public function send_outlet_task_response(Request $request)
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
              //  'id' =>'required',
                'timesheet_id'  =>'required',
                'task_id'  =>'required',
                 'is_completed'  =>'required',

            ]);
        
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  
         
       //dd($someArray);
      $date = \Carbon\Carbon::now(); 
      
        for($i = 0; $i<count($request->task_id); $i++)
        {

          $imageData = $request->img_url[$i];
          $after_image_url = null;
                    if($imageData != "")
                    { //public_path().
                        $destinationPath = 'task_file/' ;
                        list($type, $imageData) = explode(';', $imageData);
                        list(,$extension) = explode('/',$type);
                        list(,$imageData)  = explode(',', $imageData);
                        $fileName = uniqid().'.'.$extension;
                        $after_image_url =  $fileName;
                        $imageData = base64_decode($imageData);
                        file_put_contents($destinationPath .$fileName, $imageData);
                        $image_url = $fileName;
                    }
            
       // 	dd($someArray[$i]['journy_date']);  task_file  img_url

           $visibility = array(  
               'date' =>$date,
               'employee_id' => Auth::user()->emp_id,
                'timesheet_id' => $request->timesheet_id, 
                 'task_id' => $request->task_id[$i],
                 'is_completed' => $request->is_completed[$i],
                 'img_url' => $after_image_url,
                  'device' => "Mobile", 
                   //'updated_at' => Carbon::now()
             ); 
      $check = DB::table('task_response_details')
      ->where( 'task_id', $request->task_id[$i])
      ->where( 'timesheet_id', $request->timesheet_id)->count();
        if($check == 0)
        {
          $visibilityinsert = array('created_at' => Carbon::now());  
          $output = array_merge($visibility, $visibilityinsert); 
          $result = DB::table('task_response_details')->insert($output); 
        }
        else
        {
          $visibilityupdate = array('updated_at' => Carbon::now());
          $output = array_merge($visibility, $visibilityupdate);
          $result = DB::table('task_response_details')
          ->where( 'task_id', $request->task_id[$i])
          ->where( 'timesheet_id', $request->timesheet_id)->update($output); 
        }
           
           
        }  
       
         return $printReport->send_result_msg($this->success_status, $result);
          } 
          catch (\Exception $e) {
              return response()->json(['error' => $e->getmessage()], 500);
          }
      
    }

    public function fieldmanager_view_outlet_task_response(Request $request, Outlet_Task $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

           // validation
           $validator      =   Validator::make($request->all(), [
            'timesheet_id' =>'required',
            ]);

       if($validator->fails()) 
        return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);

        $matchThese = ['task_response_details.is_active' => '1']; 

        $result = DB::table('task_response_details')->where($matchThese)
         ->select('task_response_details.*','task_details.task_list', 'task_details.outlet_id')
        ->leftJoin('task_details', 'task_details.id', '=', 'task_response_details.task_id')
        ->where('timesheet_id', $request->timesheet_id)->get();
        
         return $printReport->send_result_msg($this->success_status, $result);

    } 
}
