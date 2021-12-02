<?php

namespace App\Http\Controllers;

use App\Employee_Reporting_To;


use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeereportingController extends Controller
{
     public function index(Employee_Reporting_To $model)
    {
	
        $matchThese = ['is_active' => '1'];

        $results = Employee_Reporting_To::where($matchThese)->with('employee')->with('employee_reporting_to')->get();
       
       // $result = $model->with('employees')->where($matchThese)->get();

       // dd($result);

        return view('employee.reporting-to.index', ['employee' => $results]);
    }

	 public function filter_emp_reporting_to(Request $request)
     {// dd('test');
       $matchThese = ['is_active' => '1'];

        $results = Employee_Reporting_To::where($matchThese)->with('employee')->with('employee_reporting_to');
          
    //  dd($request->reporting_to_emp_id);
              // $where = "No";
              // $type= $request->emp_type;
              // if($type == "field_manager")
              // $where = 5;
              // if($type == "merchandiser")
              // $where = 6;
              // if($type == "hr")
              // $where = 12;
         
              //  $results->where('employee_reporting_to.employee_id',$request->employee_id);
        
       
       //  if(empty($request->reporting_to_emp_id))
        // dd($request->reporting_to_emp_id);
       //  {
          $emp_id = $request->employee_id;
          $emp_type = $request->reporting_to_emp_id;

        $results =  $results->where('is_active',1)->where('employee_reporting_to.reporting_to_emp_id', $emp_id); 
        //$request->reporting_to_emp_id);
       //  }
       


        $query = $results->get();

       // $emp = DB::table('employee')->where('is_active',1)->get();

     // dd($query);
        return view('employee.reporting-to.index', ['employee' => $query]);
 

     }

	 public function create(Role $model)
    {

        $employee = DB::table('employee')
                ->where('is_active', 1)
                ->get();

      $search = "Merchandiser";
        $merchant = DB::table('employee')->leftjoin('roles','employee.designation', 'roles.id')->where('roles.name', 'not like', DB::raw("'%$search%'"))->get();

        //dd($merchant);

        return view('employee.reporting-to.create', ['employee' => $employee, 'non_merchant' =>  $merchant]);
    }

    public function store(Request $request)

    {
    
    	
        $request->validate([
         'employee_id' => 'required',
            'reporting_employee_id'=>'required',
            'report_date'=>'required',
            'report_end_month'=>'required',
              
        ]);

        $report_date = date("Y-m-d", strtotime($request->report_date));  
        $report_end_month = date("Y-m-d", strtotime($request->report_end_month));  
      
     $check = DB::table('employee_reporting_to')->where('employee_id', $request->employee_id)
                     ->where('reporting_to_emp_id', $request->reporting_employee_id)
                     ->where('is_active', 1)->get(); 
       if( count($check) == 0)
       {
          DB::table('employee_reporting_to')->insert(
              array(
                
                'employee_id'   =>   $request->employee_id, 
                'reporting_to_emp_id'   =>   $request->reporting_employee_id,
                'reporting_date'   =>  $report_date, 
                'reporting_end_date'   => $report_end_month,
                'updated_at' => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s'),
                //'is_active' => 1 ,

              )
          );
        }
        else
        {
            $id = $check[0]->id;

            $affected = DB::table('employee_reporting_to')
              ->where('id', $id)
             ->update(['employee_id' => $request->employee_id,
             'reporting_to_emp_id' => $request->reporting_employee_id,
             'reporting_date' =>  $report_date,
             'reporting_end_date' =>  $report_end_month , 
            // 'is_active' => 1 ,
              'updated_at'=>date('y-m-d H:i:s')]);
              

        }
   

        return redirect()->route('employee-reporting.index')->withStatus(__('Reporting To created successfully'));

                         

    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )
    {

        $request->validate([
               
            'employee_id' => 'required',
            'reporting_employee_id'=>'required',
            'report_date'=>'required',
            'report_end_month'=>'required',
            
        ]);
        $report_date = date("Y-m-d", strtotime($request->report_date));  
        $report_end_month = date("Y-m-d", strtotime($request->report_end_month));
  
  	
      $affected = DB::table('employee_reporting_to')
              ->where('id', $id)
             ->update(['employee_id' => $request->employee_id,
             'reporting_to_emp_id' => $request->reporting_employee_id,
             'reporting_date' =>  $report_date,
             'reporting_end_date' =>  $report_end_month ,
              'updated_at'=>date('y-m-d H:i:s')]);

        return redirect()->route('employee-reporting.index')->withStatus(__('Reporting to updated successfully'));


    }


    public function edit($id)
   {  
    	    	 
        $employee_reporting_to = Employee_Reporting_To::with('employee')->with('employee_reporting_to')//DB::table('employee_reporting_to')
               ->where('id', $id)
               ->get();

               $matchThese = ['is_active' => '1'];

               $employee = DB::table('employee')
               ->where('is_active', 1)
               ->get();

//dd($employee_reporting_to);
             return view('employee.reporting-to.edit',['employeeReport' => $employee_reporting_to,'employee' => $employee]);
        
       
    }

     /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

        public function destroy($id)

        {

        $delete = DB::table('employee_reporting_to')->where('id', $id)->update(['is_active'=>'0', 'updated_at'=>date('y-m-d H:i:s')]);
    	
        return redirect()->route('employee-reporting.index')->withStatus(__('Reporting To deleted successfully'));

                      
                         
          } 
	
	
}
