<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaverequest extends Model
{
    use HasFactory;
    use Notifiable;
 
    protected $table = 'leaverequest';
    
    public $timestamps = true;
     
    protected $fillable = [
        'lrid', 'employee_id', 'leavetype', 'leavestartdate' ,'leaveenddate','is_approved','is_rejected','reason','supportingdocument'];
    

        public function employee()
        {
           // return $this->belongsTo('App\Employee','employee_id');
            return $this->belongsTo(Employee::class,"employee_id");
        }
    }


