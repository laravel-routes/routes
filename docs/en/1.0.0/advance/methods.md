# Collection

---

- [Introduction](#default-controller)
- [Regular Expression](#regular-expression-constraints)
- [Adding Prefix](#adding-Prefix-via-collection)

<a name="default-controller"></a>
## Introduction

The `collection` is a `callback` for `each` routes in the route class, using `collection()` we can add some logic on `every` routes in the collection.


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
	public function collection(Route $route)
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

use Illuminate\Routing\Route;
use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\Auth\{
	LoginController,
	RegisterController,
	ForgotPasswordController,
	ResetPasswordController,
	VerificationController,
};

Class Auth extends Routes
{
	public $resource = false;

	public function collection(Route $route)
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

if you want to add prefix in url you can use `prefix` from the `$route` parameter.

```php
public function collection(Route $route)
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
