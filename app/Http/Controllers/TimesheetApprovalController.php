<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\merchant_timesheet;

class TimesheetApprovalController extends Controller
{
	public function index(merchant_timesheet $model)
    {

        $matchThese = ['is_active' => '1', 'employee_id' => Auth::user()->emp_id];

        $result = merchant_timesheet::where($matchThese)->with('outlet')->with('employee')->get();

      
        //dd($result);

        return view('timesheet_approval.index', ['outlets' => $result]);
    }
    
}
