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
        if ($this->checkActiveAbonnement($request->user()->user_id)) {
            return $next($request);
        }

        abort(403, "No active abonnements found for this entreprise.");
        // dd("sdwdws");
    }

    /**
     * Check if the user has active abonnement.
     *
     * @param  int  $user_id
     * @return bool
     */
    protected function checkActiveAbonnement($user_id)
    {

        $entreprise = Entreprise::where('user_id', $user_id)->first();

        if ($entreprise) {
            $activeAbonnements = $entreprise->abonnements()->where('end_date', '>=', Carbon::now())->get();

            return $activeAbonnements->isNotEmpty();
        }

        return false;
    }
}
