<?php

return [
    'url' => env('RPGDM_BASE_URL'),
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
];
