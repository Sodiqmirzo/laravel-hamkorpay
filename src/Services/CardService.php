<?php

namespace LaravelHamkorPay\HamkorPay\Services;

use LaravelHamkorPay\HamkorPay\Requests\Card\CreateCardRequest;
use LaravelHamkorPay\HamkorPay\Responses\Card\CardResponse;

class CardService extends BaseService
{
    public function create(CreateCardRequest|string $number, string $expire): CardResponse
    {
        if (!$number instanceof CreateCardRequest) {
            $number = new CreateCardRequest($number, $expire);
        }

        $response = $this->sendRequest('card.create', $number->toArray());

        return CardResponse::from($response);
    }

    public function verify(string $key, string $confirm_code): CardResponse
    {
        $response = $this->sendRequest('card.verify', compact('key', 'confirm_code'));

        return CardResponse::from($response);
    }

    public function info(string $token): CardResponse
    {
        $response = $this->sendRequest('card.info', ['card_id' => $token]);

        return CardResponse::from($response);
    }
}
