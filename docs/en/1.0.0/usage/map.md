# Routes Mapping

---

- [Supplementing URIs](#url-mapping)
- [Method Mapping](#method-mapping)
- [Multiple Method](#multiple-method)

<a name="url-mapping"></a>
## Supplementing URIs

in the Laravel [Route](https://laravel.com/docs/8.x/routing) if you use resource methods If you need to add additional routes to a resource controller beyond the default set of resource routes, you should define those routes before your call to Route::resource; otherwise, the routes defined by the resource method may unintentionally take precedence over your supplemental routes. 

in this package you can add more route in resource mode by adding on the `map()` in route class to merge all routes on resource controller. 

```php
	/**
	* Define url in the value of action
	*
	* @return array
	*/
	public function map()
	{
		return [
			...
			'upload' => '/upload',
		];
	}
```
<strong>Note:</strong> once you declared the action in `map()` you need also to add the methods on the url.

<a name="method-mapping"></a>
## Method Mapping

to define what methods on our route we can use `methods()` to declare the accepted methods on the url:

```php
	/**
	* Define methods in the value action
	*
	* @return array
	*/
	public function methods()
	{
		return [
			...
			'upload' => 'POST'
		];
	}
```
<a name="multiple-method"></a>
<strong>Note:</strong> if you add a action that same `uri` with other action make sure you add the diffirent `Verb`, if not. The route make override the first route. with a same method and uri.

sometimes we need to add `multiple` Verb on the route, using `methods()` function we can add multiple Verb on our single `action` via array


```php
	/**
	* Define methods in the value action
	*
	* @return array
	*/
	public function methods()
	{
		return [
			...
			'upload' => ['POST', 'PUT'],
		];
	}
```


