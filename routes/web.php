<?php

use App\Http\Controllers\Bsc\ControllerFournisseur;
use App\Http\Controllers\Bsc\ControllerUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/teste', [ControllerUser::class, 'index']);



Route::middleware(['auth',])->group(function(){

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::post('/Rechercherfournisseur', [ControllerFournisseur::class, 'rechercherFournisseur'])->name('recherche');
    Route::post('/Ajouterfournisseur', [ControllerFournisseur::class, 'ajouterFournisseurs'])->name('ajouterfournisseurs');
    Route::get('/dashboard', [ControllerUser::class, 'index'])->name('dashboard');
    Route::get('/fournisseur', [ControllerFournisseur::class, 'index'])->name('fournisseur');
    

});

require __DIR__.'/auth.php';