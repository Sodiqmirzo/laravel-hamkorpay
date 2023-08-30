<?php

namespace LaravelHamkorPay\HamkorPay\Responses\Card;


use LaravelHamkorPay\HamkorPay\Responses\BaseResponse;

class CardVerifyResponse extends BaseResponse
{
    public function __construct(
        public string $number,
        public string $expiry,
        public string $id
    )
    {
    }

    public function isOk(): bool
    {
        return $this->id !== null;
    }
}
