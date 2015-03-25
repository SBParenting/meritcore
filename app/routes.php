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

Route::get ('parents/base', function(){

	return View::make('front.parents.base');

});

Route::get ('parents/reflect_tour', function(){

	return View::make('front.parents.reflect_tour');

});

Route::get ('strengths/information', function(){

	return View::make('front.strengths.information');

});

Route::get ('parents/parent_feedback', function(){

	return View::make('front.parents.parent_feedback');

});

Route::get ('parents/child_feedback', function(){

	return View::make('front.parents.child_feedback');

});

Route::get ('parents/step_back', function(){

	return View::make('front.parents.step_back');

});

Route::get ('parents/pg_tour', function(){

	return View::make('front.parents.pg_tour');

});



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

    Route::get('survey/finish/{student_id?}/{survey_id?}', 'Controllers\Front\SurveyController@finishSurvey');
    Route::get('survey/{student_id?}', 'Controllers\Front\SurveyController@selectSurvey');
    Route::post('survey/save', 'Controllers\Front\SurveyController@saveQuestion');
    Route::get('survey/child/{student_id?}', 'Controllers\Front\SurveyController@getIndex');
    Route::get('survey/parent/{student_id?}', 'Controllers\Front\SurveyController@getIndexParentFocus');

    Route::get('strengths/selection/{student_id?}', 'Controllers\Front\StrengthsController@getSelection');
    Route::get('strengths/calculate/{student_id?}','Controllers\Front\StrengthsController@calculate');

    Route::get('parents/reflect/{student_id?}/{question_id?}', ['as' => 'parents.reflect' , 'uses' => 'Controllers\Admin\Parents\ParentsController@getIndex']);
    Route::post('parents/reflect/{strength_score_id?}/{question_id?}', 'Controllers\Admin\Parents\ParentsController@postIndex');

    Route::get('parents/build/picked/{strength_score_id?}/{explore_question_id}/{build_option_id}', 'Controllers\Admin\Parents\ParentsController@buildPick');
    Route::get('parents/build/pick/{strength_score_id?}/{explore_question_id}', 'Controllers\Admin\Parents\ParentsController@build');

    Route::get('parents/explore/picked/{strength_score_id?}/{explore_question_id}', 'Controllers\Admin\Parents\ParentsController@picked');
    Route::get('parents/explore/pick/{strength_score_id?}', 'Controllers\Admin\Parents\ParentsController@pick');

    Route::get('parents/explore/{strength_score_id?}', ['as' => 'parents.explore', 'uses' => 'Controllers\Admin\Parents\ParentsController@getExplore']);
    Route::post('parents/explore/setRating', 'Controllers\Admin\Parents\ParentsController@setRating');
    Route::get('parents/explore/completeExplore/{strength_score_id?}', 'Controllers\Admin\Parents\ParentsController@completeExplore');

    Route::get('parents/empower/{strength_score_id?}', 'Controllers\Admin\Parents\ParentsController@getEmpower');
    Route::get('parents/empower/feedback/{strength_score_id?}', 'Controllers\Admin\Parents\ParentsController@empowerFeedback');
    Route::get('parents/empower/stepback/{strength_score_id?}', 'Controllers\Admin\Parents\ParentsController@empowerStepback');
    Route::get('parents/empower/verify/{empower_child_id?}', 'Controllers\Admin\Parents\ParentsController@calculateFeedback');
    Route::get('parents/empower/{strength_score_id?}/{feedback_person?}', 'Controllers\Admin\Parents\ParentsController@getEmpower');
    Route::post('parents/empower/save', 'Controllers\Admin\Parents\ParentsController@saveEmpower');
    Route::post('parents/empower/saveFeedback', 'Controllers\Admin\Parents\ParentsController@saveFeedback');

    Route::get('journey/{child_id}','Controllers\Admin\Parents\ParentsController@journey');
    Route::get('journey/{child_id}/{strength_id?}','Controllers\Admin\Parents\ParentsController@getJourneyStrength');
});

Route::get('/article/{slug?}', 'Controllers\Front\HomeController@getPost');
Route::get('/articles', 'Controllers\Front\HomeController@getPosts');

require __DIR__ .'/functions.php';


require __DIR__ .'/composers.php';
