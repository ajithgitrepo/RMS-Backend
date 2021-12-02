<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Crypt;
use App\Outlet;


class ClientOutletReportController extends Controller
{

    public function index(Request $request)
    {

        $matchThese = ['merchant_time_sheet.is_active' => '1', 
            'outlet_products_mapping.is_active' => '1',
            //'merchant_time_sheet.is_completed' => '1'
            ];
            
            $result = DB::table('outlet_products_mapping')
            ->select('store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.*',
            'merchant_time_sheet.id as merch_id','outlet_products_mapping.id as opm_id','employee.first_name','employee.middle_name','employee.surname')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
          //  ->leftJoin('brand_details', 'brand_details.id', '=', 'outlet_products_mapping.brand_id')
          //  ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
            ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

            ->where('outlet_products_mapping.client_id', Auth::user()->emp_id)
            ->groupBy('merchant_time_sheet.id')
            ->where($matchThese)
            ->whereMonth('merchant_time_sheet.date', Carbon::now()->month)
            ->orderBy('merchant_time_sheet.date','asc')
            ->paginate(10);

            //dd($result);

             $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->where('outlet_products_mapping.client_id', Auth::user()->emp_id)
            ->groupBy('outlet.outlet_id')
            ->get();

             $merchandisers = DB::table('employee')
            ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
            ->get();  

        return view('client_outlet_report.index',['result' => $result,'merchandisers' => $merchandisers,'out'=>$out, 'startdate' => '', 'enddate' =>'', 'employee_id' => '', 'filter_outlet'=>'', 'status'=>'']);

    }  

    public function client_outlet_report(Request $request)
    {

        $outlets = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->where('outlet_products_mapping.client_id', Auth::user()->emp_id)
            ->groupBy('outlet.outlet_id')
            ->get();

       // dd($outlets);

        return view('client_outlet_report.report.index',['outlets'=>$outlets]);

    }

    public function get_client_report(Request $request)
    {
        //dd($request->all());
        $outlet_id = $request->outlet_id;
        $start_date = $request->from_date;
        $end_date = $request->to_date;

        if($outlet_id)
        {
              $matchThese = ['merchant_time_sheet.is_active' => '1', 
                'outlet_products_mapping.is_active' => '1',
                'merchant_time_sheet.is_completed' => '1',
                'merchant_time_sheet.outlet_id' => $outlet_id
             ];  
        }

        if(!$outlet_id)
        {
              $matchThese = ['merchant_time_sheet.is_active' => '1', 
                'outlet_products_mapping.is_active' => '1',
                'merchant_time_sheet.is_completed' => '1',
                //'merchant_time_sheet.outlet_id' => $outlet_id
             ];  
        }
        

            if($request->activity == "Availabity")
            {
                 $result = DB::table('outlet_products_mapping')
                    ->select('outlet.outlet_id','store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.*','brand_client.brand_name','product_details.product_name','category_details.category_name','outlet_products_mapping.client_id as c_id','employee.first_name','employee.middle_name','employee.surname','availability.id as a_id','availability.is_available','availability.reason')

                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

                    ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

                    ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
                  
                    ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')

                    ->Join('availability', function ($join) {
                        $join->on('availability.product_id', '=', 'product_details.id')
                            ->on('availability.timesheet_id', '=', 'merchant_time_sheet.id');
                    });

                    $result =  $result->where('outlet_products_mapping.client_id', Auth::user()->emp_id);
                    $result =  $result->groupBy('availability.id');
                    $result =  $result->where($matchThese);

                    if(!empty($start_date) && !empty($end_date))
                    {
                      // dd($start_date);

                        $startdate = date('Y-m-d', strtotime($start_date));
                        $enddate = date('Y-m-d', strtotime($end_date));

                        $result->whereBetween('availability.date', [$startdate, $enddate]);

                    }

                    $result =  $result->orderBy('merchant_time_sheet.created_at','DESC');
                    $query =  $result->get();

                    //dd($query);

                    return response()->json($query);
            }
            

            if($request->activity == "Visibility")
            {
                $result = DB::table('outlet_products_mapping')
                    ->select('outlet.outlet_id','store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.*','brand_client.brand_name','product_details.product_name','category_details.category_name','outlet_products_mapping.client_id as c_id','employee.first_name','employee.middle_name','employee.surname','visibility.g_area','visibility.main_aisle','visibility.pois','visibility.is_available','visibility.image_url','visibility.reason','visibility.id as v_id')

                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

                    ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

                    ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
                  
                    ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')

                    ->Join('visibility', function ($join) {
                        $join->on('visibility.category_id', '=', 'category_details.id')
                            ->on('visibility.timesheet_id', '=', 'merchant_time_sheet.id');
                    });

                    $result =  $result->where('outlet_products_mapping.client_id', Auth::user()->emp_id);
                    $result =  $result->groupBy('visibility.id');
                    $result =  $result->where($matchThese);

                    if(!empty($start_date) && !empty($end_date))
                    {
                      // dd($start_date);

                        $startdate = date('Y-m-d', strtotime($start_date));
                        $enddate = date('Y-m-d', strtotime($end_date));

                        $result->whereBetween('visibility.date', [$startdate, $enddate]);

                    }

                    $result =  $result->orderBy('merchant_time_sheet.created_at','DESC');
                    $query =  $result->get();

                    //dd($query);

                    return response()->json($query);
            }
           

            if($request->activity == "Share_Of_Shelf")
            {
                 $result = DB::table('outlet_products_mapping')
                    ->select('outlet.outlet_id','store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.*','category_details.category_name','outlet_products_mapping.client_id as c_id','employee.first_name','employee.middle_name','employee.surname','shareof_shelf.id as s_id','shareof_shelf.total_share','shareof_shelf.share','shareof_shelf.target','shareof_shelf.actual','shareof_shelf.reason')

                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

                    ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

                    //->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
                  
                    ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')

                    ->Join('shareof_shelf', function ($join) {
                        $join->on('shareof_shelf.category_id', '=', 'category_details.id')
                            ->on('shareof_shelf.timesheet_id', '=', 'merchant_time_sheet.id');
                    });

                    $result =  $result->where('outlet_products_mapping.client_id', Auth::user()->emp_id);
                    $result =  $result->groupBy('shareof_shelf.id');
                    $result =  $result->where($matchThese);

                    if(!empty($start_date) && !empty($end_date))
                    {
                      // dd($start_date);

                        $startdate = date('Y-m-d', strtotime($start_date));
                        $enddate = date('Y-m-d', strtotime($end_date));

                        $result->whereBetween('shareof_shelf.date', [$startdate, $enddate]);

                    }

                    $result =  $result->orderBy('merchant_time_sheet.created_at','DESC');
                    $query =  $result->get();

                    //dd($query);

                    return response()->json($query);
            }

            if($request->activity == "Planogram")
            {
                 $result = DB::table('outlet_products_mapping')
                    ->select('outlet.outlet_id','store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.*','category_details.category_name','outlet_products_mapping.client_id as c_id','employee.first_name','employee.middle_name','employee.surname','planogram_checks.id as p_id','planogram_checks.before_image','planogram_checks.after_image')

                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

                    ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

                    //->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
                  
                    ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')

                    ->Join('planogram_checks', function ($join) {
                        $join->on('planogram_checks.category_id', '=', 'category_details.id')
                            ->on('planogram_checks.timesheet_id', '=', 'merchant_time_sheet.id');
                    });

                    $result =  $result->where('outlet_products_mapping.client_id', Auth::user()->emp_id);
                    $result =  $result->groupBy('planogram_checks.id');
                    $result =  $result->where($matchThese);

                    if(!empty($start_date) && !empty($end_date))
                    {
                      // dd($start_date);

                        $startdate = date('Y-m-d', strtotime($start_date));
                        $enddate = date('Y-m-d', strtotime($end_date));

                        $result->whereBetween('planogram_checks.date', [$startdate, $enddate]);

                    }

                    $result =  $result->orderBy('merchant_time_sheet.created_at','DESC');
                    $query =  $result->get();

                    //dd($query);

                    return response()->json($query);
            }

            if($request->activity == "Promotion_Check")
            {
                 $result = DB::table('outlet_products_mapping')
                    ->select('outlet.outlet_id','store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.*','category_details.category_name','outlet_products_mapping.client_id as c_id','employee.first_name','employee.middle_name','employee.surname','promotion_check.id as p_id','promotion_check.is_available','promotion_check.image_url','promotion_check.reason')

                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

                    ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

                    ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
                  
                    ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')

                    ->Join('promotion_check', function ($join) {
                        $join->on('promotion_check.product_id', '=', 'product_details.id')
                            ->on('promotion_check.timesheet_id', '=', 'merchant_time_sheet.id');
                    });

                    $result =  $result->where('outlet_products_mapping.client_id', Auth::user()->emp_id);
                    $result =  $result->groupBy('promotion_check.id');
                    $result =  $result->where($matchThese);

                    if(!empty($start_date) && !empty($end_date))
                    {
                      // dd($start_date);

                        $startdate = date('Y-m-d', strtotime($start_date));
                        $enddate = date('Y-m-d', strtotime($end_date));

                        $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);

                    }

                    $result =  $result->orderBy('merchant_time_sheet.created_at','DESC');
                    $query =  $result->get();

                    //dd($query);

                    return response()->json($query);
            }

            if($request->activity == "Competitor_Info")
            {
                 $result = DB::table('outlet_products_mapping')
                    ->select('outlet.outlet_id','store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.*','outlet_products_mapping.client_id as c_id','employee.first_name','employee.middle_name','employee.surname','competitor.id as comp_id','competitor.company_name','competitor.brand_name','competitor.category_name','competitor.item_name','competitor.promotion_type','competitor.promotion_description','competitor.mrp','competitor.selling_price','competitor.capture_image')

                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

                    //->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

                    //->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
                  
                    //->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')

                    ->Join('competitor', function ($join) {
                        $join->on('competitor.timesheet_id', '=', 'merchant_time_sheet.id');
                           
                    });

                    $result =  $result->where('outlet_products_mapping.client_id', Auth::user()->emp_id);
                    $result =  $result->groupBy('competitor.id');
                    $result =  $result->where($matchThese);

                    if(!empty($start_date) && !empty($end_date))
                    {
                      // dd($start_date);

                        $startdate = date('Y-m-d', strtotime($start_date));
                        $enddate = date('Y-m-d', strtotime($end_date));

                        $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);

                    }

                    $result =  $result->orderBy('merchant_time_sheet.created_at','DESC');
                    $query =  $result->get();

                    //dd($query);

                    return response()->json($query);
            }
           
             if($request->activity == "Stock_Report")
            {
                 $result = DB::table('outlet_products_mapping')
                    ->select('outlet.outlet_id','store_details.store_name','store_details.store_code','store_details.address','merchant_time_sheet.id as t_id','outlet_products_mapping.client_id as c_id','employee.first_name','employee.middle_name','employee.surname','product_details.product_name','brand_client.brand_name','outlet_stockexpiry.*')

                    ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
                    ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
                    ->leftJoin('merchant_time_sheet', 'merchant_time_sheet.outlet_id', '=', 'outlet.outlet_id')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')

                    ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

                    ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
                  
                    ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')

                    ->Join('outlet_stockexpiry', function ($join) {
                        $join->on('outlet_stockexpiry.product_id', '=', 'product_details.id')
                            ->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
                    });

                    $result =  $result->where('outlet_products_mapping.client_id', Auth::user()->emp_id);
                    $result =  $result->groupBy('outlet_stockexpiry.id');
                    $result =  $result->where($matchThese);

                    if(!empty($start_date) && !empty($end_date))
                    {
                      // dd($start_date);

                        $startdate = date('Y-m-d', strtotime($start_date));
                        $enddate = date('Y-m-d', strtotime($end_date));

                        $result->whereBetween('outlet_stockexpiry.date', [$startdate, $enddate]);

                    }

                    $result =  $result->orderBy('merchant_time_sheet.created_at','DESC');
                    $query =  $result->get();

                    //dd($query);

                    return response()->json($query);
            }


    }

    public function trade_stock_report(Request $request)
    {
        
        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        //$dateE = Carbon::now()->startOfMonth(); 
        $dateE = new Carbon('last day of last month');
        //dd($dateE);

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        $result = DB::table('merchant_time_sheet')
            ->select(DB::raw('sum(near_expiry) as sum'),'outlet_stockexpiry.expiry_date','outlet_stockexpiry.product_id','outlet_stockexpiry.zrep','outlet_stockexpiry.bar_code','outlet_stockexpiry.description')

            // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

            // ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
            // ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
            
            ->leftJoin('outlet_stockexpiry', function ($join) {
                    $join->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
            })

            ->where('outlet_stockexpiry.is_active', 1)
            //->where('outlet_stockexpiry.product_id', 1)
            ->where('outlet_stockexpiry.client_id', Auth::user()->emp_id)
            ->where($matchThese)
            //->where('outlet_stockexpiry.expiry_date', ">", Carbon::now()->subMonths(3))
            ->whereBetween('outlet_stockexpiry.expiry_date',[$dateS,$dateE])
            ->groupBy('outlet_stockexpiry.product_id')
            ->groupByRaw('MONTH(expiry_date)')
            ->get();


         // $result= DB::table("outlet_stockexpiry")
         //    ->select(DB::raw('sum(near_expiry) as sum'),'outlet_stockexpiry.expiry_date','outlet_stockexpiry.product_id')
         //    ->whereBetween('outlet_stockexpiry.expiry_date',[$dateS,$dateE])
         //    ->groupBy('outlet_stockexpiry.product_id')
         //    ->groupBy(DB::raw('MONTH(expiry_date)'))
         //    ->get();


        //dd($result);


       return view('client_outlet_report.trade_report.index', ['result' => $result, 'month' => '', 'zrep_code' =>'', 'bar_code' => '']);


    }


    public function filter_trade_report(Request $request)
    {

        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        //$dateE = Carbon::now()->startOfMonth(); 
        $dateE = new Carbon('last day of last month');
        //dd($dateE);

        $months = $request->month;
        $zrep_code = $request->zrep_code;
        $bar_code = $request->bar_code;

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        $result = DB::table('merchant_time_sheet')
            ->select(DB::raw('sum(near_expiry) as sum'),'outlet_stockexpiry.expiry_date','outlet_stockexpiry.product_id','outlet_stockexpiry.zrep','outlet_stockexpiry.bar_code','outlet_stockexpiry.description')

            // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

            // ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
            // ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
            
            ->leftJoin('outlet_stockexpiry', function ($join) {
                    $join->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
            })

            ->where('outlet_stockexpiry.is_active', 1)
            //->where('outlet_stockexpiry.product_id', 1)
            ->where('outlet_stockexpiry.client_id', Auth::user()->emp_id)
            ->where($matchThese)
            //->where('outlet_stockexpiry.expiry_date', ">", Carbon::now()->subMonths(3))
            //->whereBetween('outlet_stockexpiry.expiry_date',[$dateS,$dateE])
            //->whereIn('outlet_stockexpiry.expiry_date', array($months))
            ->groupBy('outlet_stockexpiry.product_id')
            ->groupByRaw('MONTH(expiry_date)');


            if(!empty($months))
            {
                $result->whereMonth('expiry_date', $months);
            }

            if(!empty($zrep_code))
            {
                $result->where('zrep', $zrep_code);
            }

            if(!empty($bar_code))
            {
                $result->where('bar_code', $bar_code);
            }


            $query = $result->get();

            //dd($query);

             return view('client_outlet_report.trade_report.index', ['result' => $query, 'month' => '', 'zrep_code' =>'', 'bar_code' => '']);

    }
    
}
