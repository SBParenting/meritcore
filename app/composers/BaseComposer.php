<?php namespace Composers;

class BaseComposer {

	public function compose($view)
	{
		$query = \Request::all();

		if (empty($query['sort']) && !empty($view->sorting))
		{
			$query['sort'] = $view->sorting->sort;
			$query['order'] = $view->sorting->order;
		}

		$view->with('query', $query);
	}

}