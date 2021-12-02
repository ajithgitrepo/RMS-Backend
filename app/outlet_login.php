<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet_login extends Model
{
    use HasFactory;

    protected $table = 'outlet_login';

    protected $fillable = [
        'outlet_id', 'employee_id'
    ];

    public function timesheet()
    {
        //return $this->belongsTo(merchant_timesheet::class,"id");
        return $this->belongsTo(merchant_timesheet::class,"id");
    }

    public function journeyplan()
    {
        //return $this->belongsTo(merchant_timesheet::class,"id");
        return $this->belongsTo(journeyplan::class,"id");
    }

}
