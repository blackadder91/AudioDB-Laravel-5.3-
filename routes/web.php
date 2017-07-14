<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('/', 'IndexController@index');
Route::resource('archive', 'ArchiveController');
Route::resource('artists', 'ArtistController');
Route::resource('recordings', 'RecordingController');
Route::post('recordings/filter', 'RecordingController@filter')->name('recordings.filter');
Route::resource('releases', 'ReleaseController');
Route::post('releases/filter', 'ReleaseController@filter')->name('releases.filter');
Route::resource('countries', 'CountryController');
Route::resource('genres', 'GenreController');
Route::resource('labels', 'LabelController');

// Routes with referece id to related entities
Route::get('recordings/create/artist/{artist}', 'RecordingController@createWithArtistRef');
Route::get('releases/create/recording/{recording}', 'ReleaseController@createWithRecordingRef');
