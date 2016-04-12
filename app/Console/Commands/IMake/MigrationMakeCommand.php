<?php namespace App\Console\Commands\IMake;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Process;

class MigrationMakeCommand extends IMakeCommand {

	protected $name = 'imake:migration {name} {time}';

    protected $description = 'Make Migration';

    public static $DATA_FORMAT = 'Y_m_d_His';
	protected function getPath($name)
	{
        $date = date(static::$DATA_FORMAT);
		$name = str_replace($this->getAppNamespace(), '', $name);
        $name = $date.'_create_'.snake_case($name).'_table';
		return base_path('database/migrations/').str_replace('\\', '/', $name).'.php';
	}

    public function delete()
    {
        $name = $this->parseName($this->getNameInput());
        $time = $this->argument('time');
        if (empty($time)){
            $this->error($this->type.' time not assign.');
            return false;
        }
        $date = date(static::$DATA_FORMAT,strtotime($time));
        $filename = $this->getPath($name);
        $filename = preg_replace('/\d{4}_\d{2}_\d{2}_\d{6}/',$date,$filename);
        if ($this->files->exists($filename)){
            $this->files->delete($filename);
            $this->info($this->type.' delete successfully.');
            $this->info($filename);
            return true;
        }else{
            $this->error($this->type.' file not exists.');
            $this->error($filename);
            return false;
        }
    }

    protected function getDefaultNamespace($rootNamespace)
	{
        return $rootNamespace;
	}
	protected function getStub()
	{
	    return __DIR__.'/stubs/'.strtolower($this->suffix).'.stub';
	}
    protected function getArguments()
	{
		return [
			['name', InputArgument::REQUIRED, 'The name of the class'],
            ['time', InputArgument::OPTIONAL, 'The time of the migration',null],
		];
	}

}
