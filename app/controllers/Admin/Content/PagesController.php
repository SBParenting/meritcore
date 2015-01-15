<?php

namespace Controllers\Admin\Content;

use Page as Record;

class PagesController extends \BaseController {

	protected $view_path = 'admin.content.pages';

	protected $base_url = '/admin/content/pages';

	public function __construct()
	{
		$this->access('content:manage_pages');
		
		\View::share(['nav_level1' => 'content', 'nav_level2' => 'content.pages']);
	}

	public function getIndex()
	{
		$published = \Input::get('published');

		$list = Record::getListable(['published' => $published])->paginate( \Config::get('site.per_page') );

		$this->sorting( Record::$sorting );

		return \View::make("$this->view_path.list")->with('records', $list)->with('published', $published);
	}

	public function getAdd()
	{
		return \View::make("$this->view_path.form");
	}

	public function getUpdate($id)
	{
		$record = Record::findOrFail($id);

		\Form::data($record->toArray());

		return \View::make("$this->view_path.form")->with('record', $record);
	}

	public function postAdd()
	{
		$record = new Record;

		$val = $record->validator()->with(\Input::all())->action('create');

		if (!$val->passes())
		{
			return $val->toJsonResponse();
		}
		else 
		{
			$record->fill($val->data())->save();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url) ]);		
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_added')]);
	}

	public function postUpdate($id)
	{
		$record = Record::findOrFail($id);

		if ($record)
		{
			$input = \Input::all();

			$input['id'] = $id;

			$val = $record->validator()->with( $input )->action('update');

			if (!$val->passes())
			{
				return $val->toJsonResponse();
			}
			else 
			{
				$record->fill($val->data())->save();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url($this->base_url) ]);		
			}
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}

	public function postBulk()
	{
		$count = 0;

		$failed = 0;

		$ids = array_values( \Input::get('ids') );

		if (!empty($ids))
		{
			foreach ($ids as $id)
			{
				$record = Record::find($id);

				if ($record)
				{
					$input = $record->input(\Input::all());

					$record->fill($input)->save();

					$count++;
				}
				else 
				{
					$failed++;
				}
			}

			if ($count > 0)	
			{
				return \Response::json(['result' => true, 'msg' => trans('crud.success_updated_bulk', ['count' => $count]), 'url' => url($this->base_url) ]);
			}
			else 
			{
				return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated_bulk', ['count' => $failed]) ]);	
			}
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}

	public function postPublish($id)
	{
		$record = Record::findOrFail($id);

		if ($record)
		{
			$record->fill(['published' => '1'])->save();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url($this->base_url) ]);		
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}

	public function postUnpublish($id)
	{
		$record = Record::findOrFail($id);

		if ($record)
		{
			$record->fill(['published' => '0'])->save();

			return \Response::json(['result' => true, 'msg' => trans('crud.success_updated'), 'url' => url($this->base_url) ]);		
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_updated')]);
	}

	public function postRemove($id)
	{
		if ($id=='bulk' && \Input::get('ids'))
		{
			$ids = array_values( \Input::get('ids') );

			if (!empty($ids))
			{
				$count = Record::whereIn('id', $ids)->where('deletable', '=', '1')->delete();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed_bulk', ['count' => $count]), 'url' => url($this->base_url) ]);		
			}
		}
		else
		{
			$record = Record::find($id);

			if ($record && $record->deletable)
			{
				$record->delete();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed')]);		
			}
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_removed')]);
	}
}