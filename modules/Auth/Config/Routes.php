<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

$routes = service('routes');

/**
 * Overwriting Myth:auth routes file
 */
$routes->group(
    config('Auth')
        ->gateway,
    [
        'namespace' => 'Modules\Auth\Controllers',
    ],
    function ($routes): void {
        // Login/out
        $routes->get('login', 'AuthController::login', [
            'as' => 'login',
        ]);
        $routes->post('login', 'AuthController::attemptLogin');
        $routes->get('logout', 'AuthController::logout', [
            'as' => 'logout',
        ]);

        // Registration
        $routes->get('register', 'AuthController::register', [
            'as' => 'register',
        ]);
        $routes->post('register', 'AuthController::attemptRegister');

        // Activation
        $routes->get('activate-account', 'AuthController::activateAccount', [
            'as' => 'activate-account',
        ]);
        $routes->get(
            'resend-activate-account',
            'AuthController::resendActivateAccount',
            [
                'as' => 'resend-activate-account',
            ],
        );

        // Forgot/Resets
        $routes->get('forgot', 'AuthController::forgotPassword', [
            'as' => 'forgot',
        ]);
        $routes->post('forgot', 'AuthController::attemptForgot');
        $routes->get('reset-password', 'AuthController::resetPassword', [
            'as' => 'reset-password',
        ]);
        $routes->post('reset-password', 'AuthController::attemptReset');

        // interacting as an actor
        $routes->post('interact-as-actor', 'AuthController::attemptInteractAsActor', [
            'as' => 'interact-as-actor',
        ]);
    }
);
