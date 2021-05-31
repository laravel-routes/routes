<?php 

namespace PhHitachi\Routes\Facades;

use Illuminate\Support\Facades\Facade;

Class Router extends Facade
{
	protected static function getFacadeAccessor()
    {
        return 'Routes';
    }
}