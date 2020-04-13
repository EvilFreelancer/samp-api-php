<?php

namespace SampApi;

use SampApi\Interfaces\ConfigInterface;
use SampApi\Interfaces\ModelInterface;
use SampApi\Interfaces\RconInterface;
use SampApi\Models\Varlist;

/**
 * Class Rcon
 *
 * @package SampApi
 */
class Rcon extends Client implements RconInterface
{
    /**
     * Response of methods is models
     *
     * @var bool
     */
    public bool $responseModel = false;

    /**
     * Rcon constructor.
     *
     * @param \SampApi\Interfaces\ConfigInterface $config
     * @param bool                                $autoconnect
     */
    public function __construct(ConfigInterface $config, bool $autoconnect = true)
    {
        parent::__construct($config);

        // If need connect after creating object
        if ($autoconnect) {
            $this->connect();
        }
    }

    /**
     * Get list of server variables
     *
     * @return \SampApi\Models\Varlist|array
     */
    public function getVarlist()
    {
        $response = $this->send('varlist');
        $result   = new Varlist();

        foreach ($response as $item) {
            if (strpos($item, "\t") === false) {
                continue 1;
            }
            $tmp = explode('=', $item);
            $key = trim($tmp[0]);

            $value = trim($tmp[1]);
            $value = preg_replace(['/ \(read-only\)| \(rule\)/'], '', $value);

            preg_match('/(.*) \(([a-zA-Z]{3,6})\)/', $value, $type);
            if ($type[2] === 'int') {
                $value = (int) $type[1];
            } elseif ($type[2] === 'bool') {
                $value = (bool) $type[1];
            } elseif ($type[2] === 'float') {
                $value = (float) $type[1];
            } else {
                $value = (string) trim($type[1], " \t\n\r\0\x0B\"") ?: null;
            }

            $result->set($key, $value);
        }

        return $this->responseModel ? $result : $result->toArray();
    }
}
