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
    Route::put('/{id}', [AdherentController::class, 'update'])
        ->middleware(['him'])
        ->name('adherents.update');
    Route::put('/{id}', [AdherentController::class, 'updateAvatar'])
        ->middleware(['him'])
        ->name('adherents.updateAvatar');
});



Route::prefix('jeux')->group(function () {
    Route::get('/random', [JeuController::class, 'randomIndex'])
        ->name('jeux.randomIndex');
    Route::get('/jeux', [JeuController::class, 'index'])
        ->middleware('auth')
        ->name('jeux.index ')
        ->where(['age' =>'[0-9]+', 'duree'=>'[0-9]+', 'nb_joueurs_min'=>'[0-9]+', 'nb_joueurs_max'=>'[0-9]+', 'sort'=>'(asc|desc)', 'categorie'=>'[a-zA-Z0-9]+', 'theme'=>'[a-zA-Z0-9]+', 'editeur'=>'[a-zA-Z0-9]+']);
    Route::post('/jeux', [JeuController::class, 'store'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.store');
    Route::put('/{id}', [JeuController::class, 'update'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.update');
    Route::put('/{id}', [JeuController::class, 'updateUrl'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.updateUrl');
    Route::post('/achat/{id}', [JeuController::class, 'achat'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.achat');
    Route::delete('/achat/{id}', [JeuController::class, 'destroyAchat'])
        ->middleware(['essaie:adherent-premium,commentaire-moderateur,administrateur'])
        ->name('jeux.destroyAchat');

    Route::get('/{id}', [JeuController::class, 'details'])
        ->middleware(['auth'])
        ->name('jeux.details');

    Route::get('/prix_achat_moyen/{id}', [JeuController::class, 'prix_moyen'])
        ->middleware(['auth'])
        ->name('jeux.prix_moyen');

    Route::get('/{id}/commentaires', [JeuController::class, 'commentaire_jeu'])
        ->middleware(['auth'])
        ->name('jeux.commentaire_jeu');
});


Route::prefix('commentaires')->group(function () {
    Route::post('/', [CommentaireController::class, 'store'])
        ->middleware(['auth'])
        ->name('commentaires.store ');
    Route::put('/{id}', [CommentaireController::class, 'update'])
        ->middleware(['commentaire:commentaire-moderateur,administrateur'])
        ->name('commentaires.update');
    Route::delete('/{id}', [CommentaireController::class, 'destroy'])
        ->middleware(['commentaire:commentaire-moderateur,administrateur'])
        ->name('commentaires.destroy');
});


