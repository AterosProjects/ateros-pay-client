<?php

namespace Ateros\Pay\Http;

class Client
{
    /**
     * API endpoint
     * @var string
     */
    private $endpoint = 'https://pay.ateros.fr/api';

    /**
     * Curl object
     * @var false|resource
     */
    private $curl;

    /**
     * Request headers
     * @var array
     */
    public $headers = [];

    public function __construct()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Add header to the request
     * @param $key
     * @param $value
     * @return $this
     */
    public function header($key, $value): Client
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * Make a POST request to the API
     * @param string $uri
     * @param array $data
     * @return mixed
     */
    public function post(string $uri, array $data = [])
    {
        $this->prepareForRequest();
        $this->setOpt(CURLOPT_URL, $this->endpoint . $uri);
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        return $this->exec();
    }

    /**
     * Make a GET request to the API
     * @param string $uri
     * @param array $data
     * @return mixed
     */
    public function get(string $uri, array $data = [])
    {
        $this->prepareForRequest();
        $this->setOpt(CURLOPT_URL, $this->endpoint . $uri . '?' . http_build_query($data));
        return $this->exec();
    }

    /**
     * Prepare the request before sending it
     */
    protected function prepareForRequest(): void
    {
        // Accept only JSON responses
        $this->header('Accept', 'application/json');
        // If set, change the default endpoint (for testing purposes)
        if ($endpoint = getenv('ATEROS_PAY_ENDPOINT')) {
            $this->endpoint = $endpoint;
        }
        // If the token is set, add the header, else throw an Exception
        if($key = getenv('ATEROS_PAY_KEY')){
            $this->header('Authorization', 'Bearer ' . $key);
        } else {
            $this->assert(false, 'You must must set the API key before making requests');
        }
        // Add headers to curl
        $this->setHeaders();
    }

    /**
     * Set headers from the Client object to the curl object
     * @return void
     */
    protected function setHeaders(): void
    {
        $this->setOpt(CURLOPT_HTTPHEADER, str_replace('=', ': ',
                explode('&', urldecode(
                        http_build_query($this->headers)
                    ))
            ));
    }

    /**
     * Assert or throw an Exception
     * @param $bool
     * @param $message
     * @return $this
     */
    protected function assert($bool, $message): Client
    {
        if (!$bool) {
            throw new \AssertionError($message);
        }
        return $this;
    }

    /**
     * Set a curl option
     * @param $option
     * @param $value
     * @return $this
     */
    protected function setOpt($option, $value): Client
    {
        curl_setopt($this->curl, $option, $value);
        return $this;
    }

    /**
     * Execute the curl request
     * @return mixed
     */
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
