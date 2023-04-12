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
    Route::post('register','register');
    Route::post('login','login');
    Route::post('logout','logout');
    Route::get('me','me');
});



Route::prefix('adherents')->group(function () {
    Route::get('/{id}', [AdherentController::class, 'show'])
        ->middleware(['him'])
        ->name('adherents.show ');
    Route::post('/{id}', [AdherentController::class, 'update'])
        ->middleware(['him'])
        ->name('adherents.update');
    Route::put('/{id}', [AdherentController::class, 'updateAvatar'])
        ->middleware(['him'])
        ->name('adherents.update');
});



Route::prefix('jeux')->group(function () {
    Route::get('/random', [JeuController::class, 'randomIndex'])
        ->name('jeux.randomIndex');
    Route::get('/jeux', [JeuController::class, 'index'])
        ->middleware('auth')
        ->name('jeux.index ');
    Route::post('/jeux', [JeuController::class, 'store'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.store');
    Route::post('/{id}', [JeuController::class, 'update'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.update');
    Route::post('/{id}', [JeuController::class, 'updateUrl'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.updateUrl');
    Route::post('/achat/{id}', [JeuController::class, 'achat'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.achat');
    Route::post('/achat/{id}', [JeuController::class, 'destroyAchat'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.destroyAchat');

    Route::get('/{id}', [JeuController::class, 'details'])
        ->middleware(['auth'])
        ->name('jeux.details');
});


Route::prefix('commentaires')->group(function () {
    Route::post('/', [CommentaireController::class, 'store'])
        ->middleware(['auth'])
        ->name('commentaires.store ');
    Route::post('/{id}', [CommentaireController::class, 'update'])
        ->middleware(['commentaire:commentaire-moderateur,administrateur'])
        ->name('commentaires.update');
    Route::post('/{id}', [CommentaireController::class, 'destroy'])
        ->middleware(['commentaire:commentaire-moderateur,administrateur'])
        ->name('commentaires.destroy');
});


