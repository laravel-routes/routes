# Laravel Routes

- Introduction
    - [Overview](docs/en/1.0.0/overview.md)
    - [License](docs/en/1.0.0/license.md)
- Getting Started
    - [Installation](docs/en/1.0.0/installation.md)
- Routing
    - [Basic](docs/en/1.0.0/usage/basic.md)
    - [Resource](docs/en/1.0.0/usage/resource.md)
    - [Mapping](docs/en/1.0.0/usage/map.md)
    - [Names](docs/en/1.0.0/usage/names.md)
    - [Controller](docs/en/1.0.0/usage/controller.md)
    - [Middleware](docs/en/1.0.0/usage/middleware.md)
- Facade
    - [Alias](docs/en/1.0.0/usage/facade.md)
- Advanced
    - [Filter Routes](docs/en/1.0.0/advance/actions.md)
    - [Callbacks](docs/en/1.0.0/advance/callback.md)
- Options
    - [Command Options](docs/en/1.0.0/options.md)
- Other
    - [Support](docs/en/1.0.0/utilities/support.md)

# Overview

---

- [Introduction](#introduction)
- [Features](#features)

<a name="introduction"></a>
## Introduction

This Laravel package creates [Routes](https://laravel.com/docs/8.x/routing) and generating a route `classes based` and make your routes clean and easy to navigate to all controller class.

this package also can add [middleware](https://laravel.com/docs/8.x/middleware) in all actions even in a `resource mode`. also we can easily <b>disable/enable</b> routes by action without removing in the route classes using [Filtering routes](/docs/#/en/1.0.0/advance/actions) by `except` & `only`

<strong>Note:</strong> This package are `not` using `resource` from `Illuminate\Routing\Route`, This packge are using route  `mapping` from the route `classes`; however, This package providing you a `resource` mode with a same feature of the original [resource](https://laravel.com/docs/5.8/controllers#resource-controllers) methods by providing a default route inside the package to merge it in the route classes.

<strong>Note:</strong> This package are `not` using `resource` from `Illuminate\Routing\Route`, This packge are using route  `mapping` from the route `classes`; however, This package providing you a `resource` mode with a same feature of the original [resource](https://laravel.com/docs/5.8/controllers#resource-controllers) methods by providing a default route inside the package to merge it in the route classes. 

By default all route `classes` is working as `grouped`, sometimes we need to run a route individuality with diffirent prefixes and names prefixes and URI's but some point we want to put our route on other routes with a same places. 

Using Route classes we can put all our routes on the same places using class based.

<a name="requirements"></a>
## Requirements

- <strong>PHP >=7.2.34</strong>
- <strong>Laravel >=5.8.*</strong>

<a name="installation"></a>
## Installation

This package exclusive only to [Laravel](https://laravel.com/) to use this you can install this package via composer using:

```bash
composer require laravel-routes/routes
```

The `PhHitachi\Routes\ArtisanRoutesServiceProvider` is <strong>auto-discovered</strong> and registered by default.

If you want to register it yourself, add the <strong>ServiceProvider</strong> in `config/app.php`:

```php
'providers' => [
    /*
     * Package Service Providers...
     */
    PhHitachi\Routes\ArtisanRoutesServiceProvider::class,
]
```

The `Routes` facade is also <strong>auto-discovered</strong>.

If you want to add it manually, add the Facade in `config/app.php`:

```php
'aliases' => [
    ...
    'Routes' => PhHitachi\Routes\Facades\Router::class,
]
```

once [installation](docs/en/1.0.0/installation) done, you can now generate route class using the command:

```bash
php artisan make:route <name> [--] [options]
```

# Basic Routing

---

- [Load All Routes](#load-all-routes)
- [Load Routes via class](#load-spesific-routes)
- [Load Route via Alias](#load-using-alias)
- [Generate](#generate-route-class)
- [View Route](#list)

## The Default Route Files
All Laravel routes are defined in your route files, which are located in the routes directory. These files are automatically loaded by your application's `App\Providers\RouteServiceProvider`. The `routes/web.php` file defines routes that are for your web interface. Learn more about [The Default Route Files](https://laravel.com/docs/8.x/routing#the-default-route-files)

This package are using [Facde](docs/#/en/1.0.0/usage/facade.md). using facade we can load our routes on the `routes/web.php`:

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

using `facade::routes()` we can load the class as routes. Learn more about [Alias](docs/en/1.0.0/usage/facade)

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

<a name="features"></a>
## Features
- all route class can be use as `FacadeClass::routes()` using [command options](docs/#/en/1.0.0/options)
- Load spesific route class using `Routes::load(...classes)`
- Load all generated class using `Routes::all()`
- Disable/Enable actions
- Resource mode