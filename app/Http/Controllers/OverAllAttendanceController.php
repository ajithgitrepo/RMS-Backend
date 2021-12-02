<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OverAllAttendanceController extends Controller
{
    //

    public function index(Attendance $model)
    {       
        
     $model= DB::table('attendance')
     ->where('employee_id',Auth::user()
     ->emp_id)->orderby('created_at','DESC')
     ->get(); 

        $currentMonth = date('m');
        $Result= DB::table('attendance')
        // ->select('date')
        ->where('employee_id',Auth::user()->emp_id)->whereRaw('MONTH(date) = ?',[$currentMonth])
        ->orderby('created_at','DESC')
        ->get();  
      
       $Holiday = DB::table('holidays')->whereRaw('MONTH(date) = ?',[$currentMonth])
        ->get();

         $text = "";
         $Year = date('Y');
         $Month = date('m'); 
         $attendancetable = $this->atterndance_details($text, $Year,  $Month);
  // dd($model);  , 'Holiday' => $$Holiday
     return view('attendance.over_all_emp_attendance.index', ['attendance' => $model,'attendancetable' => $attendancetable, "Year" => $Year, "Month" => $Month ]);
   
    }

    public function overall_atterndance_details(Request $request)
    {
        $text ="";  
        $Year = $request->year; 
        $Month = $request->month;
       // dd($Month);
        $attendancetable =     $this->atterndance_details($text, $Year,  $Month);
      //  dd($attendancetable);
        return view('attendance.over_all_emp_attendance.index', ['attendancetable' => $attendancetable, "Year" => $Year, "Month" => $Month ]);
    }

    public function atterndance_details($text,  $Year,  $Month)
    {
         
        //  $today = today(); 
         // dd($today->month);
         $Year = $Year;
         $Month = $Month;
         $d=cal_days_in_month(CAL_GREGORIAN,$Month,$Year);
         //dd($d);
         $DayCount = $d;
         $Result = array();
         $TotPaidDays = 0;

       $text  .= "<thead>";
       $text  .= "<tr>";
       $text  .= "<td>Employee ID </td>";
       $text  .= "<td> Name </td>";

      for($i=1; $i < $DayCount + 1; ++$i) 
      {
          $dt = strtotime( \Carbon\Carbon::createFromDate( $Year, $Month, $i)->format('Y-m-d'));
          $date = date('j M ', $dt); 
          $pieces = explode(" ", $date); 
          $newdate = $pieces[1]. '- ' .$pieces[0];
          $carbon= \Carbon\Carbon::createFromDate($dt);
          $dy = \Carbon\Carbon::createFromDate($Year,  $Month, $i)->format('l');
          $day =   date('D', strtotime($dy));
         // $Result += array($newdate => $day); 

          $text  .= "<td> <b> $newdate </b> <br><b> $day </b></td>";
       }

        // foreach($Result as $x => $x_value) 
        // {
        //   $text  .= "<td> <b> $x </b> <br><b> $x_value </b></td>";
        // }
        $text  .= "<td> <b>AL</b></td>
        <td><b>SL</b></td>
        <td><b>LOP</b></td>
        <td><b>WD</b></td>
        <td><b>WF</b></td>
        <td><b>PH</b></td>
        <td><b>ML</b></td>
        <td><b>TOTAL PAID <br>DAYS</b></td>";
        $text  .= "</tr>";
        $text  .= "</thead>";
        $text  .= "<tbody>";
        $atten =  \App\Attendance::all();
        $holi =  \App\Holidays::all();
        $emp =  \App\Employee::all();
        $leavreq = \App\Leaverequest::all();
        $week_off = \App\weekoff::all(); 

        $emp = $emp->where("is_active", 1)
        ->where("designation ", "!=", 9);  
       // dd($week_off);
        //DB::table('weekoff');  //->get();
        //\App\weekoff::all(); ->whereRaw('FIND_IN_SET(css,Tags)')
        $count = 0;
    foreach ($emp as $emply)
    {
      $text  .=  "<tr>";
      $text  .=  "<td>";
      $text  .= $emply->employee_id;
      $text  .= "</td>";
      $text  .=  "<td>";
      $text  .= $emply->first_name. " " .$emply->surname;
      $text  .= "</td>";
      $AL = 0; $SL = 0; $LOP = 0; $WD = 0; $WF = 0; $PH = 0; $ML = 0; $Tot = 0;
      $TotLeaveCount = 0; $LType = "";
      for($i=1; $i < $DayCount + 1; ++$i) 
      { // date("Y")."-".$num_padded;          
          $num_padded = sprintf("%02d", $i);
          $make_date = $Year."-". $Month  ."-"   .$num_padded;
         // dd( $make_date);
          $Leave = "";$Present = "";
          $chk = $atten->where("date","=", $make_date)
          ->where("employee_id", $emply->employee_id);
         // ->where("is_active", 1) 
        //  ->where("designation ", "!=", 9);          //->count();


        // if($TotLeaveCount != 0)
        // {
          foreach ($chk as $object)   // Attendance Tbl
          {
           // $count++;
            $Leave = $object->is_leave; 
            $Present = $object->is_present;
          }
        // }
        // else
        // {
        //   $Leave = 1; 
        //   $Present = 0;
        // }
           
          $timestamp = strtotime($make_date);
          $weekday = date("l", $timestamp);
          $MonthName = date("F", $timestamp);
          $MonthNamearray = array($MonthName);
          $Empparray = $emply->employee_id; 
         
               $WeekLeave =  $week_off
               ->where("employee_id", '=', $Empparray)
               ->where("month", '=', $MonthName)
               ->where("day", '=', $weekday)
               ->count();
               //if($Empparray == "Emp9328" && $weekday == "Friday" )
              // dd( $WeekLeave );
        $LevReq = $leavreq->where('leavestartdate', '=', $make_date)->where("employee_id", $emply->employee_id);
        
        // foreach ($LevReq as $lq)
        // {
        //    $TotLeaveCount = $lq->total_days;
        //    $LType = $lq->leavetype;
        //  // if($Empparray == "Emp9328")
        //    // dd($TotLeaveCount);
        // }

            if($WeekLeave == 1)
            {  
              $WF += 1;
              $text  .=  "<td style='color:green;'>WF</td>";
            }
            else if ( $Leave  ==  1  || $TotLeaveCount != 0)
            {
              $LOP += 1;
              $checkl  = 0;

               if( $TotLeaveCount != 0)
               {   //dd($lq->leavetype);
                 if($LType == "Sick_Leave" )
                     $text  .=  "<td style='color:red;'>SL</td>";
                 if($LType == "Loss_Of_Pay" )
                     $text  .=  "<td style='color:red;'>LOP</td>";
                 if($LType == "Maternity_Leave" )
                     $text  .=  "<td style='color:red;'>ML</td>";
                 if($LType == "Annual_Leave" )
                     $text  .=  "<td style='color:red;'>AL</td>";
              }

              foreach ($LevReq as $lq)
              {
                  $TotLeaveCount = $lq->total_days;
                  $LType = $lq->leavetype;
                  if($lq->leavetype == "Sick_Leave" && $lq->is_approved == 2) 
                  {
                      $text  .=  "<td style='color:red;'>SL</td>";  
                  }
                  else if($lq->leavetype == "Loss_Of_Pay")
                  {
                      $text  .=  "<td style='color:red;'>LOP</td>"; 
                  }
                  else if($lq->leavetype == "Maternity_Leave" && $lq->is_approved == 2)
                  {
                      $text  .=  "<td style='color:red;'>ML</td>"; 
                  }
                  else if($lq->leavetype == "Annual_Leave" && $lq->is_approved == 2)
                  {
                      $text  .=  "<td style='color:red;'>AL</td>";
                  }
                  else if( $lq->leavetype != "" && $lq->is_rejected == 1 && $make_date > date('Y-m-d')) 
                  $text  .=  "<td style='color:pink;'>AB</td>"; 
                  else   
                  $text  .=  "<td style='color:pink;'>_</td>";
                    
              } 

            }
            else if ( $Present  ==  1)
            {
              $text  .=  "<td style='color:blue;'>WD</td>"; 
              $WD += 1;
            }
            else  if($Leave  ==  "" && $Present  ==  "")
            {
                $chkholi = $holi->where("date","=", $make_date)->count();
                if($chkholi == 1)
                {
                  $PH += 1; 
                  $text  .=  "<td style='color:orange;'>PH</td>"; 
                } 
                else
                {   
                  if($make_date < date('Y-m-d'))
                  $text  .=  "<td style='color:pink;'>AB</td>"; 
                  else
                  $text  .=  "<td style='color:pink;'>-</td>"; 

                }
            }
            else
            $text  .=  "<td>-</td>"; 
            
           // dd($LevReq);  Sick_Leave  Loss_Of_Pay   Maternity_Leave Annual_Leave
          
            foreach ($LevReq as $lq)
            {
                if($lq->leavetype == "Sick_Leave" && $lq->is_rejected != 1)
                $SL +=  $lq->total_days;
                if($lq->leavetype == "Loss_Of_Pay")
                $LOP +=  $lq->total_days;
                if($lq->leavetype == "Maternity_Leave" && $lq->is_rejected != 1)
                $ML +=  $lq->total_days;
                if($lq->leavetype == "Annual_Leave" && $lq->is_rejected != 1)
                $AL +=  $lq->total_days;
                // if($lq->leavetype == "Sick_Leave")
                // $SL +=  $lq->total_days; 
               
            } 
            if($TotLeaveCount != 0)
            $TotLeaveCount = $TotLeaveCount - 1;
          
          }
        // dd($TotLeaveCount);
             $Tot = $WD + $WF + $PH;
            $text  .=  "<td>$AL</td><td>$SL</td><td>$LOP</td><td>$WD</td><td>$WF</td><td>$PH</td><td>$ML</td><td>$Tot</td>";
            $text  .=  "</tr>";
          }
        //  dd($Empparray);
            $text  .= "</tbody>";

        return $text;
    }
}
