<?php

namespace LaravelHamkorPay\HamkorPay\Responses\Pay;

use LaravelHamkorPay\HamkorPay\Responses\BaseResponse;

class PayCreateResponse extends BaseResponse
{
    public function __construct(
        public string $pay_id,
        public string $confirm_method,
        public int    $fee_amount,
    )
    {
    }

    public function isOk(): bool
    {
        return $this->pay_id !== null;
    }
}
