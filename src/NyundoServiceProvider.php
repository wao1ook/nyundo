<?php

namespace Emanate\Nyundo;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Emanate\Nyundo\Http\Middleware\CheckLicense;

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
