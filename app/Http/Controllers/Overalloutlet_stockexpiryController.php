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



class Overalloutlet_stockexpiryController extends Controller
{
    
    public function index(Request $request, Outlet_stock $model)
    {       

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

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
            ->where($matchThese)
            ->groupBy('outlet_stockexpiry.id')
            ->get();

        //dd($result);

        $merchandisers = DB::table('employee')
        ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
        ->where('employee.is_active', 1)
        ->where('designation', 6)
       // ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
        ->get();

        $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->groupBy('outlet.outlet_id')
            ->get();
       

       
       return view('admin_outlet_stockexpiry.index', ['result' => $result,'outer'=>$out,'merchandisers' => $merchandisers,
        'date' => $request->date, 'zrep_code' =>$request->zrep_code, 'customer_code' => $request->customer_code,'employee_id'=>$request->merchandiser_id,'outlet_id'=>$request->outlet_id ]);

    
    }
    public function view_outletstock1(Request $request)
    {  
      // dd($request);
      //return $request->id;
      $result = DB::table('outlet_stockexpiry') ->where('id',$request->id)->get();
       
      
    // dd($result);     

               
       return response()->json($result);

    }

   public function filter_overallstock_report(Request $request)
    {  
       // dd($request->all());
        
       
        $date = $request->date;


      
        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        

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
           
            ->where($matchThese)
            ->groupBy('outlet_stockexpiry.id');
            //->get();

        
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

        $merchandisers = DB::table('employee')
        ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
        ->where('employee.is_active', 1)
        ->where('designation', 6)
       // ->where('employee_reporting_to.reporting_to_emp_id', Auth::user()->emp_id)
        ->get();

        $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->groupBy('outlet.outlet_id')
            ->get();
       
       
       
        return view('admin_outlet_stockexpiry.index', [ 'result' => $query,'outer'=>$out,'merchandisers' => $merchandisers, 'date' => $request->date, 'zrep_code' =>$request->zrep_code, 'customer_code' => $request->customer_code,'employee_id'=>$request->merchandiser_id,'outlet_id'=>$request->outlet_id ]);
     
    }

 /*   public function stock_report(Request $request)
    { 


        $matchThese = ['merchant_time_sheet.is_active' => '1'];

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

        $out = Outlet::with('store')
            ->select('outlet.*')
            ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
            ->where('outlet.is_active', 1)
            ->where('outlet.is_assigned', 0)
            ->groupBy('outlet.outlet_id')
            ->get();

       return view('outlet_stockexpiry.report.index', ['result' => $result,'outer'=>$out,'merchandisers' => $merchandisers,
            'date' => '', 'zrep_code' =>'', 'customer_code' => '','employee_id'=>'','outlet_id'=>'']);


        
    }*/

   
     public function export_stock1(Request $request) {

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
        $matchThese = ['employee_id' => $ReportToID, 'designation' => 1];
        $User = Employee::where($matchThese)->first();
        //dd($User->email);
        }
        $user_email = $User->email;

        $url = "export/stock_export/" .$fileName;

        $files = [$url
            
            //public_path('/export/test.jpg'),
        ];


        $data = array('first_name'=> $User->first_name, 'middle_name' => $User->middle_name, 'surname' => $User->surname);

        Mail::send('admin_outlet_stockexpiry.mail', $data, function($message) use ($user_email, $files)
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


     public function view_outletstock_report1(Request $request)
    {  
      //dd($request->all());

      // $matchThese = ['merchant_time_sheet.is_active' => '1'];
        //$match = ['id'=>$request->id];
        $result = DB::table('outlet_stockexpiry')
            ->select('outlet_stockexpiry.*')
          
            ->where('outlet_stockexpiry.id', $request->id)
            ->where('outlet_stockexpiry.is_active', 1)
            //->where('outlet_stockexpiry.field_manager_id', Auth::user()->emp_id)
            //->where($matchThese)
            ->get();
        
      
    //dd($result);     

               
       return response()->json($result);

    }

 
   } 

