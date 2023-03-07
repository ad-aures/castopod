<?php

declare(strict_types=1);

namespace Modules\Auth\Config;

use App\Models\PodcastModel;
use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'podcaster';

    /**
     * --------------------------------------------------------------------
     * Most powerful Group
     * --------------------------------------------------------------------
     * The group that a has the most permissions.
     */
    public string $mostPowerfulGroup = 'superadmin';

    /**
     * --------------------------------------------------------------------
     * Default Podcast Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultPodcastGroup = 'guest';

    /**
     * --------------------------------------------------------------------
     * Most powerful Podcast Group
     * --------------------------------------------------------------------
     * The group that a has the most permissions on a podcast.
     */
    public string $mostPowerfulPodcastGroup = 'admin';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * The available authentication systems, listed
     * with alias and class name. These can be referenced
     * by alias in the auth helper:
     *      auth('api')->attempt($credentials);
     *
     * @var array<string, array<string, string>>
     */
    public array $groups = [];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system. Each system is defined
     * where the key is the
     *
     * If a permission is not listed here it cannot be used.
     *
     * @var array<string, string>
     */
    public array $permissions = [];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     * @var array<string, array<string>>
     */
    public array $matrix = [];

    /**
     * @var array<string, array<string, string>>
     */
    public array $instanceGroups = [];

    /**
     * @var array<string, string>
     */
    public array $instancePermissions = [];

    /**
     * @var array<string, array<string, string>>
     */
    public array $podcastGroups = [];

    /**
     * @var array<string, string>
     */
    public array $podcastPermissions = [];

    /**
     * @var string[]
     */
    public array $instanceBaseGroups = ['superadmin', 'manager', 'podcaster'];

    /**
     * @var string[]
     */
    public array $instanceBasePermissions = [
        'admin.access',
        'admin.settings',
        'users.manage',
        'persons.manage',
        'pages.manage',
        'podcasts.view',
        'podcasts.create',
        'podcasts.import',
        'fediverse.manage-blocks',
    ];

    /**
     * @var array<string, array<string>>
     */
    public array $instanceMatrix = [
        'superadmin' => [
            'admin.*',
            'podcasts.*',
            'users.manage',
            'persons.manage',
            'pages.manage',
            'fediverse.manage-blocks',
        ],
        'manager' => ['podcasts.create', 'podcasts.import', 'persons.manage', 'pages.manage'],
        'podcaster' => ['admin.access'],
    ];

    /**
     * @var string[]
     */
    public array $podcastBaseGroups = ['admin', 'editor', 'author', 'guest'];

    /**
     * @var string[]
     */
    public array $podcastBasePermissions = [
        'view',
        'edit',
        'delete',
        'manage-import',
        'manage-persons',
        'manage-subscriptions',
        'manage-contributors',
        'manage-platforms',
        'manage-publications',
        'manage-notifications',
        'interact-as',
        'episodes.view',
        'episodes.create',
        'episodes.edit',
        'episodes.delete',
        'episodes.manage-persons',
        'episodes.manage-clips',
        'episodes.manage-publications',
        'episodes.manage-comments',
    ];

    /**
     * @var array<string, string[]>
     */
    public array $podcastMatrix = [
        'admin' => ['*'],
        'editor' => [
            'view',
            'edit',
            'manage-import',
            'manage-persons',
            'manage-platforms',
            'manage-publications',
            'manage-notifications',
            'interact-as',
            'episodes.view',
            'episodes.create',
            'episodes.edit',
            'episodes.delete',
            'episodes.manage-persons',
            'episodes.manage-clips',
            'episodes.manage-publications',
            'episodes.manage-comments',
        ],
        'author' => [
            'view',
            'manage-persons',
            'episodes.view',
            'episodes.create',
            'episodes.edit',
            'episodes.manage-persons',
            'episodes.manage-clips',
        ],
        'guest' => ['view', 'episodes.view'],
    ];

    /**
     * Fill groups, permissions and matrix based on
     */
    public function __construct($locale = null)
    {
        parent::__construct();

        foreach ($this->instanceBaseGroups as $group) {
            $this->instanceGroups[$group] = [
                'title' => lang("Auth.instance_groups.{$group}.title"),
                'description' => lang("Auth.instance_groups.{$group}.description"),
            ];
        }

        $this->groups = $this->instanceGroups;

        foreach ($this->instanceBasePermissions as $permission) {
            $this->instancePermissions[$permission] = lang("Auth.instance_permissions.{$permission}");
            $this->permissions[$permission] = lang("Auth.instance_permissions.{$permission}");
        }

        $this->matrix = $this->instanceMatrix;

        $this->generateBasePodcastAuthorizations();

        /**
         * For each podcast, include podcast groups, permissions, and matrix into $groups, $permissions, and $matrix
         * attributes.
         */
        $podcasts = (new PodcastModel())->findAll();
        foreach ($podcasts as $podcast) {
            $this->generatePodcastAuthorizations($podcast->id, $locale);
        }
    }

    public function generateBasePodcastAuthorizations(): void
    {
        foreach ($this->podcastBaseGroups as $group) {
            $this->podcastGroups[$group] = [
                'title' => lang("Auth.podcast_groups.{$group}.title", [
                    'id' => '{id}',
                ]),
                'description' => lang("Auth.podcast_groups.{$group}.description", [
                    'id' => '{id}',
                ]),
            ];
        }

        foreach ($this->podcastBasePermissions as $permission) {
            $this->podcastPermissions[$permission] = lang("Auth.podcast_permissions.{$permission}", [
                'id' => '{id}',
            ]);
            $this->permissions[$permission] = lang("Auth.podcast_permissions.{$permission}", [
                'id' => '{id}',
            ]);
        }
    }

    public function generatePodcastAuthorizations(int $podcastId): void
    {
        foreach ($this->podcastBaseGroups as $group) {
            $podcastGroup = 'podcast#' . $podcastId . '-' . $group;
            $this->groups[$podcastGroup] = [
                'title' => lang("Auth.podcast_groups.{$group}.title", [
                    'id' => $podcastId,
                ]),
                'description' => lang("Auth.podcast_groups.{$group}.description", [
                    'id' => $podcastId,
                ]),
            ];
        }

        foreach ($this->podcastBasePermissions as $permission) {
            $podcastPermission = 'podcast#' . $podcastId . '.' . $permission;
            $this->permissions[$podcastPermission] = lang("Auth.podcast_permissions.{$permission}", [
                'id' => $podcastId,
            ]);
        }

        foreach ($this->podcastMatrix as $group => $permissionWildcards) {
            $podcastGroup = 'podcast#' . $podcastId . '-' . $group;
            foreach ($permissionWildcards as $permissionWildcard) {
                $podcastPermissionWildcard = 'podcast#' . $podcastId . '.' . $permissionWildcard;
                $this->matrix[$podcastGroup][] = $podcastPermissionWildcard;
            }
        }
    }
}
