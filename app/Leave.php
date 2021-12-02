<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'leave_rule';

    public $timestamps = true;
     
    protected $fillable = [
        'leave_rule_id', 'leave_type', 'rule', 'requirements' ,'remarks'
    ];
    
    }
