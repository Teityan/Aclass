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

Route::group(['middleware' => 'auth'], function () {
  Route::get('/', function(){ return view('pages.others.index'); })->name('others');

  Route::get('/changePassword', function(){ return view('pages.others.password'); })->name('changePassword');
  Route::post('/changePassword', 'Auth\ChangePasswordController@index');

  Route::get('/twoFactor', function(){ return view('pages.others.twoFactor'); })->name('twoFactor');
  Route::post('/twoFactor', 'TwoFactorController@change');

  Route::get('/token', 'Auth\ManageApiTokenController@index')->name('token');
  Route::post('/token', 'Auth\ManageApiTokenController@change');
});
