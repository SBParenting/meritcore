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
		$children = \Child::where('user_id',\Auth::id())->get();
        foreach ($children as $child) {
            $campaign_survey = \CampaignStudent::where('student_id',$child->id)->first();
            if (isset($campaign_survey)) {
                $survey[$child->id] = $campaign_survey->status;
            }
        }

        return \View::make('front.children.select_child')->with('children',$children)->with('survey',$survey);
	}

	public function getAdd() {
		return \View::make('front.children.add_child');
	}

	public function postAdd() {
		$child = new \Child;

        $input = \Input::all();
        $image = \Input::file('image');

        if (isset($image)) {
            $extension = $image->getClientOriginalExtension();
            $filename = str_random(32).'.'.$extension;

            $image->move('uploads/children/',$filename);

            $img = \ImageTool::make(public_path('uploads/children/'.$filename));

            $img->fit(350);
            $img->save('uploads/children/squared-'.$filename);

            $input['avatar'] = $filename;
        }

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

    public function postUpdate($id) {
		$child = \Child::find($id);

        $input = \Input::all();
        $image = \Input::file('image');

        if (isset($image)) {
            $extension = $image->getClientOriginalExtension();
            $filename = str_random(32).'.'.$extension;

            if(!empty($child->avatar)) {
                $filename = explode('.',$child->avatar)[0].'.'.$extension;
            }

            $image->move('uploads/children/',$filename);

            $img = \ImageTool::make(public_path('uploads/children/'.$filename));

            $img->fit(350);
            $img->save('uploads/children/squared-'.$filename);

            $input['avatar'] = $filename;
        }


		$val = $child->validator()->with($input)->action('create');

		if (!$val->passes()) {
			return $val->toJsonResponse();
		} else {
			$child->fill($val->data());
			$child->update();

            return \Response::json(['result' => true, 'msg' => 'Child successfully saved!', 'url' => url('/children/select')]);
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_added')]);
	}

    public function view($id) {
        $child = \Child::find($id);

        return \View::make('front.children.add_child')->with('model',$child);
    }

}