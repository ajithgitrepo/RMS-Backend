<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\leave_balance;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class AddleavebalanceController extends Controller
{
    
   
   public function index( leave_balance $leave)
    {       
       // dd('test');
 $match=['is_active' => '1'];

    $leave=leave_balance::where($match)->with('employee')->get(); 

 $employee= DB::table('employee')->where('is_active',1)->get();
 //->whereIn('designation',[6,5])
    
  //dd($employee); 
     return view('leave_balance.update_leave_balance.index', ['leave' => $leave, 'employee'=>$employee]);
    
         }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

   


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {
    
        $request->validate([
          'employee_id'=>'required',
          'Annual_Leave'=>'required',
       
        ]);


	DB::table('leave_balance')->insert(
	     array(
	    
          'employee_id' => $request->employee_id,
          'Annual_Leave'=>$request->Annual_Leave,

		     'created_at' => date('y-m-d H:i:s')

	     )
	);
   

        return redirect()->route('leavebalance.index')->withStatus(__('Leavebalance created successfully'));

                         

    }


public function get_update_leave_by_hr(Request $request)
   {

    $match=['is_active' => '1'];

   // $leave=->get(); 
            
        $leave = leave_balance::where($match)->with('employee');
        if($request->Empid != "All")
        $leave =   $leave->where('employee_id', $request->Empid);
        $leave =   $leave->get();
            
      //  return view('leave.index',['leave' => $leave]);
      return response()->json($leave);
        
       
    }

    public function update_leave_by_hr(Request $request)
   {
     // dd($request->id);
     
       $affected = DB::table('leave_balance')
              ->where('id', $request->id)
              ->update([
              'Annual_Leave'=>$request->value,
              'updated_at'=>date('y-m-d H:i:s')]);

       return response()->json($affected);

      //  return redirect()->route('leavebalance.index')->withStatus(__('leavebalance updated successfully'));
    

    }


   

    /**

     * Display the specified resource.

     *

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

       $delete = DB::table('leave_balance')->where('id', $id)->update(['is_active' => '0']);
             
  	return redirect()->route('leavebalance.index')->withStatus(__('Leavebalance deleted successfully'));              
                         
          }   
 
   } 

