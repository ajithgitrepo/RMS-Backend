<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;
use App\User;  
use App\Employee;
use App\journeyplan;
use App\Outlet;
use App\Leaverequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

class ApiEmployeeDetailsController extends Controller
{
    //
	public function __construct() {
        $this->middleware('auth');
    }

    public $success_status = 200;
    public function change_password(Request $request, Employee $model) {
	
		$user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk = $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();
        
	    $validator = Validator::make($request->all(), [
	        'password' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);   
			} 
		$password =    Hash::make($request->password);  
		$matchThese = ['is_active' => '1', 'employee_id' => $user->emp_id ];
		$UserID = $user->emp_id;  
		 // update post
         $result       =      DB::table('users')
         ->where( 'emp_id', $UserID)
        ->update([//'employee_id' => $request->employee_id,
        'password' => $password, 
         'updated_at'=>date('y-m-d H:i:s')]);   
		 
		 $notify = new ApiNotificationController();
		 $add_notify =  $notify->add_audit_trails("updated password", "password");

		 
		return $printReport->send_result_msg($this->success_status, $result);
	}

	 // By Emp_ID & Month
	 public function all_roles(Request $request, journeyplan $modal)
	 {
		 $user  =  Auth::user();
		 $printReport = new ApiJourneyPlanController();
		 $chk =  $printReport->chech_auth($user);
		 
		 if($chk == false)
		 return $printReport->auth_error_msg();
        
		 $matchThese = ['is_active' => '1' ];
		 $result = Role::where($matchThese)->get();
 
		 return $printReport->send_result_msg($this->success_status, $result);
 
	 }

	 public function add_employee(Request $request, Employee $model)
    {
        try {
      
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg();

		$LastEmpID =  DB::table('employee')->latest('created_at')->first();
        $str = $LastEmpID->employee_id;
		$str2 = substr($str, 3);
		$EmpID = "Emp". "" .($str2 + 1); 
     
        /*   // validation
            $validator      =    Validator::make($request->all(), [
           "date" =>  "required",
           'description'=>'required',
          ]);

           if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        }   */

         $joining_date =   date("Y-m-d", strtotime($request->joining_date)); 
		 $passport_exp_date =   date("Y-m-d", strtotime($request->passport_exp_date));
		 $medical_ins_exp_date =   date("Y-m-d", strtotime($request->medical_ins_exp_date));
		 $visa_exp_date =   date("Y-m-d", strtotime($request->visa_exp_date));

        //  $result = $model->create($request->all());
	
		$checker = Employee::select('email')->where('email',$request->email)->exists();
			if($checker == false)
			{
				$type = "insert";
				$fillData = $this->add_update_emp($type,$EmpID, $request->first_name, $request->middle_name,  $request->surname,
				$request->gender, $request->passport_number, $request->nationality, $request->codes, $request->mobile_number,
				$request->emirates_id, $request->email, $request->designation, $request->department,$joining_date, 
				$passport_exp_date, $request->medical_ins_no, $medical_ins_exp_date, $request->visa_company_name, $visa_exp_date);
				
			    $result =   DB::table('employee')->insert($fillData);
            
				$password = "secret";
				$hashed = Hash::make($password);
		
				$user = array(   
					'emp_id' => $EmpID,
					'name' => $request->first_name,
					'email' => $request->email,
					'password' => $hashed,
					'role_id' => $request->designation,
					'is_active' => '1',
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now()
				);
		
				$leave_balance = array( 
					'employee_id' => $EmpID,
					'Annual_Leave' => 0,
					'Maternity_Leave' => 0,
					'Sick_Leave' => 0,
					'Casual_Leave' => 0,
					'Emergency_Leave' => 0,
					'Parental_Leave' => 0,
					'Medical_Leave' => 0,
					'created_at' => Carbon::now()
				);
		       
				DB::table('users')->insert($user);
				DB::table('leave_balance')->insert($leave_balance);  
                
				$notify = new ApiNotificationController();
		       $add_notify =  $notify->add_audit_trails("Employee Created", "Profile");

				return $printReport->send_result_msg($this->success_status, $result);
			}
			return $printReport->failed_error_msg("Whoops! email_id already exists");
       }
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

	public function update_employee(Request $request, Employee $model)
    {
       
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg();


		$validator = Validator::make($request->all(), [
	        'emp_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}

         $joining_date =   date("Y-m-d", strtotime($request->joining_date)); 
		 $passport_exp_date =   date("Y-m-d", strtotime($request->passport_exp_date));
		 $medical_ins_exp_date =   date("Y-m-d", strtotime($request->medical_ins_exp_date));
		 $visa_exp_date =   date("Y-m-d", strtotime($request->visa_exp_date));

		// Get the value from the form
		$input['email'] =  $request->email;

		// Must not already exist in the `email` column of `users` table
		$rules = array('email' => 'unique:employee,email');

		$validator = Validator::make($input, $rules);

		 if ($validator->fails()) {
			return $printReport->failed_error_msg("Whoops! email_id already exists");
			}
			else
			{

				$type = "update";
				$fillData = $this->add_update_emp($type,$request->emp_id, $request->first_name, $request->middle_name,  $request->surname,
				$request->gender, $request->passport_number, $request->nationality, $request->codes, $request->mobile_number,
				$request->emirates_id, $request->email, $request->designation, $request->department,$joining_date, 
				$passport_exp_date, $request->medical_ins_no, $medical_ins_exp_date, $request->visa_company_name, $visa_exp_date);
				
				$result =   DB::table('employee')->where('employee_id',$request->emp_id)->update($fillData);
                $name = $request->first_name. " " .$request->middle_name. " " .$request->surname;
				$affectedRows = User::where('emp_id',$request->emp_id)->update(['name'=>$name, 'email' => $request->email ]);
                 
				$notify = new ApiNotificationController();
		 $add_notify =  $notify->add_audit_trails("Employee Updated", "Profile");
				
				return $printReport->send_result_msg( $this->success_status, $result);
			}
			
    }

	public function add_update_emp($type,$EmpID, $first_name, $middle_name, $surname,
	$gender, $passport_number,$nationality, $codes, $mobile_number,
	$emirates_id, $email, $designation,$department,$joining_date, 
	$passport_exp_date, $medical_ins_no, $medical_ins_exp_date, $visa_company_name, $visa_exp_date)
	{
          
		$result =  
			array(
			'employee_id'   => $EmpID,
			'first_name'   => $first_name,
			'middle_name'   =>  $middle_name,
			'surname'   =>  $surname,
			'gender'   =>  $gender,
			'passport_number'   =>  $passport_number,
			'nationality'   =>  $nationality,
			'codes'   =>  $codes,
			'mobile_number'   =>  $mobile_number,
			'emirates_id'   =>  $emirates_id,
			'email'   =>  $email,
			'designation'   =>  $designation ,
			'department'   =>  $department ,
			'joining_date'   =>  $joining_date ,
			'passport_exp_date'   =>  $passport_exp_date ,
			'medical_ins_no'   =>  $medical_ins_no ,  // null
			'medical_ins_exp_date'   =>  $medical_ins_exp_date, // null
			'visa_company_name'   =>  $visa_company_name,
			 'visa_exp_date' => $visa_exp_date,
			 'is_active' => 1,
		//	'employee_score'   =>  $request->employee_score ,
			//'created_at' => date('y-m-d H:i:s')
			);
			
			if($type == "update")
			{
				$inserted = array(
					'updated_at'   => date('y-m-d H:i:s'));
			}
			else
			{
				$inserted = array(
					'created_at'   => date('y-m-d H:i:s'));
			}
		
		   $output = array_merge($result, $inserted); 
            return 	$output;

	}


	 public function employee_details(Request $request, Employee $model) {
       
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
		 $chk =  $printReport->chech_auth($user);
		 
		 if($chk == false)
		 return $printReport->auth_error_msg();

	    $validator = Validator::make($request->all(), [
	        'emp_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}
		$emp_id = $request->emp_id;  
		$matchThese = ['is_active' => '1', 'employee_id' => $emp_id ];
		$UserID = $user->emp_id ;
		$result =  Employee::with('documents')->where($matchThese)->get(); 
		
        return $printReport->send_result_msg($this->success_status, $result);
	}

	public function employee_details_by_role(Request $request, Employee $model) {
       
        $user  =  Auth::user();
        $printReport = new ApiJourneyPlanController();
		 $chk =  $printReport->chech_auth($user);
		 
		 if($chk == false)
		 return $printReport->auth_error_msg();

	    $validator = Validator::make($request->all(), [
	        'role_id' => 'required',
	        ]);
			if ($validator->fails())
			{ 
			   return response(['errors'=>$validator->errors()->all()], 422);  
			}
		$designation = $request->role_id;  
		$matchThese = ['is_active' => '1', 'designation' => $designation ];
		$UserID = $user->emp_id ;
		$result =  Employee::where($matchThese)->get(); 
		
        return $printReport->send_result_msg($this->success_status, $result);
	}

	public function employee_details_for_report(Request $request, Employee $model) {
       
        $user  =  Auth::user();
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false)
        return $printReport->auth_error_msg();

		$emp_id = $request->emp_id;  
		$matchThese = ['is_active' => '1'];
		$UserID = $user->emp_id ;
		$result =  Employee::select('employee_id','first_name','middle_name','surname','designation')->where($matchThese)
		->with([
			'Role'  => function($query) {
				$query->select(['id','name']);
			}
		])->get();
		//->with('roles')->where($matchThese)->get(); 
		
        return $printReport->send_result_msg($this->success_status, $result);
	}

	public function add_emp_location(Request $request)
    {
        try {
      
        $user  =  Auth::user();  
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg(); 
     
           // validation
            $validator  =  Validator::make($request->all(), [
            "emp_id" =>  "required",
			"emp_name" =>  "required",
			"outlet_name" =>  "required",
            "outlet_lat" =>  "required",
			"outlet_long" =>  "required",
			"date" =>  "required",
			"time" =>  "required",

           ]);  

           if($validator->fails()) {  
            return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
        } 

       
		$date = date("Y-m-d", strtotime($request->date)); 
        //  $result = $model->create($request->all());  
        
            $result =  DB::table('track_location_details')->insert( 
            array( 
            "emp_id" =>  $request->emp_id,
            "emp_name" =>  $request->emp_name,
            "outlet_name" =>  $request->outlet_name,
            "outlet_lat" =>  $request->outlet_lat,
            "outlet_long" =>  $request->outlet_long,
            "location" =>  $request->location,
             "date" =>  $date,
			 "time" =>  $request->time,
             "created_date" => date('y-m-d H:i:s'),
             "is_active" => 1
            ));  
            
            return $printReport->send_result_msg($this->success_status, $result);
       }  
       catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }


	public function track_employee_location_details(Request $request)
    {
        $user  =  Auth::user();  
        $date = date('Y'); 
		$printReport = new ApiJourneyPlanController();
        $chk =  $printReport->chech_auth($user);
		
        if($chk == false) 
        return $printReport->auth_error_msg();  

		$validator      =   Validator::make($request->all(), [
			"from_date" =>  "required",
			"to_date" =>  "required",
			"emp_id" =>  "required",
		]);
	
			if($validator->fails()) {
			  return response()->json(["status" => "failed", "validation_errors" => $validator->errors()]);
		  } 

        $matchThese = ['is_active' => '1'];
        
		$EmpID = $request->emp_id;
		$from = date("Y-m-d", strtotime($request->from_date)); 
		$to = date("Y-m-d", strtotime($request->to_date)); 

        $result = DB::table('track_location_details')->where('emp_id', $EmpID)
		        ->where($matchThese)->whereBetween('date', [$from, $to])->get();
        
        return $printReport->send_result_msg($this->success_status, $result);

    } 

	
	
}
