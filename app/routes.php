<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('password', 'Controllers\Auth\RemindersController');
Route::get('remind', 'Controllers\Auth\RemindersController@getRemind');
Route::post('remind', 'Controllers\Auth\RemindersController@postRemind');
Route::get('login', 'Controllers\Auth\AuthController@getLogin');
Route::post('login', 'Controllers\Auth\AuthController@postLogin');
Route::get('logout', 'Controllers\Auth\AuthController@getLogout');
Route::post('lock', 'Controllers\Auth\AuthController@postLock');
Route::post('unlock', 'Controllers\Auth\AuthController@postUnlock');
Route::get('register', 'Controllers\Auth\RegisterController@getIndex');
Route::post('register', 'Controllers\Auth\RegisterController@postIndex');
Route::get('verify/{code}', 'Controllers\Auth\RegisterController@getVerify');

Route::group(['prefix' => 'admin', 'before' => 'auth'], function() {

	Route::controller('dashboard', 'Controllers\Admin\Dashboard\DashboardController');
	Route::get('users/roles/{id?}', 'Controllers\Admin\Users\RolesController@getIndex');
	Route::post('users/roles/update/{id}', 'Controllers\Admin\Users\RolesController@postUpdate');
	Route::controller('users', 'Controllers\Admin\Users\UsersController');
	Route::get('children' , 'Controllers\Admin\Children\ChildrenController@getIndex');
	Route::group(['prefix' => 'content'], function() {
		Route::controller('pages', 'Controllers\Admin\Content\PagesController');
		Route::controller('posts', 'Controllers\Admin\Content\PostsController');
		Route::controller('images', 'Controllers\Admin\Content\ImagesController');
		Route::controller('files', 'Controllers\Admin\Content\FilesController');
		
	});
});

Route::group(['before' => 'auth'],function(){
    Route::get('/','Controllers\Admin\Children\ChildrenController@getIndex');
    Route::get('children/select','Controllers\Admin\Children\ChildrenController@getIndex');
    Route::get('children/add','Controllers\Admin\Children\ChildrenController@getAdd');
    Route::post('children/add','Controllers\Admin\Children\ChildrenController@postAdd');
    Route::get('children/{id}','Controllers\Admin\Children\ChildrenController@view');
    Route::post('children/{id}','Controllers\Admin\Children\ChildrenController@postUpdate');
    Route::get('survey/{student_id?}', 'Controllers\Front\SurveyController@selectSurvey');
    Route::post('survey/save', 'Controllers\Front\SurveyController@saveQuestion');
    Route::get('survey/child/{student_id?}', 'Controllers\Front\SurveyController@getIndex');
    Route::get('survey/parent/{student_id?}', 'Controllers\Front\SurveyController@getIndexParentFocus');
    Route::get('survey/finish/{student_id?}/{survey_id?}', 'Controllers\Front\SurveyController@finishSurvey');
});

Route::get('/article/{slug?}', 'Controllers\Front\HomeController@getPost');
Route::get('/articles', 'Controllers\Front\HomeController@getPosts');
Route::get('/{slug?}', 'Controllers\Front\HomeController@getIndex');

require __DIR__ .'/functions.php';

require __DIR__ .'/composers.php';