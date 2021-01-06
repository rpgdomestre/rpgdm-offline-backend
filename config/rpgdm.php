<?php

$url = env('RPGDM_BASE_URL_LOCAL', 'http://localhost:8888/');

if (env('APP_ENV') === 'stage' || env('APP_ENV') === 'staging') {
    $url = env('RPGDM_BASE_URL_STAGING') ?? throw new \Exception('No staging base url set in .env file');
}

if (env('APP_ENV') === 'prod' || env('APP_ENV') === 'production') {
    $url = env('RPGDM_BASE_URL') ?? throw new \Exception('No production base url set in .env file');
}

return [
    'url' => $url,
    'collections' => [
        'artigos' => [
            'from' => 'artigos', // if not present assume same name as collection
            'to' => 'artigos', // if not present assume same name as collection
            'chunk' => 10, // if not present assume 10,
            'color' => 'pink' // if not present assume black
        ],
        'quizzes' => [],
        'crowdfunding' => [],
        'casts' => [],
    ],
    'contentExtensions' => ['.md']
];
