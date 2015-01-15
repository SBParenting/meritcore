<?php namespace Services\Tasks;

use Libraries\Access\Access;

class PermissionsTask
{
	public function run()
	{
		$access = \App::make('access');

		if ($access->updateAdministrator())
		{
			return \Response::json(['result' => true, 'msg' => 'Successfully generated permissions!']);
		}

		return \Response::json(['result' => false, 'msg' => 'Failed to generate permissions.']);
	}
}