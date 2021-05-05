<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointdevente extends Model
{
    use HasFactory;

    protected $table = 'pointdeventes';
    
    protected $fillable = [
        'adresse','ascs_id','admins_id',

    ];

    public function asc()
    {
        return $this->belongsTo(Asc::class, 'ascs_id');
    }

    public function admincreer()
    {
        return $this->belongsTo(Admin::class, 'admins_id');
    }

    public function Evenements() 
    { 
        return $this->hasMany(Evenement::class); 
    }

    public function Tpes() 
    { 
        return $this->hasMany(Tpe::class); 
    }
}
