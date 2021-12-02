<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
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

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TaskImport;



class TaskController extends Controller
{
  
   public function index(Task $model, Request $request)
    {       
        
    //dd($request->id);

  	 $model= DB::table('task_details')
     ->where('is_active',1)
     ->where('outlet_id',$request->id)
     ->orderby('created_at','DESC')
     ->get();

     //dd($model);
    
        return view('task.index',['task' => $model]);
    }
   
    public function create()

    {
       // $outlets   = DB::table('outlet')->where('is_active',1)->get();
      // dd($outlets);
        
        return view('task.create');

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
   {

        //dd($request->all());

        $request->validate([
            'task_list' => 'required',
        ]);

       $date = date('Y-m-d');
     
	DB::table('task_details')->insert(
	     array(
		    
		     'outlet_id'  => $request->outlet_id,
             'date'  => $date,
		     'task_list'   => $request->task_list,
             'created_by'  =>Auth::user()->emp_id,
		     'updated_at'      => date('y-m-d H:i:s'),
		     'created_at'      => date('y-m-d H:i:s')

	     )
	);
   

        return redirect()->back()->withStatus(__('Task created successfully'));

                         

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Category_details category

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
	 $task =Task::find($id);
		
        return view('task.show',['task' => $task]);
 
    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Category_details category
     
     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
    	    	
      //  $categorydetails = DB::table('category_details')->where('id', $id)->get();
       //dd($categorydetails); 
       // $branddetails = DB::table('brand_details')->where('is_active',1)->get();

        return view('task.edit');
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

            'task_name' => 'required',
              
        ]);  
           
  
  //  dd($request);    
  	
       $affected = DB::table('task_details')
              ->where('id', $id)
              ->update([
                //'brand_id'        => $request->brand_id,
                 'outlet_id'  => $request->outlet_id,
                'task_list'   => $request->task_list,
                           
              ]);
              

        return redirect()->route('task.index')->withStatus(__('task updated successfully'));


    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Category_details category

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $delete = DB::table('task_details')->where('id', $id)->update(['is_active'=>'0']);
    	
        //return redirect()->route('task.index')->withStatus(__('task deleted successfully'));

        return redirect()->back()->withStatus(__('Task deleted successfully'));

                      
                         
    }   


    public function import_task()
    {

        return view('task.import');

    }

    public function import(Request $request)
    {

         $request->validate([
            'task_import' => 'required|mimes:csv,xlsx,xls,txt'
        ]);

         //dd($request->outlet_import);

       if($request->hasfile('task_import'))
        { 
             //$customerArr = $this->csvToArray($request->outlet_import);

           $customerArr = Excel::toArray(new TaskImport,request()->file('task_import'));

        }

        //dd(count($customerArr[0])); 

       

         $get_outlet =  DB::table('outlet')
           // ->where('created_by', Auth::user()->emp_id)
            ->where('is_active', 1)
            ->get();

        //dd(count($get_outlet));

        $items = array();    

        for ($i = 0; $i < count($get_outlet); $i ++)
        {
            //dd($get_outlet[$i]->task_name);

            for ($j = 0; $j < count($customerArr[0]); $j ++)
            {
                $check = DB::table('task_details')
                    ->where('outlet_id', $get_outlet[$i]->outlet_id)
                    ->where('task_list', $customerArr[0][$j]['task_name'])
                    //->where('created_by', Auth::user()->emp_id)
                    ->where('is_active', 1)
                    ->get();

                //dd($check);

                if($check->isEmpty())
                {
                    //dd($customerArr[0][$i]['task_name']);
                    $date = date('Y-m-d');

                    DB::table('task_details')->insert(
                         array( 
                            
                             'outlet_id'  => $get_outlet[$i]->outlet_id,
                             'date'  => $date,
                             'task_list'   => $customerArr[0][$j]['task_name'],
                             'created_by'  =>Auth::user()->emp_id,
                             'updated_at'      => date('y-m-d H:i:s'),
                             'created_at'      => date('y-m-d H:i:s')

                         )
                    );
                }

                if($check->isNotEmpty())
                {
                   
                    $date = date('Y-m-d');
 
                    $update_task = array(
                         'date'  => $date,
                         'task_list'   => $customerArr[0][$j]['task_name'],
                         'updated_at'      => date('y-m-d H:i:s')
                      );

                     $affected = DB::table('task_details')
                      ->where('outlet_id', $get_outlet[$i]->outlet_id)
                      ->where('task_list', $customerArr[0][$j]['task_name'])
                      //->where('created_by', Auth::user()->emp_id)
                      ->update($update_task);
                }

            }

        }

        //dd($i);

        return redirect()->back()->withStatus(__('Task created successfully'));

 
   } 


}

