<?php
/*

=========================================================
* Argon Dashboard PRO - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro-laravel
* Copyright 2018 Creative Tim (https://www.creative-tim.com) & UPDIVISION (https://www.updivision.com)

* Coded by www.creative-tim.com & www.updivision.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(User::class);
    // }

    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        //$this->authorize('manage-users', User::class);

        $result = $model->with('role')->get();
        //dd($result);

        return view('users.index', ['users' => $model->with('role')->get()]);
    }

    /**
     * Show the form for creating a new user
     *
     * @param  \App\Role  $model
     * @return \Illuminate\View\View
     */
    public function create(Role $model)
    {
        $roles = DB::table('roles')
            ->where('is_active', 1)
            ->get();

        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge([
            'picture' => $request->photo ? $request->photo->store('profile', 'public') : null,
            'password' => Hash::make($request->get('password'))
        ])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @param  \App\Role  $model
     * @return \Illuminate\View\View
     */
    public function edit(User $user, Role $model)
    {
        return view('users.edit', ['user' => $user->load('role'), 'roles' => $model->get(['id', 'name'])]);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $hasPassword = Hash::make($request->get('password'));
        $password = Hash::make('password');
        // $user->update(
        //     $request->merge([
        //         'picture' => $request->photo ? $request->photo->store('profile', 'public') : $user->picture,
        //         'password' => Hash::make($request->get('password'))
        //     ])->except([$hasPassword ? '' : 'password'])
        // );

        //dd($request->all());

        if($request->hasfile('photo'))
        {
           $profile_photo = $request->photo;

           $destinationPath = 'profiles/';
        
           $profile_photo_file_filename = time().'.'.$profile_photo->getClientOriginalName();

           $profile_photo->move($destinationPath, $profile_photo_file_filename);

           $update = DB::table('users')
            ->where('email', $request->email)
            ->update(['name' =>$request->name,
                 'email'=>$request->email,
                 'role_id'=>$request->role_id,
                 'picture'=>$profile_photo_file_filename,
                 'updated_at' => date('y-m-d H:i:s')
             ]);
 
       }

       if($request->get('password'))
        {
           //dd($hasPassword);

           $update = DB::table('users')
            ->where('email', $request->email)
            ->update(['name' =>$request->name,
                 'email'=>$request->email,
                 'role_id'=>$request->role_id,
                 'password'=> $hasPassword,
                 'updated_at' => date('y-m-d H:i:s')
             ]);
 
       }

       else{
            //dd($request->all());

            $update = DB::table('users')
                ->where('email', $request->email)
                ->update(['name' =>$request->name,
                 'email'=>$request->email,
                 'role_id'=>$request->role_id,
                 'updated_at' => date('y-m-d H:i:s')
             ]);
       }

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)

    {
        // dd('nd');
          $delete = DB::table('users')->where('id', $id)->update(['is_active' => '0']);


        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }

    public function status(Request $request)

    {
        // dd('dnj');
        $status = [
                'id'            =>  $request->id,
                'is_active'    =>  $request->is_active,
            ];

            // dd($request->is_active);

        $update = DB::table('users')->where('id',$request->id)->update($status);
        //dd($update);
            
        return response()->json($update);
    }
}
