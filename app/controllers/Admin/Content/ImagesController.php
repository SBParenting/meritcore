<?php

namespace Controllers\Admin\Content;

use Image as Record;

class ImagesController extends \BaseController {

	protected $view_path = 'admin.content.images';

	protected $base_url = '/admin/content/images';

	public function __construct()
	{
		$this->access('content:manage_images');
		
		\View::share(['nav_level1' => 'content', 'nav_level2' => 'content.images']);
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
				$filename = $file->getClientOriginalName();

				$extension = $file->getClientOriginalExtension();

				$title = str_replace(".$extension", "", $filename);

				$file->move(app_path()."/../public/uploads/images", $filename);

				$thumbnail = $title."_thumb.".$extension;

				$image = \ImageTool::make(app_path()."/../public/uploads/images/$filename");

				$image->fit(200, 200)->save(app_path()."/../public/uploads/images/$thumbnail");

				Record::create([
					'title'     => $title,
					'path'      => "public/uploads/images/$filename",
					'thumbnail' => "public/uploads/images/$thumbnail",
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
				$data = $val->data();

				$record->fill($data)->save();

				if (\Input::hasFile('file'))
				{
					$file = \Input::file('file');

					if (\File::exists(app_path().'/../'.$record->path))
					{
						\File::delete(app_path().'/../'.$record->path);
					}

					if (\File::exists(app_path().'/../'.$record->thumbnail))
					{
						\File::delete(app_path().'/../'.$record->thumbnail);
					}

					$filename = $record->createFilename();

					$extension = $record->extension;

					$file->move(app_path()."/../public/uploads/images", $filename.".".$extension);

					$thumbnail = $filename."_thumb.".$extension;

					$image = \ImageTool::make(app_path()."/../public/uploads/images/$filename.$extension");

					$image->fit(200, 200)->save(app_path()."/../public/uploads/images/$thumbnail");

					$data['path'] = "public/uploads/images/$filename.$extension";
					$data['thumbnail'] = "public/uploads/images/$filename"."_thumb.$extension";
				}

				$record->fill($data)->save();

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
						if (\File::exists(app_path().'/../'.$record->thumbnail))
						{
							\File::delete(app_path().'/../'.$record->thumbnail);
						}

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
				if (\File::exists(app_path().'/../'.$record->thumbnail))
				{
					\File::delete(app_path().'/../'.$record->thumbnail);
				}

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