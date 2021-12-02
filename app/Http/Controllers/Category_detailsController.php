<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category_details;
use App\Brand_details;
use App\Holidays;
use App\Workingdays;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\AuditController as audit_store;


class Category_detailsController extends Controller
{
  
   public function index(Category_details $model)
    {       
        
    if(Auth::user()->role->name =="Top Management" || Auth::user()->role->name =="Admin")
    {
       
        $matchThese = ['is_active' => '1'];

        $model = Category_details::where($matchThese)->get();
        
        //dd($model);
    
        return view('category_details.index',['category' => $model]);

    }

    $matchThese = ['is_active' => '1','created_by' =>Auth::user()->emp_id];

    $model = Category_details::where($matchThese)->get();
    
    //dd($model);

    return view('category_details.index',['category' => $model]);


    }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {
        $brand   = DB::table('brand_details')->where('is_active',1)->where('created_by',Auth::user()->emp_id)->get();
        
        return view('category_details.create',['brands' => $brand]);

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
   {
            $request->validate([
            'category_name' => 'required|unique:category_details',
         
        ]);
         
     
        DB::table('category_details')->insert(
             array(
                
                 //'brand_id'       => $request->brand_id,
                 'category_name'   => $request->category_name,
                 'created_by'      => Auth::user()->emp_id,
                 'updated_at'      => date('y-m-d H:i:s'),
                 'created_at'      => date('y-m-d H:i:s')

             )
        );
       
        $audit = new audit_store();
        $description = ' added a category('. $request->category_name.')';
        $add_audit =  $audit->store($description,'Category'); 

        return redirect()->route('category_details.index')->withStatus(__('Category created successfully'));

                         

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Category_details category

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
     $categorydetails =Category_details::find($id);
        
        return view('category_details.show',['category' => $categorydetails]);
 
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Category_details category
     
     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
                
        $categorydetails = DB::table('category_details')->where('id', $id)->get();
       //dd($categorydetails); 
        $branddetails = DB::table('brand_details')->where('is_active',1)->where('created_by',Auth::user()->emp_id)->get();

        return view('category_details.edit',['category' => $categorydetails,'brands'=>$branddetails]);
       //dd($branddetails); 
       
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

      * @param  \App\Category_details category

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )

    {
     
       $request->validate([
            //'category_name' => 'required|unique:category_details',
            'category_name' => 'required|unique:category_details,category_name,'.$id.' ',
              
        ]);  
           
  
  //  dd($request);    
    
       $affected = DB::table('category_details')
          ->where('id', $id)
          ->update([
            //'brand_id'        => $request->brand_id,
            'category_name'   => $request->category_name,
                       
          ]);

        if($affected){
            $audit = new audit_store();
            $description = ' updated a category('. $request->category_name.')';
            $add_audit =  $audit->store($description,'Category'); 
              
        }
        

        return redirect()->route('category_details.index')->withStatus(__('Category updated successfully'));


    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Category_details category

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $delete = DB::table('category_details')->where('id', $id)->update(['is_active'=>'0']);
        
        if($delete){
            $audit = new audit_store();
            $description = ' deleted a category';
            $add_audit =  $audit->store($description,'Category'); 

        }
        
        return redirect()->route('category_details.index')->withStatus(__('category_details deleted successfully'));

                      
                         
          }   
 
   } 

