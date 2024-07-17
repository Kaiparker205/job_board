<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'address',
        'phone',
        'employeur_id',
    ];
    /**
     * Get the employeur that owns the contact.
     */
    public function employeur()
    {
        return $this->belongsTo(Employeur::class);
    }
}
