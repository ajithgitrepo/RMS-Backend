<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;
use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\outlet_products;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Imports\OutletImport;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;

class PlanogramController extends Controller
{
    public function index()
    { 
        return 'working..';
    }
}
