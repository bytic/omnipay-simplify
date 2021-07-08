<?php

require __DIR__ . '/init.php';

$gateway = new \Paytic\Omnipay\Simplify\Gateway();

$orderId = 1625688049;

$parameters = [
    'apiPassword' => getenv('SIMPLIFY_API_PASSWORD'),
    'merchant' => getenv('SIMPLIFY_MERCHANT'),
    'orderId' => $orderId
];

$request = $gateway->retrieveOrder($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
var_dump($response->getData());
