<?php

declare(strict_types=1);

namespace Config;

use App\Filters\AllowCorsFilter;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use Modules\Auth\Filters\PermissionFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     *                                                     or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'allow-cors'    => AllowCorsFilter::class,
    ];

    /**
     * List of filter aliases that are always applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => [
                'except' => ['@[a-zA-Z0-9\_]{1,32}/inbox'],
            ],
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a particular HTTP method (GET, POST, etc.).
     *
     * Example: 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing permits any HTTP method to access a
     * controller. Accessing the controller with a method you don’t expect could bypass the filter.
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
            'session' => [
                'before' => [config('Admin')->gateway . '*', config('Analytics')->gateway . '*'],
            ],
            'podcast-unlock' => [
                'before' => ['*@*/episodes/*'],
            ],
        ];

        $this->aliases['permission'] = PermissionFilter::class;
    }
}
