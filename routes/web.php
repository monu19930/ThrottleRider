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

Route::get('/rides', 'HomeController@rides')->name('rides.index');
Route::get('/rides/{id}', 'HomeController@rideDetail')->name('rides.show');
Route::get('/bikers', 'HomeController@bikers')->name('bikers.index');
Route::get('/groups', 'HomeController@groups')->name('groups.index');

Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');

Route::post('/rider-signup', 'RiderController@register')->name('rider-register');
Route::post('/rider-login', 'RiderController@login')->name('rider-login');

Route::get('/signin', 'HomeController@signinForm')->name('signup-mob');

Route::group(['middleware'=>['auth']],function(){
    Route::get('/logout', 'RiderController@logout')->name('rider-logout');
    Route::get('/my-profile', 'RiderController@index')->name('my-profile');
    Route::get('/my-profile/edit', 'RiderController@create')->name('my-profile.edit');
    Route::post('/my-profile/update', 'RiderController@update')->name('edit-profile');

    Route::get('bikes', 'BikeController@index')->name('bikes');
    Route::get('bikes/add', 'BikeController@create')->name('add-bike');

    Route::get('my-rides', 'RideController@index')->name('my-rides');
    Route::get('my-rides/create', 'RideController@create')->name('my-rides.create');
    Route::post('my-rides/register1', 'RideController@addRideStep1')->name('my-rides.register1');
    Route::post('my-rides/add-day', 'RideController@addRideDay')->name('my-rides.add-day');
    Route::post('my-rides/register2', 'RideController@addRideStep2')->name('my-rides.register2');
    Route::post('my-rides/store', 'RideController@store')->name('my-rides.store');
    Route::post('my-rides/destroy', 'RideController@destroy')->name('my-rides.destroy');

    Route::post('search', 'HomeController@search')->name('search-result');

    Route::post('bikes/search', 'BikeController@search')->name('bike-search');
    Route::get('bikes/edit/{id}', 'BikeController@edit')->name('bikes.edit');

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

    Route::get('my-groups/{id}/join', 'RiderController@invitationJoinGroup');
    
    Route::resource('my-groups', 'GroupController');

    Route::get('my-groups/{id}/events', 'EventController@index')->name('my-groups.events');
    Route::get('my-groups/{id}/events/create', 'EventController@create')->name('my-groups.events.create');
    Route::post('my-groups/events/add-step-1', 'EventController@eventAddStep1')->name('my-groups.events.add.step1');
    Route::post('my-groups/events/add-step-2', 'EventController@eventAddStep2')->name('my-groups.events.add.step2');
    Route::post('my-groups/events/store', 'EventController@store')->name('my-groups.events.store');

    Route::post('my-groups/past-experience/store', 'GroupController@savePastExperience')->name('my-groups.experience.store');
   
    Route::post('get-group_members', 'RiderController@groupMemberList')->name('group_member-list');
    Route::post('chat/add', 'RiderController@saveDataChat')->name('send-contact-detail');

    Route::resource('suppliers', 'SupplierController');
    Route::resource('tips', 'TipController');

    Route::resource('polls', 'PollController');
    Route::post('my-groups/polls', 'PollController@groupPollsList')->name('get-group-polls');
    Route::post('poll/feedback/save', 'PollController@savePollsFeedback')->name('save-rider-polls-feedback');


    Route::post('follow-rider', 'RiderController@followRider')->name('follow-rider');
});

Route::get('login/{social}', 'Auth\LoginController@redirectToSocial')->where('social', 'facebook|google');
Route::get('login/{social}/callback', 'Auth\LoginController@handleSocialCallback')->where('social', 'facebook|google');

Route::post('search-filter', 'HomeController@searchToLocation')->name('search-location');
Route::post('search-data', 'HomeController@searchToLocationData')->name('search-location-result');

Route::post('ride-filter-search', 'HomeController@RideSearchFilter')->name('ride-filter-search');

