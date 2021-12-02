<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product_details;
use App\Category_details;
use App\Brand_details;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Http\Controllers\Api\ApiJourneyPlanController;

class ApiBrandController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    
    public $success_status = 200;

    public function add_brand(Request $request, Brand_details $model)
    {
        try {
      
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator  =  Validator::make($request->all(), [
            "brand_name" =>  "required|min:3",
            'field_manager_id'=>'required',
            'sales_manager_id'=>'required',
            'client_id'=>'required',
           // 'created_by'=>'required',         
          ]);  

           if($validator->fails()) {   
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 
           $chk = Brand_details::where('brand_name',$request->brand_name)
           ->where('client_id',$request->client_id)->exists();
        //  $validator = $printReport->check_name_exists('brand_name',$request->brand_name,'brand_details');
      //  Validator::make($input, $rules);

		 if ($chk == true) 
			return $printReport->failed_error_msg("Whoops! brand name already exists");
     
      //    $StatrtDate = date("Y-m-d", strtotime($request->date)); 

            $result =  DB::table('brand_details')->insert(
            array(
            "brand_name" =>  $request->brand_name,
            'client_id'=>$request->client_id,
            'field_manager_id'=>$request->field_manager_id,
            'sales_manager_id'=>$request->sales_manager_id,
            'created_by'=>Auth::user()->emp_id,
            'created_at' => date('y-m-d H:i:s'),
            'device' => "Mobile"
            ));  
            return $printReport->send_result_msg($this->success_status, $result);
       }
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function brand_details(Request $request, Brand_details $modal)
    {
        $user  =  Auth::user();  
        $date = date('Y'); 
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg();  

        $matchThese = ['is_active' => '1'];

        $result = Brand_details::where($matchThese)
        ->with(array('employee_client' => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
        }))
        ->with(array('employee_field' => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
        }))
        ->with(array('employee_sales' => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
        }))
        ->get();
        
   // ->with('employee_client')->with('employee_field')
       // ->select('first_name','surname')->with('employee_sales')->get();
        //->with('employee')->get();

        return $printReport->send_result_msg($this->success_status, $result);

    }  

    public function delete_brand(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            "brand_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->brand_id;

    $matchThese = ['is_active' => '1'];

    $result = DB::table('brand_details')
    ->where('id', $id)->update(['is_active' => '0']);

    return $printReport->send_result_msg($this->success_status, $result);

    }
}
