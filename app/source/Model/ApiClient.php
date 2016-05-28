<?php

namespace LastFm\Model;

use GuzzleHttp\Client;
use LastFm\Framework\Model\ApiClientInterface;

/**
 * API client.
 */
class ApiClient implements ApiClientInterface
{
    /**
     * Http client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * {@inheritdoc}
     */
    public function get($url, $options = [])
    {
        return $this->client->get($url, $options);
    }
}
