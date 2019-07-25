<?php

namespace App\Service;

use Predis\Client;

/**
 *
 */
class CacheService
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var int
     */
    private $port;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param string $host
     * @param int    $port
     */
    public function __construct(string $host = 'redis', int $port = 6379)
    {
        $this->host = $host;
        $this->port = $port;

        $this->client =
            new Client(
                [
                    'host' => $host,
                    'port' => $port,
                ]
            );
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function get(string $key)
    {
        return $this->client->get($key);
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return mixed
     */
    public function set(string $key, string $value)
    {
        return $this->client->set($key, $value);
    }
}
