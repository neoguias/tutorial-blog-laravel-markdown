<?php

return [
    'collections' => [
        'blog' => [
            'path' => base_path('content/blog'),
            'locales' => ['es'],
            'paths' => ['es' => ''],
            'segments' => ['category' => ['es' => 'categoria'], 'tag' => ['es' => 'etiqueta']],
            'views' => ['index' => 'blog.index', 'show' => 'blog.show', 'category' => 'blog.index', 'tag' => 'blog.index'],
            'per_page' => 6,
            'cards' => ['enabled' => true, 'template' => 'post', 'path' => 'images/blog', 'brand' => 'CUADERNO'],
            'feed' => ['enabled' => true, 'title' => 'Cuaderno', 'description' => 'Apuntes sobre desarrollo y escritura.', 'limit' => 20],
        ],
    ],
    'show_drafts' => false,
    'show_scheduled' => false,
    'cache' => ['enabled' => env('LARABLOG_CACHE', true), 'store' => null],
    'markdown' => ['html_input' => 'strip', 'allow_unsafe_links' => false, 'external_links' => true],
];
