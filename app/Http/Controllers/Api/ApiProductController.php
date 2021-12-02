<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product_details;
use App\Category_details;
use App\Brand_details;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiProductController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;

    public function add_product(Request $request, Product_details $model)
    {
        try {
      
        $user  =  Auth::user();  
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg(); 
     
           // validation
            $validator  =  Validator::make($request->all(), [
                'sku'          => 'required|min:12|max:12|unique:product_details',
                'product_name' => 'required|min:5|unique:product_details',
                'type'          => 'required',
                'zrep_code'    => 'required|unique:product_details',
                'piece_per_carton'  => 'required',
                'price_per_piece'  => 'required',
                'brand_id'          => 'required',
                'client_id'         => 'required',
                'product_categories'=> 'required',
               // 'remarks'           => 'required',
                'range'       => 'required',
           ]);  

           if($validator->fails()) {  
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

        $fileName = NULL;
        $imageData = $request->Image_url;
        if($imageData != "")
        { //public_path().
        $destinationPath = 'product_image/' ;
        list($type, $imageData) = explode(';', $imageData);
        list(,$extension) = explode('/',$type);
        list(,$imageData)  = explode(',', $imageData);
        $fileName = uniqid().'.'.$extension;
        $imageData = base64_decode($imageData);
        file_put_contents($destinationPath .$fileName, $imageData);
        }
        
            $result =  DB::table('product_details')->insert( 
            array( 
               'sku' => $request->sku,
               'product_name' => $request->product_name,
               'zrep_code'  => $request->zrep_code,
               'type'  => $request->type,
               'range'  => $request->range,
                'piece_per_carton'  => $request->piece_per_carton,
                'price_per_piece'  => $request->price_per_piece,
                'brand_id'  => $request->brand_id,
                'client_id'  => $request->client_id, 
                'product_categories'  => $request->product_categories,
                'Image_url' => $fileName,
                'remarks'  => $request->remarks,
                'created_by'    => Auth::user()->emp_id,
                'updated_at'   => date('y-m-d H:i:s'),
                'created_at'   => date('y-m-d H:i:s'),
                'device' => "Mobile"
            ));  
            
            return $printReport->send_result_msg($this->success_status, $result);
       }  
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

    public function Product_details(Request $request, Product_details $modal)
    {
        $user  =  Auth::user();  
        $date = date('Y'); 
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg();  
 
        $matchThese = ['Product_details.is_active' => '1','brand_details.is_active' => '1','category_details.is_active' => '1'];
        // 'category.is_active' => '1','brand.is_active' => '1',];
   
       // $result = Product_details::where($matchThese)->with('category')->with('brand')->get();

        $result = Product_details::select('product_details.*','brand_details.*','category_details.*',
        'brand_details.id as brand_id','category_details.id as cate_id',
			'Product_details.id as product_id' )->where($matchThese)->leftJoin('brand_details', function($join) {
            $join->on('Product_details.brand_id', '=', 'brand_details.id');
          })->leftJoin('category_details', function($join) {
            $join->on('Product_details.product_categories', '=', 'category_details.id');
          })
        //->with('active_brand')

        // ->whereHas('category', function($query){
        //     $query->where("is_active","1");
        // })->with('category')
        // ->whereHas('brand', function($query){
        //     $query->where("is_active","1");
        // })
        ->get();
        
        return $printReport->send_result_msg($this->success_status, $result);

    } 

    public function delete_product(Request $request)
    {

        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
        
        if($chk == false)
        return $printReport->auth_error_msg();

        // validation
        $validator     =   Validator::make($request->all(), [
            "product_id" =>  "required",
         ]); 

          if($validator->fails()) {
           return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
       } 

    $id = $request->product_id;

    $matchThese = ['is_active' => '1'];

    $result = DB::table('product_details')
    ->where('id', $id)->update(['is_active' => '0']);

    return $printReport->send_result_msg($this->success_status, $result);

    }
}
