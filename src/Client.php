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
        $this->socket = stream_socket_client('udp://' . $this->config->ip . ':' . $this->config->port, $errorcode, $errormsg);
        stream_set_timeout($this->socket, 2);
        $string = $this->packetBackbone('p0101');
        fwrite($this->socket, $string);
        if (fread($this->socket, 10) && fread($this->socket, 5) === 'p0101') {
            return true;
        }
        $this->socket = null;
        throw new \RuntimeException("Unable to connect to remote server \"udp://{$this->config->ip}:{$this->config->port}\"");
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
        $string = $this->packetRcon($command);
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
     * @link https://wiki.sa-mp.com/wiki/Query_Mechanism#RCON_Packets
     */
    public function packetRcon(string $command): string
    {
        return
            $this->packetBackbone('x')
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
     * @link https://wiki.sa-mp.com/wiki/Query_Mechanism#The_backbone_of_packets
     */
    public function packetBackbone(string $state): string
    {
        $ip = explode('.', $this->config->ip);

        return
            'SAMP'
            . chr($ip[0])
            . chr($ip[1])
            . chr($ip[2])
            . chr($ip[3])
            . chr($this->config->port & 0xFF)
            . chr($this->config->port >> 8 & 0xFF)
            . $state;
    }
}