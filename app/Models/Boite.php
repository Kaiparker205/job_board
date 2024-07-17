<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boite extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'content', 'employeur_id'];

    public function employeur()
    {
        return $this->belongsTo(Employeur::class);
    }
}
