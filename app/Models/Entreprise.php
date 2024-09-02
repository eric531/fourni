<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function abonnements()
    {
        return $this->hasMany(Abonnements::class, 'entreprise_id');
    }
    public function acheteurs()
    {
        return $this->belongsToMany(User::class, 'entreprise_user', 'entreprise_id', 'user_id');
    }

}
