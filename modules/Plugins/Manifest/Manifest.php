<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use CodeIgniter\HTTP\URI;

/**
 * @property string $name
 * @property string $version
 * @property ?string $description
 * @property Person[] $authors
 * @property Person[] $contributors
 * @property ?URI $homepage
 * @property ?string $license
 * @property bool $private
 * @property list<string> $keywords
 * @property list<string> $hooks
 * @property ?Settings $settings
 * @property ?Repository $repository
 */
class Manifest extends ManifestObject
{
    /**
     * @var array<string,string>
     */
    protected const VALIDATION_RULES = [
        'name'        => 'required|max_length[128]|regex_match[/^[a-z0-9]([_.-]?[a-z0-9]+)*\/[a-z0-9]([_.-]?[a-z0-9]+)*$/]',
        'version'     => 'required|regex_match[/^(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(?:-((?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(?:\.(?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?(?:\+([0-9a-zA-Z-]+(?:\.[0-9a-zA-Z-]+)*))?$/]',
        'description' => 'permit_empty|max_length[256]',
        'authors'     => 'permit_empty|is_list',
        'homepage'    => 'permit_empty|valid_url_strict',
        'license'     => 'permit_empty|string',
        'private'     => 'permit_empty|is_boolean',
        'keywords.*'  => 'permit_empty',
        'hooks.*'     => 'permit_empty|in_list[rssBeforeChannel,rssAfterChannel,rssBeforeItem,rssAfterItem,siteHead]',
        'settings'    => 'permit_empty|is_list',
        'repository'  => 'permit_empty|is_list',
    ];

    protected const CASTS = [
        'authors'    => [Person::class],
        'homepage'   => URI::class,
        'settings'   => Settings::class,
        'repository' => Repository::class,
    ];

    protected ?string $name = '???';

    protected ?string $version = 'X.Y.Z';

    protected ?string $description = null;

    /**
     * @var Person[]
     */
    protected array $authors = [];

    protected ?URI $homepage = null;

    protected ?string $license = null;

    protected bool $private = false;

    /**
     * @var list<string>
     */
    protected array $keywords = [];

    /**
     * @var list<string>
     */
    protected array $hooks = [];

    protected ?Settings $settings = null;

    protected ?Repository $repository = null;
}
