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

use Illuminate\Support\Facades\Auth;

class MerchantimesheetController extends Controller
{
    public function index(merchant_timesheet $model)
    {
        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' =>'0', 'store_details.is_active' => '1', 'outlet.is_active' => '1'];

        if(Auth::user()->role->name =="Field Manager")
        {
            
            $result = merchant_timesheet::with(['outlet'])
            ->select('merchant_time_sheet.*','store_details.store_name')
            //->leftJoin('employee_reporting_to', 'employee_reporting_to.employee_id', '=', 'merchant_time_sheet.employee_id')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            //->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
            ->whereMonth('date', Carbon::now()->month)
            ->where($matchThese)
            ->orderBy('date')
            ->paginate(10);

             $merchandisers = DB::table('employee')
                ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
                ->get();

            //dd($result);

        }


        if(Auth::user()->role->name =="CDE")
        {

            $result = merchant_timesheet::with(['outlet'])
                ->select('merchant_time_sheet.*','store_details.store_name')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name') 
                ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->whereMonth('date', Carbon::now()->month)
                ->where($matchThese)
                ->orderBy('date')
                ->paginate(10);

            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->get();

        }

        return view('merchant_timesheet.index', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '' ]);

    }


    public function create()
    {

        $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

        $outlets = Outlet::with('store')
            ->where('is_active', 1)
            ->where('is_assigned', 0)
            ->get();

        //dd($outlets);   

        return view('merchant_timesheet.create', ['merchandisers' => $merchandisers, 'outlets' => $outlets]);
    }


    public function store(Request $request, Employee $model)
    {
       // dd($request->all());
        
        $validatedData = $request->validate([
    		'merchandiser' => 'required|max:255',
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

             $outlet = array(
                    'employee_id' => $request->merchandiser, //$request->employee_id,
                    'date' => $new_date,
                    'outlet_id' => $request->outlet[$i],
                    'scheduled_calls' => $request->type,
                    'is_active' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'created_by' => Auth::user()->emp_id
                );
           
                // $check = DB::table('merchant_time_sheet')
                //     ->where('employee_id', $request->merchandiser)
                //     ->where('date', $new_date)
                //     ->where('outlet_id', $request->outlet[$i])
                //     ->where('is_active', 1)
                //     ->get();

                //    // dd($check);
                  
                //     if ($check->isEmpty()) {

                //         //dd($days[$i]);

                //         DB::table('merchant_time_sheet')->insert($outlets);

                //     }

                DB::table('merchant_time_sheet')->insert($outlet);
	       
      	}

        return redirect()->route('merchant-timesheet.index')->withStatus(__('Outlet assigned successfully..'));
    }

    public function filter_merchant_timesheet(Request $request)
    {  
        //dd($request->filter_ip_addr);
        //return $request->id;

        $employee_id = $request->employee_id;
        $start_date = $request->startdate;
        $end_date = $request->enddate;
       
        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' =>'0', 'store_details.is_active' => '1', 'outlet.is_active' => '1'];

        if(Auth::user()->role->name =="Field Manager")
        {
            $result = merchant_timesheet::with(['outlet'])
                ->select('merchant_time_sheet.*','store_details.store_name')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
                ->where($matchThese)
                ->orderBy('date');

            $merchandisers = DB::table('employee')
                ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
                ->get();
        }

        if(Auth::user()->role->name =="CDE")
        {

            $result = merchant_timesheet::with(['outlet'])
                ->select('merchant_time_sheet.*','store_details.store_name')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name') 
                ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->where($matchThese)
                ->orderBy('date');

            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->get();
        }
     

        $date = \Carbon\Carbon::now();

        $filter_month = $date->format('F');
        $filter_year = $date->format('Y');   
       
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

        else
        {
            $result->whereMonth('date', Carbon::now()->month);
        }

        // if(!empty($employee_id))
        // {
        //    //dd($store);
        //     $result->where('employee_id' , $employee_id);

        // }

        // if(!empty($request->specific_date))
        // {
        //     $specific_date = date('Y-m-d', strtotime($request->specific_date));

        //     $result->where('date' , $specific_date);

             
        // }

       
        // if(!empty($request->specific_month) && !empty($request->year) )
        // {
            
        //      $append_date =  date('Y-m-d', strtotime('01-'.$specific_month));
        //      $month_specific = date('Y-m', strtotime($append_date));
        //      //dd($month_specific);

        //      $result->where(\DB::raw("DATE_FORMAT(date, '%Y-%m')"), $month_specific);

        //      //dd($request->year);

        //      $result->where( DB::raw('YEAR(date)'), $request->year );

        //      $date = Carbon::createFromFormat('Y-m-d', $append_date);

        //     $filter_month = $date->format('F');
        //     $filter_year = $date->format('Y'); 

        //    // dd($filter_year);


        // }

        $query = $result->paginate(10);
        $query->appends(['employee_id' => $request->employee_id,'startdate' => $request->startdate, 'enddate' => $request->enddate,]);

       // dd($query);

        return view('merchant_timesheet.index', ['outlets' => $query, 'merchandisers' => $merchandisers, 'startdate' => $start_date, 'enddate' => $end_date, 'employee_id' => $employee_id ]);
     
    }


}
