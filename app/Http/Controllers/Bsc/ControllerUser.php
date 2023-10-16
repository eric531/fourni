<?php

namespace App\Http\Controllers\Bsc;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ControllerUser extends Controller
{
    //

    public function index()
    {
      //  $apiUrl = 'https://bsc-agrement.net/api/fournisseurs/';
        // recuperation de l'utilisateur connecté

      //  $client = new Client();

        // $response = $client->get($apiUrl, [
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . $token,
        //     ],
        //     'verify' => false,
        // ]);
        // if ($response->getStatusCode() != 200) {
        //     return view('error');
        // }

        // $fournisseurs = json_decode($response->getBody(), true);
        // dd($fournisseurs);
        $user = $_COOKIE['user']??null;
        $fournisseur = [];
        $fourn_user = [];
        $for = [];
        return view('dashboard', compact('for', 'fournisseur', 'fourn_user', 'user'));
    }




}
