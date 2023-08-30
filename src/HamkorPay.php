<?php

namespace LaravelHamkorPay\HamkorPay;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use LaravelHamkorPay\HamkorPay\Exception\HamkorPayException;
use LaravelHamkorPay\HamkorPay\Exception\HamkorPayTokenNotFound;
use LaravelHamkorPay\HamkorPay\Services\CardService;
use Throwable;

class HamkorPay
{
    const HAMKORPAY_TOKEN = 'hamkorpay_token';
    private PendingRequest $client;
    private mixed $config;

    public function __construct()
    {
        try {
            $this->config = config('hamkor-pay');
            $config = $this->config;
            $proxy_url = $this->config['proxy_url'] ?? (($config['proxy_proto'] ?? '') . '://' . ($config['proxy_host'] ?? '') . ':' . ($config['proxy_port'] ?? '')) ?? '';
            $options = is_string($proxy_url) && str_contains($proxy_url, '://') && strlen($proxy_url) > 12 ? ['proxy' => $proxy_url] : [];

            $this->client = Http::log()->withHeaders(['x-requested-with' => $config['request_from'] ?? 'Merchant Gateway'])
                ->asJson()->withOptions($options);

            if (cache()->has($this::HAMKORPAY_TOKEN)) {
                $this->client->withToken(cache()->get($this::HAMKORPAY_TOKEN));
            } else {
                $this->client->withToken($this->getAccessToken());
            }
        } catch (Throwable) {
            throw new HamkorPayException('HamkorPay config not found', -1024);
        }
    }

    /**
     * @throws Throwable
     */
    private function getAccessToken()
    {
        $tokenUrl = $this->config['token_url'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        $request = $this->client->baseUrl($tokenUrl)->withBasicAuth($username, $password)
            ->post('/oauth2/token', ['grant_type' => 'client_credentials']);

        throw_if($request['access_token'] === null, new HamkorPayTokenNotFound('HamkorPay token not found', -1025));

        if (isset($request['access_token'])) {
            cache()->put($this::HAMKORPAY_TOKEN, $request['access_token'], $request['expires_in'] - 10);
        }
        return $request['access_token'];
    }

    public function card(): CardService
    {
        $base_url = $this->config['base_url'];
        return new CardService($this->client->baseUrl($base_url));
    }
}
