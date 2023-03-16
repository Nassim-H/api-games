<?php

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

Route::apiResource('jeux', JeuController::class);


Route::prefix('jeux')->group(function () {
    Route::get('/', [JeuController::class, 'index'])
        ->name('jeux.index ');
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
});
