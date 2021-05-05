<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactionviatpes extends Model
{
    use HasFactory;

    protected $table = 'transactionviatpes';
    
    protected $fillable = [
        'montant','frais','type_transaction','date_transaction','cartes_id','tpes_id',

    ];
}
