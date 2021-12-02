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
use App\Http\Controllers\Api\ApiNotificationController;


class ApiPromotionController extends Controller
{ 
    //
    public function __construct() {
        $this->middleware('auth');
    }
     public $success_status = 200;

     public function fieldmanager_view_promotion_details(Request $request)
     {
         $user  =  Auth::user();
         // $date = \Carbon\Carbon::now()->format('Y-m-d');
          $printReport = new ApiJourneyPlanController();
          $chk =  $printReport->chech_auth($user);
         
         if($chk == false)
         return $printReport->auth_error_msg();
 
         $matchThese = ['promotion.is_active' => '1'];
      
         $result = DB::table('promotion')
         ->select('promotion.*','product_details.product_name','store_details.store_name')
         ->leftJoin('product_details', 'product_details.id', '=', 'promotion.product_id')
         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'promotion.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

         if($request->outlet_id != "")
         $result =  $result->where('promotion.outlet_id', $request->outlet_id)
         ->where($matchThese)
         ->get();
        
        return $printReport->send_result_msg($this->success_status, $result);
 
     } 

     public function fieldmanager_get_promotion_products_details(Request $request)
     {
         
         $user  =  Auth::user();
         // $date = \Carbon\Carbon::now()->format('Y-m-d');
          $printReport = new ApiJourneyPlanController();
          $chk =  $printReport->chech_auth($user);
         
         if($chk == false)
         return $printReport->auth_error_msg();

              // validation
             $validator      =   Validator::make($request->all(), [
                'outlet_id' =>'required',
                 ]);

         if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  
 
        $matchThese = ['outlet.is_active' => '1'];
       
        $result = DB::table('outlet')
        ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.Image_url',
        'outlet.outlet_id','brand_details.brand_name as b_name')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
        ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
        ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        ->where('outlet.outlet_id', $request->outlet_id)
        ->where('product_details.is_active', 1)
        ->where($matchThese)
        ->get();
        
        return $printReport->send_result_msg($this->success_status, $result);
 
     } 

     public function merchandiser_view_updated_promotion__details(Request $request)
     {
         $user  =  Auth::user();
         // $date = \Carbon\Carbon::now()->format('Y-m-d');
          $printReport = new ApiJourneyPlanController();
          $chk =  $printReport->chech_auth($user);
         
         if($chk == false)
         return $printReport->auth_error_msg();

              // validation 
             $validator      =   Validator::make($request->all(), [
                'time_sheet_id' =>'required',
                 ]);

         if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  
 
        $date = date('Y-m-d');

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name as p_name','merchant_time_sheet.*','brand_details.brand_name as b_name','category_details.category_name','promotion_check.image_url',
            'promotion_check.is_available','promotion_check.reason')

        ->leftJoin('promotion', 'promotion.outlet_id', '=', 'merchant_time_sheet.outlet_id')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'promotion.outlet_id')

        ->leftJoin('product_details', 'product_details.id', '=', 'promotion.product_id')
        //->leftJoin('promotion_check', 'promotion_check.product_id', '=', 'merchant_time_sheet.product_id')

        ->leftJoin('promotion_check', function ($join) {
            $join->on('promotion_check.product_id', '=', 'product_details.id')
                 ->on('promotion_check.timesheet_id', '=', 'merchant_time_sheet.id');
        })

        ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        ->where('merchant_time_sheet.id',($request->time_sheet_id))
        ->where('product_details.is_active', 1)

        ->where( DB::raw('from_date'), '<=',  $date )

        ->Where( DB::raw('to_date'), '>=', $date )

        ->where($matchThese) 
        ->groupBy('product_id')
        ->get();

        
        return $printReport->send_result_msg($this->success_status, $result);
 
     } 

     public function fieldmanager_add_promotion(Request $request)
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
                'outlet_id' => 'required',
                'product_id'=>'required',
                'from_date'=>'required',
                'to_date'=>'required',
                'description'=>'required',
            ]);
         
         if($validator->fails()) {
             return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
         }  

         //dd($request->all());    

         $from_date = $request->from_date;
         $new_from_date = date("Y-m-d", strtotime($from_date));  
 
         $to_date = $request->to_date;
         $new_to_date = date("Y-m-d", strtotime($to_date)); 

         for($i = 0; $i<count($request->product_id); $i++)
         {

            $fileName = NULL;
            $imageData = $request->img_url[$i];
            if($imageData != "")
            { //public_path().
            $destinationPath = 'promotion_image/' ;
            list($type, $imageData) = explode(';', $imageData);
            list(,$extension) = explode('/',$type);
            list(,$imageData)  = explode(',', $imageData);
            $fileName = uniqid().'.'.$extension;
            $imageData = base64_decode($imageData);
            file_put_contents($destinationPath .$fileName, $imageData);
            }

            $result = DB::table('promotion')->insert(
                array(
                    
                    'outlet_id'   => $request->outlet_id,
                    'product_id'   => $request->product_id[$i],
                    'from_date' => $new_from_date,
                    'to_date' => $new_to_date,
                    'description' => $request->description,
                    'img_url' => $fileName,
                    'created_by' => Auth::user()->emp_id,
                    'updated_at' => date('y-m-d H:i:s'),
                    'created_at' => date('y-m-d H:i:s'),
                    'device' => "Mobile"

                )
            );
        }  
       
        } 
        catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }  
        return  $printReport->send_result_msg($this->success_status, $result);
     }
    public function merchandiser_add_promotion__details(Request $request)
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
                'timesheet_id' =>'required',
                'product_id' =>'required',
                'check_value' =>'required',
            ]);
        
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  
        
        $JsonType = "[";
        for($i=0;$i<count($request->product_id);$i++)
        { 
            $JsonType .= "{"; 
            $JsonType .= '"outlet_id"'. ':"' .$request->outlet_id . '", ';
            $JsonType .=  '"timesheet_id"'. ':"' .$request->timesheet_id . '", ';
            $JsonType .=  '"product_id"'. ':"' .$request->product_id[$i] . '", ';
          //  $JsonType .=  '"product_name"'. ':"' .$request->product_name[$i] . '", ';
           $JsonType .=  '"check_value"'. ':"' .$request->check_value[$i] . '", ';
            $JsonType .=  '"reason"'. ':"' .$request->reason[$i] . '" ';
           
            $JsonType .= "},";
        }
        $JsonType = rtrim($JsonType, ", ");
        $JsonType .= "]";
       
       // $test = '[{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"}]';
        $someArray = json_decode($JsonType, true);

        for($i = 0; $i<count($someArray); $i++)
         {
            if(empty($someArray[$i]['reason']) && $someArray[$i]['check_value'] == 1 && $someArray[$i]['image_src'] =="undefined") 
            {
                return $printReport->send_result_msg(false, "Please select promotion image..");
            }
         if(empty($someArray[$i]['reason']) && $someArray[$i]['check_value'] == 0)
            {
                 //dd($i);
                 return $printReport->send_result_msg(false, "Please select reason..");
               
            }

         }

       
       //dd($someArray);
      $date = \Carbon\Carbon::now(); 
        $i = 0;
       for($i = 0; $i<count($someArray); $i++)
        {
           if($someArray[$i]['check_value'] == 0 && $someArray[$i]['reason'] == "null")
               return response()->json(0); 
        } 

        for($i = 0; $i<count($someArray); $i++)
        {
           $reason = NULL; $image_url = NULL; $fileName = NULL;
             if($someArray[$i]['check_value'] == 1)
         {
            
            
             $chk = "no";
              
                // if($fileName == $someArray[$i]['reason'] )
                //  {

                    
                    $imageData = $someArray[$i]['reason'];
                    if($imageData != "")
                    { //public_path().
                        $destinationPath = 'promotion_image/' ;
                        list($type, $imageData) = explode(';', $imageData);
                        list(,$extension) = explode('/',$type);
                        list(,$imageData)  = explode(',', $imageData);
                        $fileName = uniqid().'.'.$extension;
                        $imageData = base64_decode($imageData);
                        file_put_contents($destinationPath .$fileName, $imageData);
                        $image_url = $fileName;
                    }
               
       }
            if($someArray[$i]['check_value'] == 0) 
                $reason = $someArray[$i]['reason']; 
         // 	dd($someArray[$i]['journy_date']);
           $date = \Carbon\Carbon::now(); 

            $visibility = array( 
                'outlet_id' => $someArray[$i]['outlet_id'],
                'timesheet_id' => $someArray[$i]['timesheet_id'],
                'product_id' => $someArray[$i]['product_id'],
                'is_available' => $someArray[$i]['check_value'],
               // 'reason' => $reason,
               // 'image_url' => $image_url,
                'is_active' => '1',
                'device' => "Mobile"
           ); 
              if($someArray[$i]['check_value'] == 0)
              { 
               $image_url = NULL;
                 if($reason != "")
                 { 
                   $data = array('reason' => $reason,
                   'created_by' => Auth::user()->emp_id,
                   'image_url' => $image_url);
                   $visibility = array_merge($visibility, $data);
                 }
              }  
              else
              {   
                 $reason = NULL;
                 if($image_url != "")
                 {
                   $data = array(
                     'reason' => $reason, 'created_by' => Auth::user()->emp_id,
                     'image_url' => $image_url);
                     $visibility = array_merge($visibility, $data);
                 }

              } 
          
           //dd($availability);
           $check = DB::table('promotion_check')
                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                ->where('product_id', $someArray[$i]['product_id'])
                ->where('is_active', 1)
                ->count();
          // dd( $someArray[$i]['outlet_products_mapping_id']);
         //  if ($check != 0) {
             $visibilityinsert = array('created_at' => Carbon::now());
             $output = array_merge($visibility, $visibilityinsert);
             
             $result = DB::table('promotion_check')->insert($output); 

            
         //  }
        /*   else { 
             // if($image_url !=""  &&  $someArray[$i]['check_value'] == 1 )
              {
                 $visibilityupdate = array('updated_at' => Carbon::now());
                 $output = array_merge($visibility, $visibilityupdate);
                 
                 $result = DB::table('promotion_check')
                  ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                  ->where('product_id', $someArray[$i]['product_id'])
                  ->update($output); 

                 ///dd($output);
             }   */
         // }
        }

        $user = Auth::user()->emp_id;
        $notify = new ApiNotificationController();
        $ReportToID = "Emp5906";
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
        if( $ReportTo != "")
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        $title = "Merchandiser update promotion";
        $user_type = "merchandiser";
        $created_to = $ReportToID;
        $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

        $add_notify1 =  $notify->add_audit_trails("Promotion detailed caputred", "promotion");
        
            return $printReport->send_result_msg($this->success_status, $result);
        } 
        catch (\Exception $e) {
            return response()->json(['error' =>  $e->getmessage()], 500);
        }
      
    }
    
    public function merchandiser_view_updated_promotion_check_details(Request $request)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'emp_id' => 'required',
	        ]);
			if ($validator->fails())
		  	{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['promotion_check.is_active' => '1'];
        
        
        $result = DB::table('promotion_check')
        ->select('outlet.outlet_id','store_details.store_name','promotion_check.*','product_details.product_name')

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'promotion_check.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
         ->leftJoin('product_details', 'product_details.id', '=', 'promotion_check.product_id');
       
       // $result =  $result ->where('promotion_check.outlet_id', $request->outlet_id );
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->endOfMonth(); 
        $result =  $result ->where('promotion_check.created_by', $request->emp_id )
        ->whereBetween('promotion_check.created_at',[$dateS,$dateE])
        ->orderBy('promotion_check.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 
}
 