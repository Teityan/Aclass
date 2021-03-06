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
  Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/redirect', function (){return view('auth.redirect');})->name('redirect');
});

Route::get('/register', 'Auth\RegisterController@showRegistrationFormViaAuthRegisterController')->name('register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/new', function(){ return view('auth.new'); })->middleware('guest')->name('new');
Route::post('/new', 'Auth\NewController@new')->middleware('guest');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
