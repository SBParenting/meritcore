<?php

Route::controller('password', 'Auth\RemindersController');
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');
Route::post('lock', 'Auth\AuthController@postLock');
Route::post('unlock', 'Auth\AuthController@postUnlock');
Route::get('register', 'Front\RegisterController@getIndex');
Route::post('register', 'Front\RegisterController@postIndex');
Route::get('verify/{code}', 'Front\RegisterController@getVerify');
Route::get('register/{code}', 'Front\RegisterController@getWizard');
Route::post('register/{code}', 'Front\RegisterController@postWizard');

Route::group(['prefix' => 'api'], function() {

	Route::post('survey/{key}/save', 	 'Front\SurveyController@postSave');
	Route::post('survey/{key}/complete', 'Front\SurveyController@postComplete');
});

Route::group(['prefix' => 'm', 'middleware' => 'auth'], function() {

	Route::get('/', 'Manage\ManageController@getIndex');
	Route::get('/schools', 'Manage\ManageController@getSchools');
	Route::get('/schools/{id}', 'Manage\ManageController@getSchool');
	Route::get('/classes', 'Manage\ManageController@getClasses');
	Route::post('/classes/add', 'Manage\ClassController@postAdd');
	Route::get('/classes/{id}', 'Manage\ManageController@getClass');
	Route::post('/classes/{id}/students/add', 'Manage\StudentsController@postStudentAdd');
	Route::post('/classes/{id}/info', 'Manage\ClassController@postUpdate');
	Route::post('/classes/{id}/surveys/add', 'Manage\SurveyController@postAdd');
	Route::post('/classes/{id}/surveys/{survey_id}/complete', 'Manage\SurveyController@postComplete');
	Route::get('/students', 'Manage\ManageController@getStudents');
	Route::get('/surveys', 'Manage\ManageController@getSurveys');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

	Route::controller('dashboard', 'Admin\Dashboard\DashboardController');
	Route::get('users/roles/{id?}', 'Admin\Users\RolesController@getIndex');
	Route::post('users/roles/update/{id}', 'Admin\Users\RolesController@postUpdate');
	Route::controller('users', 'Admin\Users\UsersController');
});

Route::get('{key}', 'Front\SurveyController@getIndex');
Route::post('{key}/confirm', 'Front\SurveyController@postConfirm');

require __DIR__ .'/functions.php';
require __DIR__ .'/macros.php';