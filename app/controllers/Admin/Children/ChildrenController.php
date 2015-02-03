<?php

namespace Controllers\Admin\Children;

class ChildrenController extends \BaseController {

	protected $view_path = 'children.children';

	protected $base_url = '/admin/children';

	public function __construct()
	{
		$this->access('system:manage_users');
		
		\View::share(['nav_level1' => 'children', 'nav_level2' => 'children.list']);
	}

	public function getIndex()
	{
		return \View::make('admin.children.children');
	}

}


