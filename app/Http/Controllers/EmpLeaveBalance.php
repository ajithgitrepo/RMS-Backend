<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Employee;
use App\leave_balance;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DateTime;

class EmpLeaveBalance extends Controller
{
  protected $casts = [
    'id' => 'integer',
];
    public function index(leave_balance $model)
    {

    	$leave_balance = DB::table('leave_balance')
            ->where('is_active', 1)
            ->where('employee_id', Auth::user()->emp_id)
            ->get(); 

            $employee_dtl = Employee::where('employee_id',Auth::user()->emp_id)->orderby('created_at','DESC')->get();
          //  dd($leave_balance);
          
          //  $results = DB::table('employee')->where('employee_id',Auth::user()->emp_id)->get();
            /*$JoinDate =  $employee_dtl[0]->joining_date;
          //  dd($JoinDate);
            $startDate = \Carbon\Carbon::now(); 
            $todate = \Carbon\Carbon::now()->format('Y-m-d');
            $d1 = new DateTime($todate);
            $d2 = new DateTime('2017-07-04');
            $diff_month_count = ($d1->diff($d2)->m);
            $items = (string)$diff_month_count;  
            dd($items);  */
         ////  dd($diff_month_count);
         ////   $matchThese = ['total_month' => $diff_month_count, 'employee_id' => Auth::user()->emp_id];
         //   $leave_dtl = leave_balance::where($matchThese)->count();
          //  dd($leave_dtl);
           /* { 
              $MonthCount = "1";
              $todate = \Carbon\Carbon::now()->format('Y-m-d');
              $d1 = new DateTime($todate); 
              $res = DB::table('employee as emp')
              ->join('leave_balance as lb','lb.employee_id','=','emp.employee_id')
              ->select(array('lb.Annual_Leave', 'lb.employee_id', 'lb.total_month','emp.employee_id',
              'emp.created_at','emp.first_name','emp.middle_name','emp.surname', 'lb.mol_contract_date_final',
              \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate') as MonthCount")) )
            //  ->where('lb.employee_id', "RMS0070")//->get();
              ->where('lb.total_month', '!=', \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate')")) //->get();
            ->update([
                'lb.Annual_Leave' => DB::raw('lb.Annual_Leave + 2.5'),
                'lb.total_month' => DB::raw('lb.total_month + 1'),
              ]);    
            }  */
           
           $Leave_rule =  DB::table('leave_rule')->where('is_active', 1)->get();
           $anual_count = $Leave_rule[2]->total_days;
           $sick_count = $Leave_rule[0]->total_days;
         //  dd($Leave_rule[2]->total_days);
              $MonthCount = "1"; 
              $todate = \Carbon\Carbon::now()->format('Y-m-d');
              $d1 = new DateTime($todate);
              $res = DB::table('employee as emp')
              ->join('leave_balance as lb','lb.employee_id','=','emp.employee_id')
              ->select(array('lb.Annual_Leave', 'lb.employee_id', 'lb.total_month','emp.employee_id',
              'emp.created_at','emp.first_name','emp.middle_name','emp.surname', 'lb.mol_contract_date_final',
              \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate') as MonthCount")) )
            //  ->where('lb.employee_id', "RMS0070")//->get();
            ->where('lb.total_month', '!=', \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate')")) //->get();
            ->update([ 
                'lb.Annual_Leave' => DB::raw("lb.Annual_Leave + $anual_count" ),
                'lb.Sick_Leave' => DB::raw("lb.Sick_Leave + $sick_count"),
                'lb.total_month' => DB::raw('lb.total_month + 1'),
              ]);   

         return view('leave_balance.employee.index', ['leave_balance' => $leave_balance, 'employee_dtl' => $employee_dtl]);
    }
  public function filter_empleave_balance(Request $request)
{
//$results = DB::table('leave_balance') ->where('is_active', 1)->where('employee_id', Auth::user()->emp_id);
         
          $matchThese = ['is_active' => '1'];

         $results = leave_balance::where($matchThese)->with('employee');
       //dd($results);

          if(!empty($request->employee_id))
      
         {
         
                $results->where('leave_balance.employee_id',$request->employee_id);
         }
       
        $query=$results->get();
       //dd($query);
       // $employee_dtl = Employee::where('employee_id',Auth::user()->emp_id)->orderby
       // ('created_at','DESC')->get();
       // $employee  = DB::table('employee')->where('is_active',1)->get();

        return view('leave_balance.index',['leave_balance' => $query]);


  }
}
