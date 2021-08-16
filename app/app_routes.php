<?php

function getRoutes():array {
    return [
        '' => [
            'GET' => [
                'controller' => 'Controller_Main',
                'action' => 'action_index'
            ],
            'model' => 'Model_Main'
        ],

        'user/register' => [
            'GET' => [
                'controller' => 'Controller_Register',
                'action' => 'registrationForm'
            ],
            'POST' => [
                'controller' => 'Controller_Register',
                'action' => 'registerUser'
            ],
            'model' => 'stdClass'
        ],

        'user/success' => [
            'GET' => [
                'controller' => 'Controller_Register',
                'action' => 'success'
            ],
            'model' => 'stdClass'
        ],
        
        'login' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'loginForm'
            ],
            'POST' => [
                'controller' => 'Controller_Login',
                'action' => 'processLogin'
            ],
            'model' => 'stdClass'
        ],

        'login/success' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'success'
            ],
            'model' => 'stdClass',
            'login' => true
        ],

        'login/error' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'error'
            ],
            'model' => 'stdClass'
        ],

        'logout' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'logout'
            ],
            'model' => 'stdClass'
        ],

        'vk-auth' => [
            'GET' => [
                'controller' => 'Controller_Login',
                'action' => 'vkOauth'
            ],
            'model' => 'stdClass'
        ]
    ];
}