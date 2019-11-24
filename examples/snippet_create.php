<?php

require __DIR__.'../vendor/autoload.php';

use Ateros\Pay\Gateway;

$gateway = new Gateway();

$gateway->setAppToken('');

$payment = $gateway->create('payment', [
    'amount'     => 50,
    'customer'   => 'customer@example.org',
    'currency'   => 'EUR',
    'identifier' => 'order-25',
    'descriptor' => 'Achat test',
    'processor'  => 'stripe',
    'sandbox'    => true,
]);

if ($payment->success) {
    echo $payment->data->redirect_url;
} else {
    echo 'Error : '.PHP_EOL;
    var_dump($payment->errors);
}
