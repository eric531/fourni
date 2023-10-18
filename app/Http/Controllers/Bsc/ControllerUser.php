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
        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;
        $client = new Client();
       $apiUrl = 'https://bsc-agrement.net/api/wishlist/'.$user_id;
        // recuperation de l'utilisateur connecté

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
        $fournisseur = $data["data"][0]['fournisseur'] ?? [];
        #dd($fournisseur);

        $fourn_user = [];
        $for = [];
        return view('dashboard', compact('for', 'fournisseur', 'fourn_user', 'user'));
    }
     
}