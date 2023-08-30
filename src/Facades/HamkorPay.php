<?php

namespace LaravelHamkorPay\HamkorPay\Facades;

use Illuminate\Support\Facades\Facade;

class HamkorPay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaravelHamkorPay\HamkorPay\HamkorPay::class;
    }
}
