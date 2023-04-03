<?php

use App\Http\Controllers\Api\AdherentController;
use App\Http\Controllers\Api\CommentaireController;
use App\Http\Controllers\Api\JeuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('adherents', [AdherentController::class, 'store']);
Route::controller(\App\Http\Controllers\Api\AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('logout','logout');
    Route::get('me','me');
});



Route::apiResource('jeux', JeuController::class);


Route::prefix('jeux')->group(function () {
    Route::get('/', [JeuController::class, 'randomIndex'])
        ->name('jeux.randomIndex');
    Route::get('/', [JeuController::class, 'Index'])
        ->name('jeux.index ');
    Route::get('/{id}', [JeuController::class, 'show'])
        ->middleware(['auth', 'role:view-salle'])
        ->name('jeux.show');
    Route::get('/{id}', [JeuController::class, 'details'])
        ->middleware(['auth', 'role:view-salle'])
        ->name('jeux.details');
    Route::put('/', [JeuController::class, 'store'])
        ->middleware(['auth', 'role:edit-salle'])
        ->name('jeux.update');
    Route::post('/{id}', [JeuController::class, 'update'])
        ->name('jeux.store');
    Route::post('/url/{id}', [JeuController::class, 'updateUrl'])
        ->name('jeux.updateUrl');
    Route::delete('/{id}', [JeuController::class, 'destroy'])
        ->middleware(['auth', 'role:admin'])
        ->name('jeux.destroy');
    Route::post('/achat/{id}',[JeuController::class,'destroyAchat'])
        ->name('jeux.destroyAchat');
    Route::post('/achat/{id}',[JeuController::class,'achat'])
        ->name('jeux.achat');
    Route::post('/commentaire/{id}',[CommentaireController::class,'store'])
        ->name('jeux.commentaire');
    Route::post('/commentaire/{id}',[CommentaireController::class,'update'])
        ->name('jeux.commentaire');
    Route::post('/commentaire/{id}',[CommentaireController::class,'destroy'])
        ->name('jeux.commentaire');
});



Route::prefix('commentaire')->group(function () {
    Route::get('/{id}', [JeuController::class, 'index'])
        ->name('commentaire.store ');
    Route::get('/{id}', [JeuController::class, 'show'])
        ->middleware(['auth', 'role:view-salle'])
        ->name('jeux.show');
    Route::put('/', [JeuController::class, 'store'])
        ->middleware(['auth', 'role:edit-salle'])
        ->name('jeux.update');
    Route::post('/{id}', [JeuController::class, 'update'])
        ->name('jeux.store');
    Route::post('/url/{id}', [JeuController::class, 'updateUrl'])
        ->name('jeux.updateUrl');
    Route::delete('/{id}', [JeuController::class, 'destroy'])
        ->middleware(['auth', 'role:admin'])
        ->name('jeux.destroy');
    Route::post('/achat/{id}',[JeuController::class,'achat'])
        ->name('jeux.achat');
});
