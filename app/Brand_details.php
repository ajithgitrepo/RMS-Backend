<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand_details extends Model
{
    use HasFactory;
    
    protected $table = 'brand_details';
    protected $primaryKey = 'id';

    public $timestamps = true;
     
    protected $fillable = [
        'id','brand_name','client_id','field_manager_id','sales_manager_id','is_active' 
    ];
 
     public function category()
    {
        return $this->hasMany(Category_details::class,"id");
    }
     public function product()
   {
       return $this->belongsTo(Product_details::class,"id","id");
   }

    public function employee_client()
    {
        return $this->hasMany(Employee::class,"employee_id","client_id");
    }
     public function employee_field()
    {
        return $this->hasMany(Employee::class,"employee_id","field_manager_id");
    }
      public function employee_sales()
    {
        return $this->hasMany(Employee::class,"employee_id","sales_manager_id");
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
 } 
