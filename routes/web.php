<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard',[Controller::class,'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/create_transaction',[Controller::class,'create_transaction'])->name('create_transaction')->middleware('auth');
Route::post('/create_transaction',[Controller::class,'create_transaction'])->middleware('auth');
Route::get('/modify_transaction/{id}',[Controller::class,'modify_transaction'])->name('modify_transaction')->middleware('auth');
Route::post('/modify_transaction/{id}',[Controller::class,'modify_transaction'])->middleware('auth');
Route::get('/more_transaction/{id}',[Controller::class,'more_transaction'])->name('more_transaction')->middleware('auth');

Route::get('/liste_transaction',[Controller::class,'liste_transaction'])->name('liste_transaction')->middleware('auth');
Route::get('/statistique_transaction',[Controller::class,'statistique_transaction'])->name('statistique_transaction')->middleware('auth');
Route::get('/statistique',[Controller::class,'statistique'])->name('statistique')->middleware('auth');
Route::get('/statistique_annuel',[Controller::class,'statistique_annuel'])->name('statistique_annuel')->middleware('auth');
Route::get('/statistique_annuel_nombre',[Controller::class,'statistique_annuel_nombre'])->name('statistique_annuel_nombre')->middleware('auth');

Route::get('/recapitulatif',[Controller::class,'recapitulatif'])->name('recapitulatif')->middleware('auth');
Route::get('/recapitulatif_flooz',[Controller::class,'recapitulatif_flooz'])->name('recapitulatif_flooz')->middleware('auth');

Route::get('/recapitulatif_tmoney',[Controller::class,'recapitulatif_tmoney'])->name('recapitulatif_tmoney')->middleware('auth');
Route::get('/recapitulatif_ria',[Controller::class,'recapitulatif_ria'])->name('recapitulatif_ria')->middleware('auth');
Route::get('/recapitulatif_western_union',[Controller::class,'recapitulatif_western_union'])->name('recapitulatif_western_union')->middleware('auth');
Route::get('/recapitulatif_moneygram',[Controller::class,'recapitulatif_moneygram'])->name('recapitulatif_moneygram')->middleware('auth');

Route::get('/liste_log',[Controller::class,'liste_log'])->name('liste_log')->middleware('auth');
Route::get('/liste_log_activite',[Controller::class,'liste_log_activite'])->name('liste_log_activite')->middleware('auth');
Route::get('/more_log/{id}',[Controller::class,'more_log'])->name('more_log')->middleware('auth');

Route::get('/liste_admin',[Controller::class,'liste_admin'])->name('liste_admin')->middleware('auth');
Route::get('/more_admin/{id}',[Controller::class,'more_admin'])->name('more_admin')->middleware('auth');

Route::get('/create_admin',[Controller::class,'create_admin'])->name('create_admin')->middleware('auth');
Route::post('/create_admin',[Controller::class,'create_admin'])->name('create_admin')->middleware('auth');

Route::get('/delete_admin/{id}',[Controller::class,'delete_admin'])->name('delete_admin')->middleware('auth');
Route::post('/delete_admin/{id}',[Controller::class,'delete_admin'])->name('delete_admin')->middleware('auth');

Route::get('/delete_transaction/{id}',[Controller::class,'delete_transaction'])->name('delete_transaction')->middleware('auth');
Route::post('/delete_transaction/{id}',[Controller::class,'delete_transaction'])->name('delete_transaction')->middleware('auth');

Route::get('/gestion_compte',[Controller::class,'gestion_compte'])->name('gestion_compte')->middleware('auth');
Route::post('/gestion_compte',[Controller::class,'gestion_compte'])->name('gestion_compte')->middleware('auth');

Route::get('/approvisionner_compte',[Controller::class,'approvisionner_compte'])->name('approvisionner_compte')->middleware('auth');
Route::post('/approvisionner_compte',[Controller::class,'approvisionner_compte'])->name('approvisionner_compte')->middleware('auth');

Route::get('/change_password',[Controller::class,'change_password'])->name('change_password')->middleware('auth');
Route::post('/change_password',[Controller::class,'change_password'])->name('change_password')->middleware('auth');

Route::get('/login',[Controller::class,'login'])->name('login');
Route::post('/login',[Controller::class,'login']);

Route::get('/register',[Controller::class,'register'])->name('register');
Route::post('/register',[Controller::class,'register']);

Route::get('/logout',[Controller::class,'logout'])->name('logout');

Route::get('/t',[Controller::class,'t'])->name('t');



//moneygram