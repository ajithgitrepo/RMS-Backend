<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Outlet;
use App\Role;
use App\User;
use App\Employee;
use App\outlet_products;

use App\journeyplan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Services\PayUService\Exception;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;



class ApiOutletBrandMappingController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;

    public function outlet_brand_mapping_details(Request $request, outlet_products $modal)
    {
        
        $user   =  Auth::user();
        $date = \Carbon\Carbon::now()->format('Y-m-d');

        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $matchThese = ['is_active' => '1'];
        
        $result = DB::table('outlet_products_mapping')
        ->select('outlet_products_mapping.*','outlet.outlet_name','store_details.*',
        'employee.first_name','employee.surname','nbl_files.file_url as nbl_pdf',
        'brand_details.brand_name','category_details.category_name','outlet_products_mapping.id')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
        ->leftJoin('brand_details', 'brand_details.id', '=', 'outlet_products_mapping.brand_id')
        ->leftJoin('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
			 ->leftJoin('employee', 'employee.employee_id', '=', 'outlet_products_mapping.client_id')
			 ->leftJoin('nbl_files', 'nbl_files.outlet_id', '=', 'outlet.outlet_id');

        if($request->outlet_id != "")
        $result =  $result
        ->where('outlet_products_mapping.outlet_id', $request->outlet_id)
        ->where('outlet_products_mapping.is_active', 1);
        //->groupBy('offers.id');

        $result =  $result->get();
       // ->join('store', 'store.id', '=', 'outlet.outlet_name')
        //->with('store', function($query) {
          //  $query->where('is_active',1)->select(['id','store_name']);
       // })
       
 
         //   return response()->json($result);
            
         return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function add_outlet_brand_mapping(Request $request, outlet_products $model)
    {
        try {
           
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
                'outlet_id' =>'required',
                'brand_id' =>'required',
                'shelf' =>'required',
                'target' =>'required',
                'myfile' =>'required',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  

        //  $result = $model->create($request->all());
       
        if(count($request->brand_id) < 2)
        return response()->json(["status" => "failed", "validation_errors" => "minimum 2 brands required"]);
           
        for($i=0;$i<count($request->brand_id);$i++)
        {

            //dd($request->all()); 
            $check = DB::table('outlet_products_mapping')
              ->where('outlet_id', $request->outlet_id)
              ->where('brand_id', $request->brand_id[$i])
              ->where('is_active', 1)
              ->get();

          // dd( $check );  
           $fileName =""; 
           $imageData = $request->myfile[$i];
          if($imageData != "")
          {
            $destinationPath = 'planogram_image/' ;
            list($type, $imageData) = explode(';', $imageData);
            list(,$extension) = explode('/',$type);
            list(,$imageData)      = explode(',', $imageData);
            $fileName = uniqid().'.'.$extension;
            $imageData = base64_decode($imageData);
            file_put_contents($destinationPath .$fileName, $imageData);
            //  return response()->json(["status" => "failed", "validation_errors" => ($fileName)]);
        }    
          
          if ($check->isEmpty()) {
             
              $result = DB::table('outlet_products_mapping')->insert(
                 array(
                
                      'outlet_id'  => $request->outlet_id,
                      'brand_id' => $request->brand_id[$i],
                      'shelf' => $request->shelf[$i],
                      'target' => $request->target[$i],
                      'planogram_img' => $fileName,
                      'updated_at'  => date('y-m-d H:i:s'),
                      'created_at' => date('y-m-d H:i:s'),
                      'device' => "Mobile"

                 ));
            } 

          if ($check->isNotEmpty()) {

               $result = DB::table('outlet_products_mapping')
                  ->where('outlet_id', $request->outlet_id)
                  ->where('brand_id', $request->brand_id[$i])
                  ->update([
                          'shelf' => $request->shelf[$i],
                          'target' => $request->target[$i],
                          'planogram_img' => $fileName,
                          'updated_at' => Carbon::now()
              ]);
          }

        }

            return $printReport->send_result_msg($this->success_status, $result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
      
    }


    public function fieldmanager_add_outlet_category_mapping(Request $request, outlet_products $model)
    {
        try {
           
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
                'outlet_id' =>'required',
                'client_id' =>'required',
               'categories' =>'required'
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  

            for($i=0;$i<count($request->categories);$i++)
            {
                
                $check = DB::table('outlet_products_mapping')
                    ->where('outlet_id', $request->outlet_id)
                    ->where('category_id', $request->categories[$i])
                    ->where('client_id', $request->client_id)
                    ->where('is_active', 1)
                    ->get();

                if ($check->isEmpty()) {

                    //dd($fileName);

                    $result =  DB::table('outlet_products_mapping')->insert(
                    array(
                    
                            'outlet_id'  => $request->outlet_id,
                            'category_id' => $request->categories[$i],
                            'client_id' => $request->client_id,
                            'device' => "Mobile",
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                        )
                );
    
                }

                if ($check->isNotEmpty()) {

                    $result = DB::table('outlet_products_mapping')
                        ->where('outlet_id', $request->outlet_id)
                        ->where('category_id', $request->categories[$i])
                        ->where('client_id', $request->client_id)
                        ->update([
                                'outlet_id'  => $request->outlet_id,
                                'category_id' => $request->categories[$i],
                                'client_id' => $request->client_id,
                                'updated_at'  => date('y-m-d H:i:s')
                    ]);

                }

            }
        
            return $printReport->send_result_msg($this->success_status, $result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
      
    }

    public function fieldmanager_add_outlet_shareofself(Request $request, outlet_products $model)
    {
        try {
           
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
                'mapping_id' =>'required',
                'outlet_id' =>'required',
            'category_id' =>'required',
            //'shelf' =>'required',
            'target' =>'required',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  

        $category_id = array();
        $fileName = '';

        for($i=0;$i<count($request->mapping_id);$i++)
        {

          
            $category_id[] = $request->category_id[$i];
 
            $check = DB::table('outlet_products_mapping')
                ->where('id', $request->mapping_id[$i])
                ->where('outlet_id', $request->outlet_id)
                ->where('category_id', $request->category_id[$i])
                ->where('is_active', 1)
                ->get();

           // dd($check);

             if ($check->isEmpty()) {

                //dd($fileName);

                $result =  DB::table('outlet_products_mapping')->insert(
                   array(
                  
                        'outlet_id'  => $request->outlet_id,
                        'category_id' => $request->category_id[$i],
                       // 'shelf' => $request->shelf[$i],
                        'target' => $request->target[$i],
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')

                   )
              );
   
            }


            if ($check->isNotEmpty()) {

                 $result = DB::table('outlet_products_mapping')
                    ->where('id', $request->mapping_id[$i])
                    ->where('outlet_id', $request->outlet_id)
                    ->where('category_id', $request->category_id[$i])
                    ->update([
                           // 'shelf' => $request->shelf[$i],
                            'target' => $request->target[$i],
                            'updated_at' => Carbon::now()
                ]);

                   // dd($result);
            }

           
        }  
        
            return $printReport->send_result_msg($this->success_status, $result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
      
    }

    public function fieldmanager_add_outlet_planogram(Request $request, outlet_products $model)
    {
        try {
           
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
     
           // validation
            $validator      =   Validator::make($request->all(), [
                'mapping_id' =>'required',
                'outlet_id' =>'required',
            'category_id' =>'required',
            //'shelf' =>'required',
            'planogram_img' =>'required',
        ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }  

        //dd($request->all());

        $category_id = array();
        $fileName = '';

        for($i=0;$i<count($request->mapping_id);$i++)
        {

            $imageData = $request->planogram_img[$i];
            if($imageData != "")
            {
              $destinationPath = 'planogram_image/' ;
              list($type, $imageData) = explode(';', $imageData);
              list(,$extension) = explode('/',$type);
              list(,$imageData)      = explode(',', $imageData);
              $fileName = uniqid().'.'.$extension;
              $imageData = base64_decode($imageData);
              file_put_contents($destinationPath .$fileName, $imageData);
              //  return response()->json(["status" => "failed", "validation_errors" => ($fileName)]);
          }    


           
            $category_id[] = $request->category_id[$i];
 
            $check = DB::table('outlet_products_mapping')
                ->where('id', $request->mapping_id[$i])
                ->where('outlet_id', $request->outlet_id)
                ->where('category_id', $request->category_id[$i])
                ->where('is_active', 1)
                ->get();

           // dd($check);

             if ($check->isEmpty()) {

                //dd($fileName);

                $result =  DB::table('outlet_products_mapping')->insert(
                   array(
                  
                        'outlet_id'  => $request->outlet_id,
                        'category_id' => $request->category_id[$i],
                        'planogram_img' => $fileName,
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')

                   )
              );
   
            }


            if ($check->isNotEmpty()) {

                if(empty($imageData))
                {
                    $fileName = $check[0]->planogram_img;
                }

                 $result = DB::table('outlet_products_mapping')
                    ->where('id', $request->mapping_id[$i])
                    ->where('outlet_id', $request->outlet_id)
                    ->where('category_id', $request->category_id[$i])
                    ->update([
                            'planogram_img' => $fileName,
                            'updated_at' => Carbon::now()
                ]);

                   //dd($result);
            }

           
        }

        //dd($category_id);

        
            return $printReport->send_result_msg($this->success_status, $result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
      
    }

    public function fieldmanager_add_outlet_nbl(Request $request, outlet_products $model)
    {
        try {
           
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

         // validation
         $validator      =   Validator::make($request->all(), [
          //  'mapping_id' =>'required',
            'outlet_id' =>'required',
            'nbl_file' =>'required',
        
    ]);

       if($validator->fails()) {
        return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
    }  
     

         $file = $request->file('nbl_file');
         $format =   $file->getClientOriginalExtension();
        
         if($format != "pdf") {
            return response()->json(["status" => "failed", "file is not pdf format"]);
        }  
      $nbl_names = array();
      $res = "";
      if($request->hasfile('nbl_file'))
      {

             $nbl_file = $request->file('nbl_file');
             //dd($nbl_file);  public_path

             $destinationPath = ('nbl_file/');
             $file = $request->file('nbl_file');
             $filename = time().'.'.$file->getClientOriginalName();
             $file->move( $destinationPath, $filename);
             $filename_to_save_in_db =  $filename;
          

                  $check = DB::table('nbl_files')
                      ->where('outlet_id',($request->outlet_id))
                      ->where('is_active', 1)
                      ->get();

                  //if ($check->isEmpty()) {

                          //dd($fileName);
                      $values = array(
                          'outlet_id' => ($request->outlet_id),
                          'file_url' => $filename_to_save_in_db,
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now()
                      );
 
              
                 $res =  DB::table('nbl_files')->insert($values);
             

              
            }    
        
            return $printReport->send_result_msg($this->success_status, $res);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getmessage()], 500);
        }
      
    }

    public function fieldmanager_view_outlet_nbl_details(Request $request)
    {
        
        $user   =  Auth::user();
        // $date = \Carbon\Carbon::now()->format('Y-m-d');

         $printReport = new ApiJourneyPlanController();
         $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

        $validator = Validator::make($request->all(), [
	        'outlet_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

       $matchThese = ['is_active' => '1'];
      

        $result = DB::table('nbl_files')->where($matchThese)->where('outlet_id', $request->outlet_id)
        ->get();

         return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function delete_outlet_products_mapping(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation 
        $validator     =   Validator::make($request->all(), [
            "outlet_products_mapping_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->outlet_products_mapping_id;

    $matchThese = ['outlet_products_mapping.is_active' => '1'];

    $result = DB::table('outlet_products_mapping')
    ->where('id', $id)->update(['is_active' => '0']);

    return $printReport->send_result_msg($this->success_status, $result);

    }
}
