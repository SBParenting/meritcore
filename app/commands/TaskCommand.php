<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TaskCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'task:run';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run any defined task from the cli.';

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
		$task = $this->argument('task');

		$class = "Services\\Tasks\\" . ucwords($task) . "Task";

		$task_obj = new $class;
		$result   = $task_obj->run();
		$data     = $result->getData();
		
		if ($data->result)
		{
			$this->info($data->msg);
		}
		else 
		{
			$this->error($data->msg);
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('task', InputArgument::REQUIRED, 'Name of the task to run.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			
		);
	}

}
