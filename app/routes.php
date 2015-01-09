<?php

Route::get('/',function() {
    return View::make('hello');
});

Route::get('login',function() {
    return View::make('login');
});
Route::get('register',function() {
    return View::make('register');
});

Route::get('childSelection',function() {
    return View::make('childSelection');
});
Route::get('addChild',function() {
    return View::make('addChild');
});

Route::get('recoverPassword',function() {
    return View::make('recoverPassword');
});
