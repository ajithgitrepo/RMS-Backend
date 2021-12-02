<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\manualcheckin;
use App\Outlet;


use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class Manual_checkinController extends Controller
{
    


    public function index()
    {

          $manual = DB::table('manualcheckin')->select('manualcheckin.*','employee.first_name','store_details.store_name')
          ->leftJoin('employee','manualcheckin.employee_id','employee.employee_id')
          ->leftJoin('outlet','outlet.outlet_id','manualcheckin.outlet_id')
          ->leftJoin('store_details','store_details.id','outlet.outlet_name')
          ->orderby('manualcheckin.created_at','DESC')->where('manualcheckin.is_active',1)->get();
 // dd($manual);
          // $outlet= DB::table('outlet')->where('is_active',1);
          // $merchandiser=DB::table('employee')->where('is_active',1)->where('designation',6);
          
        return view('manualcheckin.index', ['manual'=>$manual]);

    }


    public function create()

    {
   // dd();
          // $outlet= DB::table('outlet')->where('is_active',1)->get();
          $outlet = Outlet::with('store')
            ->where('is_active', 1)->get();
          $merchandiser=DB::table('employee')->where('is_active',1)->where('designation',6)->get();

 //dd($outlet);
        return view('manualcheckin.create', ['outlet'=>$outlet, 'merchandiser'=>$merchandiser]);

// dd($outlet);
// 
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
          'outlet_id' =>'required',
          'employee_id'=>'required',
          'date'=>'required',
          'checkin_time'=>'required',
          'checkout_time'=>'required', 
          'checkin_location'=>'required', 
          'checkout_location'=>'required', 

        ]);
     $date  = date("Y-m-d", strtotime($request->date));
     $selected = [$request->input('employee_id')];
     $checkin=date('H:i:s',strtotime($request->checkin_time));
     $checkout=date('H:i:s',strtotime($request->checkout_time));
 //dd($selected);
  // dd($checkout);

  // dd($request->outlet_id);

    // $var= DB::table('merchant_time_sheet')->where('outlet_id'= 'outlet_id', 'employee_id'='employee_id', 'date'='date')

   $manualcheckin = DB::table('merchant_time_sheet')
                  ->where('outlet_id',$request->outlet_id)
                  ->where('employee_id',$request->employee_id)
                  ->where('date',$date )
            ->where('merchant_time_sheet.is_active', 1)
            ->count();
if($manualcheckin != 0)
{
      $var= DB::table('merchant_time_sheet')->where('outlet_id',$request->outlet_id)
          ->where('employee_id',$request->employee_id)
          ->where('date',$date )
          ->update(
          [
          
              'outlet_id' => $request->outlet_id,
              'employee_id' => $request->employee_id,
              'date'=>$date,
              'checkin_time' => $checkin,
              'checkout_time' => $checkout,
              'checkin_location' => $request->checkin_location,
              'checkout_location' => $request->checkout_location,
			  'checkout_location' => $request->checkout_location,
			  'is_completed' => '1',
              'updated_at' => date('y-m-d H:i:s')

          ]
      );

      DB::table('manualcheckin')->insert(
        array(
      
            'outlet_id' => $request->outlet_id,
            'employee_id' => $request->employee_id, 
            'date'=>$date,
            'checkin_time' => $checkin,
            'checkout_time' => $checkout,
            'checkin_location' => $request->checkin_location,
            'checkout_location' => $request->checkout_location,
            'created_at' => date('y-m-d H:i:s')
        )
    );
    return redirect()->route('manualcheckin.index')->withStatus(__('manualcheckin Details created successfully'));
}
else
return redirect()->route('manualcheckin.create')->withStatus(__('error-Time sheet not exists'));
   // dd($var);

  

                         

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    

    // public function update(Request $request, $id )

    // {

    //   $request->validate([
    //       'outlet_id' =>'required',
    //       'employee_id'=>'required',
    //       'checkin_time'=>'required',
    //       'checkout_time'=>'required', 
    //       'checkin_location'=>'required', 
    //       'checkout_location'=>'required', 

    //                ]);

  
  	
    //    $affected = DB::table('merchant_time_sheet')
      
    //           ->where('id', $id)
    //           ->update(['outlet_id' => $request->outlet_id,'employee_id' => $request->employee_id, 'checkin_time' => $request->checkin_time,
    //             'checkout_time' => $request->checkout_time,'checkin_location' => $request->checkin_location,'checkout_location' => $request->checkout_location,
    //            'updated_at'=>date('y-m-d H:i:s')]);

    //     return redirect()->route('manualcheckin.create')->withStatus(__('Manual_checkin details  updated successfully'));


    // }

  

    

    public function destroy($id)

    {

       // $delete = DB::table('outlet')->where('outlet_id', $id)->update(['is_active'=>'0']);
    	
      //  return redirect()->route('outlet.index')->withStatus(__('outlet deleted successfully'));

      // $delete = DB::table('outlet')->where('outlet_id', $id)->delete();

       $delete = DB::table('manualcheckin')->where('id', $id)->update(['is_active' => '0']);
             
  	return redirect()->route('manualcheckin.index')->withStatus(__('manualcheckin Details deleted successfully'));              
                         
          }   
 
   } 

