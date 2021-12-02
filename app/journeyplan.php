<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class journeyplan extends Model
{
    use HasFactory;

     protected $table = 'merchant_time_sheet';

    public function outlet()
    {
        return $this->belongsTo(Outlet::class,"outlet_id","outlet_id");
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,"employee_id","employee_id");
    }

    public function outlet_login()
    {
        return $this->hasMany(outlet_login::class,"timesheet_id","id");
            //->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    }

}
