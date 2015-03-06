<?php namespace Controllers\Admin\Parents;

class ParentsController extends \BaseController {


    public function getIndex($child_id) {
        $child = \Child::find($child_id);

        return \View::make('front.parents.reflect')->with(compact('child'));
    }
}