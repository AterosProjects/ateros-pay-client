<?php

require __DIR__ . '/../vendor/autoload.php';

use Ateros\Pay\Constants\Currency;
use Ateros\Pay\Constants\Processor;
use Ateros\Pay\Facades\AterosPay;
use Ateros\Pay\Objects\Payment;

AterosPay::setApiKey('YEUInYjKJU1EitwmYlf01THEGDsYZDaUSVAmAqcMs9z8w9KYfw56Ju2aNw8Z');

// Create a payment
$payment = Payment::create([
    'identifier' => 'your-custom-identifier',
    'descriptor' => 'This is a test subscription',
    'amount' => 50,
    'customer' => 'customer@examle.org',
    'currency' => Currency::$USD,
    'processor' => Processor::$STRIPE
]);

print_r($payment);

// Find an existing payment by ID
$payment2 = Payment::get($payment->id);

