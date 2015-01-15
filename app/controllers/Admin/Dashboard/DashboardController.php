<?php

namespace Controllers\Admin\Dashboard;

class DashboardController extends \BaseController {

	public function __construct()
	{	
		$this->access('*');

		\View::share(['nav_level1' => 'dashboard']);
	}

	public function getIndex()
	{
		return \View::make('admin.dashboard.dashboard');
	}


}