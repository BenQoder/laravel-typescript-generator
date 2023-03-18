<?php

namespace BenQoder\TypescriptGenerator;

use Illuminate\Contracts\Http\Kernel;
use Spatie\LaravelPackageTools\Package;
use BenQoder\TypescriptGenerator\TypescriptGenerator;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use BenQoder\TypescriptGenerator\Commands\TypescriptGeneratorCommand;

class TypescriptGeneratorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('typescript-generator')
            ->hasConfigFile();
    }
}
