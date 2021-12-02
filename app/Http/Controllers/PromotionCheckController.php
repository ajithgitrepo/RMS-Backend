<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand_details;
use App\Role;
use App\User;
use App\Employee;
use App\promotion;
use App\Http\availability;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Crypt;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;

class PromotionCheckController extends Controller
{
    public function index(Request $request)
    {  
        //dd(Crypt::decrypt($request->id));

        $date = date('Y-m-d');

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name as p_name','merchant_time_sheet.*','brand_details.brand_name as b_name','category_details.category_name','promotion_check.image_url',
            'promotion_check.is_available','promotion_check.reason')

        ->leftJoin('promotion', 'promotion.outlet_id', '=', 'merchant_time_sheet.outlet_id')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'promotion.outlet_id')

        ->leftJoin('product_details', 'product_details.id', '=', 'promotion.product_id')
        //->leftJoin('promotion_check', 'promotion_check.product_id', '=', 'merchant_time_sheet.product_id')

        ->leftJoin('promotion_check', function ($join) {
            $join->on('promotion_check.product_id', '=', 'product_details.id')
                 ->on('promotion_check.timesheet_id', '=', 'merchant_time_sheet.id');
        })

        ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
        ->where('product_details.is_active', 1)

        ->where( DB::raw('from_date'), '<=',  $date )

        ->Where( DB::raw('to_date'), '>=', $date )

        ->where($matchThese)
        ->groupBy('product_id')
        ->get();

        //dd($result);

        if ($result->isNotEmpty()) {
             return view('promotion_check.index',['result' => $result]);
        }

       

        $result = DB::table('merchant_time_sheet')
        ->select('product_details.id as product_id','product_details.product_name as p_name','merchant_time_sheet.*','brand_details.brand_name as b_name','category_details.category_name')
       
        ->leftJoin('promotion', 'promotion.outlet_id', '=', 'merchant_time_sheet.outlet_id')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'promotion.outlet_id')
        ->leftJoin('product_details', 'product_details.id', '=', 'promotion.product_id')
        ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')
        ->where('merchant_time_sheet.id', Crypt::decrypt($request->id))
        ->where('product_details.is_active', 1)
        ->where($matchThese)
        ->groupBy('product_id')
        ->get();

        //dd($result);

        return view('promotion_check.index',['result' => $result]);

    }

    public function update_promotion(Request $request)
    {
        $array = $request->uploadvisibilityfile;
        $string_version = implode(',', $array);

        $someArray = json_decode($string_version, true);

       // dd($someArray);

         for($i = 0; $i<count($someArray); $i++)
         {
            if(empty($someArray[$i]['reason']) && $someArray[$i]['check_value'] == 1 && $someArray[$i]['image_src'] =="undefined") 
            {
                return redirect()->back()->withStatus(__( 'error-Please select promotion image..'));
            }

            if(empty($someArray[$i]['reason']) && $someArray[$i]['check_value'] == 0)
            {
                 //dd($i);

                //return redirect()->back()->withStatus(__('Please select reason..'));
                return redirect()->back()->with('danger','Write your message for success');
            }

         }

         //dd('dss');

        for($i = 0; $i<count($someArray); $i++)
        {
            $reason = NULL; $image_url = NULL;
            if($someArray[$i]['check_value'] == 1)
            {
                
                if($request->hasfile('uploadfile'))
                { 
                  $chk = "no";
                  foreach($request->file('uploadfile') as $file)
                  {   
                    $fileName = $file->getClientOriginalName();
                  
                     if($fileName == $someArray[$i]['reason'] )
                      {
                       // dd($someArray[$i]['reason'] );
                          $chk .= $fileName;
                         $destinationPath = public_path().'/promotion_image/' ;
                         $file->move($destinationPath,$fileName);

                      //  $data[] = $fileName;
                        $image_url =  $fileName;    //implode(",",$data);
                     //   dd($image_url);
                        
                      }

                  }

               }
            }


        //dd($someArray[$i]['product_id']);

            if($someArray[$i]['check_value'] == 0) 
                $reason = $someArray[$i]['reason']; 
        //  dd($someArray[$i]['journy_date']);
            $visibility = array(
               
                'outlet_id' => $someArray[$i]['outlet_id'],
                'timesheet_id' => $someArray[$i]['timesheet_id'],
                'product_id' => $someArray[$i]['product_id'],
                'is_available' => $someArray[$i]['check_value'],
               // 'reason' => $reason,
               // 'image_url' => $image_url,
                'is_active' => '1',
               // 'created_at' => Carbon::now(),
              //  'updated_at' => Carbon::now()
                'created_by' => Auth::user()->emp_id
            ); 
               if($someArray[$i]['check_value'] == 0)
               { 
                $image_url = NULL;
                  if($reason != "")
                  { 
                    $data = array('reason' => $reason,
                    'image_url' => $image_url);
                    $visibility = array_merge($visibility, $data);
                  }
               }  
               else
               {   
                  $reason = NULL;
                  if($image_url != "")
                  {
                    $data = array(
                      'reason' => $reason,
                      'image_url' => $image_url);
                      $visibility = array_merge($visibility, $data);
                  }

               } 
              

            //dd($availability);
            $check = DB::table('promotion_check')
                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                ->where('product_id', $someArray[$i]['product_id'])
                ->where('is_active', 1)
                ->count();
           // dd( $someArray[$i]['outlet_products_mapping_id']);
            if ($check == 0) {
              $visibilityinsert = array('created_at' => Carbon::now());
              $output = array_merge($visibility, $visibilityinsert);
              //dd($output);
              $result = DB::table('promotion_check')->insert($output);
            }
            else { 
              // if($image_url !="" &&  $someArray[$i]['check_value'] == 1 )
               {
                  $visibilityupdate = array('updated_at' => Carbon::now());
                  $output = array_merge($visibility, $visibilityupdate);

                  $result = DB::table('promotion_check')
                  ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                  ->where('product_id', $someArray[$i]['product_id'])
                  ->update($output); 

                  ///dd($output);
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

          $user = Auth::user()->emp_id;

            $notify = new NotificationController();
             $ReportTo = "";
             $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
             if( $ReportTo != "")
             $ReportToID = $ReportTo->reporting_to_emp_id; 
             $title = "Merchandiser update promotion";
             $user_type = "merchandiser";
             $created_to = $ReportToID;
             $add_notify =  $notify->store($title, $user_type, $ReportToID);

            if($outlet->isNotEmpty())
            {
                $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

                $audit = new audit_store();
                $description = ' updated promotion in '.$outlet_name;
                $add_audit =  $audit->store($description,'promotion'); 
            }

        return redirect()->back()->withStatus(__('Promotion check updated successfully..'));

    }
}
