<?php

namespace SampApi\Interfaces;

/**
 * Interface ConfigInterface
 *
 * @package SampApi\Interfaces
 *
 * @property string $server   Hostname of IP-address of server
 * @property string $port     Port on which remote SAMP work
 * @property string $password Password of server
 * @property string $ip       IP address of server, it will filled automatically of "server" is set
 */
interface ConfigInterface
{
    /**
     * @param string $name
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function get(string $name): string;

    /**
     * @param string $name
     * @param string $value
     *
     * @return \SampApi\Interfaces\ConfigInterface
     * @throws \InvalidArgumentException
     */
    public function set(string $name, string $value): ConfigInterface;
}
