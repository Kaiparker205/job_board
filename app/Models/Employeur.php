<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeur extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * Get the user that owns the employeur.
     */
    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function boite()
    {
        return $this->hasOne(Boite::class);
    }
    public function emplois(){
       return  $this->hasMany(Emploi::class);
    }
}
