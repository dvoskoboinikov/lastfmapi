<?php

namespace LastFm\Model\DataProvider\Geo;

use Interop\Container\ContainerInterface;
use LastFm\Framework\Model\ApiClientInterface;
use LastFm\Framework\Model\DataProvider\Geo\DataProviderInterface;

/**
 * API provider of Geo data.
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
    public function getTopArtists($country, $page = 0)
    {
        $responce = $this->apiClient->get($this->apiSettings['url'], [
            'query' => [
                'method' => 'geo.gettopartists',
                'country' => $country,
                'page' => $page,
                'api_key' => $this->apiSettings['key'],
                'format' => $this->apiSettings['format'],
                'limit' => $this->apiSettings['limit']
            ]
        ]);

        return $this->normalizeData(json_decode($responce->getBody(), true));
    }

    /**
     * Fixes Last.fm bug with page #4.
     *
     * On page #4 Last.fm returns 32 items instead of 8.
     *
     * @param array $data
     *
     * @return array
     */
    protected function normalizeData(array $data)
    {
        if (isset($data['topartists'])) {
            if (count($data['topartists']['artist']) > $this->apiSettings['limit']) {
                $data['topartists']['artist'] =
                    array_slice($data['topartists']['artist'], $this->apiSettings['limit'] * -1);
            }
        }

        return $data;
    }
}
