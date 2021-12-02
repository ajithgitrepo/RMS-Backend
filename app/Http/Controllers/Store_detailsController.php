<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Outlet;
use App\Attendance;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use Illuminate\Validation\Store_details;
use Illuminate\Validation\Rule;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Imports\Store_Import;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\AuditController as audit_store;


class Store_detailsController extends Controller
{
    


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

   
   public function index(Outlet $model)
    {       
        

    if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
    {
		 $model= DB::table('store_details')
		 ->where('is_active',1)
		 //->where('created_by',Auth::user()->emp_id)
		 ->orderby('created_at','DESC')
		 ->paginate(10);

		$use_filter = DB::table('store_details')
		 ->where('is_active',1)
		 ->orderby('created_at','DESC')
		 ->get();
		
		
     return view('store_details.index', ['store' => $model, 'use_filter'=>$use_filter]);

    }

    $model= DB::table('store_details')
     ->where('is_active',1)
     ->where('created_by',Auth::user()->emp_id)
     ->orderby('created_at','DESC')
     ->paginate(10);

    $use_filter= DB::table('store_details')
     ->where('is_active',1)
     ->orderby('created_at','DESC')
    ->where('created_by',Auth::user()->emp_id)
     ->get();



     //dd($model);

   
     return view('store_details.index', ['store' => $model,'use_filter'=>$use_filter]);
    
         }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('store_details.create');

    }

    public function import_store()
    {
      

        return view('store_details.import');

    }

    public function store_import(Request $request)
    {

         $request->validate([
            'store_import' => 'required|mimes:csv,xlsx,xls,txt'
        ]);

         //dd($request->outlet_import);

       if($request->hasfile('store_import'))
        { 

           $customerArr = Excel::toArray(new Store_Import,request()->file('store_import'));

        }

        dd($customerArr); 

         $items = array();    

        for ($i = 0; $i < count($customerArr[0]); $i ++)
        {

           // dd($customerArr[0][$i]['outletname']);

            $store_arr = explode("-",$customerArr[0][$i]['outletname']);

            //dd($store_arr[2]);

            $check = DB::table('store_details')
                ->where('store_code', $store_arr[0])
                ->where('is_active', 1)
                ->get();

            // dd($check);

            if($check->isEmpty()){

                if (isset($store_arr[2])) { 

                      $insert_id = DB::table('store_details')->insertGetId(
                        array(
                            'store_code' =>$store_arr[0],  
                            'store_name'=>$store_arr[1].','.$store_arr[2],
                            'contact_number'=>'',
                            'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                            'created_by'=> Auth::user()->emp_id,
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                           
                        )
                    );

                } 

                else{
                      $insert_id = DB::table('store_details')->insertGetId(
                        array(
                            'store_code' =>$store_arr[0],  
                            'store_name'=>$store_arr[1],
                            'contact_number'=>'',
                            'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                            'created_by'=> Auth::user()->emp_id,
                            'updated_at'  => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                           
                        )
                    );

                }


            }    

            if($check->isNotEmpty()) 
            { 

                if (isset($store_arr[2])) { 

                     $update_store = array(
                        'store_code' =>$store_arr[0],
                        'store_name'=>$store_arr[1].','.$store_arr[2],
                        'contact_number'=>'',
                        'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                        'updated_at'  => date('y-m-d H:i:s')
                      );

                     
                } 

                else{
                     $update_store = array(
                        'store_code' =>$store_arr[0],
                        'store_name'=>$store_arr[1],
                        'contact_number'=>'',
                        'address'=>$customerArr[0][$i]['area'].','.$customerArr[0][$i]['emirates'],
                        'updated_at'  => date('y-m-d H:i:s')
                      );

                }

                 $affected_store = DB::table('store_details')
                      ->where('store_code', $store_arr[0])
                      ->update($update_store);

            }


        }

            return redirect()->route('store_details.index')->withStatus(__('Store imported successfully..'));
      
        
    }


    /**

     * Store a newly created resource in storage.

     *	public function controllerName(Request $request, $id)

{

$this->validate($request, [
        "form_field_name" => 'required|unique:db_table_name,db_table_column_name'
    ]);

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {
   
    	
        $request->validate([

        'store_code' => [
                'required',
            //     Rule::unique('store_details')->where(function($query) {
            //       $query->where('is_active', '=', 1);
            // })
           ],

        'store_name'=>'required|unique:store_details,store_name',
        'contact_number'=>'required|min:9|numeric',
        'address'=>'required',
             
       
        ]);


    	DB::table('store_details')->insert(
    	    array(
        	    'store_code' =>$request->store_code,
                'store_name'=>$request->store_name,
                'contact_number'=>$request->contact_number,
                'address'=>$request->address,
                'created_by'  => Auth::user()->emp_id,
        	    'updated_at'  => date('y-m-d H:i:s'),
        	    'created_at' => date('y-m-d H:i:s')
    	       
    	    )
    	);
       
        $audit = new audit_store();
        $description = ' new store added';
        $add_audit =  $audit->store($description,'Store'); 

        return redirect()->route('store_details.index')->withStatus(__('Store details created successfully'));

                         

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
	$store_details = Store_details::find($id);
        return view('store_details.show',['store' => $store_details]);
        

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
    	    	
        $store_details = DB::table('store_details')
               ->where('id', $id)
               ->get();
             
        return view('store_details.edit',['store' => $store_details]);
        
       
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Outlet $outlet
     

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )

    {
                
      $request->validate([
         'store_code' =>'required',
          'store_name'=>'required|string|unique:store_details,store_name,'.$id,
           'contact_number'=>'required|min:9|numeric',
            'address'=>'required',
        ]);

  
  	
       $affected = DB::table('store_details')
          ->where('id', $id)
          ->update(['store_code' =>$request->store_code,
        		 'store_name'=>$request->store_name,
         		 'contact_number'=>$request->contact_number,
          		 'address'=>$request->address,
       	       'updated_at'  => date('y-m-d H:i:s'),
        	   'created_at' => date('y-m-d H:i:s')]);

        if($affected)
        {
            $audit = new audit_store();
            $description = ' updated a store';
            $add_audit =  $audit->store($description,'Store'); 
        }

        return redirect()->route('store_details.index')->withStatus(__('Store details updated successfully'));


    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

      

       $delete = DB::table('store_details')->where('id', $id)->update(['is_active' => '0']);

        if($delete)
        {
            $audit = new audit_store();
            $description = ' deleted a store';
            $add_audit =  $audit->store($description,'Store'); 
        }
             
  	   return redirect()->route('store_details.index')->withStatus(__('store_details deleted successfully'));              
                         
    }  


public function filter_store(Request $request)
{
    
    //dd($request->all());

    if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
    {
        $model= DB::table('store_details')
         ->where('is_active',1)
         ->orderby('created_at','DESC');
    }

    if(Auth::user()->role->name =="Client")
    {
        $model= DB::table('store_details')
         ->where('is_active',1)
         ->where('created_by',Auth::user()->emp_id)
         ->orderby('created_at','DESC');
    }
     
     
     if(!empty($request->store_code))
  
     {
       $model->where('store_details.store_code',$request->store_code);
     }
         
   
     if(!empty($request->store_id))
  
      {
      
        $model->where('store_details.id',$request->store_id);
   
     }
        $query = $model->paginate(10);
        $query->appends(['store_code' => $request->store_code,'store_id' => $request->store_id]);

        $use_filter= DB::table('store_details')
         ->where('is_active',1)
         ->orderby('created_at','DESC')
         ->get();


     return view('store_details.index', ['store' => $query,'use_filter'=>$use_filter]);

 } 
 
} 

