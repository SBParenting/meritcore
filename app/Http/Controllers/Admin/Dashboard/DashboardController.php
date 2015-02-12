<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class DashboardController extends AdminController {

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