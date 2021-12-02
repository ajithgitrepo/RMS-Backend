<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_Reporting_To extends Model
{
    use HasFactory;

     protected $table = 'employee_reporting_to';

   public function employee()
   {
      // return $this->belongsTo('App\Employee','employee_id');
       return $this->belongsTo(Employee::class,"employee_id");
   }

   public function employee_reporting_to()
   {
      // return $this->belongsTo('App\Employee','employee_id');
       return $this->belongsTo(Employee::class,"reporting_to_emp_id");
   }


}
