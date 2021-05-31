# Overview

---

- [Introduction](#introduction)
- [Features](#features)

<a name="introduction"></a>
## Introduction

This Laravel package creates [Routes](https://laravel.com/docs/8.x/routing) and generating a route `classes based` and make your routes clean and easy to navigate to all controller class.

this package also can add [middleware](https://laravel.com/docs/8.x/middleware) in all actions even in a `resource mode`. also we can easily <b>disable/enable</b> routes by action without removing in the route classes using [Filtering routes](/docs/#/en/1.0.0/advance/actions) by `except` & `only`

<strong>Note:</strong> This package are `not` using `resource` from `Illuminate\Routing\Route`, This packge are using route  `mapping` from the route `classes`; however, This package providing you a `resource` mode with a same feature of the original [resource](https://laravel.com/docs/5.8/controllers#resource-controllers) methods by providing a default route inside the package to merge it in the route classes.

<div class="card long-shadow">
	<div class="card-body d-flex p-45">
		<div class="card-icon bg-primary text-white">
			<i class="far fas fa-comment"></i>
		</div>
		<div>
			<p class="lh-sm">
				This package are <code>not</code> using <code>resource</code> from <code>Illuminate\Routing\Route</code>, This packge are using route  <code>mapping</code> from the route <code>classes</code>; however, This package providing you a <code>resource</code> mode with a same feature of the original <a href="https://laravel.com/docs/5.8/controllers#resource-controllers">resource</a> methods by providing a default route inside the package to merge it in the route classes.
			</p>
		</div>
	</div>
</div>

By default all route `classes` is working as `grouped`, sometimes we need to run a route individuality with diffirent prefixes and names prefixes and URI's but some point we want to put our route on other routes with a same places. 

Using Route classes we can put all our routes on the same places using class based.

once [installation](http://localhost/docs-master/#/en/1.0.0/starter/third-party-libraries) done, you can now generate route class using the command:

```bash
php artisan make:route <name> [--] [options]
```

<a name="features"></a>
## Features
- all route class can be use as `FacadeClass::routes()` using [command options](docs/#/en/1.0.0/options)
- Load spesific route class using `Routes::load(...classes)`
- Load all generated class using `Routes::all()`
- Disable/Enable actions
- Resource mode