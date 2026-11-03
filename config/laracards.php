<?php

return [
    'renderer' => 'rsvg',
    'fonts' => ['default' => resource_path('fonts/DejaVuSans-Bold.ttf')],
    'templates' => [
        'post' => [
            'file' => 'post.svg',
            'fit' => [
                'title' => ['font' => 'default', 'x' => 72, 'max_width' => 1020, 'max_lines' => 3,
                    'sizes' => [78, 68, 58, 48], 'line_height' => 1.2, 'anchor' => 'top', 'baseline' => 272],
            ],
        ],
    ],
];
