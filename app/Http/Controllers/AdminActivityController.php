<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\merchant_timesheet;
use App\Outlet;
use App\Store_details;

use Illuminate\Support\Facades\Auth;

use App\Imports\TimesheetImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Employee_Reporting_To;
use App\Brand_details;
use App\Category_details;
use App\Product_details;
use App\Http\Controllers\AuditController as audit_store;


class AdminActivityController extends Controller
{
    public function admin_store(Outlet $model)
    {       
        
     $model= DB::table('store_details')
     ->where('is_active',1)
     //->where('created_by',Auth::user()->emp_id)
     ->orderby('created_at','DESC')
     ->paginate(10);

     return view('store_details.index', ['store' => $model]);
    
    }

    public function admin_brand(Brand_details $model)
    {       
     

        $matchThese = ['is_active' => '1'];
        $model = Brand_details::where($matchThese)
        ->with('employee_client')
        ->with('employee_field')
        ->with('employee_sales')
        ->get();
     
        return view('brand_details.index',['branddetails' => $model]);
    }

    public function admin_category(Category_details $model)
    {       
        
  
        $matchThese = ['is_active' => '1'];

        $model = Category_details::where($matchThese)->get();
        
        //dd($model);
    
        return view('category_details.index',['category' => $model]);
    }

    public function admin_products(Product_details $model)
    {       
        
     //  $model     = DB::table('product_details')->where('is_active',1)->get();
       $matchThese = ['is_active' => '1'];
       
       $model = Product_details::where($matchThese)->with('category')->with('brand')->get();
        
    
        $brand = DB::table('brand_details')->where('is_active',1)->get();
   
        $category = DB::table('category_details')->where('is_active',1)->get();

      return view('product_details.index',['product' => $model,'brands' => $brand,'category'=>$category]);
     
     
    }

    public function admin_outlets(Outlet $model)
    {       
        
     //dd(Auth::user()->role->name);

     $matchThese = ['is_active' => '1'];
     $model = Outlet::where($matchThese)->with('store','outlet_product')->orderby('created_at','DESC')->paginate(10);
     //dd($model);
  
     $store_details  = DB::table('store_details')
     ->where('is_active',1)
     //->where('created_by',Auth::user()->emp_id)
     ->get();
     
     return view('outlet.index', ['outlet' => $model,'store'=> $store_details]);
    
    }

    public function present_field()
    {
        $present_field_managers = DB::table('attendance')
            ->select('employee.first_name','employee.surname','employee.employee_id','attendance.checkin_time','attendance.date')
            ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
            ->whereDate('attendance.date', Carbon::today())
            ->where('employee.designation', '5')
            ->where('is_present', '1')
            ->get(); 

        //dd($present_field_managers);

        return view('admin_dashboard.present_field', ['result' => $present_field_managers]);
    }

    public function present_merchant()
    {
        $present_merchandisers = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','employee.first_name','employee.surname','employee.employee_id','store_details.store_code','store_details.store_name','store_details.address','outlet.outlet_city')
            ->leftJoin('employee', 'merchant_time_sheet.employee_id', '=', 'employee.employee_id')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->whereDate('merchant_time_sheet.date', Carbon::today())
            ->where('employee.designation', '6')
            ->whereNotNull('merchant_time_sheet.checkin_time')
            ->where('merchant_time_sheet.is_completed', '0')
            ->where('merchant_time_sheet.is_active', '1')
            ->get();    

        //dd($present_merchandisers);

        return view('admin_dashboard.present_merchant', ['result' => $present_merchandisers]);
    }

    public function absent_merchant()
    {
        $date = Carbon::today();

        $absent_merchandiesers = DB::table('attendance')
            ->select('attendance.id','employee.first_name','employee.surname','employee.employee_id','leaverequest.reason','attendance.date')
            ->leftJoin('employee', 'attendance.employee_id', '=', 'employee.employee_id')
            ->leftJoin('leaverequest', 'leaverequest.employee_id', '=', 'attendance.employee_id')
            // ->leftJoin('employee_reporting_to', 'employee_reporting_to.reporting_to_emp_id', '=', 'employee.employee_id')
            // ->leftJoin('employee as field', 'field.employee_id', '=', 'employee_reporting_to.employee_id')
            ->whereDate('attendance.date', Carbon::today())
            ->where('employee.designation', '6')
            ->where('is_leave', '1')
            ->where('is_leave_approved', '1')
            ->where('leaverequest.is_approved', '2')
            ->whereDate('leaverequest.leavestartdate', '<=', $date)
            ->whereDate('leaverequest.leaveenddate', '>=', $date)
            //->groupBy('attendance.date')
            //->groupBy('attendance.employee_id')
            ->get(); 

            //  dd($absent_merchandiesers);

            return view('admin_dashboard.absent_mercahndiser', ['result' => $absent_merchandiesers]);
    }

    public function total_timesheets()
    {

       
        $matchThese = ['merchant_time_sheet.is_active' => '1'];
        $value = 'someName';
        $total_outlets = merchant_timesheet::with(['outlet','employee','employee_field'])

        ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->where($matchThese)   
        ->orderBy('date')
        ->paginate(10);

        $merchandisers = DB::table('employee')
        ->where('employee.is_active', 1)
        ->where('designation', 6)
        ->get();



        //dd($total_outlets);
        return view('admin_dashboard.total_timesheet', ['timesheets' => $total_outlets, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '']);
    }
    

    public function filter_total_timesheet(Request $request)
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

       
       
        if(!empty($employee_id))
        {
          // dd($start_date);

           
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

        
         $query = $result->paginate(10);
         $query->appends(['employee_id' => $request->employee_id,'status' => $request->status,'startdate' => $request->startdate, 'enddate' => $request->enddate]);
     
        //dd($query);

       
          $merchandisers = DB::table('employee')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->get();

        return view('admin_dashboard.total_timesheet', [ 'timesheets' => $query, 'merchandisers' => $merchandisers, 
            'startdate' => $request->startdate, 'enddate' =>$request->enddate, 'employee_id' => $employee_id ]);

       
     
    }


    public function today_timesheet(Request $request)
    { 

            $matchThese = ['merchant_time_sheet.is_active' => '1'];
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
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->get();
       
            return view('admin_dashboard.today_timesheet', ['outlets' => $result, 'merchandisers' => $merchandisers, 'startdate' => '', 'enddate' =>'', 'employee_id' => '','status'   => '' ]);
    }

    public function filter_today_timesheet(Request $request)
    {  
        //dd($request->employee_id);
        //return $request->id;

       
        $start_date = $request->startdate;
        $end_date = $request->enddate;

        $employee_id = $request->employee_id;
        $status = $request->status;

        //dd($start_date);
       
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
            ->whereDate('date', '=', date('Y-m-d'))
            ->orderBy('date');
            
        }

       
       
        if(!empty($employee_id))
        {
          // dd($start_date);

           
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

        
         $query = $result->get(10);
         //$query->appends(['employee_id' => $request->employee_id,'status' => $request->status,'startdate' => $request->startdate, 'enddate' => $request->enddate]);
     
        //dd($query);

       
          $merchandisers = DB::table('employee')
            ->where('employee.is_active', 1)
            ->where('designation', 6)
            ->get();

         return view('admin_dashboard.today_timesheet', ['outlets' => $query, 'merchandisers' => $merchandisers, 'startdate' => $request->startdate, 'enddate' =>$request->enddate, 'employee_id'   => $request->employee_id, 'status'   => $request->status ]);

       
     
    }




}


