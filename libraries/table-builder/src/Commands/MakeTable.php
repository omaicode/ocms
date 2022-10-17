<?php

namespace Omaicode\TableBuilder\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeTable extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'ocms:make-table';

    /**
     * Type of the generator
     * 
     * @var string
     */
    protected $type = 'Table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create table builder class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/table-builder.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    } 

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\Tables";
    }    

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        if($this->argument('module')) {
            $module = Str::title($this->argument('module'));

            return "Modules\\".$module;
        }

        return "App";
    }    

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['module', InputArgument::OPTIONAL, 'The name of the module', null]
        ];
    }    

    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The namespace of the model'],
        ];
    }    

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        if($this->argument('module')) {
            $module = Str::title($this->argument('module'));

            $path = "modules/".$module.str_replace('\\', '/', $name).'.php';
            return $path;
        }

        return app_path(str_replace('\\', '/', $name).'.php');
    }     

    public function replaceModel(&$stub)
    {
        $model = $this->option('model');

        if(blank($model)) {
            $model = '\App\Models\ExampleClass';
        }

        $stub = str_replace('ModelNamepsace', "{$model}::class", $stub);
        return $this;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        return $this->replaceNamespace($stub, $name)->replaceModel($stub)->replaceClass($stub, $name);
    }    
}
