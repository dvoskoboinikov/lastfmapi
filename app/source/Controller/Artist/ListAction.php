<?php

namespace LastFm\Controller\Artist;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use LastFm\Framework\Controller\AbstractAction;

/**
 * Artists list action.
 *
 * Displays list of top artists in certain country.
 */
class ListAction extends AbstractAction
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'artist/list.html';

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ) {
        $country = isset($args['country']) ? $args['country'] : '';
        $page = isset($args['page']) ? $args['page'] : 1;

        $data = $this->ci->get('geoDataProvider')->getTopArtists($country, $page);

        return $this->ci->get('view')->render($response, $this->template, ['data' => $data]);
    }
}
