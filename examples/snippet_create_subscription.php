<?php

require __DIR__ . '../vendor/autoload.php';

use Ateros\Pay\Gateway;

$gateway = new Gateway;

$gateway->setAppToken('');

$subscription = $gateway->create('subscription', [
    "period" => "month",
    "amount" => 50,
    "customer" => "customer@example.org",
    "currency" => "EUR",
    "identifier" => "order-25",
    "descriptor" => "Achat test",
    "processor" => "stripe",
    "sandbox" => True,
]);

if ($subscription->success){
    echo $subscription->data->redirect_url;
} else {
    echo "Error : " . PHP_EOL;
    var_dump($subscription->errors);
}
