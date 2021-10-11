<?php

return [
    'status' => [
        'model' => App\Models\Status::class,
        'attributes' => [
            'show' => [
                'id',
                'name',
            ],
            'store' => [
                'name',
            ],
            'edit' => [
                'name',
            ],
        ]
    ],
    'position' => [
        'model' => App\Models\Position::class,
        'attributes' => [
            'show' => [
                'id',
                'name',
            ],
            'store' => [
                'name',
            ],
            'edit' => [
                'name',
            ],
        ]
    ],
    'programming_level' => [
        'model' => App\Models\ProgrammingLevel::class,
        'attributes' => [
            'show' => [
                'id',
                'name',
            ],
            'store' => [
                'name',
            ],
            'edit' => [
                'name',
            ],
        ]
    ],
];
