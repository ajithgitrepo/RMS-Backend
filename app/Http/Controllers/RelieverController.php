<?php

namespace App\Http\Controllers;

use App\Reliever;


use App\Role;
use App\User;
use App\Employee_Reporting_To;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class RelieverController extends Controller
{
     public function index(Reliever $model)
    {
	
        $matchThese = ['is_active' => '1'];

        $results = Reliever::where($matchThese)
        ->with('employee')
        ->with('reliever')
        ->orderby('created_at','DESC')->get();
      

        return view('reliever.index', ['employee' => $results]);
    }

    public function test_reliver(Request $request)
    {
        $from = date("Y-m-d", strtotime($request->from_date)); 
        $to = date("Y-m-d", strtotime($request->to_date)); 

        $matchThese = ['is_active' => '1'];
        $get_timesheet =  DB::table('merchant_time_sheet')
        ->where('employee_id', $request->emp_merch_id)
        ->where($matchThese)
        ->whereBetween('date', [$from, $to])->count();

        if($get_timesheet == 0)
        return response()->json("No_Time_sheet");
     
    $matchThese = ['is_active' => '1'];
    
    $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
    ->where($matchThese)->where('employee_id', '!=', $request->emp_merch_id)
    ->with([
    'employee_reporting_to'  => function($query) {
    $query->select(['employee_id','first_name', 'middle_name','surname']);
    }
    ])->pluck('employee_id')->toArray(); 

    
 
    $res =  DB::table('merchant_time_sheet')
    ->whereIn('employee_id', $Merchresult)
    ->whereBetween('date', [$from, $to])->pluck('employee_id')->toArray();

    $emp_id = array();
    foreach ($Merchresult as $Merch)
    {
        if (!in_array($Merch, $res)) 
          $emp_id[] = $Merch;
    }

    $reliver_emp =   DB::table('employee')
    ->whereIn('employee_id', $emp_id)
    ->where('is_active', 1)->get();

    return response()->json($reliver_emp);

 }
	 
	public function create(Role $model)
    {

        $matchThese = ['is_active' => '1'];
        $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
    ->where($matchThese)
    ->with([
    'employee_reporting_to'  => function($query) {
    $query->select(['employee_id','first_name', 'middle_name','surname']);
    }
    ])->pluck('employee_id')->toArray(); 

   // dd($Merchresult);

        $employee = DB::table('employee')
                ->whereIn('employee_id', $Merchresult)
                ->where('is_active', 1)//->where('designation', 5)
                ->get();

        return view('reliever.create', ['employee' => $employee]);
    }

    public function store(Request $request)
    {
       // dd($request->reliever_id);
    //    $request->validate([
    //         'employee_id' => 'required',
    //         'role'=>'required',
    //         'reliever_id'=>'required',
    //         'from_date'=>'required',
    //         'to_date'=>'required',
    //         'reason'=>'required'
    //     ]);

        $from_date = date("Y-m-d", strtotime($request->from_date));  
        $to_date = date("Y-m-d", strtotime($request->to_date));

       // dd($to_date);
        
        $check =  DB::table('reliever')
        ->where('reliever_id', $request->reliever_id)
        ->where('is_active', 1)
        ->whereDate('from_date','<=', $from_date)
        ->whereDate('to_date','>=', $to_date)->count();
        //->whereBetween('date', [$from_date, $to_date])->count();
   // dd($check);
    if($check == 0)
    {
        $get_timesheet =  DB::table('merchant_time_sheet')
        ->where('employee_id', $request->employee_id)
        ->whereBetween('date', [$from_date, $to_date]);;
       
       $DummyClone = clone $get_timesheet;
       $DummyClone1 = clone $get_timesheet;
   
       $get_timesheet_id = $DummyClone->pluck('id')->toArray();
   
       $get_timesheet_data = $DummyClone1->get();
       
       $make_deactive_timesheet = DB::table('merchant_time_sheet')
       ->whereIn('id', $get_timesheet_id)
       ->update(['is_active' =>  0,
                 'updated_at' =>date('y-m-d H:i:s')]);
  // dd(make_deactive_timesheet);
  $time_id = "";
      foreach ($get_timesheet_data as $time)     
        {   
                 $create_timesheet = array(
                   'employee_id' => $request->reliever_id,
                   'date' =>  $time->date,
                   'outlet_id' => $time->outlet_id,
                   'scheduled_calls' => 1,
                   'is_defined' => 1, 
                   'is_active' => '1',
                   'created_at' => Carbon::now(),
                   'updated_at' => Carbon::now(),
                   'created_by' => Auth::user()->emp_id,
               );
               $time_id .= $time->id. "" . ",";
               $created_timesheet_reliver =  DB::table('merchant_time_sheet')
               ->insert($create_timesheet);
        }
   
            DB::table('reliever')->insert(
                array(
                    'employee_id'   =>   $request->employee_id,
                    'role'   =>   $request->role,
                    'reliever_id' => $request->reliever_id,
                    'from_date'   =>  $from_date, 
                    'to_date'   => $to_date,
                    'reason'  => $request->reason,
                    'timesheet_id' => $time_id,
                    'updated_at' => date('y-m-d H:i:s'),
                    'created_at' => date('y-m-d H:i:s'),
                    'created_by' => Auth::user()->emp_id,
                )); 
        }

        return response()->json(true);
        // return redirect()->route('reliever.index')->withStatus(__('Reliever created successfully'));

    }

    public function get_report_employee(Request $request)
    {
    
        $where = "No";
    $type= $request->emp_type;
    if($type == "field_manager")
    $where = 5;
    if($type == "merchandiser")
    $where = 6;
    if($type == "hr")
    $where = 12;
     
    $matchThese = ['is_active' => '1'];
    
    $reliver_emp =   DB::table('employee')
   // ->whereIn('employee_id', $Merchresult)
    ->where('is_active', 1)->where('designation', $where)->get();
  // dd($reliver_emp);
    return response()->json($reliver_emp);

 }

 public function get_result_employee(Request $request)
 {
 
    $matchThese = ['is_active' => '1'];

    $results = Employee_Reporting_To::where($matchThese)->with('employee')->with('employee_reporting_to');
    
      $emp_id = $request->Empid; //dd($emp_id);
     // $emp_type = $request->reporting_to_emp_id;

     $where = "No";
    $type= $request->type;
    if($type == "field_manager" || $type == "hr")
    $results =  $results->where('is_active',1)->where('employee_reporting_to.reporting_to_emp_id', $emp_id); 
    if($type == "merchandiser")
    $results =  $results->where('is_active',1)->where('employee_reporting_to.employee_id', $emp_id); 
   // if($type == "hr")
  //  $where = 12;

    $query = $results->get();

   // return view('employee.reporting-to.index', ['employee' => $query]);
 //dd($query);
 return response()->json($query);

}

    /** 

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

 /*   public function update(Request $request, $id )

    {


         $request->validate([
            'employee_id' => 'required',
            'role'=>'required',
            'reliever_id'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
            'reason'=>'required'
              
        ]);

        $from_date = date("Y-m-d", strtotime($request->from_date));  
        $to_date = date("Y-m-d", strtotime($request->to_date));  

  	
      $affected = DB::table('reliever')
              ->where('id', $id)
             ->update(['employee_id' =>   $request->employee_id,
                        'role'       =>   $request->role,
                        'reliever_id'   => $request->reliever_id,
                        'from_date'  =>  $from_date, 
                        'to_date'    => $to_date,
                        'reason'     => $reason,

                        'updated_at' =>date('y-m-d H:i:s')]);

        return redirect()->route('reliever.index')->withStatus(__('Reliever updated successfully'));


    }


    public function edit($id)
   {  
    	    	
        $reliever = DB::table('reliever')
               ->where('id', $id)
               ->get();

              

             return view('reliever.edit',['relieve' => $reliever]);
        
       
    }*/

     /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

        public function destroy($id)

        {

        $delete = DB::table('reliever')->where('id', $id)->update(['is_active'=>'0']);
    	
        return redirect()->route('reliever.index')->withStatus(__('Reliever deleted successfully'));
                   
          } 
	
	
}
