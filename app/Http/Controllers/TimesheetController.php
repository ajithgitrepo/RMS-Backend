<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;
use App\Employee_Reporting_To;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\merchant_timesheet;

use Illuminate\Support\Facades\Mail;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

use DateTime;

// Carbon::setWeekStartsAt(Carbon::SUNDAY);
// Carbon::setWeekEndsAt(Carbon::SATURDAY);

class TimesheetController extends Controller
{
    public function index(merchant_timesheet $model)
    {


        $matchThese = ['merchant_time_sheet.is_active' => '1', 'employee_id' => Auth::user()->emp_id,'merchant_time_sheet.is_defined' =>1];

        //$result = merchant_timesheet::where($matchThese)->with('outlet')->with('outlet_login')->get();
        $date = Carbon::now(); // or $date = new Carbon();
        $start = $date->startOfWeek();

        $value = 'someName';
        $result = merchant_timesheet::with(['outlet'])
        ->select('merchant_time_sheet.*','store_details.store_name')
        ->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->Join('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->whereMonth('date', Carbon::now()->month)
        ->where($matchThese)
        ->get();

        //dd($result);

        return view('timesheet.index', ['outlets' => $result, 'date' => '']);
    }

    public function date_timesheet(merchant_timesheet $model)
    {

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'employee_id' => Auth::user()->emp_id, 'merchant_time_sheet.is_defined' =>0];

        //$result = merchant_timesheet::where($matchThese)->with('outlet')->with('outlet_login')->get();

        $date =  DB::table('merchant_time_sheet')
              ->where($matchThese)
              ->get();

       // dd($date);
        $dates = array();
        foreach ($date as $value) {
            $dates[] = $value->date;
        }      

        //dd($dates);

        $value = 'someName';
        $result = merchant_timesheet::with(['outlet'])
        ->select('merchant_time_sheet.*','store_details.store_name')
        ->Join('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->Join('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->whereMonth('date', Carbon::now()->month)
        ->where($matchThese)
        ->get();

        //dd($result);

        return view('timesheet.date-timesheet.index', ['outlets' => $result, 'date'=>'']);
    }

    public function filter_timesheet(Request $request, merchant_timesheet $model)
    {
        //dd($request->all());

    	$matchThese = ['merchant_time_sheet.is_active' => '1', 'employee_id' => Auth::user()->emp_id,'merchant_time_sheet.is_defined' =>1];

    	$result = merchant_timesheet::where($matchThese)->with('outlet')->with('outlet_login')
        ->select('merchant_time_sheet.*','store_details.store_name')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

    	if(isset($request->date))
        {

            $date = date('Y-m-d', strtotime($request->date));

           // dd($date);

        	$result->where('date', $date);
    		
    	}	

        if(!isset($request->date))
        {

            $result->whereMonth('date', Carbon::now()->month);
            
        }   

        //dd($request->status);

       
    	$query = $result->get();

    	//dd($query);
       
        return view('timesheet.index', ['outlets' => $query, 'date' => $request->date]);
    }

    public function filter_date_timesheet(Request $request, merchant_timesheet $model)
    {
        $matchThese = ['merchant_time_sheet.is_active' => '1', 'employee_id' => Auth::user()->emp_id,'merchant_time_sheet.is_defined' =>0];

        $result = merchant_timesheet::where($matchThese)->with('outlet')
        ->select('merchant_time_sheet.*','store_details.store_name')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

        if(isset($request->date))
        {

            $date = date('Y-m-d', strtotime($request->date));

            $result->where('date', $date);
            
        }  

        if(!isset($request->date))
        {

            $result->whereMonth('date', Carbon::now()->month);
            
        }    

        //dd($request->status);

        // if(isset($request->day))
        // {
        //     $result->where('is_defined', '1');
        //     $result->where('day', $request->day);
        //     //dd($request->status);
            
        // }   

        $query = $result->get();

       // dd($query);
       
        return view('timesheet.date-timesheet.index', ['outlets' => $query, 'date' => $request->date]);
    }


    public function export_schedule(Request $request) {

        //dd($request->all());

        $employee_id = $request->employee_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $status = $request->status;
        $outlet_id = $request->outlet_id;
        $type = $request->type;

        //dd($type);
       
        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '1'];

        $result = merchant_timesheet::where($matchThese)->with('outlet')->with('employee');
        $result->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code');
        $result->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id');
        $result->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');

         $date = \Carbon\Carbon::now();

         $filter_month = $date->format('F');
         $filter_year = $date->format('Y');   
        // dd($filter_year); 


        if(!empty($employee_id))
        {
          
            $result->where('merchant_time_sheet.employee_id' , $employee_id);

        }

        if(!empty($status))
        {
          
            $result->where('merchant_time_sheet.is_completed' , $status);

        }

        if(!empty($outlet_id))
        {
          
            $result->where('merchant_time_sheet.outlet_id' , $outlet_id);

        }

        if(!empty($start_date) && !empty($end_date))
        {
            //dd($start_date);

            $startdate = date('Y-m-d', strtotime($start_date));
            $enddate = date('Y-m-d', strtotime($end_date));

            $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);

        }
       

        $result->orderBy('date', 'DESC');

        $query = $result->get();

        //dd($query);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'S.No');
        $sheet->setCellValue('B1', 'Employee Name');
        $sheet->setCellValue('C1', 'Outlet Id');
        $sheet->setCellValue('D1', 'Date');
        $sheet->setCellValue('E1', 'Outlet Name');
        $sheet->setCellValue('F1', 'Outlet Area');
        $sheet->setCellValue('G1', 'Outlet City');
        $sheet->setCellValue('H1', 'Outlet State');
        $sheet->setCellValue('I1', 'Outlet Country');
        $sheet->setCellValue('J1', 'Status');
        $rows = 2;
        $i = 1;

        foreach($query as $outlet){

        //dd($outlet['outlet']['outlet_area']);

        $sheet->setCellValue('A' . $rows, $i);
        $sheet->setCellValue('B' . $rows, $outlet['employee']['first_name'].' '.$outlet['employee']['surname']);
        $sheet->setCellValue('C' . $rows, $outlet['outlet_id']);
        $sheet->setCellValue('D' . $rows, date('d - m - Y',strtotime( $outlet['date']) ));
        $sheet->setCellValue('E' . $rows, $outlet['store_name']);
        if(isset($outlet['outlet']['outlet_area']))
            $sheet->setCellValue('F' . $rows, $outlet['outlet']['outlet_area']);
        else
            $sheet->setCellValue('F' . $rows, '-');

        if(isset($outlet['outlet']['outlet_city']))
            $sheet->setCellValue('G' . $rows, $outlet['outlet']['outlet_city']);
        else
            $sheet->setCellValue('G' . $rows, '-');

        if(isset($outlet['outlet']['outlet_city']))
            $sheet->setCellValue('H' . $rows, $outlet['outlet']['outlet_state']);
        else
            $sheet->setCellValue('H' . $rows, '-');

        if(isset($outlet['outlet']['outlet_city']))
            $sheet->setCellValue('I' . $rows, $outlet['outlet']['outlet_country']);
        else
            $sheet->setCellValue('I' . $rows, '');
        if($outlet['is_completed'] == 1){

            $sheet->setCellValue('J' . $rows, 'completed');
        }
        if($outlet['is_completed'] == 0){

            $sheet->setCellValue('J' . $rows, 'pending');
        }

        
        $rows++;
        $i++;
        }

        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $time = \Carbon\Carbon::now()->format('His');
       // dd($date);

        $fileName = "timesheet-scheduled-".$date.'-'.$time.'.'.$type;
       // dd($fileName);

        if($type == 'xlsx') {
        $writer = new Xlsx($spreadsheet);
        } 
        else if($type == 'xls') {
        $writer = new Xls($spreadsheet);
        }

        //dd($type);

        $writer->save(public_path()."/export/timesheet/".$fileName);
        //header("Content-Type: application/vnd.ms-excel");

        //dd($type);


        $field_manager_id = Auth::user()->emp_id;
        //dd($field_manager_id);
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $field_manager_id)->first();
        dd($ReportTo);
        if ($ReportTo !== null) 
        {
        // user doesn't exist
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        //dd($ReportToID); 
        $matchThese = ['employee_id' => $ReportToID, 'designation' => 9];
        $User = Employee::where($matchThese)->first();
        dd($User->email);
        }
        $user_email = $User->email;

        //dd($user_email);

        $url = public_path()."/export/timesheet/" .$fileName;

        $files = [
           $url
           //public_path($url),
           // public_path('/export/test.jpg'),
        ];


        $data = array('first_name'=> $User->first_name, 'surname' => $User->surname);

        // Mail::send('timesheet.mail', $data, function($message) use ($user_email, $files)
        // {
        //     $message->to($user_email)->subject('Timesheet Report');
        //     // foreach ($files as $file){
        //     //     $message->attach($file);
        //     // }
        // });

        //dd($files);

         Mail::send('timesheet.mail', $data, function($message) use($user_email, $files) {
                $message->to($user_email);
                $message->subject('Timesheet Report');
                $message->from('alainzerowinner@thethoughtfactory.ae','RMS');
                foreach ($files as $file){
                    $message->attach($file);
                }
          });


         // check for failed ones
        if (Mail::failures()) {
             return response()->json(0);
        }

        $update = DB::table('merchant_time_sheet');

        if(!empty($employee_id))
        {
           //dd($employee_id);
            $update->where('employee_id' , $employee_id);

             
        }

        if(!empty($start_date) && !empty($end_date))
        {
            //dd($start_date);

            $startdate = date('Y-m-d', strtotime($start_date));
            $enddate = date('Y-m-d', strtotime($end_date));

            $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);

        }
   
        if(!empty($status))
        {
          
            $result->where('merchant_time_sheet.is_completed' , $status);

        }

        if(!empty($outlet_id))
        {
          
            $result->where('merchant_time_sheet.outlet_id' , $outlet_id);

        }

        $update->update([
                'salesman_approval' => '0',
                'updated_at' => Carbon::now()
        ]);

         return response()->json(1);


    }

    public function export_unshedule(Request $request) {

        //dd($request->specific_date);

        $employee_id = $request->employee_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $type = $request->type;
       
        $matchThese = ['is_active' => '1', 'is_defined' => '0'];

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.is_defined' => '0'];

        $result = merchant_timesheet::where($matchThese)->with('outlet')->with('employee');
        $result->select('merchant_time_sheet.*','store_details.store_name','store_details.store_name');
        $result->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id');
        $result->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');


         $date = \Carbon\Carbon::now();

         $filter_month = $date->format('F');
         $filter_year = $date->format('Y');   
        // dd($filter_year); 


       if(!empty($employee_id))
        {
          
            $result->where('merchant_time_sheet.employee_id' , $employee_id);

        }

        if(!empty($start_date) && !empty($end_date))
        {
            //dd($start_date);

            $startdate = date('Y-m-d', strtotime($start_date));
            $enddate = date('Y-m-d', strtotime($end_date));

            $result->whereBetween('merchant_time_sheet.date', [$startdate, $enddate]);

        }

        $result->orderBy('date', 'DESC');

        $query = $result->get();

        //dd($query);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'S.No');
        $sheet->setCellValue('B1', 'Employee Name');
        $sheet->setCellValue('C1', 'Outlet Id');
        $sheet->setCellValue('D1', 'Date');
        $sheet->setCellValue('E1', 'Outlet Name');
        $sheet->setCellValue('F1', 'Outlet Area');
        $sheet->setCellValue('G1', 'Outlet City');
        $sheet->setCellValue('H1', 'Outlet State');
        $sheet->setCellValue('I1', 'Outlet Country');
        $sheet->setCellValue('J1', 'Status');
        $rows = 2;
        $i = 1;
        foreach($query as $outlet){
        $sheet->setCellValue('A' . $rows, $i);
        $sheet->setCellValue('B' . $rows, $outlet['employee']['first_name'].' '.$outlet['employee']['middle_name'].' '.$outlet['employee']['surname']);
        $sheet->setCellValue('C' . $rows, $outlet['outlet_id']);
        $sheet->setCellValue('D' . $rows, date('d - m - Y',strtotime( $outlet['date']) ));
        $sheet->setCellValue('E' . $rows, $outlet['store_name']);
        $sheet->setCellValue('F' . $rows, $outlet['outlet']['outlet_area']);
        $sheet->setCellValue('G' . $rows, $outlet['outlet']['outlet_city']);
        $sheet->setCellValue('H' . $rows, $outlet['outlet']['outlet_state']);
        $sheet->setCellValue('I' . $rows, $outlet['outlet']['outlet_country']);
        if($outlet['is_completed'] == 1){

            $sheet->setCellValue('J' . $rows, 'completed');
        }
        if($outlet['is_completed'] == 0){

            $sheet->setCellValue('J' . $rows, 'pending');
        }

        
        $rows++;
        $i++;
        }

        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $time = \Carbon\Carbon::now()->format('His');
       // dd($date);

        $fileName = "timesheet-unscheduled-".$date.'-'.$time.'.'.$type;
        //dd($fileName);

        if($type == 'xlsx') {
        $writer = new Xlsx($spreadsheet);
        } else if($type == 'xls') {
        $writer = new Xls($spreadsheet);
        }
        $writer->save("export/timesheet/".$fileName);
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

        $url = "export/timesheet/" .$fileName;

        $files = [$url
           //public_path($url),
           // public_path('/export/test.jpg'),
        ];


         $data = array('first_name'=> $User->first_name, 'middle_name' => $User->middle_name, 'surname' => $User->surname);

        Mail::send('timesheet.mail', $data, function($message) use ($user_email, $files)
        {
            $message->to($user_email)->subject('Timesheet Report');
            foreach ($files as $file){
            $message->attach($file);
        }
        });

         // check for failed ones
        if (Mail::failures()) {
             return response()->json(0);
        }

        $update = DB::table('merchant_time_sheet');
            if(!empty($employee_id))
            {
               //dd($employee_id);
                $update->where('employee_id' , $employee_id);

                 
            }

            if(!empty($request->specific_date))
            {
                $specific_date = date('Y-m-d', strtotime($request->specific_date));

                $update->where('date' , $specific_date);

                 
            }

            if(!empty($request->specific_month) && !empty($request->year) )
            {
                
                 $append_date =  date('Y-m-d', strtotime('01-'.$specific_month));
                 $month_specific = date('Y-m', strtotime($append_date));
                 //dd($month_specific);

                 $update->where(\DB::raw("DATE_FORMAT(date, '%Y-%m')"), $month_specific);

                 //dd($request->year);

                 $update->where( DB::raw('YEAR(date)'), $request->year );

                 $date = Carbon::createFromFormat('Y-m-d', $append_date);

                $filter_month = $date->format('F');
                $filter_year = $date->format('Y'); 

               // dd($filter_year);

            }

                $update->update([
                    'salesman_approval' => '0',
                    'updated_at' => Carbon::now()
             ]);

             return response()->json(1);


    }
    

}

