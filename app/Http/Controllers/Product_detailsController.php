<?php

namespace App\Http\Controllers;
//namespace App\Imports\Controllers;

use Illuminate\Http\Request;

use App\Product_details;
use App\Category_details;
use App\Brand_details;
use App\Holidays;
use App\Workingdays;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Imports\ProductImport;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\AuditController as audit_store;

class Product_detailsController extends Controller
{
  
   public function index(Product_details $model)
    {       
        
        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {
            $matchThese = ['is_active' => '1','created_by' =>Auth::user()->emp_id];
            
            $model = Product_details::where($matchThese)->with('category')->with('brand')->paginate(10);;
            
            $brand = DB::table('brand_details')->where('is_active',1)->get();
       
            $category = DB::table('category_details')->where('is_active',1)->get();

            return view('product_details.index',['product' => $model,'brands' => $brand,'category'=>$category]);

        }

        $matchThese = ['is_active' => '1','created_by' =>Auth::user()->emp_id];
       
        $search = '';
            //$model = Product_details::where($matchThese)->with('category')->with('brand')->get();
            
             $model = Product_details::where($matchThese)->with('category')->with('brand', function($q) use($search){
                $q->where('client_id', '=', Auth::user()->emp_id);
            })->paginate(10);

        //dd($model);
        
        $brand = DB::table('brand_details')->where('is_active',1)->where('client_id', '=', Auth::user()->emp_id)->get();
   
        $category = DB::table('category_details')->where('is_active',1)->get();

        return view('product_details.index',['product' => $model,'brands' => $brand,'category'=>$category]);
     
      }

    public function filter_product(Request $request)
    {
    
    //dd($request->all());

      $matchThese = ['is_active' => '1','created_by' =>Auth::user()->emp_id];
      $model = Product_details::where($matchThese)->with('category')->with('brand');
     
     
     if(!empty($request->sku))
     {
       $model->where('product_details.sku',$request->sku);
     }
         
   
     if(!empty($request->product ))
      {
       
        $model->where('product_details.id',$request->product);
   
     }

     if(!empty($request->zrep_code ))
  
      {
      
        $model->where('product_details.zrep_code',$request->zrep_code);
   
     }
     if(!empty($request->barcode ))
  
      {
      
        $model->where('product_details.barcode',$request->barcode);
   
     }
    if(!empty($request->brand_id ))
    {
      
        $model->where('product_details.brand_id',$request->brand_id);
   
    }
     
         
        $query = $model->paginate(10);
        $query->appends(['sku' => $request->sku,'product_name' => $request->product_name]);

        if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
        {
            $brand = DB::table('brand_details')->where('is_active',1)->get();
        }

        if(Auth::user()->role->name =="Client")
        {
            $brand = DB::table('brand_details')->where('is_active',1)->where('client_id', '=', Auth::user()->emp_id)->where('created_by',Auth::user()->emp_id)->get();

        }
       
        $category = DB::table('category_details')->where('is_active',1)->where('created_by',Auth::user()->emp_id)->get();

     return view('product_details.index', ['product' => $query,'brands' => $brand,'category'=>$category]);
     
    }
   public function import_product_csv()
    {
        

        return view('product_details.import');

    }


    public function create()

    {
        $brand   = DB::table('brand_details')->where('is_active',1)->where('created_by',Auth::user()->emp_id)->get();
       
        $category_details = DB::table('category_details')->where('is_active',1)->where('created_by',Auth::user()->emp_id)->get();

        $clients  = DB::table('employee')->where('is_active',1)->where('designation', 7)->get();
   
        return view('product_details.create',['brands' => $brand,'category' => $category_details, 'client' => $clients]);

    }


    public function store(Request $request)

    {
        // dd($request->brand_id);
       
          //dd($request->client_id);
       
        $request->validate([
            'sku'          => 'required|min:10|unique:product_details',
            'product_name' => 'required',
            'type'          => 'required',
            'zrep_code'    => 'required|unique:product_details',
            'barcode'      => 'required',
            'piece_per_carton'  => 'required',
            'price_per_piece'  => 'required',
            'brand_id'          => 'required',
          //  'client_id'         => 'required',
            'product_categories'=> 'required',
            'remarks'           => 'required',
            'range'           => 'required',
            //'ProductImageFile.*'  =>  'required|mimes:jpeg,jpg,png'
        ]);

        $str = '';
        if($request->hasfile('ProductImageFile'))
        {  
           foreach($request->file('ProductImageFile') as $file)
            {
                $fileName=$file->getClientOriginalName();
                $destinationPath = public_path().'/product_image/' ;
                $file->move($destinationPath,$fileName);
                $data[] = $fileName;
                $str = implode(",",$data);
            }
        }


   
        DB::table('product_details')->insert(
             array(
                
                    'sku' => $request->sku,
                    'product_name' => $request->product_name,
                    'type'  => $request->type,
                    'zrep_code'  => $request->zrep_code,
                    'barcode'      => $request->barcode,

                    'piece_per_carton'  => $request->piece_per_carton,
                    'price_per_piece'  => $request->price_per_piece,
                    'brand_id'  => $request->brand_id,
                    'client_id'  => Auth::user()->emp_id,
                    'product_categories'  => $request->product_categories,
                    'Image_url' => ($str != "") ? $str : null,
                    'remarks'  => $request->remarks,
                    'range'  => $request->range,
                    'created_by'    => Auth::user()->emp_id,
                    'updated_at'   => date('y-m-d H:i:s'),
                    'created_at'   => date('y-m-d H:i:s')

             )
        );
       

        $audit = new audit_store();
        $description = ' added a product('. $request->product_name.')';
        $add_audit =  $audit->store($description,'Product'); 

        return redirect()->route('product_details.index')->withStatus(__('Product created successfully'));

    }

  

    public function show($id)

    {
          $productdetails =Product_details::find($id);
        return view('product_details.show',['product' => $productdetails]);
        

    }



    public function edit($id)
    {
        $brand   = DB::table('brand_details')->where('is_active',1)->where('created_by',Auth::user()->emp_id)->get();
       
        $category_details = DB::table('category_details')->where('is_active',1)->where('created_by',Auth::user()->emp_id)->get();
    //dd($category_details);
        $productdetails = DB::table('product_details')->where('id', $id)->where('created_by',Auth::user()->emp_id)->get();
               
        $clients  = DB::table('employee')->where('is_active',1)->where('designation', 7)->get();
         
             
        return view('product_details.edit',['product' => $productdetails,'brands' => $brand,'category' => $category_details, 'client' => $clients]);
        
       
      }

  

    public function update(Request $request, $id )
    {
        //dd($id);
         
        $request->validate([
            'sku'          => 'required|min:10|unique:product_details,sku,'.$request->sku.',sku',
            'product_name' => 'required',
            'type'          => 'required',
            'zrep_code'    => 'required|unique:product_details,zrep_code,'.$request->zrep_code.',zrep_code',
            'barcode'      => 'required',

            'piece_per_carton'  => 'required',
            'price_per_piece'  => 'required',
            'brand_id'          => 'required',
           // 'client_id'         => 'required',
            'product_categories'=> 'required',
            'remarks'           => 'required',
            'range'  =>'required',
            //'ProductImageFile.*'  =>  'required|mimes:jpeg,jpg,png'
        ]);
           
//dd($request);
    $str = "";
    if($request->hasfile('ProductImageFile'))
    {  
      foreach($request->file('ProductImageFile') as $file)
        {
            $fileName=$file->getClientOriginalName();
            $destinationPath = public_path().'/product_image/' ;
            $file->move($destinationPath,$fileName);
            $data[] = $fileName;
            $str = implode(",",$data);

        }
    }

    //dd($str);

    $update_array = array(
            
        'sku' => $request->sku,
        'product_name' => $request->product_name,
        'type'  => $request->type,
        'zrep_code'  => $request->zrep_code,
        'barcode'    =>$request->barcode,
        'piece_per_carton'  => $request->piece_per_carton,
        'price_per_piece'  => $request->price_per_piece,
        'brand_id'  => $request->brand_id,
        'range'  => $request->range,
        'product_categories'  => $request->product_categories,
        "Image_url" => ($str != "") ? $str : null,
        'remarks'  => $request->remarks,
        'created_by'    => Auth::user()->emp_id,
        'created_at'   => date('y-m-d H:i:s')

    );

       $update_img = array( "Image_url" => $str);


       if($str != "")
       $update_array = array_merge($update_img,$update_array);

        $affected = DB::table('product_details')
              ->where('id', $id)
              ->update($update_array);
              
        if($affected){
            $audit = new audit_store();
            $description = ' updated a product('. $request->product_name.')';
            $add_audit =  $audit->store($description,'Product'); 
        }

        return redirect()->route('product_details.index')->withStatus(__('Product updated successfully'));


    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Product_details product

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $delete = DB::table('product_details')->where('id', $id)->update(['is_active'=>'0']);

        if($delete){
            $audit = new audit_store();
            $description = ' deleted a product';
            $add_audit =  $audit->store($description,'Product'); 
        }
        
        return redirect()->route('product_details.index')->withStatus(__('Product details deleted successfully'));
      }   
      
  public function view_products(Request $request,Product_details $result)
    {  
         // dd($request->id);,'id'=>$request->id
        //return $request->id;
       // $result = DB::table('product_details') ->where('id', $request->id)->get();
       
       $matchThese = ['id'=>$request->id];
       $result = DB::table('product_details')
                ->select(array('product_details.*','brand_details.brand_name','category_details.category_name','employee.first_name','employee.middle_name','employee.surname'))
                ->join('brand_details','brand_details.id','=','product_details.brand_id')
                ->join('category_details','category_details.id','=','product_details.product_categories') 
                ->join('employee','employee.employee_id','=','brand_details.client_id') 
                ->where('product_details.id', $matchThese)
                ->where('product_details.is_active',1)
                ->get(); 
       
     //  $result1 = Product_details::where($matchThese)->with('category')->with('brand')->get();
        
     //dd($result);     

               
       return response()->json($result);

    }

    public function get_category_details(Request $request,Category_details $result)
    {  
         // dd($request->id);,'id'=>$request->id
        //return $request->id;
       // $result = DB::table('product_details') ->where('id', $request->id)->get();
       $matchThese = ['brand_id'=>$request->brand_id, 'is_active' => 1];
       $result = Category_details::where($matchThese)->get();
                 
     //  $result1 = Product_details::where($matchThese)->with('category')->with('brand')->get();
    // dd($result);     
       return response()->json($result);
    }


    public function import_product(Request $request)
    {

         $request->validate([
            'product_import' => 'required|mimes:csv,xlsx,xls,txt'
        ]);

       
       if($request->hasfile('product_import'))
        { 
             //$customerArr = $this->csvToArray($request->outlet_import);

           $productArr = Excel::toArray(new ProductImport,request()->file('product_import'));

        }

        // dd($productArr); 

         $items = array(); 
         // dd($items);       

        for ($i = 0; $i < count($productArr[0]); $i ++)
        {
            $BID = 0;
           $check = DB::table('brand_details')->where('brand_name', $productArr[0][$i]['brand'])->where('is_active', 1)->get();
           // dd($check);
           if($check->isEmpty()){
            $brand=array(
                'brand_name'=>$productArr[0][$i]['brand'],
                'field_manager_id'=>'Emp5665',
                'sales_manager_id'=>'Emp6576',
                'client_id'=>Auth::user()->emp_id,
                'created_by'=>Auth::user()->emp_id,
                'updated_at'  => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s')


               );
            // dd($brand);
            $insert_brand = DB::table('brand_details')->insertGetId($brand);
            $BID = $insert_brand;
            // dd($insert_brand);


           }
           else
           {
            $BID = $check[0]->id;
            // dd($BID);
           }
           // $check = DB::table('brand_details')->where('brand_name', $productArr[0][$i]['brand'])->where('is_active', 1)->get();
           // dd($check);

           $CID = 0;

           $get_category_id = DB::table('category_details')->where('category_name', $productArr[0][$i]['category'])->where('is_active', 1)->get();
           // dd($get_category_id);
           if($get_category_id->isEmpty()){
            $category=array(
                'brand_id'=>$BID,
                'category_name'=>$productArr[0][$i]['category'],
                'created_by'=>Auth::user()->emp_id,
                'updated_at'  => date('y-m-d H:i:s'),
                'created_at' => date('y-m-d H:i:s')



               );
            // dd($category);
            $insert_category = DB::table('category_details')->insertGetId($category);
            $CID= $insert_category;
            // dd($CID);


           }
           else
           {
            $CID = $get_category_id[0]->id;
            // dd($CID);
           }


           // $get_category_id = DB::table('category_details')->where('category_name', $productArr[0][$i]['category'])->where('is_active', 1)->get();

              // dd($get_category_id);

            if($check->isNotEmpty() && $get_category_id->isNotEmpty()){

                $get_product =  DB::table('product_details')
                    ->where('brand_id', $check[0]->id )
                    ->where('product_name', $productArr[0][$i]['product_name'] )
                    ->where('is_active', 1)
                    ->get();
                
                // dd($get_product);

                if($get_product->isEmpty()) 
                {

                       $values = array(
                           // 'id' => $insert_id,
                            'sku' => $productArr[0][$i]['sku'],
                            'product_name'  => $productArr[0][$i]['product_name'].'/'.$productArr[0][$i]['sku'],
                            // 'type' => 'Regular',  //$productArr[0][$i]['type'],
                            // 'zrep_code' => $productArr[0][$i]['zrep_code'],
                            'barcode' => $productArr[0][$i]['barcode'],
                            'piece_per_carton' => $productArr[0][$i]['peice_per_carton'],
                            'price_per_piece' => $productArr[0][$i]['price_per_peice'],
                            'brand_id' => $BID,
                            'created_by' => Auth::user()->emp_id,
                            'product_categories' => $CID,
                            'remarks' => $productArr[0][$i]['remarks'],
                            // 'range' => 'minis', //$productArr[0][$i]['range'],
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                          );
                       dd($values);

                       // $values = array(
                       //     // 'id' => $insert_id,
                       //      'sku' => $productArr[0][$i]['sku'],
                       //      'product_name'  => $productArr[0][$i]['product_name'],
                       //      'type' => $productArr[0][$i]['type'],
                       //      'zrep_code' => $productArr[0][$i]['zrep_code'],
                       //      'barcode' => $productArr[0][$i]['barcode'],
                       //      'piece_per_carton' => $productArr[0][$i]['peice_per_carton'],
                       //      'price_per_piece' => $productArr[0][$i]['price_per_peice'],
                       //      'brand_id' => $check[0]->id,
                       //      'created_by' => Auth::user()->emp_id,
                       //      'product_categories' => $get_category_id[0]->id,
                       //      'remarks' => $productArr[0][$i]['remarks'],
                       //      'range' => $productArr[0][$i]['range'],
                       //      'updated_at'  => date('y-m-d H:i:s'),
                       //      'created_at' => date('y-m-d H:i:s')
                       //    );

                       //dd($values);
                        
                
                    $insert_product = DB::table('product_details')->insert($values);
                    // dd($insert_product);
                }
            }    


        }

        return redirect()->route('product_details.create')->withStatus(__('Product details imported successfully..'));
      
        
    }


    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
        //dd($data);
    }

    public function getStatus(Request $request)
    {     
          //dd($request->id);
       
            $product_details = [
                'id'            =>  $request->id,
                'status'    =>  $request->status,
            ];

            $update = DB::table('product_details')->where('id',$request->id)->update($product_details);
            
            return response()->json($update);


    }
 
   } 

