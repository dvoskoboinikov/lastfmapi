<?php

namespace LastFm\Controller\Artist\Track;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use LastFm\Framework\Controller\AbstractAction;

/**
 * Artist tracks list action.
 *
 * Displays top tracks of certain artist.
 */
class ListAction extends AbstractAction
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'artist/track/list.html';

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ) {
        $data = $this->ci->get('artistDataProvider')
            ->getTopTracks($args['artist'], '', isset($args['page']) ? $args['page'] : 1);

        return $this->ci->get('view')->render($response, $this->template, ['data' => $data]);
    }
}
