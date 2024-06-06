<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Abonnements;
use App\Models\Entreprise;

class AbonnementController extends Controller
{
    // Afficher tous les abonnements
    public function index()
    {
        $abonnements = Abonnements::paginate(10);
        $entreprises = Entreprise::all();

        return view('admin.abonnements.abonnements', compact('abonnements','entreprises'));
    }

    // Créer un nouvel abonnement
    public function store(Request $request)
    {
        $request->validate([
            'entreprise_id' => 'required|exists:entreprises,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $abonnement = Abonnements::create([
            'entreprise_id' => $request->entreprise_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        $abonnements = Abonnements::paginate(10);
        return response()->json(['success' => true, 'message' => 'Entreprise créée avec succès.', 'abonnements' => $abonnement], 200);

    }


    // public function show($id)
    // {
    //     $abonnement = Abonnement::find($id);

    //     if (is_null($abonnement)) {
    //         return response()->json(['message' => 'Abonnement non trouvé'], 404);
    //     }

    //     return response()->json($abonnement);
    // }



  /**
     * Afficher le formulaire de modification d'une abonnement
     */
    public function edit($id)
    {
        $abonnement = Abonnements::findOrFail($id);
        return response()->json(['success' => true, 'abonnement' => $abonnement], 200);
    //     return view('admin.entreprises.edit_entreprise', compact('entreprise'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'entreprise_id' => 'sometimes|exists:entreprises,id',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
        ]);

        $abonnement = Abonnements::find($id);

        if (is_null($abonnement)) {
            return response()->json(['message' => 'Abonnement non trouvé'], 404);
        }

        $abonnement->update($request->all());

        return response()->json($abonnement);
    }

    // Supprimer un abonnement
    public function destroy($id)
    {
        $abonnement = Abonnements::find($id);

        if (is_null($abonnement)) {
            return redirect()->route('abonnements.index')->with('error', 'non trouve');
        }

        $abonnement->delete();

        return redirect()->route('abonnements.index')->with('success', 'Abonnement supprimée avec succès');
    }
}
