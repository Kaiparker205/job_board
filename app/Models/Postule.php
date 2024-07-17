<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postule extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'emploi_id',
        'user_id',
        'name',
        'post',
        'statu',
    ];

    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
