# Route Naming

---

<a name="route-name"></a>
## Named Routes

By default, all route class `actions` have a route name; however, you can override these names by passing a array with `names()` inside the route class.

```php
namespace App\Routes;

use PhHitachi\Routes\Services\Routes;
use App\Http\Controllers\UserController;

Class User extends Routes
{
	...

	public function names()
	{
		return [
			...
			'index' => 'all',
		];
	}
```


```list
+--------+-----------+-----------+---------+---------------------------------------------+------------+
| Domain | Method    | URI       | Name    | Action                                      | Middleware |
+--------+-----------+-----------+---------+---------------------------------------------+------------+
|        | GET|HEAD  | /         | all     | App\Http\Controllers\UserController@index   | web        |
|        | POST      | /         | store   | App\Http\Controllers\UserController@store   | web        |
|        | GET|HEAD  | create    | create  | App\Http\Controllers\UserController@create  | web        |
|        | GET|HEAD  | {id}      | show    | App\Http\Controllers\UserController@show    | web        |
|        | PUT|PATCH | {id}      | update  | App\Http\Controllers\UserController@update  | web        |
|        | DELETE    | {id}      | destroy | App\Http\Controllers\UserController@destroy | web        |
|        | GET|HEAD  | {id}/edit | edit    | App\Http\Controllers\UserController@edit    | web        |
+--------+-----------+-----------+---------+---------------------------------------------+------------+
```