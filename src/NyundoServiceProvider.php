<?php

namespace Emanate\Nyundo;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Emanate\Nyundo\Commands\NyundoCommand;

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
            ->hasViews()
            ->hasMigration('create_nyundo_table')
            ->hasCommand(NyundoCommand::class);
    }
}
