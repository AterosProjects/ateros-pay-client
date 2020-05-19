<?php

namespace Ateros\Pay\Http;

use Exception;

class Client
{
    public $endpoint = 'https://ateros-pay.test/api';
    public $headers = [];
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        $this->header('Accept', 'application/json');
    }

    public function header($key, $value): Client
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function setApiKey($key)
    {
        return $this->header('Authorization', 'Bearer ' . $key);
    }

    public function post(string $uri, array $data = [])
    {
        $this->prepareForRequest();
        $this->setOpt(CURLOPT_URL, $this->endpoint . $uri);
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        return $this->exec();
    }

    public function get(string $uri, array $data = [])
    {
        $this->prepareForRequest();
        $this->setOpt(CURLOPT_URL, $this->endpoint . $uri . '?' . http_build_query($data));
        return $this->exec();
    }

    protected function prepareForRequest()
    {
        $this->setOpt(CURLOPT_HTTPHEADER, str_replace('=', ': ', explode('&', urldecode(http_build_query($this->headers)))));
        $this->assert(
            array_key_exists('Authorization', $this->headers),
            'You must must set the API key before making requests.'
        );
    }

    protected function assert($bool, $message): Client
    {
        if (!$bool) {
            throw new \AssertionError($message);
        }
        return $this;
    }

    protected function setOpt($option, $value): Client
    {
        curl_setopt($this->curl, $option, $value);
        return $this;
    }

    protected function exec()
    {
        $response = curl_exec($this->curl);
        if (!$response) {
            $this->assert(false, 'Got error number ' . curl_errno($this->curl) . ' from curl : ' . curl_error($this->curl));
        }
        curl_close($this->curl);
        try {
            return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $this->assert(false, 'Invalid JSON received from the API.');
        }
    }

}
