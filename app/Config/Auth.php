<?php

namespace Config;

class Auth extends \Myth\Auth\Config\Auth
{
    //--------------------------------------------------------------------
    // Views used by Auth Controllers
    //--------------------------------------------------------------------

    public $views = [
        'login' => 'auth/login',
        'register' => 'auth/register',
        'forgot' => 'auth/forgot',
        'reset' => 'auth/reset',
        'emailForgot' => 'auth/emails/forgot',
        'emailActivation' => 'auth/emails/activation',
    ];

    //--------------------------------------------------------------------
    // Layout for the views to extend
    //--------------------------------------------------------------------

    public $viewLayout = 'auth/_layout';

    //--------------------------------------------------------------------
    // Allow User Registration
    //--------------------------------------------------------------------
    // When enabled (default) any unregistered user may apply for a new
    // account. If you disable registration you may need to ensure your
    // controllers and views know not to offer registration.
    //
    public $allowRegistration = false;

    //--------------------------------------------------------------------
    // Require confirmation registration via email
    //--------------------------------------------------------------------
    // When enabled, every registered user will receive an email message
    // with a special link he have to confirm to activate his account.
    //
    public $requireActivation = false;
}
