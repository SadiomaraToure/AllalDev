<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchatTicket extends Model
{
    use HasFactory;

    protected $table = 'achattickets';

    protected $fillable = [ 
         'montant','qr_code', 'email_acheteur', 'evenement_id','pointdevente_id', 'etat',
    ];

    //donnees qu'on veux cacher
    protected $hidden = ['created_at', 'updated_at'];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'evenement_id');
    }

    public function pointdevente()
    {
        return $this->belongsTo(Pointdevente::class, 'pointdevente_id');
    }
}
