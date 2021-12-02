<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mannual_Attendance;
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


class MannualattendanceController extends Controller
{
    
   
   public function index(Attendance $model)
    {       
       
  
       $result = DB::table('attendance')
     	->select(array('attendance.*', 'employee.first_name', 'employee.middle_name', 'employee.surname' ))
     	->leftJoin('employee', 'employee.employee_id', '=', 'attendance.employee_id')
        ->whereMonth('attendance.date', Carbon::now()->month)
     	//->groupBy('attendance.employee_id')
       // ->orderby('attendance.created_at','DESC')
        ->get();

  // dd($result);

    return view('mannual_attendance.index', ['attendance' => $result]);
   
   
    }

    public function create()
    {
    
    $employee  = DB::table('employee')->where('is_active',1)->get();
 
  //dd( $employee );
  //$attendance=DB::table('attendance')->where('is_active',1)->get();
     
       return view('mannual_attendance.create',['emp_att' => $employee]);
    }

    public function store(Request $request)
    {
    
        //dd($request->all());

        $request->validate([
            'employee_id' => 'required',
            'date'=>'required',
            'checkin_time'=>'required',
            'checkout_time'=>'required',
            
        ]);

     $newDate  = date("Y-m-d", strtotime($request->date));


        DB::table('attendance')->insert(
	     array(
		    
		    'employee_id' => $request->employee_id,
	        'date' => $newDate,
	        'is_present' => "1",
            'checkin_time'=> $request->checkin_time, // date("H:i:s", strtotime(request('checkin_time'))),
            'checkout_time'=>$request->checkout_time, // date("H:i:s", strtotime(request('checkout_time'))), 
            'created_at'=>date('y-m-d H:i:s'),
            'updated_at'=>date('y-m-d H:i:s')

	     ));
	    
     return redirect()->route('mannual_attendance.index')->withStatus(__('mannual attendance created successfully'));

       }
   
     
 

    public function show($id)

    {
	$leave = attendance::find($id);
        return view('mannual_attendance.show',['leave' => $leave]);
        

    }

    public function edit($id)

    {
    	 $employee  = DB::table('employee')->where('is_active',1)->get();  	
         $leave = DB::table('attendance')->where('id', $id)->get();
               
             
        return view('mannual_attendance.edit',['attendance' => $leave,'employee'=>$employee]);
        
       
    }

   

    public function update(Request $request, $id )

    {
 
  	 $newDate  = date("Y-m-d", strtotime($request->date));
  	 
       $affected = DB::table('attendance')
              ->where('id', $id)
              ->update([
              'employee_id' => $request->employee_id,
              'date' => $newDate,
              'is_present' => "1",
              
              'checkin_time'=> $request->checkin_time, // date("H:i:s", strtotime(request('checkin_time'))),
              'checkout_time'=>$request->checkout_time, // date("H:i:s", strtotime(request('checkout_time'))),
                
              'created_at'=>date('y-m-d H:i:s'),
              'updated_at'=>date('y-m-d H:i:s')]);

        return redirect()->route('mannual_attendance.index')->withStatus(__('Mannual Attendance Updated Successfully..'));


    }

  

    public function destroy($id)

    {

        $delete = DB::table('attendance')->where('id', $id)->delete();
    	
        return redirect()->route('mannual_attendance.index')->withStatus(__('mannual attendance deleted successfully'));

     
          }   
          
  }
