<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class availability extends Model
{
    use HasFactory;

     protected $table = 'brand_details';	

      protected $fillable = [
        'outlet_id','timesheet_id','product_id'
    ];
}
