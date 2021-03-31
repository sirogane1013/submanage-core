<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/session-check', function() {
    if (! Auth::check()) {
        return response('Unauthorized', 401);
    }
    return response('OK', 200);
});

Route::post('/user/login', 'App\Http\Controllers\Api\UserController@authenticate')
    ->middleware('web')
    ->name('login');

Route::get('/user/logout', 'App\Http\Controllers\Api\UserController@logout')
    ->middleware('web')
    ->name('logout');

Route::post('/user/register', 'App\Http\Controllers\Api\UserController@register')
    ->name('register');

Route::group(['prefix' => 'service', 'middleware' => ['auth:sanctum']], function () {
    Route::get('aggregation', 'App\Http\Controllers\Api\ServiceController@aggregation');
    Route::get('list', 'App\Http\Controllers\Api\ServiceController@list');
    Route::post('add', 'App\Http\Controllers\Api\ServiceController@add');
    Route::delete('delete', 'App\Http\Controllers\Api\ServiceController@delete');
});
