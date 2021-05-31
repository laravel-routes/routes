# Filtering routes

---

- [Partial Routes action](#partial-routes-action)

<a name="partial-routes-action"></a>
## Partial Routes action

When declaring a route class, you may specify a subset of actions the controller should handle instead of the full set of default actions

Using `only` and `except` we are easily disable and enable the action on our routes class:


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

this route class is exactly same as with `auth::routes()`; 

in the `__construct()` method we can set the except to disable some actions:

```php
public function __construct()
{
	$this->except(['showRegistrationForm', 'register']);
}
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
+--------+----------+------------------------+---------------------+------------------------------------------------------------------------+------------------------------+
```

if you want to disable actions by `controller` class name, this package not provide that function, however you can set it `manually`:

```php
use App\Http\Controllers\Auth\{
    LoginController,
    RegisterController,
    ForgotPasswordController,
    ResetPasswordController,
    VerificationController,
};


public function __construct()
{
	$this->except($this->getAllDisabled());
}

...
public function getAllDisabled()
{	
	$controller = $this->mapping();

	return array_merge(
		$controller[RegisterController::class],
		$controller[VerificationController::class]
	);
}
```

Using `only` methods we can choose only the routes that we want to run on our server this a vice versa of `except`


```php
public function __construct()
{
    $this->only(['showLoginForm', 'login', 'logout']);
}
```