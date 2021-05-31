<<<<<<< HEAD
=======
# Laravel Routes
----

- Introduction
    - [Overview](docs/en/1.0.0/overview)
    - [License](docs/en/1.0.0/license)
- Getting Started
    - [Installation](docs/en/1.0.0/installation)
- Routing
    - [Basic](docs/en/1.0.0/usage/basic)
    - [Resource](docs/en/1.0.0/usage/resource)
    - [Mapping](docs/en/1.0.0/usage/map)
    - [Names](docs/en/1.0.0/usage/names)
    - [Controller](docs/en/1.0.0/usage/controller)
    - [Middleware](docs/en/1.0.0/usage/middleware)
- Facade
    - [Alias](docs/en/1.0.0/usage/facade)
- Advanced
    - [Filter Routes](docs/en/1.0.0/advance/actions)
    - [Callbacks](docs/en/1.0.0/advance/callback)
- Options
    - [Command Options](docs/en/1.0.0/options)
- Other
    - [Support](docs/en/1.0.0/utilities/support)

>>>>>>> a90cbd986089b16dd683cb98391e21110128ea82
# Overview

---

- [Introduction](#introduction)
- [Features](#features)

<a name="introduction"></a>
## Introduction

This Laravel package creates [Routes](https://laravel.com/docs/8.x/routing) and generating a route `classes based` and make your routes clean and easy to navigate to all controller class.

this package also can add [middleware](https://laravel.com/docs/8.x/middleware) in all actions even in a `resource mode`. also we can easily <b>disable/enable</b> routes by action without removing in the route classes using [Filtering routes](/docs/#/en/1.0.0/advance/actions) by `except` & `only`

<<<<<<< HEAD
<strong>Note:</strong> This package are `not` using `resource` from `Illuminate\Routing\Route`, This packge are using route  `mapping` from the route `classes`; however, This package providing you a `resource` mode with a same feature of the original [resource](https://laravel.com/docs/5.8/controllers#resource-controllers) methods by providing a default route inside the package to merge it in the route classes.
=======
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


once [installation](docs/#/en/1.0.0/installation) done, you can now generate route class using the command:

```bash
php artisan make:route <name> [--] [options]
```
```php

```
<a name="features"></a>
## Features
- all route class can be use as `FacadeClass::routes()` using [command options](docs/#/en/1.0.0/options)
- Load spesific route class using `Routes::load(...classes)`
- Load all generated class using `Routes::all()`
- Disable/Enable actions
- Resource mode
>>>>>>> a90cbd986089b16dd683cb98391e21110128ea82
