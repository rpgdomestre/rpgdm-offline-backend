<?php

return [
    'url' => env('RPGDM_BASE_URL'),
    'collections' => [
        'artigos' => [
            'from' => 'artigos', // if not present assume same name as collection
            'to' => 'artigos' // if not present assume same name as collection
        ],
        'quizzes' => [],
        'crowdfunding' => [],
        'casts' => [],
    ],
];
