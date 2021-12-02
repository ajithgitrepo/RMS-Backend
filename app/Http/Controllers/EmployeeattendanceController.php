<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Employee_Reporting_To;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Mail;


class EmployeeattendanceController extends Controller
{
    
   
   public function index(Attendance $model)
    {       
      // dd();
    //dd( $ReportTo);
     $result = DB::table('attendance')
     	->select(array('attendance.*', 'employee.first_name', 'employee.middle_name', 'employee.surname',  DB::raw("SUM(CASE 
            WHEN is_present = '1' THEN 1 ELSE 0 END ) AS present"), DB::raw("SUM(CASE 
            WHEN is_leave = '1' THEN 1 ELSE 0 END ) AS absent") ))
     	->leftJoin('employee', 'employee.employee_id', '=', 'attendance.employee_id')
     	->whereMonth('date', Carbon::now()->month)
     	->groupBy('attendance.employee_id')
        ->orderby('attendance.created_at','DESC')
        ->get();
         
    /*attendance percentage calculation
    
    DB::raw("SUM(CASE 
            WHEN is_present = '1' THEN 1 ELSE 0 END / 26 * 100 ) AS percent") */   

   // dd($result);

    $date = \Carbon\Carbon::now();
    $current_month = $date->format('F'); // January
    $current_year = $date->format('Y'); //2021   

    $month_days = DB::table('working_days')
       ->where('year', $current_year)
       ->where('month', $current_month)
       ->get();
       $specific_month = "";
   // dd($current_month);
   $year = "";$employee_id = "";

    return view('attendance.index', ['attendance' => $result, 'month_days' => $month_days, 'specific_month' => $specific_month, 'year' => $year, 'employee_id' => $employee_id ]);
   
   
    }

    public function exportnew(Request $request) {
        //$Attendance = Attendance::all();
           
        $date = \Carbon\Carbon::now();
        $current_month = $date->format('F'); // January
        $current_year = $date->format('Y'); //2021   

        $month_days = DB::table('working_days')
        ->where('year', $current_year)
        ->where('month', $current_month)
        ->get();
        
      /*  $Attendance = DB::table('attendance')
        ->select(array('attendance.*', 'employee.first_name', 'employee.middle_name', 'employee.surname',  DB::raw("SUM(CASE 
           WHEN is_present = '1' THEN 1 ELSE 0 END ) AS present"), DB::raw("SUM(CASE 
           WHEN is_leave = '1' THEN 1 ELSE 0 END ) AS absent") ))
        ->leftJoin('employee', 'employee.employee_id', '=', 'attendance.employee_id')
        ->whereMonth('date', Carbon::now()->month)
        ->groupBy('attendance.employee_id')
       ->orderby('attendance.created_at','DESC')
       ->get();  */
      
       $employee_id = $request->employee_id;
        $specific_month = $request->specific_month;
        
        $start_month = $request->start_month;
        $end_month = $request->end_month;

      //  dd($employee_id,$specific_month,$end_month,$start_month);

       $month_start = date('Y-m-d', strtotime($start_month));
        $month_end = date('Y-m-d', strtotime($end_month));

       // dd($end_month);
        
        $result = DB::table('attendance')
	     	->select(array('attendance.*', 'employee.first_name', 'employee.middle_name', 'employee.surname',  DB::raw("SUM(CASE 
	            WHEN is_present = '1' THEN 1 ELSE 0 END ) AS present"), DB::raw("SUM(CASE 
	            WHEN is_leave = '1' THEN 1 ELSE 0 END ) AS absent") ))
	     	->leftJoin('employee', 'employee.employee_id', '=', 'attendance.employee_id')
	     	->groupBy('attendance.employee_id')
	        ->orderby('attendance.created_at','DESC');

        if(!empty($employee_id))
        {
            //dd($store);
            $result->where('attendance.employee_id' , $employee_id);
        }

       if(!empty($request->specific_month) && !empty($request->year))
        {
            $append_date =  date('Y-m-d', strtotime('01-'.$specific_month));
             $month_specific = date('Y-m', strtotime($append_date));
             //dd($month_specific);
             $result->where(\DB::raw("DATE_FORMAT(date, '%Y-%m')"), $month_specific);
             $result->where( DB::raw('YEAR(date)'), $request->year );
         }

        $Attendance= $result->get();

		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->setTitle('First tab');
        $sheet->setCellValue('A1', 'Employee Name');
        $sheet->setCellValue('B1', 'Total days');
		//$sheet->setCellValue('C1', 'Working days');
        $sheet->setCellValue('D1', 'Present days');
        $sheet->setCellValue('E1', 'Absent days');
        $sheet->setCellValue('F1', 'Start On Time');  
        $sheet->setCellValue('G1', 'Late');  
        $sheet->setCellValue('H1', 'Over Time');  
        $sheet->setCellValue('I1', 'Attendance %');             
        $rows = 2;
        
      //  dd($sheet->setCellValue );     
		foreach($Attendance as $AttendanceDetails){ 
            $Name =   $AttendanceDetails->first_name. " " .$AttendanceDetails->middle_name. " " .$AttendanceDetails->surname ; 
			$sheet->setCellValue('A' . $rows, $Name);
            $sheet->setCellValue('B' . $rows,  $date->format('t'));
            //$sheet->setCellValue('C' . $rows, $month_days[0]->working_days);
            $sheet->setCellValue('D' . $rows, $AttendanceDetails->present);
			$sheet->setCellValue('E' . $rows, $AttendanceDetails->absent);
            $sheet->setCellValue('F' . $rows, $AttendanceDetails->present);
            $sheet->setCellValue('G' . $rows, '0');
            $sheet->setCellValue('H' . $rows, '0');
            $sheet->setCellValue('I' . $rows, number_format($AttendanceDetails->present / 26  * 100,2));
            $rows++;		
        }	 
        $type = "xls"; 
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $time = \Carbon\Carbon::now()->format('His');
        $fileName = "attendance-".$date.'-'.$time.'.'.$type;

        $spreadsheet->createSheet();
        // Zero based, so set the second tab as active sheet
        $sheet =  $spreadsheet->setActiveSheetIndex(1);
        $spreadsheet->getActiveSheet()->setTitle('Second tab');
        $sheet->setCellValue('A1', 'Employee Name');
        $sheet->setCellValue('B1', 'Total days');
		$sheet->setCellValue('C1', 'Working days');

    
	  //  $fileName = "empsswe3ess.".$type;
		if($type == 'xlsx') {
			$writer = new Xlsx($spreadsheet);
		} else if($type == 'xls') {
            $writer = new Xls($spreadsheet);	
         //   dd($writer);		
        }	
        $url = null;	
		$url = "export/attendance/" .$fileName;
		//dd($url);
        $writer->save("export/attendance/".$fileName);

        $HRid = Auth::user()->emp_id;
    	//dd($HRid);
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $HRid)->first();
        if ($ReportTo !== null) 
        {
        // user doesn't exist
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        //dd($ReportToID); 
        $matchThese = ['employee_id' => $ReportToID, 'designation' => 12];
        $User = Employee::where($matchThese)->first();
      //  dd($User->email);
        
        $user_email = $User->email;
       // $type == "money";
      //  $image = "http://alpinwater.thethoughtfactory.ae/public/assets/images/money.jpg";
      $Mon =   date('F', strtotime($specific_month));
      $Yr =  $request->year;
      $type = "Employee Attendance";
        $data = array('image'=> "", 'month' => $Mon, 'year' => $Yr, 'type' => $type);
        //$attachurl = public_path(). "" .$url;
		//dd($data);
     
        $files = [$url
           //public_path($url),
           // public_path('/export/test.jpg'),
        ];

       Mail::send('attendance.mail', $data, function($message) use ($user_email, $files)
        {
        $message->to($user_email)->subject('Attendance Report');
        foreach ($files as $file){
        $message->attach($file);
        }
        });  

	//	header("Content-Type: application/vnd.ms-excel");
		
       // return redirect(url('/')."/attendance"); 
     //  return redirect()->route('attendance.index')->withStatus(__('Attendance Send to approval successfully')); 
      return response()->json(["status" => true]);  
      }
      else
      return response()->json(["status" => false]); 
     // return redirect()->route('attendance.index')->withStatus(__('You can not send approvel before add reporting to'));
       
    }
  

    public function create()
    {
       return view('attendance.create');
    }

    public function show($id)
    {
	   $leave = attendance::find($id);
        return view('attendance.show',['leave' => $leave]);
    }

    public function edit($id)

    {
    	    	
        $leave = DB::table('attendance')
               ->where('id', $id)
               ->get();
             
        return view('attendance.edit',['attendance' => $leave]);
        
       
    }

   

    public function update(Request $request, $id )

    {
         $request->validate([
           'employee_id' => 'required',   
           'date' => 'required',
            'is_present'=>'required',
            'is_leave'=>'required',
            'checkin_time'=>'required',
             'checkout_time'=>'required',
             'is_leave_approved'=>'required',
             'leave_approved_by'=>'required',
             'remarks'=>'required'
        ]);

  
  	
       $affected = DB::table('attendance')
              ->where('id', $id)
              ->update(['employee_id' => $request->employee_id,'date' => date('y-m-d H:i:s'),'is_present' => $request->is_present,'is_leave' => $request->is_leave,
              'checkin_time'=>time('H:i:s'),'checkout_time'=>time('H:i:s'), 'is_leave_approved'=> $request->is_leave_approved,'leave_approved_by'=>
              $request->leave_approved_by,'created_at'=>date('y-m-d H:i:s'),'updated_at'=>date('y-m-d H:i:s')]);

        return redirect()->route('attendance.index')->withStatus(__('Employee attendance updated successfully'));


    }

  

    public function destroy($id)

    {

        $delete = DB::table('attendance')->where('id', $id)->delete();
    	
        return redirect()->route('attendance.index')->withStatus(__('Employee attendance deleted successfully'));

     
          }    
          
    public function checkin(Request $request)
    {
    
        $date = Carbon::now();

        $time = $date->toDateTimeString();
      
    	 $check =  DB::table('attendance')->where('employee_id',  Auth::user()->emp_id)->whereDate('date', date('Y-m-d'))->count();

        if($check == 0)
          {
              $result =	DB::table('attendance')->insert(
                  array(
                      'employee_id'   => Auth::user()->emp_id,
                      'date' => date('y-m-d H:i:s'),
                      'is_present'   =>   "1" ,
                      'checkin_time' => $time,
                      'updated_at' => date('y-m-d H:i:s'),
                      'created_at' => date('y-m-d H:i:s')
              ));
          }
           else
           {
  
              $result =   DB::table('attendance')
          ->whereDate('date', date('Y-m-d'))
          ->where('is_present', '1')
          ->where('employee_id', Auth::user()->emp_id)
          ->update(
               array(
                 'is_present'   =>   "1" ,
                  'checkin_time' => $time,
                  'updated_at' => date('y-m-d H:i:s')
              ));
           }


            return redirect()->route('home');
                 
    }


    public function checkout(Request $request)
    {
    
        $date = Carbon::now();

        $time = $date->toDateTimeString();
      
      $res = DB::table('attendance')
        ->whereDate('date', date('Y-m-d'))
        ->where('is_present', '1')
        ->where('employee_id', Auth::user()->emp_id)
        ->update(
    	     array(
    	       'is_present'   =>   "1" ,
    		    'checkout_time' => $time,
    		    'updated_at' => date('y-m-d H:i:s')
    		  
         ));
       
        return redirect()->route('home');
    }

   public function filter_attn_report(Request $request)
    {  
        //dd($request->filter_ip_addr);
        //return $request->id;
        $employee_id = $request->employee_id;
        $specific_month = $request->specific_month;
        $start_month = $request->start_month;
        $end_month = $request->end_month;
        $month_start = date('Y-m-d', strtotime($start_month));
        $month_end = date('Y-m-d', strtotime($end_month));
       // dd($end_month);
        $result = DB::table('attendance')
            ->select(array('attendance.*', 'employee.first_name', 'employee.middle_name', 'employee.surname',  DB::raw("SUM(CASE 
                WHEN is_present = '1' THEN 1 ELSE 0 END ) AS present"), DB::raw("SUM(CASE 
                WHEN is_leave = '1' THEN 1 ELSE 0 END ) AS absent") ))
            ->leftJoin('employee', 'employee.employee_id', '=', 'attendance.employee_id')
            ->groupBy('attendance.employee_id')
            ->orderby('attendance.created_at','DESC');
        if(!empty($employee_id))
        {
           //dd($store);
            $result->where('attendance.employee_id' , $employee_id);
        }
        $append_date = null;
        if(!empty($request->specific_month) && !empty($request->year))
        {
             $append_date =  date('Y-m-d', strtotime('01-'.$specific_month));
             $month_specific = date('Y-m', strtotime($append_date));
             //dd($month_specific);
             $result->where(\DB::raw("DATE_FORMAT(date, '%Y-%m')"), $month_specific);
             //dd($request->year);
             $result->where( DB::raw('YEAR(date)'), $request->year );
        }
        //dd($Yr);
        // if(!empty($request->start_month) && !empty($request->end_month) )
        // {
        //   $start_date =  date('Y-m-d', strtotime('01-'.$start_month));
        //   $myArray = explode('-', $end_month);
        //   $end_month = $myArray[0];
        //   $end_year = $myArray[1];
        //   $total_days =  cal_days_in_month(CAL_GREGORIAN, $end_month, $end_year); 
        //   $end_date =  date('Y-m-d', strtotime($total_days.'-'.$request->end_month));
        //     // $month_start = date('Y-m', strtotime($start_date));
        //      //$month_end = date('Y-m', strtotime($end_date));
        //      //dd($end_date);
        //      $result->whereBetween('date', [$start_date, $end_date]);
        //     // dd($query1);
        // }
        $query= $result->get();
        //dd($query);
        //$date =  date('Y-m-d', strtotime('01-'.$specific_month));
      // dd($append_date);
       if( $append_date == null)
       $date = \Carbon\Carbon::now();
       else
        $date = Carbon::createFromFormat('Y-m-d', $append_date);
        $filter_month = $date->format('F');
        $filter_year = $date->format('Y'); 
       // dd($filter_year);
        $month_days = DB::table('working_days')
           ->where('year', $filter_year)
           ->where('month', $filter_month)
           ->get();
           $year = $request->year;
          // dd( $year);
        return view('attendance.index', ['attendance' => $query, 'month_days' => $month_days, 'specific_month' => $specific_month, 'year' => $year, 'employee_id' => $employee_id ]);
    }

  
   } 

