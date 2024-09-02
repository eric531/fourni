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
        // dd('ssss',$response);
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
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:15',
            'logo' => 'nullable|image|max:2048',
            'user_id' => 'required|array',
        ]);
        // dd($validatedData['user_id']);
        $entreprise = Entreprise::create([
            'nom' => $validatedData['nom'],
            'adresse' => $validatedData['adresse'],
            'email' => $validatedData['email'],
            'telephone' => $validatedData['telephone'],
            'logo' => $validatedData['logo'] ? $validatedData['logo']->store('logos') : null,
        ]);

        $entreprise->acheteurs()->sync($validatedData['user_id']);


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
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:15',
            'logo' => 'nullable|image|max:2048',
            'user_id' => 'required|array',
        ]);

        // Vérifiez qu'aucun utilisateur n'est déjà associé à une autre entreprise
        $existingAssociation = \DB::table('entreprise_user')
        ->whereIn('user_id', $validatedData['user_id'])
        ->exists();

        if ($existingAssociation) {
        return response()->json(['success' => false, 'message' => 'One or more selected users are already associated with another enterprise.'], 400);
        }
        
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->update(
            [
                'nom' => $validatedData['nom'],
                'adresse' => $validatedData['adresse'],
                'email' => $validatedData['email'],
                'telephone' => $validatedData['telephone'],
                'logo' => $validatedData['logo'] ? $validatedData['logo']->store('logos') : null,
            ]);
        $entreprise->acheteurs()->sync($validatedData['user_id']);

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
