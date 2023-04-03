<?php

use App\Http\Controllers\Api\AdherentController;
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

Route::apiResource('jeux', JeuController::class);
Route::prefix('jeux')->group(function () {
    Route::get('/', [JeuController::class, 'index'])
        ->name('jeux.index ');
    Route::get('/{id}', [JeuController::class, 'show'])
        ->middleware(['auth'])
        ->name('jeux.show');
    Route::put('/', [JeuController::class, 'store'])
        ->middleware(['auth', 'role:edit-salle'])
        ->name('jeux.update');
    Route::post('/{id}', [JeuController::class, 'update'])
        ->name('jeux.store');
    Route::delete('/{id}', [JeuController::class, 'destroy'])
        ->middleware(['auth', 'role:admin'])
        ->name('jeux.destroy');
});

