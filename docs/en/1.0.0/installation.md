# Installation

---

- [Requirements](#requirements)
- [Installation](#installation)

<a name="requirements"></a>
## Requirements

- <strong>PHP >=7.2.34</strong>
- <strong>Laravel >=5.8.*</strong>

<a name="installation"></a>
## Installation

This package exclusive only to [Laravel](https://laravel.com/) to use this you can install this package via composer using:

```bash
composer require laravelph/routes
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

