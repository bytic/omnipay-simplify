<?php

require __DIR__ . '/init.php';

$gateway = new \ByTIC\Omnipay\Paylike\Gateway();
$parameters = [
    'publicKey' => getenv('PAYLIKE_PUBLIC_KEY'),
    'privateKey' => getenv('PAYLIKE_PRIVATE_KEY'),
    'transactionId' => '5f5b9640e2412a5baa857e57',
    'amount' => 12.34,
];

$request = $gateway->capture($parameters);
$response = $request->send();

var_dump($response->getData());
