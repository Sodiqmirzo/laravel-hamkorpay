<?php

namespace LaravelHamkorPay\HamkorPay\Responses\Pay;

use LaravelHamkorPay\HamkorPay\Dtos\CardDto;
use LaravelHamkorPay\HamkorPay\Responses\BaseResponse;

class PayConfirmResponse extends BaseResponse
{
    public function __construct(
        public CardDto $card,
        public string  $state,
        public bool    $hold,
        public int     $amount = 0,
        public ?string $external_id = '',
        public ?string $create_at = '',
        public ?array  $details = [],
        public ?array  $payer_data = [],
    )
    {
    }

    public function isOk(): bool
    {
        if (!$this->hold) {
            return (int)$this->state === 3;
        }
        return (int)$this->state === 2;
    }
}
