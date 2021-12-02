<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

	protected $table = 'documents';
    use HasFactory;
    public $timestamps = true;

    /**
     * Get the role of the user
     *
     * @return \App\Employee
     */
   public function employees()
   {
      // return $this->belongsTo('App\Employee','employee_id');
       return $this->belongsTo(Employee::class,"employee_id");
   }
    

}
