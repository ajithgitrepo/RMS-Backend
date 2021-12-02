<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\audit_trial_details;
use App\Role;
use App\Charts\UserChart;

use App\EXports\AuditExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Requests;  
use Illuminate\Support\Facades\Hash;  

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;


use Illuminate\Support\Facades\Auth;


class Audit_trial_detailsController extends Controller
{
    
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

   
   public function index(audit_trial_details $model)
    {       

    $match=['is_active' => '1'];

    // $model=audit_trial_details::where($match)->with('client')->with('field')->with('sales')->get();  
        
    $model= audit_trial_details::where($match)
    //->whereDate('date', DB::raw('CURDATE()'))
    ->whereDate('date',  date('Y-m-d'))

    ->orderBy('created_at', 'DESC')->get();

    $role=DB::table('roles')->where('is_active','1')->get();
   // dd($model);
   $start_date = date('d-m-Y');
   $end_date   = date('d-m-Y');

   $role_id   = "6";

   $filter_type  = "";

   $reporting_to_emp_id = "";

    return view('audit_trial_details.index', ['audit' => $model, 'start_date'=>$start_date, 
   'end_date'=>$end_date, 'reporting_to_emp_id'=>$reporting_to_emp_id, 'filter_type'=>$filter_type]);
   
    // return view('audit_trial_details.index', ['audit' => $model, 'role'=>$role]);

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

    

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

   


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

   

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Outlet $outlet

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

       // $delete = DB::table('outlet')->where('outlet_id', $id)->update(['is_active'=>'0']);
    	
      //  return redirect()->route('outlet.index')->withStatus(__('outlet deleted successfully'));

      // $delete = DB::table('outlet')->where('outlet_id', $id)->delete();

       $delete = DB::table('audit_trial_details')->where('id', $id)->update(['is_active' => '0']);
             
  	return redirect()->route('audit_trial_details.index')->withStatus(__('Audit Trial Details deleted successfully'));              
                         
   } 

  public function filter_audit(Request $request, audit_trial_details $model)
    {  //dd('test');
       // dd($request->filter_type);
        //return $request->id;
 
        $start_date = $request->start_date; 
        $end_date = $request->end_date;

        $matchThese = ['is_active' => '1'];
        $query = audit_trial_details::where($matchThese)->with('roles');
        
      //  if(!empty($request->role_id) && ($request->role_id !== null)   )
      //  {
      //     $query->where('audit_trial_details.role_id',$request->role_id);
      //   }

        if(!empty($request->reporting_to_emp_id) && ($request->reporting_to_emp_id !== null)   )
       {
           // dd($request->reporting_to_emp_id);
          $query->where('audit_trial_details.created_by',$request->reporting_to_emp_id);
        }
           
       if(!empty($end_date) && !empty($start_date) )
        {
             $date_search_start_date = date('Y-m-d', strtotime($start_date));
             $date_search_end_date = date('Y-m-d', strtotime($end_date));

             $query->whereBetween('audit_trial_details.date', [$date_search_start_date, $date_search_end_date]);
        }
// dd($request->start_date);
        if(!empty($request->filter_type) && ($request->filter_type !== null))
        {
           $query->where('audit_trial_details.type',$request->filter_type);
        }

        $result = $query->get();
 
        $role = DB::table('roles')->where('is_active','1')->get();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
 
     //   $role_id = $request->role_id;

        $filter_type = $request->filter_type;

        $reporting_to_emp_id = $request->reporting_to_emp_id;
     // dd($start_date);
    // dd( $result);
        return view('audit_trial_details.index', ['audit' => $result, 'start_date'=>$start_date, 
        'end_date'=>$end_date, 'reporting_to_emp_id'=>$reporting_to_emp_id, 'filter_type'=>$filter_type]);
       
    }

    public function export() 
    {
        return Excel::download(new AuditExport, 'audit_trial_details.xlsx');
    }
   
   } 

