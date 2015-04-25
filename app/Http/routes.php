<?php
Route::controller('password', 'Auth\RemindersController');
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/', 'Auth\AuthController@postLogin');
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
	Route::post('/schools/add', 'Manage\SchoolsController@postAdd');
	Route::post('/schools/{id}/remove', 'Manage\SchoolsController@postRemove');
	Route::post('/schools/{id}/update', 'Manage\SchoolsController@postUpdate');
	Route::get('/schools/{id}', 'Manage\ManageController@getClasses');
	Route::get('/classes', 'Manage\ManageController@getClasses');
	Route::post('/classes/add', 'Manage\ClassController@postAdd');
	Route::post('/classes/{id}/archive', 'Manage\ClassController@postArchive');
	Route::post('/classes/{id}/activate', 'Manage\ClassController@postActivate');
	Route::get('/classes/{id}', 'Manage\ManageController@getClass');
	Route::post('/classes/{id}/students/add', 'Manage\StudentsController@postStudentAdd');
	Route::post('/classes/{id}/students/{student_id}/update', 'Manage\StudentsController@postStudentUpdate');
	Route::post('/classes/{id}/info', 'Manage\ClassController@postUpdate');
	Route::post('/classes/{id}/surveys/add', 'Manage\SurveyController@postAdd');
	Route::post('/classes/{id}/surveys/{survey_id}/complete', 'Manage\SurveyController@postComplete');
	Route::get('/students/{id?}', 'Manage\ManageController@getStudents');
	Route::post('/students/{id}/class/{class_id}', 'Manage\StudentsController@postAddToClass');
	Route::get('/surveys/{id?}', 'Manage\ManageController@getSurveys');
	Route::any('/surveys/{id}/report', 'Manage\SurveyController@getReport');
	Route::get('/surveys/{id}/chart.png', 'Manage\SurveyController@getChart');
	Route::post('/import', 'Manage\StudentsController@postImport');
	Route::post('/import/process', 'Manage\StudentsController@postImportProcess');
	Route::post('/import/complete', 'Manage\StudentsController@postImportComplete');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

	Route::get('/', 'Admin\Dashboard\DashboardController@getIndex');
	Route::controller('dashboard', 'Admin\Dashboard\DashboardController');
	Route::get('users/roles/{id?}', 'Admin\Users\RolesController@getIndex');
	Route::post('users/roles/update/{id}', 'Admin\Users\RolesController@postUpdate');
	Route::controller('users', 'Admin\Users\UsersController');

	Route::group(['prefix' => 's'], function() {
		Route::controller('boards', 'Admin\Schools\BoardsController');
		Route::controller('schools', 'Admin\Schools\SchoolsController');
		Route::controller('classes', 'Admin\Schools\ClassesController');
		Route::controller('surveys', 'Admin\Schools\SurveysController');
	});
});

Route::get('{key}', 'Front\SurveyController@getIndex');
Route::post('{key}/confirm', 'Front\SurveyController@postConfirm');
Route::post('{key}/add-info', 'Front\SurveyController@postAddInfo');
Route::post('{key}/save-post-question', 'Front\SurveyController@postSavePostQuestion');

require __DIR__ .'/functions.php';
require __DIR__ .'/macros.php';
require __DIR__ .'/../Libraries/Graph/Graph.php';