<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Outlet_stock;

use App\Http\Requests;

use File;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Crypt;
use DateTime;
use DatePeriod;
use DateInterval;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Mail;
use App\Employee_Reporting_To;
use App\Employee;
use App\Outlet;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use App\Http\Controllers\AuditController as audit_store;



class Outlet_stockexpiryController extends Controller
{
    
    public function index(Request $request, Outlet_stock $model)
    {       

        $matchThese = ['merchant_time_sheet.is_active' => '1'];
        
        // $result = DB::table('merchant_time_sheet')
        // ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.zrep_code','product_details.sku')
        // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        // ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
        // ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        // ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        // ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
        // ->where('product_details.is_active', 1)
        // ->where($matchThese)
        // ->get();


       $result = DB::table('merchant_time_sheet')
       
        ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.zrep_code','product_details.sku','product_details.barcode','product_details.created_by')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

        ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

        ->leftJoin('product_details', 'product_details.created_by', '=', 'brand_client.created_by')
       // ->leftJoin('availability', 'availability.timesheet_id', '=', 'merchant_time_sheet.id')

         ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')

        ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
        ->where('product_details.is_active', 1)
        // ->where('product_details.created_by')
        ->where($matchThese)
        ->groupBy('product_details.id')
        ->get();

        //dd($result);
   
         return view('outlet_stockexpiry.create', ['result' => $result]);
    
    }
  

    public function create()

    {
        //$outlet= DB::table('outlet_stockexpiry')->orderby('created_at','DESC')->where('is_active',1)->get();
        
        $product_details  = DB::table('product_details')->where('is_active',1)->get();

        return view('outlet_stockexpiry.create',['product' => $product_details]);

    }


   

    public function store(Request $request)
    {
    
        //dd($request->all());
    
        $request->validate([
        	'timesheet_id' =>'required',
            'product_id' =>'required',
    		//'piece_price'  =>'required',
    		'near_expiry'  =>'required',
    		'expiry_date' =>'required',
            'exposure_qty'  =>'required',
    		'remarks' =>'required',
         
        ]);

        $matchThese = ['merchant_time_sheet.is_active' => '1'];
        
        $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.zrep_code','product_details.type','product_details.sku','product_details.price_per_piece','store_details.store_code','store_details.store_name','sales.first_name as s_fname','sales.middle_name as s_mname','sales.surname as s_sname','sales.employee_id as s_employee_id','outlet.outlet_id','merchant.first_name as m_fname','merchant.middle_name as m_mname','merchant.surname as m_sname','field.first_name as f_fname','field.middle_name as f_mname','field.surname as f_sname','field.employee_id as f_employee_id','client.first_name as c_fname','client.middle_name as c_mname','client.surname as c_sname','client.employee_id as c_employee_id')

       
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
        ->get();

    //dd($result);

    //dd($request->piece_price);

    $matchThese = ['outlet_stockexpiry.is_active' => '1'];
        
        $check = DB::table('outlet_stockexpiry')
        ->where('timesheet_id', $request->timesheet_id)
        ->where('product_id', $request->product_id)
        ->where($matchThese)
        ->get();

    //dd($check);

    $near_expiry_value = $result[0]->price_per_piece * $request->near_expiry;

    $extimate_expire_value = $result[0]->price_per_piece * $request->exposure_qty;

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
                'date' => $current_date,
                'time' => $current_time,
                'outlet_id' =>$result[0]->outlet_id,
                'piece_price'  =>$result[0]->price_per_piece,
                'near_expiry'  =>$request->near_expiry,
                'exposure_qty'  =>$request->exposure_qty,
                'expiry_date' =>$expiryDate ,
                'remarks' =>$request->remarks,
                'merchandiser_id' => Auth::user()->emp_id,
                'field_manager_id' => $result[0]->f_employee_id,
                'sales_man_id' => $result[0]->s_employee_id,
                'client_id' => $result[0]->c_employee_id,
                'customer_code' => $result[0]->store_code,
                'salesman_name' => $result[0]->s_fname." ".$result[0]->s_mname." ".$result[0]->s_sname,
                'fieldmanager_name' => $result[0]->f_fname." ".$result[0]->f_mname." ".$result[0]->f_sname,
                'merchandiser_name' => $result[0]->m_fname." ".$result[0]->m_mname." ".$result[0]->m_sname,
                'client_name' => $result[0]->c_fname." ".$result[0]->c_mname." ".$result[0]->c_sname,
                'account' => $result[0]->store_name,
                'customer_name' => $result[0]->store_name,
                'zrep' => $result[0]->zrep_code,
                'description' => $result[0]->p_name,
                'type' => $result[0]->type,
                'near_expiry_value' => $near_expiry_value,
                'period' => $day_period,
                'expiry_period' => $expiry_period,
                'extimate_expire_value' => $extimate_expire_value,
                'bar_code' => $request->barcode,
                'created_at' => date('y-m-d H:i:s'),
                'updated_at'  => date('y-m-d H:i:s')
      ]);

    }

    if ($check->isEmpty()) {
        DB::table('outlet_stockexpiry')->insert(
         array(
            'date' => $current_date,
            'time' => $current_time,
            'timesheet_id' =>$request->timesheet_id,
            'outlet_id' =>$result[0]->outlet_id,
            'product_id' =>$request->product_id,
            'piece_price'  =>$result[0]->price_per_piece,
            'near_expiry'  =>$request->near_expiry,
            'exposure_qty'  =>$request->exposure_qty,
            'expiry_date' =>$expiryDate ,
            'remarks' =>$request->remarks,
            'merchandiser_id' => Auth::user()->emp_id,
            'field_manager_id' => $result[0]->f_employee_id,
            'sales_man_id' => $result[0]->s_employee_id,
            'client_id' => $result[0]->c_employee_id,
            'customer_code' => $result[0]->store_code,
            'salesman_name' => $result[0]->s_fname." ".$result[0]->s_mname." ".$result[0]->s_sname,
            'fieldmanager_name' => $result[0]->f_fname." ".$result[0]->f_mname." ".$result[0]->f_sname,
            'merchandiser_name' => $result[0]->m_fname." ".$result[0]->m_mname." ".$result[0]->m_sname,
            'client_name' => $result[0]->c_fname." ".$result[0]->c_mname." ".$result[0]->c_sname,
            'account' => $result[0]->store_name,
            'customer_name' => $result[0]->store_name,
            'zrep' => $result[0]->zrep_code,
            'description' => $result[0]->p_name,
            'type' => $result[0]->type,
            'near_expiry_value' => $near_expiry_value,
            'period' => $day_period,
            'expiry_period' => $expiry_period,
            'extimate_expire_value' => $extimate_expire_value,
            'bar_code' => $request->barcode,
            'created_at' => date('y-m-d H:i:s'),
            'updated_at'  => date('y-m-d H:i:s')

         )
    );
        
    }

         $outlet = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','outlet.outlet_state')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where('merchant_time_sheet.id', $request->timesheet_id)
            ->where('merchant_time_sheet.is_active', 1)
            ->get();

        $user = Auth::user()->emp_id;

        $notify = new NotificationController();
         $ReportTo = "";
         $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
         if( $ReportTo != "")
         $ReportToID = $ReportTo->reporting_to_emp_id; 
         $title = "Merchandiser update stock export";
         $user_type = "merchandiser";
         $created_to = $ReportToID;
         $add_notify =  $notify->store($title, $user_type, $ReportToID);

       if($outlet->isNotEmpty())
        {
            $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

            $audit = new audit_store();
            $description = ' updated stock exipiry  in '.$outlet_name;
            $add_audit =  $audit->store($description,'Expiry_Stock'); 
        }
	
        return redirect()->back()->withStatus(__('Outlet Stock Expiry Added Successfully..'));

    }

   


    public function show($id)

    {
	$outlet_stock = Outlet::find($id);
        return view('outlet_stockexpiry.show',['outlet_stock' => $outlet_stock]);
        

    }



    public function edit($id)

    {
    	    
    	  $product_details = DB::table('product_details')->where('is_active',1)->get();
    	 	
         $outlet_stock = DB::table('outlet_stockexpiry')->where('id', $id)->get();
               
    
        return view('outlet_stockexpiry.edit',['outlet_stock' => $outlet_stock,'product' => $product_details ]);
        
       
    }

  
    public function update(Request $request, $id )

    {
//dd($request);
      $request->validate([
         'outlet_id' =>'required',
        'product_id' =>'required',
		'total_available_carton'  =>'required',
		'total_available_cases'  =>'required',
		'total_available_pieces'  =>'required',
		'expiry_date' =>'required',
		'remarks' =>'required',
		
		
		'carton_picture.*' =>'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            	'case_picture.*' =>'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            	'piece_picture.*' =>'required|mimes:jpeg,jpg,png,doc,docx,pdf',
            	
            	
		
		'sales_man_id' =>'required',
       
        ]);
        
         if($request->hasfile('carton_picture'))
        {

            foreach($request->file('carton_picture') as $file)
            {
            
               $fileName=$file->getClientOriginalName();
                $destinationPath = public_path().'/outletstock/' ;
                $file->move($destinationPath,$fileName);
                $data[] = $fileName;
                $str = implode(",",$data);
            }
        }

	if($request->hasfile('case_picture'))
        {

            foreach($request->file('case_picture') as $file1)
            {
            
                $fileName1=$file1->getClientOriginalName();
                $destinationPath1 = public_path().'/outletstock/' ;
                $file1->move($destinationPath1,$fileName1);
                $data1[] = $fileName1;
                $str1 = implode(",",$data1);
            }
        }
        
        if($request->hasfile('piece_picture'))
        {

            foreach($request->file('piece_picture') as $file2)
            {
            
                $fileName2=$file2->getClientOriginalName();
                $destinationPath2 = public_path().'/outletstock/' ;
                $file2->move($destinationPath2,$fileName2);
                $data2[] = $fileName2;
                $str2 = implode(",",$data2);
            }
        }
        

//dd($request->carton_picture);

  	$expiryDate  = date("Y-m-d", strtotime($request->expiry_date));
  	
       $affected = DB::table('outlet_stockexpiry')
              ->where('id', $id)
              ->update([
                'outlet_id' =>$request->outlet_id,
            	'product_id' =>$request->product_id,
		'total_available_carton'  =>$request->total_available_carton,
		'total_available_cases'  =>$request->total_available_cases,
		'total_available_pieces'  =>$request->total_available_pieces,
		'expiry_date' =>$expiryDate,
		'remarks' =>$request->remarks,
		
		'carton_picture' => $str,
            	'case_picture'   => $str1,
            	'piece_picture' => $str2,
            	
            	
            	
           	//'carton_picture' =>$request->carton_picture,
            	//'case_picture' =>$request->case_picture,
            	//'piece_picture' =>$request->piece_picture,
        	
		
		'sales_man_id' =>$request->sales_man_id,
           	
             
              ]);

        return redirect()->route('outlet_stockexpiry.index')->withStatus(__('outlet_stockexpiry updated successfully'));


    }

 

    public function destroy($id)

    {

       // $delete = DB::table('outlet')->where('outlet_id', $id)->update(['is_active'=>'0']);
    	
      //  return redirect()->route('outlet.index')->withStatus(__('outlet deleted successfully'));

      // $delete = DB::table('outlet')->where('outlet_id', $id)->delete();

       $delete = DB::table('outlet_stockexpiry')->where('id', $id)->update(['is_active' => '0']);
             
       return redirect()->route('outlet_stockexpiry.index')->withStatus(__('outlet_stockexpiry deleted successfully'));              
                         
          }   
          
    public function view_outletstock(Request $request)
    {  
      // dd($request);
      //return $request->id;
      $result = DB::table('outlet_stockexpiry') ->where('id',$request->id)->get();
       
      
    // dd($result);     

               
       return response()->json($result);

    }


    public function filter_stock_report(Request $request)
    {  
       // dd($request->all());
        
       
        $date = $request->date;
      
        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        if(Auth::user()->role->name =="Field Manager")
        {
            $result = DB::table('merchant_time_sheet')
                ->select('product_details.id as product_id','product_details.product_name','outlet_stockexpiry.*','brand_details.brand_name')

                ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

                ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
                ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
                
                ->leftJoin('outlet_stockexpiry', function ($join) {
                        $join->on('outlet_stockexpiry.product_id', '=', 'product_details.id')
                            ->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
                    })

                ->where('outlet_stockexpiry.is_active', 1)
                ->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
                ->where($matchThese)
                ->groupBy('outlet_stockexpiry.id');
                //->get();


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
                ->select('product_details.id as product_id','product_details.product_name','outlet_stockexpiry.*','brand_details.brand_name')

                ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

                ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
                ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
                
                ->leftJoin('outlet_stockexpiry', function ($join) {
                        $join->on('outlet_stockexpiry.product_id', '=', 'product_details.id')
                            ->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
                    })

                ->where('outlet_stockexpiry.is_active', 1)
                //->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
                ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->where($matchThese)
                ->groupBy('outlet_stockexpiry.id');
               
            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->get();

            //dd($result);

        }

        
        if(!empty($request->outlet_id))
        {

              $result->where('outlet_stockexpiry.outlet_id' , $request->outlet_id);
          }

        if(!empty($request->merchandiser_id))
        {
           
            $result->where('outlet_stockexpiry.merchandiser_id' , $request->merchandiser_id);

        }

        if(!empty($request->date))
        {
          // dd($start_date);

            $date = date('Y-m-d', strtotime($request->date));

            $result->whereDate('outlet_stockexpiry.date', $date);

        }
        if(!empty($request->zrep_code))
        {
          

            $result->where('outlet_stockexpiry.zrep', $request->zrep_code);

        }
       
        $query = $result->get();

        //dd($query);

       
        $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->groupBy('outlet.outlet_id')
            ->get();
       
       
       
        return view('outlet_stockexpiry.report.index', [ 'result' => $query,'outer'=>$out,'merchandisers' => $merchandisers, 'date' => $request->date, 'zrep_code' =>$request->zrep_code, 'customer_code' => $request->customer_code,'employee_id'=>$request->merchandiser_id,'outlet_id'=>$request->outlet_id ]);
     
    }

    public function stock_report(Request $request)
    { 

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->groupBy('outlet.outlet_id')
            ->get();

        if(Auth::user()->role->name =="Field Manager")
        {

            $result = DB::table('merchant_time_sheet')
                ->select('product_details.id as product_id','product_details.product_name','outlet_stockexpiry.*','brand_details.brand_name')

                ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

                ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
                ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
                
                ->leftJoin('outlet_stockexpiry', function ($join) {
                        $join->on('outlet_stockexpiry.product_id', '=', 'product_details.id')
                            ->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
                    })

                ->where('outlet_stockexpiry.is_active', 1)
                ->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
                ->where($matchThese)
                ->groupBy('outlet_stockexpiry.id')
                ->get();

            //dd($result);

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
                ->select('product_details.id as product_id','product_details.product_name','outlet_stockexpiry.*','brand_details.brand_name')

                ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

                ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
                ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
                
                ->leftJoin('outlet_stockexpiry', function ($join) {
                        $join->on('outlet_stockexpiry.product_id', '=', 'product_details.id')
                            ->on('outlet_stockexpiry.timesheet_id', '=', 'merchant_time_sheet.id');
                    })

                ->where('outlet_stockexpiry.is_active', 1)
                //->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
                ->leftJoin('cde_reporting', 'cde_reporting.merchandiser_id', '=', 'merchant_time_sheet.employee_id' )
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->where($matchThese)
                ->groupBy('outlet_stockexpiry.id')
                ->get();

            $merchandisers = DB::table('employee')
                ->leftJoin('cde_reporting', 'employee.employee_id', '=', 'cde_reporting.merchandiser_id')
                ->where('employee.is_active', 1)
                ->where('designation', 6)
                ->where('cde_reporting.cde_id', Auth::user()->emp_id)
                ->get();

            //dd($result);

        }
      

       return view('outlet_stockexpiry.report.index', ['result' => $result,'outer'=>$out,'merchandisers' => $merchandisers,
            'date' => '', 'zrep_code' =>'', 'customer_code' => '','employee_id'=>'','outlet_id'=>'']);

    }

   
     public function export_stock(Request $request) {

        //dd($request->all());

        $customer_code = $request->customer_code;
        $zrep_code = $request->zrep_code;
        $type = $request->type;
       
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
            ->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
            ->where($matchThese);
           
        
        if(!empty($request->customer_code))
        {
          // dd($start_date);

           
            $result->where('outlet_stockexpiry.customer_code' , $request->customer_code);

        }

        if(!empty($request->date))
        {
          // dd($start_date);

            $date = date('Y-m-d', strtotime($request->date));

            $result->whereDate('outlet_stockexpiry.date', $date);

        }
        if(!empty($request->zrep_code))
        {
          

            $result->where('outlet_stockexpiry.zrep', $request->zrep_code);

        }
       
         $query = $result->get();

        //dd($query);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'S.No');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Customer Code');
        $sheet->setCellValue('D1', 'Salesman');
        $sheet->setCellValue('E1', 'Account');
        $sheet->setCellValue('F1', 'Customer Name');
        $sheet->setCellValue('G1', 'ZREP');
        $sheet->setCellValue('H1', 'Description');
        $sheet->setCellValue('I1', 'Copack / Regular');
        $sheet->setCellValue('J1', 'Peice Price');
        $sheet->setCellValue('K1', 'Near Expiry in peices');
        $sheet->setCellValue('L1', 'Near Expiry Value');
        $sheet->setCellValue('M1', 'Expire Date');
        $sheet->setCellValue('N1', 'Period');
        $sheet->setCellValue('O1', 'Exposure QTY');
        $sheet->setCellValue('P1', 'Estimate Exposure Value');
        $sheet->setCellValue('Q1', 'Action By');
        $rows = 2;
        $i = 1;
        foreach($query as $report){
        $sheet->setCellValue('A' . $rows, $i);
        $sheet->setCellValue('B' . $rows, $report->date);
        $sheet->setCellValue('C' . $rows, $report->customer_code);
        $sheet->setCellValue('D' . $rows, $report->salesman_name);
        $sheet->setCellValue('E' . $rows, $report->account);
        $sheet->setCellValue('F' . $rows, $report->customer_name);
        $sheet->setCellValue('G' . $rows, $report->zrep);
        $sheet->setCellValue('H' . $rows, $report->description);
        $sheet->setCellValue('I' . $rows, $report->type);
        $sheet->setCellValue('J' . $rows, $report->piece_price);
        $sheet->setCellValue('K' . $rows, $report->near_expiry);
        $sheet->setCellValue('L' . $rows, $report->near_expiry_value);
        $sheet->setCellValue('M' . $rows, $report->expiry_date);
        $sheet->setCellValue('N' . $rows, $report->period);
        $sheet->setCellValue('O' . $rows, $report->exposure_qty);
        $sheet->setCellValue('P' . $rows, $report->extimate_expire_value);
        $sheet->setCellValue('Q' . $rows, $report->merchandiser_name);

      
        $rows++;
        $i++;
        }

        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $time = \Carbon\Carbon::now()->format('His');
       // dd($date);

        $fileName = "stock-expiry-".$date.'-'.$time.'.'.$type;
        //dd($fileName);

        if($type == 'xlsx') {
        $writer = new Xlsx($spreadsheet);
        } else if($type == 'xls') {
        $writer = new Xls($spreadsheet);
        }
        $writer->save("export/stock_export/".$fileName);
        header("Content-Type: application/vnd.ms-excel");

        $field_manager_id = Auth::user()->emp_id;
        //dd($HRid);
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $field_manager_id)->first();
        //dd($ReportTo);
        if ($ReportTo !== null) 
        {
        // user doesn't exist
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        //dd($ReportToID); 
        $matchThese = ['employee_id' => $ReportToID, 'designation' => 9];
        $User = Employee::where($matchThese)->first();
        //dd($User->email);
        }
        $user_email = $User->email;

        $url = "export/stock_export/" .$fileName;

        $files = [$url
            
            //public_path('/export/test.jpg'),
        ];


        $data = array('first_name'=> $User->first_name, 'middle_name' => $User->middle_name, 'surname' => $User->surname);

        Mail::send('outlet_stockexpiry.report.mail', $data, function($message) use ($user_email, $files)
        {
            $message->to($user_email)->subject('Outlet Stock Expiry');
            foreach ($files as $file){
                $message->attach($file);
            }
        });

         // check for failed ones
        if (Mail::failures()) {
             return response()->json(0);
        }

       

        return response()->json(1);


    }


     public function view_outletstock_report(Request $request)
    {  
      //dd($request->all());

      // $matchThese = ['merchant_time_sheet.is_active' => '1'];
        //$match = ['id'=>$request->id];
        $result = DB::table('outlet_stockexpiry')
            ->select('outlet_stockexpiry.*')
          
            ->where('outlet_stockexpiry.id', $request->id)
            ->where('outlet_stockexpiry.is_active', 1)
            ->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
            //->where($matchThese)
            ->get();
        
      
    //dd($result);     

               
       return response()->json($result);

    }

 
   } 

