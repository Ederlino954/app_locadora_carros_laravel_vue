<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('client', 'App\Http\Controllers\ClientController');


Route::apiResource('client', 'App\Http\Controllers\ClientController')->middleware('jwt.auth');
Route::apiResource('car', 'App\Http\Controllers\CarController')->middleware('jwt.auth');
Route::apiResource('rent', 'App\Http\Controllers\RentController')->middleware('jwt.auth');
Route::apiResource('brand', 'App\Http\Controllers\BrandController')->middleware('jwt.auth');
Route::apiResource('type', 'App\Http\Controllers\TypeController')->middleware('jwt.auth');


Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
Route::post('/refresh', 'App\Http\Controllers\AuthController@refresh');
Route::post('/me', 'App\Http\Controllers\AuthController@me');
