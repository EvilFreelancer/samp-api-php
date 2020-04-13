<?php

namespace SampApi;

use SampApi\Interfaces\ModelInterface;

abstract class Model implements ModelInterface
{
    /**
     * List of parameters
     *
     * @var array
     */
    protected array $parameters = [];

    /**
     * Get model parameter
     *
     * @param string $name
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function get(string $name): string
    {
        return $this->parameters[$name];
    }

    /**
     * Set model parameter
     *
     * @param string                     $name
     * @param string|int|bool|float|null $value
     *
     * @return \SampApi\Interfaces\ModelInterface
     * @throws \InvalidArgumentException
     */
    public function set(string $name, $value): ModelInterface
    {
        $this->parameters[$name] = $value;
        return $this;
    }

    /**
     * Get list of all parameters in array format
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->parameters;
    }
}