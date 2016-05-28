<?php

namespace LastFm\Model\DataProvider\Artist;

use Interop\Container\ContainerInterface;
use LastFm\Framework\Model\ApiClientInterface;
use LastFm\Framework\Model\DataProvider\Artist\DataProviderInterface;

/**
 * API provider of artist data.
 */
class Api implements DataProviderInterface
{
    /**
     * Api client.
     *
     * @var ApiClientInterface
     */
    protected $apiClient;

    /**
     * Api settings.
     *
     * @var array
     */
    protected $apiSettings;

    /**
     * Constructor.
     *
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        $this->apiClient = $ci->get('apiClient');
        $this->apiSettings = $ci->get('settings')['api'];
    }

    /**
     * {@inheritdoc}
     */
    public function getTopTracks($artist, $mbid = '', $page = 0)
    {
        $responce = $this->apiClient->get($this->apiSettings['url'], [
            'query' => [
                'method' => 'artist.gettoptracks',
                'artist' => $artist,
                'mbid' => $mbid,
                'page' => $page,
                'api_key' => $this->apiSettings['key'],
                'format' => $this->apiSettings['format'],
                'limit' => $this->apiSettings['limit']
            ]
        ]);

        return json_decode($responce->getBody(), true);
    }
}
