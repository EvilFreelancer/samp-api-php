<?php

namespace SampApi\Interfaces;

/**
 * Interface ModelInterface
 *
 * @package SampApi\Interfaces
 */
interface ModelInterface
{
    /**
     * Get model parameter
     *
     * @param string $name
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function get(string $name): string;

    /**
     * Set model parameter
     *
     * @param string $name
     * @param string $value
     *
     * @return \SampApi\Interfaces\ModelInterface
     * @throws \InvalidArgumentException
     */
    public function set(string $name, string $value): ModelInterface;
}
