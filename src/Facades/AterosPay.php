<?php

namespace Ateros\Pay\Facades;

class AterosPay
{
    /**
     * Store the API key in the environment
     * @param $key
     */
    public static function setApiKey($key): bool
    {
        return putenv("ATEROS_PAY_KEY=$key");
    }

    /**
     * Store the API endpoint in the environment
     * @param $endpoint
     */
    public static function setApiEndpoint($endpoint): bool
    {
        return putenv("ATEROS_PAY_ENDPOINT=$endpoint");
    }
}