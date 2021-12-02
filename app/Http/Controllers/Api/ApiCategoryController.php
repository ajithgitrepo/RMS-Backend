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

class ApiCategoryController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;

    public function add_category(Request $request, Category_details $model)
    {
        try {
      
        $user  =  Auth::user();  
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator  =  Validator::make($request->all(), [
            "category_name" =>  "required|min:3",
           ]);  

           if($validator->fails()) {  
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

          $validator = $printReport->check_name_exists('category_name',$request->category_name,'Category_details');
        
           if ($validator->fails()) 
              return $printReport->failed_error_msg("Whoops! name already exists");
     
        //  $result = $model->create($request->all());  
        
            $result =  DB::table('Category_details')->insert( 
            array( 
            "category_name" =>  $request->category_name,
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

    public function category_details(Request $request, Category_details $modal)
    {
        $user  =  Auth::user();  
        $date = date('Y'); 
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg();  

        $matchThese = ['is_active' => '1'];

        $result = Category_details::where($matchThese)
        ->get();
        
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function delete_category(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            "category_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->category_id;

    $matchThese = ['is_active' => '1'];

    $result = DB::table('category_details')
    ->where('id', $id)->update(['is_active' => '0']);

    return $printReport->send_result_msg($this->success_status, $result);

    }
}
