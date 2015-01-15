<?php namespace Libraries\Generator;

use Illuminate\Console\Command;

class Generator {

	protected $cli;
	
	protected $entity;

	protected $data;
	
	/**
	 * Inject the Command instance
	 *
	 * @param Illuminate\Console\Command $cli
	 * @param string $entity
	 */
	public function __construct(Command $cli, $entity)
	{
		$this->cli = $cli;

		$this->entity = $entity; 
	}

	public function start()
	{
		$this->data = $this->loadData();

		if (empty($this->data))
		{
			$this->cli->error("Could not find a definition file for the specified entity."); exit;
		}

		Generation::where('entity', '=', $this->entity)->delete();

		$namespace = $this->getData('NAMESPACE');

		$resource = $this->getData('RESOURCE');

		$baseurl = $this->getData('BASEURL');

		$model = $this->getData('MODEL');

		$table = $this->getData('TABLE');

		$view_path = str_replace('.', '/', $this->getData('ADMIN_VIEWPATH'));

		if (!is_dir(app_path().'/controllers/Admin/'.$namespace))
		{
			mkdir(app_path().'/controllers/Admin/'.$namespace, 0755, true);
		}

		$this->generate('admin/controller', app_path().'/controllers/Admin/'.$namespace.'/'.$resource.'Controller.php');

		$this->generate('model', app_path().'/models/'.$model.'.php');

		$this->generate('migration', app_path().'/database/migrations/'. date('Y_m_d_His'). '_create_'.$table.'_table.php');

		$this->generate('validator', app_path().'/services/validators/'.$model.'Validator.php');

		if (!is_dir(app_path().'/views/'.$view_path))
		{
			mkdir(app_path().'/views/'.$view_path, 0755, true);
		}

		$this->generate('admin/views/form', app_path().'/views/'.$view_path.'/form.blade.php');

		$this->generate('admin/views/list', app_path().'/views/'.$view_path.'/list.blade.php');

		\Artisan::call('dump-autoload');

		$this->cli->info('Generated autoload files');

		\Artisan::call('migrate');

		$this->cli->info('Migrated tables.');

		$this->cli->comment("Add to routes.php: Route::controller('".$baseurl."', 'Controllers\Admin\\".$namespace."\\".$resource."Controller');");		
	}

	public function loadData()
	{
		$file = app_path().'/generators/'.$this->entity.'.php';

		if (file_exists($file))
		{
			return include $file;
		}
	}

	public function getData($key)
	{
		return $this->data[$key];
	}

	public function compile($template, $data)
	{
		foreach($data as $key => $value)
		{
			$template = preg_replace("/\\$\\$$key/i", $value, $template);
		}

		return $template;
	}

	public function generate($template, $path)
	{
		$file = \File::get(app_path().'/templates/'.$template.'.txt');

		$file = $this->compile($file, $this->data);

		file_put_contents($path, $file);

		Generation::create(['path' => $path, 'entity' => $this->entity]);

		$this->cli->info("Generated file: $path");
	}

	public function rollback()
	{
		\Artisan::call('migrate:rollback');

		$this->cli->info('Rolled back migration.');
		
		$records = Generation::where('entity', '=', $this->entity)->get();

		foreach ($records as $record)
		{
			if (file_exists($record->path))
			{
				\File::delete($record->path);

				$this->cli->info("Deleted file: " . $record->path);
			}

			$record->delete();
		}

		\Artisan::call('dump-autoload');

		$this->cli->info('Generated autoload files');
	}
	

}