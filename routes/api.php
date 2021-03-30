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

Route::post('/user/login', 'App\Http\Controllers\Api\UserController@authenticate')
    ->middleware('web')
    ->name('login')
;
Route::post('/user/register', 'App\Http\Controllers\Api\UserController@register')
    ->name('register')
;
Route::group(['prefix' => 'service', 'middleware' => ['auth:sanctum']], function () {
    Route::get('list', 'App\Http\Controllers\Api\ServiceController@list');
    Route::post('add', 'App\Http\Controllers\Api\ServiceController@add');
    Route::delete('delete', 'App\Http\Controllers\Api\ServiceController@delete');
});
