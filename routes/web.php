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
Route::get('/my-profile', 'RiderController@index')->name('my-profile');
Route::get('/my-profile/edit', 'RiderController@create')->name('my-profile.edit');
Route::post('/my-profile/update', 'RiderController@update')->name('edit-profile');

Route::get('bikes', 'BikeController@index')->name('bikes');
Route::get('bikes/add', 'BikeController@create')->name('add-bike');

Route::get('rides', 'RideController@index')->name('rides');
Route::get('add-ride', 'RideController@create')->name('add-ride');
Route::post('register1', 'RideController@addRideStep1')->name('register1');
Route::post('add-ride-day', 'RideController@addRideDay')->name('ride-day');
Route::post('register2', 'RideController@addRideStep2')->name('register2');
Route::post('save-ride', 'RideController@saveRide')->name('ride-submit');

Route::post('search', 'HomeController@search')->name('search-result');

