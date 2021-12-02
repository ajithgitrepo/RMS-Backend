<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    use Notifiable;
    
   
    public $timestamps = true;

    protected $table = 'attendance';
     
    protected $fillable = ['date','employee_id','is_present','is_leave','leave_approved_by'];
    
    
    public function getInicioAttribute($val) 
	{
	    return Carbon::parse($val);
	}

 }
