<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Workingdays;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class WorkingdaysController extends Controller
{
    


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

   
   public function index(Workingdays $model)
    {       
        
     $model= DB::table('working_days')->orderby('created_at','DESC')->get();
    
  // dd( $model);
     return view('working_days.index', ['working' => $model]);
    }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('working_days.create');

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
            'year' => 'required',
            'month'=>'required',
            'working_days'=>'required',
           
              
        ]);

           
	DB::table('working_days')->insert(
	     array(
		    
		    'year'   =>   $request->year,
		    'month'   =>   $request->month,
		    'working_days'   =>   $request->working_days,
		    
		     'updated_at' => date('y-m-d H:i:s'),
		    'created_at' => date('y-m-d H:i:s')

	     )
	);
   

        return redirect()->route('working_days.index')->withStatus(__('workind days created successfully'));

                         

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Workingdays working

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
	$working = Workingdays::find($id);
        return view('working_days.show',['working' => $working]);
        

    }


    /**

     * Show the form for editing the specified resource.

     *

      * @param  \App\Workingdays working

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
    	    	
        $working = DB::table('working_days')
               ->where('id', $id)
               ->get();
             
        return view('working_days.edit',['working' => $working]);
        
       
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

      * @param  \App\Workingdays working

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )

    {


         $request->validate([
            'year' => 'required',
            'month'=>'required',
            'working_days'=>'required',
           
              
        ]);
  
  	
       $affected = DB::table('working_days')
              ->where('id', $id)
              ->update(['year' => $request->year,'month' => $request->month,'working_days' => $request->working_days,
              'updated_at'=>date('y-m-d H:i:s'),'created_at'=>date('y-m-d H:i:s')]);

        return redirect()->route('working_days.index')->withStatus(__('working days updated successfully'));


    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Workingdays working

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $delete = DB::table('working_days')->where('id', $id)->delete();
    	
        return redirect()->route('working_days.index')->withStatus(__('working days deleted successfully'));

                      
                         
          }   
 
   } 

