<?php
/**
 * Created by PhpStorm.
 * User: xieyi
 * Date: 15/5/8
 * Time: 上午1:55
 */

namespace App\Console\Commands\IMake;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use Illuminate\Filesystem\Filesystem;


class IMakeCommand extends GeneratorCommand {
    use AppNamespaceDetectorTrait;


	protected $name = 'imake:base';

    protected $description = 'Make Empty';

    protected $suffix = '';
    protected $directory = '';

    function __construct(Filesystem $files)
    {
        parent::__construct($files);
        $this->suffix = trim(str_replace('MakeCommand','',str_replace(__NAMESPACE__,'',get_class($this))),'\\');
        $this->type = $this->suffix;
    }

    public function fire()
	{
        if ($this->suffix!=='Migration' &&
            $this->suffix!=='Model' &&
            !ends_with($this->argument('name'),$this->suffix)
        ){
            $this->error($this->type.' name error');
            return false;
        }
        if ($this->option('delete'))
        {
            return $this->delete();
        }
		parent::fire();

        $name = $this->parseName($this->getNameInput());
        $this->info($this->getPath($name));
        $this->info("\n");

        $this->autoload();
	}
    public function delete()
    {
        $name = $this->parseName($this->getNameInput());
        $filename = $this->getPath($name);
        if ($this->files->exists($filename)){
            $this->files->delete($filename);
            $this->info($this->type.' delete successfully.');
            $this->info($this->getPath($name));
            return true;
        }else{
            $this->error($this->type.' file not exists.');
            $this->error($this->getPath($name));
            return false;
        }
    }
    public function autoload()
    {
        $process = new Process('', $this->laravel['path.base']);
        $process->setTimeout(null);
        $composer = 'composer';
        if (file_exists($this->laravel['path.base'].'/composer.phar'))
		{
			$composer = '"'.PHP_BINARY.'" composer.phar';
		}
        $extra = '';
		$process->setCommandLine(trim($composer.' dump-autoload '.$extra));
		$process->run();
    }
    protected function getStub()
    {
        return __DIR__.'/stubs/'.strtolower($this->suffix).'.stub';
    }

    protected function getPath($name)
	{
        $name = str_replace('/', '\\', $name);
        $name = str_replace($this->getAppNamespace(), '', $name);
        return parent::getPath($name);
	}
    protected function getNamespace($name)
	{
        $name = str_replace('/', '\\', $name);
        return parent::getNamespace($name);
	}
    protected function getDefaultNamespace($rootNamespace)
	{
        return $rootNamespace.'\\'.rtrim(str_replace('/', '\\', $this->directory),'\\');
	}

    protected function buildClass($name)
	{
        $name = str_replace('/', '\\', $name);

		$stub = $this->files->get($this->getStub());
        $stub = str_replace(
			'{{namespace}}', $this->getNamespace($name), $stub
		);
		$stub = str_replace(
			'{{rootNamespace}}', $this->getAppNamespace(), $stub
		);
        $class = implode('',array_slice(explode('\\', $name), -1));
		$stub = str_replace(
            '{{class}}', $class, $stub
        );
        $model = str_replace($this->suffix, '', $class);
		$stub = str_replace(
            '{{model}}', $model, $stub
        );
        $resource = str_singular(snake_case($model));
        $resources = str_plural($resource);
        $stub = str_replace(
            '{{resource}}', $resource, $stub
        );
        $stub = str_replace(
            '{{resources}}', $resources, $stub
        );
        return str_replace(
//            '{{app}}', config('app.name','App'), $stub
            '{{app}}', 'App', $stub
        );
	}

    protected function getOptions()
	{
		return [
			['delete', 'd', InputOption::VALUE_NONE, 'delete generator file', null],
		];
	}
}