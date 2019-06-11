<?php

require('Gateway.php');

use Gateway\Gateway;

$gateway = new Gateway;

$gateway->setAppToken('xxxxxxxx');

$payment = $gateway->create([
    "amount" => 50,
    "customer" => "customer@example.org",
    "currency" => "EUR",
    "identifier" => "order-25",
    "descriptor" => "Achat test",
    "processor" => "paypal"
]);

echo $payment->redirect_url;
