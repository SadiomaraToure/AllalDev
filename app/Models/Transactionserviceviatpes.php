<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactionserviceviatpes extends Model
{
    use HasFactory;

    protected $table = 'transactionserviceviatpes';
    
    protected $fillable = [
        'montant','frais','ref_facture','type_transaction','date_transaction','entreprise_id','tpes_id',

    ];
}
