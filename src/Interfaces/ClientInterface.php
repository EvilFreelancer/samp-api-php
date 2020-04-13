<?php

namespace SampApi\Interfaces;

/**
 * Interface ClientInterface
 *
 * @package SampApi\Interfaces
 */
interface ClientInterface
{
    /**
     * Connect to remote console
     *
     * @return bool
     */
    public function connect(): bool;

    /**
     * Send packet with command to remote server
     *
     * @param string $command
     * @param float  $delay
     *
     * @return array
     */
    public function send(string $command, float $delay): array;

    /**
     * Assembles a packet from command
     *
     * @param string $command
     *
     * @return string
     */
    public function packetRcon(string $command): string;

    /**
     * Assembles a control packet
     *
     * @param string $state
     *
     * @return string
     */
    public function packetBackbone(string $state): string;

}
