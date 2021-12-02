<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\Outlet; 
use App\Holidays;
use App\Employee_Reporting_To; 
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;


use App\Leaverequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;

class ApiLeaveController extends Controller
{
    //
    public $success_status = 200;
    public function leave_request(Request $request, Leaverequest $model)
    {
      
       $user =  Auth::user();
      //  $id             =           $request->employeeid;
       if(!is_null($user)) {

            // validation
            $validator      =    Validator::make($request->all(), [
           "emp_id" =>  "required",
           'leavetype'=>'required',
           'leavestartdate'=>'required',
           'leaveenddate'=>'required',
           'reason'=>'required',
          // 'supportingdocument.*'=>'required|mimes:jpeg,jpg,png,doc,docx,pdf'
            ]);

            if($validator->fails()) {
                return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
            }
       
      $newDate  = date("Y-m-d", strtotime($request->leavestartdate));
      $newDate1 = date("Y-m-d", strtotime($request->leaveenddate));

      $date1 =  strtotime($request->leavestartdate);
      $date2 =  strtotime($request->leaveenddate);

      $date_count = 0;

      for($i = $date1; $i <= $date2; $i = $i + 86400 ){
       
        $final_date = date( 'Y-m-d', $i );
       
        $results = DB::table('leaverequest')
        ->where('employee_id',Auth::user()->emp_id)
        ->whereRaw('"'.$final_date.'" between `leavestartdate` and `leaveenddate`')
        ->orderby('created_at','DESC')
        ->count();
        if($results == 1)
        {
            return response()->json(["status" => "failed", "message" => "Whoops! Already Requested.."]);
          
        }
     }

     /*  for($i = $date1; $i <= $date2; $i = $i + 86400 ){

           $final_date = date( 'Y-m-d', $i ); 
      
           $holyday = DB::table('holidays')->where('is_active',1)
           ->where('date', $final_date)
           ->get();

           if($holyday->isNotEmpty())
           {
               $date_count++;
           }

           if($holyday->isEmpty())
           {

           }
           
        }  */

       // dd($date_count);

       $start_date = $request->leavestartdate;
       $end_date = $request->leaveenddate;
       $datetime1 = new DateTime($start_date);
       $datetime2 = new DateTime($end_date);
       $interval = $datetime1->diff($datetime2);
       $days = $interval->format('%a')+1 - $date_count;  //now do whatever you like with $days
       
       //dd($days); 
    //    $user = Auth::user()->emp_id;
    //    $ReportToID = ""; 
    //    $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
    //    if ($ReportTo !== null) 
    //    $ReportToID = $ReportTo->reporting_to_emp_id; 
    
       //    $is_approved = 0;
    //    if(Auth::user()->designation == 5)
    //    $is_approved = 1; 

      // dd($ReportTo);
   // if($ReportTo != "")  image

//    $destinationPath = public_path().'/leavedocuments/' ;
//    $data = $request->image;
//    $filename_path = md5(time().uniqid()).".jpg";
//    list($type, $data) = explode(';', $data);
// list(, $data)      = explode(',', $data);
// $data = base64_decode($data);
// file_put_contents($destinationPath .$filename_path,$data);

//file_put_contents('/tmp/image.png', $data);
    $fileName = "";
    $imageData = $request->image;
    if($imageData != "")
    { //public_path().
      $destinationPath = 'leavedocuments/' ;
      list($type, $imageData) = explode(';', $imageData);
      list(,$extension) = explode('/',$type);
      list(,$imageData)      = explode(',', $imageData);
      $fileName = uniqid().'.'.$extension;
      $imageData = base64_decode($imageData);
      file_put_contents($destinationPath .$fileName, $imageData);
    }

    
   
   /* $image = $request->image;
    $destinationPath = public_path().'/leavedocuments/' ;
    $filename_path = md5(time().uniqid()).".jpg";
    $base64_string = str_replace( $image, '', $image);
    $base64_string = str_replace(' ', '+', $base64_string);
    $decoded = base64_decode($base64_string);
    file_put_contents($destinationPath .$filename_path,$decoded);   */


//$destinationPath = public_path().'/leavedocuments/' ;
 //$str  =  file_put_contents($destinationPath, file_get_contents($image));
//$file->move($destinationPath,$data);
//$data[] = $fileName;
//$str = implode(",",$data);

  // $str  =  file_put_contents($output_file, file_get_contents($base64_string));

  $is_approved = 0;
  $action_by = null;
  if(Auth::user()->role_id == 5)
  $is_approved = 1;
  if(Auth::user()->role->name =="Field Manager")
  {
  $is_approved = 2;
  $action_by = Auth::user()->emp_id;
  }

  $created_by = Auth::user()->emp_id;

  
   $result =   DB::table('leaverequest')->insert(
        array( 
           
           'employee_id'   =>    $request->emp_id,
          // 'reporting_to_emp_id'  =>  $ReportToID,
           'leavetype'   =>   $request->leavetype,
           'leavestartdate'   => $newDate,
           'leaveenddate'   => $newDate1,
           'total_days'   => $days,
           'is_approved' => $is_approved,
           'is_rejected' => '0',
           'reason'   => $request->reason,
           'supportingdocument'   =>  $fileName,
           'action_by' => $action_by,
           //'updated_at' => date('y-m-d H:i:s'),
           'created_at' => date('y-m-d H:i:s'),
           'created_by' =>  $created_by,
           'device' => 'mobile'

        )); 
       
 if(Auth::user()->role->name =="Field Manager")
  {   // Sick_Leave   Sick_Leave Annual_Leave  Comp_off  Week_off Public_holiday
     // $is_approved = 1;
      if($request->leavetype == "Comp_off")
      {
            $date_count = 0;
            $date1 =  strtotime($request->leavestartdate);
      $date2 =  strtotime($request->leaveenddate);
       for($i = $date1; $i <= $date2; $i = $i + 86400 ){
            $date_count++;
             $final_date = date( 'Y-m-d', $i );
            $employee_id = $request->emp_id;
                  DB::table('attendance')->insert(
                        array(
                        
                        'date' => $final_date,
                        
                        'employee_id' => $employee_id,
            
                        'is_present'   => "1",
                        
                        'is_leave'   => "0",
                              
                        'is_leave_approved' => 2,
                        
                        'leave_approved_by' => Auth::user()->emp_id,
                        
                        'remarks' => "comp off",
                        
                        'updated_at' => date('y-m-d H:i:s'),
            
                        'created_at' => date('y-m-d H:i:s')
                              
                  ));
            }
          //  DB::table('leave_balance')
           //       ->where('employee_id', $employee_id)
            //      ->decrement('Annual_Leave',$date_count);

      }
      if($request->leavetype == "Public_holiday")
      {

            // for($i = $date1; $i <= $date2; $i = $i + 86400 ){
       
            //       $final_date = date( 'Y-m-d', $i );
            //       $results = DB::table('leaverequest')
            //       ->where('employee_id',Auth::user()->emp_id)
            //       ->whereRaw('"'.$final_date.'" between `leavestartdate` and `leaveenddate`')
            //       ->orderby('created_at','DESC')
            //       ->count();
            //       if($results == 1)
            //       {
            //           return response()->json(["status" => "failed", "message" => "Whoops! Already Requested.."]);
                     
            //       }
            //    }

      }
      if($request->leavetype == "Week_off")
      {
            $date1 =  strtotime($request->leavestartdate);
            $date2 =  strtotime($request->leaveenddate);
            for($i = $date1; $i <= $date2; $i = $i + 86400 ){
                  $final_date = date( 'Y-m-d', $i );
                 // $day =    date('D', $final_date);
                  $day =  date('l', $final_date);
                  $month =  date('F', $final_date);
                  $year =  date('Y', strtotime($final_date));

            DB::table('weekoff')->insert(
                        array(
                              
                              'employee_id'   => $request->emp_id,
                              'month'   =>  $month,
                              'day' => $day,
                              'year' => $year,
                              'updated_at' => date('y-m-d H:i:s'),
                              'created_at' => date('y-m-d H:i:s')

                        )
                  ); 

            }

           // return response()->json(["status" => "failed", "success" => false, "message" => $year ]);

      }
      if($request->leavetype == "Sick_Leave" || $request->leavetype == "Annual_Leave")
      {

            $date_count = 0;
            $date1 =  strtotime($request->leavestartdate);
      $date2 =  strtotime($request->leaveenddate);
       for($i = $date1; $i <= $date2; $i = $i + 86400 ){
            $date_count++;
             $final_date = date( 'Y-m-d', $i );
         
        
            }
             $employee_id = $request->emp_id;
            DB::table('leave_balance')
                  ->where('employee_id', $employee_id)
                  ->decrement('Annual_Leave',$date_count);
  }
  }

        $notify = new ApiNotificationController();
        
        $ReportToID = "Emp5906";
        if(Auth::user()->role_id != 5)
        {
          $user = Auth::user()->emp_id;
         $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
        if( $ReportTo != "")
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        }
        else
        {
          $emp =   DB::table('employee')  
                   ->where('employee.is_active', 1)
                   ->where('employee.designation', 3)->get();

           $ReportToID = $emp[0]->employee_id;

        }
      
        $title = "Leave request from merchandiser";
        if(Auth::user()->role_id == 5)
        $title = "Leave request from field manager";
        $user_type = "merchandiser";
       
        $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);

        $description = "requested for leave". " " ."from ". $start_date. "" ." to " .$end_date;
		$add_notify =  $notify->add_audit_trails($description, "Leave_Request");

        if(!is_null($result)) {  
            return response()->json(["status" => $this->success_status, "success" => true, "data" => $result]);
        }
        else
        return response()->json(["status" => "failed", "success" => false, "message" => $result ]);

    }
    else {
        return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    }  
}  

public function leave_details(Request $request, Leaverequest $model)
{

    $chk =  DB::table('leaverequest')->where('is_approved', 0)
    ->where('leavestartdate', '<=', Carbon::yesterday()->format('Y-m-d'))
    ->update([
        'is_rejected' => 1,
    ]);   

  $user =  Auth::user();
 //  $id             =           $request->employeeid;
  if(!is_null($user)) {
   // validation
    //    $validator      =    Validator::make($request->all(), [
    //   "emp_id" =>  "required",
    //    ]);

    //    if($validator->fails()) {
    //        return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
    //    }
    //dd($day);
     $matchThese = [ 'employee_id' => $request->emp_id ];

    $result = Leaverequest::with([
        'employee'  => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
        }
    ])->orderBy('created_at', 'desc');
    if($request->emp_id != "")
    $result->where($matchThese);
    
    $result = $result->get();
    if(!is_null($result)) {  
        return response()->json(["status" => $this->success_status, "success" => true, "data" => $result]);
    }
    else
    return response()->json(["status" => "failed", "success" => false, "message" => $result ]);

    }
    else {
    return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    }  

}


public function leave_details_view_by_fieldmanager(Request $request, Leaverequest $model)
{

    $chk =  DB::table('leaverequest')->where('is_approved', 0)
    ->where('leavestartdate', '<=', Carbon::yesterday()->format('Y-m-d'))
    ->update([
        'is_rejected' => 1,
    ]);   

  $user =  Auth::user();
 //  $id             =           $request->employeeid; 'created_by' => Auth::user()->emp_id 
  if(!is_null($user)) {

      $date1 =  strtotime($request->from_date);
      $date2 =  strtotime($request->to_date);
   
     $matchThese = [ 'employee_id' => $request->emp_id, 'is_active' => 1 ];
     
             $arrayleave = array();
             $test = "";
         for($i = $date1; $i <= $date2; $i = $i + 86400 ){
         
             $final_date = date( 'Y-m-d', $i );

             $test = $test .$final_date ;

             $day =  date('l', strtotime($final_date));
             $month =  date('F', strtotime($final_date));
             $year =  date('Y', strtotime($final_date));
           
      //      $sd = date("Y-m-d", strtotime($request->from_date));
      //        $result= DB::table('leaverequest')
      //        ->whereRaw('"'.  $sd.'" between `leavestartdate` and `leaveenddate`')
      //        ->get();
               
      $sd = date("Y-m-d", strtotime($request->from_date));
      $ed = date("Y-m-d", strtotime($request->from_date));
        
        $result = Leaverequest::with([
            'employee'  => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
            }
      ])->where($matchThese )->whereRaw('"'.$final_date.'" between `leavestartdate` and `leaveenddate`')
     // ->whereRaw('"'.$ed.'" between `leavestartdate` and `leaveenddate`')
      //->where($matchThese )->whereDate('leavestartdate', '>=', $request->from_date)->whereDate('leaveenddate', '<=', $request->to_date)
      //->whereRaw('"'.$date1.'" between `leavestartdate` and `leaveenddate`')
     // ->whereDate('leavestartdate', $final_date)
      ->orderBy('created_at', 'desc')->get();
    //  $arrayleave[] =  $result ;
      if ($result->isNotEmpty())
            {   
                  $date11 =  strtotime($result[0]->leavestartdate);
                        $date22 =  strtotime($result[0]->leaveenddate);
                        for($j = $date11; $j <= $date22; $j = $j + 86400 ){

                        $final_date1 = date( 'Y-m-d', $j );

                        $arrayleave[] = array('leavestartdate' => $final_date1,
                        'leavetype' => $result[0]->leavetype,
                        'employee_id' => $request->emp_id
                        );

                        }

            } 
            else
            {  


           $week = DB::table('weekoff')->where($matchThese)->where('day', $day )
           ->where('month', $month )->where('year', $year )->get();
          // ->get();
          // if($day == "Thursday")
        #   return response()->json(["status" => $day, "success" => $month, "data" => $year]);
           //
            
                  if ($week->isNotEmpty())
                  {
                       // $arrayleave[] = "";

                         $arrayleave[] =  array('leavestartdate' => $final_date,
                                                 'leavetype' => "Week off",
                                                 'employee_id' => $request->emp_id
                                                );
                  }
           
        
            }
      }


      $result = array();
foreach ($arrayleave as $key => $value){
  if(!in_array($value, $result))
    $result[$key]=$value;
}

   
      //$array = array_unique($arrayleave);
    if(!is_null($arrayleave)) {  
        return response()->json(["status" => $this->success_status, "success" => true, "data" => $result]);
    }
    else
    return response()->json(["status" => "failed", "success" => false, "message" =>'$arrayleave' ]);

    }
    else {
    return response()->json(["status" => "failed", "message" => "Whoops! invalid auth token"]);
    }  

}

public function merchandiser_leave_details(Request $request, Leaverequest $model)
{
   
    $chk =  DB::table('leaverequest')->where('is_approved', 0)
    ->where('leavestartdate', '<=', Carbon::yesterday()->format('Y-m-d'))
    ->update([
        'is_rejected' => 1,
    ]);   

    $user =  Auth::user();
 //  $id             =           $request->employeeid;
    $printReport = new ApiJourneyPlanController();
    $chk =  $printReport->chech_auth($user);
    
    if($chk == false)
    return $printReport->auth_error_msg();
  
     $matchThese = [ 'employee_reporting_to' =>Auth::user()->emp_id ];

     $searchMer = "Merchandiser"; 

     $merchandisers = DB::table('employee')  
  ->leftJoin('employee_reporting_to', 'employee.employee_id', '=', 'employee_reporting_to.employee_id')
  ->where('employee.is_active', 1)
  //->leftjoin('roles', 'employee.designation', 'roles.id')
  //->where('designation', 6)  
 // ->where('roles.name', 'like',  DB::raw("'%$searchMer%'"))
 ->where('employee_reporting_to.reporting_to_emp_id', $matchThese)
  ->pluck('employee_reporting_to.employee_id')->all();

  $result = Leaverequest::whereIn('employee_id', $merchandisers)->with([
    'employee'  => function($query) { 
        $query->select(['employee_id','first_name','middle_name','surname']);
    }           
])   //->whereRaw('MONTH(created_at) = ?',[$currentMonth])  
    //->
    //->where('is_approved', 0)
    ->orderBy('created_at', 'desc')
    ->get();

    
    return $printReport->send_result_msg($this->success_status, $result);

}

public function leave_accept_reject(Request $request, Holidays $model)
{
    
    $user  =  Auth::user();
    $printReport = new ApiJourneyPlanController();
    $chk =  $printReport->chech_auth($user);
    
    if($chk == false)
    return $printReport->auth_error_msg();
 
       // validation
        $validator      =    Validator::make($request->all(), [
         'id' =>  "required",  
        'is_approved'=>'required|integer',
        'is_rejected'=>'required|integer',
        'action_by' => Auth::user()->emp_id
      ]);

       if($validator->fails()) {
        return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
    } 
 
if($request->is_approved == 2 )
  {
    $id = $request->id;
    $results = DB::table('leaverequest as t')->select('t.*')->where('lrid', $id)->get();
    
    $employee_id = $results[0]->employee_id;
    $start_date = strtotime($results[0]->leavestartdate);
    $end_date = strtotime($results[0]->leaveenddate);
     $type =  $results[0]->leavetype;
     $leave_type = $results[0]->leavetype;
    //dd($employee_id);

     $date_count = 0;

    for($i = $start_date; $i <= $end_date; $i = $i + 86400 ){

       $final_date = date( 'Y-m-d', $i );

     //  $final_date = date( 'Y-m-d', $i );

            $day =  date('l', strtotime($final_date));
             $month =  date('F', strtotime($final_date));
             $year =  date('Y', strtotime($final_date));
             $matchThese = [ 'employee_id' => $employee_id, 'is_active' => 1 ];
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

    /*   $holyday = DB::table('holidays')->where('is_active',1)
       ->where('date', $final_date)
       ->get();

       if($holyday->isNotEmpty())
       {
           //dd($final_date);
       }
       $is_leave_approved = 1; 
        if($type == "Loss_Of_Pay")
        {
         $is_leave_approved = 0; 
        }
         
       if($holyday->isEmpty())
       {
           DB::table('attendance')->insert(
            array(
             
             'date' => $final_date,
             
             'employee_id' => $employee_id,

             'is_present'   =>"0",
             
             'is_leave'   =>"1",
                  
             'is_leave_approved' => $is_leave_approved,
             
             'leave_approved_by' => Auth::user()->emp_id,
             
             'remarks' => "take care",
             
             'updated_at' => date('y-m-d H:i:s'),

             'created_at' => date('y-m-d H:i:s')
                   
                   
           ));

           $date_count++;

       } */
       
    }

   // dd($date_count);

    DB::table('leave_balance')
       ->where('employee_id', $employee_id)
       ->decrement('Annual_Leave',$date_count);

        $is_approved = 2;
    if(Auth::user()->designation == 5)
    $is_approved = 1;

    $notify = new ApiNotificationController();
       
    $ReportToID = $employee_id; 
  
    if($is_approved == 2)
    {
        $title = "HR accept merchandiser leave request";
        $user_type = "hr";
    }
    if($is_approved == 1)
    {
        $title = "Field Manager accept your leave request and waiting for HR approval";
        $user_type = "field_manager";
    }
    if($is_rejected == 1)
    {
        $title = "Field Manager reject your leave request";
        $user_type = "field_manager";
    }
   
    $add_notify =  $notify->add_notification($title, $user_type, $ReportToID);
    $emp_id = Auth::user()->emp_id;
              $name = Auth::user()->name;
             // $role = Auth::user()->role->name;
        $desc = $emp_id. " " .$name. " " .$title;
    $add_notify1 =  $notify->add_audit_trails( $desc, "Leave_status");
      
  }
         $data =  array(
            'is_rejected'   =>  $request->is_rejected,
            'is_approved'   =>  $request->is_approved,
            'updated_at' => date('y-m-d H:i:s'),
            'action_by' => Auth::user()->emp_id
            );  
          
        $result =  DB::table('leaverequest')->where('lrid', $request->id)->update($data);
       
        return $printReport->send_result_msg($this->success_status, $result);
  
}


public function leave_rule_details(Request $request, Outlet $modal)
    {
         
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $matchThese = ['is_active' => '1'];
        
        $result = DB::table('leave_rule')->where('is_active',1)->orderby('created_at','DESC')->get();
       
        return $printReport->send_result_msg($this->success_status, $result);

    }

    public function update_leave_rule(Request $request)
    {
        
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
             "leave_id" =>  "required",
           
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

        //  $result = $model->create($request->all()); 
        
            $result = DB::table('leave_rule')
            ->where('leave_rule_id',  $request->leave_id )
            ->update([
            'total_days' => $request->total_days,
            'remarks' => $request->remarks,
             'updated_at' => date('y-m-d H:i:s')
           ]);

           $notify = new ApiNotificationController();
           $add_notify =  $notify->add_audit_trails("Leave Rule", "Leave Rule");

            return $printReport->send_result_msg($this->success_status, $result);
      
    }


}
