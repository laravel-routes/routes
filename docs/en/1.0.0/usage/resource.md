# Resource

---

- [Prefix](#route-prefixes)
- [Name](#route-name-prefixes)
- [Separator](#route-name-separator)
- [Parameters Naming](#route-name-parameters)
- [Disabled grouping](#disabled-grouping)
- [Disabled Resourcing](#disabled-resourcing)


## Route Prefixes

The `prefix` method may be used to prefix each route in the route class with a given class. For example, you may want to prefix all route URIs within the route class with admin:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{

	public $prefix = 'admin';
	....
```

All `URI` in the route class will be added a prefix of `admin`

```list
+--------+-----------+-----------------+---------+---------------------------------------------+------------+
| Domain | Method    | URI             | Name    | Action                                      | Middleware |
+--------+-----------+-----------------+---------+---------------------------------------------+------------+
|        | GET|HEAD  | admin           | index   | App\Http\Controllers\UserController@index   | web        |
|        | POST      | admin           | store   | App\Http\Controllers\UserController@store   | web        |
|        | GET|HEAD  | admin/create    | create  | App\Http\Controllers\UserController@create  | web        |
|        | GET|HEAD  | admin/{id}      | show    | App\Http\Controllers\UserController@show    | web        |
|        | PUT|PATCH | admin/{id}      | update  | App\Http\Controllers\UserController@update  | web        |
|        | DELETE    | admin/{id}      | destroy | App\Http\Controllers\UserController@destroy | web        |
|        | GET|HEAD  | admin/{id}/edit | edit    | App\Http\Controllers\UserController@edit    | web        |
+--------+-----------+-----------------+---------+---------------------------------------------+------------+
```

<a name="route-name-prefixes"></a>
## Route Name Prefixes

The `name` method may be used to prefix each route name in the group with a given string. For example, you may want to prefix all of the class route's names with `admin`.  Learn more about [Naming](#/docs/#/en/1.0.0/usage/names)

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{

	public $name = 'admin';
	....
```

All names in the route class will added names with `separator` of `'.'`
```list
+--------+-----------+-----------------+---------------+---------------------------------------------+------------+
| Domain | Method    | URI             | Name          | Action                                      | Middleware |
+--------+-----------+-----------------+---------------+---------------------------------------------+------------+
|        | GET|HEAD  | admin           | admin.index   | App\Http\Controllers\UserController@index   | web        |
|        | POST      | admin           | admin.store   | App\Http\Controllers\UserController@store   | web        |
|        | GET|HEAD  | admin/create    | admin.create  | App\Http\Controllers\UserController@create  | web        |
|        | GET|HEAD  | admin/{id}      | admin.show    | App\Http\Controllers\UserController@show    | web        |
|        | PUT|PATCH | admin/{id}      | admin.update  | App\Http\Controllers\UserController@update  | web        |
|        | DELETE    | admin/{id}      | admin.destroy | App\Http\Controllers\UserController@destroy | web        |
|        | GET|HEAD  | admin/{id}/edit | admin.edit    | App\Http\Controllers\UserController@edit    | web        |
+--------+-----------+-----------------+---------------+---------------------------------------------+------------+
```
<a name="route-name-separator"></a>
## Route Name Prefixes Separator

The given string for prefixed to the route name will seprated by dot(`.`) character between the prefix and original name in the prefix automatically, if you want to change the prefix separator with "`/`" you can declared `settings()` method on the route class:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{
	...

	public function settings()
	{
		return [
			'separator' => '/',
		];
	}
	...
```

<a name="route-name-parameters"></a>
## Naming Resource Route Parameters

By default, resource mode will create the route parameters for your resource routes based on the "singularized" version of the resource name. You can easily override this on a per class basis by using the `$parameter` method. 

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{
	...

	public $parameter = 'admin';
	...
```

<a name="group-options"></a>
## Disabled grouping

to disabled grouping of route you can use `group` methods:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{

    public $group = false;
    ....
```

once you set the group to false, you can no longer use other options such as (name,prefix, etc..)



<a name="disabled-resourcing"></a>
## Disabled Resourcing

to disabled grouping of route you can use `group` methods:

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{

    public $group = false;
    ....
```

once you set the group to false, you can no longer use other options such as (name,prefix, etc..)





