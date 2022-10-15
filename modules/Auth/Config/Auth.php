<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use CodeIgniter\Shield\Authentication\Actions\ActionInterface;
use CodeIgniter\Shield\Config\Auth as ShieldAuth;
use Modules\Auth\Models\UserModel;

class Auth extends ShieldAuth
{
    /**
     * ////////////////// AUTHENTICATION //////////////////
     *
     * @var array<string, string>
     */
    public array $views = [
        'login' => 'login',
        'register' => 'register',
        'layout' => '_layout',
        'action_email_2fa' => 'email_2fa_show',
        'action_email_2fa_verify' => 'email_2fa_verify',
        'action_email_2fa_email' => 'emails/email_2fa_email',
        'action_email_activate_show' => 'email_activate_show',
        'action_email_activate_email' => 'emails/email_activate_email',
        'magic-link-login' => 'magic_link_form',
        'magic-link-message' => 'magic_link_message',
        'magic-link-email' => 'emails/magic_link_email',
        'magic-link-set-password' => 'magic_link_set_password',
        'welcome-email' => 'emails/welcome_email',
    ];

    /**
     * --------------------------------------------------------------------
     * Redirect urLs
     * --------------------------------------------------------------------
     * The default URL that a user will be redirected to after
     * various auth actions. If you need more flexibility you can
     * override the `getUrl()` method to apply any logic you may need.
     *
     * @var array<string, string>
     */
    public array $redirects = [
        'register' => '/',
        'login' => '/',
        'logout' => 'login',
    ];

    /**
     * --------------------------------------------------------------------
     * Authentication Actions
     * --------------------------------------------------------------------
     * Specifies the class that represents an action to take after
     * the user logs in or registers a new account at the site.
     *
     * You must register actions in the order of the actions to be performed.
     *
     * Available actions with Shield:
     * - register: 'CodeIgniter\Shield\Authentication\Actions\EmailActivator'
     * - login:    'CodeIgniter\Shield\Authentication\Actions\Email2FA'
     *
     * @var array<string, class-string<ActionInterface>|null>
     */
    public array $actions = [
        'register' => null,
        'login' => null,
    ];

    /**
     * --------------------------------------------------------------------
     * Allow Registration
     * --------------------------------------------------------------------
     * Determines whether users can register for the site.
     */
    public bool $allowRegistration = true;

    /**
     * --------------------------------------------------------------------
     * Welcome Link Lifetime
     * --------------------------------------------------------------------
     * Specifies the amount of time, in seconds, that a welcome link is valid.
     * You can use Time Constants or any desired number.
     */
    public int $welcomeLinkLifetime = 48 * HOUR;

    /**
     * --------------------------------------------------------------------
     * User Provider
     * --------------------------------------------------------------------
     * The name of the class that handles user persistence.
     * By default, this is the included UserModel, which
     * works with any of the database engines supported by CodeIgniter.
     * You can change it as long as they adhere to the
     * CodeIgniter\Shield\Models\UserModel.
     *
     * @var class-string<UserModel>
     */
    public string $userProvider = UserModel::class;

    /**
     * --------------------------------------------------------------------------
     * Auth gateway
     * --------------------------------------------------------------------------
     * Defines a base route for all authentication related pages
     */
    public string $gateway = 'cp-auth';

    public function __construct()
    {
        $adminGateway = config('Admin')
            ->gateway;

        $this->redirects = [
            'register' => $adminGateway,
            'login' => $adminGateway,
            'logout' => $adminGateway,
        ];
    }

    /**
     * Returns the URL that a user should be redirected to after a successful login.
     *
     * Redirects to the set-password form if magicLogin
     */
    public function loginRedirect(): string
    {
        $url = session('magicLogin') ? route_to('magic-link-set-password') : setting('Auth.redirects')['login'];

        return $this->getUrl($url);
    }
}
