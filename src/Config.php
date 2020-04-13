<?php

namespace SampApi;

use SampApi\Interfaces\ConfigInterface;

/**
 * Class Config
 *
 * @package SampApi
 */
class Config implements ConfigInterface
{
    /**
     * List of allowed parameters
     */
    public const ALLOWED = ['server', 'port', 'password', 'ip'];

    /**
     * List of parameters
     *
     * @var array
     */
    public array $parameters = [
        'port' => '7777', // Default value
    ];

    public function __construct(array $parameters = [])
    {
        foreach ($parameters as $name => $value) {
            $this->set($name, $value);
        }
    }

    /**
     * @param string $name
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function get(string $name): string
    {
        if (!in_array($name, self::ALLOWED, true)) {
            throw new \InvalidArgumentException("Parameter \"$name\" is not allowed");
        }

        return (string) $this->parameters[$name];
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return \SampApi\Interfaces\ConfigInterface
     * @throws \InvalidArgumentException
     */
    public function set(string $name, string $value): ConfigInterface
    {
        if (!in_array($name, self::ALLOWED, true)) {
            throw new \InvalidArgumentException("Parameter \"$name\" is not allowed");
        }

        $this->parameters[$name] = $value;

        if (mb_strtolower(trim($name)) === 'server') {
            $this->parameters['ip'] = gethostbyname($value);
        }

        return $this;
    }

    /**
     * Magic alias to `->get()`
     *
     * @param string $name
     *
     * @return string
     */
    public function __get(string $name): string
    {
        return $this->get($name);
    }

    /**
     * Magic alias to `->set()`
     *
     * @param string $name
     * @param string $value
     */
    public function __set(string $name, string $value): void
    {
        $this->set($name, $value);
    }

    /**
     * Check if parameter is set
     *
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->parameters[$name]);
    }
}
