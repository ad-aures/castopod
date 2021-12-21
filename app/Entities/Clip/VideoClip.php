<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities\Clip;

/**
 * @property string $theme
 */
class VideoClip extends BaseClip
{
    protected string $type = 'video';

    public function __construct(array $data = null)
    {
        parent::__construct($data);

        if ($this->metadata !== null) {
            $this->theme = $this->metadata['theme'];
            $this->format = $this->metadata['format'];
        }
    }
}
