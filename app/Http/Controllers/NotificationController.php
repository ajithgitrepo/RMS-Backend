<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Holidays;
use App\Workingdays;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use DateTime;

class NotificationController extends Controller
{
    //
   

   public function notification_pageurl_details($title)
    {
      

         $res = "";
         if($title == "Leave request from merchandiser")
          $res = "leaves";

        else if($title == "Leave request from field manager")
          $res = "leaves";

        else if($title == "Merchandiser CheckIn In Outlet")
          $res = "defined-outlets";

        else if($title == "Merchandiser CheckOut In Outlet")
          $res = "defined-outlets";

        else if($title == "Merchandiser update availability")
          $res = "defined-outlets";

        else if($title == "Merchandiser update visibility")
          $res = "defined-outlets";

        else if($title == "Merchandiser update shareof_shelf")
          $res = "defined-outlets";

        else if($title == "Merchandiser update promotion")
          $res = "defined-outlets";

        else if($title == "Merchandiser update planogram")
          $res = "defined-outlets";

        else if($title == "Merchandiser update competitor")
          $res = "defined-outlets";

        else if($title == "Merchandiser update stock export")
          $res = "stock_report";

        else if($title == "Fieldmanager added scheduled timesheet")
          $res = "timesheet";

        else if($title == "Fieldmanager added unscheduled timesheet")
          $res = "date_timesheet";

        else if($title == "Field Manager accept your leave request and waiting for HR approval")
          $res = "leaverequest";

        else if($title == "Field Manager reject your leave request")
          $res = "leaverequest";

        else if($title == "HR accept your leave request")
          $res = "leaverequest";

        else if($title == "HR accept merchandiser leave request")
          $res = "leaves";

        else if($title == "HR reject your leave request")
          $res = "leaverequest";

        else if($title == "HR reject merchandiser leave request")
          $res = "leaves";

         return $res; 

    } 

public function store($title, $user_type, $ReportToID)
   {
      
        $dt = new DateTime();
        $time =  $dt->format('H:i:s');
       // dd($time);
        $page_url = $this->notification_pageurl_details($title);

        $res =	DB::table('notifiation_details')->insert(
            array(
                'title'   =>   $title, 
                'date'   =>  date('y-m-d'),
                'time'   =>   $time,
                'created_by'   =>   Auth::user()->emp_id,
                'user_type' => $user_type,
                'created_to' => $ReportToID,
                'page_url' => $page_url,
                'read_at'   =>   1,
                'viwed_at'   =>   1,
                'is_active'   =>   1,
                'updated_at' => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s')
                )
        ); 
   
         return  $res;
        }
        public function get_notification(Request $request)
        {
            //dd(Auth::user()->role->name);
       
            $Event_data = DB::table('notifiation_details')
            //->where("user_type", Auth::user()->role->name)
            ->orderBy('date', 'desc') 
            ->take(5) 
            ->where('is_active', 1)
            ->where('created_to', Auth::user()->emp_id)
            ->where('viwed_at', 1)
            ->get();

             return response()->json($Event_data);
            
        }

        public function viwed_notification(Request $request)
        { 
            $string = $request->id;
            $value = rtrim($string, ',');
            $array = explode(',', $value);
         
            $result =  DB::table('notifiation_details')
            ->whereIn('id', ($array))->update(['read_at' => '0']);
        //  dd( $value);
            return response()->json($result);
            
        }

        public function single_viwed_notification(Request $request)
        { 
            $string = $request->id;
             $result =  DB::table('notifiation_details')
                ->where('id', ($string))->update(['viwed_at' => '0']);
        //  dd( $value);
            return response()->json($result);
            
        }
    
    }
