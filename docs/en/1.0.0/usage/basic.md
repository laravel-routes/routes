# Basic Routing

---

- [Load All Routes](#load-all-routes)
- [Load Routes via class](#load-spesific-routes)
- [Load Route via Alias](#load-using-alias)
- [Generate](#generate-route-class)
- [View Route](#list)

## The Default Route Files
All Laravel routes are defined in your route files, which are located in the routes directory. These files are automatically loaded by your application's `App\Providers\RouteServiceProvider`. The `routes/web.php` file defines routes that are for your web interface. Learn more about [The Default Route Files](https://laravel.com/docs/8.x/routing#the-default-route-files)

This package are using [Facde](docs/en/1.0.0/usage/facade.md). using facade we can load our routes on the `routes/web.php`:

<a name="load-all-routes"></a>
## Load All Routes

using `Routes::all()` we can load all route classes inside the `/App/Routes` directory.

```php
//routes/web.php
Routes::all();
```
<a name="load-spesific-routes"></a>
## Load Routes via Full class

using `Routes::load(...classes)` we can load all given classes.
```php
//routes/web.php
Routes::load([
	App\Routes\Auth::class,
	....
]);
```
<a name="load-using-alias"></a>
## Load Route via Class Name

using `facade::routes()` we can load the class as routes. Learn more about [Alias](docs/en/1.0.0/usage/facade.md)

```php
//routes/web.php
Post::routes();
```

<a name="generate-route-class"></a>
## Generate Route Class

To generate route class you can run this command:

```bash
php artisan make:route Post --controller=PostController
```
This will automatically generate a route class on /App/Routes directory.

using `--controller` we can directly add the contoller to `defaultController()` with a default namespace of controller

```php
//app/routes/Post.php
<?php 

namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\PostController;

Class Post extends Routes
{
	/**
	* Create a new route instance.
	*
	* @return void
	*/
	public function __construct()
	{
		
	}

	/**
	* Define url in the value action
	*
	* @return array
	*/
	public function map(): array
	{
		return [
			
		];
	}

	/**
	* Define methods in the value of action
	*
	* @return array
	*/
	public function methods(): array
	{
		return [

		];
	}
	
	/**
	* Define the controller for all actions in this class
	* 
	* @return string
	*/
	public function defaultController()
	{
		return PostController::class;
	}
}

```


<a name="list"></a>
## Route List
<strong>Note:</strong> all generated route class is in a <b>resource mode</b> by default. learn more about [options]().

To check the route, you can run:
```bash
php artisan route:list
```

```text
+--------+-----------+-----------+---------+---------------------------------------------+------------+
| Domain | Method    | URI       | Name    | Action                                      | Middleware |
+--------+-----------+-----------+---------+---------------------------------------------+------------+
|        | GET|HEAD  | /         | index   | App\Http\Controllers\PostController@index   | web        |
|        | POST      | /         | store   | App\Http\Controllers\PostController@store   | web        |
|        | GET|HEAD  | create    | create  | App\Http\Controllers\PostController@create  | web        |
|        | GET|HEAD  | {id}      | show    | App\Http\Controllers\PostController@show    | web        |
|        | PUT|PATCH | {id}      | update  | App\Http\Controllers\PostController@update  | web        |
|        | DELETE    | {id}      | destroy | App\Http\Controllers\PostController@destroy | web        |
|        | GET|HEAD  | {id}/edit | edit    | App\Http\Controllers\PostController@edit    | web        |
+--------+-----------+-----------+---------+---------------------------------------------+------------+
```

This package are automatically add names even not resource.