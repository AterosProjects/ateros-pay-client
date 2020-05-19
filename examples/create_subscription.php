<?php

require __DIR__ . '/../vendor/autoload.php';

use Ateros\Pay\Constants\Currency;
use Ateros\Pay\Constants\Period;
use Ateros\Pay\Constants\Processor;
use Ateros\Pay\Facades\AterosPay;
use Ateros\Pay\Objects\Subscription;

AterosPay::setApiKey('YEUInYjKJU1EitwmYlf01THEGDsYZDaUSVAmAqcMs9z8w9KYfw56Ju2aNw8Z');

// Create a subscription
$subscription = Subscription::create([
    'identifier' => 'your-custom-identifier',
    'descriptor' => 'This is a test subscription',
    'amount' => 50,
    'customer' => 'customer@examle.org',
    'currency' => Currency::$USD,
    'period' => Period::$MONTH,
    'processor' => Processor::$STRIPE
]);

print_r($subscription);

// Find an existing subscription by ID
$subscription2 = Subscription::get($subscription->id);