<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use Myth\Auth\Config\Auth as MythAuthConfig;

class Auth extends MythAuthConfig
{
    /**
     * --------------------------------------------------------------------------
     * Views used by Auth Controllers
     * --------------------------------------------------------------------------
     *
     * @var array<string, string>
     */
    public $views = [
        'login' => 'login',
        'register' => 'register',
        'forgot' => 'forgot',
        'reset' => 'reset',
        'emailForgot' => 'emails/forgot',
        'emailActivation' => 'emails/activation',
    ];

    /**
     * --------------------------------------------------------------------------
     * Layout for the views to extend
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $viewLayout = '_layout';

    /**
     * --------------------------------------------------------------------------
     * Allow User Registration
     * --------------------------------------------------------------------------
     * When enabled (default) any unregistered user may apply for a new
     * account. If you disable registration you may need to ensure your
     * controllers and views know not to offer registration.
     *
     * @var bool
     */
    public $allowRegistration = false;

    /**
     * --------------------------------------------------------------------------
     * Auth gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all authentication related pages
     */
    public string $gateway = 'cp-auth';
}
