<?php
require_once __DIR__ . '/../vendor/autoload.php';

$config = new \SampApi\Config([
    'server'   => 'localhost',
    'port'     => '7777',
    'password' => '12345',
]);
$client = new \SampApi\Rcon($config);

// Get list of vars (only this method is ready for right now)
$response = $client->getVarlist();
dump($response);

// Another way
$response = $client->send('varlist');
dump($response);

// Yet another way, OOP style
$client->responseModel = true;
$response = $client->getVarlist();
dump($response);
