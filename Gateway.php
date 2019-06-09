<?php

namespace Gateway;

use Exception;

class Gateway
{
    public $endpoint = 'https://pay.ateros.fr/';
    private $app_token;
    private $curl;

    /**
     * Gateway constructor.
     * @param $app_token
     */
    public function __construct()
    {
        $this->curl = curl_init($this->endpoint);

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * @param $bool
     * @param $message
     * @throws Exception
     */
    private static function assert($bool, $message)
    {
        if (!$bool){
            var_dump(new Exception($message));
            die();
        }
    }

    /**
     * @param array $request
     * @param callable $handler
     * @throws Exception
     */
    public function handle(array $request, callable $handler)
    {
        $this::assert(isset($this->app_token), "app_token must be set to use this function");
        $this::assert($request['app_token'] == hash('sha256', $this->app_token), "callback message could not be verified");

        $handler($request);
    }

    /**
     * @param array $payment
     * @return mixed
     * @throws Exception
     */
    public function create(array $payment)
    {
        $this::assert(isset($this->app_token), "app_token must be set to use this function");
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $payment);

        $response = curl_exec($this->curl);
        curl_close($this->curl);

        return json_decode($response);
    }

    /**
     * @param mixed $app_token
     */
    public function setAppToken($app_token)
    {
        $this->app_token = $app_token;
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $this->app_token));
    }
}
