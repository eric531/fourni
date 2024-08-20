<?php

use App\Http\Controllers\Bsc\ControllerFournisseur;
use App\Http\Controllers\Bsc\DashboardController;

use App\Http\Controllers\Bsc\DraftController;
use App\Http\Controllers\Admin\EntrepriseController;
use App\Http\Controllers\Admin\AbonnementController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::post('/Ajouterfournisseur', [ControllerFournisseur::class, 'ajouterFournisseurs'])->name('ajouterfournisseurs');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/fournisseurAgree', [ControllerFournisseur::class, 'index'])->name('fournisseur');
Route::get('/fournisseurBlackliste', [ControllerFournisseur::class, 'blacklist'])->name('blacklist');
Route::post('/blacklist_set', [ControllerFournisseur::class, 'setblacklist'])->name('blacklist_set');
Route::get('/fournisseurProspect', [DraftController::class, 'index'])->name('draft_list');
Route::post('/draft', [DraftController::class, 'store'])->name('draft_add');
Route::delete('/draft', [DraftController::class, 'destroy'])->name('draft_destroy');
Route::post('export/excel', [ControllerFournisseur::class, 'export_f'])->name('export.excel');
Route::post('export/black', [ControllerFournisseur::class, 'export_black'])->name('export.blacklist');
Route::post('export/draft', [DraftController::class, 'export_draft'])->name('export.draft');


Route::get('/Rechercherfournisseur', [ControllerFournisseur::class, 'rechercherFournisseur'])->name('recherche');
Route::get('/search_page', [ControllerFournisseur::class, 'search_view'])->name('recherche_view');
Route::post('/search_fourn', [ControllerFournisseur::class, 'search'])->name('search_fourn');
Route::post('/search_blacklist', [ControllerFournisseur::class, 'search_blacklist'])->name('search_blacklist');
Route::post('/search_draft', [DraftController::class, 'search'])->name('search_draft');


Route::get('/admin/dashboard',[AdminDashboardController::class, 'index']);
Route::resource('admin/entreprises',EntrepriseController::class);
Route::resource('admin/abonnements',AbonnementController::class);

Route::middleware(['token','abonnement'])->group(function(){


    // Route::get('/Rechercherfournisseur', [ControllerFournisseur::class, 'rechercherFournisseur'])->name('recherche');
    // Route::get('/search_page', [ControllerFournisseur::class, 'search_view'])->name('recherche_view');
    // Route::post('/search_fourn', [ControllerFournisseur::class, 'search'])->name('search_fourn');
    // Route::post('/search_blacklist', [ControllerFournisseur::class, 'search_blacklist'])->name('search_blacklist');
    // Route::post('/search_draft', [DraftController::class, 'search'])->name('search_draft');

    // // Route::get('/Rechercherfournisseur/{code}', [ControllerFournisseur::class, 'rechercherFournisseur'])->name('recherche');
    // Route::post('/Ajouterfournisseur', [ControllerFournisseur::class, 'ajouterFournisseurs'])->name('ajouterfournisseurs');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/fournisseurAgree', [ControllerFournisseur::class, 'index'])->name('fournisseur');
    // Route::get('/fournisseurBlackliste', [ControllerFournisseur::class, 'blacklist'])->name('blacklist');
    // Route::post('/blacklist_set', [ControllerFournisseur::class, 'setblacklist'])->name('blacklist_set');
    // Route::get('/fournisseurProspect', [DraftController::class, 'index'])->name('draft_list');
    // Route::post('/draft', [DraftController::class, 'store'])->name('draft_add');
    // Route::delete('/draft', [DraftController::class, 'destroy'])->name('draft_destroy');
    // Route::post('export/excel', [ControllerFournisseur::class, 'export_f'])->name('export.excel');
    // Route::post('export/black', [ControllerFournisseur::class, 'export_black'])->name('export.blacklist');
    // Route::post('export/draft', [DraftController::class, 'export_draft'])->name('export.draft');

});


Route::namespace('Auth')->middleware('guest')->group(function(){
    // login route
    Route::get('/admin/login',[AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('/admin/login',[AdminAuthenticatedSessionController::class, 'store'])->name('adminlogin');
});

Route::middleware(['auth','admin'])->group(function(){

    // Route::get('/admin/dashboard',[AdminDashboardController::class, 'index']);
    // Route::resource('admin/entreprises',EntrepriseController::class);
    // Route::resource('admin/abonnements',AbonnementController::class);



});
require __DIR__.'/auth.php';
