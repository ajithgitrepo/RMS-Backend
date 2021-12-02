<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\merchant_timesheet;
use App\Outlet;
use App\Store_details;

use Illuminate\Support\Facades\Auth;

use App\Imports\TimesheetImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;

class ScheduleOutletsController extends Controller
{
    public function index(merchant_timesheet $model)
    {

        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {
            //dd(Auth::user()->role->name);
            $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '1'];
            $value = 'someName';
            $result = merchant_timesheet::with(['outlet','employee','employee_field'])

            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where($matchThese)   
            ->whereDate('date', '=', date('Y-m-d'))
            ->orderBy('date')
            ->get();

            //dd($result);

            $merchandisers = DB::table('employee')
            //->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            //->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

       
            return view('scheduled_outlets.index', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '' ]);
    
        }

        if(Auth::user()->role->name =="CDE")
        {
            $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '1'];
            $value = 'someName';

            $result = merchant_timesheet::with(['outlet','employee'])
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
            ->where('cde_reporting.cde_id', Auth::user()->emp_id)
            ->whereDate('date', '=', date('Y-m-d'))
            ->where($matchThese)
            ->orderBy('date')
            ->get();

            //dd($result);

            $merchandisers = DB::table('employee')
            ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('cde_reporting.cde_id', Auth::user()->emp_id)
            ->get();

            //dd($merchandisers);

       
            return view('scheduled_outlets.index', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '' ]);

        }

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '1'];
        $value = 'someName';

        $result = merchant_timesheet::with(['outlet','employee'])
        ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
         ->whereDate('merchant_time_sheet.date', Carbon::today())
        ->where($matchThese)
        ->orderBy('date')
        ->get();

        //dd($result);

         $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

       
        return view('scheduled_outlets.index', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '' ]);
    
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
            // ->leftJoin('employee', 'employee.employee_id', '=', 'outlet.created_by')
            ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet.created_by')
            ->where('outlet.is_active', 1)
            //->where('brand_details.field_manager_id', Auth::user()->emp_id)
            ->where('outlet.is_assigned', 0)
            ->where('outlet.created_by',Auth::user()->client_id)
            ->groupBy('outlet.outlet_id')
            ->get();


        // dd($outlets);   

        return view('scheduled_outlets.create', ['merchandisers' => $merchandisers, 'outlets' => $outlets]);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'merchandiser' => 'required|max:255',
            'days' => 'required|max:255',
            'outlets' => 'required|max:255',

        ]);

        //dd($request->all());

        $days = $request->days;
        //dd($days);
        //$new_date = date("Y-m-d", strtotime($date));  

        $i = 0;
        $j = 0;
        $l = 0;

            $today = today(); 
            $dates = array(); 

            

            //dd($today->month);

            // for($i=1; $i < $no_of_days + 1; ++$i) {
            //    // dd(\Carbon\Carbon::createFromDate($request->year, $nmonth, $i)->format('D'));
            //     if(\Carbon\Carbon::createFromDate($request->year, $nmonth, $i)->format('D') == 'Tue')
            //     {
            //         $dates[] = \Carbon\Carbon::createFromDate($request->year, $nmonth, $i)->format('Y-m-d');
            //     }
                
            // }

           
            //dd($dates);

        for($l=0;$l<count($request->month);$l++)
        {
        for($i=0;$i<count($request->days);$i++)
        {
            for($j=0;$j<count($request->outlets);$j++)
            {
               
                $nmonth = date("m", strtotime($request->month[$l]));
                //dd($nmonth);

                $no_of_days=cal_days_in_month(CAL_GREGORIAN,$nmonth,$request->year);
                //dd($no_of_days);

                 for($k=1; $k < $no_of_days + 1; ++$k) {
                    //dd($request->days[$i]);
                     
                     if(\Carbon\Carbon::createFromDate($request->year, $nmonth, $k)->format('D') == $request->days[$i] )
                     {
                        
                       //dd(\Carbon\Carbon::createFromDate($request->year, $nmonth, $k)->format('D'));


                        $dates = \Carbon\Carbon::createFromDate($request->year, $nmonth, $k)->format('Y-m-d');

                        //dd($dates);

                        $created_by = Auth::user()->emp_id;

                        if(Auth::user()->role->name =="CDE")
                        {
                            $matchThese = ['is_active' => '1','employee_id' => $request->merchandiser];

                            $result = Employee_Reporting_To::where($matchThese)->with('employee','employee_reporting_to')->with('employee_reporting_to')->first();

                            $created_by = $result->employee_reporting_to->employee_id;
                        }

                        //dd($created_by);

                         $outlets = array(
                            'employee_id' => $request->merchandiser, 
                            'date' => $dates,
                            'outlet_id' => $request->outlets[$j],
                            'scheduled_calls' => '1',
                            'is_active' => '1',
                            'is_defined' => '1',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                            'created_by' => $created_by,
                            'added_by' => Auth::user()->emp_id
                        );

                        $check = DB::table('merchant_time_sheet')
                            ->where('employee_id', $request->merchandiser)
                            ->where('date', $dates)
                            ->where('outlet_id', $request->outlets[$j])
                            ->where('is_defined', 1)
                            ->where('is_active', 1)
                            ->get();

                        //dd($outlets);
                      
                        if ($check->isEmpty()) {

                            //dd($days[$i]);

                            DB::table('merchant_time_sheet')->insert($outlets);

                        }

                    }

                }


            }
        }
        }   

        $user = $request->merchandiser;

         $notify = new NotificationController();
         $ReportTo = "";
         //$ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
         //if( $ReportTo != "")
         $ReportToID = $user; 
         $title = "Fieldmanager added scheduled timesheet";
         $user_type = "Merchandiser";
         $created_to = $ReportToID;
         $add_notify =  $notify->store($title, $user_type, $ReportToID);

        $audit = new audit_store();
        $description = ' added new scheduled timesheet to ('.$request->merchandiser.')';
        $add_audit =  $audit->store($description,'journey_plan'); 

        return redirect()->route('schedule-outlets.index')->withStatus(__('Timesheet created successfully..'));
    }


    

    public function edit(merchant_timesheet $model, $id)
    {   
        //dd($id);

        $matchThese = ['id' => $id];

        $results = gift::where($matchThese)->get();

        //dd($results);
    	
    	//$emp = Employee::find($id);
        return view('scheduled_outlets.edit',['data' => $results]);
       
    }

    public function update(Request $request, $id, gift $model)
    {	
      
    }

    public function destroy(Request $request, $id)
    {
    	//$delete = DB::table('employee')->where('id', $id)->delete();

    	$date = date('Y-m-d');

    	//dd($id);

        // $result = DB::table('merchant_time_sheet')
        //         ->where('id', $id)
        //         ->where('is_active', 1)
        //         ->get();

        // $db_date = $result[0]->date; 

  //       if ($date > $db_date) {
		//     //dd('greater than');
		//     return redirect()->route('schedule-outlets.index')->withStatus(__('You cant delete this outlet.'));
		// }else{
		    //dd('Less than');
		    
            $result = DB::table('merchant_time_sheet')
                ->where('id', $id)
                ->update([
                    'is_active' => '0',
                    'updated_at' => Carbon::now()
            ]);


            if($result){
                $audit = new audit_store();
                $description = ' removed scheduled timesheet';
                $add_audit =  $audit->store($description,'journey_plan'); 
            }
        

		//}

    	//return redirect()->route('schedule-outlets.index')->withStatus(__('Timesheet successfully deleted.'));

        return redirect()->back()->withStatus(__('Timesheet successfully deleted.'));
    }


     public function filter_scheduled_outlet(Request $request)
    {  
        //dd($request->employee_id);
        //return $request->id;

       
        $start_date = $request->startdate;
        $end_date = $request->enddate;

        $employee_id = $request->employee_id;
        $status = $request->status;

       // dd($request->employee_id);
       
       // $matchThese = ['is_active' => '1', 'is_defined' => '1'];

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '1'];
        $value = 'someName';

       
        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {
            
            $result = merchant_timesheet::with(['outlet','employee','employee_field'])

            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where($matchThese)   
            ->orderBy('date');
            
        }

        if(Auth::user()->role->name =="Field Manager")
        {   
             $result = merchant_timesheet::where($matchThese)->with('outlet')->with('employee')

             ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
            ->orderBy('date');

            
        }

        if(Auth::user()->role->name =="CDE")
        {
            //dd(1);
           
            $result = merchant_timesheet::with(['outlet','employee'])
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
            ->where('cde_reporting.cde_id', Auth::user()->emp_id)
            ->where($matchThese) 
            ->orderBy('date');
        }
       
        if(!empty($employee_id))
        {
           //dd($employee_id);

            $result->where('merchant_time_sheet.employee_id' , $employee_id);

        }

        if(!empty($status))
        {
          // dd($start_date);

            $result->where('merchant_time_sheet.is_completed' , $status);

        }

        if(!empty($start_date) && !empty($end_date))
        {
          // dd($start_date);

            $startdate = date('Y-m-d', strtotime($start_date));
            $enddate = date('Y-m-d', strtotime($end_date));

            $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);

        }

        // if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        // {
        //     $query = $result->get();
        // }
        // if(Auth::user()->role->name =="Field Manager")
        // {
         $query = $result->get();
         //$query->appends(['employee_id' => $request->employee_id,'startdate' => $request->startdate, 'enddate' => $request->enddate]);
       // }

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

        if(Auth::user()->role->name =="Field Manager")
        {

             $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
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

       
        return view('scheduled_outlets.index', [ 'outlets' => $query, 'merchandisers' => $merchandisers, 
            'startdate' => $request->startdate, 'enddate' =>$request->enddate, 'employee_id' => $employee_id ]);
     
    }


    public function follow_timesheet(Request $request)
    {  
        //dd('working..');

         $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

        $outlets = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            //->where('outlet.created_by',Auth::user()->emp_id)
            ->groupBy('outlet.outlet_id')
            ->get();


        //dd($outlets);   

        return view('scheduled_outlets.follow', ['merchandisers' => $merchandisers, 'outlets' => $outlets]);

    }

    public function add_follow_timesheet(Request $request)
    { 
        //dd($request->all());

        //$date = date("Y-n-j", strtotime("last day of this month"));

        $weekdays = array("0", "1", "2", "3", "4", "5", "6");
        $new_array = array();

        //dd($request->all());


       for($i=0; $i<count($request->merchandiser); $i++) 
       {
        
       foreach ($request->month as $m_count) {

        
        foreach ($weekdays as $value) {

            $result = DB::table('merchant_time_sheet')
            ->whereRaw('WEEKDAY(merchant_time_sheet.date) = '.$value.' ')
            ->where('merchant_time_sheet.created_by', Auth::user()->emp_id) 
            ->where('merchant_time_sheet.is_defined', 1)
            ->where('merchant_time_sheet.is_active', 1)
            ->where('merchant_time_sheet.employee_id', $request->merchandiser[$i])
            ->whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->groupBy('date')
            ->groupBy('outlet_id')

            ->get();



           // dd($request->merchandiser[$j]);

            // if($request->merchandiser[$j] == "Emp3058"){
            //     dd($request->merchandiser[$j]);
            // }
            

            foreach ($result as $records) {

                $month_value = date('m', strtotime($records->date));
                $year_value = date('Y', strtotime($records->date));
                $day_value = date('d', strtotime($records->date));

                $day_db = \Carbon\Carbon::createFromDate($year_value, $month_value, $day_value)->format('D');

                //dd($year_value);

                $month = $m_count;
                //dd($month);
                if($month_value < 12)
                {   
                    // dd($year_value);
                    // $now = new DateTime();
                    // $year = $now->format('Y'); 
                    // $month = $now->format('m') + 1; 
                     $year = $year_value; 
                     //$month = $month_value + 1; 
                }
                else
                {
                    $year = $year_value + 1; 
                    //$month = 01; 
                }

                //dd($month);


                $no_of_days=cal_days_in_month(CAL_GREGORIAN,$month,$year);

                //dd($no_of_days);

                for($j=1; $j <=$no_of_days; $j++) {
                   //dd($i);
                    $dates = \Carbon\Carbon::createFromDate($year, $month, $j)->format('Y-m-d');

                    $day_convert = \Carbon\Carbon::createFromDate($year, $month, $j)->format('D');
                    //dd($dates);
                    $compare = strcmp($day_db, $day_convert);

                    //dd($day_convert);

                    if($day_convert == $day_db)
                    {
                        //dd($dates);
                        $new_array[] = $dates.'-'.$records->outlet_id.'-'.$day_convert;

                        $outlets = array(
                            'employee_id' => $records->employee_id, 
                            'date' => $dates,
                            'outlet_id' => $records->outlet_id,
                            'scheduled_calls' => '1',
                            'is_active' => '1',
                            'is_defined' => '1',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                            'created_by' => Auth::user()->emp_id
                        );

                         $check = DB::table('merchant_time_sheet')
                        ->where('employee_id', $records->employee_id)
                        ->where('date', $dates)
                        ->where('outlet_id', $records->outlet_id)
                        ->where('is_active', 1)
                        ->get();

                        //dd($check);
                      
                        if ($check->isEmpty()) {

                            DB::table('merchant_time_sheet')->insert($outlets);

                        }
                    } 
                    
                     
                }

                //break;

            }

        }

        }

       
        }


        return redirect()->route('schedule-outlets.index')->withStatus(__('Timesheet created successfully..'));

    }


    public function import_timesheet(Request $request)
    {

        return view('scheduled_outlets.import');       
    }


    public function import(Request $request)
    {

        $request->validate([
            'timesheet_import' => 'required|mimes:csv,xlsx,xls,txt'
        ]);

        if($request->hasfile('timesheet_import'))
        { 
             //$customerArr = $this->csvToArray($request->outlet_import);

           $customerArr = Excel::toArray(new TimesheetImport,request()->file('timesheet_import'));

        }

        // dd($customerArr);
    
        $new_array = array();
        for($i=0;$i<count($customerArr[0]);$i++)
        {

            $emp_id = $customerArr[0][$i]['employee'];

            $outlet_name = $customerArr[0][$i]['outlet_name'];
            
            $emp_id_arr = explode ("-", $emp_id); 

            $outlet_name_arr = explode ("-", $outlet_name);

            //dd($outlet_name_arr[1]);

            // if(empty($outlet_name_arr[1])){
            //     dd($outlet_name_arr[0]);
            // }

            //$new_array[] =  $outlet_name_arr[0].'-'.$outlet_name_arr[1];

            if(!isset($emp_id_arr[0]) || !isset($outlet_name_arr[0]))
            {


                return redirect()->back()->withStatus(__('error-Please check your Excel / CSV values has correct format..'));

            }

            //dd($outlet_name_arr);



            // //dd($outlet_name_arr[1]);
            // $check_store = DB::table('store_details')
            //     ->where('store_code', $outlet_name_arr[1])
            //     ->where('is_active', 1)
            //     ->get();

            // if($check_store->isEmpty())
            // {
            //     return redirect()->back()->withStatus(__('error-Some store code does not match in records please check..'));
            // }

        } 

        //dd($new_array);

        for($i=0;$i<count($customerArr[0]);$i++)
        {
            $nmonth = date("m", strtotime($customerArr[0][$i]['month']));

            // dd($nmonth);

            $no_of_days = cal_days_in_month(CAL_GREGORIAN,$nmonth,$customerArr[0][$i]['year']);

             //dd($customerArr[0][$i]['year']);

            $emp_id = $customerArr[0][$i]['employee'];

            $outlet_name = $customerArr[0][$i]['outlet_name'];
            
            $emp_id_arr = explode ("-", $emp_id); 

            $outlet_name_arr = explode ("-", $outlet_name);

            $check_store = DB::table('store_details')
                ->where('store_code', $outlet_name_arr[1])
                ->where('is_active', 1)
                ->get();

           
            //     dd($check_store);

            if($check_store->isEmpty())
            {

                $store_insert_id = DB::table('store_details')->insertGetId(
                    array(
                        'store_code' =>$outlet_name_arr[1],
                        'store_name'=>$outlet_name_arr[0],
                        'contact_number'=>'',
                        'address'=>$outlet_name_arr[0],
                        'created_by'  => "Emp2784",
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')
                       
                    )
                );

                $outlet_insert_id = DB::table('outlet')->insertGetId(
                   array(
                  
                        'outlet_name'  => $store_insert_id,
                        'outlet_lat' => '25.06894675649297',
                        'outlet_long' => '55.1426825853866',
                        'outlet_country' => 'UAE',
                        'created_by'  =>  "Emp2784",
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')
                   )                                     
              );

                $check_store = DB::table('store_details')
                ->where('store_code', $outlet_name_arr[1])
                ->where('is_active', 1)
                ->get();


            }

            // if($outlet_name_arr[1] == 5000)
            //     dd($check_store);

            if($check_store->isNotEmpty())
            {
            $check_outlet = DB::table('outlet')
                ->where('outlet_name', $check_store[0]->id)
                ->where('is_active', 1)
                ->get();

            //dd($check_store[0]->id);

            if($check_outlet->isEmpty())
            {
                $insert_outlet_id = DB::table('outlet')->insertGetId(
                   array(
                  
                        'outlet_name'  => $check_store[0]->id,
                        'outlet_country' => 'UAE',
                        'created_by'  =>  "Emp2784",
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')
                   )
                );

                $check_outlet = DB::table('outlet')
                    ->where('outlet_id', $insert_outlet_id)
                    ->where('is_active', 1)
                    ->get();

                //dd(1);
            }

            //dd(2);


            if($check_outlet->isNotEmpty())
            {

                for($k=1; $k < $no_of_days + 1; ++$k) {
                    
                   //dd($customerArr[0][$i]['year']);

                   $year = "".$customerArr[0][$i]['year']."";

                   $day = "".$customerArr[0][$i]['day']."";

                   $day = substr($day, 0, 3);
                   //dd($day);

                     
                     if(\Carbon\Carbon::createFromDate($year, $nmonth, $k)->format('D') == $day )
                     {
                        
                       //dd(\Carbon\Carbon::createFromDate($year, $nmonth, $k)->format('D'));


                        $dates = \Carbon\Carbon::createFromDate($year, $nmonth, $k)->format('Y-m-d');

                         $outlets = array(
                            'employee_id' => $emp_id_arr[1], 
                            'date' => $dates,
                            'outlet_id' => $check_outlet[0]->outlet_id,
                            'scheduled_calls' => '1',
                            'is_active' => '1',
                            'is_defined' => '1',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                            'created_by' => Auth::user()->emp_id,
                        );

                         $check = DB::table('merchant_time_sheet')
                            ->where('employee_id', $emp_id_arr[1])
                            ->where('date', $dates)
                            ->where('outlet_id', $check_outlet[0]->outlet_id)
                            ->where('is_defined', 1)
                            ->where('is_active', 1)
                            ->get();

                        //dd($check);
                      
                        if ($check->isEmpty()) {

                            //dd($days[$i]);

                            DB::table('merchant_time_sheet')->insert($outlets);

                        }

                    }

                }
            }
            }

             }

        $audit = new audit_store();
        $description = 'scheduled timesheet csv/excel file imported';
        $add_audit =  $audit->store($description,'journey_plan'); 

        return redirect()->route('schedule-outlets.index')->withStatus(__('Timesheet imported successfully..'));

    }

}
