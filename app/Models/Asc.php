<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asc extends Model
{
    use HasFactory;

    protected $table = 'ascs';
    
    protected $fillable = [
        'nom','telephone','email','adresse','zones_id',

    ];


    public function Pointdevents() 
    { 
        return $this->hasMany(Pointdevente::class); 
    }

    public function zones() 
    { 
        return $this->belongsTo(Zone::class, 'zones_id'); 
    }
}
