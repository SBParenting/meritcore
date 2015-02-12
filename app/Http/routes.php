<?php

Route::controller('password', 'Auth\RemindersController');
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::post('lock', 'Auth\AuthController@postLock');
Route::post('unlock', 'Auth\AuthController@postUnlock');
Route::get('register', 'Auth\RegisterController@getIndex');
Route::post('register', 'Auth\RegisterController@postIndex');
Route::get('verify/{code}', 'Auth\RegisterController@getVerify');
Route::get('register/{code}', 'Auth\RegisterController@getComplete');
Route::post('register/{code}', 'Auth\RegisterController@postComplete');

Route::get('{key}', 'Front\SurveyController@getIndex');
Route::post('{key}/confirm', 'Front\SurveyController@postConfirm');

Route::group(['prefix' => 'api'], function() {

	Route::post('survey/{key}/save', 	 'Front\SurveyController@postSave');
	Route::post('survey/{key}/complete', 'Front\SurveyController@postComplete');

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

	Route::controller('dashboard', 'Admin\Dashboard\DashboardController');
	Route::get('users/roles/{id?}', 'Admin\Users\RolesController@getIndex');
	Route::post('users/roles/update/{id}', 'Admin\Users\RolesController@postUpdate');
	Route::controller('users', 'Admin\Users\UsersController');
});


require __DIR__ .'/functions.php';
require __DIR__ .'/macros.php';