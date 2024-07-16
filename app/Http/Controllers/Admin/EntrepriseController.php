<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entreprise;
use GuzzleHttp\Client;

class EntrepriseController extends Controller
{
    /**
     * Afficher la liste des entreprises
     */
    public function index()
    {


    $client = new Client();

    try {
        $response = $client->get('https://bsc-agrement.net/api/userlist', [
            'verify' => false,
        ]);

        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody());
            $entreprises = Entreprise::paginate(10);
            $acheteurs = $data->data;

            return view('admin.entreprises.entreprises', compact('acheteurs','entreprises'));
        }
    } catch (\Exception $e) {
        dd('ssss',$response);
    }

    }

    /**
     * Afficher le formulaire de création d'une entreprise
     */
    public function create()
    {
        return view('admin.entreprises.entreprise');
    }

    /**
     * Enregistrer une nouvelle entreprise
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:entreprises,email',
            'telephone' => 'required|string|max:20',
            'user_id'=>'required|string|max:20',
        ]);
        $imagePath="";
        if ($request->hasFile('logo')) {

            $imagePath = $request->file('logo')->store('logos', 'public');
            Entreprise::create([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'user_id'=>$request->user_id,
                'logo'=>$imagePath
            ]);
        }else{
            Entreprise::create([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'user_id'=>$request->user_id,
            ]);
        }

        $entreprises = Entreprise::paginate(10);




        return response()->json(['success' => true, 'message' => 'Entreprise créée avec succès.', 'entreprises' => $entreprises], 200);

        // return redirect()->route('admin.entreprises')->with('success', 'Entreprise créée avec succès');
    }

    /**
     * Afficher les détails d'une entreprise spécifique
     */
    // public function show($id)
    // {
    //     $entreprise = Entreprise::findOrFail($id);
    //     return view('admin.entreprise', compact('entreprise'));
    // }

    /**
     * Afficher le formulaire de modification d'une entreprise
     */
    public function edit($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        return response()->json(['success' => true, 'entreprise' => $entreprise], 200);
    //     return view('admin.entreprises.edit_entreprise', compact('entreprise'));
    }

    /**
     * Mettre à jour une entreprise spécifique
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:entreprises,email,' . $id,
            'telephone' => 'required|string|max:20',
        ]);
        $entreprise = Entreprise::findOrFail($id);
        $imagePath="";
        if ($request->hasFile('logo')) {

            $imagePath = $request->file('logo')->store('logos', 'public');
            $entreprise->update([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'logo'=>$imagePath
            ]);
        }else{
            $entreprise->update([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'email' => $request->email,
                'telephone' => $request->telephone,
            ]);
        }


        $entreprises = Entreprise::paginate(10);
        return response()->json(['success' => true, 'message' => 'Entreprise modifie avec succès.', 'entreprises' => $entreprises], 200);

    }

    /**
     * Supprimer une entreprise spécifique
     */
    public function destroy($id)
    {
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();

        return redirect()->route('entreprises.index')->with('success', 'Entreprise supprimée avec succès');
    }
}
