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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/redirect', 'Auth\SocialAuthGoogleController@redirect');
Route::get('/', 'Auth\SocialAuthGoogleController@callback');

Route::get('/downloadData/{type}', 'imporExcelController@downloadData');
Route::get('/excel', 'importExcelController@index');