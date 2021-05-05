<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;

    protected $table = 'cartes';
    
    protected $fillable = [
        'num_carte','date_expiration','type_carte','clients_id',

    ];
}
