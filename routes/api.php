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

/*Route::middleware('auth.api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('registration','AuthenController@store');;
Route::post('login','AuthenController@login');
Route::middleware('auth.api')->group(function ()
{
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/logout', 'AuthenController@logout');

    Route::get('/todo', 'TodoController@index');
    Route::post('/todo', 'TodoController@store');
    Route::put('/todo/{todo}', 'TodoController@update');
    Route::delete('/todo/{todo}', 'TodoController@destroy');
   /* Route::post('/logout', 'AuthController@logout');*/
});



/*Route::resource('/todo', 'TodoController');
Route::post('/checkbox/{id}', 'TodoController@checkBox') ;*/
