<?php

namespace App\Http\Controllers\Bsc;
use App\Models\Draft;
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
        // $domaine_fourn = Fournisseur::where("domaine_fourn","=",true)->count();

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;

        return view('dashboard', compact('fourn_agree', 'fourn_draft', 'fourn_blacklist','user'));
    }



}
