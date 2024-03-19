<?php

namespace LaravelHamkorPay\HamkorPay\Requests\Card;

use LaravelHamkorPay\HamkorPay\Requests\BaseRequest;

class CreateCardRequest extends BaseRequest
{
    public function __construct(
        public string $number,
        public string $expiry,
        public bool $must_otp = true,
        public string $phone = '',
    )
    {
    }
}
