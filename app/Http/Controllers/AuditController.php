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

class AuditController extends Controller
{
    public function store($description,$type)
    {
      
        $ip = \Request::ip(); // dd($ip);
        $ipdat = 'Not Found';
        //@json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

        $dt = new DateTime();
        $time =  $dt->format('H:i:s');

        $emp_id = Auth::user()->emp_id;
        $name = Auth::user()->name;
        $role = Auth::user()->role->name;

        $description = $name.'('.$emp_id.'/'.$role.')'.$description;
      
        $res = DB::table('audit_trial_details')->insert(
            array(
                'date'   =>  date('y-m-d'),
                'time'   =>   $time,
                'description'   =>  $description, 
                'ip_address' => $ip,
                'country' => $ipdat, //$ipdat->geoplugin_countryName,
                'device' => "Web",
                'type' => $type,
                'status' => "success",
                'role_id'   =>  Auth::user()->role_id,
                'created_by'   =>  Auth::user()->emp_id,
                'is_active'   =>   1,
                'updated_at' => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s'),
                )
        ); 
   
         return  $res;
    }
}
