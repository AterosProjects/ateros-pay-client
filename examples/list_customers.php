<?php

require __DIR__ . '/../vendor/autoload.php';

use Ateros\Pay\Facades\AterosPay;
use Ateros\Pay\Objects\Customer;

AterosPay::setApiKey('YEUInYjKJU1EitwmYlf01THEGDsYZDaUSVAmAqcMs9z8w9KYfw56Ju2aNw8Z');

$customers = Customer::all();

print_r($customers);
