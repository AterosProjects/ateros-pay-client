<?php

require __DIR__.'../vendor/autoload.php';

use Ateros\Pay\Gateway;

$gateway = new Gateway();

$gateway->setAppToken('');

function handle_payment($payment)
{
    $file = 'log.txt';
    $current = file_get_contents($file);
    $current .= 'Paiement '.$payment['id']." validé\n";
    file_put_contents($file, $current);
}

function handle_subscription($subscription)
{
    $file = 'log.txt';
    $current = file_get_contents($file);
    $current .= 'Abonnement '.$subscription['id']." validé\n";
    file_put_contents($file, $current);
}

$gateway->handle($_POST, 'payment', 'handle_payment');
$gateway->handle($_POST, 'subscription', 'handle_subscription');
