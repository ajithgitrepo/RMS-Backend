<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'holidays';

    public $timestamps = true;
     
    protected $fillable = [
        'date', 'description', 'is_active'
    ];

  //  public function where($key, $value, $strict = true){}
    
   }
