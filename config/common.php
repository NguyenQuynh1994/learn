<?php

return [
    'limit' => [
        'page_limit' => 10,
    ],
    'user' => [
        'avatar_path' => 'upload/',
        'default_avatar' => 'images/default.png',
        'user_limit' => 30,
        'confirmed' => [
            'is_confirm' => 1,
            'not_confirm' => 0,
        ],
        'confirmation_code' => [
            'length' => 10,
        ],
        'role' => [
            'user' => 0,
            'admin' => 1,
        ],
    ],
    'path' => [
        'path_cloud_avatar' => 'learn_el/avatar/',
        'path_cloud_category_image' => 'learn_el/category_image/',
        'path_cloud_word_image' => 'learn_el/word_image/',
    ],
];
