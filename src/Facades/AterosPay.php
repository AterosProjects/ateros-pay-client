<?php

namespace Ateros\Pay\Facades;

use Ateros\Pay\Http\Client;

class AterosPay
{
    public static function setApiKey($key)
    {
        $_ENV['ATEROS_PAY_KEY'] = $key;
        $_ENV['ATEROS_PAY_CLIENT'] = (new Client())->setApiKey($_ENV['ATEROS_PAY_KEY']);
    }

    public static function client()
    {
        return $_ENV['ATEROS_PAY_CLIENT'];
    }
}