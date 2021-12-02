<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'competitor';

    public $timestamps = true;
     
    protected $fillable = ['company_name','brand_id','promotion_type', 'promotion_description' ,'mpr','selling_price','capture_image','is_active'];
         
  public function brand()
    {
        return $this->hasMany(Brand_details::class,"id","brand_id");
    }
}
    
    
