<?php

return [
    'user' => [
        'model' => App\Models\User::class,
        'attributes' => [
            'show' => [
                'id',
                'name',
                'email',
                'is_admin',
                'created_at',
                'updated_at',
            ],
            'store' => [
                'name',
                'email',
                'password',
                'is_admin'
            ],
            'edit' => [
                'name',
                'email',
                'is_admin',
            ],
        ]
    ],
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
    'postition' => [
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
    'programming-level' => [
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
