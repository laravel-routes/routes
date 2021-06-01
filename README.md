<div align="center">
    <p>
        <img src="https://raw.githubusercontent.com/laravel-routes/routes/4cbc37417beb7470fee9edc45ffdd034171e5cb2/laravel-routes.svg"/>
    </p>
    <p>
        <a href="https://stars.medv.io/laravel-routes/routes">
            <img src="https://stars.medv.io/laravel-routes/routes.svg" alt="starts graph">
        </a>
    </p>
    <p>
        <a href="https://packagist.org/packages/laravel-routes/routes">
            <img src="https://img.shields.io/packagist/v/laravel-routes/routes" alt="Latest Stable Version">
        </a>
        <!---->
        <a href="https://packagist.org/packages/laravel-routes/routes">
            <img src="https://img.shields.io/packagist/dt/laravel-routes/routes" alt="Total Downloads">
        </a>
        <!---->
        <a href="https://packagist.org/packages/laravel-routes/routes">
            <img src="https://img.shields.io/badge/License-MIT-brightgreen.svg" alt="License">
        </a>
    </p>
</div>

# Laravel Routes

- Introduction
    - [Overview][overview]
    - [License][license]
- Getting Started
    - [Installation][installation]
- Routing
    - [Basic][basic]
    - [Resource][resource]
    - [Mapping][map]
    - [Names][names]
    - [Controller][controller]
    - [Middleware][middleware]
- Facade
    - [Alias][facade]
- Advanced
    - [Filter Routes][actions]
    - [Callbacks][callback]
    - [handle][handle]
- Options
    - [Command Options][options]
- Other
    - [Support][support]

<a name="introduction"></a>
## Introduction

This Laravel package creates [Routes](https://laravel.com/docs/8.x/routing) `classes based` and make your routes clean and easy to `navigate` to all route/controller classes.

this package also can add [middleware](https://laravel.com/docs/8.x/middleware) in all actions even in a `resource` mode. also we can easily <b>disable/enable</b> routes by `action` without `removing` in the route classes using [Filtering routes][actions] by `except` & `only`

<strong>Note:</strong> This package are `not` using `resource` from `Illuminate\Routing\Route`, This packge are using route  `mapping` from the route `classes`; however, This package providing you a `resource` mode with a same feature of the original [resource](https://laravel.com/docs/5.8/controllers#resource-controllers) methods by providing a default route inside the package to merge it in the route classes.

By default `all` route classes that use `mapping` is working as `grouped`, sometimes we need to run a routes with diffirent prefixes and names prefixes and URI's but some point we want to handle our route on other routes with a same places, this package provided a `handle` methods to handle your route in `one` class. 

<a name="requirements"></a>
## Requirements

- <strong>PHP >=7.2.34</strong>
- <strong>Laravel >=5.8.*</strong>


<a name="installation"></a>
## Installation

For the installation you can visit [documentation][documentation].

## Become a contributor
<strong>Contact</strong>: ph.hitachi@gmail.com

[documentation]: https://laravel-routes.herokuapp.com/
[overview]: https://laravel-routes.herokuapp.com/#/en/1.0.0/overview
[license]: https://laravel-routes.herokuapp.com/#/en/1.0.0/license
[installation]: https://laravel-routes.herokuapp.com/#/en/1.0.0/installation
[basic]: https://laravel-routes.herokuapp.com/#/en/1.0.0/usage/basic
[map]: https://laravel-routes.herokuapp.com/#/en/1.0.0/usage/map
[names]: https://laravel-routes.herokuapp.com/#/en/1.0.0/usage/names
[controller]: https://laravel-routes.herokuapp.com/#/en/1.0.0/usage/controller
[middleware]: https://laravel-routes.herokuapp.com/#/en/1.0.0/usage/middleware
[facade]: https://laravel-routes.herokuapp.com/#/en/1.0.0/usage/facade
[actions]: https://laravel-routes.herokuapp.com/#/en/1.0.0/advance/actions
[callback]: https://laravel-routes.herokuapp.com/#/en/1.0.0/advance/callback
[handle]: https://laravel-routes.herokuapp.com/#/en/1.0.0/advance/handle
[options]: https://laravel-routes.herokuapp.com/#/en/1.0.0/options
[support]: https://laravel-routes.herokuapp.com/#/en/1.0.0/support