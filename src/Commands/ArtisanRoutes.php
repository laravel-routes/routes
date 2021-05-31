<?php

namespace PhHitachi\Routes\Commands;

//use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ArtisanRoutes extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new route class';

    /**
     * The default namespace
     *
     * @var string
     */
    protected $namespace;

    /**
     * The default controller
     *
     * @var string
     */
    protected $controller;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Routes';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        if ($this->option('facade')) {
            $this->call("route:facade", $this->getCommandOptions());
        }

        $this->callSilent('route:clear');
    }

    /**
     * get command options
     *
     * @return array
     */
    public function getCommandOptions()
    {
        $options = [];

        $options['name'] = $this->getClassName();
        $options['--aliases'] = $this->getAlias();
        $options['--route'] = $this->getClassName();

        if ($this->option('force')) {
            $options['--force'] = true;
        }

        return $options;
    }

    /**
     * get alias name
     *
     * @return string
     */
    public function getAlias()
    {
        if ($this->option('aliases')) {
            return $this->option('aliases');
        }

        return $this->getClassName();
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $class = parent::buildClass($name);

        if ($this->option('controller') && !$this->option('resource')) {
            $class = str_replace('ControllerFullNameSpace', $this->ControllerNameSpace(), $class);
            $class = str_replace('DummyController', $this->getController(), $class);
        }

        if ($this->option('resource') && $this->option('resource')) {
            $class = str_replace('ControllerFullNameSpace', $this->ControllerNameSpace(), $class);
            $class = str_replace('DummyController', $this->getController(), $class);
            $class = str_replace('DummyName', $this->getOriginalName(), $class);
        }

        if ($this->option('resource')) {
            $class = str_replace('DummyName', $this->getOriginalName(), $class);
        }

        return $class;
    }

    /**
     * get original name
     *
     * @return string
     */
    protected function getOriginalName()
    {
        return strtolower($this->getClassName());
    }

    /**
     * get default controller
     *
     * @return string
     */
    protected function getController()
    {
        return  $this->controller ?? $this->option('controller');
    }

    /**
     * repalce the dummy string in stub to Controller NameSpace
     *
     * @return string
     */
    public function ControllerNameSpace()
    {
        if ($this->getClassName() == $this->option('controller')) 
        {
            $this->controller = "{$this->option('controller')}Controller";
            return "App\Http\Controllers\\{$this->option('controller')} as {$this->controller}";
        }

        return "App\Http\Controllers\\{$this->getController()}";
    }

    /**
     * Get class name
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->argument('name');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('controller') && !$this->option('resource')) {
            return __DIR__.'/stubs/routes.controller.stub';
        }

        if ($this->option('controller') && $this->option('resource')) {
            return __DIR__.'/stubs/routes.resource.controller.stub';
        }

        if ($this->option('resource')) {
            return __DIR__.'/stubs/routes.resource.stub';
        }

        return __DIR__.'/stubs/routes.default.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->getValadeatedNamespace($rootNamespace);
    }

    /**
     * Get the route class namespace.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    public function getValadeatedNamespace($rootNamespace)
    {
        return $this->namespace = "{$rootNamespace}\\$this->type";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the route class even if the class already exists'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Create new route class with resource mode'],

            ['controller', 'c', InputOption::VALUE_REQUIRED, 'add controller to the route class'],

            ['facade', 'F', InputOption::VALUE_NONE, 'Create a new facade for route class'],

            ['aliases', 'a', InputOption::VALUE_OPTIONAL, 'Customize name on aliases & facade'],
        ];
    }
}
