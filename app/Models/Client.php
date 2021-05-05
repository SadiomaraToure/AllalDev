<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    
    protected $fillable = [
        'nom','prenom','telephone','email','sexe','adresse','num_carte_identite','pointdeventes_id',

    ];
}
