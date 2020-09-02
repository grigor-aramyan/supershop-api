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



Route::domain('{account}.localhost')->group(function () {
    Route::get('/', 'HomeController@account');
});



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::group([

    'middleware' => 'api',
    'prefix' => 'store'

], function ($router) {

    Route::get('store', 'StoreController@store');
    Route::get('show/{id}', 'StoreController@show');
    
});



Route::group([

    'middleware' => 'api',
    'prefix' => 'builder'

], function ($router) {

    Route::post('store', 'BuilderController@store');
    
});


