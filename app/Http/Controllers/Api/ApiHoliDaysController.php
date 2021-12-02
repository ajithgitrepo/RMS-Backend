<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Holidays;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Http\Controllers\Api\ApiJourneyPlanController;

class ApiHoliDaysController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    
    public $success_status = 200;

    public function add_holidays(Request $request, Holidays $model)
    {
        try {
      
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =    Validator::make($request->all(), [
           "date" =>  "required",
           'description'=>'required',
          ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

          $StatrtDate =   date("Y-m-d", strtotime($request->date)); 

        //  $result = $model->create($request->all());
        
            $result =   DB::table('holidays')->insert(
            array(
            'date'   => $StatrtDate,
            'description'   =>  $request->description,
            'created_at' => date('y-m-d H:i:s')
            ));  
            return $printReport->send_result_msg($this->success_status, $result);
       }
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function holidays_details(Request $request, Holidays $modal)
    {
        $user  =  Auth::user();
        $date = date('Y');
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $matchThese = ['is_active' => '1',];

        $result = Holidays::where($matchThese)->whereYear('date', $date)->get();

        return $printReport->send_result_msg($this->success_status, $result);

    }  
}
