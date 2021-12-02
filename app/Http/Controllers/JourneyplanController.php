<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Employee_Reporting_To;

use App\Http\Controllers\AuditController as audit_store;

class JourneyplanController extends Controller
{
	public function index(journeyplan $modal)
	{
        //dd(Auth::user()->role->name);
       
		 $date = \Carbon\Carbon::now();

		 $day = $date->format('l');

		//dd($day);
		 $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => Auth::user()->emp_id, 'merchant_time_sheet.is_defined' => '1'];

		// $result = journeyplan::where($matchThese)->with('outlet')->with('employee')->with('outlet_login')
			$value = 'someName';
			$result = journeyplan::where($matchThese)->with(['outlet', 'employee'])
			 ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code')
			 ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
			 ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
			 //->leftJoin('outlet_login', 'outlet_login.timesheet_id', '=', 'merchant_time_sheet.id')
			 //->where('merchant_time_sheet.day', $day)
			->get();

		//dd($result);

		//$matchThese = ['is_active' => '1'];

		//$result = journeyplan::where($matchThese)->whereDate('date', date('Y-m-d'))->with('outlet')->with('employee')->get();

		//$result = $model->with('documents')->with('Role')->where($matchThese)->get();

	   // dd($result);

  //   	$start_time = "09:00:00";
		// $end_time = "20:30:00";

		// $start_datetime = new DateTime(date('Y-m-d').' '.$start_time);
		// $end_datetime = new DateTime(date('Y-m-d').' '.$end_time);

		// dd($start_datetime->diff($end_datetime));

		//$timeDifference = Carbon::parse($hours->finish)->diffInMinutes(Carbon::parse($hours->start));
		//$hours->total = $timeDifference / 60;

	   //  $lat = 12.95030677;
	   //  $lon = 79.13785788;

	   // $result = DB::table("outlet")
	   //  ->select("outlet.outlet_name"
	   //      ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
	   //      * cos(radians(outlet.outlet_lat)) 
	   //      * cos(radians(outlet.outlet_long) - radians(" . $lon . ")) 
	   //      + sin(radians(" .$lat. ")) 
	   //      * sin(radians(outlet.outlet_lat))) AS distance"))
	   //      ->where('is_active', '1')
	   //      ->orderBy("distance")
	   //      ->get();

	   //   dd($result);   


		return view('journey_plan.index');
	}

	public function get_journey_plan(journeyplan $modal)
	{
		// $matchThese = ['is_active' => '1', 'employee_id' => Auth::user()->emp_id, 'is_defined' => '0'];

	 //    $result = journeyplan::where($matchThese)
	 //        ->whereDate('date', date('Y-m-d'))
	 //        ->with('outlet')->with('employee')
	 //        ->get();

		 $date = \Carbon\Carbon::now();

		 $date1 = date('Y-m-d');
		 //dd($date1);

		 $day = $date->format('l');

		//dd($day);
		 $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => Auth::user()->emp_id];

		// $result = journeyplan::where($matchThese)->with('outlet')->with('employee')->with('outlet_login')
			$value = 'someName';
			$result = journeyplan::where($matchThese)->with(['outlet', 'employee'])
			 ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code')
			 ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
			 ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
			 //->leftJoin('outlet_login', 'outlet_login.outlet_id', '=', 'merchant_time_sheet.outlet_id')
			 //->where('merchant_time_sheet.day', $day)
			 ->Where('merchant_time_sheet.date', $date1)
			 ->where('merchant_time_sheet.is_active', '1')
			 //->where('merchant_time_sheet.is_defined', '0')
			->get();

	   		//dd($result);

		return response()->json($result);

	}

	public function get_by_date(journeyplan $modal, Request $request)
	{
		$matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => Auth::user()->emp_id];

		$date = $request->date;
		//$day = $request->day;
		//dd($date);
		$new_date = date("Y-m-d", strtotime($date)); 

		$value = 'someName';
		$result = journeyplan::where($matchThese)->with('outlet')->with('employee')
			 ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code')
			 ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
			 ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

		if(isset($date))
		{
		   //dd($date); 
		   $result->with('outlet_login'); 
		   $result->whereDate('date', $new_date);
		   //$result->where('merchant_time_sheet.is_defined', 0);

		}

		// if(isset($day) && empty($date))
		// {
		   
		// 	$result->with(['outlet_login'  => function($q) use($value) {
		// 		// Query the name field in status table
		// 		$q->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
		// 	}]);

		// 	$result->where('day', $day);
		// 	$result->where('merchant_time_sheet.is_defined', 1);

		// }

		// if(isset($day) && isset($date))
		// {
		//    //dd($day);
		//    $result->with('outlet_login'); 
		//    $result->whereDate('date', $new_date);
		//    $result->where('merchant_time_sheet.is_defined', 0);

		// }

		$query = $result->get();

	   // dd($query);

		return response()->json($query);

	}

	public function outlet_check_in(Request $request)
	{
		$matchThese = ['is_active' => '1'];

		$id = $request->id;
		// $lat = $request->lat;
		// $lng = $request->lng;
		// $address = $request->address;
		//dd($lat);

		$date = Carbon::now();
	   // dd($date);
		$checkin_time = $date->toDateTimeString();

	  
		$login = array(
			
			'is_present?' => '1',
			'checkin_time' => $checkin_time,
			'updated_at' => Carbon::now()
		);

	
		$check = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','outlet.outlet_state')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
			->where('merchant_time_sheet.id', $id)
			->where('merchant_time_sheet.is_active', 1)
			->get();

        //dd($check);

		$condition = DB::table('merchant_time_sheet')
			->where('id', $id)
			->whereDate('date', $date)
			->where('is_active', 1)
			->get();

      
		if (Carbon::now()->isSameDay($check[0]->date)) {
		   
			if($condition->isNotEmpty() && $condition[0]->checkin_time){
			//dd('enter');
				$affected = DB::table('merchant_time_sheet')
				  ->where('id', $id)
				  ->whereDate('date', $date)
				  ->update([
				  'updated_at' => Carbon::now()
				  ]);

               
                 if($check->isNotEmpty())
                {
                    //dd(1);
                    $outlet_name = $check[0]->store_name.'['.$check[0]->store_code.'],'.$check[0]->address.','.$check[0]->outlet_state; 

                    $audit = new audit_store(); 
                    $description = ' checked again in '.$outlet_name;
                    $add_audit =  $audit->store($description,'CheckIn'); 
                } 
		   
			}
            
			else{
				//dd('new login');
				$affected = DB::table('merchant_time_sheet')
				  ->where('id', $id)
				  ->whereDate('date', $date)
				  ->update([
				  	'is_present?' => '1',
					'checkin_time' => $checkin_time,
				  	'updated_at' => Carbon::now()
				  ]);

                $user = Auth::user()->emp_id;

                $notify = new NotificationController();
                 $ReportTo = "";
                 $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
                 if( $ReportTo != "")
                 $ReportToID = $ReportTo->reporting_to_emp_id; 
                 $title = "Merchandiser CheckIn In Outlet";
                 $user_type = "merchandiser";
                 $created_to = $ReportToID;
                 $add_notify =  $notify->store($title, $user_type, $ReportToID);

               // $outlet_name = $check[0]->store_name.'['.$check[0]->store_code.'],'.$check[0]->address.','.$check[0]->outlet_state;

                if($check->isNotEmpty())
                {
                    $outlet_name = $check[0]->store_name.'['.$check[0]->store_code.'],'.$check[0]->address.','.$check[0]->outlet_state; 

                    $audit = new audit_store();
                    $description = ' check in '.$outlet_name;
                    $add_audit =  $audit->store($description,'CheckIn'); 
                } 

			}
			
			return response()->json($affected);

		}

		else{
			 return response()->json(0);
		}
		

		//dd($condition);

		
	}

	public function outlet_check_out(Request $request)
	{
		$matchThese = ['is_active' => '1'];

		$id = $request->id;
		//$lat = $request->lat;
		//$lng = $request->lng;
	   // $address = $request->address;
		//dd($lat);

		$check = DB::table('merchant_time_sheet')
			->where('id', $id)
			->where('is_active', 1)
			->get();

		if($check[0]->checkin_time == null)
		{
			return response()->json(0);
		}

		$date = Carbon::now();
		$checkout_time = $date->toDateTimeString();

		$affected = DB::table('merchant_time_sheet')
			  ->where('id', $id)
			  ->whereDate('date', $date)
			  ->update([
			  'checkout_time' => $checkout_time,
			  //'checkout_location' => $address,
			  'is_completed' => 1,
			  'updated_at' => Carbon::now()
			  ]);

       
	   

		//dd($affected);

		return response()->json($affected);

	}

	// public function outlet_details(Request $request, $id)
	// {
	//     // $matchThese = ['is_active' => '1', 'id' =>$id ];

	//     // $result = journeyplan::where($matchThese)->whereDate('date', date('Y-m-d'))->with('outlet')->with('employee')->get();

	//    return view('outlet_details.index');

	// }

	//  public function outlet_detail(Request $request)
	// {

	//     $id = $request->id;

	//     $matchThese = ['is_active' => '1', 'id' =>$id ];

	//     $result = journeyplan::where($matchThese)->whereDate('date', date('Y-m-d'))->with('outlet')->with('employee')->get();

	//    return response()->json($result);

	// }


}
