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
use DateTime;

class LeaveBalance extends Controller
{
    public function index(leave_balance $model)
    {

     //dd('test');
      //   $startDate = \Carbon\Carbon::now(); 
      //   $todate = \Carbon\Carbon::now()->format('Y-m-d');
      //   $d1 = new DateTime('2017-07-04');
      //   $d2 = new DateTime($todate);
      //   $diff_month_count = ($d1->diff($d2)->m);
      //   $items = (string)$diff_month_count;  
      //   dd($items);
        
    	$leave_balance = leave_balance::with('employee')
                        ->where('is_active', 1)
                        ->get();
            //  dd($leave_balance);
           //  $anual_count = 2.5;
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
        //DB::table('leave_balance')
            //  dd($res);

            //  $employee_dtl = Employee::where('employee_id',Auth::user()->emp_id)->orderby('created_at','DESC')->get();
               

        return view('leave_balance.index', ['leave_balance' => $leave_balance]);
    }
}
