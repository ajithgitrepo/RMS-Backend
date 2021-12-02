<?php
/*

=========================================================
* Argon Dashboard PRO - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro-laravel
* Copyright 2018 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)

* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Employee;
use Illuminate\Support\Facades\Hash;
use App\merchant_timesheet;
use App\Outlet;
use App\Store_details;
use App\cde_reporting;
use DateTime;


use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        if (auth()->user()->role->name == "Human Resource") {

            $total_employees = DB::table('employee')
                ->where('is_active', '1')
                ->count();

            $total_field_managers = DB::table('employee')
                ->where('is_active', '1')
                ->where('designation', '5')
                ->count();  

            $total_merchandisers = DB::table('employee')
                ->where('is_active', '1')
                ->where('designation', '6')
                ->count();  

            $today_present = DB::table('attendance')
                ->whereDate('date', Carbon::today())
                ->where('is_present', '1')
                ->count(); 

            $present_field_managers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '5')
                ->where('is_present', '1')
                ->count();    

             $present_merchandisers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '6')
                ->where('is_present', '1')
                ->count();    


            $today_absent = DB::table('attendance')
                ->whereDate('date', Carbon::today())
                ->where('is_leave', '1')
                ->where('is_leave_approved', '1')
                ->count(); 

             $absent_field_managers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '5')
                ->where('is_leave', '1')
                ->where('is_leave_approved', '1')
                ->count(); 


            $absent_merchandiesers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '6')
                ->where('is_leave', '1')
                ->where('is_leave_approved', '1')
                ->count(); 

           //dd($today_present);  

            return view('pages.dashboard', ['total_employees' => $total_employees, 'total_field_managers' => $total_field_managers, 'total_merchandisers' => $total_merchandisers, 'today_present' => $today_present, 'present_field_managers' => $present_field_managers, 'today_absent' => $today_absent, 'absent_field_managers' => $absent_field_managers, 'absent_merchandiesers' => $absent_merchandiesers, 'present_merchandisers' => $present_merchandisers ]);

         }

         if (auth()->user()->role->name == "Merchandiser") {

            $EmpID = Auth::user()->emp_id;
            //dd($EmpID);
            $userid  =  Auth::user();
            $currentMonth = date('m');
            // JOIN merchant_time_sheet vs outlet 
            if(!is_null($userid)) {  //$user->id
                $query1    =   DB::table('merchant_time_sheet as merch')
                ->select(array('merch.*','outlet.outlet_id','outlet.outlet_name', 'outlet.outlet_lat', 'outlet.outlet_area', 'outlet.outlet_city', 'outlet.outlet_state', 'outlet.outlet_country'))
                ->join('outlet','outlet.outlet_id','=','merch.outlet_id')
               // ->whereMonth('merchant_time_sheet.date', 'CURDATE()')
               ->whereRaw('MONTH(merch.date) = ?',[$currentMonth])
               ->where('merch.is_active',1)
                ->where('merch.employee_id', $EmpID);

                  $query2 = clone $query1;

                  $SheduleCallsCount = $query1->where('merch.scheduled_calls', 1)->get()->count();

                  $UnSheduleCallsCount = $query2->where('merch.scheduled_calls', 0)->get()->count();


                  $SheduleCallsCompletedCount = $query1->where('merch.scheduled_calls', 1)->where('merch.is_completed', 1)->get()->count();

                  $UnSheduleCallsCompletedCount = $query2->where('merch.scheduled_calls', 0)->where('merch.is_completed', 1)->get()->count();


                  // Attendance
                  $AttendacequeryReal = DB::table('attendance') 
                  ->where('employee_id',$EmpID) 
                 // ->where('date','>=',$EmpID)
                  ->whereRaw('MONTH(date) = ?',[$currentMonth]);   //->get();
                  $AttendacequeryClone = clone $AttendacequeryReal;
                  $AttendanceCount = $AttendacequeryReal->where('is_present', 1)->get()->count();
                  ///$TotalWorkingHours =   // $AttendacequeryReal->where('is_present', 1)->get()->count();
                  $AttendacequeryReal =  $AttendacequeryReal->get();
                  $arraytime = array();

                  foreach ($AttendacequeryReal as $att) {
                      $CalculateTime = $this->timeDiff($att->checkin_time,$att->checkout_time);
                    $arraytime[] = $CalculateTime;
                    }

                    //dd($arraytime);

                    $TotalWorkingTime = 0;
                    foreach ($arraytime as $tim) {
                        $TotalWorkingTime += $tim;
                    }

                   $TotalWorkingTime = round($TotalWorkingTime, 2);
                  // dd($TotalWorkingTime);
                   
                   $arrayEffecttimeQuery = DB::table('merchant_time_sheet') 
                  ->where('employee_id',$EmpID) 
                 // ->where('date','>=',$EmpID)
                  ->whereRaw('MONTH(date) = ?',[$currentMonth])->get(); 
                   $arrayEffecttime = array();

                   foreach ($arrayEffecttimeQuery as $att) {
                    $CalculateEffectTime = $this->timeDiff($att->checkin_time,$att->checkout_time);
                  $arrayEffecttime[] = $CalculateEffectTime;
                  }  

                  $TotalEffectiveTime = 0;
                  foreach ($arrayEffecttime as $tim) {
                      $TotalEffectiveTime += $tim;
                  }  

                $TotalEffectiveTime = round($TotalEffectiveTime, 2);
                $TotalTravelTime = $TotalEffectiveTime - $TotalEffectiveTime;
                $TotalTravelTime1 = round($TotalTravelTime, 2);
                  //$EffrctiveTime = $AttendacequeryClone->where('is_present', 1)->get()->count();
                  $emp_id = $EmpID;
                  $matchThese = ['is_active' => '1', 'employee_id' => $emp_id];
                  $percentage = DB::table('merchant_time_sheet')
                      ->where('employee_id',$emp_id)
                      ->whereMonth('date', Carbon::now()->month)
                      ->where('is_active',1)  //DB::raw('count(*) as outlets'),
                      ->select(DB::raw('(select count(*) from merchant_time_sheet where is_completed = 1 AND MONTH(date) = MONTH(CURRENT_DATE()) ) / count(*) * 100 as month_percentage'))
                     // ->groupBy('employee_id')
                      ->get();

                $today_outlets = DB::table('merchant_time_sheet')
                ->leftJoin('employee', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                //->where('merchant_time_sheet.is_completed', 0)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where('merchant_time_sheet.employee_id', $EmpID)
                ->where('employee.is_active', 1)
                ->count(); 

                $today_completed = DB::table('merchant_time_sheet')
                ->leftJoin('employee', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('merchant_time_sheet.is_completed', 1)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where('merchant_time_sheet.employee_id', $EmpID)
                ->where('employee.is_active', 1)
                ->count(); 

                 $today_pending = DB::table('merchant_time_sheet')
                ->leftJoin('employee', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('merchant_time_sheet.is_completed', 0)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where('merchant_time_sheet.employee_id', $EmpID)
                ->where('employee.is_active', 1)
                ->count();   

                //dd($today_outlets);    

                        if(!is_null($SheduleCallsCount)) { 
                            return view('pages.dashboard', ["SheduleCalls" => $SheduleCallsCount , "UnSheduleCalls" => $UnSheduleCallsCount ,
                             "SheduleCallsDone" => $SheduleCallsCompletedCount , "UnSheduleCallsDone" => $UnSheduleCallsCompletedCount ,
                             "Attendance" => $AttendanceCount , "WorkingTime" => $TotalWorkingTime,"EffectiveTime" => $TotalEffectiveTime, 
                             "TravelTime" => $TotalTravelTime1,"JourneyPlanpercentage" => round($percentage[0]->month_percentage, 2), 
                             "today_outlets" => $today_outlets, 'today_completed' => $today_completed, 'today_pending' => $today_pending ]);
                        }
                  
                    }

                    return view('pages.dashboard');

        }

        if (auth()->user()->role->name == "Field Manager") {

            $emp_id = Auth::user()->emp_id;

            // $matchThese = ['is_active' => '1'];
            // $cde_array = array();
            // $mer_array = array();

            // $cdes = cde_reporting::where($matchThese)->with('cde_reporting')->get();

            // //dd($cdes);

            // foreach($cdes as $cde)
            // {
            //     if (!in_array($cde->cde_id, $cde_array)) {

            //         $cde_array[] = $cde->cde_id;
            //     }
                
               
            //     if (array_key_exists($cde->cde_id,$mer_array)){

            //         $mer_array[$cde->cde_id][] = $cde->merchandiser_id;
                   
            //     }

            //     if (!array_key_exists($cde->cde_id,$mer_array)){

            //         $mer_array[$cde->cde_id][] = $cde->merchandiser_id;
            //     }


            // }

            // //dd($mer_array);

            // foreach($cde_array as $cde)
            // {
            //     //$ids = $mer_array[$cde];
            //     dd($ids);
            // }

            // $matchThese = ['merchant_time_sheet.is_active' => '1' ];
            // $total_timesheets = merchant_timesheet::with(['outlet','employee','employee_field'])
            // ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
            // ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            // ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            // ->where($matchThese)  
            // ->whereDate('date', '=', date('Y-m-d')) 
            // ->orderBy('date')
            // ->get();



             $total_merchandisers = DB::table('employee_reporting_to')
                ->leftJoin('employee', 'employee_reporting_to.employee_id', '=', 'employee.employee_id')
                ->where('employee_reporting_to.reporting_to_emp_id', $emp_id)
                //->where('employee.designation', 6)
                ->where('employee.is_active', 1)
                ->where('employee_reporting_to.is_active',1)
                ->count();

            $present_merchandisers = DB::table('employee_reporting_to')
                ->leftJoin('employee', 'employee_reporting_to.employee_id', '=', 'employee.employee_id')
                ->leftJoin('attendance', 'attendance.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee_reporting_to.reporting_to_emp_id', $emp_id)
                ->whereDate('attendance.date', Carbon::today())
                ->where('attendance.is_present', '1')
                ->where('employee.is_active', 1)
                ->count();

             $absent_merchandisers = DB::table('employee_reporting_to')
                ->leftJoin('employee', 'employee_reporting_to.employee_id', '=', 'employee.employee_id')
                ->leftJoin('attendance', 'attendance.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee_reporting_to.reporting_to_emp_id', $emp_id)
                ->whereDate('attendance.date', Carbon::today())
                ->where('attendance.is_leave', '1')
                ->where('attendance.is_leave_approved', '1')
                ->where('employee.is_active', 1)
                ->count();

            $merchandisers = DB::table('employee')
                ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
                ->get();


            $total_outlets = DB::table('employee_reporting_to')
                ->leftJoin('employee', 'employee_reporting_to.employee_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee_reporting_to.reporting_to_emp_id', $emp_id)
                ->where('employee.is_active', 1)
                ->count();

             $completed_outlets = DB::table('employee_reporting_to')
                ->leftJoin('employee', 'employee_reporting_to.employee_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee_reporting_to.reporting_to_emp_id', $emp_id)
                ->where('merchant_time_sheet.is_completed', 1)
                ->where('employee.is_active', 1)
                ->count();

             $pending_outlets = DB::table('employee_reporting_to')
                ->leftJoin('employee', 'employee_reporting_to.employee_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee_reporting_to.reporting_to_emp_id', $emp_id)
                ->where('merchant_time_sheet.is_completed', 0)
                ->where('employee.is_active', 1)
                ->count();

            // $today_outlets = DB::table('employee_reporting_to')
            //     ->leftJoin('employee', 'employee_reporting_to.employee_id', '=', 'employee.employee_id')
            //     ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee_reporting_to.employee_id')
            //     ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            //     ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            //     ->where('employee_reporting_to.reporting_to_emp_id', $emp_id)
            //     //->where('merchant_time_sheet.is_completed', 0)
            //     ->whereDate('merchant_time_sheet.date', Carbon::today())
            //     ->where('employee.is_active', 1)
            //     ->count();

             $matchThese = ['merchant_time_sheet.is_active' => '1'];
            
            $today_outlets = merchant_timesheet::with(['outlet','employee'])
                ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where($matchThese)
                ->orderBy('date')
                ->count();


             $matchThese = ['merchant_time_sheet.is_active' => '1'];
            
             $today_completed = merchant_timesheet::with(['outlet','employee'])
                ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
                ->where('merchant_time_sheet.is_completed', 1)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where($matchThese)
                ->orderBy('date')
                ->count();


             $matchThese = ['merchant_time_sheet.is_active' => '1'];
            
             $today_pending = merchant_timesheet::with(['outlet','employee'])
                ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
                ->where('merchant_time_sheet.is_completed', 0)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where($matchThese)
                ->orderBy('date')
                ->count();

            //dd($today_pending);

                 if(!is_null($total_merchandisers)) { 
                    return view('pages.dashboard', ["total_merchandisers" => $total_merchandisers, 'present_merchandisers' => $present_merchandisers, 'absent_merchandisers' => $absent_merchandisers, 'total_outlets' => $total_outlets, 'completed_outlets' => $completed_outlets, 'pending_outlets' => $pending_outlets, 'today_outlets' => $today_outlets, 'today_completed' => $today_completed, 'today_pending' => $today_pending, 'merchandisers' => $merchandisers ]);
                }
                  
         
        }

    if (auth()->user()->role->name == "CDE") {

            $emp_id = Auth::user()->emp_id;

             $total_merchandisers = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.designation', 6)
                ->where('employee.is_active', 1)
                ->count();

             $present_merchandisers = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('attendance', 'attendance.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', 6)
                ->where('employee.is_active', 1)
                ->count();

             $absent_merchandisers = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('attendance', 'attendance.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->whereDate('attendance.date', Carbon::today())
                ->where('attendance.is_leave', '1')
                ->where('attendance.is_leave_approved', '1')
                ->where('employee.designation', 6)
                ->where('employee.is_active', 1)
                ->count();

            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.is_active', 1)
                ->where('employee.designation', 6)
                ->get();

           
            $total_outlets = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.is_active', 1)
                ->where('merchant_time_sheet.is_active', 1)
                ->count();

           
            $completed_outlets = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.is_active', 1)
                ->where('merchant_time_sheet.is_active', 1)
                ->where('merchant_time_sheet.is_completed', 1)
                ->count();

          
            $pending_outlets = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.is_active', 1)
                ->where('merchant_time_sheet.is_active', 1)
                ->where('merchant_time_sheet.is_completed', 0)
                ->count();

            
            $today_outlets = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.is_active', 1)
                ->where('merchant_time_sheet.is_active', 1)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->count();

            $today_completed = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.is_active', 1)
                ->where('merchant_time_sheet.is_active', 1)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where('merchant_time_sheet.is_completed', 1)
                ->count();

            $today_pending = DB::table('cde_reporting')
                ->leftJoin('employee', 'cde_reporting.merchandiser_id', '=', 'employee.employee_id')
                ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
                ->where('cde_reporting.cde_id', $emp_id)
                ->where('employee.is_active', 1)
                ->where('merchant_time_sheet.is_active', 1)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->where('merchant_time_sheet.is_completed', 0)
                ->count();

            //dd($today_pending);


                 if(!is_null($total_merchandisers)) { 
                    return view('pages.dashboard', ["total_merchandisers" => $total_merchandisers, 'present_merchandisers' => $present_merchandisers, 'absent_merchandisers' => $absent_merchandisers, 'total_outlets' => $total_outlets, 'completed_outlets' => $completed_outlets, 'pending_outlets' => $pending_outlets, 'today_outlets' => $today_outlets, 'today_completed' => $today_completed, 'today_pending' => $today_pending, 'merchandisers' => $merchandisers ]);
                }
                  
         
        }


    if (auth()->user()->role->name == "Top Management" || auth()->user()->role->name == "Admin") {

         $total_employees = DB::table('employee')
                ->where('is_active', '1')
                ->count();

            $total_field_managers = DB::table('employee')
                ->where('is_active', '1')
                ->where('designation', '5')
                ->count();  

            $total_merchandisers = DB::table('employee')
                ->where('is_active', '1')
                ->where('designation', '6')
                ->count();  

            $today_present = DB::table('attendance')
                ->whereDate('date', Carbon::today())
                ->where('is_present', '1')
                ->count(); 

            $present_field_managers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '5')
                ->where('is_present', '1')
                ->count();    

            $present_merchandisers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '6')
                ->where('is_present', '1')
                ->count();    



            $absent_field_managers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '5')
                ->where('is_leave', '1')
                ->where('is_leave_approved', '1')
                ->count(); 


            $absent_merchandiesers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '6')
                ->where('is_leave', '1')
                ->where('is_leave_approved', '1')
                ->count(); 

            $total_outlets = DB::table('merchant_time_sheet')
                ->where('merchant_time_sheet.is_active', 1)
                ->count();

            $completed_outlets = DB::table('merchant_time_sheet')
                ->where('merchant_time_sheet.is_active', 1)
                ->where('merchant_time_sheet.is_completed', 1)
                ->count();

            $pending_outlets = DB::table('merchant_time_sheet')
                ->where('merchant_time_sheet.is_active', 1)
                ->where('merchant_time_sheet.is_completed', 0)
                ->count();

            $today_outlets = DB::table('merchant_time_sheet')
                ->where('merchant_time_sheet.is_active', 1)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->count();

            $today_completed = DB::table('merchant_time_sheet')
                ->where('merchant_time_sheet.is_active', 1)
                ->where('merchant_time_sheet.is_completed', 1)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->count();

            $today_pending = DB::table('merchant_time_sheet')
                ->where('merchant_time_sheet.is_active', 1)
                ->where('merchant_time_sheet.is_completed', 0)
                ->whereDate('merchant_time_sheet.date', Carbon::today())
                ->count();

            $absent_merchandiesers = DB::table('attendance')
                ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
                ->whereDate('attendance.date', Carbon::today())
                ->where('employee.designation', '6')
                ->where('is_leave', '1')
                ->where('is_leave_approved', '1')
                ->count(); 

            //dd($absent_merchandiesers);  

             $field_managers = DB::table('employee')
                //->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee.is_active', 1)
                ->where('designation', 5)
                //->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
                ->get();

            $merchandisers = DB::table('employee')
                ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->groupBy('employee.employee_id')
                //->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
                ->get();

            $form = DB::table('merchant_time_sheet')
            ->Join('employee','merchant_time_sheet.created_by','=','employee.employee_id')
            ->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->Join('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->select('employee.first_name','employee.surname','merchant_time_sheet.checkin_time','merchant_time_sheet.checkout_time',
                DB::raw('count(*) as num'),
                DB::raw('SUM(CASE WHEN merchant_time_sheet.checkin_time != "null" THEN 1 ELSE 0 END) AS "checkin"'),
                DB::raw('SUM(CASE WHEN merchant_time_sheet.checkout_time != "null" THEN 1 ELSE 0 END) AS "checkout"'))
            ->where('date',Carbon::today())
            ->groupBy('merchant_time_sheet.created_by')
            ->where('merchant_time_sheet.is_active', 1)
            ->get();

           
            $date = new DateTime("now");
            $curr_date = $date->format('Y-m-d');

            $merch= DB::table('employee_reporting_to')
                 ->leftJoin('employee', 'employee_reporting_to.reporting_to_emp_id', '=', 'employee.employee_id')
  
                ->select('employee.employee_id as f_id','employee.first_name','employee.surname',DB::raw('group_concat(employee_reporting_to.employee_id) as merchant_id'),DB::raw('count(*) as merchandisers'))
                // DB::raw('count(*) as merchandisers'))
                //DB::raw('SUM(CASE WHEN attendance.checkin_time != "null" THEN 1 ELSE 0 END) AS "checkin"'),
                //DB::raw('SUM(CASE WHEN attendance.checkout_time != "null" THEN 1 ELSE 0 END) AS "checkout"'))
                ->groupBy('employee_reporting_to.reporting_to_emp_id')
                //->groupBy('employee_reporting_to.employee_id')
                ->where('employee.designation', 5)
                ->where('employee.is_active',1)
                ->where('employee_reporting_to.is_active',1) //->get();
                ->get(); 

            //dd($merch);

            $arrayname = array();

            foreach($merch  as $key => $field)
            {

                $merchant_ids = $field->merchant_id;

                //dd($field->surname);

                $explode = explode(',', $merchant_ids);
                //dd($explode);


                $attendance= DB::table('attendance')
                     ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
      
                    //->select('employee.employee_id as f_id','employee.first_name','employee.surname','employee_reporting_to.employee_id as m_id')
                    
                    ->whereIn('attendance.employee_id', $explode)
                    ->whereDate('attendance.date', $curr_date)
                    ->where('employee.designation', 6)
                    ->where('employee.is_active', 1)
                    ->where('attendance.is_active', 1)
                    ->count();

               
                $field->{'present'} = $attendance; 

                // $arrayname[$key] = array(
                //     'f_name' => $field->first_name,
                //     's_name' => $field->surname,
                //     'count' => $field->merchandisers,
                //     'present' => $attendance
                // );

            }

            //dd($merch);

           
            return view('pages.dashboard', ['total_employees' => $total_employees, 'total_field_managers' => $total_field_managers, 'total_merchandisers' => $total_merchandisers, 'present_field_managers' => $present_field_managers, 'present_merchandisers' => $present_merchandisers, 'total_outlets' => $total_outlets, 'completed_outlets'=> $completed_outlets, 'pending_outlets' => $pending_outlets, 'today_outlets' => $today_outlets, 'today_completed' => $today_completed, 'today_pending' => $today_pending, 'absent_merchandiesers' => $absent_merchandiesers, 'field_managers' => $field_managers, 'merchandisers' => $merchandisers, 'attendance' => $merch, 'form' => $form ]);    


        }

        if (auth()->user()->role->name == "Client") {

            $total_stores = DB::table('store_details')
                ->where('created_by', auth()->user()->emp_id)
                ->where('is_active', 1)
                ->count();
        
        	

            $total_outlets = DB::table('outlet_products_mapping')
                ->where('client_id', auth()->user()->emp_id)
                ->where('is_active', 1)
                ->groupBy('outlet_id')
                ->get();

            
            $total_products = DB::table('product_details')
                ->where('created_by', auth()->user()->emp_id)
                ->where('is_active', 1)
                ->get();
        
        
        	

           
            $field_managers = DB::table('employee')
                //->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee.is_active', 1)
                ->where('designation', 5)
                //->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
                ->get();
        
        	

            $total_scheduled_timesheet = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->where('outlet_products_mapping.client_id', auth()->user()->emp_id)
                ->where('merchant_time_sheet.is_active', 1)
                ->where('outlet.created_by', Auth::user()->emp_id)
                ->where('merchant_time_sheet.is_defined', 1)
                //->groupBy('merchant_time_sheet.id')
                ->count();
        
        		//dd($total_scheduled_timesheet);
        
        	

            $total_s_completed = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->where('outlet_products_mapping.client_id', auth()->user()->emp_id)
                ->where('merchant_time_sheet.is_active', 1)
                // ->where('outlet_products_mapping.is_active', 1)
                ->where('merchant_time_sheet.is_defined', 1)
                ->where('merchant_time_sheet.is_completed', 1)
                ->where('outlet.created_by', Auth::user()->emp_id)

                //->groupBy('merchant_time_sheet.id')
                ->count();
        
          	//dd($total_s_completed);
        
        	$total_s_pending = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->where('outlet_products_mapping.client_id', auth()->user()->emp_id)
                ->where('merchant_time_sheet.is_active', 1)
                // ->where('outlet_products_mapping.is_active', 1)
                ->where('merchant_time_sheet.is_defined', 1)
                ->where('merchant_time_sheet.is_completed', 0)
                ->where('outlet.created_by', Auth::user()->emp_id)
                
                //->groupBy('merchant_time_sheet.id')
                ->count();
        
        	

            $total_unscheduled_timesheet = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->where('outlet_products_mapping.client_id', auth()->user()->emp_id)
                 ->where('merchant_time_sheet.is_active', 1)
                // ->where('outlet_products_mapping.is_active', 1)
                ->where('merchant_time_sheet.is_defined', 0)
                ->where('outlet.created_by', Auth::user()->emp_id)

                //->groupBy('merchant_time_sheet.id')
                ->count();
        
        	//dd($total_unscheduled_timesheet);

            $total_uns_completed = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->where('outlet_products_mapping.client_id', auth()->user()->emp_id)
                // ->where('merchant_time_sheet.is_active', 1)
                // ->where('outlet_products_mapping.is_active', 1)
                ->where('merchant_time_sheet.is_defined', 0)
                ->where('merchant_time_sheet.is_completed', 1)
                ->where('outlet.created_by', Auth::user()->emp_id)

                //->groupBy('merchant_time_sheet.id')
                ->count();
        	
        //dd($total_uns_completed);

            $total_uns_pending = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                // ->where('outlet_products_mapping.client_id', auth()->user()->emp_id)
                // ->where('merchant_time_sheet.is_active', 1)
                // ->where('outlet_products_mapping.is_active', 1)
                ->where('merchant_time_sheet.is_defined', 0)
                ->where('merchant_time_sheet.is_completed', 0)
                ->where('outlet.created_by', Auth::user()->emp_id)
                
                //->groupBy('merchant_time_sheet.id')
                ->count();

            //dd($total_uns_pending);

            return view('pages.dashboard', ['total_stores' => $total_stores,
                                            'total_outlets' => $total_outlets,
                                            'total_scheduled_timesheet' => $total_scheduled_timesheet,
                                            'total_products' => $total_products,
                                            'total_s_completed' => $total_s_completed,
                                            'total_s_pending' => $total_s_pending,
                                            'total_unscheduled_timesheet' => $total_unscheduled_timesheet,
                                            'total_uns_completed' => $total_uns_completed,
                                            'total_uns_pending' => $total_uns_pending,
                                            'field_managers' => $field_managers]); 

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
          return 0;  
    }

    public function monthly_bar_chart_field(Request $request) 
    {

        $result = DB::table('merchant_time_sheet') 
        ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
            WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
            WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))
        ->where('created_by', Auth::user()->emp_id)
        ->where('is_active',1)
        ->whereYear('date', date('Y'))
        ->groupByRaw('MONTH(date)')
        ->get();
        // ->groupBy(function ($date) {
        //     return Carbon::parse($date->date)->format('m');
        // });


        //dd($result[0]->date);

        // $usermcount = [];
        // $userArr = [];
        // $valueArr = [];

        // foreach ($result as $key => $value) {

        //     //dd($value->date);

        //     $valueArr[] = $value->total;

        //     $usermcount[] = $value->completed;
        // }

        // //dd($valueArr);

        // $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // for ($i = 1; $i <= 12; $i++) {
        //     if (!empty($usermcount[$i])) {
        //         $userArr[$i]['count'] = $usermcount[$i];
        //     } else {
        //         $userArr[$i]['count'] = 0;
        //     }
        //     $userArr[$i]['month'] = $month[$i - 1];
        // }

        // $result = array_values($userArr);

        // dd($result);

        return response()->json($result);


        //return 1;


    }

    public function monthly_bar_chart_client(Request $request) 
    {

        $result = DB::table('merchant_time_sheet') 
        ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
            WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
            WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))

        // ->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        // ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')

        // ->where('outlet_products_mapping.client_id', Auth::user()->emp_id)

        //->where('created_by', Auth::user()->emp_id)
        ->where('merchant_time_sheet.is_active',1)
        //->where('outlet_products_mapping.is_active',1)
        ->whereYear('date', date('Y'))
        ->groupByRaw('MONTH(date)')
        ->get();

        //dd($result);

        return response()->json($result);


    }

    public function filter_bar_chart_client(Request $request) 
    {
        //dd($request->emp_id);

        $query = DB::table('merchant_time_sheet') 
        ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
            WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
            WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))

        // ->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        // ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')

        ->where('merchant_time_sheet.is_active',1)
        //->where('outlet_products_mapping.is_active',1)
        ->whereYear('date', date('Y'))
        ->groupByRaw('MONTH(date)');


        if(!empty($request->emp_id))
        {

          $query->where('merchant_time_sheet.created_by', $request->emp_id);

        }

        $result = $query->get();

        //dd($result);

        return response()->json($result);


    }


    public function filter_bar_chart_field(Request $request) 
    {
        //dd($request->emp_id);

        $query = DB::table('merchant_time_sheet') 
        ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
            WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
            WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))

        //->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        //->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')

        ->where('merchant_time_sheet.is_active',1)
        ->where('merchant_time_sheet.created_by',Auth::user()->emp_id)
        //->where('outlet_products_mapping.is_active',1)
        ->whereYear('date', date('Y'))
        ->groupByRaw('MONTH(date)');


        if(!empty($request->emp_id))
        {

          $query->where('merchant_time_sheet.employee_id', $request->emp_id);

        }

        $result = $query->get();

        //dd($result);

        return response()->json($result);


    }


    public function monthly_bar_chart_admin(Request $request) 
    {

        $result = DB::table('merchant_time_sheet') 
        ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
            WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
            WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))

        // ->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        // ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')

        // ->where('outlet_products_mapping.client_id', Auth::user()->emp_id)

        //->where('created_by', Auth::user()->emp_id)
        ->where('merchant_time_sheet.is_active',1)
        //->where('outlet_products_mapping.is_active',1)
        ->whereYear('date', date('Y'))
        ->groupByRaw('MONTH(date)')
        ->get();

        //dd($result);

        return response()->json($result);


    }


    public function filter_bar_chart_admin(Request $request) 
    {
        //dd($request->emp_id);

        $query = DB::table('merchant_time_sheet') 
        ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
            WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
            WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))

        //->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        //->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')

        ->where('merchant_time_sheet.is_active',1)
        //->where('merchant_time_sheet.created_by',Auth::user()->emp_id)
        //->where('outlet_products_mapping.is_active',1)
        ->whereYear('date', date('Y'))
        ->groupByRaw('MONTH(date)');


        if(!empty($request->emp_id) && $request->type =="field_manager")
        {

          $query->where('merchant_time_sheet.created_by', $request->emp_id);

        }

        if(!empty($request->emp_id) && $request->type =="merchandiser")
        {

          $query->where('merchant_time_sheet.employee_id', $request->emp_id);

        }

        $result = $query->get();

        //dd($result);

        return response()->json($result);


    }


    public function monthly_bar_chart_cde(Request $request) 
    {

        $result = DB::table('merchant_time_sheet') 
            ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
                WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
                WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))
            ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
            ->where('cde_reporting.cde_id', Auth::user()->emp_id)
            ->where('merchant_time_sheet.is_active',1)
            ->whereYear('merchant_time_sheet.date', date('Y'))
            ->groupByRaw('MONTH(merchant_time_sheet.date)')
            ->get();
       
        return response()->json($result);


    }


    public function filter_bar_chart_cde(Request $request) 
    {
        //dd($request->emp_id);

        $query = DB::table('merchant_time_sheet') 
        ->select('date', DB::raw('monthname(date) as month'), DB::raw('count(*) as total'), DB::raw("SUM(CASE
            WHEN is_completed > '0' THEN 1 ELSE 0 END) AS completed"), DB::raw("SUM(CASE
            WHEN is_completed <= '0' THEN 1 ELSE 0 END) AS pending"), DB::raw('EXTRACT(MONTH FROM date) AS month_number'))

        ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
        ->where('cde_reporting.cde_id', Auth::user()->emp_id)

        ->where('merchant_time_sheet.is_active',1)
        ->whereYear('date', date('Y'))
        ->groupByRaw('MONTH(date)');


        if(!empty($request->emp_id))
        {

          $query->where('merchant_time_sheet.employee_id', $request->emp_id);

        }

        $result = $query->get();

        //dd($result);

        return response()->json($result);


    }

    public function pie_chart_field(Request $request) 
    {

        $matchThese = ['merchant_time_sheet.is_active' => '1','outlet.is_active' => '1','store_details.is_active' => '1'];

            $field_outlet_count = merchant_timesheet::with(['employee_field'])
            ->select('merchant_time_sheet.created_by', DB::raw('count(*) as total'))
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where($matchThese)
            ->whereDate('merchant_time_sheet.date', Carbon::today())
            ->groupBy('merchant_time_sheet.created_by')
            ->get();

            //dd($field_outlet_count); 

            return response()->json($field_outlet_count);

    }  

    public function filter_pie_monthly(Request $request) 
    {

        $matchThese = ['merchant_time_sheet.is_active' => '1','outlet.is_active' => '1','store_details.is_active' => '1'];

            $field_outlet_count = merchant_timesheet::with(['employee_field'])
            ->select('merchant_time_sheet.created_by', DB::raw('count(*) as total'))
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where($matchThese)
            ->groupBy('merchant_time_sheet.created_by');

            if($request->value =="Monthly")
            {
              $field_outlet_count->whereMonth('date', Carbon::now()->month);
            }
            if($request->value =="Year")
            {
              $field_outlet_count->whereYear('date', date('Y'));
            }
            if($request->value =="Today")
            {
              $field_outlet_count->whereDate('date', Carbon::today());
            }

            $result = $field_outlet_count->get();

            //dd($field_outlet_count); 

            return response()->json($result);

    }  


}
