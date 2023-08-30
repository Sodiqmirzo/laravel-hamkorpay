<?php

namespace LaravelHamkorPay\HamkorPay;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HamkorPayServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('hamkor-pay')->hasConfigFile();
    }
}
