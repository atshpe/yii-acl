<?php

use acl\model\Role;

return [
    'base' => [
        [
            'controller' => 'app\controllers\SiteController',
            'resources' => [
                'index',
                'login',
                'logout',
                'contact',
                'about',
            ],
            'roles' => [
                Role::USER,
                Role::ADMIN,
            ],
        ],
        [
            'controller' => 'app\controllers\AdminController',
            'resources' => [
                'index',
            ],
            'roles' => [
                Role::ADMIN,
            ],
        ],
    ],
];
