<?php

use App\Http\Controllers\Bsc\ControllerFournisseur;
use App\Http\Controllers\Bsc\DashboardController;

use App\Http\Controllers\Bsc\DraftController;
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



Route::middleware(['token',])->group(function(){

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/Rechercherfournisseur', [ControllerFournisseur::class, 'rechercherFournisseur'])->name('recherche');
    // Route::get('/Rechercherfournisseur/{code}', [ControllerFournisseur::class, 'rechercherFournisseur'])->name('recherche');
    Route::post('/Ajouterfournisseur', [ControllerFournisseur::class, 'ajouterFournisseurs'])->name('ajouterfournisseurs');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/fournisseur', [ControllerFournisseur::class, 'index'])->name('fournisseur');
    Route::get('/draft', [DraftController::class, 'index'])->name('draft_list');
    Route::post('/draft', [DraftController::class, 'store'])->name('draft_add');
    Route::delete('/draft', [DraftController::class, 'destroy'])->name('draft_destroy');


});


require __DIR__.'/auth.php';
