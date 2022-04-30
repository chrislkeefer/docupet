<?php

use App\Http\Controllers\Api\PetBreedListApiController;
use App\Http\Controllers\Api\PetResourceApiController;
use App\Http\Controllers\Api\PetSpeciesListApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::resource('pet', PetResourceApiController::class);
Route::get('species', PetSpeciesListApiController::class);
Route::get('breed', PetBreedListApiController::class);
