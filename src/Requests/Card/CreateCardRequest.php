<?php

namespace LaravelHamkorPay\HamkorPay\Requests\Card;

use Ittech\Payme\Requests\BaseRequest;

class CreateCardRequest extends BaseRequest
{
    public function __construct(
        public string $number,
        public string $expiry,
    )
    {
    }
}
