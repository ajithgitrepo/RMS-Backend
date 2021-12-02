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


class CdeController extends Controller
{
    public function index(Employee $model)
    {

        $matchThese = ['is_active' => '1','designation' => '2'];

     //  $result = DB::table('employee') ->where('is_active', 1)->get();
        
     // $results=Employee::where($matchThese)->with('documents')->get();

      $result = $model->with('Role')->where($matchThese)->get();

        //dd($result);

        return view('cde.index', ['employee' => $result]);
    }

    public function create(Role $model)
    {

        $roles = DB::table('roles')->where('is_active', 1)->get();

        return view('cde.create',['roles' => $roles]);
    }


    public function store(Request $request, Employee $model)
    {
        
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            //'middle_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'nationality' => 'required|max:255',
            'email' => 'required|email|unique:employee',
            'codes' =>'required',
            'mobile_number' => 'required|min:9',
            
        ]);

      //  dd($request->nationality);    
         $random_emp_id = rand(1000,10000);
      
        $employee = array(
            'employee_id' => "Emp".$random_emp_id, //$request->employee_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'surname' => $request->surname,
            
            'nationality' => $request->nationality,
            'email' => $request->email,
            'codes' => $request->codes,
            'mobile_number' => $request->mobile_number,
            'designation' => '2', 
   
            'is_active' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        $password = "secret";
        $hashed = Hash::make($password);

        $user = array(   
            'emp_id' => "Emp".$random_emp_id,
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => $hashed,
            'role_id' => '2',
            'is_active' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        );

        DB::table('employee')->insert($employee);
        DB::table('users')->insert($user);
        
        return redirect()->route('cde.index')->withStatus(__('CDE details successfully created'));
    }

    public function edit($id)
    {   
        //dd($id);

        $matchThese = ['employee_id' => $id];

        $results = Employee::where($matchThese)->get();
        $roles = DB::table('roles') ->where('is_active', 1) ->get();
   
        //dd($results);
        
        //$emp = Employee::find($id);
        return view('cde.edit',['employee' => $results,'roles' => $roles]);
    }



    public function update(Request $request, $id, Employee $model)
    {   
          
        $validatedData = $request->validate([
            //'employee_id' => 'required|unique:employee,employee_id'. $id,
            'employee_id' => 'required|unique:employee,employee_id,'.$id.',employee_id',
            'first_name' => 'required|max:255',
            //'middle_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'nationality' => 'required|max:255',
           // 'email' => 'required|email|unique:employee',
            'email' => 'required|email|unique:employee,email,'.$id.',employee_id',
            'codes' =>'required',
            'mobile_number' => 'required|min:9',
           
        ]);
          


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
                    'is_active' => '1',
                    'updated_at' => Carbon::now(),
             ]);

          

            $user = DB::table('users')
                ->where('emp_id', $request->employee_id)
                ->update([
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'role_id' => '2',
                    'is_active' => '1',
                    'updated_at' => Carbon::now()
                ]);
       
            return redirect()->route('cde.index')->withStatus(__('CDE details successfully updated'));
    }

    public function destroy(Request $request, $id, Employee $model)
    {
       
        $result = DB::table('employee')
                ->where('employee_id', $id)
                ->update([
                    'is_active' => '0',
                    'updated_at' => Carbon::now()
        ]);

        $result_user = DB::table('users')
                ->where('emp_id', $id)
                ->update([
                    'is_active' => '0',
                    'updated_at' => Carbon::now()
             ]);

        return redirect()->route('cde.index')->withStatus(__('CDE successfully deleted.'));
    }

    

}
