<?php

namespace LaravelHamkorPay\HamkorPay\Responses;

use Spatie\LaravelData\Data;

abstract class BaseResponse extends Data
{
    abstract public function isOk(): bool;
}
