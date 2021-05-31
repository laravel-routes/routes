# Route Middleware

---

- [Group Middleware](#group-middleware)
- [Assigning Middleware](#assigning-middleware)
- [Custom Middleware](#custom-middleware)

<a name="group-middleware"></a>
## Group Middleware

To assign [middleware](https://laravel.com/docs/8.x/middleware) to all routes within a route class, you may use the `$middleware` method. Middleware are executed in the order they are listed in the array:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{

	public $middleware = ['first', 'second'];
	....
```

<a name="assigning-middleware"></a>
## Assigning Middleware To Routes

If you would like to assign `middleware` to specific routes, you should first assign the middleware a key in your application's `app/Http/Kernel.php` file. By default, the `$routeMiddleware` property of this class contains entries for the middleware included with Laravel. You may add your own middleware to this list and assign it a key of your choosing:

```php
// Within App\Http\Kernel class...

protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
];
```

Once the `middleware` has been defined in the HTTP kernel, you may use the middleware method to assign middleware to a route using `middleware()`:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{

	public function middleware()
	{
		return [
			'profile' => 'auth',
			...
		];
	}
	....
```

You may assign multiple `middleware` to the action by passing an array of middleware names to the `middlewares()` method:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\Auth\VerificationController;

Class Auth extends Routes
{
	...
	public function middlewares()
	{
		return [
			'verify' => ['auth', 'signed', 'throttle:6,1'],
			...
		];
	}
	...
```

<a name="custom-middleware"></a>
## Custom Middleware

To create a new middleware, use the `make:middleware` Artisan command:

```bash
php artisan make:middleware CheckAge
```

This command will place a new `CheckAge` class within your `app/Http/Middleware` directory. In this middleware, we will only allow access to the route if the supplied `age` is greater than `200`. Otherwise, we will redirect the users back to the home URI:

```php
<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if ($request->age <= 200) {
            return redirect('home');
        }

        return $next($request);
    }
}

```

As you can see, if the given `age` is less than or equal to `200`, the middleware will return an HTTP redirect to the client; otherwise, the request will be passed further into the application. To pass the request deeper into the application (allowing the middleware to "pass"), call the `$next` callback with the `$request`.

It's best to envision middleware as a series of "layers" HTTP requests must pass through before they hit your application. Each layer can examine the request and even reject it entirely.

When assigning middleware, you may also pass the fully qualified class name:

```php

use App\Http\Middleware\CheckAge;

public function middlewares()
{
	return [
		'view' => ['auth', CheckAge::class,],
			...
	];
}
```