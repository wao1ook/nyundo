<?php

namespace Emanate\Nyundo;

use Emanate\Nyundo\Http\Middleware\CheckLicense;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NyundoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('nyundo')
            ->hasConfigFile()
            ->hasViews();
    }

    public function packageBooted()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('nyundo.check-license', CheckLicense::class);
    }
}
