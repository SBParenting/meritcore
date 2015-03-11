<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use \App\Models\Permission;

class Permissions extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'auth:permissions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Export all authentication permissions to the database.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$ids = [];

		foreach (\Config::get('permissions.permissions') as $key => $value) {
			
			$record = Permission::where('name', '=', $key)->first();

			if (empty($record))
			{
				$record = new Permission;
				$record->name = $key;
			}

			$record->display_name = $value['title'];
			$record->description = $value['description'];
			$record->save();

			$this->info("Saved permission: $key");

			$ids[] = $record->id;
		}

		if (!empty($ids))
		{
			Permission::whereNotIn('id', $ids)->delete();
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
