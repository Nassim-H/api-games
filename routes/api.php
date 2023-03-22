<?php

use App\Http\Controllers\Api\AdherentController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('adherents', [AdherentController::class, 'store']);
Route::controller(\App\Http\Controllers\Api\AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('logout','logout');
    Route::get('me','me');
});


