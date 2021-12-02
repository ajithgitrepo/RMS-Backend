<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Brand_details;
use App\Role;
use App\User;
use App\Employee;
use App\Http\availability;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Crypt;
use App\Employee_Reporting_To;
use App\Http\Controllers\AuditController as audit_store;

class PlanogramCheckController extends Controller
{
    //
    public function index(Request $request)
    {  

      $matchThese = ['merchant_time_sheet.is_active' => '1'];
      // otherwise
      // $userExists = DB::table('planogram_checks')->where('timesheet_id', $request->id)->exists();
        $result = DB::table('merchant_time_sheet')
        ->select(
        'merchant_time_sheet.*','jointable.id as opm',
        'category_details.category_name',
        'category_details.id as c_id',
        'jointable.planogram_img',
        'planogram_checks.before_image',
        'planogram_checks.after_image',
        'planogram_checks.id  as planlo_id'
      );
         $result = $result->leftJoin('outlet_products_mapping as jointable', 'jointable.outlet_id', '=', 'merchant_time_sheet.outlet_id'); 

         $result = $result->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'jointable.client_id');

         $result = $result->leftJoin('category_details', 'category_details.id', '=', 'jointable.category_id');

         $result = $result->where('category_details.is_active', 1);


         $result = $result->leftJoin('planogram_checks', function ($join) {
          $join->on('planogram_checks.category_id', '=', 'category_details.id')
               ->on('planogram_checks.timesheet_id', '=', 'merchant_time_sheet.id');
      });

        $result = $result->addSelect(DB::raw("'image_url' as image_url, 'reason' as reason"));
        $result = $result->where('merchant_time_sheet.id',(Crypt::decrypt($request->id)));
        //  $result = $result->where('product_details.is_active', 1);
         $result = $result->where($matchThese);
         $result = $result->whereNotNull('jointable.planogram_img');
         $result = $result->groupBy('category_details.category_name');
         $result = $result->where('jointable.is_active', '1');
         $result = $result->get();


        //dd($result);   


        $OID ="0"; 

        if ($result->isNotEmpty())
        $OID = $result[0]->outlet_id;

        $Store_result = DB::table('store_details')
        ->leftJoin('outlet', 'store_details.id', '=', 'outlet.outlet_name')
        ->where('outlet.outlet_name',$OID)
        ->get();


        return view('planogram_checks.index',['result' => $result, 'Store_result' =>  $Store_result ]);
    }




    public function view_palno(Request $request)
    {  
     // dd('dd');
       $matchThese = ['id'=>$request->id];
       $result = DB::table('planogram_checks')
                ->where($matchThese) 
                ->get(); 
          return response()->json($result);
    }

    public function update_product_Planogram_Check(Request $request)
    {

        //dd($request->all());

       $array = $request->uploadvisibilityfile;
    //   dd($array);
       $string_version = implode(',', $array);
      //dd($string_version);
   
    $someArray = json_decode($string_version, true);
    //dd($someArray);

       for($i = 0; $i<count($someArray); $i++)
       {
        $reason = NULL; $before_image_url = NULL;  $after_image_url = NULL;
            if($request->hasfile('uploadfile'))
            { 
              $chk = "no";
              foreach($request->file('uploadfile') as $file)
              {   
                $fileName = $file->getClientOriginalName();
                 if($fileName == $someArray[$i]['before_image'] )
                  {

                    $fileName = time().'.'.$fileName;

                     $destinationPath = public_path().'/planogram_image/' ;
                     $file->move($destinationPath,$fileName);
                     $before_image_url =  $fileName;    
                  }
                  if($fileName == $someArray[$i]['after_image'] )
                  {
                    $fileName = time().'.'.$fileName;
                     $destinationPath = public_path().'/planogram_image/' ;
                     $file->move($destinationPath,$fileName);
                     $after_image_url =  $fileName;   
                  }
              }
           }
      //  dd($someArray[$i]['journy_date']);
        $visibility = array(
                'date' =>$someArray[$i]['journy_date'],
                'outlet_products_mapping_id' => $someArray[$i]['outlet_products_mapping_id'],
                'outlet_id' => $someArray[$i]['outlet_id'],
                'timesheet_id' => $someArray[$i]['timesheet_id'],
                //'product_id' => $someArray[$i]['product_id'],
                'category_id' => $someArray[$i]['category_id'],
                'category_name' => $someArray[$i]['category_name'],
                'default_image' => $someArray[$i]['default_image'],
                'is_active' => '1', 
                'created_at' => Carbon::now(),
                //'updated_at' => Carbon::now()
                'created_by' => Auth::user()->emp_id
            ); 

               if($before_image_url != null)
               { 
                     $data = array( 'before_image' => $before_image_url);
                    $visibility = array_merge($visibility, $data);
               }  
               if($after_image_url != null)
               {   
                     $data = array( 'after_image' => $after_image_url);
                      $visibility = array_merge($visibility, $data);
               } 
          if($before_image_url != null || $after_image_url != null)   
          {      
            //dd($availability);
            $check = DB::table('planogram_checks')
                ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
                ->where('timesheet_id', $someArray[$i]['timesheet_id'])
                ->where('category_id', $someArray[$i]['category_id'])
                ->where('is_active', 1)
                ->count();
           // dd( $someArray[$i]['outlet_products_mapping_id']);
            if ($check == 0) {
            //  dd($visibility);
              $visibilityinsert = array('created_at' => Carbon::now());
              $output = array_merge($visibility, $visibilityinsert);
            //  dd($output);
              $result = DB::table('planogram_checks')->insert($output);
            }
            else { 
              // if($image_url !="" &&  $someArray[$i]['check_value'] == 1 )
               //   dd($visibility);
                  $visibilityupdate = array('updated_at' => Carbon::now());
                  $output = array_merge($visibility, $visibilityupdate);
                  $result = DB::table('planogram_checks')
                  ->where('outlet_products_mapping_id', $someArray[$i]['outlet_products_mapping_id'])
                  ->where('category_id', $someArray[$i]['category_id'])
                  ->whereDate('date', '=', $someArray[$i]['journy_date'])
                  ->update($output); 
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
         $title = "Merchandiser update planogram";
         $user_type = "merchandiser";
         $created_to = $ReportToID;
         $add_notify =  $notify->store($title, $user_type, $ReportToID);

        if($outlet->isNotEmpty())
        {
            $outlet_name = $outlet[0]->store_name.'['.$outlet[0]->store_code.'],'.$outlet[0]->address.','.$outlet[0]->outlet_state; 

            $audit = new audit_store();
            $description = ' updated planogram in '.$outlet_name;
            $add_audit =  $audit->store($description,'Planogram'); 
        }

       return redirect()->back()->withStatus(__( 'Planogram checks updated successfully'));
    }


    public function view_brands(Request $request,Brand_details $result)
    {  
         // dd($request->id);,'id'=>$request->id
        //return $request->id;
       // $result = DB::table('product_details') ->where('id', $request->id)->get();
       $matchThese = ['id'=>$request->id];
       $result = Brand_details::where($matchThese)
        ->with(array('employee_client' => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
        }))
        ->with(array('employee_field' => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
        }))
        ->with(array('employee_sales' => function($query) {
            $query->select(['employee_id','first_name','middle_name','surname']);
        }))
        ->get();
     //  $result1 = Product_details::where($matchThese)->with('category')->with('brand')->get();
     //dd($result);     
       return response()->json($result);
    }
}