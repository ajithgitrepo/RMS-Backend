<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Brand_details;
use App\Role;
use App\User;
use App\Employee;  
use App\Employee_Reporting_To;

use App\Http\availability;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Services\PayUService\Exception;

use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;


class ApiPlanogramCheckController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    
    public $success_status = 200;
    public function Planogram_details(Request $request)
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
      // otherwise
       $userExists = DB::table('planogram_checks')->where('timesheet_id', $request->id)->exists();
    
      /*  $result = DB::table('merchant_time_sheet')
        ->select( 'brand_details.id',
        //product_details.id as product_id','product_details.Image_url',
        //'product_details.product_name',
        'merchant_time_sheet.*','jointable.id as opm',
        'merchant_time_sheet.date as date' ,'brand_details.brand_name',
        //'category_details.category_name',
        'brand_details.brand_name','brand_details.id as BID',
        'jointable.planogram_img',
        'planogram_checks.before_image',
        'planogram_checks.after_image',
        'planogram_checks.id  as planlo_id',
        'category_details.category_name as c_name'
      );
     
         $result = $result->leftJoin('outlet_products_mapping as jointable', 'jointable.outlet_id', '=', 'merchant_time_sheet.outlet_id'); 
         $result = $result->leftJoin('brand_details', 'brand_details.id', '=', 'jointable.brand_id');
          
       // $result = $result->leftJoin('product_details', 'product_details.brand_id', '=', ' .brand_id');

         $result = $result->leftJoin('planogram_checks', function ($join) {
          $join->on('planogram_checks.brand_id', '=', 'brand_details.id')
              ->on('planogram_checks.timesheet_id', '=', 'merchant_time_sheet.id');
      });  
      
     //   $result = $result->addSelect(DB::raw("'image_url' as image_url, 
     //   'reason' as reason")) ;  
               
     //   $result = $result->addSelect(DB::raw("'image_url' as image_url, 'reason' as reason"));

     $result = $result->leftJoin('product_details', 'product_details.brand_id', '=', 'jointable.brand_id');

     $result = $result->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories');


        $result = $result->where('merchant_time_sheet.id',($request->time_sheet_id));
        //  $result = $result->where('product_details.is_active', 1);
         $result = $result->where($matchThese);
         $result = $result->groupBy('c_name');
         $result = $result->get();
        */

        $result = DB::table('merchant_time_sheet')
        ->select(
        'merchant_time_sheet.*','jointable.id as opm',
        'category_details.category_name',
        'category_details.id as c_id',
        'jointable.planogram_img',
        'planogram_checks.before_image',
        'planogram_checks.after_image',
        'planogram_checks.id  as planlo_id',
        'nbl_files.file_url as nbl_pdf',

      );
         $result = $result->leftJoin('outlet_products_mapping as jointable', 'jointable.outlet_id', '=', 'merchant_time_sheet.outlet_id'); 

      //   $result = $result->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'jointable.client_id');

         $result = $result->leftJoin('category_details', 'category_details.id', '=', 'jointable.category_id');
             
         $result = $result->leftJoin('nbl_files', 'nbl_files.outlet_id', '=', 'jointable.outlet_id');


         $result = $result->leftJoin('planogram_checks', function ($join) {
          $join->on('planogram_checks.category_id', '=', 'category_details.id')
               ->on('planogram_checks.timesheet_id', '=', 'merchant_time_sheet.id');
      });

      $result = $result->where('merchant_time_sheet.id',($request->time_sheet_id));
      //  $result = $result->where('product_details.is_active', 1);
       $result = $result->where($matchThese)->where('jointable.is_active', 1);
          
     //  $result = $result->whereNotNull('jointable.planogram_img');
       $result = $result ->where('category_details.is_active', 1);
       $result = $result->groupBy('category_details.category_name');
       $result = $result->get();
        

         return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function add_planogram(Request $request)
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
                'outlet_products_mapping_id'  =>'required',
                'timesheet_id' =>'required',
              //  'product_id' =>'required',
              'category_name' =>'required',

                'category_id'  =>'required',
               // 'brand_name' =>'required',
                'plano_image' =>'required',
                'before_image' =>'required',
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
          //  $JsonType .=  '"brand_id"'. ':"' .$request->brand_id[$i] . '", ';
            $JsonType .=  '"category_id"'. ':"' .$request->category_id[$i] . '", ';
            $JsonType .=  '"category_name"'. ':"' .$request->category_name[$i] . '", ';

          //  $JsonType .=  '"category_name"'. ':"' .$request->category_name[$i] . '", ';
          //  $JsonType .=  '"product_id"'. ':"' .$request->product_id[$i] . '", ';
            $JsonType .=  '"plano_image"'. ':"' .$request->plano_image[$i] . '", ';
           $JsonType .=  '"before_image"'. ':"' .$request->before_image[$i] . '", ';
            $JsonType .=  '"after_image"'. ':"' .$request->after_image[$i] . '" ';
           
            $JsonType .= "},";
        }
        $JsonType = rtrim($JsonType, ", ");
        $JsonType .= "]";
       
       // $test = '[{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"}]';
        $someArray = json_decode($JsonType, true);
       
       //dd($someArray);
      $date = \Carbon\Carbon::now(); 
      
        for($i = 0; $i<count($someArray); $i++)
        {
         $reason = NULL; $before_image_url = NULL;  $after_image_url = NULL;
           
                    $imageData = $someArray[$i]['before_image'];
                    if($imageData != "")
                    { //public_path().
                        $destinationPath = 'planogram_image/' ;
                        list($type, $imageData) = explode(';', $imageData);
                        list(,$extension) = explode('/',$type);
                        list(,$imageData)  = explode(',', $imageData);
                        $fileName = uniqid().'.'.$extension;
                        $before_image_url =  $fileName;
                        $imageData = base64_decode($imageData);
                        file_put_contents($destinationPath .$fileName, $imageData);
                        $image_url = $fileName;
                    }
                  
                     $imageData = $someArray[$i]['after_image'];
                    if($imageData != "")
                    { //public_path().
                        $destinationPath = 'planogram_image/' ;
                        list($type, $imageData) = explode(';', $imageData);
                        list(,$extension) = explode('/',$type);
                        list(,$imageData)  = explode(',', $imageData);
                        $fileName = uniqid().'.'.$extension;
                        $after_image_url =  $fileName;
                        $imageData = base64_decode($imageData);
                        file_put_contents($destinationPath .$fileName, $imageData);
                        $image_url = $fileName;
                    }
                 
       // 	dd($someArray[$i]['journy_date']);
          $visibility = array(
               'date' =>$date,
                'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'],
                 'outlet_id' => $someArray[$i]['outlet_id'],
                 'timesheet_id' => $someArray[$i]['timesheet_id'],
                // 'product_id' => $someArray[$i]['product_id'],
               //  'brand_id' => $someArray[$i]['brand_id'],
                 'category_id' => $someArray[$i]['category_id'],
                'category_name' => $someArray[$i]['category_name'],

                 //'category_name' => $someArray[$i]['category_name'],
               //  'product_name' => $someArray[$i]['product_name'],
                 'default_image' => $someArray[$i]['plano_image'],
                  'is_active' => '1', 
                 'created_at' => Carbon::now(),
                 'created_by' => Auth::user()->emp_id,
                 'device' => "Mobile"
               //  'updated_at' => Carbon::now()
             ); 
                if($before_image_url != null)
                { 
                      $data = array( 'before_image' => $before_image_url);
                     $visibility = array_merge($visibility, $data);
                   
                }  
                if($after_image_url != null)
                {   
                      $data = array( 'after_image' => $after_image_url);
                       $visibility = array_merge($visibility, $data);
                } 
           if($before_image_url != null || $after_image_url != null)   
           {      
             //dd($availability);
             $check = DB::table('planogram_checks')
                 ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
                 ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                 ->where('category_id', $someArray[$i]['category_id'])
                 ->where('is_active', 1)
                 ->count();
            // dd( $someArray[$i]['outlet_products_mapping_id']);
             if ($check == 0) {
             //  dd($visibility);
               $visibilityinsert = array('created_at' => Carbon::now());
               $output = array_merge($visibility, $visibilityinsert);
             //  dd($output);
               $result = DB::table('planogram_checks')->insert($output);


             }
             else { 
               // if($image_url !="" &&  $someArray[$i]['check_value'] == 1 )
                //   dd($visibility);
                   $visibilityupdate = array('updated_at' => Carbon::now());
                   $output = array_merge($visibility, $visibilityupdate);
                   $result = DB::table('planogram_checks')
                   ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
                   ->where('category_id', $someArray[$i]['category_id'])
                  // ->whereDate('date', '=', $someArray[$i]['journy_date'])
                   ->update($output); 
             }  
           } 
        }  
       
        $user = Auth::user()->emp_id;
        $notify = new ApiNotificationController();
        $ReportToID = "Emp5906";
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
        if( $ReportTo != "")
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        $title = "Merchandiser update planogram";
        $user_type = "merchandiser";
        $created_to = $ReportToID;
        $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

        $add_notifynew =  $notify->add_audit_trails("Planogram submitted", "Planogram");
        
     return $printReport->send_result_msg($this->success_status, $result);
          } 
          catch (\Exception $e) {
              return response()->json(['error' => $e->getmessage()], 500);
          }
      
    }

    
}
