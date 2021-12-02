<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'outlet';

    public $timestamps = true;
     
    protected $fillable = [
         'outlet_id','outlet_name','outlet_lat', 'outlet_longi' ,'outlet_area','outlet_city','outlet_state','outlet_country'];
    
    public function timesheet()
    {
        return $this->belongsTo(merchant_timesheet::class,"outlet_id");
    }
    
    public function store()
    {
        return $this->hasMany(Store_details::class,"id","outlet_name");
    }

    public function product()
    {
        return $this->hasMany(Product_details::class,"id","product_id");
    }

    public function outlet_product()
    {
        return $this->hasMany(outlet_products::class,"outlet_id","outlet_id");
    }
	// public function where($key, $value, $strict = true){}
    
}
    
    
