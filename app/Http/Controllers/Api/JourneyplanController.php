<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\Outlet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiJourneyPlanController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;

    public function journey(Request $request, journeyplan $modal)
    {
        $EmpID = $request->emp_id;
        $user   =  Auth::user();
        $currentMonth = date('m');
         $date = \Carbon\Carbon::now()->format('Y-m-d');

        if(!is_null($user)) {  //$user->id  
            $post  =  DB::table('merchant_time_sheet')
            ->select(array('merchant_time_sheet.*','outlet.outlet_id','outlet.outlet_name', 'outlet.outlet_lat', 'outlet.outlet_area', 'outlet.outlet_city', 'outlet.outlet_state', 'outlet.outlet_country'))
            ->join('outlet','outlet.outlet_id','=','merchant_time_sheet.outlet_id')
          //  ->whereRaw('MONTH(merchant_time_sheet.date) = ?',[$currentMonth])
               //  ->where('merchant_time_sheet.date', $date)
           // ->where('is_present',1)
            ->where('employee_id', $EmpID)
            ->get();   
            
            // journeyplan::where("employee_id", $id)->where("employee_id", $id)->first();
            
            if(!is_null($post)) {  
                return response()->json(["status" => $this->success_status, "success" => true, "data" => $post]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => $post ]);
            }
        }

        else {
            return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
        }   
    }

    
	
    public function today_planned_journey(Request $request, journeyplan $modal)
    {

        $user   =  Auth::user();
        if(!is_null($user)) { 

            $emp_id = $request->emp_id; 
            $Date = Carbon::now();
            $Day = $Date->format('l'); 
            $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => $emp_id];

            $resultDate = journeyplan::with('outlet')//->with('employee')
            ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id' )
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
             ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
             ->where($matchThese)->whereDate('date', date('Y-m-d'))
             ->get();

             $resultDay = journeyplan::where($matchThese)->where('day', $Day)->with('outlet')//->with('employee')
             ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id')
             ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
              ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
              ->get();

             $merged = array_merge($resultDate->toArray(), $resultDay->toArray());

            if(!is_null($merged)) {  
                return response()->json(["status" => $this->success_status, "success" => true, "data" => $merged]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => $merged ]);
            }
        }
        else {
            return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
        } 

    }

    public function complete_percentage(Request $request, journeyplan $modal)
    {

        $emp_id = $request->emp_id;

        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id];

        $percentage = DB::table('merchant_time_sheet')
            ->where('employee_id',$emp_id)
            ->whereMonth('date', Carbon::now()->month)
            ->where('is_active',1)
            ->select(DB::raw('(select count(*) from merchant_time_sheet where is_completed = 1 AND MONTH(date) = MONTH(CURRENT_DATE()) ) / count(*) * 100 as month_percentage'))
           // ->groupBy('employee_id')
            ->get();

        return response()->json($percentage);

    }

    public function today_completed_journey(Request $request, journeyplan $modal)
    {
        $user   =  Auth::user();
        if(!is_null($user)) {  

        $emp_id = $request->emp_id;

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => $emp_id];
       // ->with('employee')
       $Date = Carbon::now();
       $Day = $Date->format('l'); 
      /* $result = DB::table('merchant_time_sheet as merch') 
       //journeyplan::with('outlet')
       //->whereDate('merch.date', date('Y-m-d'))
       //->Where('merch.day',$Day)//->with('employee')
       ->select('merch.*','sd.*','ol.*' ,'merch.id','merch.employee_id',
        'ol.date', 'ol.employee_id','ol.is_completed')
       ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merch.outlet_id')
       ->leftJoin('store_details as sd', 'sd.id', '=', 'outlet.outlet_name')
        ->leftJoin('outlet_login as ol', 'ol.employee_id', '=', 'merch.employee_id')
        ->whereDate('ol.date' ,date('Y-m-d'));
              //  ->get();
          $Query = $result->where('ol.date' ,date('Y-m-d'))->where($matchThese)->get();
      //  $result = journeyplan::where($matchThese)->whereDate('date', date('Y-m-d'))->with('outlet')->get(); 

      $resultDay = journeyplan::where($matchThese)->where('day', $Day)->with('outlet')//->with('employee')
      ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id')
      ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
       ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
       ->get(); */

     $result = DB::table('outlet_login as ol')->whereDate('ol.date' ,date('Y-m-d'))
     ->select('store_details.*','outlet.*')
     ->leftJoin('outlet', 'outlet.outlet_id', '=', 'ol.outlet_id')
       ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
     ->where('is_completed', 1)->get();

     // $merged = array_merge($resultDate->toArray(), $resultDay->toArray());

          if(!is_null($result)) {  
            return response()->json(["status" => $this->success_status, "success" => true, "data" => $result]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => $result ]);
        }
    }
    else {
        return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    } 

    }

    public function week_planned_journey(Request $request, journeyplan $modal)
    {

        $emp_id = $request->emp_id;

        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id];

        $result = journeyplan::where($matchThese)->with('outlet')->with('employee')
        ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();

        return response()->json($result);

    }

    public function week_completed_journey(Request $request, journeyplan $modal)
    {

        $emp_id = $request->emp_id;

        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id, 'is_completed' => '1'];

        $result = journeyplan::where($matchThese)->with('outlet')->with('employee')
        ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();

        return response()->json($result);

    }  

    public function today_skipped_journey(Request $request, journeyplan $modal)
    {
        $user   =  Auth::user();
        if(!is_null($user)) {  
        $emp_id = $request->emp_id;  //->with('employee')

       // $matchThese = ['is_active' => '1', 'employee_id' => $emp_id, 'is_completed' => '0'];

       // $result = journeyplan::where($matchThese)->whereDate('date', date('Y-m-d'))->with('outlet')->get();

       $result = DB::table('outlet_login as ol')->whereDate('ol.date' ,date('Y-m-d'))
       ->select('store_details.*','outlet.*')
       ->leftJoin('outlet', 'outlet.outlet_id', '=', 'ol.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
       ->where('is_completed', 0)->get();

        if(!is_null($result)) {  
            return response()->json(["status" => $this->success_status, "success" => true, "data" => $result]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => $result ]);
        }
    }
    else {
        return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    } 

    }

    public function week_skipped_journey(Request $request, journeyplan $modal)
    {

        

        $emp_id = $request->emp_id;

        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id, 'is_completed' => '0'];

        $result = journeyplan::where($matchThese)->with('outlet')->with('employee')
         ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
         ->get();

        return response()->json($result);

    }


    // By Emp_ID & Month
    public function timesheet_monthly(Request $request, journeyplan $modal)
    {
        $user   =  Auth::user();
        if(!is_null($user)) {  
        $emp_id = $request->emp_id;
        $timestamp = Carbon::parse($request->month);
        $Month =  $timestamp->month;
        $Year =  $timestamp->year;
        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id];

        $result = journeyplan::where($matchThese)->with('outlet') //->with('employee')
        ->whereRaw('MONTH(date) = ?',[$Month])->whereYear('date', $Year)
         ->get();

         if(!is_null($result)) {  
            return response()->json(["status" => $this->success_status, "success" => true, "data" => $result]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => $result ]);
        }
    }
    else {
        return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    } 

    }
     // By Emp_ID & Date
     public function timesheet_daily(Request $request, journeyplan $modal)
     {
         $user   =  Auth::user();
         if(!is_null($user)) {  
         $emp_id = $request->emp_id;
         $timestamp = Carbon::parse($request->date);
         $Date =  $request->date;
         $Year =  $timestamp->year;
         $matchThese = ['employee_id' => $emp_id, 'is_completed' => '1'];
 
        //// $result = journeyplan::where($matchThese)->with('outlet') //->with('employee')
         ///->whereDate('date', $Date)
        //  ->get();
          
          $Day = $timestamp->format('l'); 
         // $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => $emp_id];

          $resultDate = DB::table('outlet_login')->where($matchThese)//->with('employee')
         // ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id' )
          ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_login.outlet_id','store_details.store_name')
           ->whereDate('date', $timestamp)
           ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
           ->get();

        //    $resultDay = journeyplan::where($matchThese)->where('day', $Day)->with('outlet')//->with('employee')
        //    ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id')
        //    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        //     ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        //     ->get();

         //  $result = array_merge($resultDate->toArray(), $resultDay->toArray());
 
          if(!is_null($resultDate)) {  
             return response()->json(["status" => $this->success_status, "success" => true, "data" => $resultDate]);
         }
         else {
             return response()->json(["status" => "failed", "success" => false, "message" => $resultDate ]);
         }
     }
     else {
         return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
     } 
 
     }

     public function employee_details(Request $request, Employee $model) {
		$user   =  Auth::user();
        if(!is_null($user)) {  
	    $validator = Validator::make($request->all(), [
	        'emp_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}
		$emp_id = $request->emp_id;  
		$matchThese = ['is_active' => '1', 'employee_id' => $user->emp_id ];
		$UserID = $user->emp_id ;
		$result =  Employee::with('documents')->where($matchThese)->get(); 
		
		   if(!is_null($result)) {  
				return response()->json(["status" => $this->success_status, "success" => true, "data" => $result]);
			}
			else {
				return response()->json(["status" => "failed", "success" => false, "message" => $result ]);
			}
		}
		else {
			return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
		} 
	}
}
