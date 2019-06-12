<?php

require('Gateway.php');

use Gateway\Gateway;

$gateway = new Gateway;

$gateway->setAppToken('UFG0EI5blBOFzg1aLf6sx32ovZt7z1sT54XUl4tfvHsYb6s6mW86pR3x7OuY');

$payment = $gateway->create([
    "amount" => 50,
    "customer" => "customer@example.org",
    "currency" => "EUR",
    "identifier" => "order-25",
    "descriptor" => "Achat test",
    "processor" => "paypal",
    "sandbox" => True,
]);

echo $payment->redirect_url;
