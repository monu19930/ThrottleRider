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
Route::get('/', 'HomeController@index')->name('login');


Route::get('/ride', 'HomeController@rides')->name('front-rides');
Route::get('/biker', 'HomeController@bikers')->name('front-bikers');
Route::get('/group', 'HomeController@groups')->name('front-groups');

Route::group(['middleware'=>['auth','admin']],function(){
    Route::get('dashboard', 'AdminController@index');
    Route::get('dashboard', 'AdminController@index')->name('admin-dashboard');
});


Route::post('/rider-signup', 'RiderController@register')->name('rider-register');
Route::post('/rider-login', 'RiderController@login')->name('rider-login');

Route::group(['middleware'=>['auth']],function(){
    Route::get('/logout', 'RiderController@logout')->name('rider-logout');
    Route::get('/my-profile', 'RiderController@index')->name('my-profile');
    Route::get('/my-profile/edit', 'RiderController@create')->name('my-profile.edit');
    Route::post('/my-profile/update', 'RiderController@update')->name('edit-profile');

    Route::get('bikes', 'BikeController@index')->name('bikes');
    Route::get('bikes/add', 'BikeController@create')->name('add-bike');

    Route::get('rides', 'RideController@index')->name('rides');
    Route::get('rides/add', 'RideController@create')->name('add-ride');
    Route::post('register1', 'RideController@addRideStep1')->name('register1');
    Route::post('add-ride-day', 'RideController@addRideDay')->name('ride-day');
    Route::post('register2', 'RideController@addRideStep2')->name('register2');
    Route::post('save-ride', 'RideController@saveRide')->name('ride-submit');
    Route::post('ride-delete', 'RideController@delete')->name('delete-ride');

    Route::post('search', 'HomeController@search')->name('search-result');

    Route::post('bikes/search', 'BikeController@search')->name('bike-search');
    Route::get('bikes/edit/{id}', 'BikeController@edit');

    Route::post('bikes/details', 'BikeController@searchBikeDetails')->name('search-bike-details');
    Route::post('bike-register1', 'BikeController@addBikeStep1')->name('bike-register1');
    Route::post('bike-register2', 'BikeController@addBikeStep2')->name('bike-register2');
    Route::post('save-bike', 'BikeController@saveBike')->name('bike-submit');
    Route::post('bike-delete', 'BikeController@delete')->name('delete-bike');
    Route::post('get-brands', 'BikeController@brandList')->name('brand-list');
    
    Route::post('review-bike-model', 'BikeController@reviewBikeImageSave')->name('review-bike-image-save');
    Route::post('review-bike-moredetails', 'BikeController@reviewBikeMoreDetailsSave')->name('review-bike-moredetails-save');
    Route::post('review-bike-description', 'BikeController@reviewBikeDescSave')->name('review-bike-desc-save');

    Route::post('group-join', 'RiderController@joinGroup')->name('join-group');
    Route::post('invite-members', 'RiderController@inviteGroupMembers')->name('invite-group-members');

    
    Route::get('group/{id}/join', 'RiderController@invitationJoinGroup');
    

    Route::get('groups', 'GroupController@index')->name('groups');
    Route::get('groups/add-group', 'GroupController@create')->name('add-group');
    Route::post('save-group', 'GroupController@saveGroup')->name('group-submit');
    Route::post('save-group', 'GroupController@saveGroup')->name('group-submit');


    Route::get('group/{id}/events', 'EventController@index')->name('group.events');
    Route::get('group/{id}/events/add', 'EventController@create')->name('group.events.add');
    Route::post('group/events/add', 'EventController@eventAddStep1')->name('group.events.add.step1');
    Route::post('group/events/add-2', 'EventController@eventAddStep2')->name('group.events.add.step2');
    Route::post('group/events/save', 'EventController@eventSave')->name('group.events.submit');


});

Route::get('login/{social}', 'Auth\LoginController@redirectToSocial')->where('social', 'facebook|google');
Route::get('login/{social}/callback', 'Auth\LoginController@handleSocialCallback')->where('social', 'facebook|google');

Route::post('search-filter', 'HomeController@searchToLocation')->name('search-location');
Route::post('search-data', 'HomeController@searchToLocationData')->name('search-location-result');

