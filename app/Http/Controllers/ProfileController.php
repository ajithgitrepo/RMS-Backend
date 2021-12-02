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

use Gate;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Controllers\AuditController as audit_store;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
       
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {

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
                 'picture'=>$profile_photo_file_filename,
                 'created_at' => date('y-m-d H:i:s')]);
 
       }

       else{

            $update = DB::table('users')
                ->where('email', $request->email)
                ->update(['name' =>$request->name,
                     'email'=>$request->email,
                     'created_at' => date('y-m-d H:i:s')]);
       }
       

        /*auth()->user()->update(
            $request->merge(['picture' => $request->photo ? $request->photo->store('profile', 'public') : null])
                ->except([$request->hasFile('photo') ? '' : 'picture'])
        );*/

       if($update)
       {
            $audit = new audit_store();
            $description = 'changed his name / email ';
            $add_audit =  $audit->store($description,'Profile'); 

       }
        
            return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

      
        $audit = new audit_store();
        $description = ' changed his password ';
        $add_audit =  $audit->store($description); 

        return back()->withStatus(__('Password successfully updated.'));
    }
}
