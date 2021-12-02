<?php

namespace App\Http\Controllers\api;

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


class ApiAvailabilityController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public $success_status = 200;
    public function availability_details(Request $request)
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
        'outlet.outlet_name','store_details.*',
        'product_details.Image_url','merchant_time_sheet.*','brand_details.brand_name as b_name',
        'category_details.category_name as c_name','availability.is_available','availability.reason')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
       // ->leftJoin('availability', 'availability.timesheet_id', '=', 'merchant_time_sheet.id')
        ->leftJoin('availability', function ($join) {
            $join->on('availability.product_id', '=', 'product_details.id')
                ->on('availability.timesheet_id', '=', 'merchant_time_sheet.id');
        })     
        ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        ->where('merchant_time_sheet.id', ($request->time_sheet_id))
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->where('product_details.is_active', 1)
        ->where($matchThese)   
      //  ->groupBy('product_id')
        ->get();  */

      /*  $result = DB::table('merchant_time_sheet')
       
        ->select('merchant_time_sheet.*','product_details.id as product_id','product_details.product_name as p_name',
        'product_details.Image_url', 'product_details.product_categories',
         'product_details.zrep_code','brand_client.brand_name as b_name',
        'brand_client.id as b_id','category_details.category_name as c_name','nbl_files.file_url as nbl_pdf',
        'availability.is_available','availability.reason')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

        ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

       // ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
       //  ->leftJoin('availability', 'availability.timesheet_id', '=', 'merchant_time_sheet.id')

         ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        
         ->leftJoin('nbl_files', 'nbl_files.outlet_id', '=', 'outlet_products_mapping.outlet_id')
        
         ->leftJoin('product_details', function ($join) {
            $join->on('product_details.brand_id', '=', 'brand_client.id')
                 ->on('product_details.product_categories', '=', 'category_details.id');
        })


        ->leftJoin('availability', function ($join) {
            $join->on('availability.product_id', '=', 'product_details.id')
                ->on('availability.timesheet_id',  '=', 'merchant_time_sheet.id');
        })

        ->where('merchant_time_sheet.id', ($request->time_sheet_id))
        ->where('product_details.is_active', 1)
        ->where('product_details.status', 1)
        ->where($matchThese)->where('outlet_products_mapping.is_active', 1)
        ->groupBy('product_details.id')
        ->get();   */

        // $Store_result = DB::table('store_details') ($request->time_sheet_id))
        // ->leftJoin('outlet', 'store_details.id', '=', 'outlet.outlet_name')
        // ->where('outlet.outlet_name',$request->time_sheet_id)
        // ->get();
        // ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
       // ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')

       $result = DB::table('merchant_time_sheet')
      
       ->select('merchant_time_sheet.*','map.id as opm','product_details.id as product_id',
       'product_details.product_name as p_name','product_details.Image_url',
       'brand_client.brand_name as b_name','brand_client.id as b_id',
       'product_details.zrep_code', 'product_details.product_categories',
       'category_details.category_name as c_name','availability.is_available','availability.reason')

       ->leftJoin('outlet_products_mapping as map', 'map.outlet_id', '=', 'merchant_time_sheet.outlet_id')

       ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'map.client_id')

        ->leftJoin('category_details', 'category_details.id', '=', 'map.category_id')

       // ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')

       // ->leftJoin('product_details as pro_map', 'pro_map.product_categories', '=', 'category_details.id')
       
       ->leftJoin('product_details', function ($join) {
               $join->on('product_details.brand_id', '=', 'brand_client.id')
                    ->on('product_details.product_categories', '=', 'category_details.id');
           })
       
       
       //->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')

       
       ->leftJoin('availability', function ($join) {
           $join->on('availability.product_id', '=', 'product_details.id')
               ->on('availability.timesheet_id', '=', 'merchant_time_sheet.id');
       })

       ->where('merchant_time_sheet.id', ($request->time_sheet_id))
       ->where('product_details.is_active', 1)
       ->where('product_details.status', 1)
       ->where('category_details.is_active', 1)
       ->where('map.is_active', 1)
       ->where($matchThese)
       ->groupBy('product_details.id')
       ->get();


       $category = DB::table('category_details')
       ->where('category_details.is_active', 1)
       ->get();
        
         return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function add_availability(Request $request)
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
                'timesheet_id' =>'required',
                'product_id' =>'required',
                'outlet_products_mapping_id' =>'required',
                'brand_name' =>'required',
                'category_name' =>'required',
                'product_name' =>'required',
                'check_value' =>'required',
                'reason' =>'required',
               // 'is_active' => '1',
              //  'created_at' => Carbon::now(),
              //  'updated_at' => Carbon::now()
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
        for($i=0;$i<count($request->product_id);$i++)
        { 
            $JsonType .= "{"; 
            $JsonType .= '"outlet_id"'. ':"' .$request->outlet_id . '", ';
            $JsonType .=  '"timesheet_id"'. ':"' .$request->timesheet_id . '", ';
            $JsonType .=  '"outlet_products_mapping_id"'. ':"' .$request->outlet_products_mapping_id . '", ';

         //  $JsonType .=  '"category_id"'. ':"' .$request->category_id[$i] . '", ';
            $JsonType .=  '"brand_name"'. ':"' .$request->brand_name[$i] . '", ';
           $JsonType .=  '"category_name"'. ':"' .$request->category_name[$i] . '", ';
            $JsonType .=  '"product_id"'. ':"' .$request->product_id[$i] . '", ';
            $JsonType .=  '"product_name"'. ':"' .$request->product_name[$i] . '", ';
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
            if($someArray[$i]['check_value'] == 1)
                $value = null;
            if($someArray[$i]['check_value'] == 0)
                $value = $someArray[$i]['reason'];
           // if($someArray[$i]['check_value'] == 0 && $someArray[$i]['reason'] == "null")
           //     return response()->json(0);
            //dd($someArray[$i]['reason']);
            $availability = array(
               'outlet_id' => $someArray[$i]['outlet_id'],
               'date' => $date,
               'timesheet_id' => $someArray[$i]['timesheet_id'],
               'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'],
               'product_id' => $someArray[$i]['product_id'],
               'brand_name' => $someArray[$i]['brand_name'],
               'category_name' => $someArray[$i]['category_name'],
               'product_name' => $someArray[$i]['product_name'],
               'is_available' => $someArray[$i]['check_value'],
               'reason' => $value,
               'is_active' => '1',
               'created_at' => Carbon::now(),
               'created_by' => Auth::user()->emp_id,
               'device' => "Mobile"
             //  'updated_at' => Carbon::now()
           );
           //dd($availability);
           $check = DB::table('availability')
               ->where('timesheet_id', $someArray[$i]['timesheet_id'])
               ->where('product_id', $someArray[$i]['product_id'])
               ->where('is_active', 1)
               ->get();
          // dd($check);
           if ($check->isEmpty()) {
               $result = DB::table('availability')->insert($availability);
              

           }
            if ($check->isNotEmpty()) {
                $result = DB::table('availability')
                   ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                   ->where('product_id', $someArray[$i]['product_id'])
                   ->update([
                     'outlet_id' => $someArray[$i]['outlet_id'],
                     'timesheet_id' => $someArray[$i]['timesheet_id'],
                    'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'],
                    'product_id' => $someArray[$i]['product_id'],
                     'brand_name' => $someArray[$i]['brand_name'],
                     'category_name' => $someArray[$i]['category_name'],
                     'product_name' => $someArray[$i]['product_name'],
                     'is_available' => $someArray[$i]['check_value'],
                     'reason' => $value,
                     'is_active' => '1',
                     'updated_at' => Carbon::now()
             ]);
           }
        }   

        $user = Auth::user()->emp_id;
        $notify = new ApiNotificationController();
        $ReportToID = "Emp5906";
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
        if( $ReportTo != "")
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        $title = "Merchandiser update availability";
        $user_type = "merchandiser";
        $created_to = $ReportToID;
        $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

        $add_notifynew =  $notify->add_audit_trails("Availability Updated", "Availability");

           return $printReport->send_result_msg($this->success_status, $result);
        } 
        catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
      
    }
}
