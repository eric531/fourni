<?php

namespace App\Http\Controllers\Bsc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use GuzzleHttp\Client;

class ControllerFournisseur extends Controller
{
    //



    public function index()
    {
        #$apiUrl = 'https://bsc-agrement.net/api/fournisseurs/';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;

        $fournisseurs = Fournisseur::wherer('user_id',$user)->get();
       // dd($fournisseurs);
        return view('fournisseur', compact('fournisseurs','user'));
    }


    //ajouter les fournisseurs sélectionnés à la liste de l'utilisateur :
    public function ajouterFournisseurs(Request $request)
    {
        #$apiUrl = 'https://bsc-agrement.net/api/wish/add';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;


        $data = $request->except('_token');
        $data['user_id']= $user_id;
        $fournisseurs = Fournisseur::getOrCreate($data);





       return redirect()->route('dashboard')->with('success', 'fournisseur ajoutés avec succès!');
    }




    public function rechercherFournisseur(Request $request)
    {
        #dd($request);
        $codeFournisseur = $request->input('code_fournisseur');

        if ($codeFournisseur ==null){
            $codeFournisseur= '00000';
        }
        $apiUrl = 'https://bsc-agrement.net/api/fournisseurs-search?code=' . $codeFournisseur;

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $client = new Client();



        $response = $client->post($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
            'verify' => false,
        ]);
        if ($response->getStatusCode() != 200) {
            return view('error');
        }

        $data = json_decode($response->getBody(), true);
        $searchfournisseur = $data["data"]['data'];
        $produits_services = json_decode($searchfournisseur['produits_services'])[0];
        $interlocuteur =json_decode($searchfournisseur['interlocuteur'])[0];
      #dd($interlocuteur->interloc_nom);
        if (isset($searchfournisseur) || $searchfournisseur !=null){
            return view('dashboard', compact('searchfournisseur','user','interlocuteur','produits_services'));
        } else {
            return back()->with('error', 'Fournisseur non trouvé.');
        }
    }




}
