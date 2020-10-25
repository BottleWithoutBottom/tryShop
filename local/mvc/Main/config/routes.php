<?php

return [
    '/' => [
        'controller' => 'MainController',
        'action' => 'index',

        'children' => [
            '/:id/' => [
                'pattern' => '#^/[0-9]*/$#',
                'maskPattern' => '#^/[0-9]*/$#',
                'controller' => 'MainController',
                'action' => 'index',
            ]
        ]
    ],
    '/catalog/' => [
        'controller' => 'CatalogController',
        'action' => 'index',

        'children' => [
            '/catalog/category/' => [
                'controller' => 'CatalogController',
                'action' => 'categories',
            ],

            '/catalog/category/:category_id/' => [
                'pattern' => '#^/catalog/category/([0-9])*/#',
                'maskPattern' => '#/([0-9])*/#',
                'controller' => 'CatalogController',
                'action' => 'category',
            ],
            '/catalog/new/' => [
                'controller' => 'CatalogController',
                'action' => 'new'
            ],

            '/catalog/sale/' => [
                'controller' => 'CatalogController',
                'action' => 'sale'
            ]
        ]
    ],
    '/account/' => [
        'controller' => 'AccountController',
        'action' => 'index',

        'children' => [
            '/account/login/' => [
                'controller' => 'AccountController',
                'action' => 'login',

                'children' => [
                    '/account/authorize/' => [
                        'controller' => 'AccountController',
                        'action' => 'loginAJAX',
                    ]
                ]
            ],
            '/account/reg/' => [
                'controller' => 'AccountController',
                'action' => 'reg',

                'children' => [
                    '/account/register/' => [
                        'controller' => 'AccountController',
                        'action' => 'registerAJAX'
                    ]
                ]
            ],
            '/account/logout/' => [
                'controller' => 'AccountController',
                'action' => 'logout',
            ]
        ]
    ],
];