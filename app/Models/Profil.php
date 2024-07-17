<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable=['cv_path','profil_path','user_id'];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function competences(){
        return $this->hasMany(Competence::class);
    }
    public function diplomes(){
        return $this->hasMany(Diplome::class);
    }
}
