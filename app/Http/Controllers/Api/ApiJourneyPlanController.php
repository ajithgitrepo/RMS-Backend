<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\Employee_Reporting_To;
use App\Outlet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiJourneyPlanController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = "200";
    //public  $usear = Auth::user();

    public function journey(Request $request, journeyplan $modal)
    {
        $EmpID = $request->emp_id;
        $user   =  Auth::user();
        $currentMonth = date('m');
         $date = \Carbon\Carbon::now()->format('Y-m-d');

         $chk =  $this->chech_auth($user);
       
        if($chk == false)
        return $this->auth_error_msg();

        $Date = Carbon::now();
        $Day = $Date->format('l'); 

        $matchThese = ['merchant_time_sheet.is_active' => '1', 
        'merchant_time_sheet.employee_id' => $EmpID];
       
        $result = journeyplan::with('outlet')//->with('employee')
         ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id' )
         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
         ->where($matchThese)->whereYear('merchant_time_sheet.date', date('Y'));
       
         $query =  $result->get();
         
         return $this->send_result_msg($this->success_status, $query);
           
    }

    public function today_planned_journey(Request $request, journeyplan $modal)
    {

        $user  =  Auth::user();
        $chk =  $this->chech_auth($user);
       
        if($chk == false) 
        return $this->auth_error_msg();

            $emp_id = $request->emp_id; 
            $Date = Carbon::now(); 
            $Day = $Date->format('l'); 
            $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => $emp_id];
            
            $type = "day";
            $status = "planned";

            $merged = $this->get_planned_journey_data($emp_id, $type, $status, $matchThese);

             return $this->send_result_msg($this->success_status, $merged);
        
    }

    public function complete_percentage(Request $request, journeyplan $modal)
    {

        $emp_id = $request->emp_id;

        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id];

        $percentage = DB::table('merchant_time_sheet')
            ->where('employee_id',$emp_id)
            ->whereMonth('date', Carbon::now()->month)->whereYear('date', date('Y'))
            ->where('is_active',1)
            ->select(DB::raw('(select count(*) from merchant_time_sheet where is_completed = 1 AND MONTH(date) = MONTH(CURRENT_DATE()) ) / count(*) * 100 as month_percentage'))
           // ->groupBy('employee_id')
            ->get();

        return response()->json($percentage);

    }

    public function today_completed_journey(Request $request, journeyplan $modal)
    {
        $user  =  Auth::user();
        $chk =  $this->chech_auth($user);
       
        if($chk == false)
        return $this->auth_error_msg();

        $emp_id = $request->emp_id;

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => $emp_id];
       // ->with('employee')
      
       $type = "day";
       $status = "completed";
      
     /* $resultDay = journeyplan::where($matchThese)->where('day', $Day)->with('outlet')//->with('employee')
      ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id')
      ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
       ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
       ->get(); */

       $result = $this->get_journey_data($emp_id, $type, $status, $matchThese);

     // $merged = array_merge($resultDate->toArray(), $resultDay->toArray());

        return $this->send_result_msg($this->success_status, $result);
   

    }

    public function week_planned_journey(Request $request, journeyplan $modal)
    {

        $emp_id = $request->emp_id;

        // $result = journeyplan::where($matchThese)->with('outlet')->with('employee')
        // ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        // ->get();

        $type = "week";
        $status = "planned";
          
        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.employee_id' => $emp_id ];

        $result = $this->get_planned_journey_data($emp_id, $type, $status, $matchThese);

        return $this->send_result_msg($this->success_status, $result);

    }

    public function week_completed_journey(Request $request, journeyplan $modal)
    {  

        $emp_id = $request->emp_id;

        $type = "week";
        $status = "completed";
          
        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id, 'is_completed' => '0'];

        $result = $this->get_journey_data($emp_id, $type, $status, $matchThese);

        // $result = journeyplan::where($matchThese)->with('outlet')->with('employee')
        // ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        // ->get();

        return $this->send_result_msg($this->success_status, $result);

    }  

    public function today_skipped_journey(Request $request, journeyplan $modal)
    {
        $user  =  Auth::user();
        $chk =  $this->chech_auth($user);
       
        if($chk == false)
        return $this->auth_error_msg();

        $emp_id = $request->emp_id;  //->with('employee')

        $type = "day";
        $status = "skipped";
          
        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id, 'is_completed' => '0'];

        $result = $this->get_journey_data($emp_id, $type, $status, $matchThese);

       // $result = journeyplan::where($matchThese)->whereDate('date', date('Y-m-d'))->with('outlet')->get();

        return $this->send_result_msg($this->success_status, $result);
    
    }

    public function week_skipped_journey(Request $request, journeyplan $modal)
    {

        $user  =  Auth::user();
        $chk =  $this->chech_auth($user);
       
        if($chk == false)
        return $this->auth_error_msg();

        $emp_id = $request->emp_id;

        $type = "week";
        $status = "skipped";
          
        $matchThese = ['is_active' => '1', 'employee_id' => $emp_id, 'is_completed' => '0'];

        $result = $this->get_journey_data($emp_id, $type, $status, $matchThese);

        return $this->send_result_msg($this->success_status, $result);

    }


    // By Emp_ID & Month
    public function timesheet_monthly(Request $request, journeyplan $modal)
    {
        $user  =  Auth::user();
        $chk =  $this->chech_auth($user);
       
        if($chk == false)
        return $this->auth_error_msg();

        $emp_id = $request->emp_id;
        $timestamp = Carbon::parse($request->month);
        $Month =  $timestamp->month;
        $Year =  $timestamp->year;
        $matchThese = [ 'employee_id' => $emp_id, 'is_completed' => '1', 'merchant_time_sheet.is_active' => '1'];

        $type = "month";
        $status = "monthly";
          
         $Day = $timestamp->format('l'); 
       
          $resultDate = $this->get_timesheet_data($emp_id, $Month, $status, $matchThese);

        return $this->send_result_msg($this->success_status, $resultDate);

    }
     // By Emp_ID & Date
     public function timesheet_daily(Request $request, journeyplan $modal)
     {
         $user  =  Auth::user();
          $chk =  $this->chech_auth($user);
          if($chk == false)
          return $this->auth_error_msg();
          //  dd($chk);
         $emp_id = $request->emp_id;
         $timestamp = Carbon::parse($request->date);
         $Date =  $request->date;
         $Year =  $timestamp->year;
         $matchThese = ['employee_id' => $emp_id, 'is_completed' => '1', 'merchant_time_sheet.is_active' => '1'];
 
        //// $result = journeyplan::where($matchThese)->with('outlet') //->with('employee')
         ///->whereDate('date', $Date)
        //  ->get();

        $type = "day"; 
        $status = "daily";  
           
         $Day = $timestamp->format('l'); 
       
          $resultDate = $this->get_timesheet_data($emp_id, $Date, $status, $matchThese);
      

         //  $result = array_merge($resultDate->toArray(), $resultDay->toArray());
        
         return $this->send_result_msg($this->success_status, $resultDate);
         
     }

     public function get_timesheet_data($emp_id, $DateMonth, $status, $matchThese)
     {
        $Date = Carbon::now();
        $Day = $Date->format('l'); 

        $resultDate = DB::table('merchant_time_sheet')
        ->where($matchThese)->whereYear('merchant_time_sheet.date', date('Y'))//->with('employee')
       // ->whereDate('date', $timestamp)
        //->leftJoin('store_details', 'store_details.id', '=', 'merchant_time_sheet.outlet_id');
        ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id' )
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
         
        if($status == "daily") 
        {
            $Date = date('Y-m-d');
           $resultDate->whereDate('date' ,$Date);
        }
        if($status == "monthly")
          $resultDate->whereRaw('MONTH(date) = ?',[$DateMonth]);

       $resultDate = $resultDate->get();
       //->where('merchant_time_sheet.is_active', 1)->get();

        return  $resultDate;

     }

    public function get_planned_journey_data($emp_id, $type, $status, $matchThese)
       {
       
        $Date = Carbon::now();
        $Day = $Date->format('l'); 
       
        $result = journeyplan::with('outlet')//->with('employee')
         ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id' )
         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
         ->where($matchThese)->whereYear('merchant_time_sheet.date', date('Y')); 
        
        // $resultDate = journeyplan::with('outlet')//->with('employee')
        //  ->select('merchant_time_sheet.*','store_details.*', 'merchant_time_sheet.id' )
        //  ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        //  ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        //  ->where($matchThese);

         if($type == "day") 
         $result->whereDate('date' ,date('Y-m-d'));

         Carbon::setWeekStartsAt(Carbon::SUNDAY);
         Carbon::setWeekEndsAt(Carbon::SATURDAY);

         if($type == "week")
         {
       // $result->where('date', '>', Carbon::now()->startOfWeek())
       // ->where('date', '<', Carbon::now()->endOfWeek());
           $result->whereBetween('date', [Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')]);  
         }
         $query1 =  $result->get();
         
       return  $query1;

       }


       public function get_journey_data($emp_id, $type, $status, $matchThese)
       {

        $Date = Carbon::now(); 
        $Day = $Date->format('l'); 
       
        $result = DB::table('merchant_time_sheet as ol')->where('ol.is_active', 1)
        ->where("employee_id", $emp_id)->whereYear('ol.date', date('Y'));

        if($type == "day")
        $result->whereDate('ol.date' ,date('Y-m-d'));
        if($type == "week")
        $result->whereBetween('ol.date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        if($type == "date")
        {
            $from = date("Y-m-d", strtotime($request->from_date)); 
            $to = date("Y-m-d", strtotime($request->to_date)); 
           $result->whereBetween('ol.date', [$from, $to]);
        }

        $result->select('store_details.*','outlet.*', 'ol.*')
       ->leftJoin('outlet', 'outlet.outlet_id', '=', 'ol.outlet_id')
       ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

       if($status == "completed")
        $result->where('is_completed', 1);

        if($status == "skipped")
        $result->where('is_completed', 0);

        $query = $result->get();

       return  $query;

       } 

       public function timesheet_by_date(Request $request, journeyplan $modal)
       {

        $Date = Carbon::now(); 
        $Day = $Date->format('l'); 
        $emp_id = $request->emp_id;
        $status = $request->type;
       
        $result = DB::table('merchant_time_sheet as ol')->where('ol.is_active', 1)
        ->where("employee_id", $emp_id)->whereYear('ol.date', date('Y'));

         $from = date("Y-m-d", strtotime($request->from_date));  
         $to = date("Y-m-d", strtotime($request->to_date)); 
         $result->whereBetween('ol.date', [$from, $to]); 
       
        $result->select('store_details.*','outlet.*', 'ol.*')
       ->leftJoin('outlet', 'outlet.outlet_id', '=', 'ol.outlet_id')
       ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

       if($status == "completed")
        $result->where('is_completed', 1);

        if($status == "skipped")
        $result->where('is_completed', 0);

        $query = $result->get();

       return  $query;

       } 


       public function add_unscheduled_journeyplan(Request $request, journeyplan $model)
       {
           
           $user  =  Auth::user();
           $printReport = new ApiJourneyPlanController();
           $chk =  $printReport->chech_auth($user);
           
           if($chk == false)
           return $printReport->auth_error_msg();
        
              // validation
               $validator      =   Validator::make($request->all(), [
                'emp_id' => 'required|max:255',
                'date' => 'required|max:255',
                'outlet_id' => 'required|max:255',
           ]);
   
              if($validator->fails()) {
               return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
           } 
   
           $date = $request->date;
           //dd($joining_date);
           $new_date = date("Y-m-d", strtotime($date));  
   
           $result = false;
            for($i=0;$i<count($request->outlet_id);$i++)
            {
                $MatchThese = ['employee_id' => $request->emp_id, 'date' => $new_date, 'outlet_id' => $request->outlet_id[$i], 'is_active' => 1];
                $checker = journeyplan:://select('employee_id,date,outlet_id')
                where($MatchThese)->exists();

                if($checker == false)
                {  

                  $created_by =  Auth::user()->emp_id;
                  $added_by = null;
                        if(Auth::user()->role->name =="CDE")
                        {
                              $added_by =  Auth::user()->emp_id;
                                    
                              $matchThese = ['is_active' => '1','employee_id' => $request->merchandiser];

                              $result = Employee_Reporting_To::where($matchThese)->with('employee','employee_reporting_to')->with('employee_reporting_to')->first();

                              $created_by = $result->employee_reporting_to->employee_id;
                        }


                    $outlet = array(    
                        'employee_id' => $request->emp_id, //$request->employee_id,
                        'date' => $new_date,
                        'outlet_id' => $request->outlet_id[$i],
                        'scheduled_calls' => 0,
                        'is_active' => '1',
                        'created_at' => Carbon::now(),
                        'added_by' =>  $added_by,
                        'created_by' => $created_by,
                        'device' => 'mobile'
                        
                    );
                    $result =  DB::table('merchant_time_sheet')->insert($outlet);
                }
            }  
   
           //  $result = $model->create($request->all());
		$notify = new ApiNotificationController();
           $ReportToID = $request->emp_id; 
           $title = "Fieldmanager added unscheduled timesheet";
           $user_type = "merchandiser";
           $created_to = $ReportToID;
           $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);
 
       return $printReport->send_result_msg($this->success_status, $result);
           
           //  return $printReport->send_result_msg($this->success_status, $result);
         
       }

       public function add_scheduled_journeyplan(Request $request, journeyplan $model)
       {
           
           $user  =  Auth::user();
           $printReport = new ApiJourneyPlanController();
           $chk =  $printReport->chech_auth($user);
           
           if($chk == false)
           return $printReport->auth_error_msg();
        
              // validation
               $validator      =   Validator::make($request->all(), [
                'emp_id' => 'required|max:255',
                'days' => 'required|max:255',
                'year' => 'required|max:255',
                'month' => 'required|max:255',
                'outlet_id' => 'required|max:255',
           ]);
   
              if($validator->fails()) {
               return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
           } 
          // $result = false;
           $Month = $request->month;
           $Year =  $request->year;
           $DayCount=cal_days_in_month(CAL_GREGORIAN,$Month,$Year);
           $test = 0; $dayy = "";  $result =  "Records not related";
         
          
            //$k=0;   
             $dayy .= "";
            for($j=0;$j<count($request->days);$j++)
            { 
               //  $j=0;   
                 for($k=0;$k<count($request->outlet_id);$k++)
                {   
                    
                    for($i=1; $i < $DayCount + 1; ++$i) 
                    {  
            $num_padded = sprintf("%02d", $i);
            $date = $Year."-". $Month  ."-"   .$num_padded;

          //  $date = strtotime( \Carbon\Carbon::createFromDate( $Year, $Month, $i)->format('Y-m-d'));
            $day = \Carbon\Carbon::createFromDate($Year,  $Month, $i)->format('l');

                   
                    if( $day == $request->days[$j])
          //  if(\Carbon\Carbon::createFromDate($request->year, $nmonth, $k)->format('D') == $request->days[$i] )
                    {
                        $dayy .= $day;    
                        $dates = \Carbon\Carbon::createFromDate($request->year, $Month, $i)->format('Y-m-d');

                        $MatchThese = ['employee_id' => $request->emp_id, 'date' => $date, 'outlet_id' => $request->outlet_id[$k], 'is_active' => 1];
                       
                        $checker = journeyplan::where($MatchThese)->exists();

                         if($checker == false)
                            {
                              $created_by =  Auth::user()->emp_id;
                              $added_by = null;
                                    if(Auth::user()->role->name =="CDE")
                                    {
                                          $added_by =  Auth::user()->emp_id;
                                                
                                          $matchThese = ['is_active' => '1','employee_id' => $request->merchandiser];

                                          $result = Employee_Reporting_To::where($matchThese)->with('employee','employee_reporting_to')->with('employee_reporting_to')->first();

                                          $created_by = $result->employee_reporting_to->employee_id;
                                    }


                                $outlet = array(    
                                    'employee_id' => $request->emp_id, 
                                    'date' => $dates,
                                    'outlet_id' => $request->outlet_id[$k],
                                    'scheduled_calls' => '1',
                                    'is_active' => '1',
                                    'is_defined' => '1',
                                    'created_at' => Carbon::now(),
                                    'created_by' => Auth::user()->emp_id,
                                    'added_by' =>  $added_by,
                                    'created_by' => $created_by,
                                    'device' => 'mobile'
                                );
                             $result =  DB::table('merchant_time_sheet')->insert($outlet);
                       }
                       else
                       $result = "already exists";

                    }
                }
            }
            
         }
		$notify = new ApiNotificationController();
            $ReportToID = $request->emp_id; 
             $title = "Fieldmanager added scheduled timesheet";
             $user_type = "merchandiser";
            // $created_to = $ReportToID;
             $add_notify =  $notify->add_notification($title, $user_type, $ReportToID); 
   
         return $printReport->send_result_msg($this->success_status, $result);
         
       }

        public function delete_journeyplan(Request $request, journeyplan $modal)
        {

            $user  =  Auth::user();
            $printReport = new ApiJourneyPlanController();
            $chk =  $printReport->chech_auth($user);
            
            if($chk == false)
            return $printReport->auth_error_msg();

            // validation
            $validator     =   Validator::make($request->all(), [
                "time_sheet_id" =>  "required",
             ]); 
   
              if($validator->fails()) {
               return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
           } 

        $id = $request->time_sheet_id;

        $matchThese = ['is_active' => '1'];
         
        $inserted = array(
            'updated_at'   => date('y-m-d H:i:s'), 'is_active' => '0');
        
        $update = DB::table('merchant_time_sheet')
        ->where('id', $id)->update($inserted);

		$notify = new ApiNotificationController();

        $result = DB::table('merchant_time_sheet as ol')//->where('ol.is_active', 1)
        ->where('ol.id', $id)->whereYear('ol.date', date('Y'));

        $result->select('store_details.*','outlet.*', 'ol.*','store_details.store_name')
       ->leftJoin('outlet', 'outlet.outlet_id', '=', 'ol.outlet_id')
       ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

        $query = $result->get();

        $desc =  $query[0]->store_name. " " ."journey plan was deleted";
		$add_notify =  $notify->add_audit_trails($desc, "journey_plan");

        return $printReport->send_result_msg($this->success_status, $update);

        }

 public function chech_auth($user)
    {
       if(is_null($user))  
        return false;
        else
        return true;
    }

    public function auth_error_msg()
    {
        return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    }

    // public function exists_error_msg()
    // {
    //     return response()->json(["status" => "failed", "message" => "Whoops! already exists"]);
    // }

    public function failed_error_msg($result)
    {
        return response()->json(["status" => "failed", "success" => false, "message" => $result ]);
    }

    public function send_result_msg($success_status, $result)
    {
        if(!is_null($result)) 
          return response()->json(["status" => $success_status, "success" => true, "data" => $result]);
        else
          return $this->failed_error_msg($result);
    }

    public function check_name_exists($var,$name, $table)
    {  
        // Get the value from the form
		$input[$var] =  $name; 
         
        // Must not already exist in the `email` column of `users` table
		$rules = array($var => 'unique:'.$table.','.$var.'');

		$validator = Validator::make($input, $rules);

        return $validator;

    }

}
