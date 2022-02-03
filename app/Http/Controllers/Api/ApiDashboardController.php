<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\journeyplan;
use App\leave_balance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\merchant_timesheet;
use App\outlet_login;
use DateTime;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;


class ApiDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public $success_status = 200;

    public function dashboard_monthly(Request $request, journeyplan $modal)
    {
        $EmpID = $request->emp_id;
        $userid  =  Auth::user();
        $Type = "Month"; 
      
        if(!is_null($userid)) { 

              $Result = $this->Get_Dashboard_All_Details($EmpID, $Type);     
               return $Result;
              
           }
   else {
            return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
        }   
    }
    public function dashboard_daily(Request $request, journeyplan $modal)
    {
        $EmpID = $request->emp_id;
        $userid  =  Auth::user();
        $Type = "Day"; 
      
        if(!is_null($userid)) { 

              $Result = $this->Get_Dashboard_All_Details($EmpID, $Type);     
               return $Result;
              
           }
   else {
            return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
        }   
    }

  /*  public function dashboard_dailytest(Request $request, journeyplan $modal)
    {
        $EmpID = $request->emp_id;
        $userid  =  Auth::user();
        $Type = "Day"; 
      
        if(!is_null($userid)) { 

              $Result = $this->Get_Dashboard_All_Details1($EmpID, $Type);     
               return $Result;
              
           }
   else {
            return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
        }   
    } */

     

    function Get_Dashboard_All_Details($EmpID, $Type)
    {
            // JOIN merchant_time_sheet vs outlet 
        //$user->id

         $SheduleCallsCount = 0 ; $UnSheduleCallsCount = 0 ;
         $SheduleCallsCompletedCount = 0 ;  $UnSheduleCallsCompletedCount = 0;
         $AttendanceCount = 0 ;  $TotalWorkingTime = 0; $TotalEffectiveTime = 0; 
         $TotalTravelTime1 = 0; $percent = 0; $LeaveBal = 0;
       
         $emp_id = $EmpID;
            $currentMonth = date('m');
            $date = \Carbon\Carbon::now()->format('Y-m-d');
            
            $query1    =   DB::table('merchant_time_sheet as merch')
            ->select(array('merch.*','outlet.outlet_id','outlet.outlet_name', 'outlet.outlet_lat', 'outlet.outlet_area',
             'outlet.outlet_city', 'outlet.outlet_state', 'outlet.outlet_country'))
            ->join('outlet','outlet.outlet_id','=','merch.outlet_id');
           // ->whereMonth('merchant_time_sheet.date', 'CURDATE()')
            if($Type == "Month")
            $query1->whereRaw('MONTH(merch.date) = ?',[$currentMonth]);
            if($Type == "Day")
            {
              $query1->whereDate('merch.date', $date);
            }
            $query1->where('merch.is_active',1)->where('merch.employee_id', $EmpID);

            $query2 = clone $query1;

            $query3 = clone $query1;

            $query4 = clone $query1;

            $SheduleCallsCount = $query1->where('merch.scheduled_calls', 1)->get()->count();

            $UnSheduleCallsCount = $query2->where('merch.scheduled_calls', 0)->get()->count();


            $SheduleCallsCompletedCount = $query3->where('merch.scheduled_calls', 1)->where('merch.is_completed', 1)->get()->count();
  
            $UnSheduleCallsCompletedCount = $query4->where('merch.scheduled_calls', 0)->where('merch.is_completed', 1)->get()->count();

            // Attendance 
            $AttendacequeryReal = DB::table('attendance')
            ->select('attendance.employee_id', 'attendance.date', 'merchant_time_sheet.checkin_time',
            'merchant_time_sheet.created_at', 'merchant_time_sheet.id',
            'attendance.checkin_time as att_checkin_time',
            'merchant_time_sheet.checkout_time as merch_checkout_time')
            ->leftJoin('merchant_time_sheet', 'attendance.employee_id', 'merchant_time_sheet.employee_id')
            ->where('attendance.employee_id',$EmpID)->groupBy('merchant_time_sheet.id')
            ->whereNotNull('merchant_time_sheet.checkin_time')
            ->orderBy('merchant_time_sheet.created_at', 'DESC'); 
           // ->where('date','>=',$EmpID)  
           if($Type == "Month")  
           $AttendacequeryReal->whereRaw('MONTH(attendance.date) = ?',[$currentMonth])->whereRaw('MONTH(merchant_time_sheet.date) = ?',[$currentMonth]);
           if($Type == "Day")
           $AttendacequeryReal->whereDate('attendance.date', $date)->whereDate('merchant_time_sheet.date', $date);   //->get();
            $AttendacequeryClone = clone $AttendacequeryReal;

            $AttendacequeryReal =  $AttendacequeryReal->get();
          
          
            $AttendanceCount = DB::table('attendance')->where('attendance.employee_id',$EmpID)->where('attendance.is_present', 1);
            if($Type == "Month")
            $AttendanceCount = $AttendanceCount->whereRaw('MONTH(attendance.date) = ?',[$currentMonth])->get()->count();
            if($Type == "Day")
            $AttendanceCount = $AttendanceCount->where('attendance.date', $date)->get()->count();
            ///$TotalWorkingHours =   // $AttendacequeryReal->where('is_present', 1)->get()->count();
          
            $arraytime = array();

             foreach ($AttendacequeryReal as $att) {
                 $CalculateTime = $this->timeDiff($att->att_checkin_time,$att->merch_checkout_time);
               $arraytime[] = $CalculateTime;
               }

            $splitqueryReal =  DB::table('outlet_journey_time')
            ->where('is_active', 1)
            ->where('employee_id', $EmpID)
            ->whereDate('outlet_journey_time.date', $date)->get();

            foreach ($splitqueryReal as $spli) {
            $CalculateTime = $this->timeDiff($spli->checkin_time,$spli->checkout_time);
            $arraytime[] = $CalculateTime;
            }  

              //dd($arraytime);

              $TotalWorkingTime1 = 0;
              foreach ($arraytime as $tim) {
                  $TotalWorkingTime1 += $tim;
              }
              $TotalWorkingTime =  $TotalWorkingTime1;
              //$this->convert_houers(115);
           $TotalWorkingTime = round($TotalWorkingTime, 2);
            // dd($TotalWorkingTime);
             
             $arrayEffecttimeQuery = DB::table('merchant_time_sheet') 
            ->where('employee_id',$EmpID) ;
           // ->where('date','>=',$EmpID)
           if($Type == "Month")
           $arrayEffecttimeQuery->whereRaw('MONTH(date) = ?',[$currentMonth]);
           if($Type == "Day")
           $arrayEffecttimeQuery->whereDate('date', $date); 

        $arrayEffecttimeQuery =  $arrayEffecttimeQuery->get(); 

             $arrayEffecttime = array();

             foreach ($arrayEffecttimeQuery as $att) {
              $CalculateEffectTime = $this->timeDiff($att->checkin_time,$att->checkout_time);
            $arrayEffecttime[] = $CalculateEffectTime;
            }  

            foreach ($splitqueryReal as $spli) {
                  $CalculateTime = $this->timeDiff($spli->checkin_time,$spli->checkout_time);
                  $arrayEffecttime[] = $CalculateTime;
               }

            $TotalEffectiveTime = 0;
            foreach ($arrayEffecttime as $tim) {
                $TotalEffectiveTime += $tim;
            }  

          $TotalEffectiveTime = round($TotalEffectiveTime, 2);
          $TotalTravelTime = $TotalWorkingTime - $TotalEffectiveTime ;
          $TotalTravelTime1 = round($TotalTravelTime, 2);

            $matchThese = ['is_active' => '1', 'employee_id' => $emp_id];
                /*  $percentage = DB::table('merchant_time_sheet')
                      ->where('employee_id',$emp_id);
                    if($arrayEffecttimeQuery == "Month")
                    $AttendacequeryReal->whereRaw('MONTH(date) = ?',[$currentMonth]);
                    if($arrayEffecttimeQuery == "Day")
                    $AttendacequeryReal->whereDate('date', $date); 
                      ->where('is_active',1)  //DB::raw('count(*) as outlets'),
                      ->select(DB::raw('(select count(*) from merchant_time_sheet where is_completed = 1 AND MONTH(date) = MONTH(CURRENT_DATE()) ) / count(*) * 100 as month_percentage'))
                     // ->groupBy('employee_id')
                      ->get();  */

      $wl = DB::table('merchant_time_sheet')->where('is_completed', 1)->where('is_active',1)->where('employee_id', $EmpID);

      if($Type == "Month")
      $wl->whereRaw('MONTH(date) = ?',[$currentMonth]);
      if($Type == "Day")
      $wl->whereDate('date', $date);
      $wl = $wl->count();

    $total = merchant_timesheet::where($matchThese)->where('is_active',1)->where('employee_id', $EmpID);

         if($Type == "Month")
         $total =   $total->whereRaw('MONTH(date) = ?',[$currentMonth]);
        if($Type == "Day")
        $total =   $total->whereDate('date', $date);

      $total =  $total->count();   // + $MerchMonthDayCount;
      $percent = 0;
      if($total != 0 && $wl != 0)
      {
       $percent =  $total / $wl  * 50/$wl;   
       $percent = round($percent, 0);
      }
      else
      $percent = 0;
     
       $LeaveBal = 0; 

       $Leave_rule =  DB::table('leave_rule')->where('is_active', 1)->get();
       $anual_count = $Leave_rule[2]->total_days;
       $sick_count = $Leave_rule[0]->total_days;
      
       $todate = \Carbon\Carbon::now()->format('Y-m-d');
              $d1 = new DateTime($todate); 
              $res = DB::table('employee as emp')
              ->join('leave_balance as lb','lb.employee_id','=','emp.employee_id')
              ->select(array('lb.Annual_Leave', 'lb.employee_id', 'lb.total_month','emp.employee_id',
              'emp.created_at','emp.first_name','emp.middle_name','emp.surname', 'lb.mol_contract_date_final',
              \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate') as MonthCount")) )
             // ->where('lb.employee_id', "RMS0070")//->get();
              ->where('lb.total_month', '!=', \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate')")) //->get();
            ->update([
                  'lb.Annual_Leave' => DB::raw("lb.Annual_Leave + $anual_count" ),
                  'lb.Sick_Leave' => DB::raw("lb.Sick_Leave + $sick_count"),
                  'lb.total_month' => DB::raw('lb.total_month + 1'),
              ]);   
           
       $leave_balance = DB::table('leave_balance')->where('is_active', 1)->where('employee_id',$emp_id)
                          ->get();

         if(!empty($leave_balance))
         {
            
            $date1 =  $leave_balance[0]->mol_contract_date_final; 
            $LeaveBal = $leave_balance[0]->Annual_Leave;  
            if(!empty($date1))    
            {
                  $date2 = date('Y-m-d');

                  $ts1 = strtotime($date1);
                  $ts2 = strtotime($date2);

                  $year1 = date('Y', $ts1);
                  $year2 = date('Y', $ts2);

                  $month1 = date('m', $ts1);
                  $month2 = date('m', $ts2);

                  $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                  
                  if($diff < 6)
                  $LeaveBal = 0 ;

            }

           
         }

    //  $TotalWorkingTime =   $this->convert_houers($TotalWorkingTime);
    //  $TotalTravelTime1 =   $this->convert_houers($TotalTravelTime1);
   //   $TotalEffectiveTime =   $this->convert_houers($TotalEffectiveTime);
      //round($TotalWorkingTime, 2);

         if(!is_null($SheduleCallsCount)) { 
            return response()->json(["status" => $this->success_status, "success" => true,
             "SheduleCalls" => $SheduleCallsCount , "UnSheduleCalls" => $UnSheduleCallsCount ,
             "SheduleCallsDone" => $SheduleCallsCompletedCount , "UnSheduleCallsDone" => $UnSheduleCallsCompletedCount ,
             "Attendance" => $AttendanceCount , "WorkingTime" => $TotalWorkingTime,"EffectiveTime" => $TotalEffectiveTime, 
             "TravelTime" => $TotalTravelTime1,"JourneyPlanpercentage" => $percent,"LeaveCount" => $LeaveBal
            ]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => $SheduleCallsCount ]);
        }
       
    }   
    
    function timeDiff($firstTime,$lastTime)
    {
            if($firstTime !==null && $lastTime !==null)
            {
                $time1 = strtotime($firstTime);
                $time2 = strtotime($lastTime);
                $difference = round(abs($time2 - $time1) / 3600,2);
                return $difference; 
            }
            else
            return 0;
    }

    function convert_houers($minutes)
    {     // $minutes = 115;
            if($minutes !==null)
            {
               // $hours = round($minutes / 60);
               // $min = $minutes - ($hours * 60);
               $hours  = floor($minutes/60); //round down to nearest minute. 
                  $min = $minutes % 60;
                $difference = $hours.":".$min;
                return $difference; 
            }
            else
            return 0;
    }

    public function outlet_chart(Request $request, journeyplan $modal)
    {
        $user  =  Auth::user();

        $userID  =  Auth::user()->emp_id;

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $validator      =     Validator::make($request->all(), [
            "outlet_id"           =>      "required",
        ]);  

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $outlet_id  = $request->outlet_id ;
        
        // $result = outlet_login::select(DB::raw('count(id) as `count`'),DB::raw("DATE_FORMAT(date, '%Y-%m') month"))
        // ->groupBy('date')->orderBy('date')->get();

        $users = merchant_timesheet::select('id', 'date')
        ->where('employee_id', $userID)
        ->where('outlet_id', $outlet_id)
        ->where('is_completed',1)->whereYear('date', date('Y'))
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->date)->format('m');
        });

    $usermcount = [];
    $userArr = [];

    foreach ($users as $key => $value) {   
        $usermcount[(int)$key] = count($value);
    }

    $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])) {
            $userArr[$i]['count'] = $usermcount[$i];
        } else {
            $userArr[$i]['count'] = 0;
        }
        $userArr[$i]['month'] = $month[$i - 1];
    }
     
        $result = array_values($userArr);
          
        return $printReport->send_result_msg($this->success_status, $result);

    }

    public function outlet_expected_outlet_chart(Request $request, journeyplan $modal)
    {
        $user  =  Auth::user();

        $userID  =  Auth::user()->emp_id;

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $validator      =     Validator::make($request->all(), [
            "outlet_id"           =>      "required",
        ]);  

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }

        $outlet_id  = $request->outlet_id ;
        
        // $result = outlet_login::select(DB::raw('count(id) as `count`'),DB::raw("DATE_FORMAT(date, '%Y-%m') month"))
        // ->groupBy('date')->orderBy('date')->get();

        $users = merchant_timesheet::select('id', 'date')
        ->where('employee_id', $userID)
        ->where('outlet_id', $outlet_id)
        //->where('is_completed',1)
        ->whereYear('date', date('Y'))
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->date)->format('m');
        });

    $usermcount = [];
    $userArr = [];

    foreach ($users as $key => $value) {
        $usermcount[(int)$key] = count($value);
    }

    $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])) {
            $userArr[$i]['count'] = $usermcount[$i];
        } else {
            $userArr[$i]['count'] = 0;
        }
        $userArr[$i]['month'] = $month[$i - 1];
    }
     
        $result = array_values($userArr);
          
        return $printReport->send_result_msg($this->success_status, $result);

    }

}
