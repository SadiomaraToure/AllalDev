<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    
    protected $fillable = [
        'nom','prenom','telephone','email','sexe','matricule','profil'

    ];

    public function Pointdeventes() 
    { 
        return $this->hasMany(Pointdevente::class); 
    }

    public function Evenements() 
    { 
        return $this->hasMany(Evenement::class); 
    }
}
