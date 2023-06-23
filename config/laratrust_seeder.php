<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'list_permintaan' => 'c,r,u,d',
            'lop' => 'c,r,u,d',
            'mitra' => 'c,r,u,d'
        ],
        'mitra' => [
            'lop' => 'r,u,d',
            'persiapan' => 'c,r,u,d',
            'instalasi' => 'c,r,u,d',
            'selesai_fisik' => 'c,r,u,d'
        ],
        'optima' => [
            'lop' => 'r,u,d',
            'mitra' => 'r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
