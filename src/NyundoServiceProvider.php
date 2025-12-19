<?php

namespace Emanate\Nyundo;

use Emanate\Nyundo\Commands\NyundoRenewCommand;
use Emanate\Nyundo\Commands\NyundoStatusCommand;
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
            ->hasViews()
            ->hasCommands([
                NyundoStatusCommand::class,
                NyundoRenewCommand::class,
            ]);
    }

    public function packageBooted()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('nyundo.check-license', CheckLicense::class);
    }
}
