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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('login/{social}', 'Auth\LoginController@redirectToSocial')->where('social', 'facebook|google');
Route::get('login/{social}/callback', 'Auth\LoginController@handleSocialCallback')->where('social', 'facebook|google');

Route::post('/rider-signup', 'RiderController@register');
Route::post('/rider-login', 'RiderController@login')->name('login');
Route::get('/logout', 'RiderController@logout')->name('logout');
Route::get('/my-profile', 'RiderController@profile')->name('profile');

Route::post('bike', 'BikeController@addBikes')->name('add-bike');