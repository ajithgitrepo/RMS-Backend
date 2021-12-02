<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use Notifiable;
    
   
    public $timestamps = true;

    protected $table = 'task_details';
     
    protected $fillable = ['outlet_id','task_list','created_by','is_active'];
   

     public function outlet()
    {
       return $this->belongsTo(Outlet::class,"id","outlet_id");
    }


 }
