<?php
/**
 * Configuration array for application
 */
use Guz\Rest\Api\Controllers\UserController;

return [

    'autoload' => [
        /*
         * Please, add  Namespace prefixes and Directories just like in PSR-4 composer loader.
         * ex: "Foo\\Bar\\" => "dir/"
         */
        "Guz\\Rest\\" => "app/"
    ],

    'baseauth' => [
        /*
         * Logins and passwords for base authentication
         * 'login'=>'password'
         */
        'admin' => 'AJKiuuf57854',
        'leha' => 'leha123',
        'pupkin' => 'fddffqwer554'
    ],
    'routing' => [
        /*
         * Application routes
         * example:
         * 'TYPE OF REQUEST[GET,POST<DELETE]' = [
         *        //Url with starting slash ex: "/get/something"
         *        //If you need some request with id put it as parameter with <:param_name> ex: "/get/<:id>"
         *        'url' => [
         *         'class' => FSCN
         *         ]
         *   ]
         */
        'GET' => [
            '/get/users'    => [
                'class'  => UserController::class,
                'action' => 'getUsersAction'
            ],
            '/get/user/<:user_id>' => [
                'class'  => UserController::class ,
                'action' =>'getUserAction',
            ]
        ]
    ]
];