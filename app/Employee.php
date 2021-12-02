<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'employee';

    protected $primaryKey = 'employee_id';
    public $incrementing = false;

    public $timestamps = true;
     
    protected $fillable = [
        'name', 'email', 'phone', 'address' ,'department'
    ];
    
    public function profilePicture()
    {
        if ($this->picture) {
            return "/profiles/{$this->picture}";
        }

        return 'http://i.pravatar.cc/200';
    }

    public function documents()
    {
        return $this->hasMany(Document::class,"employee_id");
    }  

    public function user()
    {
        return $this->hasMany(User::class,"emp_id");
    }
    
    public function reporting_to()
    {
        return $this->hasMany(Employee_Reporting_To::class,"employee_id");
    }

    // public function reporting_to_emp()
    // {
    //     return $this->hasMany(Employee_Reporting_To::class,"employee_id");
    // }

    public function Role()
    {
        return $this->hasMany(Role::class,"id","designation");
    }

    public function timesheet()
    {
        return $this->hasMany(merchant_timesheet::class,"employee_id");
    }
    public function leaverequest()
    {
        return $this->hasMany(Leaverequest::class,"employee_id");
    }
   public function leavebalance()
    {
        return $this->hasMany(leave_balance::class,"id","employee_id");
    }

}
