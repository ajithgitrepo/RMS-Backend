<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mannual_Attendance extends Model
{
    use HasFactory;
    use Notifiable;
    
   
    public $timestamps = true;

    protected $table = 'attendance';
     
    protected $fillable = ['employee_id','date','is_present','checkin_time','checkout_time'];
    
    
    public function getInicioAttribute($val) 
	{
	    return Carbon::parse($val);
	}

 }
