<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\weekoff;
use App\Employee_Reporting_To;


use DateTime;
use DatePeriod;
use DateInterval;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiOutletStockExpiryController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
     
    public $success_status = 200;

    public function stock_expiry_details(Request $request)
    {
        $user  =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');

         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg(); 
        $matchThese = ['is_active' => '1'];

        // $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
        // ->where($matchThese)->with([
		// 	'employee_reporting_to'  => function($query) {
		// 		$query->select(['employee_id','first_name', 'middle_name','surname']);
		// 	}
		//  ])->pluck('employee_id');

      
        $result = DB::table('stock_expiry');
        // ->where($matchThese)
        // ->whereIn('employee.employee_id',$Merchresult);
      //  if($request->emp_id != "")
      //  $result = $result->where('employee_id', $request->emp_id);;
        $result = $result->get();
        return $printReport->send_result_msg($this->success_status, $result);

    } 
    
    public function stock_expiry_details_new(Request $request)
    {
        $user  =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');

         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg(); 

        // $validator = Validator::make($request->all(), [
	    //     'time_sheet_id' => 'required',
	    //     ]);
		// 	if ($validator->fails())
		// 	{ 
		// 	   return response(['errors'=>$validator->errors()->all()], 422);  
		// 	}

       // $matchThese = ['is_active' => '1'];

        $matchThese = ['merchant_time_sheet.is_active' => '1'];
        
        $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name','outlet_stockexpiry.*','brand_details.brand_name')
        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
        ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
     
         ->leftJoin('outlet_stockexpiry', function ($join) {
                $join->on('outlet_stockexpiry.product_id', '=', 'product_details.id')
                    ->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
            })

        ->where('outlet_stockexpiry.is_active', 1)
     //   ->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
        ->where($matchThese)
        ->get();

       // $result = $result->get();
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function stock_product_details(Request $request)
    {
        $user  =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');

         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
        $matchThese = ['is_active' => '1'];

        // $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
        // ->where($matchThese)->with([
		// 	'employee_reporting_to'  => function($query) {
		// 		$query->select(['employee_id','first_name', 'middle_name','surname']);
		// 	}
		//  ])->pluck('employee_id');

        $result = DB::table('product');
        // ->where($matchThese)
        // ->whereIn('employee.employee_id',$Merchresult);
      //  if($request->emp_id != "")
      //  $result = $result->where('employee_id', $request->emp_id);;
        $result = $result->get();
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function stock_product_details_new(Request $request)
    {
        $user  =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');

         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
        $matchThese = ['is_active' => '1'];

        $result = DB::table('product_details')->where('is_active',1)->get();
        
        return $printReport->send_result_msg($this->success_status, $result);

    } 


    public function add_stock_expiry(Request $request, weekoff $model)
    {
        
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
         
        if($chk == false)
        return $printReport->auth_error_msg();
     
         /*  // validation 
            $validator      =   Validator::make($request->all(), [
             'emp_id' => 'required|max:255',
             'month' => 'required|max:255',
             'day' => 'required|max:255',
             'year' => 'required|max:255',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }   */

      //  $date = $request->date;
        //dd($joining_date);
        $bs_expiry_date = date("Y-m-d", strtotime($request->pc_expiry_date));  
        $cs_expiry_date = date("Y-m-d", strtotime($request->pc_expiry_date));  
        $pc_expiry_date = date("Y-m-d", strtotime($request->pc_expiry_date));  

        $firstdate = date('Y').'-01-01';
        $lastdate = date('Y').'-12-31';
    
        //echo $lastdate;
    
        $array = array();
        $day_period = 0;
        // Variable that store the date interval of period 28 day
        $interval = new DateInterval('P28D');
    
        $realEnd = new DateTime($lastdate);
        $realEnd->add($interval);
    
        $period = new DatePeriod(new DateTime($firstdate), $interval, $realEnd);
    
        // Use loop to store date into array
        foreach($period as $date) {             
            $array[] = $date->format('Y-m-d');
        }
    
        foreach($array as $key=>$dat) { 
    
            $now = new DateTime();
    
            if($key >=1)
            {
                $startdate =  new DateTime($array[$key-1]);
                $enddate =   new DateTime($array[$key]);  
    
                if($startdate <= $now && $now <= $enddate) {
                    $day_period = $key;
                    break;
                }
    
            } 
               
        }

        $result = false;
         
                 $outlet = array(    
                     'customer_outlet_id' => $request->customer_outlet_id, //$request->employee_id,
                     //'date' => $new_date,
                     'product_id' => $request->product_id,
                     'copack_regular' => $request->copack_regular,
                     'near_expiry_in_pc' =>  $request->near_expiry_in_pc,

                     'pc_expiry_date' =>  $pc_expiry_date,
                     'period' =>  $day_period,
                     'exposure_qty_will_expire_in_pc' =>  $request->exposure_qty_will_expire_in_pc,
                     'price_pc' =>  $request->price_pc,

                     'price_cs' =>  $request->price_cs,
                     'cs_expiry_date' =>  $cs_expiry_date,
                     'near_expiry_in_bs' =>  $request->near_expiry_in_bs,
                     'price_bs' =>  $request->price_bs,

                     'bs_expiry_date' =>   $bs_expiry_date,
                     'exposure_expiry_in_cs' =>  $request->exposure_expiry_in_cs,
                     'exposure_expiry_in_bs' =>  $request->exposure_expiry_in_bs,
                     'action_to_be_filled_by_cde' =>  $request->action_to_be_filled_by_cde,

                     'client_id' =>  $request->client_id,

                     'TimeStamp' => Carbon::now(),
                    // 'bar_code' => $request->bar_code
                    // 'created_by' => Auth::user()->emp_id
                 );
                 $result =  DB::table('stock_expiry')->insert($outlet);
            

        //  $result = $model->create($request->all());
        
          return $printReport->send_result_msg($this->success_status, $result);
      
    }


    public function add_stock_expiry_new(Request $request)
    {
        
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
         
        if($chk == false)
        return $printReport->auth_error_msg();
     
          // validation 
            $validator      =   Validator::make($request->all(), [
             'timesheet_id' =>'required',
            'product_id' =>'required',
    		'piece_price'  =>'required',
    		'near_expiry'  =>'required',
    		'expiry_date' =>'required',
            'exposure_qty'  =>'required',
    		'remarks' =>'required',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }   

      //  $date = $request->date;
        //dd($joining_date);
     /*   $matchThese = ['merchant_time_sheet.is_active' => '1'];
        
        $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.zrep_code','product_details.type','product_details.sku','store_details.store_code','store_details.store_name','sales.first_name as s_fname','sales.middle_name as s_mname','sales.surname as s_sname','sales.employee_id as s_employee_id','outlet.outlet_id','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname','field.first_name as f_fname','field.middle_name as f_mname','field.surname as f_sname','field.employee_id as f_employee_id','client.first_name as c_fname','client.middle_name as c_mname','client.surname as c_sname','client.employee_id as c_employee_id')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
        ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')

        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->leftJoin('employee as sales', 'sales.employee_id', '=', 'brand_details.sales_manager_id')
        ->leftJoin('employee as merchant', 'merchant.employee_id', '=', 'merchant_time_sheet.employee_id')
        ->leftJoin('employee as field', 'field.employee_id', '=', 'merchant_time_sheet.created_by')
        ->leftJoin('employee as client', 'client.employee_id', '=', 'brand_details.client_id')

        ->where('merchant_time_sheet.id', $request->timesheet_id)
        ->where('product_details.id', $request->product_id)
        ->where('product_details.is_active', 1)
        ->where($matchThese)
        ->get();  */

        $Product_brandid = "0";
        $Product_cateid = "0";
        $fieldmanager_id  = "";
        $outlet_id = "0";
        $fieldmanager_name = "";
        $salesmanager_name = "";
        $client_name = "";
        $merchandiser_name = "";
       
       // $store_name = "";
        $store_name = "";
        $zrep_code = "";
        $p_name = "";
        $store_code = "";
        $type = "";
        $result_product = DB::table('product_details')->where('id', $request->product_id)->get();
        if( $result_product != "")
        {
            $Product_brandid =  $result_product[0]->brand_id ;
            $Product_cateid =  $result_product[0]->product_categories ;
            $zrep_code = $result_product[0]->zrep_code;
            $p_name = $result_product[0]->product_name;
            $type  = $result_product[0]->type;
          
            $brand_tbl = DB::table('brand_details')->where('id', $Product_brandid)->get();
           
            $client_id = $brand_tbl[0]->client_id;
            $salesman_id = $brand_tbl[0]->sales_manager_id;

            $timesheet_tbl = DB::table('merchant_time_sheet')->where('id', $request->timesheet_id)->get();
            $fieldmanager_id  = $timesheet_tbl[0]->created_by;
            $outlet_id =  $timesheet_tbl[0]->outlet_id;

            $outlet_tbl = DB::table('outlet')->where('outlet_id', $outlet_id)->get();
            $outlet_name_id =   $outlet_tbl[0]->outlet_name;

            $store_tbl = DB::table('store_details')->where('id', $outlet_name_id)->get();
            $store_name = $store_tbl[0]->store_name;
            $store_code =  $store_tbl[0]->store_code;
 
            $employee_tbl = DB::table('employee')->where('employee_id', $fieldmanager_id)->get();
            $fieldmanager_name =  $employee_tbl[0]->first_name;

            $employee_tbl1 = DB::table('employee')->where('employee_id', $salesman_id)->get();
            $salesmanager_name =  $employee_tbl1[0]->first_name;

            $employee_tbl2 = DB::table('employee')->where('employee_id', $client_id)->get();
            $client_name =  $employee_tbl2[0]->first_name;

            $employee_tbl3 = DB::table('employee')->where('employee_id', Auth::user()->emp_id)->get();
            $merchandiser_name =  $employee_tbl3[0]->first_name;

           // $brand_tbl = DB::table('category_details')->where('id', $Product_cateid)->get();
           // $client_id = $brand_tbl[0]->client_id;
        }
       
  
        // if($result->isEmpty()) {
        //     return response()->json(["status" => "failed", "errors" => $result]);
        // }   
    //dd($result);

    //dd($request->piece_price);

    $matchThese = ['outlet_stockexpiry.is_active' => '1'];
        
        $check = DB::table('outlet_stockexpiry')
        ->where('timesheet_id', $request->timesheet_id)
        ->where('product_id', $request->product_id)
        ->where($matchThese)
        ->get();

    //dd($check); 
    $near_expiry_value = $request->piece_price * $request->near_expiry;

    $extimate_expire_value = $request->piece_price * $request->exposure_qty;

	$expiryDate  = date("Y-m-d", strtotime($request->expiry_date));

    $firstdate = date('Y').'-01-01';
    $lastdate = date('Y').'-12-31';

    //echo $lastdate;

    $array = array();
    $day_period = 0;
    // Variable that store the date interval of period 28 day
    $interval = new DateInterval('P28D');

    $realEnd = new DateTime($lastdate);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($firstdate), $interval, $realEnd);

    // Use loop to store date into array
    foreach($period as $date) {             
        $array[] = $date->format('Y-m-d');
    }

    foreach($array as $key=>$dat) { 

        $now = new DateTime();

        if($key >=1)
        {
            $startdate =  new DateTime($array[$key-1]);
            $enddate =   new DateTime($array[$key]);  

            if($startdate <= $now && $now <= $enddate) {
                $day_period = $key;
                break;
            }

        } 
           
    }
 
    $f_date1 = date("Y", strtotime($request->expiry_date));
    $firstdate1 = $f_date1.'-01-01';
    $l_date1  = date("Y", strtotime($request->expiry_date));
    $lastdate1 = $l_date1.'-12-31';

    //dd($lastdate1);

    $array1 = array();
    $expiry_period = 0;
    // Variable that store the date interval of period 28 day
    $interval1 = new DateInterval('P28D');

    $realEnd1 = new DateTime($lastdate1);
    $realEnd1->add($interval1);

    $period1 = new DatePeriod(new DateTime($firstdate1), $interval1, $realEnd1);
    //dd($period1);

    // Use loop to store date into array
    foreach($period1 as $date1) {             
        $array1[] = $date1->format('Y-m-d');
    }

    //dd($array1);

    foreach($array1 as $key1=>$dat1) { 

         //$now1 = new DateTime();
         //dd($now1);

        if($key1 >=1)
        {

            $startdate1 =  new DateTime($array1[$key1-1]);
            $enddate1 =   new DateTime($array1[$key1]);  

            //dd($enddate1);

            $expiry_date =   new DateTime($expiryDate); 

            //dd($expiry_date);

            if($startdate1 <= $expiry_date && $expiry_date <= $enddate1) {
                
                $expiry_period = $key1;
                break;
            }

        } 
           
    }

    //dd($expiry_period);

    $current_date = \Carbon\Carbon::now();
    $current_time = date('H:i:s');

    if ($check->isNotEmpty()) {

        $result = DB::table('outlet_stockexpiry')
            ->where('timesheet_id', $request->timesheet_id)
            ->where('product_id', $request->product_id)
            ->update([
                'outlet_id' =>$outlet_id,     //$result[0]->outlet_id,
                'piece_price'  =>$request->piece_price,
                'near_expiry'  =>$request->near_expiry,
                'exposure_qty'  =>$request->exposure_qty,
                'expiry_date' =>$expiryDate ,
                'remarks' =>$request->remarks,
                'merchandiser_id' => Auth::user()->emp_id,
                'field_manager_id' => $fieldmanager_id,     //$result[0]->f_employee_id,
                'sales_man_id' => $salesman_id,   //$result[0]->s_employee_id,
                'client_id' => $client_id, // $result[0]->c_employee_id,
                'customer_code' => $store_code,
                'salesman_name' => $salesmanager_name, //$result[0]->s_fname." ".$result[0]->s_mname." ".$result[0]->s_sname,
                'fieldmanager_name' => $fieldmanager_name, // $result[0]->f_fname." ".$result[0]->f_mname." ".$result[0]->f_sname,
                'merchandiser_name' => $merchandiser_name, //$result[0]->m_fname." ".$result[0]->m_mname." ".$result[0]->m_sname,
                'client_name' => $client_name,// $result[0]->c_fname." ".$result[0]->c_mname." ".$result[0]->c_sname,
                'account' => $store_name,
                'customer_name' => $store_name,
                'zrep' => $zrep_code,
                'description' => $p_name,
                'type' => $type,
                'near_expiry_value' => $near_expiry_value,
                'period' => $day_period,
                'expiry_period' => $expiry_period,
                'extimate_expire_value' => $extimate_expire_value,
               // 'created_at' => date('y-m-d H:i:s'),
                'updated_at'  => date('y-m-d H:i:s'),
                'device'  => 'Mobile',
                'bar_code' => $request->bar_code,
                'created_by' => Auth::user()->emp_id,
                'expiry_items_count' => $request->near_expiry,// $request->expiry_items_count 
      ]);

     

    }

    if ($check->isEmpty()) {
        $result =   DB::table('outlet_stockexpiry')->insert(
         array(
            'date' => $current_date,
            'time' => $current_time,
            'timesheet_id' =>$request->timesheet_id,
            'outlet_id' =>$outlet_id,
            'product_id' =>$request->product_id,
            'piece_price'  =>$request->piece_price,
            'near_expiry'  =>$request->near_expiry,
            'exposure_qty'  =>$request->exposure_qty,
            'expiry_date' =>$expiryDate ,
            'remarks' =>$request->remarks,
            'merchandiser_id' => Auth::user()->emp_id,
            'field_manager_id' => $fieldmanager_id,// $result[0]->f_employee_id,
            'sales_man_id' => $salesman_id,//$result[0]->s_employee_id,
            'client_id' => $client_id, //$result[0]->c_employee_id,
            'customer_code' => $store_code,
            'salesman_name' => $salesmanager_name, //$result[0]->s_fname." ".$result[0]->s_mname." ".$result[0]->s_sname,
            'fieldmanager_name' => $fieldmanager_name, // $result[0]->f_fname." ".$result[0]->f_mname." ".$result[0]->f_sname,
            'merchandiser_name' => $merchandiser_name, //$result[0]->m_fname." ".$result[0]->m_mname." ".$result[0]->m_sname,
            'client_name' => $client_name,// $result[0]->c_fname." ".$result[0]->c_mname." ".$result[0]->c_sname,
            'account' => $store_name,
            'customer_name' => $store_name,
            'zrep' => $zrep_code,
            'description' => $p_name,
            'type' => $type,
            'expiry_period' => $expiry_period,
            'near_expiry_value' => $near_expiry_value,
            'period' => $day_period,
            'extimate_expire_value' => $extimate_expire_value,
            'created_at' => date('y-m-d H:i:s'),
            'updated_at'  => date('y-m-d H:i:s'),
            'device'  => 'Mobile',
            'bar_code' => $request->bar_code,
            'created_by' => Auth::user()->emp_id,
            'expiry_items_count' => $request->near_expiry, //$request->expiry_items_count 

         )
    );
    $user = Auth::user()->emp_id;
    $notify = new ApiNotificationController();
    $ReportToID = "Emp5906";
    $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
    if( $ReportTo != "")
    $ReportToID = $ReportTo->reporting_to_emp_id; 
    $title = "Merchandiser update stock export";
    $user_type = "merchandiser";
    $created_to = $ReportToID;
    $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);    
    
    $add_notifynew =  $notify->add_audit_trails("Expiry Stock submitted", "Expiry_Stock");
  
 }      
 return $printReport->send_result_msg($this->success_status, $result);
      
    }

    public function merchandiser_view_updated_stock_expirey_details(Request $request)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();  

        $validator = Validator::make($request->all(), [
	        'emp_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

        $matchThese = ['outlet_stockexpiry.is_active' => '1'];
        
        $result = DB::table('outlet_stockexpiry')
        ->select('outlet.outlet_id','store_details.store_name','outlet_stockexpiry.timesheet_id',
        'outlet_stockexpiry.piece_price', 'outlet_stockexpiry.expiry_items_count as number_ of_ expiry_items_count',
        'outlet_stockexpiry.expiry_date', 'outlet_stockexpiry.exposure_qty',
        'outlet_stockexpiry.remarks', 'outlet_stockexpiry.created_at',
        'outlet_stockexpiry.zrep', 'outlet_stockexpiry.description',)

         ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_stockexpiry.outlet_id')
         ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
        

      //  $result =  $result ->where('outlet_stockexpiry.outlet_id', $request->outlet_id );
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->endOfMonth(); 
 
        $result =  $result ->where('outlet_stockexpiry.created_by', $request->emp_id )
        ->whereBetween('outlet_stockexpiry.created_at',[$dateS,$dateE])
        ->orderBy('outlet_stockexpiry.created_at','DESC');
        $result =  $result->where($matchThese)->get();
      
        return $printReport->send_result_msg($this->success_status, $result);

    } 



}
