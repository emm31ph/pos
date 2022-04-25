<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u',
            'branch' => 'r,u',
            'lookup' => 'r',

        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            // 'profile' => 'r,u',
            'acl' =>  'c,r,u,d',
            // 'profile' => 'r,u',
            'branch' => 'c,r,u,d',
            'employee' => 'c,r,u,d',
            'lookup' => 'r,u,d',
            'items' => 'c,r,u,d',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
        'role_name' => [
            'module_1_name' => 'c,r,u,d',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'access',
        'u' => 'update',
        'd' => 'delete'
    ]
];
