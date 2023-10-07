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
        $user = Auth::User();
        $fournisseurs = Fournisseur::all();
       
        $fournisseurs = $user->fournisseurs;
        return view('fournisseur', compact('fournisseurs', ));
    }

    //ajouter les fournisseurs sélectionnés à la liste de l'utilisateur :
    public function ajouterFournisseurs(Request $request)
    {
       // dd($request->all());
        $user = Auth::user();

        if ($user->fournisseurs->contains($request->fournisseur)) {
            return redirect()->route('dashboard')->with('error', 'Le fournisseur est déjà associé à cet utilisateur.');
        }

        $user->fournisseurs()->syncWithoutDetaching($request->fournisseur);
        
        return redirect()->route('dashboard')->with('success', 'Fournisseurs ajoutés avec succès!');
    }




    public function rechercherFournisseur(Request $request)
    {
        $codeFournisseur = $request->input('code_fournisseur');

        $searchfournisseur = Fournisseur::where('code_fournisseur', $codeFournisseur)->first();
        //dd($fournisseur);

        if (isset($searchfournisseur)){
            return view('dashboard', compact('searchfournisseur'));
        } else {
            return back()->with('erreur', 'Fournisseur non trouvé.');
        }
    }




}