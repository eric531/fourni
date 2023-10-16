<?php

namespace App\Http\Controllers\Bsc;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ControllerFournisseur extends Controller
{
    //



    public function index()
    {
        $apiUrl = 'https://bsc-agrement.net/api/fournisseurs/';

        $token = $_COOKIE['token'] ?? null;

        $client = new Client();

        $response = $client->get($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
            'verify' => false,
        ]);
        if ($response->getStatusCode() != 200) {
            return view('error');
        }

        $data = json_decode($response->getBody(), true);
        //dd($data["data"]['data'][0]);
        $fournisseurs = $data["data"]['data'];
       // dd($fournisseurs);
        return view('fournisseur', compact('fournisseurs'));
    }


    //ajouter les fournisseurs sélectionnés à la liste de l'utilisateur :
    public function ajouterFournisseurs(Request $request)
    {
        $apiUrl = 'https://bsc-agrement.net/api/add-fourn';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $client = new Client();

        $data = $request->excetp('_token');

        // $searchfournisseur = Fournisseur::where('code_fournisseur', $codeFournisseur)->first();
        // //dd($fournisseur);


        $response = $client->post($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
            'form_param'=> $data,
            'verify' => false,
        ]);

        if ($response->getStatusCode() != 200) {
            return redirect()->route('dashboard')->with('success', 'Fournisseurs ajoutés avec succès!');
        }
        // if ($user->fournisseurs->contains($request->fournisseur)) {
        //     return redirect()->route('dashboard')->with('error', 'Le fournisseur est déjà associé à cet utilisateur.');
        // }

       # $user->fournisseurs()->syncWithoutDetaching($request->fournisseur);

        return redirect()->route('dashboard')->with('success', 'Fournisseurs ajoutés avec succès!');
    }




    public function rechercherFournisseur(Request $request)
    {
        $codeFournisseur = $request->input('code_fournisseur');

        if ($codeFournisseur ==null){
            $codeFournisseur= '00000';
        }
        $apiUrl = 'https://bsc-agrement.net/api/fournisseurs-search?code=' . $codeFournisseur;

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $client = new Client();


        // $searchfournisseur = Fournisseur::where('code_fournisseur', $codeFournisseur)->first();
        // //dd($fournisseur);


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
      //dd($codeFournisseur,$searchfournisseur);
        if (isset($searchfournisseur) || $searchfournisseur !=null){
            return view('dashboard', compact('searchfournisseur','user'));
        } else {
            return back()->with('error', 'Fournisseur non trouvé.');
        }
    }




}
