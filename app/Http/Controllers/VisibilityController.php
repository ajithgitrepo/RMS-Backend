<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand_details;
use App\Role;
use App\User;
use App\Employee;
use App\Http\availability;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Crypt;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;

class VisibilityController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $matchThese = ['merchant_time_sheet.is_active' => '1'];
       // otherwise
        $userExists = DB::table('visibility')->where('timesheet_id', Crypt::decrypt($request->id))->exists();
       // dd($userExists); 
      
       if($userExists == false)
       {

        $result = DB::table('merchant_time_sheet')
          ->select('merchant_time_sheet.*','outlet_products_mapping.id as opm','category_details.category_name as c_name', 'category_details.category_name','category_details.id as c_id');
       
       
        $result = $result->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id');

        $result = $result->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id');

        $result = $result->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id');

        $result = $result->where('category_details.is_active', 1);
       

          }

       else
         { 
             
          $result = DB::table('merchant_time_sheet')
          ->select('merchant_time_sheet.*','outlet_products_mapping.id as opm','visibility.image_url','visibility.reason','visibility.is_available','visibility.g_area','visibility.main_aisle','visibility.pois','category_details.category_name','category_details.id as c_id');
         // if($userExists == true) 

            $result = $result->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 
                'merchant_time_sheet.outlet_id'); 

            $result = $result->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id');

             $result = $result->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id');


            $result = $result->leftJoin('visibility', function ($join) {
                $join->on('visibility.category_id', '=', 'category_details.id')
                    ->on('visibility.timesheet_id', '=', 'merchant_time_sheet.id');
            });



         }

         $result = $result->where('merchant_time_sheet.id',(Crypt::decrypt($request->id)));
         //$result = $result->where('product_details.is_active', 1);
         $result = $result->where($matchThese);
       // ->get(); 
      
        if($userExists == false)
        {
          // $result = $result->toArray(); 
          // $array1 = array(
          //   'reason' => '', 
          //   'is_available' => '' , 
          //   'Image_url' => '' check_value
          //   );
            $result = $result->addSelect(DB::raw("'image_url' as image_url, 
            'reason' as reason, 'is_available' as is_available"));
           

          }
        // $result = array_merge($array1, $result);

        // }

        $result = $result->groupBy('category_details.category_name');
        $result = $result->where('outlet_products_mapping.is_active', '1');
        $result = $result->whereNotNull('category_details.id');
        $result = $result->get();

        //dd($result);

        if($userExists == false)
        $OID ="0";

        if ($result->isNotEmpty())
        $OID = $result[0]->outlet_id;
        
        $Store_result = DB::table('store_details')
        ->leftJoin('outlet', 'store_details.id', '=', 'outlet.outlet_name')
        ->where('outlet.outlet_name',$OID)
        ->get();

        
        return view('visibility.index',['result' => $result, 'Store_result' =>  $Store_result ]);
    }

  /*  public function update_product_visibility(Request $request)
    {
       //dd(request('uploadfile') );
       dd($request->uploadvisibilityfile);
        $str = "";
        if($request->hasfile('uploadfile'))
        { 
            $chk = "no";
          foreach($request->file('uploadfile') as $file)
            {   $fileName= "yes";
                $fileName=$file->getClientOriginalName();
              //  $chk .= $fileName;
               // $destinationPath = public_path().'/product_image/' ;
              //  $file->move($destinationPath,$fileName);
              
                $data[] = $fileName;
                $str = implode(",",$data);
               
            }

            foreach(request('uploadfile') as  $file) {
              //  dd($key);
                $chk .= $file->id. " , " ;
            }
           dd($chk);
        }
         
    }  */

    public function update_product_visibility(Request $request)
    {
        //dd($request->uploadfile);

        $array = $request->uploadvisibilityfile;
        $string_version = implode(',', $array);
        //dd($string_version);
    //   $someArray = json_decode($array, true);

 
        $someArray = json_decode($string_version, true);
        //dd($someArray);

  
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
                     $fileName = time().'.'.$fileName;
                     $destinationPath = public_path().'/visibility_image/' ;
                     $file->move($destinationPath,$fileName);

                    $image_url =  $fileName;   
                    
                  }

              }

           }
        }
            if($someArray[$i]['check_value'] == 0) 
                $reason = $someArray[$i]['reason']; 
        //  dd($someArray[$i]['journy_date']);
            $visibility = array(
                'date' =>$someArray[$i]['journy_date'],
                'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'],
                'outlet_id' => $someArray[$i]['outlet_id'],
                'timesheet_id' => $someArray[$i]['timesheet_id'],
                //'product_id' => $someArray[$i]['product_id'],
                //'brand_id' => $someArray[$i]['brand_id'],
                //'brand_name' => $someArray[$i]['brand_name'],
                'category_name' => $someArray[$i]['category_name'],
                'category_id' => $someArray[$i]['category_id'],
                //'product_name' => $someArray[$i]['product_name'],
                'is_available' => $someArray[$i]['check_value'],
                'g_area' => !empty($someArray[$i]['g_area']) ? $someArray[$i]['g_area'] : NULL,
                'main_aisle' => !empty($someArray[$i]['main_aisle']) ? $someArray[$i]['main_aisle'] : NULL,
                'pois' => !empty($someArray[$i]['pois']) ? $someArray[$i]['pois'] : NULL,
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
            $check = DB::table('visibility')
                ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                ->where('category_id', $someArray[$i]['category_id'])
                ->where('is_active', 1)
                ->count();

            if ($check == 0) {
              $visibilityinsert = array('created_at' => Carbon::now());
              $output = array_merge($visibility, $visibilityinsert);
              
              $result = DB::table('visibility')->insert($output);
            }
            else { 
              // if($image_url !="" &&  $someArray[$i]['check_value'] == 1 )
               {
                  $visibilityupdate = array('updated_at' => Carbon::now());
                  $output = array_merge($visibility, $visibilityupdate);
                  $result = DB::table('visibility')
                  ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
                  ->where('category_id', $someArray[$i]['category_id'])
                  ->whereDate('date', '=', $someArray[$i]['journy_date'])
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
             $title = "Merchandiser update visibility";
             $user_type = "merchandiser";
             $created_to = $ReportToID;
             $add_notify =  $notify->store($title, $user_type, $ReportToID);

            if($outlet->isNotEmpty())
            {
                $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

                $audit = new audit_store();
                $description = ' updated visibility in '.$outlet_name;
                $add_audit =  $audit->store($description,'Visibility'); 
            }


        return redirect()->back()->withStatus(__('Visibility updated successfully..'));
    }

  
}


