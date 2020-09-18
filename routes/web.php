<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth.api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});
Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/registration', function () {
    return view('registration');
});

/*Auth::routes();*/

/*Route::get('/home', 'HomeController@index')->name('home');*/
