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

Auth::routes();
Route::get('home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('auth.login');
});


Route::get('statistic', 'Guestbook\StatisticController@getForm');
Route::post('statistic', 'Guestbook\StatisticController@getResult');


Route::group(['middleware' => 'auth', 'namespace' => 'Guestbook', 'prefix' => 'guestbook'], function () {
    Route::resource('guests', 'GuestController')->names('guestbook.guests');
});

Route::get('getguests', 'Guestbook\GuestController@getGuests')->name('get.guests');

Route::group(['middleware' => 'auth', 'namespace' => 'Guestbook', 'prefix' => 'guestbook'], function () {
    Route::resource('visits', 'VisitController')->names('guestbook.visits');
});

Route::get('getvisits', 'Guestbook\VisitController@getVisits')->name('get.visits');