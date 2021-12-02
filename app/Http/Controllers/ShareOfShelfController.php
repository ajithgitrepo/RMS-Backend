<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand_details;
use App\Role;
use App\User;
use App\Employee;
use App\Http\availability;
use App\merchant_timesheet;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Crypt;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;


class ShareOfShelfController extends Controller
{
    public function index(Request $request, merchant_timesheet $model)
    {
        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        $result = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','outlet_products_mapping.id as opm','shareof_shelf.share', 'shareof_shelf.actual', 'shareof_shelf.target', 'shareof_shelf.total_share', 'shareof_shelf.reason','category_details.category_name','category_details.id as c_id')

            ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

            ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

            ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')

            ->leftJoin('shareof_shelf', function ($join) {
                $join->on('shareof_shelf.category_id', '=', 'category_details.id')
                     ->on('shareof_shelf.timesheet_id', '=', 'merchant_time_sheet.id');
            })

            ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
            //->where('shareof_shelf.timesheet_id', Crypt::decrypt($request->id))
            ->where($matchThese)
            ->groupBy('category_details.category_name')
            ->where('category_details.is_active', 1)
            ->where('outlet_products_mapping.is_active', '1')
            ->get();

         //dd($result);

       
            return view('share_of_shelf.index', ['result' => $result]);
      
    }

    public function create(Request $request)
    {

       // dd($request->id);

        $matchThese = ['outlet_products_mapping.is_active' => '1'];

        $result = DB::table('outlet_products_mapping')
            ->select('outlet_products_mapping.*','brand_details.brand_name as b_name')
            ->leftJoin('brand_details', 'brand_details.id', '=', 'outlet_products_mapping.brand_id')
            ->where('brand_details.is_active', 1)
            ->where('outlet_products_mapping.outlet_id', $request->id)
            ->where($matchThese)
            ->get();

        //dd($result);

            return view('outlet_share_of_shelf.index', ['brands' => $result]);
   
       
    }

    public function get_share_details(Request $request)
    {

        $result = DB::table('outlet_products_mapping')
            ->where('outlet_products_mapping.is_active', 1)
            ->where('outlet_products_mapping.outlet_id', $request->outlet_id)
            ->where('outlet_products_mapping.category_id', $request->category_id)
            ->get();

        //dd($result);

        return response()->json($result);
    }


    public function update_shareof_shelf(Request $request)
    {

         $array = $request->value;

         $someArray = json_decode($array, true);

         //dd($someArray);

       $date = \Carbon\Carbon::now();

         $i = 0;

        
        for($i = 0; $i<count($someArray); $i++)
         {
            if($someArray[$i]['actual_shelf_val'] == 0 || $someArray[$i]['actual_shelf_val'] == "" )
                return response()->json(0);
 
         }

         for($i = 0; $i<count($someArray); $i++)
         {

            $reason = null;
            if($someArray[$i]['reason'] !== 'null' )
            {
                $reason = $someArray[$i]['reason'];
            }

            

            $availability = array(
                'outlet_id' => $someArray[$i]['outlet_id'], 
                'date' => $date, 
                'outlet_products_mapping_id' => $someArray[$i]['opm'],
                'outlet_id' => $someArray[$i]['outlet_id'], 
                'timesheet_id' => $someArray[$i]['timesheet_id'], 
                'category_id' => $someArray[$i]['category_id'],
                'total_share' => $someArray[$i]['total_shelf'],
                'share' => $someArray[$i]['shelf_val'],
                'target' => $someArray[$i]['target'],
                'actual' => $someArray[$i]['actual_shelf_val'],
                'reason' => $reason,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => Auth::user()->emp_id
            );

            //dd($availability);

            $check = DB::table('shareof_shelf')
                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                ->where('category_id', $someArray[$i]['category_id'])
                ->where('is_active', 1)
                ->get();

           // dd($check);

            if ($check->isEmpty()) {
               
                $result = DB::table('shareof_shelf')->insert($availability);

            }

            //dd($reason);

            if ($check->isNotEmpty()) {

                 $result = DB::table('shareof_shelf')
                    ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                    ->where('category_id', $someArray[$i]['category_id'])
                    ->update([
                        'outlet_id' => $someArray[$i]['outlet_id'], 
                        'date' => $date, 
                        'outlet_id' => $someArray[$i]['outlet_id'], 
                        'timesheet_id' => $someArray[$i]['timesheet_id'], 
                        'category_id' => $someArray[$i]['category_id'],
                        'total_share' => $someArray[$i]['total_shelf'],
                        'share' => $someArray[$i]['shelf_val'],
                        'target' => $someArray[$i]['target'],
                        'actual' => $someArray[$i]['actual_shelf_val'],
                        'reason' => $reason,
                        'is_active' => '1',
                        'updated_at' => Carbon::now()
              ]);
            }

         }

        $outlet = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','outlet.outlet_state')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where('merchant_time_sheet.id', $someArray[0]['timesheet_id'])
            ->where('merchant_time_sheet.is_active', 1)
            ->get();

          $user = Auth::user()->emp_id;

            $notify = new NotificationController();
             $ReportTo = "";
             $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
             if( $ReportTo != "")
             $ReportToID = $ReportTo->reporting_to_emp_id; 
             $title = "Merchandiser update shareof_shelf";
             $user_type = "merchandiser";
             $created_to = $ReportToID;
             $add_notify =  $notify->store($title, $user_type, $ReportToID);

            if($outlet->isNotEmpty())
            {
                $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

                $audit = new audit_store();
                $description = ' updated share of shelf in '.$outlet_name;
                $add_audit =  $audit->store($description,'share_of_shelf'); 
            }

         return response()->json($result);
    }

}
