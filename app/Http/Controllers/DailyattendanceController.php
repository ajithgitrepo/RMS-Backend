<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Daily;
use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class DailyattendanceController extends Controller
{
    

   public function index()
    {       
  
   //$results = Attendance::whereRaw('date = CURDATE()')->with('employee')->where('is_present',1)->get();

        $results = DB::table('attendance')
                ->select(array('attendance.*','employee.first_name', 'employee.middle_name', 'employee.surname'))
                ->join('employee','employee.employee_id','=','attendance.employee_id')
                ->join('roles','roles.id','=','employee.designation')
	 	        ->whereDate('date', Carbon::today())
                ->where('is_present',1)
                ->get();

       // dd($results);
                
     
          $role = DB::table('roles')->get();
  
  
     return view('dailyattendance.index', ['dailyattendance' => $results,'position' => $role]);
       }
   
   
   public function filter(Request $request)
    {  
        
  //  $results = Attendance::where('is_present',1)->with('employee');
  
  
 
   $role = $request->position;

   $results = DB::table('attendance')
                ->select(array('attendance.*','employee.first_name', 'employee.middle_name', 'employee.surname'))
                ->join('employee','employee.employee_id','=','attendance.employee_id')
                ->join('roles','roles.id','=','employee.designation')
		 ->where('is_present',1);
                
  

     if($role  != "Select")
     {
  
      $results->where('roles.id',$role );
           }
      
   
     if(!empty($request->employee_id))
     {

      $results->where('attendance.employee_id',$request->employee_id);
           }
      
      $query = $results->get();
     
      
       $startdate = ($request->startdate);
       $enddate = ($request->enddate);
      if (($startdate != null) && ($enddate != null))
       {
      $startdate = date("Y-m-d", strtotime($request->startdate));
      $enddate = date("Y-m-d", strtotime($request->enddate));
       
      $results->whereBetween('date',[$startdate ,$enddate] )->get();
        } 
      $query = $results->get();
      // dd( $query );
  
      

      $role = DB::table('roles')->get();
      return view('dailyattendance.index', ['dailyattendance' => $query ,'position' => $role]);

     
      }
   
   } 

