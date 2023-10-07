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
        $user = Auth::user();
        $fournisseurs = $user->fournisseurs;

        return view('fournisseur', compact('fournisseurs', ));
    }

    //ajouter les fournisseurs sélectionnés à la liste de l'utilisateur :
    public function ajouterFournisseurs(Request $request)
    {
        dd($request);
        $user = Auth::user();
        $user->fournisseurs()->Sync($request->fournisseurs);

        $fournisseurs = $user->fournisseurs;

        return view('fournisseur', compact('fournisseurs'));
    }

    public function rechercherFournisseur(Request $request)
    {
        $codeFournisseur = $request->input('code_fournisseur');

        
// 
        if (Fournisseur::where('code_fournisseur',)->exists()){
            $fournisseur = Fournisseur::where('code_fournisseur', $codeFournisseur)->first();
            return view('monfournisseur', compact('fournisseur'));
        } else {
            return redirect()->route('dashboard')->with('erreur', 'Fournisseur non trouvé.');
        }
    }

}
