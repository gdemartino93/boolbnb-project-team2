<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum') ->group(function(){

  



});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route :: post('/v1/apartment/store', [ApiController :: class, 'store']);
Route::middleware('auth:sanctum')->get('/user/apartments', [ApiController::class, 'dashboardList']);


Route::get('/v1/apartment/all', [ApiController::class, 'index']);


Route :: post('/v1/apartment/update/{apartment}', [ApiController :: class, 'update']);

Route :: delete('/v1/apartment/delete/{apartment}', [ApiController :: class, 'delete']);