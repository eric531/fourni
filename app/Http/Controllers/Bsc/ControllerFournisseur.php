<?php

namespace App\Http\Controllers\Bsc;

use App\Exports\ExportBlack;
use App\Exports\ExportFourn;
use App\Models\Draft;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use App\Models\Entreprise;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;

class ControllerFournisseur extends Controller
{
    //



    public function index()
    {
        #$apiUrl = 'https://bsc-agrement.net/api/fournisseurs/';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;

        $logoE = Entreprise::where("user_id",$user_id)->first();
        // $logo =$logoE->logo;

        $fournisseurs = Fournisseur::where('user_id',$user_id)->where('blaklist',false)->paginate(5);
       // dd($fournisseurs);
        return view('fournisseur', compact('fournisseurs','user',));
    }


    public function search_view()
    {
        #$apiUrl = 'https://bsc-agrement.net/api/fournisseurs/';

        $token = $_COOKIE['token'] ?? null;
        $user = $_COOKIE['user']??null;
        $user_id = $_COOKIE['user_id'] ?? null;
        $logoE = Entreprise::where("user_id",$user_id)->first();
       // $logo =$logoE->logo;

        return view('search', compact('user',));
    }
    public function search(Request $request)
    {
        $token = $_COOKIE['token'] ?? null;
        $user_id = $_COOKIE['user_id'] ?? null;

        $searchTerm = $request->input('search');
        $entreprise = $request->input('entreprise');
        $domaine = $request->input('domaine');

        $fournisseurs = Fournisseur::where('user_id', $user_id)
            ->where('blaklist', false)
            ->where(function ($query) use ($searchTerm, $domaine, $entreprise ) {
                $query->where('domaine_activites_1', 'LIKE', '%' . $domaine . '%')
                    ->where('entreprise', 'LIKE', '%' . $entreprise . '%')
                    ->where('mobile', 'LIKE', '%' . $searchTerm . '%')
                    ->where('email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->get();

        return response()->json(['response' => $fournisseurs]);
    }


        public function search_blacklist(Request $request)
    {
        $token = $_COOKIE['token'] ?? null;
        $user_id = $_COOKIE['user_id'] ?? null;
        //dd("dzefzef");
        $searchTerm = $request->input('search');
        $entreprise = $request->input('entreprise');
        $domaine = $request->input('domaine');

        $fournisseurs = Fournisseur::where('user_id', $user_id)
            ->where('blaklist', true)
            ->where(function ($query) use ($searchTerm, $domaine, $entreprise ) {
                $query->where('domaine_activites_1', 'LIKE', '%' . $domaine . '%')
                    ->where('entreprise', 'LIKE', '%' . $entreprise . '%')
                    ->where('mobile', 'LIKE', '%' . $searchTerm . '%')
                    ->where('email', 'LIKE', '%' . $searchTerm . '%');
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
             $logoE = Entreprise::where("user_id",$user_id)->first();
        //$logo =$logoE->logo;

        $fournisseurs = Fournisseur::where('user_id',$user_id)->where('blaklist',true)->paginate(5);
       // dd($fournisseurs->links());
        return view('fournisseursBlackliste', compact('fournisseurs','user',));
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
        // dd($data);
        $fournisseurs = Fournisseur::create($data);
        $draft = Draft::findOrFail(intval($request['id']));
        $draft->delete();




       return redirect()->route('fournisseur')->with('success', 'fournisseur ajoutés avec succès!');
    }


    // public function export_f()
    // {
    //     return Excel::download(new ExportFourn, 'fournisseurs.xlsx');
    // }
    public function export_f(Request $request)
    {

        $selectedSupplierIds = explode(',', intval($request->input('selected_suppliers_ids', '')));
        return Excel::download(new ExportFourn($selectedSupplierIds), 'fournisseurs.xlsx');
    }
    public function export_black(Request $request)
    {
        $selectedSupplierIds = explode(',', intval($request->input('selected_suppliers_ids', '')));
        return Excel::download(new ExportBlack($selectedSupplierIds), 'blacklist.xlsx');
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
        $user_id = $_COOKIE['user_id']??null;
        $client = new Client();
        $logoE = Entreprise::where("user_id",$user_id)->first();
        //$logo =$logoE->logo;



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
        $interlocuteurs =json_decode($searchfournisseur['interlocuteur']);
        //dd($searchfournisseur['interlocuteur']);
        }
      #dd($interlocuteur->interloc_nom);
        if (isset($searchfournisseur) || $searchfournisseur !=null){
            return view('search', compact('searchfournisseur','user','interlocuteurs','produits_services',));
        } else {
            return back()->with('error', 'Fournisseur non trouvé.');
        }
    }


}
