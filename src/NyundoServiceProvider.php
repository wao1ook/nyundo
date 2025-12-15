<?php

namespace Emanate\Nyundo;

use Emanate\Nyundo\Http\Middleware\CheckLicense;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NyundoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('nyundo')
            ->hasConfigFile()
            ->hasViews();
    }

    public function packageBooted()
    {
        // Register the middleware with an alias
        $router = $this->app['router'];
        $router->aliasMiddleware('nyundo.checklicense', CheckLicense::class);
    }
}
