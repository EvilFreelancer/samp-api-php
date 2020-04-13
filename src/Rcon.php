<?php

namespace SampApi;

use SampApi\Interfaces\ConfigInterface;

/**
 * Class Rcon
 *
 * @package SampApi
 */
class Rcon extends Client
{
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
}
