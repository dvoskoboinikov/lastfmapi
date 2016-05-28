<?php

$app->get(
    '/',
    'LastFm\Controller\Index\IndexAction'
)->setName('index');

$app->get(
    '/artist/list[/[{country}[/[{page}]]]]',
    'LastFm\Controller\Artist\ListAction'
)->setName('artist.list');

$app->get(
    '/artist/track/list[/[{artist}[/[{page}]]]]',
    'LastFm\Controller\Artist\Track\ListAction'
)->setName('artist.track.list');
