<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }



 /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

     public function store(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');
    $client = new Client();

    try {
        $response = $client->post('https://bsc-agrement.net/api/auth', [
            'form_params' => $credentials,
            'verify' => false,
        ]);

        if ($response->getStatusCode() == 200) {
            $decode = json_decode($response->getBody());
            // dd($decode->data->user->id);
            $token = $decode->data->token;
            $user =  $decode->data->user->name;
            $user_id =  $decode->data->user->id;

            // Stockez le token en tant que cookie
            setcookie('token', $token, time() + 86400, '/', null, false, true);
            setcookie('user', $user, time() + 86400, '/', null, false, true);
            setcookie('user_id', $user_id, time() + 86400, '/', null, false, true);
           $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return view('auth.login');
        }
    } catch (\Exception $e) {
        return view('auth.login');
    }
}

    // public function store(LoginRequest $request)
    // {

    //     $credentials = $request->only('email', 'password');

    //     $client = new Client();



    //     try {
    //         $response = $client->post('https://bsc-agrement.net/api/auth', [
    //             'form_params' =>  $credentials,
    //             'verify' => false,
    //         ]);

    //         if ($response->getStatusCode() == 200) {
    //             $decode = json_decode($response->getBody());
    //             //dd($decode->data->token);


    //             $token =$decode->data->token; //json_decode($response->getBody())->data->token;
    //             // Stockez le token en local storage côté client
    //             echo "<script>localStorage.setItem('token', '$token');</script>";

    //             $request->session()->regenerate();
    //             dd('zzef');
    //             return redirect()->intended(RouteServiceProvider::HOME);
    //         } else {
    //             dd('error');
    //             return view('auth.login');
    //         }
    //     } catch (\Exception $e) {
    //         dd('error');
    //         return view('auth.login');
    //     }
    // }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(LoginRequest $request)
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
       # Auth::guard('web')->logout();

        //delete token and user on cookies
        if (isset($_COOKIE['token'])) {
            unset($_COOKIE['token']);
            setcookie('token', null, -1, '/');
            dd('ghghgh');

        }
        dd('sdfzefzefzefef');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function logoutF(Request $request)
    {

        //delete token and user on cookies
        if (isset($_COOKIE['token'])) {
            unset($_COOKIE['token']);
            setcookie('token', null, -1, '/');

        }


       $request->session()->regenerateToken();

        return redirect('/');
    }
}
