<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifiation_details';

    public function employee()
    {
       // return $this->belongsTo('App\Employee','employee_id');
        return $this->belongsTo(Employee::class,"created_by","employee_id");
    }
}
