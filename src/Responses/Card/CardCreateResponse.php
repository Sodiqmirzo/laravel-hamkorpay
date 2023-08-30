<?php

namespace LaravelHamkorPay\HamkorPay\Responses\Card;


use LaravelHamkorPay\HamkorPay\Responses\BaseResponse;

class CardCreateResponse extends BaseResponse
{
    public function __construct(
        public string $number,
        public string $expiry,
        public string $key
    )
    {
    }

    public function isOk(): bool
    {
        return $this->key !== null;
    }
}
