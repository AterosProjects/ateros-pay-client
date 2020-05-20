<?php

namespace Ateros\Pay\Http;

use Ateros\Pay\Constants\Objects;

class Webhook
{
    public static function fromJson($payload)
    {
        $data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);

        $class = Objects::${$data['object']};

        return \Ateros\Pay\Objects\Webhook::make([
            'type' =>$data['type'],
            'object' => $class::make($data['data']),
        ]);
    }

    public static function verify($payload, string $signature)
    {
        if(hash_hmac('sha256', $payload, getenv('ATEROS_PAY_KEY')) !== $signature){
            throw new \Exception('Invalid signature');
        };

        return true;
    }
}