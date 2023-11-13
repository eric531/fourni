<?php

namespace App\Http\Controllers\Bsc;

use App\Models\Draft;
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

        $fournisseurs = Fournisseur::where('user_id',$user_id)->where('blaklist',false)->get();
       // dd($fournisseurs);
        return view('fournisseur', compact('fournisseurs','user'));
    }


    public function search_view()
    {
        #$apiUrl = 'https://bsc-agrement.net/api/fournisseurs/';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;

        return view('search', compact('user'));
    }
    public function search(Request $request)
    {
        $token = $_COOKIE['token'] ?? null;
        $user_id = $_COOKIE['user_id'] ?? null;
        //dd("dzefzef");
        $searchTerm = $request->input('search');

        $fournisseurs = Fournisseur::where('user_id', $user_id)
            ->where('blaklist', false)
            ->where(function ($query) use ($searchTerm) {
                $query->where('domaine_activites_1', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('entreprise', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('mobile', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();

        return response()->json(['response' => $fournisseurs]);
    }


    public function blacklist()
    {
        #$apiUrl = 'https://bsc-agrement.net/api/fournisseurs/';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;

        $fournisseurs = Fournisseur::where('user_id',$user_id)->where('blaklist',true)->get();
       // dd($fournisseurs);
        return view('fournisseursBlackliste', compact('fournisseurs','user'));
    }

    //ajouter les fournisseurs sélectionnés à la liste de l'utilisateur :
    public function ajouterFournisseurs(Request $request)
    {
        #$apiUrl = 'https://bsc-agrement.net/api/wish/add';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;


        $data = $request->except(['_token','id']);
        $data['status'] = intval($request['status']);

        $data['user_id']= $user_id;
        $data['blaklist']= false;
        //dd($data);
        $fournisseurs = Fournisseur::create($data);
        $draft = Draft::findOrFail(intval($request['id']));
        $draft->delete();




       return redirect()->route('fournisseur')->with('success', 'fournisseur ajoutés avec succès!');
    }




    //ajouter les fournisseurs sélectionnés à la liste de l'utilisateur :
    public function setblacklist(Request $request, )
    {
        #$apiUrl = 'https://bsc-agrement.net/api/wish/add';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;
        // dd($request['id']);
        $fourn = Fournisseur::findOrFail(intval($request['id']));
        $fourn->blaklist = true;
        $fourn->save();




       return redirect()->route('fournisseur')->with('success', 'fournisseur ajoutés avec succès!');
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
        if( $searchfournisseur !=null){
        $produits_services = json_decode($searchfournisseur['produits_services'])[0];
        $interlocuteur =json_decode($searchfournisseur['interlocuteur'])[0];
        }
      #dd($interlocuteur->interloc_nom);
        if (isset($searchfournisseur) || $searchfournisseur !=null){
            return view('search', compact('searchfournisseur','user','interlocuteur','produits_services'));
        } else {
            return back()->with('error', 'Fournisseur non trouvé.');
        }
    }




}
