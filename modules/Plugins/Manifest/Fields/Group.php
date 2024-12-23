<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest\Fields;

use Modules\Plugins\Manifest\Field;
use Modules\Plugins\Manifest\WithFieldsTrait;
use Override;
use RuntimeException;

class Group extends Field
{
    use WithFieldsTrait;

    public function __construct(string $pluginKey)
    {
        $this->injectRules();

        parent::__construct($pluginKey);
    }

    #[Override]
    public function loadData(array $data): void
    {
        $data = $this->transformData($data);

        parent::loadData($data);
    }

    public function render(string $name, mixed $value, string $class = ''): string
    {
        // TODO: render group, depending on multiple
        throw new RuntimeException('Render function not defined in Group Field class');
    }
}
