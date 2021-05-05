<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrondissement extends Model
{
    use HasFactory;

    protected $table = 'arrondissements';
    
    protected $fillable = [
        'nom','departements_id',

    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departements_id');
       // return $this->belongsTo(Departement::class);
       
    }

    public function Zones() 
    { 
        return $this->hasMany(Zone::class); 
    }
}
