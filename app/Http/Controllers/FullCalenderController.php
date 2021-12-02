<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FullCalenderController extends Controller
{
    //
   
    public function index(Request $request)
    {
    
        if($request->ajax()) {  //dd($request->start); Event
       
             $Event_data = DB::table('events')->whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->where('employee_id', Auth::user()->emp_id)
                       ->get(['id', 'title', 'start', 'end', 'color'])->toArray();
            
           $Attendance_present_data = DB::table('attendance')
           //->addSelect()
           ->select('id', DB::raw("'present' as title"), 'date as start', 'date as end',DB::raw("'#228B22' as color"))
           ->where('is_present', 1)
           ->where('employee_id', Auth::user()->emp_id)->get(['id', 'title', 'start', 'end', 'color'])->toArray(); 
  
           $Attendance_absent_data = DB::table('attendance')
           //->addSelect()
           ->select('id', DB::raw("'leave' as title"), 'date as start', 'date as end',DB::raw("'#DC143C' as color"))
           ->where('is_leave', 1)
           ->where('employee_id', Auth::user()->emp_id)->get(['id', 'title', 'start', 'end', 'color'])->toArray(); 
        
           // ->get(); 
           // dd($Event_data);
          // ->get();    

         // $data1 = $data1->addSelect(DB::raw("'#006400' as color"));
         // $data1 = $data1
          
          $output = array_merge($Event_data, $Attendance_present_data, $Attendance_absent_data);
        //  dd($output);
                       //whereDate('date', '>=', $request->start)
                      // ->whereDate('date',   '<=', $request->end)
                      // ->get(['id', 'title', 'date', 'date']);
          //  dd($data1);
             return response()->json($output);
        }
  
        return view('fullcalender');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
                  'employee_id' => Auth::user()->emp_id,
                  'color' => '#9B26B6',
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}
