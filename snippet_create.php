<?php

require('Gateway.php');

use Gateway\Gateway;

$gateway = new Gateway;

$gateway->setAppToken('j2TWMMcRHHf9WnkuNIGADivlZQiXK5nxNEP2nlVQX2AHmUErOtvPTWTYMExA');

$payment = $gateway->create([
    "amount" => 1,
    "customer" => "gregjlen@gmail.com",
    "currency" => "EUR",
    "identifier" => "order-25",
    "descriptor" => "Achat test",
    "processor" => "paypal"
]);

echo $gateway->endpoint . $payment->id;