<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workingdays extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'working_days';

    public $timestamps = true;
     
    protected $fillable = [
        'year', 'month', 'working_days'
    ];
    
   }
