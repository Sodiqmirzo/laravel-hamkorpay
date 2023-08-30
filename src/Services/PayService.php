<?php

namespace LaravelHamkorPay\HamkorPay\Services;

use LaravelHamkorPay\HamkorPay\Dtos\PayCreateDto;
use LaravelHamkorPay\HamkorPay\Responses\Pay\PayConfirmResponse;
use LaravelHamkorPay\HamkorPay\Responses\Pay\PayCreateResponse;

class PayService extends BaseService
{
    public function create(PayCreateDto $dto): PayCreateResponse
    {
        $response = $this->sendRequest('pay.create', [$dto->toArray()]);

        return PayCreateResponse::from($response);
    }

    public function confirm(string $pay_id, ?string $confirm_code = "", bool $hold = false): PayConfirmResponse
    {
        $response = $this->sendRequest('pay.confirm', [compact('pay_id', 'confirm_code', 'hold')]);
        $response['hold'] = $hold;

        return PayConfirmResponse::from($response);
    }

    public function confirmHold(string $pay_id): PayConfirmResponse
    {
        $response = $this->sendRequest('pay.confirmHold', [compact('pay_id')]);
        $response['hold'] = true;

        return PayConfirmResponse::from($response);
    }

    public function cancel(string $pay_id): PayConfirmResponse
    {
        $response = $this->sendRequest('pay.cancel', [compact('pay_id')]);

        return PayConfirmResponse::from($response);
    }

    public function cancelPartial(string $pay_id, int $amount, array $details = []): PayConfirmResponse
    {
        $response = $this->sendRequest('card.verify', [compact('pay_id', 'amount', 'details')]);

        return PayConfirmResponse::from($response);
    }

    public function info(string $pay_id): PayConfirmResponse
    {
        $response = $this->sendRequest('pay.get', [['pay_id' => $pay_id]]);

        return PayConfirmResponse::from($response);
    }
}
