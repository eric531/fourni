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
 
        return view('dashboard', compact('for', 'fournisseur', 'fourn_user', 'user'));
    }

}
