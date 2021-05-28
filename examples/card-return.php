<?php

require __DIR__ . '/init.php';

$gateway = new \ByTIC\Omnipay\Paylike\Gateway();
$parameters = [
    'publicKey' => getenv('PAYLIKE_PUBLIC_KEY'),
    'privateKey' => getenv('PAYLIKE_PRIVATE_KEY'),
];

$request = $gateway->completePurchase($parameters);
$response = $request->send();

$response->send();
