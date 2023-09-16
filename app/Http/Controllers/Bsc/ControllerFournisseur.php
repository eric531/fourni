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

    public function rechercherFournisseur(Request $request)
    {
        $codeFournisseur = $request->input('code_fournisseur');

        $fournisseur = Fournisseur::where('code_fournisseur', $codeFournisseur)->first();

        if (isset($fournisseur)){
            return view('dashboard', compact('fournisseur'));
        } else {
            return back()->with('erreur', 'Fournisseur non trouvé.');
        }
    }

}
