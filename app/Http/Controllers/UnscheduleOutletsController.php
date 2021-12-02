<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\merchant_timesheet;
use App\Outlet;
use App\Store_details;
use App\Employee_Reporting_To;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuditController as audit_store;

class UnscheduleOutletsController extends Controller
{

    public function index(merchant_timesheet $model)
    {

        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {
            //dd(Auth::user()->role->name);
            $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '0'];
           

             $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname', 'field.first_name as f_fname','field.middle_name as f_mname','field.surname as f_sname')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('employee as merchant', 'merchant.employee_id', '=', 'merchant_time_sheet.employee_id')
            ->leftJoin('employee as field', 'field.employee_id', '=', 'merchant_time_sheet.created_by')
            ->where($matchThese)
            ->whereDate('date', '=', date('Y-m-d'))
            ->orderBy('date')
            ->get();


           // dd($result);

            $merchandisers = DB::table('employee')
            //->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            //->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

       
            return view('unscheduled_outlets.index', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '' ]);
    
    
        }

        if(Auth::user()->role->name =="CDE")
        {

            $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '0'];
           
             $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('employee as merchant', 'merchant.employee_id', '=', 'merchant_time_sheet.employee_id')
            ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
            ->where('cde_reporting.cde_id', Auth::user()->emp_id)
            ->where($matchThese)
            ->whereDate('date', '=', date('Y-m-d'))
            ->orderBy('date')
            ->get();


            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->get();

            //dd($result);

       
            return view('unscheduled_outlets.index', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '' ]);


        }

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '0'];
        $value = 'someName';
       

        $result = DB::table('merchant_time_sheet')
        ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname',)
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->leftJoin('employee as merchant', 'merchant.employee_id', '=', 'merchant_time_sheet.employee_id')
        ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
        ->where($matchThese)
        ->whereDate('date', '=', date('Y-m-d'))
        ->orderBy('date')
        ->get();

        //dd($result);

         $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

       
        return view('unscheduled_outlets.index', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '' ]);
    
    }

    public function create()
    {

        if(Auth::user()->role->name =="CDE")
        {

            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->get();

            //dd($merchandisers);

        }

        if(Auth::user()->role->name =="Field Manager")
        {
            $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
		    ->where('employee_reporting_to.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();
        }
      

         $outlets = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
           // ->where('outlet.created_by',Auth::user()->emp_id)
            ->groupBy('outlet.outlet_id')
            ->get();

        //dd($outlets);   

        return view('unscheduled_outlets.create', ['merchandisers' => $merchandisers, 'outlets' => $outlets]);
    }

    public function store(Request $request, Employee $model)
    {
        //dd($request->all());
        
        $validatedData = $request->validate([
    		'merchandiser' => 'required',
            'date' => 'required|max:255',
            'outlet' => 'required|max:255',

	    ]);

     	$date = $request->date;
        //dd($joining_date);
        $new_date = date("Y-m-d", strtotime($date));  

      	$i = 0;

        //dd($request->type);

      	for($i=0;$i<count($request->outlet);$i++)
      	{
      		//dd($request->outlet[$i]);

                $created_by = Auth::user()->emp_id;

                if(Auth::user()->role->name =="CDE")
                {
                    $matchThese = ['is_active' => '1','employee_id' => $request->merchandiser];

                    $result = Employee_Reporting_To::where($matchThese)->with('employee','employee_reporting_to')->with('employee_reporting_to')->first();

                    $created_by = $result->employee_reporting_to->employee_id;
                }

                //dd($created_by);

             $outlet = array(
                    'employee_id' => $request->merchandiser, //$request->employee_id,
                    'date' => $new_date,
                    'outlet_id' => $request->outlet[$i],
                    'scheduled_calls' => $request->type,
                    'is_active' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'created_by' => $created_by,
                    'added_by' => Auth::user()->emp_id
                );
           
                $check = DB::table('merchant_time_sheet')
                    ->where('employee_id', $request->merchandiser)
                    ->where('date', $new_date)
                    ->where('outlet_id', $request->outlet[$i])
                    ->where('is_defined', 0)
                    ->where('is_active', 1)
                    ->get();

                    //dd($check);
                  
                    if ($check->isEmpty()) {

                        //dd($days[$i]);

                        DB::table('merchant_time_sheet')->insert($outlet);

                    }

               // DB::table('merchant_time_sheet')->insert($outlet);
	       
      	}

        $user = $request->merchandiser;

        $notify = new NotificationController();
         $ReportTo = "";
         //$ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
         //if( $ReportTo != "")
         $ReportToID = $user; 
         $title = "Fieldmanager added unscheduled timesheet";
         $user_type = "Merchandiser";
         $created_to = $ReportToID;
         $add_notify =  $notify->store($title, $user_type, $ReportToID);

        $audit = new audit_store();
        $description = ' added new unscheduled timesheet to ('.$request->merchandiser.')';
        $add_audit =  $audit->store($description,'journey_plan'); 


        return redirect()->route('unschedule-outlets.index')->withStatus(__('Unscheduled Outlet created successfully..'));
    }


    public function destroy(Request $request, $id)
    {
    	//$delete = DB::table('employee')->where('id', $id)->delete();

    	$date = date('Y-m-d');

    	//dd($id);

        $result = DB::table('merchant_time_sheet')
                ->where('id', $id)
                ->where('is_active', 1)
                ->get();

        $db_date = $result[0]->date; 

        if ($date > $db_date) {
		    //dd('greater than');
		    return redirect()->route('unschedule-outlets.index')->withStatus(__('You cant delete this outlet.'));
		}else{
		    //dd('Less than');
		    
                $result = DB::table('merchant_time_sheet')
	                ->where('id', $id)
	                ->update([
	                    'is_active' => '0',
	                    'updated_at' => Carbon::now()
	             ]);

                if($result){
                    $audit = new audit_store();
                    $description = ' removed unscheduled timesheet';
                    $add_audit =  $audit->store($description,'journey_plan'); 
                }
        

		}

    	return redirect()->route('unschedule-outlets.index')->withStatus(__('Outlet successfully deleted.'));
    }


     public function filter_unscheduled_outlet(Request $request)
    {  
        //dd($request->employee_id);
        //return $request->id;

       
        $start_date = $request->startdate;
        $end_date = $request->enddate;

        $employee_id = $request->employee_id;

       // dd($request->employee_id);
       
       // $matchThese = ['is_active' => '1', 'is_defined' => '1'];

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '0'];
        $value = 'someName';

       

        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {

             $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname', 'field.first_name as f_fname','field.middle_name as f_mname','field.surname as f_sname')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('employee as merchant', 'merchant.employee_id', '=', 'merchant_time_sheet.employee_id')
            ->leftJoin('employee as field', 'field.employee_id', '=', 'merchant_time_sheet.created_by')
            ->where($matchThese)
            ->orderBy('date');

        }

        if(Auth::user()->role->name =="Field Manager")
        {
            $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname',)
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('employee as merchant', 'merchant.employee_id', '=', 'merchant_time_sheet.employee_id')
            ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
            ->where($matchThese)
            ->orderBy('date');
        }

        if(Auth::user()->role->name =="CDE")
        {
            //dd(1);
           
             $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname',)
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('employee as merchant', 'merchant.employee_id', '=', 'merchant_time_sheet.employee_id')
             ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
            ->where('cde_reporting.cde_id', Auth::user()->emp_id)
            ->where($matchThese)
            ->orderBy('date');


        }

        if(!empty($employee_id))
        {
          // dd($start_date);

           
            $result->where('merchant_time_sheet.employee_id' , $employee_id);

        }

        if(!empty($start_date) && !empty($end_date))
        {
          // dd($start_date);

            $startdate = date('Y-m-d', strtotime($start_date));
            $enddate = date('Y-m-d', strtotime($end_date));

            $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);

        }

      

         $query = $result->get();
         //$query->appends(['employee_id' => $request->employee_id,'startdate' => $request->startdate, 'enddate' => $request->enddate]);

        //dd($query);

        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {
          $merchandisers = DB::table('employee')
           // ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            //->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

        }

        if(Auth::user()->role->name =="CDE")
        {
             $merchandisers = DB::table('employee')
            ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('cde_reporting.cde_id', Auth::user()->emp_id)
            ->get();
        }

        if(Auth::user()->role->name =="Field Manager")
        {
          $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();
        }
       
        return view('unscheduled_outlets.index', [ 'outlets' => $query, 'merchandisers' => $merchandisers, 
            'startdate' => $request->startdate, 'enddate' =>$request->enddate, 'employee_id' => $employee_id ]);
     
    }

}
