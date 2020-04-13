<?php

namespace SampApi;

use SampApi\Interfaces\ClientInterface;
use SampApi\Interfaces\ConfigInterface;

/**
 * Class Client
 *
 * @package SampApi
 */
abstract class Client implements ClientInterface
{
    /**
     * Socket connection resource
     *
     * @var resource
     */
    private $socket;

    /**
     * @var \SampApi\Interfaces\ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * Client constructor.
     *
     * @param \SampApi\Interfaces\ConfigInterface $config
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Connect to remote console
     *
     * @return bool
     */
    public function connect(): bool
    {
        $connected    = false;
        $string       = $this->encodeControl('p0101');
        $this->socket = fsockopen('udp://' . $this->config->ip, $this->config->port, $errorNum, $errorString, 2);
        stream_set_timeout($this->socket, 2);
        fwrite($this->socket, $string);
        if (fread($this->socket, 10) && fread($this->socket, 5) === 'p0101') {
            $connected = true;
        }
        return $connected;
    }

    /**
     * Send packet with command to remote server
     *
     * @param string $command
     * @param float  $delay
     *
     * @return array
     */
    public function send(string $command, float $delay = 1.0): array
    {
        $string = $this->encodeCommand($command);
        fwrite($this->socket, $string);

        $result    = [];
        $microtime = microtime(true) + $delay;
        while (microtime(true) < $microtime) {
            $temp = substr(fread($this->socket, 128), 13);
            if ($temp !== '') {
                $result[] = $temp;
            } else {
                break;
            }
        }
        return $result;
    }

    /**
     * Assembles a packet from command
     *
     * @param string $command
     *
     * @return string
     */
    public function encodeCommand(string $command): string
    {
        return
            $this->encodeControl('x')
            . chr(strlen($this->config->password) & 0xFF)
            . chr(strlen($this->config->password) >> 8 & 0xFF)
            . $this->config->password
            . chr(strlen($command) & 0xFF)
            . chr(strlen($command) >> 8 & 0xFF)
            . $command;
    }

    /**
     * Assembles a control packet
     *
     * @param string $state
     *
     * @return string
     */
    public function encodeControl(string $state): string
    {
        return
            'SAMP'
            . chr(strtok($this->config->ip, '.'))
            . chr(strtok('.'))
            . chr(strtok('.'))
            . chr(strtok('.'))
            . chr($this->config->port & 0xFF)
            . chr($this->config->port >> 8 & 0xFF)
            . $state;
    }
}