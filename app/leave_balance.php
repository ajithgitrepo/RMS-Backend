<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leave_balance extends Model
{
    use HasFactory;

    protected $table = 'leave_balance';

    public $timestamps = true;
     
    protected $fillable = [
        'id', 'employee_id','Annual_Leave','is_active'];

    public function employee()
    {
      
        return $this->belongsTo(Employee::class,"employee_id");
    }

}
