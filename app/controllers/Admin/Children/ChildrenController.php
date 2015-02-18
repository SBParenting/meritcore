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
		$children = \Child::all();

        return \View::make('front.children.select_child')->with('children',$children);
	}

	public function uploadImage()
	{
		$input = \Input::file('file');

		$extension = $input->getClientOriginalExtension();

		$filename = str_random(32).'.'.$extension;

		$input->move('uploads/children/',$filename);


        $img = \ImageTool::make('uploads/children/'.$filename);

        $img->crop(350,350);

        $img->save('uploads/children/squared-'.$filename);

		return \Response::json(['result'=>true,'msg'=>$filename]);
	}

	public function getAdd() {
		return \View::make('front.children.add_child');
	}

	public function postAdd() {
		$child = new \Child;

		$val = $child->validator()->with(\Input::all())->action('create');

		if (!$val->passes()) {
			return $val->toJsonResponse();
		} else {
			$child->fill($val->data());
			$child->save();

            return \Response::json(['result' => true, 'msg' => 'Child successfully saved!', 'url' => url('/children/select')]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_added')]);
	}

}