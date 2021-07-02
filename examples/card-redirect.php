<?php

require __DIR__ . '/init.php';

$gateway = new \Paytic\Omnipay\Simplify\Gateway();
$parameters = [
    'apiPassword' => getenv('SIMPLIFY_API_PASSWORD'),
    'merchant' => getenv('SIMPLIFY_MERCHANT'),
    'merchant_name' => 'Test Merchant Name',
    'orderId' => time(),
    'description' => 'My test transaction',
    'returnUrl' => 'http://localhost/libraries/paytic/omnipay-simplify/examples/card-return.php?id=99999',
    'amount' => 12.34,
    'currency' => 'ron',
    'card' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@gmail.com',
    ],
];

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
