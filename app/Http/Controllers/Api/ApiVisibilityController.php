<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Brand_details;
use App\Role;
use App\User;
use App\Employee;
use App\Http\availability;
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



class ApiVisibilityController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public $success_status = 200;
    public function visibility_details(Request $request)
    {
        
        $user   =  Auth::user();
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

       $matchThese = ['merchant_time_sheet.is_active' => '1'];
      /* $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name as p_name',
        'outlet.outlet_name','store_details.*','visibility.image_url',
        'outlet_products_mapping.id as outlet_products_mapping_id',
        'product_details.Image_url','merchant_time_sheet.*','brand_details.brand_name as b_name',
        'category_details.category_name as c_name','visibility.is_available','visibility.reason'
        ,'visibility.image_url') 
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
       // ->leftJoin('availability', 'availability.timesheet_id', '=', 'merchant_time_sheet.id')
        ->leftJoin('visibility', function ($join) {
            $join->on('visibility.product_id', '=', 'product_details.id')
                ->on('visibility.timesheet_id', '=', 'merchant_time_sheet.id');
        })     
        ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        ->where('merchant_time_sheet.id', ($request->time_sheet_id))
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->where('product_details.is_active', 1)
        ->where($matchThese)   
       ->groupBy('c_name')
        ->get();  */

        $result = DB::table('merchant_time_sheet')
          ->select('merchant_time_sheet.*','outlet_products_mapping.id as opm',
          'jointable.image_url','jointable.reason','jointable.is_available',
          'nbl_files.file_url as nbl_pdf',
          'category_details.category_name','category_details.id as c_id');
         // if($userExists == true) 

            $result = $result->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 
                'merchant_time_sheet.outlet_id'); 

            $result = $result->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id');

             $result = $result->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id');

             $result = $result->leftJoin('nbl_files', 'nbl_files.outlet_id', '=', 'outlet_products_mapping.outlet_id');
                               
            $result = $result->leftJoin('visibility as jointable', function ($join) {
                $join->on('jointable.category_id', '=', 'category_details.id')
                    ->on('jointable.timesheet_id', '=', 'merchant_time_sheet.id');
            });
            $result = $result->where('merchant_time_sheet.id',($request->time_sheet_id));
            $result = $result ->where('category_details.is_active', 1);
            $result = $result->where($matchThese)->where('outlet_products_mapping.is_active', 1);;
            $result = $result->groupBy('category_details.category_name');
            
            $result = $result->get();

        // $Store_result = DB::table('store_details') ($request->time_sheet_id))
        // ->leftJoin('outlet', 'store_details.id', '=', 'outlet.outlet_name')
        // ->where('outlet.outlet_name',$request->time_sheet_id)
        // ->get();
        // ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
       // ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        
         return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function add_visibility(Request $request)
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
                'outlet_id' =>'required',
                'outlet_products_mapping_id'  =>'required',
                'timesheet_id' =>'required',
              //  'product_id' =>'required',
              //  'brand_id'  =>'required',
              //  'brand_name' =>'required',
              'category_id' =>'required',
               'category_name' =>'required',
               // 'product_name' =>'required',
                //'is_available' =>'required',
                //'reason' =>'required',
            ]);
        
        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  

        $check = DB::table('merchant_time_sheet')
        ->where('id', $request->timesheet_id)
        ->where('outlet_id', $request->outlet_id)
        ->where('is_active', 1)
        ->get();
   // dd($check);
    if ($check->isEmpty()) {
        return response()->json(["status" => "failed", "timesheet not mapping to brand"]);
    }
        
        $JsonType = "[";
        for($i=0;$i<count($request->category_id);$i++)
        { 
            $JsonType .= "{"; 
            $JsonType .= '"outlet_id"'. ':"' .$request->outlet_id . '", ';
            $JsonType .=  '"outlet_products_mapping_id"'. ':"' .$request->outlet_products_mapping_id . '", ';
            $JsonType .=  '"timesheet_id"'. ':"' .$request->timesheet_id . '", ';
            $JsonType .=  '"g_area"'. ':"' .$request->g_area[$i] . '", ';
            $JsonType .=  '"main_aisle"'. ':"' .$request->main_aisle[$i] . '", ';
            $JsonType .=  '"pois"'. ':"' .$request->pois[$i] . '", ';
            $JsonType .=  '"category_id"'. ':"' .$request->category_id[$i] . '", ';
            $JsonType .=  '"category_name"'. ':"' .$request->category_name[$i] . '", ';
          //  $JsonType .=  '"product_name"'. ':"' .$request->product_name[$i] . '", ';
           $JsonType .=  '"check_value"'. ':"' .$request->check_value[$i] . '", ';
            $JsonType .=  '"reason"'. ':"' .$request->reason[$i] . '" ';
           
            $JsonType .= "},";  
        }
        $JsonType = rtrim($JsonType, ", ");
        $JsonType .= "]";
       
       // $test = '[{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"}]';
        $someArray = json_decode($JsonType, true);
       
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
                        $destinationPath = 'visibility_image/' ;
                        list($type, $imageData) = explode(';', $imageData);
                        list(,$extension) = explode('/',$type);
                        list(,$imageData)  = explode(',', $imageData);
                        $fileName = uniqid().'.'.$extension;
                        $imageData = base64_decode($imageData);
                        file_put_contents($destinationPath .$fileName, $imageData);
                        $image_url = $fileName;
                    }
                 
                   
                // }

       }
            if($someArray[$i]['check_value'] == 0) 
                $reason = $someArray[$i]['reason']; 
         // 	dd($someArray[$i]['journy_date']);
      $date = \Carbon\Carbon::now(); 

            $visibility = array( 
              'date' =>$date,
              'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'],
               'outlet_id' => $someArray[$i]['outlet_id'],
               'timesheet_id' => $someArray[$i]['timesheet_id'],
               'category_id' => $someArray[$i]['category_id'],
              
               'g_area' => $someArray[$i]['g_area'],
              'main_aisle' => $someArray[$i]['main_aisle'],
               'pois' => $someArray[$i]['pois'],

               'category_name' => $someArray[$i]['category_name'],
              // 'product_name' => $someArray[$i]['product_name'],
               'is_available' => $someArray[$i]['check_value'],
              // 'reason' => $reason,
              // 'image_url' => $image_url,
               'is_active' => '1',
               'created_by' => Auth::user()->emp_id,
               'device' => "Mobile"
              // 'created_at' => Carbon::now(),
             //  'updated_at' => Carbon::now()
           ); 
              if($someArray[$i]['check_value'] == 0)
              { 
               $image_url = NULL;
                 if($reason != "")
                 { 
                   $data = array('reason' => $reason,
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
                     'reason' => $reason,
                     'image_url' => $image_url);
                     $visibility = array_merge($visibility, $data);
                 }

              } 
             

           //dd($availability);
           $check = DB::table('visibility')
               ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
               ->where('timesheet_id', $someArray[$i]['timesheet_id'])
               ->where('category_id', $someArray[$i]['category_id'])
               ->where('is_active', 1)
               ->count();
          // dd( $someArray[$i]['outlet_products_mapping_id']);
           if ($check == 0) {
             $visibilityinsert = array('created_at' => Carbon::now());
             $output = array_merge($visibility, $visibilityinsert);
            // $reason = NULL; $image_url = NULL;
             if($reason != NULL || $image_url != NULL )
             $result = DB::table('visibility')->insert($output); 
             else
             $result = false;
            
           }
           else { 
             // if($image_url !=""  &&  $someArray[$i]['check_value'] == 1 )
              {
                 $visibilityupdate = array('updated_at' => Carbon::now());
                 $output = array_merge($visibility, $visibilityupdate);
                 $result = DB::table('visibility')
                 ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
                 ->where('category_id', $someArray[$i]['category_id'])
               //  ->whereDate('date', '=', $someArray[$i]['journy_date'])
                 ->update($output); 

                 ///dd($output);
             }
         }
        }


        $user = Auth::user()->emp_id;
        $notify = new ApiNotificationController();
        $ReportToID = "Emp5906";
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
        if( $ReportTo != "")
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        $title = "Merchandiser update visibility";
        $user_type = "merchandiser";
        $created_to = $ReportToID;
        $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

        $add_notifynew =  $notify->add_audit_trails("Visibility submitted", "Visibility");
        
       return $printReport->send_result_msg($this->success_status, $result);
          } 
          catch (\Exception $e) {
              return response()->json(['error' => $e->getmessage()], 500);
          }
    }

}
