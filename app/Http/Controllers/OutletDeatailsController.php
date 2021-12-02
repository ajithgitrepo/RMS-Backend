<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class OutletDeatailsController extends Controller
{
    public function index(journeyplan $modal)
    {
        return view('outlet_details.index');
    }

    public function outlet_detail(Request $request, journeyplan $modal)
    {
        $id = $request->id;

        //dd($id);

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.id' =>$id ];

        $result = journeyplan::where($matchThese)->with('outlet')->with('employee')
        ->select('merchant_time_sheet.*','store_details.*')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->get();

        $outlet_id = $result[0]->outlet_id;

        $last_visit = DB::table('merchant_time_sheet')
            ->select('date as last_visit')
            ->where('employee_id', Auth::user()->emp_id)
            ->where('outlet_id', $outlet_id)
            ->where('is_active', 1)
            ->where('is_completed', 1)
            ->orderBy('date', 'DESC')
            ->limit(1)
            ->get();

            if($last_visit->isNotEmpty())
            {
                $data = array_merge($result->toArray(), $last_visit->toArray());
      
            }
            else{
                $data = array_merge($result->toArray());
            }

        
       // dd($data);

       return response()->json($data);
    }

    public function monthly_count(Request $request, journeyplan $modal)
    {
        $user  =  Auth::user();
        $userID  =  Auth::user()->emp_id;
       
        $timeshee_id  = $request->id;

        // $result = outlet_login::select(DB::raw('count(id) as `count`'),DB::raw("DATE_FORMAT(date, '%Y-%m') month"))
        // ->groupBy('date')->orderBy('date')->get();

         $last_visit = DB::table('merchant_time_sheet')
            ->where('id', $request->id)
            ->where('is_active', 1)
            ->get();


       // dd($last_visit[0]->outlet_id);    

        $users = journeyplan::select('id', 'date')
        ->where('employee_id', $userID)
        ->where('outlet_id', $last_visit[0]->outlet_id)
        ->where('is_completed',1)->whereYear('date', date('Y'))
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->date)->format('m');
        });

        //dd($users);

    $usermcount = [];
    $userArr = [];

    foreach ($users as $key => $value) {
        $usermcount[(int)$key] = count($value);
    }

    $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])) {
            $userArr[$i]['count'] = $usermcount[$i];
        } else {
            $userArr[$i]['count'] = 0;
        }
        $userArr[$i]['month'] = $month[$i - 1];
    }
        $result = array_values($userArr);
        //dd($result);
         return response()->json($result);
        //return $printReport->send_result_msg($this->success_status, $result);
    }

}
