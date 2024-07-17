<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emploi extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'salary',
        'employeur_id',
        'delay', 'deleted_at'
    ];
    public function customSoftDelete()
    {
        // Assuming $this->delay is defined elsewhere
        if ($this->updated_at->addDays($this->delay) <= now()) {
            parent::delete();
        }
    }


    public function employeur()
    {
        return $this->belongsTo(Employeur::class);
    }
    
    public function users()
    {

        return $this->belongsToMany(User::class);
    }
}
