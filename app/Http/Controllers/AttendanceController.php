<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Attendance $model)
    {       
      //  dd();
     $model= DB::table('attendance')
     ->where('employee_id',Auth::user()
     ->emp_id)->orderby('created_at','DESC')
     ->get(); 

     $currentMonth = date('m');
     $Result= DB::table('attendance')
    // ->select('date')
     ->where('employee_id',Auth::user()->emp_id)->whereRaw('MONTH(date) = ?',[$currentMonth])
     ->orderby('created_at','DESC')
       ->get();  
      
       $Holiday = DB::table('holidays')->whereRaw('MONTH(date) = ?',[$currentMonth])
        ->get();

        $text = "";
         $attendancetable =   $text = "";        // $this->atterndance_details( $text);
  // dd($model);  , 'Holiday' => $$Holiday
      return view('attendance.emp_attendance.index', ['attendance' => $model,'startdate' =>'', 'enddate' => 
     '']);
   
    }

    public function filter_emp_attn(Request $request)
    {

	 $results= DB::table('attendance')
     ->where('employee_id',Auth::user()->emp_id)->orderby('created_at','DESC');
     
 //dd($query);

       $startdate = $request->startdate;
       $enddate = $request->enddate;
     // dd($startdate);
      if (($startdate != null) && ($enddate != null))
       {
          $startdate = date("Y-m-d", strtotime($request->startdate));
          $enddate = date("Y-m-d", strtotime($request->enddate));

         // $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);
           $results->whereBetween('attendance.date',[$startdate ,$enddate] );
      // $results->whereBetween('leaveenddate',[$startdate ,$enddate] );
        } 
      $query = $results->get();
      //$employee_id = $request->employee_id; 

     return view('attendance.emp_attendance.index',['attendance' => $query,'startdate' => $startdate, 'enddate' => 
     	$enddate]);


    }

    
}
