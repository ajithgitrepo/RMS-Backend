<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Employeeleaves;
use App\Role;
use App\User;
use App\Employee;
use App\Leave;
use App\Leaverequest;
use App\Leaves;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;


class LeavesController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

   
   public function index(Leaves $model)
   {   
   /* $match = [ "employee_id" => Auth::user()->emp_id , "designation" => 3  ];
    $chk = Employee::where($match)->count();
    if($chk == 0)
    $matchcase = [  "is_approved" => 1,"is_approved" => 0, 'is_rejected' => 1, 'is_rejected' => 0, 'reporting_to_emp_id' => Auth::user()->emp_id  ];  // ->where("is_approved", '!=', 2)->where('reporting_to_emp_id',Auth::user()->emp_id)
   else  */
   $matchcase = [ 'reporting_to_emp_id' => Auth::user()->emp_id ];
    // DB::connection()->enableQueryLog();
   //dd(Auth::user()->emp_id);

  $merchandisers = DB::table('employee')  
  ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
  ->where('employee.is_active', 1)
  ->where('designation', 6)
  ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)->pluck('employee_reporting_to.employee_id')->all();
  //->pluck('employee_reporting_to.employee_id')->toArray();
  //->get();
  
    $results = Leaverequest::with('employee')
    ->whereIn('employee_id', $merchandisers)->get();
   // ->where('is_approved', '!=', 2)->orderby('created_at','DESC')->get();
    
    //dd( $results);

    
    //->where($matchcase )
   // 
    
   //  dd($results);
    //$queries = DB::getQueryLog(); 
   
     
     return view('leaves.index', ['leaves' => $results]);
   }
    
    public function approvedfield(Request $request,$id,$type)
   {
     //dd($id);
       $affected = DB::table('leaverequest')
       ->where('lrid', $id)
       ->update(['is_approved' =>"1"]);

        $emp_id = DB::table('leaverequest')
           ->where('lrid', $id)
           ->get();

        //dd($emp_id[0]->employee_id);

        //$user = Auth::user()->emp_id;

        $notify = new NotificationController();
         // $ReportTo = "";
         // $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
         // if( $ReportTo != "")
         //$ReportToID = $emp_id->employee_id; 
     
         $title = "Field Manager accept your leave request and waiting for HR approval";
         $user_type = "Merchandiser";
         $created_to = $emp_id[0]->employee_id; 
         $add_notify =  $notify->store($title, $user_type, $created_to);

        $audit = new audit_store();
        $description = ' accept merchandiser leave request ';
        $add_audit =  $audit->store($description,'Leave_status'); 
   
        return redirect()->route('leaves.index')->withStatus(__('Leave approved successfully..'));
      }
      
    public function rejectedfield(Request $request,$id)
   {
    
      $affected = DB::table('leaverequest')
       ->where('lrid', $id)
       ->update(['is_rejected' =>"1"]);

        $emp_id = DB::table('leaverequest')
           ->where('lrid', $id)
           ->get();

        //dd($emp_id[0]->employee_id);

        //$user = Auth::user()->emp_id;

        $notify = new NotificationController();
         // $ReportTo = "";
         // $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
         // if( $ReportTo != "")
         //$ReportToID = $emp_id->employee_id; 
     
         $title = "Field Manager reject your leave request";
         $user_type = "Merchandiser";
         $created_to = $emp_id[0]->employee_id; 
         $add_notify =  $notify->store($title, $user_type, $created_to);

        $audit = new audit_store();
        $description = ' reject merchandiser leave request ';
        $add_audit =  $audit->store($description,'Leave_status'); 

        return redirect()->route('leaves.index')->withStatus(__('Leave rejected successfully..'));
          
      
    }
    
    }
    
