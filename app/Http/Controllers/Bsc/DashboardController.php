<?php

namespace App\Http\Controllers\Bsc;
use App\Models\Draft;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fourn_agree = Fournisseur::where("blaklist","=",false)->count();
        $fourn_draft = Draft::count();
        $fourn_blacklist = Fournisseur::where("blaklist","=",true)->count();
        $fournisseurs = Fournisseur::all();
        // $domaine_fourn = Fournisseur::where("domaine_fourn","=",true)->count();

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;

        $entrepriseIds = \DB::table('entreprise_user')
        ->where('user_id', $user_id)
        ->pluck('entreprise_id');

        $logoE = Entreprise::find($entrepriseIds)->first();
        $logo =$logoE->logo;
        return view('dashboard', compact('fourn_agree', 'fourn_draft', 'fourn_blacklist','user','fournisseurs','logo'));
    }



}
