<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Leave;
use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class LeaveruleController extends Controller
{
    
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

   
   public function index(Leave $model)
    {       
        //dd('test');
     $model= DB::table('leave_rule')->where('is_active',1)->orderby('created_at','DESC')->get();

     $Leave_rule =  DB::table('leave_rule')->where('is_active', 1)->get();
     $anual_count = $Leave_rule[2]->total_days;
     $sick_count = $Leave_rule[0]->total_days;
   //  dd($Leave_rule[2]->total_days);
        $MonthCount = "1"; 
        $todate = \Carbon\Carbon::now()->format('Y-m-d');
       // $d1 = new DateTime($todate);
        $res = DB::table('employee as emp')
        ->join('leave_balance as lb','lb.employee_id','=','emp.employee_id')
        ->select(array('lb.Annual_Leave', 'lb.employee_id', 'lb.total_month','emp.employee_id',
        'emp.created_at','emp.first_name','emp.middle_name','emp.surname', 'lb.mol_contract_date_final',
        \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate') as MonthCount")) )
      //  ->where('lb.employee_id', "RMS0070")//->get();
      ->where('lb.total_month', '!=', \DB::raw("TIMESTAMPDIFF(MONTH, emp.created_at, '$todate')")) //->get();
      ->update([ 
          'lb.Annual_Leave' => DB::raw("lb.Annual_Leave + $anual_count" ),
          'lb.Sick_Leave' => DB::raw("lb.Sick_Leave + $sick_count"),
          'lb.total_month' => DB::raw('lb.total_month + 1'),
        ]);   
 
    
   
     return view('leave_rule.index', ['leave_rule' => $model]);
    }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('leave_rule.create');

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
            'leave_type' => 'required',
            'total_days'=>'required',
            'year'=>'required',
            'requirements'=>'required',
            'remarks'=>'required',
              
        ]);


	DB::table('leave_rule')->insert(
	     array(
		    
		    'leave_type'   =>   $request->leave_type,
		    'total_days'   =>   $request->total_days,
                'year'   =>   $request->year,
		    'requirements'   =>   $request->requirements,
		    'remarks'   => $request->remarks,
		    'updated_at' => date('y-m-d H:i:s'),
		    'created_at' => date('y-m-d H:i:s')

	     )
	);
   

        return redirect()->route('leave_rule.index')->withStatus(__('leave rule created successfully'));

                         

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {
	$leave = Leave::find($id);
        return view('leave_rule.show',['leave' => $leave]);
        

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Elect $elect

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {
    	    	
        $leave = DB::table('leave_rule')
               ->where('leave_rule_id', $id)
               ->get();
             
        return view('leave_rule.edit',['leave_rule' => $leave]);
        
       
    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id )

    {


         $request->validate([
            'leave_type' => 'required',
            'total_days'=>'required',
            //'year'=>'required',
           // 'requirements'=>'required',
            'remarks'=>'required',
              
        ]);

  
  	
       $affected = DB::table('leave_rule')
              ->where('leave_rule_id', $id)
              ->update(['leave_type' => $request->leave_type,'total_days' => $request->total_days,'year' => $request->year,'requirements' => $request->requirements,'remarks' => $request->remarks,
              'updated_at'=>date('y-m-d H:i:s'),'created_at'=>date('y-m-d H:i:s')]);

        return redirect()->route('leave_rule.index')->withStatus(__('leave rule updated successfully'));


    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $delete = DB::table('leave_rule')->where('leave_rule_id', $id)->update(['is_active'=>'0']);
    	
        return redirect()->route('leave_rule.index')->withStatus(__('leave rule deleted successfully'));

                      
                         
          }   
 
   } 

