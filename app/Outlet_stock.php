<?php

namespace App;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Outlet_stock extends Model 
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'outlet_stockexpiry';

    public $timestamps = true;
     
    protected $fillable = ['outlet_id','product_id','total_available_carton','total_available_cases','total_available_pieces','expiry_date','remarks','updated_by',
            	'created_by','carton_picture','case_picture','piece_picture','merchandiser_id','field_manager_id','sales_man_id','is_active'];
    
   public function product()
   {
       return $this->belongsTo(Product_details::class,"product_id","id");
   }
}
    
    
