# Route Controller

---

- [Default Controller](#default-controller)
- [Route Controllers](#controller-mapping)
- [Create Auth Routes](#create-auth-route)

<a name="default-controller"></a>
## Default Controller

To add the single controller on the route class you can put inside the `defaultController()` 

using command we can add directly on the route class automatically upon generating using [command options](/docs/#/en/1.0.0/options)

```php
	/**
	* Define the controller for all actions in this class
	* 
	* @return string
	*/
	public function defaultController()
	{
		return UserController::class;
	}
```

<a name="method-mapping"></a>
## Supplementing Route Controllers

Sometimes we need to add route with diffirent controller but we need to put on the same place like `auth::routes()` thats why this package provide you a same things using `mapping()` we can add multiple controller in one route class

```php
	/**
	* Define all actions on the spesific controller
	*
	* @return array
	*/
	public function mapping()
	{
		return [
			LoginController::class => ['showLoginForm', 'login', 'logout'],
			RegisterController::class => ['showRegistrationForm', 'register'],
			ForgotPasswordController::class => ['showLinkRequestForm', 'sendResetLinkEmail'],
			ResetPasswordController::class => ['showResetForm', 'reset'],
			VerificationController::class => ['show', 'verify', 'resend'],
		];
	}
```

To keep the `resource` mode you can add the controller in the `mapping()` and declare the `defaultActions()` methods to get the `default` resource actions and add to the resource `contoller` class name `without` adding the `actions` in `map` methods.

```php
	/**
	* Define all actions on the spesific controller
	*
	* @return array
	*/
	public function mapping()
	{
		return [
			YourResourceController::class => $this->defaultActions(),
			...
		];
	}
```

<a name="create-auth-route"></a>
## Create Auth Routes

To create a routes we have options to register the facade in our `config/app.php` in `aliases`, using `--facade` we generate a facade in the `App/Routes/Facade` directory, and using `--aliases=*` we automatically register the facade on `config/app.php` with aliases. Learn more about [Facade](/docs/#/en/1.0.0/usage/facade).


```php

<?php 

namespace App\Routes;

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
	/**
	* Create a new route instance.
	*
	* @return void
	*/
	public function __construct()
	{

	}
	
	/**
	* Define url in the value of action
	*
	* @return array
	*/
	public function map()
	{
		return [
			//Login
			'showLoginForm' => '/login',
			'login' => '/login',
			'logout' => '/logout',

			//Register
			'showRegistrationForm' => '/register',
			'register' => '/register',

			//Forgot Password
			'showLinkRequestForm' => '/password/reset',
			'sendResetLinkEmail' => '/password/email',

			//Reset Password
			'showResetForm' => '/password/reset/{token}',
			'reset' => '/password/reset',

			//Email Verification
			'show' => '/email/verify',
			'verify' => '/email/verify/{id}',
			'resend' => '/email/resend',

		];
	}

	public function names()
	{
		return [
			'showLoginForm' => 'login',
			'login' => '',
			'logout' => 'logout',

			//Register
			'showRegistrationForm' => 'register',
			'register' => '',
			
			//resetPassword
			'showLinkRequestForm' => 'password.request',
			'sendResetLinkEmail' => 'password.email',
			'showResetForm' => 'password.reset',
			'reset' => 'password.update',

			//Email Verification
			'show' => 'verification.notice',
			'verify' => 'verification.verify',
			'resend' => 'verification.resend',
		];
	}

	/**
	* Define methods in the value action
	*
	* @return array
	*/
	public function methods()
	{
		return [
			'showLoginForm' => 'GET',
			'login' => 'POST',
			'logout' => 'POST',
			
			//Register
			'showRegistrationForm' => 'GET',
			'register' => 'POST',
			
			//resetPassword
			'showLinkRequestForm' => 'GET',
			'sendResetLinkEmail' => 'POST',
			'showResetForm' => 'GET',
			'reset' => 'POST',

			//Email Verification
			'show' => 'GET',
			'verify' => 'GET',
			'resend' => 'GET',
		];
	}

	/**
	* Define all actions on the spesific controller
	*
	* @return array
	*/
	public function mapping()
	{
		return [
			LoginController::class => ['showLoginForm', 'login', 'logout'],
			RegisterController::class => ['showRegistrationForm', 'register'],
			ForgotPasswordController::class => ['showLinkRequestForm', 'sendResetLinkEmail'],
			ResetPasswordController::class => ['showResetForm', 'reset'],
			VerificationController::class => ['show', 'verify', 'resend'],
		];
	}
}
```

after creating route class we can now call it on the `/routes/web.php` using alias, For example: `AuthRoute::routes()`. Learn more about [Facde](/docs/#/en/1.0.0/usage/facade)

```php
//routes/web.php
AuthRoute::routes()
```

```list
+--------+----------+------------------------+---------------------+------------------------------------------------------------------------+------------------------------+
| Domain | Method   | URI                    | Name                | Action                                                                 | Middleware                   |
+--------+----------+------------------------+---------------------+------------------------------------------------------------------------+------------------------------+
|        | GET|HEAD | email/resend           | verification.resend | App\Http\Controllers\Auth\VerificationController@resend                | web,auth,throttle:6,1        |
|        | GET|HEAD | email/verify           | verification.notice | App\Http\Controllers\Auth\VerificationController@show                  | web,auth                     |
|        | GET|HEAD | email/verify/{id}      | verification.verify | App\Http\Controllers\Auth\VerificationController@verify                | web,auth,signed,throttle:6,1 |
|        | GET|HEAD | login                  | login               | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest                    |
|        | POST     | login                  |                     | App\Http\Controllers\Auth\LoginController@login                        | web,guest                    |
|        | POST     | logout                 | logout              | App\Http\Controllers\Auth\LoginController@logout                       | web                          |
|        | POST     | password/email         | password.email      | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest                    |
|        | GET|HEAD | password/reset         | password.request    | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest                    |
|        | POST     | password/reset         | password.update     | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest                    |
|        | GET|HEAD | password/reset/{token} | password.reset      | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest                    |
|        | GET|HEAD | register               | register            | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest                    |
|        | POST     | register               |                     | App\Http\Controllers\Auth\RegisterController@register                  | web,guest                    |
+--------+----------+------------------------+---------------------+------------------------------------------------------------------------+------------------------------+
```
