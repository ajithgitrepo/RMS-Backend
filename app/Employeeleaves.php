<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeeleaves extends Model
{
    use HasFactory;
    use Notifiable;
    
   
    public $timestamps = true;
     
    protected $fillable = [
       ];
    }
