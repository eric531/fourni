<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable =

    [
        'name',
        'domaine',
        'contact',
        'email',
        'code_fournisseur'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
