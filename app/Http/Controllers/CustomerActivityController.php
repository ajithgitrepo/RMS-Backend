<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Employee;
use App\journeyplan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;

class CustomerActivityController extends Controller
{
    public function index(Request $request, journeyplan $modal)
    {
    	//dd($request->id);

    	$id = $request->id;

        //dd($id);

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'merchant_time_sheet.id' =>$id ];

        $result = journeyplan::where($matchThese)->with('outlet')->with('employee')
        ->select('merchant_time_sheet.*','store_details.*', 'outlet.*')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->get();

        //dd($result);

        $nbl_file = DB::table('merchant_time_sheet')
        ->select('nbl_files.file_url')
        ->leftJoin('nbl_files', 'nbl_files.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->where('merchant_time_sheet.id', $id)
        ->where('nbl_files.is_active', 1)
        ->take(1)
        ->get();

        //dd($nbl_file);

        $availability = DB::table('availability')
        ->where('timesheet_id', $id)
        ->where('is_active', 1)
        ->exists();

        $visibility = DB::table('visibility')
        ->where('timesheet_id', $id)
        ->where('is_active', 1)
        ->exists();

        $shareof_shelf = DB::table('shareof_shelf')
        ->where('timesheet_id', $id)
        ->where('is_active', 1)
        ->exists();

        $planogram_checks = DB::table('planogram_checks')
        ->where('timesheet_id', $id)
        ->where('is_active', 1)
        ->exists();

        $promotion_check = DB::table('promotion_check')
        ->where('timesheet_id', $id)
        ->where('is_active', 1)
        ->exists();

        $competitor = DB::table('competitor')
        ->where('timesheet_id', $id)
        ->where('is_active', 1)
        ->exists();

        $outlet_stockexpiry = DB::table('outlet_stockexpiry')
        ->where('timesheet_id', $id)
        ->where('is_active', 1)
        ->exists();

        //dd($visibility);


        return view('customer_activity.index', ['result' => $result, 'nbl_file' =>$nbl_file, 'availability' => $availability, 'visibility' => $visibility,'shareof_shelf' => $shareof_shelf,'planogram_checks' => $planogram_checks,'promotion_check' => $promotion_check,'competitor' => $competitor,'outlet_stockexpiry' => $outlet_stockexpiry]);
    }


    public function get_category_check(Request $request)
    {

        $matchThese = ['merchant_time_sheet.is_active' => '1', 'task_details.is_active' => '1'];

        $result = DB::table('merchant_time_sheet')
        ->select('task_details.*')
        ->leftJoin('task_details', 'task_details.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        ->where('merchant_time_sheet.id', $request->timesheet_id)
        ->where($matchThese)
        ->get();


        //dd($result);

        return response()->json($result);
    }


    public function update_category_check(Request $request)
    {
        //dd($request->all());

         $array = $request->uploadvisibilityfile;
         $string_version = implode(',', $array);

         $someArray = json_decode($string_version, true);
        // dd($someArray);
        
       $date = \Carbon\Carbon::now();

         $i = 0;

     

         for($i = 0; $i<count($someArray); $i++)
         {

            if(isset($someArray[$i]['task_id']))
            {
                $image_url = NULL;

                if($request->hasfile('task_file'))
                {  
                  //dd($request->task_file[$i]);

                  // foreach($request->file('task_file') as $file)
                  // {   //dd('kjkjkj');

                        $fileName = $request->task_file[$i]->getClientOriginalName();
                        //dd($fileName);
                
                         $fileName = time().'.'.$fileName;
                         $destinationPath = public_path().'/task_file/' ;
                         $request->task_file[$i]->move($destinationPath,$fileName);

                        $image_url =  $fileName;   
                     
                  //}

               }
                $category_task = array(
                    'employee_id' => Auth::user()->emp_id, 
                    'date' => $date, 
                    'timesheet_id' => $someArray[$i]['timesheet_id'], 
                    'task_id' => $someArray[$i]['task_id'],
                    'img_url' => $image_url,
                    'is_completed' => $someArray[$i]['checked'], 
                    'is_active' => '1',
                    'device' => 'Desktop',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );

                //dd($availability);

                $check = DB::table('task_response_details')
                    ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                    ->where('task_id', $someArray[$i]['task_id'])
                    ->where('is_active', 1)
                    ->get();

               // dd($check);

                if ($check->isEmpty()) {
                   
                    $result = DB::table('task_response_details')->insert($category_task);

                }

                if ($check->isNotEmpty()) {

                     $result = DB::table('task_response_details')
                        ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                        ->where('task_id', $someArray[$i]['task_id'])
                        ->update([
                         'employee_id' => Auth::user()->emp_id, 
                        'date' => $date, 
                        'timesheet_id' => $someArray[$i]['timesheet_id'], 
                        'task_id' => $someArray[$i]['task_id'],
                        'img_url' => $image_url,
                        'is_completed' => $someArray[$i]['checked'], 
                        'is_active' => '1',
                        'device' => 'Desktop',
                        'updated_at' => Carbon::now()
                  ]);
                }
            }

         }

        $outlet = DB::table('merchant_time_sheet')
            ->select('merchant_time_sheet.*','store_details.store_name','store_details.store_code','store_details.address','outlet.outlet_state')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where('merchant_time_sheet.id', $someArray[0]['timesheet_id'])
            ->where('merchant_time_sheet.is_active', 1)
            ->get();

       
        $checkout_time = $date->toDateTimeString();

        $affected = DB::table('merchant_time_sheet')
              ->where('id', $someArray[0]['timesheet_id'])
              ->whereDate('date', $date)
              ->update([
              'checkout_time' => $checkout_time,
              //'checkout_location' => $address,
              'is_completed' => 1,
              'updated_at' => Carbon::now()
        ]);

        $user = Auth::user()->emp_id;

        $notify = new NotificationController();
         $ReportTo = "";
         $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
         if( $ReportTo != "")
         $ReportToID = $ReportTo->reporting_to_emp_id; 
         $title = "Merchandiser CheckOut In Outlet";
         $user_type = "merchandiser";
         $created_to = $ReportToID;
         $add_notify =  $notify->store($title, $user_type, $ReportToID);

       

        if($outlet->isNotEmpty())
        {
            $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

            $audit = new audit_store();
            $description = ' checkout in '.$outlet_name;
            $add_audit =  $audit->store($description,'CheckOut'); 
        }

        return redirect()->route('journey-plan.index')->withStatus(__('Checkout Successfully..'));
    }


}
