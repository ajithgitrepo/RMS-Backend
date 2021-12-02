<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;
use App\Employee;
use App\Leave;
use App\Leaverequest;
use App\Employee_Reporting_To;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

use App\Http\Controllers\AuditController as audit_store;


class LeaverequestController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

   //  public static function getPhotographer() {

   //      $results = DB::table('leaverequest')->where('employee_id',Auth::user()->emp_id)->orderby('created_at','DESC')->get();

   //      return $results;
   // }

   
   public function index(Leaverequest $model)
    {       
        // int(8
//dd(Auth::user()->emp_id);  ->where('employee_id',Auth::user()->emp_id)
     $results = DB::table('leaverequest')->where('employee_id',Auth::user()->emp_id)->orderby('created_at','DESC')
               ->where('is_active',1)->get();
   // dd($results);   
     return view('leaverequest.index', ['leaverequest' => $results]);
     
     }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */ 

    public function create()
    {
        $leavetype = "";
        $todate = \Carbon\Carbon::now()->format('Y-m-d');
       
        $results = DB::table('employee')->where('employee_id',Auth::user()->emp_id)->orderby('created_at','DESC')->get();
        $joindate = $results[0]->joining_date;
     
        //  dd($joindate);
        $d1 = new DateTime($todate);
        $d2 = new DateTime($joindate);
       $prob_period = ($d1->diff($d2)->m); // int(4)  joining_date
      //  dd($d1->diff($d2)->m + ($d1->diff($d2)->y*12));

      $gender = $results[0]->gender;

      if($prob_period == 6)
        $leavetype = "Anual";
        return view('leaverequest.create', [
            'leavetype' => $leavetype , 'gender' => $gender //Leave::all()
         ]);

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
     {
       // dd($request->all());

        $request->validate([
            'leavetype'=>'required',
            'leavestartdate'=>'required',
            'leaveenddate'=>'required',
            'reason'=>'required',
            //'supportingdocument.*'=>'required|mimes:jpeg,jpg,png,doc,docx,pdf'
        ]);

        $new_startdate =  date("Y-m-d", strtotime($request->leavestartdate));

        $new_enddate =  date("Y-m-d", strtotime($request->leaveenddate));

        $date1 =  strtotime($request->leavestartdate);
        $date2 =  strtotime($request->leaveenddate);

        $date_count = 0;

        for($i = $date1; $i <= $date2; $i = $i + 86400 ){

            $final_date = date( 'Y-m-d', $i );

          // dd($final_date);

            $results = DB::table('leaverequest')
            ->where('employee_id',Auth::user()->emp_id)
            // ->where('leavestartdate', '<=', $new_startdate )
            // ->where('leaveenddate', '>=', $new_enddate )  
            // ->whereBetween($final_date, ['leavestartdate', 'leaveenddate'])
            ->whereRaw('"'.$final_date.'" between `leavestartdate` and `leaveenddate`')
            ->orderby('created_at','DESC')
            ->count();

            if($results == 1)
            {
                //dd($results);
                return redirect()->route('leaverequest.index')->withStatus(__('Already Requested..'));
            }
            
            
         }

        $getmonths= DB::table('Financial_Year');
                   
      //  $results = DB::select(' SELECT * FROM leaverequest WHERE ( leavestartdate <= '.$new_startdate.' and leaveenddate >= '.$new_startdate.' ) OR ( '.$new_startdate.' <= leavestartdate and '.$new_enddate.' >= leavestartdate ) OR ( leavestartdate < '.$new_enddate.' and leaveenddate >= '.$new_enddate.' ) ');    

      //  dd($results);

        
        $str = null;

        if($request->hasfile('supportingdocument'))
        {
           foreach($request->file('supportingdocument') as $file)
            {
                $fileName=$file->getClientOriginalName();
                $destinationPath = 'leavedocuments/' ;
                $file->move($destinationPath,$fileName);
                $data[] = $fileName;
                $str = implode(",",$data);
            }
        }
	
       $newDate  = date("Y-m-d", strtotime($request->leavestartdate));
       $newDate1 = date("Y-m-d", strtotime($request->leaveenddate));

       $date1 =  strtotime($request->leavestartdate);
       $date2 =  strtotime($request->leaveenddate);

       $date_count = 0;

        for($i = $date1; $i <= $date2; $i = $i + 86400 ){   

            $final_date = date( 'Y-m-d', $i );

            $holyday = DB::table('holidays')->where('is_active',1)
            ->where('date', $final_date)
            ->get();

            if($holyday->isNotEmpty())
            {
                $date_count++;
            }

            if($holyday->isEmpty())
            {

            }
            
         }

        // dd($date_count);

        $start_date = $request->leavestartdate;
        $end_date = $request->leaveenddate;
        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a')+1 - $date_count;  //now do whatever you like with $days

        //dd($days);
        $user = Auth::user()->emp_id;
        $ReportToID = "";
        $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
        if ($ReportTo !== null) 
        $ReportToID = $ReportTo->reporting_to_emp_id; 
        else
        $ReportTo = Employee_Reporting_To::where('reporting_to_emp_id', '=', $user)->first();
        
       // else
       // $ReportToID = Auth::user()->emp_id;
       // dd(Auth::user()->role_id);
        $is_approved = 0;
        if(Auth::user()->role_id == 5)
        $is_approved = 1;

       // dd($ReportTo);
     if($ReportTo != "")
     { 
	DB::table('leaverequest')->insert(
	     array(
		    
            'employee_id'   =>   $user = Auth::user()->emp_id,
           // 'reporting_to_emp_id'  =>  $ReportToID,
		    'leavetype'   =>   $request->leavetype,
		    'leavestartdate'   => $newDate,
		    'leaveenddate'   => $newDate1,
            'total_days'   => $days,
		    'is_approved' => $is_approved,
		    'is_rejected' => '0',
		    'reason'   => $request->reason,
		    'supportingdocument'   =>  $str,
		    'updated_at' => date('y-m-d H:i:s'),
		    'created_at' => date('y-m-d H:i:s')


	     ));

         $notify = new NotificationController();
         $ReportTo = "";
         $ReportTo = Employee_Reporting_To::where('employee_id', '=', $user)->first();
         if( $ReportTo != "")
         $ReportToID = $ReportTo->reporting_to_emp_id; 
         $title = "Leave request from merchandiser";
         $user_type = "merchandiser";
         $created_to = $ReportToID;
         $add_notify =  $notify->store($title, $user_type, $ReportToID);

        $audit = new audit_store();
        $description = ' request a leave ';
        $add_audit =  $audit->store($description,'Leave_Request'); 
	     
        return redirect()->route('leaverequest.index')->withStatus(__('Leave requested successfully'));
       
        }

        else
         return redirect()->route('leaverequest.index')->withStatus(__('Reporting To Not Assigned'));


    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    { 
	 $leave = Leaverequest::find($id);
      
        return view('leaverequest.show',['leave' => $leave]);

    }


    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\Elect $elect

     * @return \Illuminate\Http\Response

     */

    public function edit($id)
    {
    	    	
        $leave = DB::table('leaverequest')
               ->where('lrid', $id)
               ->get();
             
        return view('leaverequest.edit',['leaverequest' => $leave]);

    }

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)
    {

        $request->validate([
               
            'employee_id'   =>   $request->employee_id,
            'leavetype'   =>   $request->leavetype,
            'leavestartdate'   =>   $request->leavestartdate,
            'leaveenddate'   => $request->leaveenddate,
            'is_approved' => '0',
            'is_rejected' => '0',
            'reason'   => $request->reason,
            'supportingdocument'   => $request->supportingdocument,
            ]);
     
       $affected = DB::table('leaverequest')
              ->where('lrid', $id)
              ->update(['employee_id' => $request->employee_id,'leavetype' => $request->leavetype,'leavestartdate' => $request->leavestartdate,'leaveenddate' => 			$request->leaveenddate,'is_approved' => $request->is_approved,'is_rejected' => $request->is_rejected,'reason' => $request->reason,
              'supportingdocument' => $request->supportingdocument,'updated_at'=>date('y-m-d H:i:s'),'created_at'=>date('y-m-d H:i:s')]);

        return redirect()->route('leaverequest.index')->withStatus(__('leave request updated successfully'));

    }

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\Leave $leave

     * @return \Illuminate\Http\Response

     */

         public function destroy($id)
         {

            $delete = DB::table('leaverequest')->where('lrid', $id)->delete();
            
            return redirect()->route('leaverequest.index')->withStatus(__('leave request deleted successfully'));

         }   
  


       public function show_leave_documents(Request $request)
       {
            $result = DB::table('leaverequest')
                ->where('lrid', $request->id)
                ->get();

             return response()->json($result);
       }
 
   } 

