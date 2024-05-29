<?php

declare(strict_types=1);

namespace App\Views\Components\Forms;

use Override;
use ViewComponents\Component;

class Helper extends Component
{
    // TODO: add type with error and show errors inline

    #[Override]
    public function render(): string
    {
        $this->mergeClass('text-skin-muted');

        return <<<HTML
            <small {$this->getStringifiedAttributes()}>{$this->slot}</small>
        HTML;
    }
}
