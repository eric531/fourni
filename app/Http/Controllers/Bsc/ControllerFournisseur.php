<?php

namespace App\Http\Controllers\Bsc;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ControllerFournisseur extends Controller
{
    //

    
    public function index()
    {
       
        $fournisseurs = Fournisseur::all();

        return view('fournisseur', compact('fournisseurs', ));
    }

    //ajouter les fournisseurs sélectionnés à la liste de l'utilisateur :
    public function ajouterFournisseurs(Request $request)
    {
        $user = Auth::user();
        $user->fournisseurs()->Sync($request->fournisseurs);

        return redirect()->route('dashboard')->with('success', 'Fournisseurs ajoutés avec succès.');
    }

}
