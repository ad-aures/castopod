<?php

declare(strict_types=1);

namespace Modules\Plugins\Manifest;

use Override;

class Fields extends ManifestObject
{
    #[Override]
    public function loadData(array $data): void
    {
        dd($data);
    }
}
