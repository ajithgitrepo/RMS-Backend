<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Brand_details;
use App\Holidays;
use App\Workingdays;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Validation\Rule; 

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
Use Redirect;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\AuditController as audit_store;


class Brand_detailsController extends Controller
{
  
   public function index(Brand_details $model)
    {       
     
 	if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
    {
        $matchThese = ['is_active' => '1','created_by' =>Auth::user()->emp_id];
        $model = Brand_details::where($matchThese)
        ->with('employee_client')
        ->with('employee_field')
        ->with('employee_sales')
        ->paginate(10);

        $employee_field  = DB::table('employee')->where('is_active',1)->where('designation', 5)->get();
        $employee_sales  = DB::table('employee')->where('is_active',1)->where('designation', 9)->get();     
   

       return view('brand_details.index',['branddetails' => $model,'employ_field' => $employee_field,
       'employ_sales' => $employee_sales]);
    }
	 

     $matchThese = ['is_active' => '1', 'created_by' =>Auth::user()->emp_id];
        $model = Brand_details::where($matchThese)
        ->with('employee_client')
        ->with('employee_field')
        ->with('employee_sales')
        ->paginate(10);

     $employee_field  = DB::table('employee')->where('is_active',1)->where('designation', 5)->get();
    $employee_sales  = DB::table('employee')->where('is_active',1)->where('designation', 9)->get();     
   
	return view('brand_details.index',['branddetails' => $model,'employ_field' => $employee_field,
       'employ_sales' => $employee_sales]);

    }
    

    public function create()
    {
  //$employee = DB::table('employee')->where('is_active',1)->get();
  
   
    
      $employee_client  = DB::table('employee')->where('is_active',1)->where('designation', 7)->get();
      $employee_field  = DB::table('employee')
      ->leftJoin('users','users.emp_id','=','employee.employee_id')
      ->where('users.client_id',Auth::user()->emp_id)
      ->where('employee.is_active',1)
      ->where('designation', 5)
      ->get();
      $employee_sales  = DB::table('employee')->where('is_active',1)->where('designation', 9)->get();     
   
      return view('brand_details.create',['employ_client' => $employee_client,'employ_field' => $employee_field,
       'employ_sales' => $employee_sales]);
       
       
   
       
       }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

  public function store(Request $request)
  {

        $client_id = $request->client_id;

	    $request->validate([
            //'brand_name'     => 'required',

             'brand_name' => [
                'required',
                'max:255',
                Rule::unique('brand_details')->where(function($query)  use ($request) {
                  $query->where('client_id', '=', $request->client_id);
            })
           ],

            //'client_id'     => 'required',
            'field_manager_id'=> 'required',
            'sales_manager_id'=> 'required',
          
        ],
        [
            'brand_name.required' => 'The brand name field is required.',
            'brand_name.unique' => 'Already this client has been assinged to this brand. '
        ]);
       

    	DB::table('brand_details')->insert(
    	     array(
    		    
    		        'brand_name'      => $request->brand_name,
    		        'client_id'       =>   Auth::user()->emp_id,
               		'field_manager_id' =>  $request->field_manager_id,
              	 	'sales_manager_id' =>  $request->sales_manager_id,
               		//'created_by'       =>  $request->created_by,
               		'created_by'       => Auth::user()->emp_id,
    		   
    		    	'updated_at'      => date('y-m-d H:i:s'),
    		        'created_at'      => date('y-m-d H:i:s')

    	     )
    	  
    	);

        $audit = new audit_store();
        $description = ' added a brand('. $request->brand_name.')';
        $add_audit =  $audit->store($description,'Brand'); 
	
      return redirect()->route('brand_details.index')->withStatus(__('Brand Added successfully..'));

    }
   
			 
    /**

     * Display the specified resource.

     *

     * @param  \App\brand_details brand

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
	$branddetails =Brand_details::find($id);
        return view('brand_details.show',['branddetails' => $branddetails]);
 
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\brand_details brand
     
     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
   
     $branddetails = DB::table('brand_details') ->where('id', $id)->get();
  //dd($branddetails); 
      $employee_client   = DB::table('employee')->where('is_active',1)->where('designation', 7) ->get();
       $employee_field   = DB::table('employee')->where('is_active',1)->where('designation', 5) ->get();
        $employee_sales  = DB::table('employee')->where('is_active',1)->where('designation', 9) ->get();     
   
        return view('brand_details.edit',['branddetails' => $branddetails,'employ_client' => $employee_client,'employ_field' => $employee_field,
        'employ_sales' => $employee_sales]);
  
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

      * @param  \App\brand_details brand

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )

    {
     $request->validate([
             'brand_name'    => 'required',
             //'client_id'     => 'required',
           'field_manager_id'=> 'required',
           'sales_manager_id'=> 'required',
         
        ]);  
  
//dd($request); 
  	
       $affected = DB::table('brand_details')
              ->where('id', $id)
              ->update([
             
                'brand_name'    => $request->brand_name,
		        'client_id'   =>   Auth::user()->emp_id,
           		'field_manager_id' =>  $request->field_manager_id,
          	 	'sales_manager_id' =>  $request->sales_manager_id,
          	 	
           		'updated_by'       => Auth::user()->emp_id,
           		
		   
		    	'updated_at' => date('y-m-d H:i:s'),
		        'created_at' => date('y-m-d H:i:s')           
              ]);

        if($affected){
            $audit = new audit_store();
            $description = ' updated a brand('. $request->brand_name.')';
            $add_audit =  $audit->store($description,'Brand'); 
        }
            

        return redirect()->route('brand_details.index')->withStatus(__('Brand updated successfully..'));

       // return Redirect::back()->withStatus(__('Brand details updated successfully'));
     }
        

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\brand_details brand

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)
    {

        $delete = DB::table('brand_details')->where('id', $id)->update(['is_active'=>'0']);

        if($delete){
            $audit = new audit_store();
            $description = ' deleted a brand';
            $add_audit =  $audit->store($description,'Brand'); 
        }
    	
        return redirect()->route('brand_details.index')->withStatus(__('Brand deleted successfully..'));
                    
    }   


    public function filter_brand(Request $request)
    {
    
    //dd($request->all());

       $matchThese = ['is_active' => '1', 'client_id' =>Auth::user()->emp_id];
        $model = Brand_details::where($matchThese)
        ->with('employee_client')
        ->with('employee_field')
        ->with('employee_sales');
   
     
     if(!empty($request->brand_name))
  
     {
       $model->where('brand_details.brand_name',$request->brand_name);
     }

     if(!empty($request->field_manager_id))
  
     {
       $model->where('brand_details.field_manager_id',$request->field_manager_id);
     }
     if(!empty($request->sales_manager_id))
  
     {
       $model->where('brand_details.sales_manager_id',$request->sales_manager_id);
     }
     
         
        $query = $model->paginate(10);
        $query->appends(['brand_name' => $request->brand_name,'field_manager_id' => $request->field_manager_id,'sales_manager_id' => $request->sales_manager_id]);

        $employee_field  = DB::table('employee')->where('is_active',1)->where('designation', 5)->get();
        $employee_sales  = DB::table('employee')->where('is_active',1)->where('designation', 9)->get();     
   
    // dd($employee_field); 
     return view('brand_details.index',['branddetails' => $query,'employ_field' => $employee_field,
       'employ_sales' => $employee_sales]);
     
    }
  
 }


