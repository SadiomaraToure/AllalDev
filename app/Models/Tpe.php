<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Tpe extends Model
{
    use HasFactory;
    use HasApiTokens;
    
    protected $table = 'tpes';
    
    protected $fillable = [
        'sn','login','pwd','pointdeventes_id',

    ];


    protected $hidden = [
        'created_at',
        'updated_at',
    
    ];


    public function ptvente()
    {
        return $this->belongsTo(Pointdevente::class, 'pointdeventes_id');
    }
}
