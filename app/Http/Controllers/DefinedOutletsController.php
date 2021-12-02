<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
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

use \Datetime;

use Illuminate\Support\Facades\Auth;

class DefinedOutletsController extends Controller
{
    public function index(merchant_timesheet $model)
    {

        $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->groupBy('outlet.outlet_id')
            ->get();


        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '1', 'store_details.is_active' => '1', 'outlet.is_active' => '1'];
        $value = 'someName';
          

        if(Auth::user()->role->name =="CDE")
        {

            $result = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','employee.first_name','employee.middle_name','employee.surname')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')
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

            //dd($result);

            return view('day_journeyplan.index', ['outlets' => $result, 'merchandisers' => $merchandisers,'out'=>$out, 'startdate' => '', 'enddate' =>'', 'employee_id' => '', 'filter_outlet'=>'', 'status'=>'']);
    
        }


       
        $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_code','store_details.store_name','store_details.address','employee.first_name','employee.middle_name','employee.surname')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')
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

       

        return view('day_journeyplan.index', ['outlets' => $result, 'merchandisers' => $merchandisers,'out'=>$out, 'startdate' => '', 'enddate' =>'', 'employee_id' => '', 'filter_outlet'=>'', 'status'=>'']);
    
    }

    public function create()
    {

        $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();

        // $outlets = DB::table('outlet')
        //     ->where('is_active', 1)
        //     ->where('is_assigned', 0)
        //     ->get();

         $outlets = Outlet::with('store')
            ->where('is_active', 1)
            ->where('is_assigned', 0)
            ->get();

        //dd($outlets);   

        return view('day_journeyplan.create', ['merchandisers' => $merchandisers, 'outlets' => $outlets]);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'merchandiser' => 'required|max:255',
            'days' => 'required|max:255',
            'outlets' => 'required|max:255',

        ]);

        //dd($request->year);

        $days = $request->days;
        //dd($days);
        //$new_date = date("Y-m-d", strtotime($date));  

        $i = 0;
        $j = 0;

            $today = today(); 
            $dates = array(); 

            $nmonth = date("m", strtotime($request->month));

            $no_of_days=cal_days_in_month(CAL_GREGORIAN,$nmonth,$request->year);

            //dd($today->month);

            // for($i=1; $i < $no_of_days + 1; ++$i) {
            //    // dd(\Carbon\Carbon::createFromDate($request->year, $nmonth, $i)->format('D'));
            //     if(\Carbon\Carbon::createFromDate($request->year, $nmonth, $i)->format('D') == 'Tue')
            //     {
            //         $dates[] = \Carbon\Carbon::createFromDate($request->year, $nmonth, $i)->format('Y-m-d');
            //     }
                
            // }

           
            //dd($dates);

        
        for($i=0;$i<count($request->days);$i++)
        {
            for($j=0;$j<count($request->outlets);$j++)
            {
                //dd($request->outlets[$i]);
               // dd($request->days[$i]);

                 for($k=1; $k < $no_of_days + 1; ++$k) {
                    //dd($request->days[$i]);
                     
                     if(\Carbon\Carbon::createFromDate($request->year, $nmonth, $k)->format('D') == $request->days[$i] )
                     {
                        
                       //dd(\Carbon\Carbon::createFromDate($request->year, $nmonth, $k)->format('D'));


                        $dates = \Carbon\Carbon::createFromDate($request->year, $nmonth, $k)->format('Y-m-d');

                       // dd($dates);

                        $outlets = array(
                            'employee_id' => $request->merchandiser, 
                            'date' => $dates,
                            'outlet_id' => $request->outlets[$j],
                            'scheduled_calls' => '1',
                            'is_active' => '1',
                            'is_defined' => '1',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                            'created_by' => Auth::user()->emp_id
                        );

                         $check = DB::table('merchant_time_sheet')
                        ->where('employee_id', $request->merchandiser)
                        ->where('date', $dates)
                        ->where('outlet_id', $request->outlets[$j])
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

        return redirect()->route('defined-outlets.index')->withStatus(__('Outlet Assigned successfully..'));
    }


    public function filter_defined_journey(Request $request)
    {  
        //dd($request->all());
        
        $start_date = $request->startdate;
        $end_date = $request->enddate;

        $employee_id = $request->employee_id;
        $Status = $request->status;
       // dd($request->employee_id);
       
       // $matchThese = ['is_active' => '1', 'is_defined' => '1'];

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '1', 'store_details.is_active' => '1', 'outlet.is_active' => '1'];

        if(Auth::user()->role->name =="Field Manager")
        {
        
        $result = merchant_timesheet::where($matchThese)->with('outlet')->with('employee')
            ->select('merchant_time_sheet.*','store_details.store_name','employee.first_name','employee.middle_name','employee.surname')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')
            ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
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
            $result = DB::table('merchant_time_sheet')
                ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','employee.first_name','employee.middle_name','employee.surname')
                ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')
                ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                //->whereMonth('date', Carbon::now()->month)
                ->where($matchThese)
                ->orderBy('date');

            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->get();

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
        else
        {
            $result->whereMonth('date', Carbon::now()->month);
        }

        if(!empty($request->outlet_id))
        {

            $result->where('merchant_time_sheet.outlet_id' , $request->outlet_id);
        }
        //dd($request->outlet_id);

         if($Status  !== "")
         {
           if($Status  == "1")
           $result->where('merchant_time_sheet.is_completed',1 );

           if($Status  == "0")
           $result->where('merchant_time_sheet.is_completed',0);
    
        }
      
         $result->orderBy('date');
         $query = $result->paginate(10);
         $query->appends(['employee_id' => $request->employee_id,'outlet_id' => $request->outlet_id,'startdate' => $request->startdate, 'enddate' => $request->enddate, 'status' => $request->status]);
       
        //dd($query);

         $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->groupBy('outlet.outlet_id')
            ->get();

         
       
        return view('day_journeyplan.index', [ 'outlets' => $query, 'merchandisers' => $merchandisers, 
            'startdate' => $request->startdate, 'enddate' =>$request->enddate, 'employee_id' => $employee_id,'out' => $out, 'filter_outlet'=>$request->outlet_id, 'status'=>$Status ]);
     
    }

    public function get_weekoff_days(Request $request)
    {  
        //dd($request->all());

        //$string = implode(",",$request->month);


        // $query = 'SELECT * FROM weekoff WHERE employee_id = "'.$request->emp_id.'" AND ( '; // construct query

        // foreach ($request->month as $search)
        // {
        //     $query .= "FIND_IN_SET('".$search."', month) OR "; // append every time for set 
        // }        

        // $query1 = rtrim($query, ' OR'); // remove last OR

        // $query1 .= ' ) ';

        // $result = DB::select($query1); 

        // $result = DB::table('weekoff')
        // ->where('employee_id', $request->emp_id)
        // ->whereIn('month', $string)->get();

        $result =  DB::select(' SELECT * FROM weekoff WHERE employee_id = "'.$request->emp_id.'" AND month ="'.$request->month.'" AND year ="'.$request->year.'" AND is_active = 1 ');


        //dd($result);

       return response()->json($result);

    }

    public function view_activity(Request $request)
    {
        //dd($request->id);

        $matchThese = ['merchant_time_sheet.is_active' => '1'];
       
       //  $result = DB::table('merchant_time_sheet')
       //  ->select('product_details.id as product_id','product_details.product_name','merchant_time_sheet.*','availability.is_available','availability.reason')
       //  ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
       //  ->leftJoin('product_details', 'product_details.id', '=', 'outlet_products_mapping.brand_id')
       //  ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
       //  ->leftJoin('availability', 'availability.product_id', '=', 'product_details.id')
       //  ->where('merchant_time_sheet.id', $request->id)
       //  ->where('availability.timesheet_id', $request->id)
       //  ->where('product_details.is_active', 1)
       //  ->where($matchThese)
       // // ->groupBy('product_details.id')
       //  ->get();

        $check_in = DB::table('merchant_time_sheet')
        ->select('merchant_time_sheet.date','merchant_time_sheet.checkin_time','merchant_time_sheet.checkout_time')
        ->where('merchant_time_sheet.id', $request->id)
        ->where($matchThese)
        ->get();

        $break_time = DB::table('outlet_journey_time')
        ->where('timesheet_id', $request->id)
        ->where('is_active',1)
        ->get();

        //dd($break_time);

        $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name','merchant_time_sheet.*','brand_details.brand_name','category_details.category_name','availability.is_available','availability.reason','availability.created_at')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
        ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
        ->leftJoin('availability', 'availability.product_id', '=', 'product_details.id')
        ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        ->where('merchant_time_sheet.id', $request->id)
        ->where('availability.timesheet_id', $request->id)
        ->where('product_details.is_active', 1)
        ->where($matchThese)
        ->groupBy('product_details.id')
        ->get();

        //dd($result);

        $result1 = DB::table('merchant_time_sheet')
        ->select('shareof_shelf.total_share','shareof_shelf.share','shareof_shelf.target','shareof_shelf.actual','merchant_time_sheet.*','brand_details.brand_name','category_details.category_name')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id','shareof_shelf.created_at')
        ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
        ->leftJoin('shareof_shelf', 'shareof_shelf.category_id', '=', 'category_details.id')
        ->where('merchant_time_sheet.id', $request->id)
        ->where('shareof_shelf.timesheet_id', $request->id)
        ->where($matchThese)
        ->groupBy('category_details.category_name')
        ->get();

        //dd($result1);


        $result2 = DB::table('merchant_time_sheet')
        ->select('merchant_time_sheet.*','visibility.brand_name','visibility.category_name','visibility.product_name','visibility.is_available','visibility.image_url','visibility.reason','category_details.category_name','visibility.created_at')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
        ->leftJoin('visibility', 'visibility.category_id', '=', 'category_details.id')
        ->where('merchant_time_sheet.id', $request->id)
        ->where('visibility.timesheet_id', $request->id)
        ->where($matchThese)
        ->groupBy('category_details.category_name')
        ->get();

        //dd($request->id);

        $result3 = DB::table('merchant_time_sheet')
        ->select('merchant_time_sheet.*','product_details.id as product_id','product_details.product_name','promotion_check.is_available','promotion_check.image_url','promotion_check.reason','promotion_check.created_at')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
        ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
        ->leftJoin('promotion_check', 'promotion_check.product_id', '=', 'product_details.id')
        ->where('merchant_time_sheet.id', $request->id)
        ->where('promotion_check.timesheet_id', $request->id)
        ->where($matchThese)
        ->groupBy('product_details.id')
        ->get();

        //dd($result3);


         $result4 = DB::table('merchant_time_sheet')
        ->select('merchant_time_sheet.*','planogram_checks.brand_name','planogram_checks.default_image','planogram_checks.before_image','planogram_checks.after_image','category_details.category_name','planogram_checks.created_at')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
        ->leftJoin('planogram_checks', 'planogram_checks.category_id', '=', 'category_details.id')
        ->where('merchant_time_sheet.id', $request->id)
        ->where('planogram_checks.timesheet_id', $request->id)
        ->where($matchThese)
        ->groupBy('category_details.category_name')
        ->get();

        $result5 = DB::table('merchant_time_sheet')
        ->select('competitor.*','competitor.company_name','competitor.brand_name','competitor.item_name','competitor.promotion_type','competitor.mrp','competitor.selling_price','competitor.capture_image','competitor.created_at')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('competitor', 'competitor.timesheet_id', '=', 'merchant_time_sheet.id')
        ->where('merchant_time_sheet.id', $request->id)
        ->whereNotNull('competitor.id')
        ->where($matchThese)
        ->groupBy('competitor.id')
        ->get();

      
        //dd($result5);

        return response()->json(['check_in' => $check_in, 'break_time' => $break_time, 'availability'=>$result,'shareof_shelf'=>$result1,'visibility' => $result2,'promotion_check' => $result3, 'planogram_checks'=>$result4,'competition_info'=>$result5]);

    }

}
