<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Outlet; 
use App\Store_details;  
use App\merchant_timesheet;
use App\Employee_Reporting_To;


use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OverJourneyPlanController extends Controller
{
    //

    public function index(Attendance $model)
    {       
        
    //  $model= DB::table('attendance')
    //  ->where('employee_id',Auth::user()
    //  ->emp_id)->orderby('created_at','DESC')
    //  ->get(); 

        // $currentMonth = date('m');
        // $Result= DB::table('attendance')
        // // ->select('date')
        // ->where('employee_id',Auth::user()->emp_id)->whereRaw('MONTH(date) = ?',[$currentMonth])
        // ->orderby('created_at','DESC')
        // ->get();  
      
     //  $Holiday = DB::table('holidays')->whereRaw('MONTH(date) = ?',[$currentMonth])
       // ->get();
//dd();
         $text = "";
         $Year = date('Y');
         $Month = date('m'); 
         $joureytable = $this->all_journey_details($text, $Year,  $Month);
  // dd($joureytable); // , 'Holiday' => $$Holiday
     return view('outlet.over_all_journeyplan.index', ['joureytable' => $joureytable, "Year" => $Year, "Month" => $Month ]);
   
    }

    public function overall_journey_details(Request $request)
    {
        $text ="";  
        $Year = $request->year; 
        $Month = $request->month;
       // dd($Month);
        $joureytable =   $this->all_journey_details($text, $Year,  $Month);
       // dd($joureytable);
        return view('outlet.over_all_journeyplan.index', ['joureytable' => $joureytable, "Year" => $Year, "Month" => $Month ]);
    }

    public function get_all_employees(Request $request)
   {

    $match=['is_active' => '1'];

   // $leave=->get(); 
            
      //  $Res = Employee::where($match);
      //  if($request->Empid != "All")
      //  $leave =   $leave->where('employee_id', $request->Empid);
      //  $Res =   $Res->get();

      $matchThese = ['is_active' => '1']; $searchMer = "Merchandiser"; 
   
     /* $Merchresult = Employee_Reporting_To::where('reporting_to_emp_id', Auth::user()->emp_id)
      ->where($matchThese)->with([
    'employee_reporting_to'  => function($query) {
      $query->select(['employee_id','first_name', 'middle_name','surname']);
    }
   ])->pluck('employee_id'); // dd($Merchresult);  */

   $Res = DB::table('employee')
   //->whereIn('employee.employee_id',$Merchresult)
   ->leftjoin('roles', 'employee.designation', 'roles.id')
   ->where('roles.name', 'like',  DB::raw("'%$searchMer%'"))->get();
             
      //  return view('leave.index',['leave' => $leave]);
      return response()->json($Res);
        
       
    }


    public function add_over_journey_plan(Request $request)
    {
      // dd($request->id);
    //  dd($request->outletDate);
            
          $check = DB::table('merchant_time_sheet')
          ->where('outlet_id', $request->outlet_id)
          ->where('employee_id', $request->emp_id) 
          ->where('date', $request->outletDate)
        //  ->where('is_active', 1)
          ->get();

      // dd($check);

        if ($check->isEmpty()) {  
              if($request->outletDate != "0000-00-00")
              {
                $ReportToID = DB::table('employee_reporting_to')->where('employee_id', '=', $request->emp_id)->get();
                if($ReportToID->isEmpty())
                $created_by = Auth::user()->emp_id;
                else
                $created_by = $ReportToID[0]->reporting_to_emp_id;
            
                     $outlet = array(
                                'employee_id' => $request->emp_id, //$request->employee_id,
                                'date' => $request->outletDate,
                                'outlet_id' => $request->outlet_id,
                                'scheduled_calls' => 1,
                                'is_defined' => 1, 
                                'is_active' => '1',
                                'created_at' => Carbon::now(),
                               // 'updated_at' => Carbon::now(),
                                 'created_by' => $created_by,
                            );  
                    $affected =  DB::table('merchant_time_sheet')->insert($outlet);
              }
           
         }
        else if( $check[0]->is_active == 1 && $request->outletDate != "0000-00-00")
        {
           $affected = DB::table('merchant_time_sheet')
                ->where('outlet_id', $request->outlet_id)
                    ->where('employee_id', $request->emp_id) 
                    ->where('date', $request->outletDate)
                ->update([
                    'is_active' => '0',
                    'updated_at' => Carbon::now()
             ]);  
        }
       
        else if( $check[0]->is_active == 0 && $request->outletDate != "0000-00-00")
        {
           $affected = DB::table('merchant_time_sheet')
                ->where('outlet_id', $request->outlet_id)
                    ->where('employee_id', $request->emp_id) 
                    ->where('date', $request->outletDate)
                ->update([
                    'is_active' => '1',
                    'updated_at' => Carbon::now()
             ]);
        }


        return response()->json($affected);
 
       //  return redirect()->route('leavebalance.index')->withStatus(__('leavebalance updated successfully'));
     
 
     }



     
    public function remove_over_journey_plan(Request $request)
    {
      // dd($request->id);

           $affected = DB::table('merchant_time_sheet')
                ->where('outlet_id', $request->outlet_id)
                    ->where('employee_id', $request->emp_id) 
                   // ->where('date', $request->outletDate)
                   ->whereRaw('MONTH(date) = ?',[$request->month])
                   ->whereYear('date', $request->year)

                ->update([
                    'is_active' => '0',
                    'updated_at' => Carbon::now()
             ]);
       

        return response()->json($affected);
 
       //  return redirect()->route('leavebalance.index')->withStatus(__('leavebalance updated successfully'));
     
 
     }

     public function all_journey_details($text,  $Year,  $Month)
    {
         
        //  $today = today(); 
         //dd($today->month);
         $Year = $Year;
         $Month = $Month;
         $d=cal_days_in_month(CAL_GREGORIAN,$Month,$Year);
         //dd($d);
         $DayCount = $d;
         $Result = array();
         $TotPaidDays = 0;

       $text  .= "<thead>";
       $text  .= "<tr >";
       $text  .= "<td class='thead'> </td>";
       $text  .= "<td class='thead' style='color:rose'><b>Outlet </b> </td>";
       $text  .= "<td class='thead'><b>Merchandiser </b></td>";

      for($i=1; $i < $DayCount + 1; ++$i) 
      {
          $dt = strtotime( \Carbon\Carbon::createFromDate( $Year, $Month, $i)->format('Y-m-d'));
          $date = date('j M ', $dt); 
          $pieces = explode(" ", $date); 
          $newdate = $pieces[1];  //. '- ' .$pieces[0];
          $carbon= \Carbon\Carbon::createFromDate($dt);
          $dy = \Carbon\Carbon::createFromDate($Year,  $Month, $i)->format('l');
          $day =  date('D', strtotime($dy));
         // $Result += array($newdate => $day); 

          $text .= "<td class='thead'> <b> $newdate </b> <br><b> $day </b></td>";
       }

 
       $join_journey =  DB::table('outlet')
    ->select('store_details.store_name  as outlet_name',
    'store_details.store_code',
    'outlet.outlet_id',
    'merchant_time_sheet.employee_id',
    DB::raw('group_concat(merchant_time_sheet.date) as date'),
    //GROUP_CONCAT('merchant_time_sheet.date'),
    //'merchant_time_sheet.date',
    'employee.first_name')
   ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');
   //->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id');

    
    $join_journey = $join_journey->crossJoin('merchant_time_sheet', function ($join) {
      $join->on('outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id');
     });

  $join_journey = $join_journey->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id');
  $join_journey = $join_journey->where('merchant_time_sheet.is_active',1);
  $join_journey =  $join_journey->where('outlet.is_active',1)
  ->whereMonth('merchant_time_sheet.date', '=', $Month)
  //->whereRaw('MONTH(merchant_time_sheet.date) = ?',[$Month])
  ->whereYear('merchant_time_sheet.date', $Year)
  ->groupBy('outlet.outlet_id')
  ->groupBy('merchant_time_sheet.employee_id');
    
    $DummyClone = clone $join_journey;
    $DummyClone1 = clone $join_journey;
    $Merch_outlet_id = $DummyClone->pluck('merchant_time_sheet.outlet_id')->toArray();

    $res2 = $DummyClone1->get()->toArray();
 //dd($res2);
  //  $join_journey1 =  DB::table('outlet')  
  //  ->select('outlet.outlet_id')
   

   $join_journey1 = DB::table('outlet')->select('outlet.outlet_id','store_details.store_code',
   'store_details.store_name  as outlet_name')
   ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
   ->whereNotIn('outlet_id', $Merch_outlet_id)->where('outlet.is_active',1);
  //  ->orderby('created_a t','DESC');
 
    $join_journey1 = $join_journey1
    ->addSelect(DB::raw("'employee_id' as employee_id, 
    'date' as date, 'employee_name' as first_name"))->get();
    
//     $paginator = $join_journey1;
    
//     $links = $paginator;
    
//     $convert_paginate_to_array = $paginator->getCollection()->transform(function ($value) {
    
//          return $value;
// });
//dd($test);

   $res1 = $join_journey1->toArray();;
    // dd($res1);

    $output = array_merge($res1,$res2);
//dd($output);
        $text  .= "</tr>";
        $text  .= "</thead>";
        $text  .= "<tbody>";
       // $atten =  \App\Attendance::all();
     //    $holi =  \App\Holidays::all();
     //   $emp =  \App\Employee::all();
       // $leavreq = \App\Leaverequest::all();
     //   $week_off = \App\weekoff::all(); 
     //   $outlet = \App\Outlet::all();
      //  $store = \App\Store_details::all();  
      //  $time_sheet = \App\merchant_timesheet::all();
      
     //   $outlet = $outlet->where('created_by', Auth::user()->emp_id);

        $count = 0;  $tes = "";
    foreach ($output as $out)  
    {  
    //  if($out->date != "date")
     // dd($out->date);
      /* $check = false;
      for($i=1; $i < $DayCount + 1; ++$i) 
      {
        if($check == false)
        {
          $num_padded = sprintf("%02d", $i);
        $chkmonth = $Year."-". $Month  ."-"   .$num_padded;
        $merch = $time_sheet->where('outlet_id', $out->outlet_id)
        ->where('is_active', 1)->where('date', '=',  $chkmonth);

     //   $tes .= $i ;
       // ->where('created_by', Auth::user()->emp_id);;
      
        $empID = "";$empFstName = "";
        $outID = $out->outlet_id;
        foreach ($merch as $mer)
        {
          $empID = $mer->employee_id;
          $outID = $mer->outlet_id; 
         //  dd($outID);
          $empFstName = Employee::find($mer->employee_id)->first_name;
          // dd($empID); 
        }
        if($empID != "" &&  $outID != "")
        {
          $check = true; 
         // dd($outID); 
        //  break 1;
        
        }
      }
          
     } */
    // dd($out->outlet_id);

     $outID = $out->outlet_id;
     $empID = $out->employee_id;
     if($empID == "employee_id")  
     $empID = "";
     $date = $out->date;

     $first_name = $out->first_name;
     $outlet_name = $out->outlet_name;
     $store_code = $out->store_code;

    // if( $out->outlet_name == "LULU EXPRESS UAQ" && $empID == "RMS0077")
     //  dd($output);
    
     $text  .= $this->bind_jp_details($outID,  $outlet_name, $store_code, $empID, $first_name, $date, $Month, $DayCount, $Year);
 
 /* if($out->employee_id != "employee_id")
  {
// Multiple merchandiser
      $multimerch_check =   DB::table('merchant_time_sheet')
      ->select('store_details.store_name  as outlet_name',
    'outlet.outlet_id',
   // 'merchant_time_sheet.employee_id',
   'merchant_time_sheet.employee_id',
   DB::raw('group_concat(merchant_time_sheet.date) as date'),
    //GROUP_CONCAT('merchant_time_sheet.date'),
   // 'merchant_time_sheet.date',
    'employee.first_name');
   //dd($out->employee_id);
    ////$multimerch_check = $multimerch_check->crossJoin('merchant_time_sheet', function ($join) {
    
    $multimerch_check = $multimerch_check->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
  ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name');;

  $multimerch_check = $multimerch_check->leftJoin('employee', 'employee.employee_id', '=', 'merchant_time_sheet.employee_id')
      ->where('merchant_time_sheet.outlet_id', $out->outlet_id)
  // ->where('merchant_time_sheet.employee_id',  $out->employee_id)
      // ->whereNotIn( 'merchant_time_sheet.employee_id', [$out->employee_id])
      ->where('merchant_time_sheet.is_active', 1) 
      ->where('outlet.is_active', 1)  
      ->whereMonth('merchant_time_sheet.date', '=', $Month)
      ->whereYear('merchant_time_sheet.date', $Year)
      ->groupBy('merchant_time_sheet.employee_id')
      ->get(); 

      if($multimerch_check->isNotEmpty())
      {   
        foreach ($multimerch_check as $mult)
        {
          $re = $mult->employee_id   .$out->employee_id;
         // dd($multimerch_check);
       
     if( $mult->employee_id != $out->employee_id)
      {
       // if( $mult->outlet_name == "LULU EXPRESS UAQ" && $mult->employee_id != "RMS0077" )
       // dd($mult->employee_id);
        
        $text  .=  "<tr class='tr'>"; 
        $text  .=  "<td><input type='checkbox'/>"; 
        $text  .=  "</td>";
       
       $text  .=  "<td class='t_outlet' style='color:blue'><input type='hidden' value='$outID'></input>";
       $text  .=  $outlet_name; //$outlet->outlet_name;
       $text  .= "</td>"; 
       $text  .=  "<td class='t_emp' style='color:orange'><input type='hidden' value=".$mult->employee_id."></input>";
      if($empID == "")  
       $text  .=  "<select class='jSelectbox employeeddl'><option value=''>Add Merchandiser &nbsp;&nbsp;&nbsp;</option><select>";
       else
       {
       $text  .= $mult->employee_id. " " .$mult->first_name;
  
      
      // if( $empID != "")
     //dd( $out->first_name);
       
       //if($out->first_name ==  "BIBEK")
       //dd($date);
       //  $currentMonth = date('m');
       $today = today(); 
    
       if($today->month <= $Month)
       $text  .= '&nbsp;&nbsp;<a style="color:red;" id="BtnDelete"><i <i class="fa fa-trash-o"></i></a>';
       }
  
       $text  .= "</td>";

      


      for($i=1; $i < $DayCount + 1; ++$i) 
     {
       $num_padded = sprintf("%02d", $i);
       $dt = $Year."-". $Month  ."-"   .$num_padded;

        
       $check = false;
     // if( $mult->outlet_name == "LULU EXPRESS UAQ" && $emp == "" )
   ///  dd($mult->date);
          $date = $mult->date;  //dd($date);
        if(strpos($date, $dt) !== false)
       //if ($date == $dt) 
          {  
            $check = true;
            $text  .=  "<td class='bg-success'>";  //style='background-color:gray;'
            $text  .=  $i;
            $text  .=  "</td>";
          }
          else
          {
            if( $check != true)
            {
              $text  .=  "<td class='bg-danger'>";  //style='background-color:gray;'
              $text  .=  $i;
              $text  .=  "</td>"; 
            }
          }
     
          
        }  
    }

     $text  .=  "</tr>";
  }
  }
  }  */

     /* foreach ($multimerch_check as $mult)
      { //dd($multimerch_check);

        $outID = $mult->outlet_id;
        $empID = $mult->employee_id;
        $$first_name = $mult->first_name;
        $date = $mult->date;
        $outlet_name = $mult->outlet_name;



        

         $first_name = $mult->first_name;
        $text  .= $this->bind_jp_details($outID, $outlet_name, $empID, $first_name, $date, $Month, $DayCount, $Year);
      }  */

   }
       //  dd($tes);
     $text  .= "</tbody>";

       // return $text;
      return (['table'=> $text]);
    }


    function bind_jp_details($outID, $outlet_name, $store_code, $empID, $first_name, $date, $Month, $DayCount, $Year)
    {
         
      $text  = "";
      $text  .=  "<tr class='tr'>"; 
      $text  .=  "<td><input type='checkbox'/>"; 
      $text  .=  "</td>";
     
     $text  .=  "<td class='t_outlet' style='color:blue'><input type='hidden' value='$outID'></input>";
     $text  .= "(". $store_code. ") ".  $outlet_name; //$outlet->outlet_name;
    // $text  .= "<input type='button' name='add' value='Add' class='tr_clone_add'>";
     $text  .= "</td>";
     
     $text  .=  "<td class='t_emp' style='color:orange'><input type='hidden' value='$empID'></input>";
    if($empID == "")  
     $text  .=  "<select class='jSelectbox employeeddl'><option value=''>Add Merchandiser &nbsp;&nbsp;&nbsp;</option><select>";
     else
     {
     $text  .= $empID. " " .$first_name;

    // if( $empID != "")
   //dd( $out->first_name);
     
     //if($out->first_name ==  "BIBEK")
     //dd($date);
     //  $currentMonth = date('m');
     $today = today(); 
  
     if($today->month <= $Month)
     $text  .= '&nbsp;&nbsp;<a style="color:red;" id="BtnDelete"><i <i class="fa fa-trash-o"></i></a>';
     }

     $text  .= "</td>";
        
     for($i=1; $i < $DayCount + 1; ++$i) 
     {
       $num_padded = sprintf("%02d", $i);
       $dt = $Year."-". $Month  ."-"   .$num_padded;

      //   if( $outlet_name == "LULU EXPRESS UAQ" && $empID == "RMS0077"  )
    //  dd($date);
   
    //   $checktimesheetdate = $time_sheet->where('outlet_id', $outID)->where('is_active', 1)
      // ->where('date', $dt)->count();
       // merchant_timesheet::f ind(); onClick='myFunction($out->outlet_id,$num_padded, this)'
      // if($date == $dt)
      if(strpos($date, $dt) !== false)
        {  
           $text  .=  "<td class='bg-success'>";  //style='background-color:gray;'
           $text  .=  $i;
           $text  .=  "</td>";
        }
        else
        {
         $text  .=  "<td class='bg-danger'>";  //style='background-color:gray;'
         $text  .=  $i;
         $text  .=  "</td>";
        }
     }

     $text  .=  "</tr>";

 return $text;

    }
}
