<?php

namespace LaravelHamkorPay\HamkorPay\Responses\Card;


use LaravelHamkorPay\HamkorPay\Responses\BaseResponse;

class CardResponse extends BaseResponse
{

    public function __construct(
        public string $number,
        public string $expiry,
        public int    $balance
    )
    {
    }

    public function isOk(): bool
    {
        return $this->number !== null;
    }
}
