<?php namespace Controllers\Front;

class LoginController extends \BaseController
{

    public function getIndex()
    {

        return \View::make('front.auth.login');
    }
}