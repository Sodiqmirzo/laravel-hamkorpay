<?php

namespace LaravelHamkorPay\HamkorPay\Dtos;

class PayCreateDto extends BaseDto
{
    public function __construct(
        public string  $external_id,
        public int     $amount,
        public string  $currency_code,
        public CardDto $card,
        public ?array  $details = [],
        public ?object  $payer_data = null,
    )
    {
    }
}
