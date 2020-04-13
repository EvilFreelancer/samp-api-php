<?php
require_once __DIR__ . '/../vendor/autoload.php';

$config = new \SampApi\Config([
    'server'   => 'localhost',
    'port'     => '7777',
    'password' => '12345',
]);
$client = new \SampApi\Rcon($config);

// Get list of vars
$response = $client->send('varlist');

dd($response);
