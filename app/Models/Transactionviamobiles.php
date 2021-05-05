<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactionviamobiles extends Model
{
    use HasFactory;

    protected $table = 'transactionviamobiles';
    
    protected $fillable = [
        'montant','frais','type_transaction','date_transaction','comptes_id','telephone',

    ];
}
