<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use Modules\Auth\Filters\PermissionFilter;
use Modules\Fediverse\Filters\ActivityPubFilter;
use Myth\Auth\Filters\LoginFilter;
use Myth\Auth\Filters\RoleFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to make reading things nicer and simpler.
     *
     * @var array<string, string>
     */
    public array $aliases = [
        'csrf' => CSRF::class,
        'toolbar' => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'login' => LoginFilter::class,
        'role' => RoleFilter::class,
        'permission' => PermissionFilter::class,
        'activity-pub' => ActivityPubFilter::class,
    ];

    /**
     * List of filter aliases that are always applied before and after every request.
     *
     * @var array<string, string[]>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a particular HTTP method (GET, POST, etc.).
     *
     * Example: 'post' => ['csrf', 'throttle']
     *
     * @var array<string, string[]>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any before or after URI patterns.
     *
     * Example: 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, string[]>>
     */
    public array $filters = [];

    public function __construct()
    {
        parent::__construct();

        $this->filters = [
            'login' => [
                'before' => [config('Admin') ->gateway . '*', config('Analytics') ->gateway . '*'],
            ],
        ];
    }
}
