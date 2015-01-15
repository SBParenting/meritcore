<?php

namespace Controllers\Admin\Content;

use ContentFile as Record;

class FilesController extends \BaseController {

	protected $view_path = 'admin.content.files';

	protected $base_url = '/admin/content/files';

	public function __construct()
	{
		parent::__construct();
		
		$this->access('content:manage_files');
		
		\View::share(['nav_level1' => 'content', 'nav_level2' => 'content.files']);
	}

	public function getIndex()
	{
		$list = Record::getListable()->paginate( \Config::get('site.per_page') );

		$this->sorting( Record::$sorting );

		return \View::make("$this->view_path.list")->with('records', $list);
	}

	public function getAdd()
	{
		return \View::make("$this->view_path.form");
	}

	public function getUpdate($id)
	{
		$record = Record::findOrFail($id);

		\Form::data($record->toArray());

		return \View::make("$this->view_path.update")->with('record', $record);
	}

	public function postAdd()
	{
		$files = \Input::file('file');

		if (count($files) > 0)
		{
			foreach ($files as $file)
			{
				$extension = $file->getClientOriginalExtension();

				$filename = str_random(10).'.'.$extension;

				$title = str_replace(".$extension", "", $file->getClientOriginalName());

				$file->move(app_path()."/../public/uploads/files", $filename);

				Record::create([
					'title'     => $title,
					'path'      => "public/uploads/files/$filename",
					'extension' => $extension,
				]);
			}			

			return \Response::json(['result' => true, 'msg' => trans('crud.success_added'), 'url' => url($this->base_url) ], 200);		
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_added')], 400);
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
				$record->fill($val->data());

				if (\Input::hasFile('file'))
				{
					$file = \Input::file('file');

					$extension = $file->getClientOriginalExtension();

					$filename = str_random(10).'.'.$extension;

					$file->move(app_path()."/../public/uploads/files", $filename);

					if (\File::exists(app_path().'/../'.$record->path))
					{
						\File::delete(app_path().'/../'.$record->path);
					}

					$record->path = "public/uploads/files/$filename";

					$record->extension = $extension;
				}

				$record->save();

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

	public function postRemove($id)
	{
		if ($id=='bulk' && \Input::get('ids'))
		{
			$count = 0;

			$ids = array_values( \Input::get('ids') );

			if (!empty($ids))
			{
				foreach ($ids as $id)
				{
					$record = Record::find($id);

					if ($record)	
					{
						if (\File::exists(app_path().'/../'.$record->path))
						{
							\File::delete(app_path().'/../'.$record->path);
						}
						
						$record->delete();

						$count++;
					}
				}

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed_bulk', ['count' => $count]), 'url' => url($this->base_url) ]);		
			}
		}
		else
		{
			$record = Record::find($id);

			if ($record)
			{
				if (\File::exists(app_path().'/../'.$record->path))
				{
					\File::delete(app_path().'/../'.$record->path);
				}

				$record->delete();

				return \Response::json(['result' => true, 'msg' => trans('crud.success_removed'), 'url' => url($this->base_url)]);		
			}
		}

		return \Response::json(['result' => false, 'msg' => trans('crud.failed_removed')]);
	}
}