<?php

require('Gateway.php');

use Gateway\Gateway;

$gateway = new Gateway;

$gateway->setAppToken('xxxxxxx');

$payment = $gateway->createPayment([
    "amount" => 50,
    "customer" => "customer@example.org",
    "currency" => "EUR",
    "identifier" => "order-25",
    "descriptor" => "Achat test",
    "processor" => "paypal",
    "sandbox" => True,
]);

if ($payment->success){
    echo $payment->data->redirect_url;
} else {
    echo "Error : " . PHP_EOL;
    var_dump($payment->data);
}
