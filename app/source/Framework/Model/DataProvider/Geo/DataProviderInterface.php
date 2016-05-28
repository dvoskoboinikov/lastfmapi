<?php

namespace LastFm\Framework\Model\DataProvider\Geo;

/**
 * Intrface for provider of Geo data.
 */
interface DataProviderInterface
{
    /**
     * Gets top artists by country name.
     *
     * Country name should be provided according to
     * ISO 3166-1 country names standard.
     *
     * @param string $country
     * @param int $page
     *
     * @return array
     */
    public function getTopArtists($country, $page = 0);
}
