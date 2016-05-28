<?php

namespace LastFm\Framework\Model;

use Psr\Http\Message\ResponseInterface;

/**
 * Interface of API client.
 */
interface ApiClientInterface
{
    /**
     * Performs GET HTTP request.
     *
     * @param string $url
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function get($url, $options = []);
}
