<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'nom_evenement', 'date_evenement','liste_asc','lieu_evenement','prix_ticket1','prix_ticket2','prix_ticket3' ,'prix_ticket4','zone_id','admin_id','nombre_place', 
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function Achattickets() 
    { 
        return $this->hasMany(AchatTicket::class); 
    }
}
