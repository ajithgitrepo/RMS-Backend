<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Employee;
use App\Document;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiJourneyPlanController;
use App\Http\Controllers\Api\ApiNotificationController;

use App\Role;


use App\journeyplan;
use App\Outlet;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Http\Requests;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
	    $validator = Validator::make($request->all(), [
	        'name' => 'required|string|max:255',
	        'email' => 'required|string|email|max:255|unique:users',
	        'password' => 'required|string|min:6',
	    ]);
	    if ($validator->fails())
	    {
	        return response(['errors'=>$validator->errors()->all()], 422);
	    }
	    $request['password']=Hash::make($request['password']);
	    $request['remember_token'] = Str::random(10);
	    $user = User::create($request->toArray());
	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	    $response = ['token' => $token];
	    return response($response, 200);
	}

	public function login (Request $request, Employee $model) {
	    $validator = Validator::make($request->all(), [
	        'email' => 'required|string|email|max:255',
	        'password' => 'required|string|min:6',
	    ]);
	    if ($validator->fails())
	    {
	        return response(['errors'=>$validator->errors()->all()], 422);
	    }
		$user = User::where('email', $request->email)->where("is_active", 1)->first();
		if($user != "")
		{
		$role = Role::where('id', $user->role_id)->first();
		// $matchThese = ['is_active' => '1', 'employee_id' => $user->emp_id ];
		// $UserID = $user->emp_id ;
		// $employee =  Employee::with('documents')->where($matchThese)->with(['user' => function($q) use($UserID) {
        //     // Query the name field in status table
        //     $q->where('users.emp_id', $UserID );
        // }])->get();

	 $keys = array('role_id', 'created_by', 'emp_id', 'emp_name', 'role_name', 'type');

     $values = array($user->role_id, $user->emp_id,  $user->emp_id, $user->name, $role->name, 'Log_In');

      $data = array_combine($keys, $values);
		
		}
		//-> with('user')->where($matchThese)->get();  */
		
	    if ($user) {
	        if (Hash::check($request->password, $user->password)) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
	            $response = ['token' => $token, 'user' => $user, 'status' => 200];
           
		$notify = new ApiNotificationController();
		$description = "Logged In";
		//$user_type = "merchandiser";
		$add_notify =  $notify->add_audit_trails($description, $data);

	         return response($response, 200);
	        } else {
	            $response = ["message" => "Password mismatch"];
	            return response($response, 422);
	        }
	    } else {
	        $response = ["message" =>'User does not exist'];
	        return response($response, 422);
	    }
	}
 
	public function logout (Request $request) {
	    $token = $request->user()->token();
	    $token->revoke();
	    $response = ['message' => 'You have been successfully logged out!'];
		$notify = new ApiNotificationController();
		$description = "Logged Out";
		$add_notify =  $notify->add_audit_trails("Logged Out", "Log_Out");
	    return response($response, 200);
	}

}
