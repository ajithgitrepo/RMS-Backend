<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audit_trial_details extends Model
{
    use HasFactory;
    use Notifiable;
    
    
    protected $table = 'audit_trial_details';

   // protected $primarykey = 'id';

    public $timestamps = true;
     
    protected $fillable = [
        'id', 'date','time', 'ip_address','country','description','type','status','device','role_id','created_by','is_active'];
    public function roles()
    {
        return $this->belongsTO(Role::class,"role_id");
    }
    


}


    
    
