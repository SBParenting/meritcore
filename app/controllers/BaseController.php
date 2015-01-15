<?php

class BaseController extends Controller {

	/**
	 * Check if the controller may be accessed by the current user.
	 *
	 * @return void
	 */
	protected function access($id)
	{
		if (!Access::can($id))
		{
			App::abort(403);
		}

		\View::share(['locked' => Access::isLocked()]);	
	}

	protected function sorting($sorting)
	{
		\View::share(['sorting' => $sorting]);
	}

}
