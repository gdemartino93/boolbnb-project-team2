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

    Route::get('/dashboard',[ApiController :: class, 'dashboardList' ]);




});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});
Route :: post('/v1/apartment/store', [ApiController :: class, 'store']);


Route::get('/v1/apartment/all', [ApiController::class, 'index']);
Route::get('/v1/apartment/{id}',[ApiController :: class, 'signleAp']);


Route :: post('/v1/apartment/update/{apartment}', [ApiController :: class, 'update']);

Route :: delete('/v1/apartment/delete/{apartment}', [ApiController :: class, 'delete']);

Route::get('/v1/services/all', [ApiController::class, 'getAdditionalServices']);