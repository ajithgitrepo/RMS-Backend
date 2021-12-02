<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Employeeleaves;
use App\Role;
use App\User;
use App\Employee;
use App\Leave;
use App\Leaverequest;

use App\Employee_Reporting_To;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Mail;


class EmployeeleavesController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response 

     */

   
   public function index(Employeeleaves $model)
    {       
 
/*
  $twilioURL = "https://api.twilio.com/2010-04-01/Accounts/AC2dc979b4bc8963ed7839c8dcf1bfec42/Messages/MM4d6b3c0da96f159c5c66fc72c5e23096/Media/MEb3b88052356ecfdc81fd7f796a218f24";

      //set the url you're getting from twilio
 // $twilioUrl= $b64image;

  //use some curl to get where that url redirects to
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $twilioURL);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $a = curl_exec($ch);

  //here's that amazon url
  $amazonURL = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
 
  //and now you can do stuff to it like get its contents
  $contents=file_get_contents($amazonURL);

  $imageData =  'data:image/jpg;base64,'.base64_encode($contents);

  $destinationPath = 'leavedocuments/' ;
  list($type, $imageData) = explode(';', $imageData);
  list(,$extension) = explode('/',$type);
  list(,$imageData)  = explode(',', $imageData);
  $fileName = uniqid().'.'.$extension;
  $before_image_url =  $fileName;
  $imageData = base64_decode($imageData);
  file_put_contents($destinationPath .$fileName, $imageData);

  //dd($imageData);
    
      //  $response = stream_get_contents($fp);

      //  $context = context_create_stream($context_options);
  
    //  $context = stream_context_create($opts);
      
           $b64image = "https://s3-external-1.amazonaws.com/media.twiliocdn.com/AC2dc979b4bc8963ed7839c8dcf1bfec42/89d7355e4e25ac3b9babe9d9a13c3284";      
      //   $fp = fopen($b64image, 'r', false, $context);
        //  dd($fp);
           $url =  $b64image;  //'http://yoursite.com/image.jpg';
           $imageData = "";
           $image = file_get_contents($url);
           if ($image !== false){
            $imageData =  'data:image/jpg;base64,'.base64_encode($image);
           
           }

           dd(imageData);
            //  $img = 'leavedocuments/';

        //    $test =  'data:image/jpg;base64,'.base64_encode($imageData);
//dd($imageData);
              $destinationPath = 'leavedocuments/' ;
              list($type, $imageData) = explode(';', $imageData);
              list(,$extension) = explode('/',$type);
              list(,$imageData)  = explode(',', $imageData);
              $fileName = uniqid().'.'.$extension;
              $before_image_url =  $fileName;
              $imageData = base64_decode($imageData);
              file_put_contents($destinationPath .$fileName, $imageData);
 //$res = ( file_get_contents($url));
     // $file->move($destinationPath,$res);
     //dd($res);

              $destinationPath = 'leavedocuments/' ;
              $file->move($destinationPath,$fileName);
              $data[] = $fileName;
              $str = implode(",",$data);
       
*/

      $chk =  DB::table('leaverequest')->where('is_approved', 0)
    ->where('leavestartdate', '<=', Carbon::yesterday()->format('Y-m-d'))
    ->update([
        'is_rejected' => 1,
    ]);  

     //$results = DB::table('leaverequest')->orderby('created_at','DESC')->get(); ->where('is_approved', '!=', 0)
     $results = Leaverequest::with('employee')
     ->where('is_approved', '!=', 0)
      ->orderby('created_at','DESC')->get();
  //dd($results);
     $employee_id = "";$role =""; $startdate = ""; $enddate ="";
     return view('employeeleaves.index', ['employeeleaves' => $results, 'employee_id' => $employee_id,
     'role' => $role, 'startdate' => $startdate, 'enddate' => $enddate]);

    } 

    public function exportnew(Request $request) {
      //$Attendance = Attendance::all();
        
      $date = \Carbon\Carbon::now();
      $current_month = $date->format('F'); // January
      $current_year = $date->format('Y'); //2021   

      $Status = $request->DdlStatus;
      $results = DB::table('leaverequest')->orderby('created_at','DESC');
     
        if($Status  != "")
        {
          if($Status  != "Approved")
          $results->where('is_approved',2 );
          if($Status  != "Rejected")
          $results->where('is_rejected',0 );
        }
       // dd($request->employee_id);
       if(!empty($request->employee_id))
        {
          
           $results->where('employee_id',$request->employee_id);
        }
       
       // $query = $results->get();
        // dd( $query );
        
          $startdate = ($request->startdate);
          $enddate = ($request->enddate);
         
         if (($startdate != null) && ($enddate != null))
          {
             $startdate = date("Y-m-d", strtotime($request->startdate));
             $enddate = date("Y-m-d", strtotime($request->enddate));
             $results->whereBetween('leavestartdate',[$startdate ,$enddate] );
         // $results->whereBetween('leaveenddate',[$startdate ,$enddate] );
           } 
         $query = $results->get();
        // dd($query ); 

  $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', 'Employee ID');
      $sheet->setCellValue('B1', 'Leave Type');
  $sheet->setCellValue('C1', 'From Date');
      $sheet->setCellValue('D1', 'To Date');
      $sheet->setCellValue('E1', 'Total Days');
      $sheet->setCellValue('F1', 'Reason');
      $sheet->setCellValue('G1', 'Documents');  
      
      $rows = 2;
      
    //  dd($sheet->setCellValue );     
  foreach($query as $LeaveDetails){ 
        //  $Name =   $LeaveDetails->first_name ; 
          $sheet->setCellValue('A' . $rows, $LeaveDetails->employee_id);
          $sheet->setCellValue('B' . $rows,  $LeaveDetails->leavetype);
          $sheet->setCellValue('C' . $rows, $LeaveDetails->leavestartdate);
          $sheet->setCellValue('D' . $rows, $LeaveDetails->leaveenddate);
          $sheet->setCellValue('E' . $rows, $LeaveDetails->total_days);
          $sheet->setCellValue('F' . $rows, $LeaveDetails->reason);
          
          $string = $LeaveDetails->supportingdocument;
          $Base = url('/'). "/leavedocuments/" .$LeaveDetails->supportingdocument;

         //// $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i'; 
        //  $Link = "<a href='$Base' target='_blank'>$LeaveDetails->supportingdocument</a>";
         // $stringq = "Look on <a href='http://www.google.com'>http://www.google.com</a>";
      
         // $Repla = "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~";

         // $string = preg_replace($Repla,$Base,$stringq,  );
                    
//dd($Base);
        
          $sheet->setCellValue('G' . $rows, $Base );
          $rows++;		
      }	 
     $type = "xls"; 
     $date = \Carbon\Carbon::now()->format('Y-m-d');
      $time = \Carbon\Carbon::now()->format('His');
     $fileName = "leave-".$date.'-'.$time.'.'.$type;
  //  $fileName = "empsswe3ess.".$type;
  if($type == 'xlsx') {
    $writer = new Xlsx($spreadsheet);
  } else if($type == 'xls') {
          $writer = new Xls($spreadsheet);	
       //   dd($writer);		
      }	
      $url = null;	
  $url = "/export/leave/" .$fileName;
  //dd($url);
      $writer->save("export/leave/".$fileName);

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
    $Mon =   date('F', strtotime($startdate));
    $Yr =  $request->startdate;
    $type = "Employee Leaves";
      $data = array('image'=> "", 'month' => $Mon, 'year' => $Yr, 'type' => $type);
      $attachurl = public_path(). "" .$url;
  //dd($data);

      $files = [
         public_path($url),
         // public_path('/export/test.jpg'),
      ];

     Mail::send('attendance.mail', $data, function($message) use ($user_email, $files)
      {
      $message->to($user_email)->subject('Leave Report');
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


    public function filtervaluesnew(Request $request)
    {  
    //  $results = Attendance::where('is_present',1)->with('employee');
  
   $Status = $request->DdlStatus;
   $results = DB::table('leaverequest')->orderby('created_at','DESC');
      
     if($Status  !== "")
     {
       if($Status  == "Approved")
       $results->where('is_approved',2 );
       if($Status  == "Rejected")
       $results->where('is_rejected',1 );
     }  
 
    if(!empty($request->employee_id))
     {
        $results->where('employee_id',$request->employee_id);
     }
    
    // $query = $results->get();
     // dd( $query );
     
       $startdate = ($request->startdate);
       $enddate = ($request->enddate);
      
      if (($startdate != null) && ($enddate != null))
       {
          $startdate = date("Y-m-d", strtotime($request->startdate));
          $enddate = date("Y-m-d", strtotime($request->enddate));
          $results->whereBetween('leavestartdate',[$startdate ,$enddate] );
      // $results->whereBetween('leaveenddate',[$startdate ,$enddate] );
        } 
      $query = $results->get();
      $employee_id = $request->employee_id; 
      
     return view('employeeleaves.index', ['employeeleaves' => $query, 'employee_id' => $employee_id,
     'role' => $Status, 'startdate' => $startdate, 'enddate' => $enddate]);

     //// $role = DB::table('roles')->get();
     /// return view('dailyattendance.index', ['dailyattendance' => $query ,'position' => $role]);

    }




    
    public function approved(Request $request,$id,$type)
   {

     //  dd($type); 

         $results = DB::table('leaverequest as t')->select('t.*')->where('lrid', $id)->get();
    
         $employee_id = $results[0]->employee_id;
         $start_date = strtotime($results[0]->leavestartdate);
         $end_date = strtotime($results[0]->leaveenddate);
         $leave_type = $results[0]->leavetype;
         $matchThese = [ 'employee_id' => $employee_id, 'is_active' => 1 ];
         //dd($employee_id);

          $date_count = 0;

      for($i = $start_date; $i <= $end_date; $i = $i + 86400 )
      {

            $final_date = date( 'Y-m-d', $i );

            $day =  date('l', strtotime($final_date));
             $month =  date('F', strtotime($final_date));
             $year =  date('Y', strtotime($final_date));

             $week = DB::table('weekoff')->where($matchThese)->where('day', $day )
             ->where('month', $month )->where('year', $year )->get();

           //  if($day == "Wednesday")
           //  dd($week);

        if ($week->isEmpty())
        {

            $holyday = DB::table('holidays')->where('is_active',1)
            ->where('date', $final_date)
            ->get();
            $date_count = 1;
            $holi = false;
            if($holyday->isNotEmpty())
            {
                 // $date_count++;
                  $remark = "Holiday";
                  $Typ = "Annual_Leave";
                //dd($final_date);
                $holi = true;
            }
            if($holyday->isEmpty())
            {
              // $date_count++;
               $remark = $leave_type;
            //    DB::table('leave_balance')
            //       ->where('employee_id', $employee_id)
            //       ->decrement('Annual_Leave',$date_count);
               $Typ = $leave_type;

               if($holi == true)
               $Typ = "Annual_Leave";
            }

            $is_leave_approved = 1;  
             if($leave_type == "Loss_Of_Pay")
             {
                 // $date_count++;
                  $is_leave_approved = 0; 
                  $remark = "Loss of pay";
                  $Typ = "Annual_Leave";
             }

            DB::table('attendance')->insert(
                  array(
                   
                   'date' => $final_date,
                   
                   'employee_id' => $employee_id,
 
                   'is_present'   => "0",
                   
                   'is_leave'   => "1",
                        
                   'is_leave_approved' => $is_leave_approved,
                   
                   'leave_approved_by' => Auth::user()->emp_id,
                   
                   'remarks' => $remark,
                   
                   'updated_at' => date('y-m-d H:i:s'),
 
                   'created_at' => date('y-m-d H:i:s')
                         
             ));

             DB::table('leave_balance')
                    ->where('employee_id', $employee_id)
                    ->decrement($Typ,$date_count);
             
        }
      }

      //   // dd($date_count);
      //   if($leave_type == "Annual_Leave")
      //   {
            
      //   }
      //   if($leave_type == "Sick_Leave")
      //   {
      //       DB::table('leave_balance')
      //       ->where('employee_id', $employee_id)
      //       ->decrement('Sick_Leave',$date_count);
      //   }

         $is_approved = 2;
        if(Auth::user()->designation == 5)
        $is_approved = 1;
            
          $affected = DB::table('leaverequest')
           ->where('lrid', $id)
           ->update(['is_approved' =>$is_approved,'action_by'=>Auth::user()->emp_id]);

    
         return redirect()->route('employeeleaves.index')->withStatus(__('Leave approved successfully..'));
    
      }
      
    public function rejected(Request $request,$id)

    {
   
       $affected = DB::table('leaverequest')
       ->where('lrid', $id)
       ->update(['is_rejected' =>"1",'action_by'=>Auth::user()->emp_id]);
       
     return redirect()->route('employeeleaves.index')->withStatus(__('Leave rejected successfully..'));
          
      
    }
    
   
    
   } 
  

