<?php

namespace LastFm\Controller\Index;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use LastFm\Framework\Controller\AbstractAction;

/**
 * Index action.
 *
 * Displays homepage.
 */
class IndexAction extends AbstractAction
{
    /**
     * {@inheritdoc}
     */
    protected $template = 'index/index.html';

    /**
     * {@inheritdoc}
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    ) {
        return $this->ci->get('view')->render($response, $this->template);
    }
}
