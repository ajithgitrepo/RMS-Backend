<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\weekoff;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Http\Controllers\AuditController as audit_store;

class WeekoffController extends Controller
{
	public function index(weekoff $model)
	{       
		
	 // $result = $model::('weekoff')->with('employee')->where('is_active',1)->orderby('created_at','DESC')->get();

	 $matchThese = ['weekoff.is_active' => '1'];

	 $result = $model->with('employee')->where($matchThese)->orderby('weekoff.created_at','DESC')
        ->select('weekoff.*','employee.first_name','employee.middle_name','employee.surname')
        ->leftJoin('employee', 'employee.employee_id', '=', 'weekoff.employee_id')
        ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
        ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
        ->where('employee.is_active', 1)
        ->get();

	//dd($result);
   
	 return view('weekoff.index',['result' => $result]);

	}

	public function create()
	{
		//$employees = DB::table('employee')->where('is_active',1)->get();

		//dd($employees);

		$result = DB::table('employee')
			->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
			->where('employee.is_active', 1)
			->where('designation', 6)
			->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
			->get();
   
		return view('weekoff.create',['employees' => $result]);

	}

	public function store(Request $request)
	{
		//dd($request->all());	

		$request->validate([
			'employee' => 'required',
			'month'=>'required',
			'day'=>'required',
			
		]);


       for($i=0;$i<count($request->month);$i++)
       { 

        //dd($request->month[$i]);

	   $check = DB::table('weekoff')
			->where('employee_id', $request->employee)
			->where('month', $request->month[$i])
			->where('year', $request->year)
			->get();

		 if ($check->isNotEmpty()) {
		   // dd($check);
			//return Redirect::back()->withStatus(__('Already Added in this month..')); 

          
             $affected = DB::table('weekoff')
                      ->where('employee_id', $request->employee)
                      ->where('month', $request->month[$i])
                      ->where('year', $request->year)
                      ->update([
                         'day' => $request->day,
                         'updated_at' => date('y-m-d H:i:s'),
                 ]);

		 }

         if ($check->isEmpty()) {
		   
			DB::table('weekoff')->insert(
				array(
					
					 'employee_id'   => $request->employee,
					 'month'   => $request->month[$i],
					 'day' => $request->day,
					 'year' => $request->year,
					 'updated_at' => date('y-m-d H:i:s'),
					 'created_at' => date('y-m-d H:i:s')

				)
			);

        }

        $audit = new audit_store();
        $description = $request->month[$i].' month weekoff added to ('.$request->employee.')';
        $add_audit =  $audit->store($description,'weekoff'); 

   
        }

       
		return redirect()->route('weekoff.index')->withStatus(__('WeekOff created successfully..'));

						 

	}


	public function show($id)

	{

		$result = weekoff::find($id);
		return view('weekoff.show',['weekoff' => $result]);
		

	}



	public function edit(weekoff $model, $id)
	{


	  $employees = DB::table('employee')
		->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
		->where('employee.is_active', 1)
		->where('designation', 6)
		->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
		->get();


		 $matchThese = ['is_active' => '1', 'id' => $id];

		 $result = $model->with('employee')->where($matchThese)->get();
	   
	    //dd($result);       
			 
		return view('weekoff.edit',['employees' => $employees, 'result' => $result]);
		
	   
	}

   

	public function update(Request $request, $id )
	{
		//dd($request->all());

        $current_month = date('m');
		   
	    $request->validate([
			'employee' => 'required',
			'month'=>'required',
			'day'=>'required',

		]); 

	    $check = DB::table('weekoff')
			->where('employee_id', $request->employee)
			->where('month', $request->month)
            //->where('day', $request->day)
			->where('year', $request->year)
            ->where('is_active', 1)
			->get();

        //dd($check);

        
		if ($check->isNotEmpty()){
		   // dd($check);
		  
            $month = $check[0]->month;

            $month_no = date('m', strtotime($month) );
            //dd($month_no);

            if($current_month < $month_no)
            {
               $timesheet = DB::table('merchant_time_sheet')
                ->where('employee_id', $request->employee)
                ->whereMonth('date', $month_no)
                ->whereYear('date', $request->year)
                ->get();

                //dd($timesheet);

                if ($timesheet->isNotEmpty()){

                    return Redirect::back()->withStatus(__('error-You cannot able to change weekoff this month..')); 
                }
                if ($timesheet->isEmpty()){

                    //dd(1);

                     $affected = DB::table('weekoff')
                      ->where('id', $id)
                      ->update([
                          'employee_id' => $request->employee,
                          'month'   => $request->month,
                          'day' => $request->day,
                          'year' => $request->year,
                          'updated_at' => date('y-m-d H:i:s')
                    ]);

                    $audit = new audit_store();
                    $description = $request->month.' month weekoff added to ('.$request->employee.')';
                    $add_audit =  $audit->store($description,'weekoff'); 

                    return redirect()->route('weekoff.index')->withStatus(__('WeekOff updated successfully..'));

                }

               
            }

            else{
                return Redirect::back()->withStatus(__('error-You cannot able to change weekoff this month..'));
            }

    	}

        return Redirect::back()->withStatus(__('error-You cannot able to change weekoff this month..'));

	}


	public function destroy($id)

	{

		$delete = DB::table('weekoff')->where('id', $id)->update(['is_active'=>'0']);

        $audit = new audit_store();
        $description = 'weekoff deleted ';
        $add_audit =  $audit->store($description,'weekoff'); 
		
		return redirect()->route('weekoff.index')->withStatus(__('WeekOff deleted successfully'));

				  
					 
	}   


	 public function get_emp_list(Request $request)
	{  
		//dd($request->role);

		// $result = DB::table('employee')
		//     ->where('designation', $request->role)
		//     ->where('is_active', '1')
		//     ->get();

		 $result = DB::table('employee')
			->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
			->where('employee.is_active', 1)
			->where('designation', 6)
			->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
			->get();

	   return response()->json($result);

	}
   
}
