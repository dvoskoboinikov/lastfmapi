<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'api' => [
            'url' => 'http://ws.audioscrobbler.com/2.0/',
            'key' => '6e39d708841157eee55196a0c53af7bb',
            'format' => 'json',
            'limit' => 8
        ]
    ]
];
