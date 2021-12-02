<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Employee;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Imports\UsersImport;
use App\Imports\LeaveImport;

use Maatwebsite\Excel\Facades\Excel;
use App\Services\PayUService\Exception;


class EmployeeController extends Controller
{
    public function index(Employee $model)
    {

        $matchThese = ['is_active' => '1'];

        //$result = Employee::where($matchThese)->with('documents')->get();

        $result = $model->with('documents')->with('Role')->where($matchThese)->whereNotIn('designation', [7])->paginate(10);
        
		 $roles = DB::table('roles')->where('is_active', 1)->get();
    //   dd($roles);

        return view('employee.management.index', ['employee' => $result, 'roles' => $roles]);
    }
    
    public function create(Role $model)
    {

        $roles = DB::table('roles')
                ->where('is_active', 1)
                ->get();

        return view('employee.management.create', ['roles' => $roles]);
    }

    public function store(Request $request, Employee $model)
    {

        // dd($request->visa_company_name);

       //  dd($request->all());
        
        $validatedData = $request->validate([
            'employee_id'=>'required|max:255',
    		'first_name' => 'required|max:255',
            'surname' => 'required|max:255',
           // 'nationality' => 'required|max:255',
           // 'mobile_number' => 'required|digits:10',
           // 'emirate_id' => 'required|max:20', 
    		//'email' => 'required|email|unique:employee',
           // 'designation' => 'required|max:255',
           // 'department' => 'required|max:255',
           // 'joining_date' => 'required|date',
           // 'passport_number' => 'required|max:255',
           // 'visa_exp_date' => 'required|date',
           // 'passport_exp_date' => 'required|date',
           // 'visa_company_name' => 'required|max:255',

	    ]);

        $joining_date = $request->joining_date;
        //dd($joining_date);
        $new_joining_date = date("Y-m-d", strtotime($joining_date));  

        $visa_exp_date = $request->visa_exp_date;
        $new_visa_exp_date = date("Y-m-d", strtotime($visa_exp_date));  

        $passport_exp_date = $request->passport_exp_date;
        $new_passport_exp_date = date("Y-m-d", strtotime($passport_exp_date)); 

        //dd( $new_passport_exp_date); 

        $medical_ins_exp_date = $request->medical_ins_exp_date;
        $new_medical_ins_exp_date = date("Y-m-d", strtotime($medical_ins_exp_date));  

        $random_emp_id = rand(1000,10000);

         //dd($random_emp_id);

        $employee = array(
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'surname' => $request->surname,
            'passport_number' => $request->passport_number,
            'nationality' => $request->nationality,
            'mobile_number' => $request->mobile_number, 
            'emirates_id' => $request->emirates_id, 
            'email' => $request->email,
            'designation' => $request->designation,
            'department' => $request->department,
            'joining_date' => $new_joining_date,
            'visa_exp_date' => $new_visa_exp_date,
            'passport_exp_date' => $new_passport_exp_date,
            'medical_ins_no' => $request->medical_ins_no,
            'medical_ins_exp_date' => $new_medical_ins_exp_date,
            'visa_company_name' => $request->visa_company_name,
            //'employee_score' => $request->employee_score,
            'is_active' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );
    //dd($employee);
        $password = "secret";
        $hashed = Hash::make($password);

        $user = array(   
            'emp_id' =>$request->employee_id ,
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => $hashed,
            'role_id' => $request->designation,
            'is_active' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

         $leave_rule = DB::table('leave_rule')
            ->where('is_active', 1)
            ->get(); 

       $Annual_Leave =""; $Maternity_Leave=""; $Sick_Leave=""; $Casual_Leave=""; $Emergency_Leave="";
        $Parental_Leave =""; $Medical_Leave="";

        foreach ($leave_rule as $value) {
          if($value->leave_type == 'Annual_Leave'){

              $Annual_Leave = $value->total_days;
          }  
           if($value->leave_type == 'Maternity_Leave'){
            
              $Maternity_Leave = $value->total_days;
          }  
           if($value->leave_type == 'Sick_Leave'){
            
              $Sick_Leave = $value->total_days;
          }  
           if($value->leave_type == 'Emergency_Leave'){
            
              $Emergency_Leave = $value->total_days;
          }  
           if($value->leave_type == 'Parental_Leave'){
            
              $Parental_Leave = $value->total_days;
          }  
           if($value->leave_type == 'Medical_Leave'){
            
              $Medical_Leave = $value->total_days;
          }  
          if($value->leave_type == 'Casual_Leave'){
            
              $Casual_Leave = $value->total_days;
          }  
          
        }

        $leave_balance = array( 
            'employee_id' => $request->employee_id,
            'Annual_Leave' => 0,
            'Maternity_Leave' => $Maternity_Leave,
            'Sick_Leave' => 0,
            'Casual_Leave' => $Casual_Leave,
            'Emergency_Leave' => $Emergency_Leave,
            'Parental_Leave' => $Parental_Leave,
            'Medical_Leave' => $Medical_Leave,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        //dd($Casual_Leave);
	
        DB::table('employee')->insert($employee);
        DB::table('users')->insert($user);
        DB::table('leave_balance')->insert($leave_balance);

        return redirect()->route('employee.index')->withStatus(__('Employee successfully created.'));
    }
    
     public function edit($id)
    {
        //dd($id);
        $matchThese = ['employee_id' => $id];
        $results = Employee::where($matchThese)->get();
        $roles = DB::table('roles') ->where('is_active', 1) ->get();
        //dd($results);
        //$emp = Employee::find($id);
        return view('employee.management.edit',['employee' => $results,'roles' => $roles]);
    }
    
    public function update(Request $request, $id, Employee $model)
    {
          //dd($request->all());
        $validatedData = $request->validate([
            //'employee_id' => 'required|unique:employee,employee_id'. $id,
            'employee_id' => 'required|unique:employee,employee_id,'.$id.',employee_id',
            'first_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'nationality' => 'required|max:255',
           // 'email' => 'required|email|unique:employee',
            'email' => 'required|email|unique:employee,email,'.$id.',employee_id',
            'codes' =>'required',
            'mobile_number' => 'required|min:9',
            'gender'=> 'required|in:male,female',
            'emirates_id' => 'required|max:20',
            'designation' => 'required|max:255',
            'department' => 'required',
            'joining_date' => 'required|date',
            'passport_number' => 'required|max:255',
            'visa_exp_date' => 'required|date',
            'passport_exp_date' => 'required|date',
            // 'medical_ins_no'  => 'required|max:255',
            // 'medical_ins_exp_date' => 'required|date',
            'visa_company_name' => 'required|max:255',
        ]);
//dd($request);
//dd($request->codes);
       // dd($request->all());
        $joining_date = $request->joining_date;
        $new_joining_date = date("Y-m-d", strtotime($joining_date));
        $visa_exp_date = $request->visa_exp_date;
        $new_visa_exp_date = date("Y-m-d", strtotime($visa_exp_date));
        $passport_exp_date = $request->passport_exp_date;
        $new_passport_exp_date = date("Y-m-d", strtotime($passport_exp_date));
        //dd( $new_passport_exp_date);
        $medical_ins_exp_date = $request->medical_ins_exp_date;
        $new_medical_ins_exp_date = null;
        if(!empty($medical_ins_exp_date))
        {
            $new_medical_ins_exp_date = date("Y-m-d", strtotime($medical_ins_exp_date));
        }
        //dd($request->gender);
            $result = DB::table('employee')
                ->where('employee_id', $id)
                ->update([
                    'employee_id' => $request->employee_id,
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'surname' => $request->surname,
                    'nationality' => $request->nationality,
                    'email' => $request->email,
                    'codes' => $request->codes,
                    'mobile_number' => $request->mobile_number,
                    'gender' => $request->gender,
                    'emirates_id' => $request->emirates_id,
                    'designation' => $request->designation,
                    'department' => $request->department,
                    'joining_date' => $new_joining_date,
                    'passport_number' => $request->passport_number,
                    'visa_exp_date' => $new_visa_exp_date,
                    'passport_exp_date' => $new_passport_exp_date,
                    'medical_ins_no' => $request->medical_ins_no,
                    'medical_ins_exp_date' => $new_medical_ins_exp_date,
                    'visa_company_name' => $request->visa_company_name,
                    //'employee_score' => $request->employee_score,
                    'is_active' => '1',
                    'updated_at' => Carbon::now(),
             ]);
            //  $user = array(
            //     'name' => $request->first_name,
            //     'email' => $request->email,
            //     'role_id' => $request->designation,
            //     'is_active' => '1',
            //     'updated_at' => Carbon::now()
            // );
            $user = DB::table('users')
                ->where('emp_id', $request->employee_id)
                ->update([
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'role_id' => $request->designation,
                    'is_active' => '1',
                    'updated_at' => Carbon::now()
                ]);
   // dd($result);
        //$model->update($request->all());
        return redirect()->route('employee.index')->withStatus(__('Employee successfully updated.'));
    }

     public function destroy(Request $request, $id, Employee $model)
    {
        //$delete = DB::table('employee')->where('id', $id)->delete();
        $result = DB::table('employee')
                ->where('employee_id', $id)
                ->update([
                    'is_active' => '0',
                    'updated_at' => Carbon::now()
             ]);
        return redirect()->route('employee.index')->withStatus(__('Employee successfully deleted.'));
    }

    public function view_employee(Request $request)
    {
        //dd($request->id);
        //return $request->id;
        $result = DB::table('employee')
                ->where('employee_id', $request->id)
                ->get();
       return response()->json($result);
    }

    public function import_employee_csv()
    {
        
          return view('employee.management.import');

    }

   public function bulk_import_employee_csv(Request $request, Employee $model)
    {
         
        //$file = public_path('file/wk_mp_reward_details.csv');

       // dd($request->customer_detail_import);

       $request->validate([
        'employee_import' => 'required|mimes:csv,xlsx,xls,txt'
    ]);

     // dd($request->employee_import);

   if($request->hasfile('employee_import'))
    { 
         //$customerArr = $this->csvToArray($request->outlet_import);

       $customerArr = Excel::toArray(new UsersImport,request()->file('employee_import'));

    }
// dd($customerArr);
    //    if($request->hasfile('customer_detail_import'))
    //     { 
    //          $customerArr = $this->csvToArray($request->customer_detail_import);
    //     }

      
   
       $items = array();  

        for ($i = 0; $i < count($customerArr[0]); $i ++)
        {
           // dd($customerArr[0][$i]);
            // if($check->isEmpty()){
            //     $items[] = $customerArr[0][$i]['Outlet Name'];
            // }
           
   // if ($check->isNotEmpty()) 
   // {  
   // dd($customerArr[0][$i]['employee_id']); 

   if($customerArr[0] != null && $customerArr[0][$i]['employee_id'] != null) 
   {
       $passport_expiry = ""; $JDate = "";

       $faker = \Faker\Factory::create();  
                 if($customerArr[0][$i]['email'] != null)
                 $email = $customerArr[0][$i]['email'];
                 else
                 $email = preg_replace('/@example\..*/', '@rhapsody.ae', $faker->unique()->safeEmail);
     
      $chaeck = Employee::where('email',  $email)->count();
      //where('employee_id',  $customerArr[0][$i]['employee_id'])
      

      //if($customerArr[0][$i]['employee_id'] == "Emp3644")
     // dd($customerArr[0][$i]['doj']);

        if ($chaeck == 0) 
        {     

             $JDate =null;
             if (array_key_exists('doj', $customerArr[0][$i])) {
             if($customerArr[0][$i]['doj'] != null)
             $JDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($customerArr[0][$i]['doj'])->format('Y-m-d');
         // dd($JDate);
             }

             if( $JDate == null)
             $JDate = date('Y-m-d');

             // $Passport_Date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($customerArr[0][$i]['passport_expiry'])->format('Y-m-d');
            // ( Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($customerArr[0][$i]['doj'])));
          
          //  $Passport_Date =  Carbon::parse($customerArr[0][$i]['passport_expiry'])->format('M d, Y');
          //  dd($Passport_Date);

      if (array_key_exists('passport_expiry', $customerArr[0][$i])) {
            try {
            
                $Passport_Date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($customerArr[0][$i]['passport_expiry'])->format('Y-m-d');
            } catch (\Exception $e) {   
                $error =  $e->getMessage(); 
                if($error == "A non well formed numeric value encountered" )
                $Passport_Date = date('Y-m-d');;
            } 
        }
        else
        $Passport_Date = date('Y-m-d');
    // dd($Passport_Date);


        /*
        finally {
          //  if($error == "The separation symbol could not be found")
          $Passport_Date = Carbon::createFromFormat('d/M/Y', $customerArr[0][$i]['passport_expiry'])->format('Y-m-d');
          if (strtotime($Passport_Date) !== false)
            dd( $Passport_Date);
           // $Passport_Date =  date('Y-m-d');
            // deal with error array
        }  */
        // $carbDate=Carbon::createFromFormat('Y/m/d', $customerArr[0][$i]['passport_expiry']);
         //   $date = str_replace('/', '-', $customerArr[0][$i]['passport_expiry']);
        //   $newDate = date("Y-m-d", strtotime($date));
          //  dd($carbDate);
                $random_emp_id = rand(1000,10000);

                 $password = "secret";
                 $hashed = Hash::make($password);
                
               //  dd($email); 
                 $designation = 6; 
                 if($customerArr[0][$i]['job_title']  == "FIELD MANAGER")
                 $designation = 5;
                 if($customerArr[0][$i]['job_title']  == "MERCHANDISER")
                 $designation = 6;
                 if($customerArr[0][$i]['job_title']  == "KEY ACCOUNT EXECUTIVE")
                 $designation = 13;
                 if($customerArr[0][$i]['job_title']  == "FIELD SUPERVISOR")
                 $designation = 14;
                 if($customerArr[0][$i]['job_title']  == "ACCOUNT COORDINATOR")
                 $designation = 4;
                 if($customerArr[0][$i]['job_title']  == "ACCOUNTANT")
                 $designation = 4;
                 if($customerArr[0][$i]['job_title']  == "HUMAN RESOURCE")
                 $designation = 3;



                 if($customerArr[0][$i]['gender']  != "FEMALE")
                 $gender = "male";
                 else
                 $gender = "female";

                 $employee_last_name =null;
                 if (array_key_exists('employee_last_name', $customerArr[0][$i])) {
                 if($customerArr[0][$i]['employee_last_name'] != null)
                 $employee_last_name = $customerArr[0][$i]['employee_last_name'];
                 }

                 $marital_status =null;
                 if (array_key_exists('marital_status', $customerArr[0][$i])) {
                 $marital_status = $customerArr[0][$i]['marital_status'];
                 }

                 $work_contact_number =null;
                 if (array_key_exists('work_contact_number', $customerArr[0][$i])) {
                 $work_contact_number = $customerArr[0][$i]['work_contact_number'];
                 }

                 $mobile_no =null;
                 if (array_key_exists('mobile_no', $customerArr[0][$i])) {
                 $mobile_no = $customerArr[0][$i]['mobile_no'];
                 }

                 $department ="sale";
                 if (array_key_exists('department', $customerArr[0][$i])) {
                 $department = $customerArr[0][$i]['department'];
                 // dd($department);
                 }

                 $work_permit_no_labor_card_no =null;
                 if (array_key_exists('work_permit_no_labor_card_no', $customerArr[0][$i])) {
                 $work_permit_no_labor_card_no = $customerArr[0][$i]['work_permit_no_labor_card_no'];
                 }

                 $person_codemol_id_personnel_number_max_14_digit =null;
                 if (array_key_exists('person_codemol_id_personnel_number_max_14_digit', $customerArr[0][$i])) {
                 $person_codemol_id_personnel_number_max_14_digit = $customerArr[0][$i]['person_codemol_id_personnel_number_max_14_digit'];
                 }

                 $trade_license_select_from_the_drop_down_list =null;
                 if (array_key_exists('trade_license_select_from_the_drop_down_list', $customerArr[0][$i])) {
                 $trade_license_select_from_the_drop_down_list = $customerArr[0][$i]['trade_license_select_from_the_drop_down_list'];
                 }

                 $location =null;
                 if (array_key_exists('location', $customerArr[0][$i])) {
                 $location = $customerArr[0][$i]['location'];
                 }

                 $location =null;
                 if (array_key_exists('location', $customerArr[0][$i])) {
                 $location = $customerArr[0][$i]['location'];
                 }

                 $business_unit =null;
                 if (array_key_exists('business_unit', $customerArr[0][$i])) {
                 $business_unit = $customerArr[0][$i]['business_unit'];
                 }
                
                 $business_unit =null;
                 if (array_key_exists('business_unit', $customerArr[0][$i])) {
                 $business_unit = $customerArr[0][$i]['business_unit'];
                 }

                 $line_manager_1 =null;
                 if (array_key_exists('line_manager_1', $customerArr[0][$i])) {
                 $line_manager_1 = $customerArr[0][$i]['line_manager_1'];
                 }
                  
                    $user = array(   
                        'emp_id' => $customerArr[0][$i]['employee_id'],
                        'name' => $customerArr[0][$i]['employee_first_name'],
                        'email' => $email,
                        'password' => $hashed,
                        'role_id' => $designation,
                        'is_active' => '1',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    );

                  $values = array( 
                  
                  'employee_id' => $customerArr[0][$i]['employee_id'],
                  'first_name' => $customerArr[0][$i]['employee_first_name'],
                  'surname' => $employee_last_name,
      
                  'gender' =>  $gender,
                  //$customerArr[0][$i]['gender'],
                  'joining_date' => $JDate,
                  'emirates_id' => $location,
      
                  'visa_company_name' => $trade_license_select_from_the_drop_down_list,
                  // 'Person_code' => $person_codemol_id_personnel_number_max_14_digit,
               //
                  // 'work_permit_no' => $work_permit_no_labor_card_no,
      
                  'designation' => $designation,
                  'department' => $department,
                  'mobile_number' => $mobile_no,
      
                  // 'work_contact_number' => $work_contact_number,
                  'email' => $email,
                  // 'marital_status' => $marital_status,
                  
      
               //   'passport_number' => $customerArr[0][$i]['passport_no'],
                  'passport_exp_date' => $Passport_Date,

                 // 'business_unit' => $business_unit,

                  'is_active' => "1", 
                
                  'created_at' => date('Y-m-d H:i:s')
                  );

                  $leave_rule = DB::table('leave_rule')
                  ->where('is_active', 1)
                  ->get(); 
      
             $Annual_Leave =""; $Maternity_Leave=""; $Sick_Leave=""; $Casual_Leave=""; $Emergency_Leave="";
              $Parental_Leave =""; $Medical_Leave="";
      
              foreach ($leave_rule as $value) {
                if($value->leave_type == 'Annual_Leave'){
      
                    $Annual_Leave = $value->total_days;
                }  
                 if($value->leave_type == 'Maternity_Leave'){
                  
                    $Maternity_Leave = $value->total_days;
                }  
                 if($value->leave_type == 'Sick_Leave'){
                  
                    $Sick_Leave = $value->total_days;
                }  
                 if($value->leave_type == 'Emergency_Leave'){
                  
                    $Emergency_Leave = $value->total_days;
                }  
                 if($value->leave_type == 'Parental_Leave'){
                  
                    $Parental_Leave = $value->total_days;
                }  
                 if($value->leave_type == 'Medical_Leave'){
                  
                    $Medical_Leave = $value->total_days;
                }  
                if($value->leave_type == 'Casual_Leave'){
                  
                    $Casual_Leave = $value->total_days;
                }  
                
              }
      
              $leave_balance = array( 
                  'employee_id' => $customerArr[0][$i]['employee_id'],
                  'Annual_Leave' => 0,
                  'Maternity_Leave' => $Maternity_Leave,
                  'Sick_Leave' => 0,
                  'Casual_Leave' => $Casual_Leave,
                  'Emergency_Leave' => $Emergency_Leave,
                  'Parental_Leave' => $Parental_Leave,
                  'Medical_Leave' => $Medical_Leave,
                  'created_at' => Carbon::now(),
                  'updated_at' => Carbon::now()
              );
      
              // dd($leave_balance);
             
              DB::table('employee')->insert($values);
              DB::table('users')->insert($user);
              DB::table('leave_balance')->insert($leave_balance);

              if($line_manager_1 != "")
              {
                $repotto_id= "";
                if($customerArr[0][$i]['line_manager_1'] == "PONRAJ")
                    $repotto_id= "Emp5665";
                    // dd($repotto_id); 
                    
               if($repotto_id != "")
               {

                    DB::table('employee_reporting_to')->insert(
                        array(

                            'employee_id'   =>  $customerArr[0][$i]['employee_id'],
                            'reporting_to_emp_id'   =>  $repotto_id,
                            'reporting_date'   =>  date('Y-m-d'), 
                            'reporting_end_date'   => "2024-06-15",
                            'updated_at' => date('y-m-d H:i:s'),
                            'created_at' => date('y-m-d H:i:s')
                
                            )
                    );

               }
                   // dd($repotto_id);
             
             
                }
      
                //    DB::table('customer_details')->insert($values);
                }
              }
            }
             

      //  }

      return redirect()->back()->withStatus(__('Imported successfully')); 

    }
    public function filter_employee(Request $request,Employee $model)
    {

        $matchThese = ['is_active' => '1'];

        //$result = Employee::where($matchThese)->with('documents')->get();

        $results = $model->with('documents')->with('Role')->where($matchThese);

        //dd($result);
		
         if(!empty($request->designation))
      
         {
         
                $results->where('employee.designation',$request->designation);
         }

         if(!empty($request->nationality))
      
         {
         
                $results->where('employee.nationality',$request->nationality);
         }
		
		if(!empty($request->emp_id))
      
         {
         
                $results->where('employee.employee_id',$request->emp_id);
         }

       
        $query = $results->paginate(10);
        $query->appends(['designation' => $request->designation,'nationality' => $request->nationality]);

        $roles = DB::table('roles')->where('is_active', 1)->get();



       return view('employee.management.index', ['employee' => $query,'roles' => $roles]);


    }


 public function import(Request $request)
    {

        return view('employee.import');
       
    }

    public function import_leave(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls,txt']);
        if($request->hasfile('file'))
        {
            $array = Excel::toArray(new LeaveImport, request()->file('file'));
             // dd($array);

        }




        for ($i = 0; $i < count($array[0]); $i ++)
        {
            $check=DB::table('employee')->where('employee_id',$array[0][$i]['employee_id'])->get();

            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($array[0][$i]['doj_final']);

        if($check->isNotEmpty())
       {
              

            if($check->isNotEmpty())
            {
                $employee_joining_date=array(
                    'employee_id'=> $array[0][$i]['employee_id'],
                    'joining_date'=>$date->format('Y-m-d')
                );


            }


            $update=DB::table('employee')->where('employee_id',$array[0][$i]['employee_id'])
                ->update($employee_joining_date);


            $leave=DB::table('leave_balance')->where('is_active',1)
            ->where('employee_id',$array[0][$i]['employee_id'])->get();
//            dd($leave);

           if($array[0][$i]['mol_contract_date_final'] != "IN PROCESS")
           {
            $mol=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($array[0][$i]['mol_contract_date_final']);
//dd($mol);
             $cdate = $check[0]->created_at;
         //  dd($cdate);
             $date1 =  $check[0]->created_at;   // $cdate->format('Y-m-d'); // D.O.J
            $date2 = date('Y-m-d');

            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

           // dd($diff);

//            dd($mol);
           
           $anual_count = $diff * 2.50;
           $sick_count =  $diff * 1.25;


            if($leave->isNotEmpty())
            {
                $employee_leave=array(
                    'annual_leave_accured'=>number_format( $array[0][$i]['annual_leave_accured'],2),
                    'annual_leave_availed'=> number_format($array[0][$i]['annual_leave_availed']),
                    'Annual_Leave'=>number_format( $array[0][$i]['annual_leave_balance'],2),
                //   $anual_count,
                     'mol_contract_date_final'=>$mol->format('Y-m-d'),
                    'no_of_years'=>number_format( $array[0][$i]['noyears'],2),
                     'updated_at' => Carbon::now(),
                     'total_month'=> 0,
                      'Maternity_Leave'=>0,
                      'Sick_Leave'=>number_format( $array[0][$i]['sick_leave'],2),
                  //  $sick_count,
                     'Casual_Leave'=>0,
                     'Emergency_Leave'=>0,
                     'Parental_Leave'=>0,
                     'Medical_Leave'=>0      

                );
               // dd($employee_leave);

                $employee_leave_update=DB::table('leave_balance')->where('employee_id',$array[0][$i]['employee_id'])
                ->update($employee_leave);
            }
            

            if($leave->isEmpty())
            {
                $employee_leave=array(
                    'employee_id' => $array[0][$i]['employee_id'],
                     'annual_leave_accured'=>number_format( $array[0][$i]['annual_leave_accured'],2),
                     'annual_leave_availed'=> number_format($array[0][$i]['annual_leave_availed']),
                    'Annual_Leave'=>number_format( $array[0][$i]['annual_leave_balance'],2),
                //    $anual_count,
                     'mol_contract_date_final'=>$mol->format('Y-m-d'),
                    'no_of_years'=>number_format( $array[0][$i]['noyears'],2),
                    'mol_contract_date_final'=>$mol->format('Y-m-d'),
                    'no_of_years'=>number_format( $array[0][$i]['noyears'],2),
                     'is_active' => '1',
                     'total_month'=> 0,
                     'Maternity_Leave'=>0,
                     'Sick_Leave'=>number_format( $array[0][$i]['sick_leave'],2),
                //    $sick_count,
                     'Casual_Leave'=>0,
                     'Emergency_Leave'=>0,
                     'Parental_Leave'=>0,
                     'Medical_Leave'=>0,                    
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now()

                );
               dd($employee_leave);
                $employee_leave_update=DB::table('leave_balance')->where('employee_id',$array[0][$i]['employee_id'])
                ->insert($employee_leave);
            }
            
          }
//dd($employee_leave_update);
      }
    }
        return redirect()->back()->withStatus(__('leaves imported successfully..'));


    }

  /*  public function filter_employee(Request $request,Employee $model)
    {

        $matchThese = ['is_active' => '1'];

        //$result = Employee::where($matchThese)->with('documents')->get();

        $results = $model->with('documents')->with('Role')->where($matchThese);

        //dd($result);
         if(!empty($request->designation))
      
         {
         
                $results->where('employee.designation',$request->designation);
         }

         if(!empty($request->nationality))
      
         {
         
                $results->where('employee.nationality',$request->nationality);
         }

       
        $query=$results->get();

        $roles = DB::table('roles')->where('is_active', 1)->get();



       return view('employee.management.index', ['employee' => $query,'roles' => $roles]);


    }  */

}
