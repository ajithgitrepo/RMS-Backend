<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cde_reporting extends Model
{
    use HasFactory;

    protected $table = 'cde_reporting';

    public function merchandiser()
   {
      // return $this->belongsTo('App\Employee','employee_id');
       return $this->belongsTo(Employee::class,"merchandiser_id");
   }

   public function cde_reporting()
   {
      // return $this->belongsTo('App\Employee','employee_id');
       return $this->belongsTo(Employee::class,"cde_id");
   }

}
