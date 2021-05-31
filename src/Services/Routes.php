<?php 	

namespace PhHitachi\Routes\Services;

use Illuminate\Routing\Router;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;

Class Routes //extends RouteCollection
{
	use RouteDispatcher;

	/**
	* alias of 'as' in group methods
	*
	* @var string
	*/
	public $name;

	/**
	* set $prefix to the group
	*
	* @var string
	*/
	public $prefix;

	/**
	* defined as parameter key on resource
	*
	* @var string
	*/
	public $parameter;

	/**
	* defined middlewares on group 
	*
	* @var array
	*/
	public $middleware = [];

	/**
	* define if resource
	*
	* @var bool
	*/
	public $resource = true;

	/**
	* define route class as group
	*
	* @var bool
	*/
	public $group = true;

	/**
	* defined $domain for group routes
	*
	* @var array
	*/
	public $domain;

	/**
	* get all url of action
	*
	* @var bool
	*/
	protected $uri;

	/**
	* get single action
	*
	* @var bool
	*/
	protected $action;

	/**
	* set $except to disallowed on route
	*
	* @var array
	*/
	protected $except;

	/**
	* set $only to add only allowed action
	*
	* @var array
	*/
	protected $only;

	/**
	* get All defined actions
	*
	* @var array
	*/
	protected $actions = [];

	/**
	* defined methods
	*
	* @var array
	*/
	protected $methods = [];

	/**
	* defined $separator for names
	*
	* @var string
	*/
	protected $separator = '.';

	/**
	* defined $settings for configuration of the class
	*
	* @var string
	*/
	protected $settings;

	/**
	* All of the verbs supported by the router.
	*
	* @var array
	*/
	protected $verbs = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

	/**
	* define a group options from the route class
	*
	* @var array
	*/
	protected $options = [];

	/**
	* define a mapping from the route class
	*
	* @var array
	*/
	protected $mapping;

	/**
	* define a route
	*
	* @var Illuminate\Routing\Route
	*/
	protected $route;

	/**
	* define a default router
	*
	* @var Illuminate\Routing\Router
	*/
	protected $router;

	/**
	* add route to the collection
	*
	* @var Illuminate\Routing\RouteCollection
	*/
	protected $collection;

	/**
	* initials run
	*
	* @return void
	*/
	protected function init()
	{
		$this->settings = $this->settings();
		//set middlewares
		$this->middlewares = method_exists($this, 'middlewares') ? 
		$this->middlewares() : [];
		//define collection
		$this->collection = new RouteCollection;
		//set methods
		$this->setMethods();
		$this->setRouter();
	}

	/**
	* Get validated routes
	*
	* @return void
	*/
	protected function run()
	{	
		//run intials 
		$this->init();
		$this->createRoutes();
	}

	/**
	* Create new routes
	*
	* @return void
	*/
	protected function createRoutes()
	{
		if (method_exists($this, 'handle')) {
			return $this->handle(routes());
		}

		if (is_array($this->getAllMethods())) 
		{
			foreach ($this->getAllMethods() as $action => $methods) {
				$this->addRoutes($methods, $action);
			}
		}

		if (method_exists($this, 'collection')) {
			$this->collection($this->collection);
		}
	}

	/**
	* Add all routes
	*
	* @param  array|string  $method 
	* @param  string 		$action
	* @return void
	*/
	protected function addRoutes($method, $action)
	{
		$this->action = $action;
		$this->names = $this->getNames();
		$this->uri = $this->getUri(); 
		$this->controller = $this->getMapping() ?? $this->getController();

		if (!is_null($this->controller) && $this->uri) {
			$this->makeRoute($method);
		}
	}

	/**
	* Make new route
	*
	* @param  array|string $method
	* @return void
	*/
	protected function makeRoute($method)
	{
		if (!$this->validateAction()) {
			return;
		}

		if (isset($method)) {
			$route = $this->toRoute($method);
		}

		return $this->addRouteOptions($route);
	}

	/**
	* Validate Allowed actions
	*
	* @return bool
	*/
	protected function validateAction(): bool
	{
		if ($this->except) {
			return !in_array($this->action, $this->except);
		}

		if (is_array($this->getMethods())) {
			return in_array($this->action, $this->getMethods());
		}
	}

	/**
	* Filter actions
	*
	* @param  array $actions
	* @return array
	*/
	protected function filterAction($actions): array
	{
		if (is_array($actions[0])) {
			return array_unique($actions[0]);
		}

		return array_unique($actions);
	}

	/**
	* Add Route
	*
	* @param  string $method
	* @return Illuminate\Routing\Route
	*/
	protected function toRoute($method): Route
	{
		return $this->router->addRoute($method, $this->uri, $this->getAction());
	}

	/**
	* Add all Methods on action to Match methods
	*
	* @param  array $method
	* @return Illuminate\Routing\Route
	*/
	protected function toMatch($methods): Route
	{
		return $this->router->match($methods, $this->uri, $this->getAction());
	}

	/**
	* Add all options to route
	*
	* @return Illuminate\Routing\Route
	*/
	protected function addRouteOptions($route)
	{
		$this->route = $route;

		if (isset($this->middlewares[$this->action])) {
			$this->route->middleware($this->middlewares[$this->action]);
		}

		if (method_exists($this, 'row')) {
			$this->row($this->route);
		}

		if(isset($this->names[$this->action])){
			$this->name($this->names[$this->action]);
		}

		return $this->collection->add($this->route);
	}


	/**
	* Add name to specific actions
	*
	* @param Illuminate\Routing\Route $route
	* @return Illuminate\Routing\Route
	*/
	protected function name($name)
	{
		if(!$name){
			return;
		}

		if (isset($this->name) && $this->group) {
			return $this->route->name($this->getSeparator() . $name);
		}

		return $this->route->name($name);
	}

	/**
	* Run route class as group
	*
	* @return void
	*/
	public function toGroup(Router $route)
	{
		$route->group($this->addGroupRouteOptions(), function($route){
			$this->routes();
		});
	}

	/**
	* Add group options
	*
	* @return array
	*/
	protected function addGroupRouteOptions(): array
	{
		$this->options = [];

		if (isset($this->middleware)) {
			$this->options['middleware'] = $this->middleware;
		} 
		
		if(isset($this->name)){
			$this->options['as'] = $this->name;
		}

		if(isset($this->namespace)){
			$this->options['namespace'] = $this->namespace;
		}

		if(isset($this->prefix)){
			$this->options['prefix'] = $this->prefix;
		}

		return $this->options;
	}

	/**
	* Add domains to the group route
	*
	* @return void
	*/
	protected function domains()
	{
		Route::domains(
			$this->getDomainOptions(),
			function() {
			    $this->run();
			}
		);
	}

	/**
	* get all route options and merge with domain
	*
	* @return array
	*/
	protected function getDomainOptions(): array
	{
		return array_merge($this->addGroupRouteOptions(), [
			'domain' => $this->domain,
		]);
	}

	/**
	* Get Url to specific action
	*
	* @return string
	* @throws \Exception
	*/
	protected function getUri(): string
	{	
		$uri = $this->getAllUri();

		if(in_array($this->action, array_keys($uri))){
			return $uri[$this->action];
		}

		throw new \Exception("Error: the '{$this->action}' action doesn't have URL, Please check the map & methods function.");
	}

	/**
	* set methods for validation
	*
	* @return array
	* @throws \LogicException
	*/
	protected function setMethods(): array
	{
		$default = [];

		if (!empty($this->except) && !empty($this->only)) {
			throw new \LogicException('Error: you can\'t declare \'except\' and \'only\' method at the same time.');
		}

		if (!empty($this->getAllMethods())) {
			$default = array_keys($this->getAllMethods());
		}

		$this->methods = $this->only ?? $this->except ?? $default;

		return $this->methods;
	}

	/**
	* get contoller with action
	*
	* @return array
	*/
	protected function getAction()
	{
		if (method_exists($this, 'mapping') && !empty($this->mapping())) {
			$controller = $this->getMapping();
		}

		if (!isset($controller)) {
			$controller = [$this->controller, $this->action];
		}
		
		if (!str_contains($controller[0], "\\")) {
			return $this->parseAction($controller);
		}

		return $controller;
	}

	protected function parseAction($controller)
	{
		return implode('@',$controller);
	}
	/**
	* Get parameter
	*
	* @return string
	*/
	protected function getParameter(): String
	{
		return $this->parameter ? '{'. strtolower($this->parameter).'}' : '{id}';
	}

	/**
	* add route names
	*
	* @return array
	*/
	protected function getOriginalname()
	{
		return [
			$this->action => $this->action,
		];
	}

	/**
	* Get validated controller
	*
	* @return string
	*/
	protected function getController()
	{
		return $this->getDefaultController();
	}

	/**
	* Get mapping from the route class and return to each action
	*
	* @return array
	*/
	protected function getMapping()
	{
		if (method_exists($this, 'mapping')) 
		{
			$this->mapping = $this->mapping();

			foreach ($this->mapping as $controller => $actions) 
			{
				foreach ($actions as $action) 
				{
					if ($this->action == $action) {
						return ([$controller, $action]);
					}
				}
			}
		}
	}

	protected function setRouter()
	{
		$this->router = routes();
	}
}