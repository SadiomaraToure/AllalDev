<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';
    
    protected $fillable = [
        'nom','arrondissements_id',

    ];

    public function Evenements() 
    { 
        return $this->hasMany(Evenement::class); 
    }

    public function Ascs() 
    { 
        return $this->hasMany(Asc::class); 
    }

    
    public function Arondisement()
    {
        return $this->belongsTo(Arrondissement::class, 'arrondissements_id');
       
       
    }
}
