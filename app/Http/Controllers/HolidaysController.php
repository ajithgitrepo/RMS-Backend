<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Holidays;
use App\Workingdays;
use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class HolidaysController extends Controller
{
    


   
   
   public function index(Holidays $model)
    {       
        
     $model= DB::table('holidays')->where('is_active',1)->orderby('created_at','DESC')->get();
    
  // dd( $model);
     return view('holidays.index',['holiday' => $model]);
    }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('holidays.create');

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
            'date' => 'required',
            'description'=>'required',
            
              
        ]);
         
         
        
         $holidaydate  = date("Y-m-d", strtotime($request->date));
           
	DB::table('holidays')->insert(
	     array(
		    
		     'date'   =>  $holidaydate,
		     'description'   =>   $request->description,
		   
		     'updated_at' => date('y-m-d H:i:s'),
		     'created_at' => date('y-m-d H:i:s')

	     )
	);
   

        return redirect()->route('holidays.index')->withStatus(__('Holidays created successfully'));

                         

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Holidays holiday

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
	$holiday =Holidays::find($id);
        return view('holidays.show',['holiday' => $holiday]);
        

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Holidays holiday

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
    	    	
        $holiday = DB::table('holidays')
               ->where('id', $id)
               ->get();
             
        return view('holidays.edit',['holiday' => $holiday]);
        
       
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

      * @param  \App\Holidays holiday

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )

    {
           
           
       $request->validate([
            'date' => 'required',
            'description'=>'required',
            
              
        ]);  
           
      $holidaydate  = date("Y-m-d", strtotime($request->date));    
     

     // dd($request); 
  	
       $affected = DB::table('holidays')
              ->where('id', $id)
              ->update([
              'date' => $holidaydate,
              'description' => $request->description
              ]);
              

        return redirect()->route('holidays.index')->withStatus(__('Holidays updated successfully'));


    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Workingdays working

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $delete = DB::table('holidays')->where('id', $id)->update(['is_active'=>'0']);
    	
        return redirect()->route('holidays.index')->withStatus(__('Holidays deleted successfully'));

                      
                         
          }   
 
   } 

