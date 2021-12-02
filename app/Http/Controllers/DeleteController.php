<?php /** @noinspection PhpUndefinedFunctionInspection */

/** @noinspection UnknownTableOrViewInspection */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Employee;
use App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
Use Redirect;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\AuditController as audit_store;


class DeleteController extends Controller
{

    public function index()

    {


//     $delete  = DB::table('merchant_time_sheet')->where('is_active',1)->paginate(10);
       $merchandisers = DB::table('employee') ->where('designation', 6)->get();


       return view('delete.create',['merchandisers' => $merchandisers]);
    }




    /** @noinspection UnknownColumnInspection
     * @noinspection PhpMethodParametersCountMismatchInspection
     * @noinspection UnknownTableOrViewInspection
     */
    public function deleterecords(Request $request)
    {

        $from_date=(date('Y-m-d', strtotime($request->from_date)));
        $to_date= (date('Y-m-d', strtotime($request->to_date)));
        $reason=$request->reason;

//        dd($reason);

        $merchandiser= $request->merchandiser;

//        dd($merchandiser);

        /** @var TYPE_NAME $delete */
        /** @noinspection UnknownColumnInspection */
        $delete = DB::table('merchant_time_sheet')
            ->whereBetween('date',[$from_date,$to_date])
            ->where('employee_id',$merchandiser)
            // ->where('is_completed',0)
//            ->get();
            ->update(['is_active'=>'0','reason' => $reason ]);

//dd($delete);
        return redirect()->route('delete.index')->withStatus(__('Time Sheet deleted successfully..'));

    }




 }

