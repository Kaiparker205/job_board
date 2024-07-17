<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
       
    ];
    function user()
    {
        return $this->hasOne(User::class);
    }
    use HasFactory;
}
