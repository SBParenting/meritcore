<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller {

	protected function access($id)
	{
		if (!\Auth::user()->ability(['admin'], [$id]))
		{
			App::abort(403);
		}

		\View::share(['locked' => false]);
	}

	protected function sorting($sorting, $base_url=false)
	{
		if ($base_url === false)
		{
			$base_url = $this->base_url;
		}

		\State::page($base_url)->set($sorting)->view();
	}

}