<?php 

if (!function_exists('route_path')){
	function route_path()
	{
		return app_path('Routes');
	}
}

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('routes')) {
    function routes() {
        return app('router');
    }
}