<?php

require('Gateway.php');

use Gateway\Gateway;

$gateway = new Gateway;

$gateway->setAppToken('j2TWMMcRHHf9WnkuNIGADivlZQiXK5nxNEP2nlVQX2AHmUErOtvPTWTYMExA');

function handle_payment($payment){
    echo "Paiement " . $payment['id'] . " validé";
}

$gateway->handle($_POST, 'handle_payment');