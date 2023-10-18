<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TokenMiddleware
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
        $token = $_COOKIE['token'] ?? null;
        //dd($token);
        if ($token !=null) {

            $request->headers->set('Authorization', 'Bearer ' . $token);
           return $next($request);
        }
        return Redirect::route('login');


    }
}

