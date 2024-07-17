<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    protected $fillable = [
        'type',
        'place',
        'profil_id',
    ];
    function profil(){
        return $this->belongsTo(profil::class);
    }
    use HasFactory;
}
