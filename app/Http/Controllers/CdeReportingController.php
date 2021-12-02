<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\User;
use App\Employee;
use App\cde_reporting;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CdeReportingController extends Controller
{
    public function index(cde_reporting $model)
    {
    
         $matchThese = ['employee.is_active' => '1','cde_reporting.is_active' => '1'];

         $result = cde_reporting::where($matchThese)->with('merchandiser')->with('cde_reporting')
         ->leftJoin('employee', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
         ->get();
       
         // dd($result);

        return view('cde_reporting.index', ['employee' => $result]);
    }


    public function create(Role $model)
    {

        $merchant = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

       //$search = "Merchandiser";
        $cde =  DB::table('employee')
            ->where('is_active', 1)
            ->where('designation', 2)
            ->get();

        //dd($merchant);

        return view('cde_reporting.create', ['merchant' => $merchant, 'cde' =>  $cde]);
    }


    public function store(Request $request)

    {
    
        
        $request->validate([
            'merchant_id' => 'required',
            'cde_id'=>'required',
            'report_date'=>'required',
            'report_end_month'=>'required',
              
        ]);

        $report_date = date("Y-m-d", strtotime($request->report_date));  
        $report_end_month = date("Y-m-d", strtotime($request->report_end_month));  


            DB::table('cde_reporting')->insert(
                 array(
                    
                    'merchandiser_id'   =>   $request->merchant_id,
                    'cde_id'   =>   $request->cde_id,
                    'reporting_date'   =>  $report_date, 
                    'reporting_end_date'   => $report_end_month,
                    'created_by'   => Auth::user()->emp_id,
                    'updated_at' => date('y-m-d H:i:s'),
                    'created_at' => date('y-m-d H:i:s')

                 )
            );
   

        return redirect()->route('cde_reporting.index')->withStatus(__('Reporting To created successfully'));

    }

    public function edit($id)
   {  
                
        $cde_reporting_to = DB::table('cde_reporting')
           ->where('id', $id)
           ->where('is_active', '1')
           ->get();

        
        $merchant = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

        //$search = "Merchandiser";
        $cde =  DB::table('employee')
            ->where('is_active', 1)
            ->where('designation', 2)
            ->get();


             return view('cde_reporting.edit',['cde_reporting_to'=> $cde_reporting_to, 'cde' => $cde, 'merchant' =>  $merchant]);
        
       
    }


    public function update(Request $request, $id )
    {

        $request->validate([
               
            'merchant_id' => 'required',
            'cde_id'=>'required',
            'report_date'=>'required',
            'report_end_month'=>'required',
            
        ]);
        $report_date = date("Y-m-d", strtotime($request->report_date));  
        $report_end_month = date("Y-m-d", strtotime($request->report_end_month));
  
    
      $affected = DB::table('cde_reporting')
              ->where('id', $id)
             ->update(['merchandiser_id' => $request->merchant_id,
             'cde_id' => $request->cde_id,
             'reporting_date' =>  $report_date,
             'reporting_end_date' =>  $report_end_month ,
              'updated_at'=>date('y-m-d H:i:s')]);

        return redirect()->route('cde_reporting.index')->withStatus(__('Reporting to updated successfully'));


    }


     /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

        public function destroy($id)

        {

        $delete = DB::table('cde_reporting')->where('id', $id)->update(['is_active'=>'0']);
        
        return redirect()->route('cde_reporting.index')->withStatus(__('Reporting To deleted successfully'));

                      
                         
          } 


}
