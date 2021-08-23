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
        'login' => 'Modules\Auth\Views\login',
        'register' => 'Modules\Auth\Views\register',
        'forgot' => 'Modules\Auth\Views\forgot',
        'reset' => 'Modules\Auth\Views\reset',
        'emailForgot' => 'Modules\Auth\Views\emails\forgot',
        'emailActivation' => 'Modules\Auth\Views\emails\activation',
    ];

    /**
     * --------------------------------------------------------------------------
     * Layout for the views to extend
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $viewLayout = 'Modules\Auth\Views\_layout';

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
     * Require confirmation registration via email
     * --------------------------------------------------------------------------
     * When enabled, every registered user will receive an email message
     * with a special link he have to confirm to activate his account.
     *
     * @var bool
     */
    public $requireActivation = false;

    /**
     * --------------------------------------------------------------------------
     * Auth gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all authentication related pages
     */
    public string $gateway = 'cp-auth';
}
