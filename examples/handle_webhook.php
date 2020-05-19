<?php

require __DIR__ . '/../vendor/autoload.php';

use Ateros\Pay\Facades\AterosPay;
use Ateros\Pay\Http\Webhook;

AterosPay::setApiKey('YEUInYjKJU1EitwmYlf01THEGDsYZDaUSVAmAqcMs9z8w9KYfw56Ju2aNw8Z');

// Retrieving the JSON input
$body = file_get_contents('php://input');

// Verify the request signature
Webhook::verify($body, $_SERVER['HTTP_SIGNATURE']);

// Parsing the JSON to get Object models
$webhook = Webhook::fromJson($body);

// Next, do anything you need to do...
print_r($webhook->object);