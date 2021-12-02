<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet_products extends Model
{
    use HasFactory;

     protected $table = 'outlet_products_mapping';

      protected $fillable = [
         'outlet_id','product_id'];

   

    public function product()
    {
        return $this->hasMany(Product_details::class,"id","product_id");
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class,"outlet_id","outlet_id");
    }

    public function brand()
    {
        return $this->hasMany(Brand_details::class,"id","brand_id");
    }

}
