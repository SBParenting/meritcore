<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller {

	protected function access($id)
	{
		if (\Auth::user()->ability(['admin'], [$id]))
		{
			App::abort(403);
		}

		\View::share(['locked' => false]);
	}

	protected function sorting($sorting)
	{
		\View::share(['sorting' => $sorting]);
	}

}