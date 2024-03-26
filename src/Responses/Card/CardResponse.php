<?php

namespace LaravelHamkorPay\HamkorPay\Responses\Card;


use LaravelHamkorPay\HamkorPay\Responses\BaseResponse;

class CardResponse extends BaseResponse
{

    public function __construct(
        public string $number,
        public string $expiry,
        public int    $balance,
        public string $owner,
        public string $phone,
        public string $status,
        public bool   $is_sms_enabled,
    )
    {
    }

    public function isOk(): bool
    {
        return (int)$this->status === 0;
    }
}
