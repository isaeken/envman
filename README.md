# Manage your Laravel environment runtime

[![Latest Version on Packagist](https://img.shields.io/packagist/v/isaeken/envman.svg?style=flat-square)](https://packagist.org/packages/isaeken/envman)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/isaeken/envman/run-tests?label=tests)](https://github.com/isaeken/envman/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/isaeken/envman/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/isaeken/envman/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/isaeken/envman.svg?style=flat-square)](https://packagist.org/packages/isaeken/envman)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://banners.beyondco.de/EnvMan.png?theme=light&packageManager=composer+require&packageName=isaeken%2Fenvman&pattern=architect&style=style_1&description=Manage+your+environment+dynamically&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" width="419px" />](https://github.com/sponsors/isaeken)

Manage your Laravel application's environment variables dynamically so fast.

## Installation

You can install the package via composer:

```bash
composer require isaeken/envman
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="envman-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="envman-config"
```

This is the contents of the published config file:

```php
return [
    'enabled' => env('ENVMAN_ENABLED', true),

    'cache' => env('APP_ENV', 'production') === 'production',

    'features' => [
        // custom configs for domains
        'domains' => true,
    ],

    'database' => [
        'connection', env('DB_CONNECTION'),
    ],
];
```

## Usage

You can change environment variables dynamically:

```php
\IsaEken\Envman\Facades\Envman::setConfig('app.name', 'Your App Name');
\IsaEken\Envman\Facades\Envman::setConfig('app.debug', false);
\IsaEken\Envman\Facades\Envman::setConfig('app.environment', 'production');
```

And you can reset variables:

```php
\IsaEken\Envman\Facades\Envman::resetConfig('app.debug');
```

## Commands

```shell
# Reset all your environment changes
php artisan envman:reset
```

```shell
# Cache all environment variables
php artisan envman:cache
```

```shell
# Clear all environment variable cache
php artisan envman:cache:clear
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [İsa Eken](https://github.com/isaeken)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
