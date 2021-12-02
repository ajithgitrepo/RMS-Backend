<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet_Task extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'task_details';

    public $timestamps = true;
     
    protected $fillable = [
         'outlet_id ','task_list','outlet_lat','is_active'];

         public function timesheet()
         {
             return $this->belongsTo(merchant_timesheet::class,"outlet_id");
         }

         public function store()
         {
             return $this->hasMany(Store_details::class,"id","outlet_name");
         }

}
