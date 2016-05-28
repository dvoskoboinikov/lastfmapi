<?php

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates', [
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

$container['apiClient'] = function () {
    return new \LastFm\Model\ApiClient();
};

$container['geoDataProvider'] = function ($container) {
    return new \LastFm\Model\DataProvider\Geo\Api($container);
};

$container['artistDataProvider'] = function ($container) {
    return new \LastFm\Model\DataProvider\Artist\Api($container);
};
