<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Employee;
use App\outlet_products;

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

class ApiClientOutletReportController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;

    public function client_view_outlet_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $matchThese = ['merchant_time_sheet.is_active' => '1', 
        'outlet_products_mapping.is_active' => '1',
        'merchant_time_sheet.is_completed' => '1'
        ];
        
        $result = DB::table('outlet_products_mapping')
        ->select('outlet.outlet_id','store_details.store_name','merchant_time_sheet.*',
        'employee.first_name','employee.surname',
        'merchant_time_sheet.id as merch_id',
        //'brand_details.brand_name','category_details.category_name',
        'outlet_products_mapping.id as opm_id')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
      //  ->leftJoin('brand_details', 'brand_details.id', '=', 'outlet_products_mapping.brand_id')
      //  ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
        ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id');

        if($request->client_id != "")
        $result =  $result->where('outlet_products_mapping.client_id', $request->client_id);
        if($request->merchandiser_id != "")
        $result =  $result->where('merchant_time_sheet.employee_id', $request->merchandiser_id);
        $result =  $result->groupBy('merchant_time_sheet.id');
        $result =  $result->where($matchThese)
        ->whereMonth('merchant_time_sheet.date', Carbon::now()->month)
        ->orderBy('merchant_time_sheet.created_at','DESC')
        ->get();
       // ->join('store', 'store.id', '=', 'outlet.outlet_name')
        //->with('store', function($query) {
          //  $query->where('is_active',1)->select(['id','store_name']);
       // })
       
 
         //   return response()->json($result);
            
         return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function client_view_outlet_visibility_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'Outlet_mapping_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['visibility.is_active' => '1'];
        
        $result = DB::table('visibility')
        ->select('outlet.outlet_id','store_details.store_name','visibility.*')

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'visibility.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
       
        $result =  $result ->whereIn('visibility.outlet_products_mapping_id', $request->Outlet_mapping_id);
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->endOfMonth(); 
        $result =  $result ->where('visibility.outlet_id', $request->outlet_id )
        ->whereBetween('visibility.created_at',[$dateS,$dateE])
        ->orderBy('sharvisibilityeof_shelf.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function client_view_outlet_shareofself_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'Outlet_mapping_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['shareof_shelf.is_active' => '1'];
        
        $result = DB::table('shareof_shelf')
        ->select('outlet.outlet_id','store_details.store_name','shareof_shelf.*')

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'shareof_shelf.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
       
        $result =  $result ->whereIn('shareof_shelf.outlet_products_mapping_id', $request->Outlet_mapping_id);
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->endOfMonth(); 
        $result =  $result ->where('shareof_shelf.outlet_id', $request->outlet_id )
        ->whereBetween('shareof_shelf.created_at',[$dateS,$dateE])
        ->orderBy('shareof_shelf.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function client_view_outlet_availability_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'Outlet_mapping_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['availability.is_active' => '1'];
        
        $result = DB::table('availability')
        ->select('outlet.outlet_id','store_details.store_name','availability.*')

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'availability.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
       
        $result =  $result ->whereIn('availability.outlet_products_mapping_id', $request->Outlet_mapping_id);
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->endOfMonth(); 
        $result =  $result ->where('availability.outlet_id', $request->outlet_id )
        ->whereBetween('availability.created_at',[$dateS,$dateE])
        ->orderBy('availability.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function client_view_outlet_planogram_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'Outlet_mapping_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['planogram_checks.is_active' => '1'];
        
        $result = DB::table('planogram_checks')
        ->select('outlet.outlet_id','store_details.store_name','planogram_checks.*')

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'planogram_checks.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
       
        $result =  $result ->whereIn('planogram_checks.outlet_products_mapping_id', $request->Outlet_mapping_id);
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->endOfMonth(); 
        $result =  $result ->where('planogram_checks.outlet_id', $request->outlet_id )
        ->whereBetween('planogram_checks.created_at',[$dateS,$dateE])
        ->orderBy('planogram_checks.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function client_view_outlet_promotion_check_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'outlet_id' => 'required',
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
        $result =  $result ->where('promotion_check.outlet_id', $request->outlet_id )
        ->whereBetween('promotion_check.created_at',[$dateS,$dateE])
        ->orderBy('promotion_check.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function client_view_outlet_stock_expirey_details(Request $request)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'outlet_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['outlet_stockexpiry.is_active' => '1'];
        
        $result = DB::table('outlet_stockexpiry')
        ->select('outlet.outlet_id','store_details.store_name','outlet_stockexpiry.*')

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_stockexpiry.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
       
        $result =  $result ->where('outlet_stockexpiry.outlet_id', $request->outlet_id );
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->endOfMonth(); 
        $result =  $result ->where('outlet_stockexpiry.outlet_id', $request->outlet_id )
        ->whereBetween('outlet_stockexpiry.created_at',[$dateS,$dateE])
        ->orderBy('outlet_stockexpiry.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function client_view_outlet_competitior_info_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'outlet_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['competitor.is_active' => '1'];
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
         $dateE = Carbon::now()->endOfMonth(); 
        
        $result = DB::table('competitor')
        ->select('outlet.outlet_id','store_details.store_name','competitor.*')

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'competitor.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
       
        $result =  $result ->where('competitor.outlet_id', $request->outlet_id )
        ->whereBetween('competitor.created_at',[$dateS,$dateE])
        ->orderBy('competitor.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 
}
