<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Store_details;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiStoreController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    
    public $success_status = 200;

    public function add_store(Request $request, Store_details $model)
    {
        try {
      
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =    Validator::make($request->all(), [
           "store_code" =>  "required",
           'store_name'=>'required',
           'contact_number' => 'required',
           'address' => 'required',
        ]);
        
           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

        // Get the value from the form
	//	$input['store_name'] =  $request->store_name;

		// Must not already exist in the `email` column of `users` table
		//$rules = array('store_name' => 'unique:store_details,store_name');

		//$validator =  Validator::make($input, $rules);
        $validator = $printReport->check_name_exists('store_name',$request->store_name,'store_details');
      //  Validator::make($input, $rules);

		 if ($validator->fails()) 
			return $printReport->failed_error_msg("Whoops! store name already exists");

        //  $result = $model->create($request->all());
          $result =   DB::table('store_details')->insert(
            array(
            'store_code'   => $request->store_code,
            'store_name'   =>  $request->store_name,
            'contact_number'   => $request->contact_number,
            'address'   =>  $request->address,
            'created_at' => date('y-m-d H:i:s')
            ));  
            return $printReport->send_result_msg($this->success_status, $result);
       }
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function store_details(Request $request, Store_details $modal)
    {
        $user  =  Auth::user();
        $date = date('Y');
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $matchThese = ['is_active' => '1',];

        $result = Store_details::where($matchThese)->get();

        return $printReport->send_result_msg($this->success_status, $result);

    }  

   
}
