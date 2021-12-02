<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store_details extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'store_details';

    public $timestamps = true;
     
    protected $fillable = ['id','store_code','store_name','contact_number','address','is_active'];
    
    public function outlet()
    {
        return $this->belongsTo(Outlet::class,"outlet_id");
    }

   
}
    
    
