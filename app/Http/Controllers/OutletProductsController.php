<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;
use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\outlet_products;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Imports\OutletImport;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;
use Crypt;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuditController as audit_store;

class OutletProductsController extends Controller
{

	public function index(Outlet $model)
    {       
        
    //$model= DB::table('outlet')->orderby('created_at','DESC')->where('is_active',1)->get();

     //$matchThese = ['is_active' => '1'];
     //$model = outlet_products::where($matchThese)->with('product')->orderby('created_at','DESC')->get();
    //dd($model);

      $matchThese = ['outlet_products_mapping.is_active' => '1'];
        $value = 'someName';
        $result = outlet_products::with(['product'])
        ->select('outlet_products_mapping.*','store_details.store_name')
        ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
        ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        ->where($matchThese)
        ->get();

      // dd($result); 
  
     return view('outlet_products.index', ['outlet' => $result]);
    
    }


    public function create(Request $request)
    {
       

        $matchThese = ['is_active' => '1','outlet_id'=>$request->id];
     	$outlets = Outlet::where($matchThese)->with('store')->orderby('created_at','DESC')->get();

     	//dd($outlets);

       // $products  = DB::table('product_details')->where('is_active',1)->get();

        $brands = DB::table('brand_details')
                    ->select('brand_details.*','employee.first_name','employee.middle_name','employee.surname')
                    ->leftJoin('employee', 'employee.employee_id', '=', 'brand_details.client_id')
                    ->where('brand_details.is_active',1)
                    ->where('created_by' ,Auth::user()->emp_id)
                    ->get();

        return view('outlet_products.create',['outlets' => $outlets, 'brands' => $brands]);

    }


    public function store(Request $request)
    {
    
        $request->validate([
            'outlet_name' =>'required',
            'brand' =>'required',
            'shelf' =>'required',
            'target' =>'required',
            'myfile' =>'required',
       
        ]);

        

        for($i=0;$i<count($request->brand_id);$i++)
      	{

      		//dd($request->all());

             $check = DB::table('outlet_products_mapping')
                ->where('outlet_id', $request->outlet_name)
                ->where('brand_id', $request->brand_id[$i])
                ->where('is_active', 1)
                ->get();

            // dd( $check );  

            if($request->hasfile('myfile'))
            {
               
                    $fileName = time().'.'.$request->myfile[$i]->getClientOriginalName();
                    $request->myfile[$i]->move('/planogram_image',$fileName);

                    //dd($fileName);

            }    
            
             if ($check->isEmpty()) {
               
                DB::table('outlet_products_mapping')->insert(
                   array(
                  
                        'outlet_id'  => $request->outlet_name,
                        'brand_id' => $request->brand_id[$i],
                        'shelf' => $request->shelf[$i],
                        'target' => $request->target[$i],
                        'planogram_img' => $fileName,
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')

                   )
              );
   
            }

            if ($check->isNotEmpty()) {

                 $result = DB::table('outlet_products_mapping')
                    ->where('outlet_id', $request->outlet_name)
                    ->where('brand_id', $request->brand_id[$i])
                    ->update([
                            'shelf' => $request->shelf[$i],
                            'target' => $request->target[$i],
                            'planogram_img' => $fileName,
                            'updated_at' => Carbon::now()
                ]);
            }
 

      		
      	}

        return redirect()->route('outlet.index')->withStatus(__('Brand added to outlet successfully..'));

    }

    public function view_edit(Request $request)
    {
            
        $old_category_data = DB::table('outlet_products_mapping')
            ->select('outlet_products_mapping.*','employee.first_name','employee.middle_name','employee.surname','category_details.category_name')
            ->leftJoin('employee', 'employee.employee_id', '=', 'outlet_products_mapping.client_id')
            ->Join('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
            ->where('outlet_id', $request->id)
            ->where('outlet_products_mapping.is_active', 1)
			->where('category_details.is_active', 1)
            ->get();

        // $old_nbl_data = DB::table('nbl_files')
        //     ->where('outlet_id', $request->id)
        //     ->where('is_active', 1)
        //     ->get();

        // $old_share_data = DB::table('outlet_products_mapping')
        //     ->select('outlet_products_mapping.*','category_details.category_name')
        //     ->Join('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
        //     ->where('outlet_id', $request->id)
        //     ->where('outlet_products_mapping.is_active', 1)
        //     //->whereNotNull('outlet_products_mapping.shelf')
        //     ->whereNotNull('outlet_products_mapping.target')
        //     ->get();

        // $old_planogram_data = DB::table('outlet_products_mapping')
        //     ->select('outlet_products_mapping.*','category_details.category_name')
        //     ->Join('category_details', 'category_details.id', '=', 'outlet_products_mapping.category_id')
        //     ->where('outlet_id', $request->id)
        //     ->where('outlet_products_mapping.is_active', 1)
        //     ->whereNotNull('outlet_products_mapping.planogram_img')
        //     ->get();


        //dd($old_planogram_data);


        // $matchThese = ['outlet_products_mapping.is_active' => '1','outlet_products_mapping.outlet_id' =>$request->id];
        // $value = 'someName';
        // $result = outlet_products::with(['brand'])
        //     ->select('outlet_products_mapping.*','store_details.store_name')
        //     ->leftJoin('outlet', 'outlet.outlet_id', '=', 'outlet_products_mapping.outlet_id')
        //     ->leftJoin('store_details', 'store_details.id', '=', 'outlet.outlet_name')
        //     ->where($matchThese)
        //     ->get();

        // $brands = DB::table('brand_details')
        //     ->select('brand_details.*','employee.first_name','employee.middle_name','employee.surname')
        //     ->leftJoin('employee', 'employee.employee_id', '=', 'brand_details.client_id')
        //     ->where('brand_details.is_active',1)
        //     ->get();


        return view('outlet_products.view_edit',['old_category_data' => $old_category_data ]);
        
       
    }
   

    public function edit(Request $request)
    {
            
    	//dd($request->outlet);

        $result = DB::table('outlet_products_mapping')
	        ->where('id', $request->id)
	        ->where('is_active', 1)
	        ->get();
       // dd($result);
               
        $matchThese = ['is_active' => '1','outlet_id'=>$request->outlet];
     	$outlets = Outlet::where($matchThese)->with('store')->orderby('created_at','DESC')->get();

     	//dd($outlets);

        //$products  = DB::table('product_details')->where('is_active',1)->get();

        $brands = DB::table('brand_details')->where('is_active',1)->get();
             
        return view('outlet_products.edit',['result' => $result, 'outlets' => $outlets, 'brands' => $brands ]);
        
       
    }

    public function update(Request $request, $id )
    {
        //dd($request->all());
         
        $request->validate([
            'outlet_name' =>'required',
            'brand' =>'required',
            'shelf' =>'required',
            'target' =>'required',
       
        ]);

        //dd($request->all());

        $brand_ids_array = array();
        $fileName = '';

        for($i=0;$i<count($request->brand_id);$i++)
        {

            if($request->hasfile('myfile'))
            {
                //dd($request->all());

                if(!empty($request->myfile[$i]))
                {
                    $fileName = time().'.'.$request->myfile[$i]->getClientOriginalName();
                    $request->myfile[$i]->move('/planogram_image',$fileName);
                }

                //$fileName = time().'.'.$request->myfile[$i]->getClientOriginalName();
               

            }    


            $brand_ids_array[] = $request->brand_id[$i];

            $check = DB::table('outlet_products_mapping')
                ->where('outlet_id', $request->outlet_name)
                ->where('brand_id', $request->brand_id[$i])
                ->where('is_active', 1)
                ->get();

            //dd($check);

             if ($check->isEmpty()) {

                //dd($fileName);

                DB::table('outlet_products_mapping')->insert(
                   array(
                  
                        'outlet_id'  => $request->outlet_name,
                        'brand_id' => $request->brand_id[$i],
                        'shelf' => $request->shelf[$i],
                        'target' => $request->target[$i],
                        'planogram_img' => $fileName,
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')

                   )
              );
   
            }


            if ($check->isNotEmpty()) {

                if(empty($request->myfile[$i]))
                {
                    $fileName = $check[0]->planogram_img;
                }
                
                //dd($fileName);

                 $result = DB::table('outlet_products_mapping')
                    ->where('outlet_id', $request->outlet_name)
                    ->where('brand_id', $request->brand_id[$i])
                    ->update([
                            'shelf' => $request->shelf[$i],
                            'target' => $request->target[$i],
                            'planogram_img' => $fileName,
                            'updated_at' => Carbon::now()
                ]);

                   // dd($result);
            }

           
        }

        //dd($brand_ids_array);

        $delete = DB::table('outlet_products_mapping')
            ->where('outlet_id', $request->outlet_name)
            ->whereNotIn('brand_id', $brand_ids_array)
            ->update(['is_active' => '0']);



        return redirect()->route('outlet.index')->withStatus(__('Brand updated to outlet successfully..'));
    }

    public function destroy($id)
    {

     
        $delete = DB::table('outlet_products_mapping')->where('id', $id)->update(['is_active' => '0']);
      
        return Redirect::back()->withStatus(__('Brand deleted from outlet successfully..'));    
                         
    }  


    public function add_outlet_categories(Request $request)
    {

        //dd(Crypt::decrypt($request->id));

        $id = $request->id;

        $matchThese = ['is_active' => '1','outlet_id'=>Crypt::decrypt($request->id)];
        $outlets = Outlet::where($matchThese)->with('store')->orderby('created_at','DESC')->get();


        $clients = DB::table('employee')
            ->where('employee.designation',7)
            ->where('employee.is_active',1)
            ->get();

        // $categories = DB::table('category_details')
        //     ->where('category_details.is_active',1)
        //     ->get();

        $nbl_file =  DB::table('nbl_files')
            ->where('outlet_id',Crypt::decrypt($id))
            ->where('is_active',1)
            ->get();

        //dd($nbl_file);

        $categories = DB::table('category_details')
            ->select('category_details.*','outlet_products_mapping.outlet_id','outlet_products_mapping.target','outlet_products_mapping.planogram_img','outlet_products_mapping.category_id')

             ->leftJoin('outlet_products_mapping', function ($join) use ($id) {
                $join->on('outlet_products_mapping.category_id', '=', 'category_details.id')
                 ->where('outlet_products_mapping.outlet_id',Crypt::decrypt($id))
                 ->where('outlet_products_mapping.is_active',1);
            })

            ->where('category_details.is_active',1)
            ->where('created_by',Auth::user()->emp_id)
            //->where('outlet_products_mapping.is_active',1)
            ->groupBy('category_details.id')
            ->get();

        //dd($categories);


        return view('outlet_products.create_category',['outlets' => $outlets, 'clients' => $clients, 'categories'=> $categories, 'nbl_file' => $nbl_file]);
        

    }


    public function outlet_categories(Request $request)
    {
       
         $request->validate([
            'outlet_name' =>'required',
            //'client_id' =>'required',
            'categories' =>'required',
            'target' =>'required'   
       
        ]);

        //dd($request->all()); 

        $category = array();
        $fileName = '';
        $nbl_fileName = '';


        if($request->hasfile('nbl_file'))
        {
            if(!empty($request->nbl_file[0]))
            {
                $nbl_fileName = time().'.'.$request->nbl_file[0]->getClientOriginalName();
                $request->nbl_file[0]->move('nbl_file/',$nbl_fileName);
            }

            $check_nbl = DB::table('nbl_files')
            ->where('outlet_id', $request->outlet_name)
            ->where('is_active', 1)
            ->get();

            //dd($check_nbl);

            if($check_nbl->isEmpty()){
                $values = array(
                    'outlet_id' => $request->outlet_name,
                    'file_url' => $nbl_fileName,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                );

                DB::table('nbl_files')->insert($values);

                $audit = new audit_store();
                $description = ' added a nbl to outlet';
                $add_audit =  $audit->store($description,'outlet');
            }

            if($check_nbl->isNotEmpty()){
                 $result = DB::table('nbl_files')
                    ->where('outlet_id', $request->outlet_name)
                    ->update([
                            'file_url' => $nbl_fileName,
                            'updated_at'  => date('y-m-d H:i:s')
                ]);

                if($result){
                    $audit = new audit_store();
                    $description = ' updated a nbl to outlet';
                    $add_audit =  $audit->store($description,'outlet');
                }
            }

        }

        for($i=0;$i<count($request->categories);$i++)
        {
            //dd($request->category_id[$i]);
            $check = DB::table('outlet_products_mapping')
                ->where('outlet_id', $request->outlet_name)
                ->where('category_id', $request->mapping_id[$i])
                ->where('client_id', Auth::user()->emp_id)
                ->where('is_active', 1)
                ->get();

            //dd($check); 

            if($request->hasfile('myfile'))
            {
                //dd($request->all());

                if(!empty($request->myfile[$i]))
                {
                    $fileName = time().'.'.$request->myfile[$i]->getClientOriginalName();
                    $request->myfile[$i]->move('planogram_image/',$fileName);
                }


            }


            $category[] = $request->category_id[$i];


            if ($check->isEmpty()) {

                //dd($fileName);

                DB::table('outlet_products_mapping')->insert(
                   array(
                  
                        'outlet_id'  => $request->outlet_name,
                        'category_id' => $request->mapping_id[$i],
                        'target' => $request->target[$i],
                        'planogram_img' => $fileName,
                        'client_id' => Auth::user()->emp_id,
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')

                   )
              );

                $audit = new audit_store();
                $description = ' categories added to outlet';
                $add_audit =  $audit->store($description,'outlet');
   
            }

            if ($check->isNotEmpty()) {

                if(empty($request->myfile[$i]))
                {
                    $fileName = $check[0]->planogram_img;
                }

                $result = DB::table('outlet_products_mapping')
                    ->where('outlet_id', $request->outlet_name)
                    ->where('category_id', $request->mapping_id[$i])
                    ->where('client_id', Auth::user()->emp_id)
                    ->update([
                            'target' => $request->target[$i],
                            'planogram_img' => $fileName,
                            'updated_at'  => date('y-m-d H:i:s')
                ]);

            }


        }

        //dd($category);

        $delete = DB::table('outlet_products_mapping')
            ->where('outlet_id', $request->outlet_name)
            ->whereNotIn('category_id', $category)
            ->update([
                'is_active' => 0,
        ]);
               

        return redirect()->back()->withStatus(__('Category Added To Outlet Successfully..'));

    }

    public function remove_outlet_categories(Request $request)
    {
        $delete = DB::table('outlet_products_mapping')->where('id', $request->id)->update(['is_active' => '0']);

        if($delete){
            $audit = new audit_store();
            $description = ' deleted category to outlet';
            $add_audit =  $audit->store($description,'outlet');
        }
      
        return redirect()->back()->withStatus(__('Category Removed Successfully..'));  
           
    }

    public function add_outlet_nbl(Request $request)
    {

       return view('outlet_products.add_nbl_file');
    }

    public function update_nbl_file(Request $request)
    {

        //dd($request->all());

        // if($request->hasfile('nbl_file'))
        // {
        //     //dd($request->all());

        //     $fileName = time().'.'.$request->nbl_file[$i]->getClientOriginalName();
        //     $request->myfile[$i]->move('nbl_file',$fileName);
      
        // }   

        $nbl_names = array();

        if($request->hasfile('nbl_file'))
        {

               $nbl_file = $request->file('nbl_file');
               //dd($nbl_file);
            

                foreach ($nbl_file as $nbl) {
                    $nbl_file_name = time().'.'.$nbl->getClientOriginalName();
                    //dd($nbl_file_name);
                    $nbl->move('/nbl_file', $nbl_file_name);
                    $nbl_names[] = $nbl_file_name; 

                    //$nbl_data = implode(',', array_values($nbl_names));

                    $check = DB::table('nbl_files')
                        ->where('outlet_id', Crypt::decrypt($request->outlet_id))
                        ->where('is_active', 1)
                        ->get();

                    //if ($check->isEmpty()) {

                            //dd($fileName);
                        $values = array(
                            'outlet_id' => Crypt::decrypt($request->outlet_id),
                            'file_url' => $nbl_file_name,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        );

                        DB::table('nbl_files')->insert($values);
               
                   // }

                    // if ($check->isNotEmpty()) {

                    //      $result = DB::table('nbl_files')
                    //         ->where('outlet_id', Crypt::decrypt($request->outlet_id),)
                    //         ->update([
                    //                 'file_url' => $nbl_file_name,
                    //                 'updated_at'  => date('y-m-d H:i:s')
                    //     ]);

                    // }

                }

            return redirect()->back()->withStatus(__('NBL Added To Outlet Successfully..'));

        }

        return redirect()->back()->withStatus(__('error-Something went wrong..'));

    }

    public function remove_nbl_file(Request $request)
    {
        $delete = DB::table('nbl_files')->where('id', $request->id)->update(['is_active' => '0']);
      
        return redirect()->back()->withStatus(__('NBL Removed Successfully..'));  
           
    }

    public function add_outlet_share(Request $request)
    {
        $matchThese = ['is_active' => '1','outlet_id'=>Crypt::decrypt($request->id)];
        $outlets = Outlet::where($matchThese)->with('store')->orderby('created_at','DESC')->get();

        $categories = DB::table('category_details')
            ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.category_id', '=', 'category_details.id')
            ->where('category_details.is_active',1)
            ->where('outlet_products_mapping.is_active',1)
            // ->whereNotNull('outlet_products_mapping.shelf')
            // ->whereNotNull('outlet_products_mapping.target')
            ->where('outlet_products_mapping.outlet_id',Crypt::decrypt($request->id))
            ->get();

        //dd($categories);

        return view('outlet_products.add_share',['outlets' => $outlets, 'categories'=> $categories]);
        
      
    }

    public function outlet_share(Request $request)
    {
        
         $request->validate([
            'outlet_name' =>'required',
            'categories' =>'required',
            //'shelf' =>'required',
            'target' =>'required',
       
        ]);

        //dd($request->all());

        $category_id = array();
        $fileName = '';

        for($i=0;$i<count($request->mapping_id);$i++)
        {

          
            $category_id[] = $request->category_id[$i];
 
            $check = DB::table('outlet_products_mapping')
                ->where('id', $request->mapping_id[$i])
                ->where('outlet_id', $request->outlet_name)
                ->where('category_id', $request->category_id[$i])
                ->where('is_active', 1)
                ->get();

            //dd(0);

             if ($check->isEmpty()) {

                //dd($fileName);

                DB::table('outlet_products_mapping')->insert(
                   array(
                  
                        'outlet_id'  => $request->outlet_name,
                        'category_id' => $request->category_id[$i],
                       // 'shelf' => $request->shelf[$i],
                        'target' => $request->target[$i],
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')

                   )
              );
   
            }


            if ($check->isNotEmpty()) {

                //dd(1);

                 $result = DB::table('outlet_products_mapping')
                    ->where('id', $request->mapping_id[$i])
                    ->where('outlet_id', $request->outlet_name)
                    ->where('category_id', $request->category_id[$i])
                    ->update([
                           // 'shelf' => $request->shelf[$i],
                            'target' => $request->target[$i],
                            'updated_at' => Carbon::now()
                ]);

                   // dd($result);
            }

           
        }

        //dd($category_id);

        $delete = DB::table('outlet_products_mapping')
            ->where('outlet_id', $request->outlet_name)
            ->whereNotIn('category_id', $category_id)
            ->update([
                'shelf' => null,
                'target' => null,
                'updated_at' => Carbon::now()
            ]);



        return redirect()->back()->withStatus(__('Share Of Shelf Added To Outlet Successfully..'));
    }

    public function remove_share(Request $request)
    {
        $delete = DB::table('outlet_products_mapping')->where('id', $request->id)->update([
            'shelf' => null,
            'target' => null,
            'updated_at' => Carbon::now()
        ]);
      
        return redirect()->back()->withStatus(__('Share Of Shelf Removed Successfully..'));  
           
    }

    public function add_outlet_planogram(Request $request)
    {
        $matchThese = ['is_active' => '1','outlet_id'=>Crypt::decrypt($request->id)];
        $outlets = Outlet::where($matchThese)->with('store')->orderby('created_at','DESC')->get();

        $categories = DB::table('category_details')
            ->leftJoin('outlet_products_mapping', 'outlet_products_mapping.category_id', '=', 'category_details.id')
            ->where('category_details.is_active',1)
            ->where('outlet_products_mapping.is_active',1)
            // ->whereNotNull('outlet_products_mapping.shelf')
            // ->whereNotNull('outlet_products_mapping.target')
            ->where('outlet_products_mapping.outlet_id',Crypt::decrypt($request->id))
            ->get();

        //dd($categories);

        return view('outlet_products.add_planogram',['outlets' => $outlets, 'categories'=> $categories]);
        
      
    }


    public function outlet_planogram(Request $request)
    {
         
         $request->validate([
            'outlet_name' =>'required',
            'categories' =>'required',
            //'myfile' =>'required',
       
        ]);

        //dd($request->all());

        $category_id = array();
        $fileName = '';

        for($i=0;$i<count($request->mapping_id);$i++)
        {


            if($request->hasfile('myfile'))
            {
                //dd($request->all());

                if(!empty($request->myfile[$i]))
                {
                    $fileName = time().'.'.$request->myfile[$i]->getClientOriginalName();
                    $request->myfile[$i]->move(public_path('planogram_image'),$fileName);
                }


            }    
          
            $category_id[] = $request->category_id[$i];
 
            $check = DB::table('outlet_products_mapping')
                ->where('id', $request->mapping_id[$i])
                ->where('outlet_id', $request->outlet_name)
                ->where('category_id', $request->category_id[$i])
                ->where('is_active', 1)
                ->get();

           // dd($check);

             if ($check->isEmpty()) {

                //dd($fileName);

                DB::table('outlet_products_mapping')->insert(
                   array(
                  
                        'outlet_id'  => $request->outlet_name,
                        'category_id' => $request->category_id[$i],
                        'planogram_img' => $fileName,
                        'updated_at'  => date('y-m-d H:i:s'),
                        'created_at' => date('y-m-d H:i:s')

                   )
              );
   
            }


            if ($check->isNotEmpty()) {

                if(empty($request->myfile[$i]))
                {
                    $fileName = $check[0]->planogram_img;
                }

                 $result = DB::table('outlet_products_mapping')
                    ->where('id', $request->mapping_id[$i])
                    ->where('outlet_id', $request->outlet_name)
                    ->where('category_id', $request->category_id[$i])
                    ->update([
                            'planogram_img' => $fileName,
                            'updated_at' => Carbon::now()
                ]);

                   //dd($result);
            }

           
        }

        //dd($category_id);

        $delete = DB::table('outlet_products_mapping')
            ->where('outlet_id', $request->outlet_name)
            ->whereNotIn('category_id', $category_id)
            ->update([
                'planogram_img' => null,
                'updated_at' => Carbon::now()
            ]);



        return redirect()->back()->withStatus(__('Planogram Added To Outlet Successfully..'));
    }

    public function remove_planogram(Request $request)
    {
        $delete = DB::table('outlet_products_mapping')->where('id', $request->id)->update([
            'planogram_img' => null,
            'updated_at' => Carbon::now()
        ]);
      
        return redirect()->back()->withStatus(__('Planogram Image Removed Successfully..'));  
           
    }


}
