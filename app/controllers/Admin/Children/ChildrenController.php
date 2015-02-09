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
		$children = \Children::all();

		return \View::make('admin.children.children')->with('children',$children);
	}

	public function uploadImage()
	{
		$input = \Input::file('file');

		$extension = $input->getClientOriginalExtension();

		$filename = str_random(32).'.'.$extension;

		$input->move('uploads/children/',$filename);

		return 'uploads/children/'.$filename;
	}

	public function getAdd() {
		return \View::make('front.children.add_child');
	}

	public function postAdd() {
		return json_encode(\Input::all());
	}

}