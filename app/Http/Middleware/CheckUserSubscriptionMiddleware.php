<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Entreprise;

class CheckUserSubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $_COOKIE['user_id'] ?? null;

        if ($this->checkActiveAbonnement($userId)) {
            return $next($request);
        }

        abort(403, "No active abonnements found for this entreprise.");
    }

    /**
     * Check if the user has active abonnement.
     *
     * @param  int|null  $userId
     * @return bool
     */
//     protected function checkActiveAbonnement($userId)
//     {
//         if (!$userId) {
//             return false;
//         }

//         // Récupérer toutes les entreprises associées à cet utilisateur
//         $entreprises = Entreprise::whereHas('acheteurs', function ($query) use ($userId) {
//             $query->where('user_id', $userId);
//         })->get();
// dd($entreprises);
//         foreach ($entreprises as $entreprise) {
//             // Vérifiez si l'entreprise a des abonnements actifs
//             $activeAbonnements = $entreprise->abonnements()->where('end_date', '>=', Carbon::now())->exists();

//             if ($activeAbonnements) {
//                 return true;
//             }
//         }

//         return false;
//     }

protected function checkActiveAbonnement($user_id)
{
    // Retrieve all entreprise IDs associated with this user_id from the pivot table
    $entrepriseIds = \DB::table('entreprise_user')
        ->where('user_id', $user_id)
        ->pluck('entreprise_id');

    // Check if there are any entreprises with active abonnements
    $activeAbonnements = \DB::table('abonnements')
        ->whereIn('entreprise_id', $entrepriseIds)
        ->where('end_date', '>=', Carbon::now())
        ->exists();

    return $activeAbonnements;
}

}
