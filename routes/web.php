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

// LDAP Login Routes
// Route::get('login', 'Auth\LdapAuthController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LdapAuthController@login')->name('login.submit');

// Route::get('/login', 'Auth\LoginController@login')->name('login');
// Route::get('/auth/azure/callback', 'Auth\LoginController@handleAzureCallback');

Route::get('/login/azure', 'Auth\LoginController@redirectToAzure')->name('login.azure');
Route::get('/login/azure/callback', 'Auth\LoginController@handleAzureCallback');
