<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use CodeIgniter\HTTP\URI;
use Exception;
use Override;

/**
 * @property string $name
 * @property ?string $email
 * @property ?URI $url
 */
class Person extends ManifestObject
{
    protected const AUTHOR_STRING_PATTERN = '/^(?<name>[^<>()]*)\s*(<(?<email>.*)>)?\s*(\((?<url>.*)\))?$/';

    public static array $validation_rules = [
        'name'  => 'required',
        'email' => 'permit_empty|valid_email',
        'url'   => 'permit_empty|valid_url_strict',
    ];

    /**
     * @var array<string,array{string}|string>
     */
    protected array $casts = [
        'url' => URI::class,
    ];

    protected string $name;

    protected ?string $email = null;

    protected ?URI $url = null;

    #[Override]
    public function loadData(array|string $data): void
    {
        if (is_string($data)) {
            $result = preg_match(self::AUTHOR_STRING_PATTERN, $data, $matches);

            if (! $result) {
                throw new Exception('Author string is not valid.');
            }

            $data = [
                'name'  => $matches['name'],
                'email' => $matches['email'] ?? null,
                'url'   => $matches['url'] ?? null,
            ];
        }

        parent::loadData($data);
    }
}
