<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users_dbscontroller;
use App\Http\Controllers\secretaireController;
use App\Http\Controllers\directeurController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\authgenreralController;
use App\Http\Controllers\HeureTravailController;
use App\Http\Controllers\StatusAttestationPresenceController;
use App\Http\Controllers\PresencePersonnelController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('addattestation',[StatusAttestationPresenceController::class,'addusers']);
//api seretaire
Route::post('addsecretaire',[secretaireController::class,'addsecretaire']);
Route::post('authsecretaire',[secretaireController::class,'auth']);
Route::get('getsecretaire',[secretaireController::class,'getusers']);
//fin 
//api directeur
Route::post('adddirecteur',[directeurController::class,'adddirecteur']);
Route::post('authdirecteur',[directeurController::class,'auth']);
//fin
//api login
Route::post('login',[authgenreralController::class,'login']);
//fin
Route::get('users',[users_dbscontroller::class,'getusers']);
Route::get('personnel',[PersonnelController::class,'getusers']);
Route::delete('deleteuser/{id}',[PersonnelController::class,'deleteusers']);
Route::get('count',[PersonnelController::class,'count']);
Route::get('getattestation/{id}',[PersonnelController::class,'getattestion']);
Route::get('getpresence/{id}',[PersonnelController::class,'presence']);
Route::post('addpersonnels',[PersonnelController::class,'addusers']);
Route::post('authentifiaction',[PersonnelController::class,'auth']);
Route::post('doubleauthentification',[PersonnelController::class,'doubleauth']);
Route::get('users/{id}',[users_dbscontroller::class,'getusersbyid']);
Route::post('addusers',[users_dbscontroller::class,'addusers']);
Route::put('updateuser/{id}',[users_dbscontroller::class,'updateusers']);
// Route::delete('deleteuser/{id}',[users_dbscontroller::class,'deleteusers']);
Route::post('auth',[users_dbscontroller::class,'auth']);
Route::post('doubleauth',[users_dbscontroller::class,'doubleauth']);
Route::post('addpresence',[PresencePersonnelController::class,'addpresence']);
//heuretravail
Route::put('updateheuretravail/{id}',[HeureTravailController::class,'updateusers']);
Route::post('addheuretravail',[HeureTravailController::class,'addheure']);
//fin
//statusattestation
Route::post('addstatusattestation',[StatusAttestationPresenceController::class,'addattestation']);
//

