<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_details extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'category_details';

    public $timestamps = true;
     
    protected $fillable = [
       'id','brand_id', 'category_name', 'is_active' 
    ];
 
    public function brand()
    {
        return $this->belongsTo(Brand_details::class,"brand_id","id");
    }
    public function product()
   {
       return $this->belongsTo(Product_details::class,"id","id");
   }
 
  }
