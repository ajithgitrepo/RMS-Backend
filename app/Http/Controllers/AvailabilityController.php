<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand_details;
use App\Http\availability;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Crypt;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;

class AvailabilityController extends Controller
{
    public function index(Request $request)
    {  

      //dd(Crypt::decrypt($request->id));

    	$matchThese = ['merchant_time_sheet.is_active' => '1'];

       $result = DB::table('merchant_time_sheet')
       
        ->select('merchant_time_sheet.*','map.id as opm','product_details.id as product_id','product_details.product_name as p_name','product_details.Image_url','brand_client.brand_name as b_name','brand_client.id as b_id','category_details.category_name as c_name','availability.is_available','availability.reason')

        ->leftJoin('outlet_products_mapping as map', 'map.outlet_id', '=', 'merchant_time_sheet.outlet_id')

        ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'map.client_id')

         ->leftJoin('category_details', 'category_details.id', '=', 'map.category_id')

        // ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')

        // ->leftJoin('product_details as pro_map', 'pro_map.product_categories', '=', 'category_details.id')
        
        ->leftJoin('product_details', function ($join) {
                $join->on('product_details.brand_id', '=', 'brand_client.id')
                     ->on('product_details.product_categories', '=', 'category_details.id');
            })
        
        
        //->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')

        
        ->leftJoin('availability', function ($join) {
            $join->on('availability.product_id', '=', 'product_details.id')
                ->on('availability.timesheet_id', '=', 'merchant_time_sheet.id');
        })

        ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
        ->where('product_details.is_active', 1)
        ->where('product_details.status', 1)
        ->where('category_details.is_active', 1)
        ->where('map.is_active', 1)
        ->where($matchThese)
        ->groupBy('product_details.id')
        ->get();


        $category = DB::table('category_details')
        ->where('category_details.is_active', 1)
        ->get();

        //dd($result);

         // if ($result->isNotEmpty()) {
            return view('availability.index',['result' => $result, 'category' => $category, 'brand' => '', 's_category' => '']);
        // }

       
       //  $result = DB::table('merchant_time_sheet')
       //  ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.Image_url','merchant_time_sheet.*','brand_details.brand_name as b_name','category_details.category_name as c_name')
       //  ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
       //  ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
       //  ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
       //  ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
       //  ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
       //  ->where('product_details.is_active', 1)
       //  ->where($matchThese)
       //  ->get();

       // // dd($result);
      	
       //   return view('availability.index',['result' => $result, 'category' => $category, 'brand' => '', 's_category' => '']);

    }

  
    public function update_product_availability(Request $request)
    {

    	 $array = $request->value;

    	 $someArray = json_decode($array, true);

    	//dd($someArray[0]['timesheet_id']);

       $date = \Carbon\Carbon::now();

    	 $i = 0;

        
        for($i = 0; $i<count($someArray); $i++)
         {
            if($someArray[$i]['check_value'] == 0 && $someArray[$i]['reason'] == "null")
                return response()->json(0);
 
         }

    	 for($i = 0; $i<count($someArray); $i++)
    	 {

    	 	if($someArray[$i]['check_value'] == 1)
    	 		$value = null;

    	 	if($someArray[$i]['check_value'] == 0)
    	 		$value = $someArray[$i]['reason'];

            // if($someArray[$i]['check_value'] == 0 && $someArray[$i]['reason'] == "null")
            //     return response()->json(0);
 
    	 	//dd($someArray[$i]['reason']);

    	 	$availability = array(
                'outlet_id' => $someArray[$i]['outlet_id'], 
                'date' => $date, 
                'outlet_products_mapping_id' => $someArray[$i]['opm'], 
                'timesheet_id' => $someArray[$i]['timesheet_id'], 
                'product_id' => $someArray[$i]['product_id'],
                'brand_name' => $someArray[$i]['brand_name'], 
                'category_name' => $someArray[$i]['category_name'],  
                'product_name' => $someArray[$i]['product_name'], 
                'is_available' => $someArray[$i]['check_value'],
                'reason' => $value,
                'is_active' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => Auth::user()->emp_id
            );

            //dd($availability);

            $check = DB::table('availability')
                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                ->where('product_id', $someArray[$i]['product_id'])
                ->where('is_active', 1)
                ->get();

           // dd($check);

            if ($check->isEmpty()) {
               
                $result = DB::table('availability')->insert($availability);

            }

            if ($check->isNotEmpty()) {

                 $result = DB::table('availability')
	                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
	                ->where('product_id', $someArray[$i]['product_id'])
	                ->update([
                      'outlet_id' => $someArray[$i]['outlet_id'], 
                      'timesheet_id' => $someArray[$i]['timesheet_id'], 
                      'product_id' => $someArray[$i]['product_id'], 
                      'brand_name' => $someArray[$i]['brand_name'], 
                      'category_name' => $someArray[$i]['category_name'],  
                      'product_name' => $someArray[$i]['product_name'], 
                      'is_available' => $someArray[$i]['check_value'],
                      'reason' => $value,
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
             $title = "Merchandiser update availability";
             $user_type = "merchandiser";
             $created_to = $ReportToID;
             $add_notify =  $notify->store($title, $user_type, $ReportToID);

            if($outlet->isNotEmpty())
            {
                $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

                $audit = new audit_store();
                $description = ' updated availability in '.$outlet_name;
                $add_audit =  $audit->store($description,'Availability'); 
            }


    	 return response()->json($result);
    }

    public function search_brand(Request $request)
    {

       // dd(Crypt::decrypt($request->id));

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        // $brand = DB::table('merchant_time_sheet')
        // ->select('brand_details.brand_name')
        // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
        // ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
        // ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        // ->where('merchant_time_sheet.id', $request->id)
        // ->where('product_details.is_active', 1)
        // ->where($matchThese)
        // ->get();

       
                $result = DB::table('merchant_time_sheet')
                ->select('product_details.id as product_id','product_details.product_name','merchant_time_sheet.*','availability.is_available','availability.reason','brand_details.brand_name','category_details.category_name')
                //->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('availability', 'availability.timesheet_id', '=', 'merchant_time_sheet.id')
                ->leftJoin('product_details', 'product_details.id', '=', 'availability.product_id')
                ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
                ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
                ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
                ->where('product_details.is_active', 1);

                if(!empty($request->brand) )
                {
                    
                    $result = $result->where('brand_details.brand_name', $request->brand);
                }  

                if(!empty($request->category) )
                {
                   
                    $result = $result->where('category_details.id', $request->category);
                }  

                $result = $result->where($matchThese);
                $result = $result->get();

                 
                //dd($result);

                  $category = DB::table('category_details')
                    ->where('category_details.is_active', 1)
                    ->get();

                    //dd($category);

                 if ($result->isNotEmpty()) {

                    return view('availability.index',['result' => $result,'brand' => $request->brand, 'category' => $category, 's_category' => $request->category ]);
                 }


                $result = DB::table('merchant_time_sheet')
                ->select('product_details.id as product_id','product_details.product_name','merchant_time_sheet.*','brand_details.brand_name','category_details.category_name')
                ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')
                ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
                ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
                ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
                ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
                ->where('product_details.is_active', 1);

                if(!empty($request->brand) )
                {
                    //dd($request->brand);
                    $result = $result->where('brand_details.brand_name', $request->brand);
                }   

                if(!empty($request->category) )
                {
                   //dd($request->category);
                    $result = $result->where('category_details.id', $request->category);
                }  

                $result = $result->where($matchThese);
                $result = $result->get();
       
       // dd($category);
        
        return view('availability.index',['result' => $result, 'brand' => $request->brand,  'category' => $category, 's_category' => $request->category ]);

    }


}
