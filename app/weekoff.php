<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weekoff extends Model
{
    use HasFactory;

    protected $table = 'weekoff';

    protected $fillable = [
        'employee_id', 'month', 'day'
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class,"employee_id","employee_id");
    }

}
