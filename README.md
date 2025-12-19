# Nyundo: License Manager for Laravel

[![Latest Stable Version](https://poser.pugx.org/emanate/nyundo/v)](https://packagist.org/packages/emanate/nyundo)
[![Total Downloads](https://poser.pugx.org/emanate/nyundo/downloads)](https://packagist.org/packages/emanate/nyundo)
[![License](https://poser.pugx.org/emanate/nyundo/license)](https://packagist.org/packages/emanate/nyundo)

Nyundo is a simple license management package for Laravel applications. it allows you to easily enforce license expiration, grace periods, and display customizable warning messages or expiration pages.

## Installation

You can install the package via composer:

```bash
composer require emanate/nyundo
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="nyundo-config"
```

## Configuration

This is the contents of the published config file:

```php
return [
    'key' => env('LICENSE_KEY', null),
    
    'holder' => env('LICENSE_HOLDER', null),

    'warning_days' => (int) env('LICENSE_WARNING_DAYS', 7),

    'expiration_date' => env('LICENSE_EXPIRATION_DATE', null),
     
    'grace_period_days' => (int) env('LICENSE_GRACE_PERIOD_DAYS', 0),

    'support' => [
        'phone' => env('LICENSE_SUPPORT_PHONE', '+2557123456789'),
        'email' => env('LICENSE_SUPPORT_EMAIL', 'support@example.com'),
        'hours' => env('LICENSE_SUPPORT_HOURS', 'Monday - Friday, 9:00 AM - 5:00 PM'),
    ],
];
```

## Usage

### Middleware

To enforce license checks, add the `nyundo.check-license` middleware to your routes:

```php
Route::middleware(['nyundo.check-license'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

### CLI Command

You can check the current status of your license from the terminal:

```bash
php artisan nyundo:status
```

## Customization

### Views

If you want to customize the expiration page, you can publish the views:

```bash
php artisan vendor:publish --tag="nyundo-views"
```

The view will be published to `resources/views/vendor/nyundo/expired.blade.php`.

### Session Messages

The middleware flashes messages to the session which you can display in your layout:

- `nyundo_license_warning`: Shown when the license is nearing expiration.
- `nyundo_license_error`: Shown during the grace period.

```blade
@if(session('nyundo_license_warning'))
    <div class="alert alert-warning">
        {{ session('nyundo_license_warning') }}
    </div>
@endif
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Emanate Software](http://github.com/wao1ook)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
