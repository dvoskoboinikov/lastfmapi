<?php

namespace LastFm\Framework\Controller;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Abstract controller action.
 */
abstract class AbstractAction
{
    /**
     * Dependency container.
     *
     * @var ContainerInterface
     */
    protected $ci;

    /**
     * Template file.
     *
     * @var string
     */
    protected $template;

    /**
     * Constructor.
     *
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     */
    abstract public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args
    );
}
