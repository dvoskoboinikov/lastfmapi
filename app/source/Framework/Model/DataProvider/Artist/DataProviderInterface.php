<?php

namespace LastFm\Framework\Model\DataProvider\Artist;

/**
 * Intrface for provider of artist data.
 */
interface DataProviderInterface
{
    /**
     * Gets top tracks by artist name or mbid.
     *
     * @param string $artist The artist name.
     * @param string $mbid The musicbrainz Id for the artist.
     *
     * @return array
     */
    public function getTopTracks($artist, $mbid = '', $page = 0);
}
