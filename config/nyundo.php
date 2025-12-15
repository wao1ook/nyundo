<?php

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
        'email' => env('LICENSE_SUPPORT_EMAIL', 'support@example.com'),
        'phone' => env('LICENSE_SUPPORT_PHONE', '+1-555-123-4567'),
        'hours' => env('LICENSE_SUPPORT_HOURS', 'Monday - Friday, 9:00 AM - 5:00 PM'),
    ],
];
