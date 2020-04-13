# SAMP API PHP client

Simple PHP client for San Andreas Multiplayer server for
executing commands on remote console.

    composer require evilfreelancer/samp-api-php

## How to use

```php
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

```

List of all available commands can be found [here](https://wiki.sa-mp.com/wiki/RCON#RCON_Commands).

## Links

Documentation and some important links

* https://wiki.sa-mp.com/wiki/User:Westie/stuff/Query_Mechanism
* https://www.sa-mp.com/

Alternatives

* https://forum.sa-mp.com/showthread.php?t=104299
* https://github.com/Mielnik/samp-api
