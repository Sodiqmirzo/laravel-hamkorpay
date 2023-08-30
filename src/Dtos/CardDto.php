<?php

namespace LaravelHamkorPay\HamkorPay\Dtos;

class CardDto extends BaseDto
{
    public function __construct(
        public ?string $id,
        public ?string $number,
        public ?string $expiry,
    )
    {
    }
}
