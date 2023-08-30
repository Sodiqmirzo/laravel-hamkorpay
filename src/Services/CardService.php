<?php

namespace LaravelHamkorPay\HamkorPay\Services;

use LaravelHamkorPay\HamkorPay\Requests\Card\CreateCardRequest;
use LaravelHamkorPay\HamkorPay\Responses\Card\CardCreateResponse;
use LaravelHamkorPay\HamkorPay\Responses\Card\CardResponse;
use LaravelHamkorPay\HamkorPay\Responses\Card\CardVerifyResponse;

class CardService extends BaseService
{
    public function create(CreateCardRequest|string $number, string $expire): CardCreateResponse
    {
        if (!$number instanceof CreateCardRequest) {
            $number = new CreateCardRequest($number, $expire);
        }

        $response = $this->sendRequest('card.create', [$number->toArray()]);

        return CardCreateResponse::from($response);
    }

    public function verify(string $key, string $confirm_code): CardVerifyResponse
    {
        $response = $this->sendRequest('card.verify', [compact('key', 'confirm_code')]);

        return CardVerifyResponse::from($response);
    }

    public function info(string $token): CardResponse
    {
        $response = $this->sendRequest('card.info', [['card_id' => $token]]);

        return CardResponse::from($response);
    }

    public function list(string $phone): CardResponse
    {
        $response = $this->sendRequest('card.list', [compact('phone')]);

        return CardResponse::from($response);
    }
}
