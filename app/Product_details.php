<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_details extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'product_details';

    public $timestamps = true;
     
    protected $fillable = [
        'sku','product_name','barcode','uom','zrep_code','piece_per_carton ','price_per_piece',
        'updated_by','created_by','brand_id','client_id','product_categories','remarks','is_active'
    ];
    
    public function brand()
    {
        return $this->hasMany(Brand_details::class,"id","brand_id");
    }
    public function category()
    {
        return $this->hasMany(Category_details::class,"id","product_categories");
    }
    
    public function outlet_stock()
    {
       return $this->hasMany(Outlet_stockexpiry::class,"id");
    }
    
    public function outlet()
    {
       return $this->hasMany(Outlet::class,"id");
    }

    public function outlet_products()
    {
       return $this->hasMany(outlet_products::class,"id");
    }

    public function active_brand()
    {
        return $this->hasMany(Brand_details::class,"id","brand_id")
            ->where('is_active', '1');
    }
    
    
 }
   		
