# Overview

---

- [Introduction](#introduction)
- [Features](#features)

<a name="introduction"></a>
## Introduction

This Laravel package creates [Routes](https://laravel.com/docs/8.x/routing) and generating a route `classes based` and make your routes clean and easy to navigate to all controller class.

this package also can add [middleware](https://laravel.com/docs/8.x/middleware) in all actions even in a `resource mode`. also we can easily <b>disable/enable</b> routes by action without removing in the route classes using [Filtering routes](/docs/#/en/1.0.0/advance/actions) by `except` & `only`

<strong>Note:</strong> This package are `not` using `resource` from `Illuminate\Routing\Route`, This packge are using route  `mapping` from the route `classes`; however, This package providing you a `resource` mode with a same feature of the original [resource](https://laravel.com/docs/5.8/controllers#resource-controllers) methods by providing a default route inside the package to merge it in the route classes.