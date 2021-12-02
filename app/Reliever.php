<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reliever extends Model
{
    use HasFactory;

     protected $table = 'reliever';

   public function employee()
   {
      // return $this->belongsTo('App\Employee','employee_id');
       return $this->belongsTo(Employee::class,"employee_id");
   }

   public function reliever()
   {
      // return $this->belongsTo('App\Employee','employee_id');
       return $this->belongsTo(Employee::class,"reliever_id");
   }


}
