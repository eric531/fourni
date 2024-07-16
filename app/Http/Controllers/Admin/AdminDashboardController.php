<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Abonnements;
use App\Models\Entreprise;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abonnementsNbr = Abonnements::count();
        $abonnements = Abonnements::all();
        $currentDate = Carbon::now();
        $abonnementsActif = Abonnements::where('start_date', '<=', $currentDate)
                                       ->where('end_date', '>=', $currentDate)
                                       ->count();
        $abonnementsInactif = Abonnements::where('end_date', '<', $currentDate)->count();
        $entreprisesNbr = Entreprise::count();

        return view('admin.index', compact(
            'abonnementsNbr',
            'abonnements',
            'abonnementsActif',
            'abonnementsInactif',
            'entreprisesNbr'
        ));
        // return view('admin.index');
    }

}
