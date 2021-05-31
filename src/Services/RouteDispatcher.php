<?php
namespace PhHitachi\Routes\Services;

use PhHitachi\Routes\Router;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;

Trait RouteDispatcher
{
	/**
	* run all routes from tha route class
	*
	* @return void
	*/
	public function routes()
	{
		return $this->run();
	}

	/**
	* Set disallowed actions
	*
	* @param  array $actions
	* @return void
	*/
	protected function except(...$actions)
    {
        $this->except = $this->filterAction($actions);
    }

    /**
	* Set only allowed actions
	*
	* @param  array $actions
	* @return void
	*/
    protected function only(...$actions)
    {
		$this->only = $this->filterAction($actions);
    }

	/**
	* Check the route if has name
	*
	* @return bool
	*/
	public function hasName(): bool
	{
		return !is_null($this->route->getName());
	}

	/**
	* add prefix name's to route
	*
	* @return Illuminate\Routing\Route
	*/
	public function addPrefixName($name)
	{
		if(!$this->hasName() && isset($name)){
			return $this->route->name($name); 
		}

		return $this->route->name($this->getSeparator().$name);
	}
	/**
	* Get all set options in the group mode
	*
	* @return array
	*/
	public function getOptions(): array
	{
		return $this->options ?? [];
	}

	/**
	* get default resource action
	*
	* @return array
	*/
	public function defaultActions(): array
	{
		return ['index', 'store', 'create', 'show', 'update', 'destroy', 'edit'];
	}

	/**
	* get default resource uri's
	*
	* @return array
	*/
	public function defaultUri(): array
	{
		if ($this->resource) {
			return [
				'index' => '/',
				'create' => '/create',
				'store' => '/',
				'show' => $this->getParameter(),
				'update' => $this->getParameter(),
				'destroy' => $this->getParameter(),
				'edit' => "{$this->getParameter()}/edit",
			];
		}

		return [];
	}

	/**
	* get all URI's
	*
	* @return array
	*/
	public function getAllUri(): array
	{
		if (method_exists($this, 'map')) {
		 	return array_merge($this->defaultUri(), $this->map());
		}

		return $this->defaultUri();
	}

	/**
	* get all merge methods from except,only & default
	*
	* @return array
	*/
	public function getMethods(): array
	{
		return $this->methods;
	}

	/**
	* get default resource methods
	*
	* @return array
	*/
	public function defaultMethods()
	{
		if ($this->resource) {
			return [
				'index' => 'GET',
				'create' => 'GET',
				'store' => 'POST',
				'show' => 'GET',
				'update' => ['PUT', 'PATCH'],
				'destroy' => 'DELETE',
				'edit' => 'GET',
			];
		}

		return [];
	}
	
	/**
	* get merged methods from map & defaultUri
	*
	* @return string
	*/
	public function getAllMethods()
	{
		if (method_exists($this, 'methods')) {
			return array_merge($this->defaultMethods(), $this->methods());
		}

		return $this->defaultMethods();
	}

	/**
	* Get all names
	*
	* @return string
	*/
	public function getNames()
	{
		if (method_exists($this, 'names')) {
			return array_merge($this->getOriginalname(), $this->names());
		}

		return $this->getOriginalname();
	}

	/**
	* Get default controller
	*
	* @return string
	*/
	public function getDefaultController()
	{
		if (method_exists($this, 'defaultController')) {
			return $this->defaultController();
		}
	}

	/**
	* Get Separator
	*
	* @return string
	*/
	public function getSeparator()
	{	
		return $this->settings['separator'];
	}

	/**
	* set default configuration
	*
	* @return array
	*/
	public function settings()
	{
		return [
			'separator' => $this->separator,
		];
	}
}