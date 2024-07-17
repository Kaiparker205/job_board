<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = [
        'name',
        'description',
        'profil_id',
    ];
    function profil(){
        return $this->belongsTo(profil::class);
    }
    use HasFactory;
}
