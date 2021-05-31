# Callback

---

- [Row](#row)
- [Regular Expression](#regular-expression-constraints)
- [Adding Prefix](#adding-Prefix-via-collection)
- [Collection](#collection)

<a name="row"></a>
## Row
The `row` methods is instance of `Illuminate\Routing\Route` which is a callback for `each` routes.

```php

namespace App\Routes;

...
use Illuminate\Routing\Route;

Class User extends Routes
{
	public function row(Route $route)
	{
		# code...
		...
	}
```

<a name="regular-expression-constraints"></a>
## Regular Expression Constraints
if you want to add a [Regular Expression Constraints](https://laravel.com/docs/8.x/routing#parameters-regular-expression-constraints) You may constrain the format of your route parameters using the `where` method on a route `instance`. The where method accepts the name of the parameter and a regular `expression` defining how the parameter should be constrained:


```php

namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Route;

Class User extends Routes
{
	public function row(Route $route)
	{
		if($route->getActionName() === 'show'){
			$route->where('id', '[0-9]+');
		}
		...
	}
```

<a name="adding-Prefix-via-collection"></a>
## Adding Prefix via collection

Some point when we use a controller mapping on the route class and we disabled a `group mode` we no longer availble to set a prefix using `$prefix` however, using `addPrefixName` we can add a `prefix` name on our routes. The `addPrefixName` methods is a built in function of the package:

```php
namespace App\Routes;

...
use Illuminate\Routing\Route;

Class Auth extends Routes
{
	public $resource = false;

	public function row(Route $route)
	{
		if (in_array($route->getActionName(), $this->getLogin())) {
			$this->addPrefixName('password');
		}
	}

	public function getLogin(): array
	{
		return [
			'showLinkRequestForm', 
			'sendResetLinkEmail',
			'showResetForm', 
			'reset'
		];
	}

	public function names()
	{
		return [
			...
			
			//resetPassword
			'showLinkRequestForm' => 'request',
			'sendResetLinkEmail' => 'email',
			'showResetForm' => 'reset',
			'reset' => 'update',
			...
		];
	}
	...
```
This a method `list` built in from the package that you can call on the route class by itself

| Method 							| Description 										|
| ----------------------------------| ------------------------------------------------- |
| `routes()`						| run all routes from tha route class |
| `only(...$actions)`				| set allowed methods |
| `except(...$actions)`				| set disabled actions |
| `hasName()`						| Check the route if has name. |
| `addPrefixName($name)`			| Add prefix name in non group mode. |
| `getOptions()`					| Get all set options in the group mode. |
| `defaultActions()`				| get default resource actions. |
| `defaultUri()`					| get default resource uri's |
| `getAllUri()`						| Get all uri's from `map` & `defaultUri` |
| `getMethods()`					| get all merged methods from `except`,`only` & `default` |
| `defaultMethods()`				| get default resource methods |
| `getAllMethods()`					| get merged methods from `map` & `defaultUri` |
| `getNames()`						| get merged methods from `names` & `orginalName` |
| `getDefaultController()`			| get `defaultController` from the route class |
| `getSeparator()`					| get seperator from `settings` |
| `settings()`						| set default configuration |


if you want to add `prefix` in url you can use `prefix()` from the `Illuminate\Routing\Route $route` parameter.

```php
public function row(Route $route)
{
	if (in_array($route->getActionName(), $this->getLogin())) {
			$route->prefix('/password');
	}
}
```

<a name="regular-expression-constraints"></a>
## List of available methods

The `collection` have a parameter `$route` which is instance of `Illuminate\Routing\Route` you can check all available methods [here](https://laravel.com/api/8.x/Illuminate/Routing/Route.html) 

Take note this `methods` is from `Laravel 5.8` to view your current version you can go official laravel [api](https://laravel.com/api/5.8/index.html) documentation

<strong>Note:</strong> Only `public` methods you can get to parameter `$route`

| Method 										| Description 										|
| --------------------------------------------- | ------------------------------------------------- |
| [getController()][1]							| Get the controller instance for the route. |
| [where($name, $expression)][2]				| Set a regular expression requirement on the route. |
| [fallback()][3]								| Mark this route as a fallback route. |
| [methods()][4]								| Get the HTTP verbs the route responds to. |
| [httpOnly()][5]								| Determine if the route only responds to HTTP requests. |
| [httpsOnly()][6]								| Determine if the route only responds to HTTPS requests. |
| [secure()][7]									| Determine if the route only responds to HTTPS requests. |
| [domain($domain)][8]							| Get or set the domain for the route. |
| [getDomain()][9]								| Get the domain defined for the route. |
| [getPrefix()][10]								| Get the prefix of the route instance. |
| [prefix($prefix)][11]							| Add a prefix to the route URI. |
| [uri()][12]									| Get the URI associated with the route. |
| [setUri($uri)][13]							| Set the URI that the route responds to. |
| [getName()][14]								| Get the name of the route instance. |
| [name($name)][15]								| Add or change the route name.|
| [named(...$patterns)][16]						| Determine whether the route's name matches the given patterns.|
| [uses($action)][17]							| Set the handler for the route. |
| [getActionName()][18]							| Get the action name for the route. |
| [getActionMethod()][19]						| Get the method name of the route action. |
| [getAction($key)][20]							| Get the action array or one of its properties for the route. |
| [setAction(array $action)][21]				| Set the action array for the route. |
| [gatherMiddleware()][22]						| Get all middleware, including the ones from the controller. |
| [middleware($middleware)][23]					| Get or set the middlewares attached to the route. |
| [controllerMiddleware()][24]					| Get the middleware for the route's controller. |
| [controllerDispatcher()][25]					| Get the dispatcher for the route's controller. |



<a name="collection"></a>
## collection

The `collection` is a method that returing to instance of `Illuminate\Routing\RouteCollection`, This method is a `callback` for `all` routes in the route class after all routes are loaded.

```php

namespace App\Routes;

...
use Illuminate\Routing\RouteCollection;

Class User extends Routes
{
	public function collection(RouteCollection $routes)
	{
		foreach ($routes as $route) {
			# code...
		}
		...
	}
```

in the `RouteCollection` you can return a single route by using `getByName()` the getByName is a built in function in from `Illuminate\Routing\RouteCollection` to check the available methods you can go [here](https://laravel.com/api/8.x/Illuminate/Routing/RouteCollection.html).




[1]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getController
[2]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_where
[3]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_fallback
[4]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_methods
[5]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_httpOnly
[6]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_httpsOnly
[7]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_secure
[8]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_domain
[9]:  https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getDomain
[10]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getPrefix

[11]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_prefix
[12]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_uri
[13]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_setUri
[14]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getName
[15]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_name
[16]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_named
[17]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_uses
[18]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getActionName
[19]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getActionMethod
[20]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getAction

[21]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_setAction
[22]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_gatherMiddleware
[23]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_middleware
[24]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_controllerMiddleware
[25]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_controllerDispatcher
[26]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_getCompiled
[27]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_setRouter
[28]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_setContainer
[29]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_matches
[30]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_bind

[31]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_hasParameters
[32]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_hasParameter
[33]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_parameter
[34]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_originalParameter
[35]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_setParameter
[36]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_forgetParameter
[37]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_parameters
[38]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_originalParameters
[39]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_parametersWithoutNulls
[40]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_parameterNames

[41]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_signatureParameters
[42]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_defaults
[43]: https://laravel.com/api/5.8/Illuminate/Routing/Route.html#method_prepareForSerialization
