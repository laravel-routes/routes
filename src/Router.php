<?php 

namespace PhHitachi\Routes;

use Illuminate\Routing\Router as Route;
use PhHitachi\Routes\Services\ClassMapGenerator;

Class Router extends ClassMapGenerator
{
	/**
	* Load all routes via class
	*
	* @param  array $classes
	* @return void
	*/
	public function load(...$classes)
	{
		foreach ($classes as $key => $routes) 
		{
			$this->getValidatorInstance($routes);
		}
	}

    /**
    * Load all routes
    *
    * @return void
    */
	public function all()
	{
        $this->load($this->getAllClass());
	}

    /**
    * Get all classes inside /App/Routes directory
    *
    * @return array
    */
    public function getAllClass()
    {
        $routes = $this->createMap(route_path());
        return array_keys($routes);
    }

	/**
	* Convert class name to new instance
	*
	* @param string $class
	* @return mixed
	*/
	protected function getInstance($class)
	{
		return tap(new $class, function ($instance) {
            return $instance;
        });
	}

	/**
	* Get all Instance
	*
	* @param  array $classes
	* @return mixed
	*/
	protected function getInstances($classes): array
	{
		foreach ($classes as $class) {
			$instance[] = $this->getInstance($class);
		}

		return $instance;
	}

	/**
	* Get validated  
	*
	* @param  string $routes
	* @return void
	*/
	protected function getValidatorInstance($routes)
	{
		$instances = $this->getInstances($routes);
		
		foreach ($instances as $instance) 
		{
			$this->handle($instance);
		}
	}

	/**
	* handle instances
	*
	* @param  mixed $instance 
	* @return Illuminate\Routing\Route
	*/
	public function handle($instance)
	{
		if ($instance->group) {
			return $instance->toGroup(routes());
		}

		return $instance->routes();
	}
}