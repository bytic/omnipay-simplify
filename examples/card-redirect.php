<?php

require __DIR__ . '/init.php';

$gateway = new \Paytic\Omnipay\Simplify\Gateway();
$orderId = time();
$parameters = [
    'apiPassword' => getenv('SIMPLIFY_API_PASSWORD'),
    'merchant' => getenv('SIMPLIFY_MERCHANT'),
    'merchant_name' => 'Test Merchant Name',
    'orderId' => $orderId,
    'description' => 'My test transaction',
    'returnUrl' => 'http://localhost/libraries/paytic/omnipay-simplify/examples/card-return.php?id=' . $orderId,
    'notifyUrl' => 'https://hookb.in/MqqdzrREWnFDRWppRLRw',
    'amount' => 12.34,
    'currency' => 'ron',
    'card' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@gmail.com',
        'phone' => '0741040219',
    ],
];

$request = $gateway->purchase($parameters);
$response = $request->send();

// Send the Symfony HttpRedirectResponse
$response->send();
