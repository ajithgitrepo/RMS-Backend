<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\availability;
use App\merchant_timesheet;
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


class ApiShareOfShelfController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
     public $success_status = 200;

     public function share_of_shelf_details(Request $request)
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
         $matchThese = ['merchant_time_sheet.is_active' => '1'];

           /*  $result = DB::table('merchant_time_sheet')
                 ->select('merchant_time_sheet.*','brand_details.brand_name as b_name', 'brand_details.id as b_id', 'shareof_shelf.share', 'shareof_shelf.actual', 
                 'shareof_shelf.target', 'shareof_shelf.total_share', 
                 'category_details.category_name as c_name',
                   'outlet_products_mapping.shelf','outlet_products_mapping.target')
     
                 ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
     
                 ->leftJoin('brand_details', 'brand_details.id', '=', 'outlet_products_mapping.brand_id')
                
           
                 //->leftJoin('shareof_shelf', 'shareof_shelf.timesheet_id', '=', 'merchant_time_sheet.id')
     
                 ->leftJoin('shareof_shelf', function ($join) {
                     $join->on('shareof_shelf.brand_id', '=', 'outlet_products_mapping.brand_id')
                          ->on('shareof_shelf.timesheet_id', '=', 'merchant_time_sheet.id');
         ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')

   ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')         })

         
              
                 ->where('merchant_time_sheet.id',($request->time_sheet_id))
                 //->where('shareof_shelf.timesheet_id', Crypt::decrypt($request->id))
                 ->where($matchThese)
                 //->groupBy('brand_details.id')
                 ->groupBy('c_name')
                 ->get();  */

                 $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*',
            'outlet_products_mapping.target as opm_target',
            'outlet_products_mapping.shelf as opm_shelf',
            'shareof_shelf.target as merch_update_target',
            'shareof_shelf.share as merch_update_share', 
            'shareof_shelf.reason as reason', 
            'shareof_shelf.actual as merch_update_actual',  
          'nbl_files.file_url as nbl_pdf',
            'category_details.category_name', 
            'category_details.id as c_id')

            ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
  
            ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

            ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
            
            ->leftJoin('nbl_files', 'nbl_files.outlet_id', '=', 'outlet_products_mapping.outlet_id')
              
            ->leftJoin('outlet_products_mapping as opm_cat', 'opm_cat.category_id', '=', 'category_details.id')
 
            ->leftJoin('shareof_shelf', function ($join) {
                $join->on('shareof_shelf.category_id', '=', 'category_details.id')
                     ->on('shareof_shelf.timesheet_id', '=', 'merchant_time_sheet.id');
            })
            ->where('category_details.is_active', 1)
            ->where('merchant_time_sheet.id', ($request->time_sheet_id))
            //->where('shareof_shelf.timesheet_id', Crypt::decrypt($request->id))
            ->where($matchThese)
            ->groupBy('category_details.category_name')
           
            //->where('shareof_shelf.is_active', 1)
           // ->where('category_details.is_active', 1)
           // ->where('shareof_shelf.is_active', 1)
            ->where('outlet_products_mapping.is_active', 1)
            ->get();

     
              //dd($result);
     
             if ($result->isNotEmpty()) {
                return $printReport->send_result_msg($this->success_status, $result);
              }
     
            //  $result = DB::table('merchant_time_sheet')
            //      ->select('merchant_time_sheet.*','brand_details.brand_name as b_name', 'brand_details.id as b_id')
            //      ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            //      ->leftJoin('brand_details', 'brand_details.id', '=', 'outlet_products_mapping.brand_id')
            //      ->where('merchant_time_sheet.id', ($request->time_sheet_id))
            //      ->where($matchThese)
            //      ->get();
       
          return $printReport->send_result_msg($this->success_status, $result);
 
     } 

     public function add_share_of_shelf(Request $request)
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
                'category_name' =>'required',
                 'category_id'  =>'required',
                 'total_share' =>'required',
                 'share' =>'required',
                 'target' =>'required',
                 'actual' =>'required',
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
              $JsonType .=  '"timesheet_id"'. ':"' .$request->timesheet_id . '", ';
              $JsonType .=  '"outlet_products_mapping_id"'. ':"' .$request->outlet_products_mapping_id . '", ';

               $JsonType .=  '"category_name"'. ':"' .$request->category_name[$i] . '", ';
               $JsonType .=  '"category_id"'. ':"' .$request->category_id[$i] . '", ';
               $JsonType .=  '"reason"'. ':"' .$request->reason[$i] . '", ';
               
                $JsonType .=  '"total_share"'. ':"' .$request->total_share[$i] . '", ';
               $JsonType .=  '"share"'. ':"' .$request->share[$i] . '", ';
                $JsonType .=  '"target"'. ':"' .$request->target[$i] . '", ';
                $JsonType .=  '"actual"'. ':"' .$request->actual[$i] . '" ';  
               
                $JsonType .= "},";
            }
        $JsonType = rtrim($JsonType, ", ");
        $JsonType .= "]";

        // $test = '[{"outlet_id":"22","timesheet_id":"110"},
        // {"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"}]';

       
        $someArray =   json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $JsonType), true );
        
        // $test = '[{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"}]';
      //  $someArray = json_decode(trim($contents), TRUE);
        // json_decode($JsonType, true);
        
     //  $test = '[{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"},{"outlet_id":"22","timesheet_id":"110"}]';
       
    //   $testnew= "[{\"outlet_id\":\"3\",\"timesheet_id\":\"625\",\"brand_id\":\"3\",\"total_share\":\"3\",\"share\":\"2\",\"target\":\"40\" \"actual\":\"75\"},\"outlet_id\":\"3\",\"timesheet_id\":\"625\",\"brand_id\":\"5\",\"total_share\":\"2\",\"share\":\"2\",\"target\":\"50\" \"actual\":\"80\"}]";
       
      // $someArray = json_decode($JsonType, true);
        
         //dd($someArray);
  
         $date = \Carbon\Carbon::now();

         $i = 0;

        for($i = 0; $i<count($someArray); $i++)
         {
            if($someArray[$i]['actual'] == 0 || $someArray[$i]['actual'] == "" )
                return response()->json(0);
        }

         for($i = 0; $i<count($someArray); $i++)
         {

            $availability = array(
               // 'outlet_id' => $someArray[$i]['outlet_id'], 
                'date' => $date, 
                'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'], 
                 'outlet_id' => $someArray[$i]['outlet_id'], 
                'timesheet_id' => $someArray[$i]['timesheet_id'], 
                'category_name' => $someArray[$i]['category_name'],
                'category_id' => $someArray[$i]['category_id'],
                'total_share' => $someArray[$i]['total_share'],
                'share' => $someArray[$i]['share'],
                'target' => $someArray[$i]['target'],
                'actual' => $someArray[$i]['actual'],
                'reason' => $someArray[$i]['reason'],
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => Auth::user()->emp_id,
                'device' => "Mobile"
            );

            //dd($availability);

            $check = DB::table('shareof_shelf')
                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                ->where('category_id', $someArray[$i]['category_id'])
                ->where('is_active', 1)
                ->get();

           // dd($check);

            if ($check->isEmpty()) {
               
                $result = DB::table('shareof_shelf')->insert($availability);

            }  

             if ($check->isNotEmpty()) {

                 $result = DB::table('shareof_shelf')
                    ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                    ->where('category_id', $someArray[$i]['category_id'])
                    ->update([
                        'outlet_id' => $someArray[$i]['outlet_id'], 
                        'date' => $date, 
                      'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'], 
                       'outlet_id' => $someArray[$i]['outlet_id'], 
                        'timesheet_id' => $someArray[$i]['timesheet_id'], 
                        'category_id' => $someArray[$i]['category_id'],
                        'category_name' => $someArray[$i]['category_name'],
                        'total_share' => $someArray[$i]['total_share'],
                        'share' => $someArray[$i]['share'],
                        'target' => $someArray[$i]['target'],
                        'actual' => $someArray[$i]['actual'],
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
         $title = "Merchandiser update shareof_shelf";
         $user_type = "merchandiser";
        // $created_to = $ReportToID;
         $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

         $add_notify1 =  $notify->add_audit_trails("Share of shelf detailed caputred", "share_of_shelf");
         
             return  $printReport->send_result_msg($this->success_status,$result);
            } 
            catch (\Exception $e) {
                return response()->json(['error' =>  $e->getmessage()], 500);
            }
       
     }
}
