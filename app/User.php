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
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','emp_id', 'email', 'password', 'picture' ,'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the role of the user
     *
     * @return \App\Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    

    /**
     * Get the path to the profile picture
     *
     * @return string
     */
    public function profilePicture()
    {
        if ($this->picture) {
            return "/profiles/{$this->picture}";
        }

        return 'http://i.pravatar.cc/200';
    }

    /**
     * Check if the user has admin role
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->role->name == "Admin";
    }

    /**
     * Check if the user has creator role
     *
     * @return boolean
     */
  
    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isCoordianator()
    {
        return $this->role_id == 2;
    }

    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isHuman_Resource()
    {
        //return $this->role_id == 3;
        return $this->role->name == "Human Resource";
    }

     /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isAccounts()
    {
        return $this->role_id == 4;
    }

    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isField_Manager()
    {
        //return $this->role_id == 5;
        return $this->role->name == "Field Manager";
    }

    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isMerchandiser()
    {
        //dd($this->role->name);
        return $this->role->name == "Merchandiser";
    }


    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    // public function isClient()
    // {
    //     return $this->role_id == 7;
    // }

    public function isTop_Management()
    {
        return $this->role_id == 8;
    }

    /**
     * Check if the user has user role
     *
     * @return boolean
     */
    public function isSalesman()
    {
        return $this->role_id == 9;
    }

    public function isHrmanager()
    {
        return $this->role_id == 12;
    }

    public function isTopManagement()
    {
        return $this->role->name == "Top Management";
    }

    public function isClient()
    {
        return $this->role->name == "Client";
    }

    public function isCDE()
    {
        return $this->role->name == "CDE";
    }




}


// Notes:

//     <!-- @canany(['merchandiser','isAdmin'],App\User::class) -->