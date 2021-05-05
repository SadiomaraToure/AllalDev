<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactionserviceviamobile extends Model
{
    use HasFactory;

    protected $table = 'transactionserviceviamobiles';
    
    protected $fillable = [
        'montant','frais','type_transaction','date_transaction','comptes_id', 'entreprise_id',

    ];
}
