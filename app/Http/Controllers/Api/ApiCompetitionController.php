<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\availability;
use App\merchant_timesheet;
use App\Outlet_stockexpiry;
use App\Competition;
use App\Employee_Reporting_To;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Services\PayUService\Exception;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;


class ApiCompetitionController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
     public $success_status = 200;

     public function competition_details(Request $request)
     {
         $user  =  Auth::user();
         // $date = \Carbon\Carbon::now()->format('Y-m-d');
          $printReport = new ApiJourneyPlanController();
          $chk =  $printReport->chech_auth($user);
         
         if($chk == false)
         return $printReport->auth_error_msg();
 
         $matchThese = ['is_active' => '1'];
        $result = Competition::where($matchThese)->orderby('created_at','DESC')->get();
        //->with('brand')
        
        return $printReport->send_result_msg($this->success_status, $result);
 
     } 

     public function add_competition(Request $request)
     {
        try {
         $user  =  Auth::user();
             $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
 
         $date = \Carbon\Carbon::now();
         
         if($chk == false)
         return $printReport->auth_error_msg();
      
            // validation 
             $validator      =   Validator::make($request->all(), [
                'company_name' =>'required',
                'brand_name'=>'required',
                'timesheet_id'=>'required',
                 'item_name'=>'required',
                  'promotion_type'=>'required',
                   'promotion_description'=>'required',
                    'mrp'=>'required',
                     'selling_price'=>'required',
                     // 'capture_image.*'=>'required'
                      //|image|mimes:jpeg,jpg,png,doc,docx,pdf',
                 //'reason' =>'required',
             ]);
         
         if($validator->fails()) {
             return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
         }  

         $competitor = DB::table('competitor')
         ->where('timesheet_id', $request->timesheet_id)
         ->where('competitor.is_active', 1)
         ->get();

         $check = DB::table('merchant_time_sheet')
         ->where('id', $request->timesheet_id)
         ->where('merchant_time_sheet.is_active', 1)
         ->get();

         $Outlet_id = 0;
         if($check->isNotEmpty())
         {
            $Outlet_id = $check[0]->outlet_id;
         }

         $imageData = $request->capture_image;  $before_image_url = null;
         if($imageData != "")
         { //public_path().  
             $destinationPath = 'competitor/' ;
             list($type, $imageData) = explode(';', $imageData);
             list(,$extension) = explode('/',$type);
             list(,$imageData)  = explode(',', $imageData);
             $fileName = uniqid().'.'.$extension;
             $before_image_url =  $fileName;
             $imageData = base64_decode($imageData);
             file_put_contents($destinationPath .$fileName, $imageData);
             $image_url = $fileName;
         }


         $result =   array(
            'timesheet_id'=> $request->timesheet_id,
            'outlet_id' => $Outlet_id,
            'company_name'  => $request->company_name,
             'brand_name' => $request->brand_name,
             'item_name' => $request->item_name,  
             'promotion_type' => $request->promotion_type,
             'promotion_description' => $request->promotion_description,
             'mrp' => $request->mrp,
             'selling_price'=>$request->selling_price,
             'device' => "Mobile",
             'created_by' =>  Auth::user()->emp_id,
           //  'capture_image'=> $before_image_url,
           //  'updated_at'  => date('y-m-d H:i:s'),
           //  'created_at' => date('y-m-d H:i:s')

         );

         if ($competitor->isNotEmpty()) {

            $array2 = array(
                'updated_at' => date('y-m-d H:i:s'),
            );
  
                $array3 = array(
                    'capture_image' =>$before_image_url,
                );

                $output = array_merge($result, $array2);
                 
                if($before_image_url != null)
                $output = array_merge($result, $array2, $array3);
            
            
             $result = DB::table('competitor')
                ->where('timesheet_id', $request->timesheet_id)
                ->update($output);

              return  $printReport->send_result_msg($this->success_status,$result);
              

         }
        else
        {

            $array2 = array(
                'created_at' => date('y-m-d H:i:s'),
            );

                $array3 = array(
                    'capture_image' =>$before_image_url,
                );

                $output = array_merge($result, $array2);
                 
                if($before_image_url != null)
                $output = array_merge($result, $array2, $array3);

         $result =  DB::table('competitor')->insert($output);

         $notify = new ApiNotificationController();
         $add_notify1 =  $notify->add_audit_trails("Compititor captured info", "compititor");

              $user = Auth::user()->emp_id;
                $notify = new ApiNotificationController();
                $ReportToID = "Emp5906";
                $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
                if( $ReportTo != "")
                $ReportToID = $ReportTo->reporting_to_emp_id; 
                $title = "Merchandiser update competitor";
                $user_type = "merchandiser";
                $created_to = $ReportToID;
                $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

          $add_notify1 =  $notify->add_audit_trails("Compititor captured info", "compititor");
    }
         
        return  $printReport->send_result_msg($this->success_status,$result);
        } 
        catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
       
     }


     public function add_competitor_visibility(Request $request)
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
                'timesheet_id'=>'required',
                'company_name' =>'required',
                'brand_name'=>'required',
                'visibility_type'=>'required',
            ]);
         
         if($validator->fails()) {
             return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
         }  

         $competitor = DB::table('competitor')
         ->where('timesheet_id', $request->timesheet_id)
         ->where('competitor.is_active', 1)
         ->get();

         $imageData = $request->visibility_image;  $before_image_url = null;
         if($imageData != "")
         { //public_path().
             $destinationPath = 'competitor/' ;
             list($type, $imageData) = explode(';', $imageData);
             list(,$extension) = explode('/',$type);
             list(,$imageData)  = explode(',', $imageData);
             $fileName = uniqid().'.'.$extension;
             $before_image_url =  $fileName;
             $imageData = base64_decode($imageData);
             file_put_contents($destinationPath .$fileName, $imageData);
             $image_url = $fileName;
         }


         $result =   array(
            'timesheet_id'=> $request->timesheet_id,
            'company_name'  => $request->company_name,
            'brand_name' => $request->brand_name,
            'visibility_type' => $request->visibility_type,  
            'device' => "Mobile",
            'created_by' =>  Auth::user()->emp_id,
           //  'capture_image'=> $before_image_url,
           //  'updated_at'  => date('y-m-d H:i:s'),
           //  'created_at' => date('y-m-d H:i:s')

         );

         if ($competitor->isNotEmpty()) {

            $array2 = array(
                'updated_at' => date('y-m-d H:i:s'),
            );

                $array3 = array(
                    'visibility_image' =>$before_image_url,
                );

                $output = array_merge($result, $array2);
                 
                if($before_image_url != null)
                $output = array_merge($result, $array2, $array3);
            
            
             $result = DB::table('competitor')
                ->where('timesheet_id', $request->timesheet_id)
                ->update($output);

              return  $printReport->send_result_msg($this->success_status,$result);

         }
        else
        {

            $array2 = array(
                'created_at' => date('y-m-d H:i:s'),
            );

                $array3 = array(
                    'visibility_image' =>$before_image_url,
                );

                $output = array_merge($result, $array2);
                 
                if($before_image_url != null)
                $output = array_merge($result, $array2, $array3);

         $result =  DB::table('competitor')->insert($output);
    }
         
        return  $printReport->send_result_msg($this->success_status,$result);
    } 
    catch (\Exception $e) {
        return response()->json(['error' =>  $e->getmessage()], 500);
    }
       
     }
}
