<?php
namespace Omaicode\Repository\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Omaicode\Repository\Generators\ControllerGenerator;
use Omaicode\Repository\Generators\FileAlreadyExistsException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ControllerCommand
 * @package Omaicode\Repository\Generators\Commands
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class ControllerCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'ocms:repo:resource';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new RESTful controller.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * ControllerCommand constructor.
     */
    public function __construct()
    {
        $this->name = ((float) app()->version() >= 5.5  ? 'ocms:repo:rest-controller' : 'ocms:repo:resource');
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle(){
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {
            // Generate create request for controller
            $this->call('ocms:repo:request', [
                'name' => $this->argument('name') . 'CreateRequest',
                'module' => $this->argument('module')
            ]);

            // Generate update request for controller
            $this->call('ocms:repo:request', [
                'name' => $this->argument('name') . 'UpdateRequest',
                'module' => $this->argument('module')
            ]);

            (new ControllerGenerator([
                'name' => $this->argument('name'),
                'module' => $this->argument('module'),
                'force' => $this->option('force'),
            ]))->run();

            $this->info($this->type . ' created successfully.');

        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }
    }


    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of model for which the controller is being generated.',
                null
            ],
            [
                'module',
                InputArgument::REQUIRED,
                'The name of module.',
                null
            ],            
        ];
    }


    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null
            ],
        ];
    }
}
