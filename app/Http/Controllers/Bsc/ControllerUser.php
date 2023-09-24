<?php

namespace App\Http\Controllers\Bsc;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;

class ControllerUser extends Controller
{
    //

    public function index()
    {
        // recuperation de l'utilisateur connecté
        $user = Auth::User();

        //recuperation de tous les fournisseurs de l'utilisateur connecté
        $fourn_user = $user->fournisseurs;

        $for = $fourn_user;

        $fournisseur = Fournisseur::all();
        //dd($fournisseur);
        return view('dashboard', compact('for', 'fournisseur', 'fourn_user'));
    }
     
}
