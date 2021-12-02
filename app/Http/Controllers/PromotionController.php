<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\promotion;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Outlet;
use App\Imports\PromoImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AuditController as audit_store;

class PromotionController extends Controller
{
    public function index()
    {       
    
        $matchThese = ['promotion.is_active' => '1', 'promotion.created_by' => Auth::user()->emp_id];

        $result = DB::table('promotion')
            ->select('promotion.*','product_details.product_name','store_details.store_name','store_details.store_code','store_details.address','outlet.outlet_area','outlet.outlet_city')
            ->leftJoin('product_details', 'product_details.id', '=', 'promotion.product_id')
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'promotion.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where($matchThese)
            ->get();

        //dd($result);
       
        return view('promotion.index',['result' => $result]);

    }

    public function create()
    {
        
        $result = DB::table('outlet')
            ->select('outlet.*','store_details.store_code','store_details.store_name','store_details.address')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where('outlet.is_active', 1)
            //->where('outlet.created_by', Auth::user()->emp_id)
            ->get();

         // $result = Outlet::with('store')
         //    ->select('outlet.*')
         //    ->Join('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
         //    ->where('outlet.is_active', 1)
         //    ->where('outlet.is_assigned', 0)
         //    //->where('outlet.created_by',Auth::user()->emp_id)
         //    ->groupBy('outlet.outlet_id')
         //    ->get();

        //dd($result);
   
        return view('promotion.create',['outlets' => $result]);

    }

    public function import_promotion()
    {
        //$outlet= DB::table('outlet')->orderby('created_at','DESC')->where('is_active',1)->get();
        
        //$store_details  = DB::table('store_details')->where('is_active',1)->get();

        return view('promotion.import');

    }


    public function get_promo_products(Request $request)
    {
        //dd($request->all());

        $matchThese = ['outlet.is_active' => '1'];
       
        // $result = DB::table('outlet')
        // ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.Image_url','outlet.outlet_id','brand_details.brand_name as b_name')
        // ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')
        // ->leftJoin('product_details', 'product_details.brand_id', '=', 'outlet_products_mapping.brand_id')
        // ->leftJoin('brand_details', 'brand_details.id', '=', 'product_details.brand_id')
        // ->where('outlet.outlet_id', $request->outlet_id)
        // ->where('product_details.is_active', 1)
        // ->where($matchThese)
        // ->get();


        $result = DB::table('outlet')
       
       ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.Image_url','outlet.outlet_id','brand_client.brand_name as b_name')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')

        ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

        ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
       // ->leftJoin('availability', 'availability.timesheet_id', '=', 'merchant_time_sheet.id')

         ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')

        ->where('outlet.outlet_id', $request->outlet_id)
        ->where('product_details.is_active', 1)
        ->where($matchThese)
        ->groupBy('product_details.id')
        ->get();

        //dd($result);

        return response()->json($result);

    }

    public function store(Request $request)
    {
        //dd($request->all());   

        $request->validate([
            'outlet_id' => 'required',
            'product_id'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
            'description'=>'required',
            
        ]);

       // dd($request->all());   

        for($i = 0; $i<count($request->product_id); $i++)
        {
            //dd($request->product_id[$i]);

             $str = null;
              if($request->hasfile('image_url'))
                {  
                   foreach($request->file('image_url') as $file)
                    {
                        $fileName=$file->getClientOriginalName();
                        $destinationPath = public_path().'/promotion_image/' ;
                        $file->move($destinationPath,$fileName);
                        $data[] = $fileName;
                        $str = implode(",",$data);
                    }
                }

            $from_date = $request->from_date;
            $new_from_date = date("Y-m-d", strtotime($from_date));  

            $to_date = $request->to_date;
            $new_to_date = date("Y-m-d", strtotime($to_date)); 

            DB::table('promotion')->insert(
            array(
                
                 'outlet_id'   => $request->outlet_id,
                 'product_id'   => $request->product_id[$i],
                 'from_date' => $new_from_date,
                 'to_date' => $new_to_date,
                 'description' => $request->description,
                 'img_url' => $str,
                 'created_by' => Auth::user()->emp_id,
                 'updated_at' => date('y-m-d H:i:s'),
                 'created_at' => date('y-m-d H:i:s')

                )
            );
   
        }

      
        $audit = new audit_store();
        $description = ' promotion added to outlet';
        $add_audit =  $audit->store($description,'promotion'); 
           
        
        return redirect()->route('promotion.index')->withStatus(__('promotion created successfully..'));

    }

    public function edit($id)
    {
        $matchThese = ['is_active' => '1', 'id' => $id];

        $result = DB::table('promotion')
            ->where($matchThese)
            ->get();

        //dd($result[0]->outlet_id);

        $products = DB::table('outlet')
       
       ->select('product_details.id as product_id','product_details.product_name as p_name','product_details.Image_url','outlet.outlet_id','brand_client.brand_name as b_name')

        ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'outlet.outlet_id')

        ->leftJoin('brand_details as brand_client', 'brand_client.client_id', '=', 'outlet_products_mapping.client_id')

        ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_client.id')
       // ->leftJoin('availability', 'availability.timesheet_id', '=', 'merchant_time_sheet.id')

         ->leftJoin('category_details', 'category_details.id', '=', 'product_details.product_categories')

        ->where('outlet.outlet_id', $result[0]->outlet_id)
        ->where('product_details.is_active', 1)
        ->groupBy('product_details.id')
        ->get();

        //dd($products);


        $outlets = DB::table('outlet')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
            ->where('outlet.is_active', 1)
            ->get();

        //dd($outlets);

        return view('promotion.edit',['outlets' => $outlets, 'result' => $result,'products' => $products]);
        
       
    }

   

    public function update(Request $request, $id )
    {
        //dd($request->all());

        $request->validate([
            'outlet_id' => 'required',
            'product_id'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
            'description'=>'required',
            
        ]);

        $str = null;
        if($request->hasfile('image_url'))
        {  
          foreach($request->file('image_url') as $file)
            {
                $fileName=$file->getClientOriginalName();
                $destinationPath = public_path().'Promotion_Image/' ;
                $file->move($destinationPath,$fileName);
                $data[] = $fileName;
                $str = implode(",",$data);

            }
        }

        $from_date = $request->from_date;
        $new_from_date = date("Y-m-d", strtotime($from_date));  

        $to_date = $request->to_date;
        $new_to_date = date("Y-m-d", strtotime($to_date)); 

        $affected = DB::table('promotion')
          ->where('id', $id)
          ->update([
                 'outlet_id'   => $request->outlet_id,
                 'product_id'   => $request->product_id,
                 'from_date' => $new_from_date,
                 'to_date' => $new_to_date,
                 'description' => $request->description,
                 'img_url'  =>($str != "") ? $str : null,
                 'created_by' => Auth::user()->emp_id,
                 'updated_at' => date('y-m-d H:i:s'),
        ]);

        if($affected){
            $audit = new audit_store();
            $description = ' promotion updated to outlet';
            $add_audit =  $audit->store($description,'promotion'); 
        }

        return redirect()->route('promotion.index')->withStatus(__('Promotion updated successfully..'));


    }


    public function destroy($id)

    {

        $delete = DB::table('promotion')->where('id', $id)->update(['is_active'=>'0']);
        
        $audit = new audit_store();
        $description = ' promotion deleted to outlet';
        $add_audit =  $audit->store($description,'promotion'); 

        return redirect()->route('promotion.index')->withStatus(__('Promotion deleted successfully'));

    }   


    public function import_promo(Request $request)
    {

        $request->validate([
            'promo_import' => 'required|mimes:csv,xlsx,xls,txt'
        ]);

         //dd($request->outlet_import);

       if($request->hasfile('promo_import'))
        { 
             //$customerArr = $this->csvToArray($request->outlet_import);

           $customerArr = Excel::toArray(new PromoImport,request()->file('promo_import'));

        }

       // dd($customerArr); 

         $items = array();    

        for ($i = 0; $i < count($customerArr[0]); $i++)
        {

           // dd($customerArr[0][$i]['outlet']);

            $check_store = DB::table('store_details')
                ->where('store_name', $customerArr[0][$i]['outlet'])
                ->where('is_active', 1)
                ->get();

            $check_product = DB::table('product_details')
                ->where('product_name', $customerArr[0][$i]['product'])
                ->where('is_active', 1)
                ->get();


           // dd($check_product);

            if($check_store->isEmpty()){
                $items[] = $customerArr[0][$i]['outlet'];
            }    



            if ($check_store->isNotEmpty() && $check_product->isNotEmpty()) 
            { 

                $from_date = $customerArr[0][$i]['from_date'];
                $new_from_date = date("Y-m-d", strtotime($from_date));  

                $to_date = $customerArr[0][$i]['to_date'];
                $new_to_date = date("Y-m-d", strtotime($to_date)); 

                 $check1 =  DB::table('promotion')
                    ->where('outlet_id', $check_store[0]->id )
                    ->where('product_id', $check_product[0]->id )
                    ->whereDate('from_date', $new_from_date)
                    ->whereDate('to_date', $new_to_date)
                    ->where('is_active', 1)
                    ->get();

                    //dd($check1);

                if ($check1->isEmpty()) 
                { 

                    $values = array(
                        'outlet_id' => $check_store[0]->id,
                        'product_id' => $check_product[0]->id,
                        'from_date' => $new_from_date,
                        'to_date' => $new_to_date,
                        'description' => $customerArr[0][$i]['description'],
                        'created_by' => Auth::user()->emp_id,
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')
                    );
                        
                    DB::table('promotion')->insert($values);

                    
                }

            }

           
        }

        // dd($i);


        if(empty($items)){

            $audit = new audit_store();
            $description = 'promotion imported ';
            $add_audit =  $audit->store($description,'promotion');

            return redirect()->route('promotion.create')->withStatus(__('Promotion imported successfully..'));
        }

        if(isset($items)){

            $audit = new audit_store();
            $description = 'promotion imported ';
            $add_audit =  $audit->store($description,'promotion');
            
             return redirect()->route('import_promo')->with('warning', 'Outlets ('. implode(", ",$items).') does not exits..' );
        }
  
        
    }

    public function report_promo(Request $request)
    {

        $matchThese = ['merchant_time_sheet.is_active' => '1'];

        $result = DB::table('merchant_time_sheet')
            ->select('product_details.id as product_id','product_details.product_name','promotion_check.id as promo_id','promotion_check.is_available','promotion_check.image_url','promotion_check.reason','brand_details.brand_name','promotion_check.timesheet_id','promotion_check.created_at','store_details.store_name','store_details.store_code','store_details.address','outlet.outlet_area','outlet.outlet_city')

            ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.outlet_id', '=', 'merchant_time_sheet.outlet_id')

            ->leftJoin('brand_details', 'brand_details.client_id', '=', 'outlet_products_mapping.client_id')
            ->leftJoin('product_details', 'product_details.brand_id', '=', 'brand_details.id')
            
            ->leftJoin('outlet', 'outlet.outlet_id', '=', 'merchant_time_sheet.outlet_id')
            ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')

            ->leftJoin('promotion_check', function ($join) {
                $join->on('promotion_check.product_id', '=', 'product_details.id')
                    ->on('promotion_check.timesheet_id', '=', 'merchant_time_sheet.id');
            })

            ->where('promotion_check.is_active', 1)
            ->where('merchant_time_sheet.created_by', Auth::user()->emp_id)
            ->where($matchThese)
            ->groupBy('product_details.id')
            ->get();

        //dd($result);

        return view('promotion_report.index',['result' => $result]);

    }


}
