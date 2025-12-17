# License Manager Package for your Laravel Applications
[![Latest Stable Version](https://poser.pugx.org/emanate/nyundo/v)](https://packagist.org/packages/emanate/nyundo)
[![Total Downloads](https://poser.pugx.org/emanate/nyundo/downloads)](https://packagist.org/packages/emanate/nyundo)
[![Monthly Downloads](https://poser.pugx.org/emanate/nyundo/d/monthly)](https://packagist.org/packages/emanate/nyundo)
[![License](https://poser.pugx.org/emanate/nyundo/license)](https://packagist.org/packages/emanate/nyundo)

## Installation

You can install the package via composer:

```bash
composer require wao1ook/nyundo
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="nyundo-config"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | License Settings
    |--------------------------------------------------------------------------
    |
    | These values are typically set via environment variables in your .env file.
    | They define the key parameters for license validation and display.
    |
    */

    'key' => env('LICENSE_KEY', null),

    // The date the license expires (format YYYY-MM-DD)
    'expiration_date' => env('LICENSE_EXPIRATION_DATE', null),

    // The name of the license holder (e.g., Your Company Name)
    'holder' => env('LICENSE_HOLDER', null),

    // Email of the license holder
    'email' => env('LICENSE_EMAIL', null),

    // Number of days before expiration to start showing a warning
    'warning_days' => (int) env('LICENSE_WARNING_DAYS', 7),

    // Number of days after expiration to allow access (grace period)
    'grace_period_days' => (int) env('LICENSE_GRACE_PERIOD_DAYS', 0),

    /*
    |--------------------------------------------------------------------------
    | Support Information (Displayed on the license expired page)
    |--------------------------------------------------------------------------
    */

    'support' => [
        'phone' => env('LICENSE_SUPPORT_PHONE', '+2557123456789'),
        'email' => env('LICENSE_SUPPORT_EMAIL', 'support@example.com'),
        'hours' => env('LICENSE_SUPPORT_HOURS', 'Monday - Friday, 9:00 AM - 5:00 PM'),
    ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="nyundo-views"
```

## Usage



## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Emanate Software](https://github.com/wao1ook)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
