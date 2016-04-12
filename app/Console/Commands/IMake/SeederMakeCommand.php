<?php namespace App\Console\Commands\IMake;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Process;

class SeederMakeCommand extends IMakeCommand {

    protected $name = 'imake:seeder {name} {--db=mysql} {--delete}';

    protected $description = 'Make Seeder';

	protected function buildClass($name)
	{
        $stub = parent::buildClass($name);
        $table = str_replace($this->getNamespace($name).'\\', '', $name);
        $table = str_replace($this->suffix, '', $table);
        if (config('database.table_plural',false)){
            $table = snake_case(str_plural(class_basename($table)));
        }else{
            $table = snake_case(class_basename($table));
        }
        return str_replace(
            '{{table}}', $table, $stub
        );
	}
	protected function getPath($name)
	{
		$name = str_replace($this->getAppNamespace(), '', $name);
//        $name = $name.'.'.$this->option('db');
		return $this->laravel['path.base'].'/database/seeds/'.str_replace('\\', '/', $name).'.php';
	}
    protected function getDefaultNamespace($rootNamespace)
	{
        return $rootNamespace;
	}
	protected function getStub()
	{
	    return __DIR__.'/stubs/'.strtolower($this->suffix).'.'.$this->option('db').'.stub';
	}
    protected function getOptions()
	{
		return [
            ['db', null, InputOption::VALUE_OPTIONAL, 'assign db type', 'mysql'],
			['delete', 'd', InputOption::VALUE_NONE, 'delete generator file', null],
		];
	}

}
