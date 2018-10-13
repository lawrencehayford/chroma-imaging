<?php

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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout');
//PDF
Route::post('genpdfpreview', 'HomeController@genpdfpreview')->name('genpdfpreview');
Route::post('genpdffinal', 'HomeController@genpdffinal')->name('genpdffinal');
Route::post('uploadimage', 'HomeController@uploadimage')->name('uploadimage');
Route::post('genpdfinalimage', 'HomeController@genpdfinalimage')->name('genpdfinalimage');
Route::get('/gotohome', 'HomeController@gotohome');
