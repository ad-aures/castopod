<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics;

use App\Entities\Episode;

class OP3
{
    protected string $host;

    /**
     * @param array<string, string> $config
     */
    public function __construct(array $config)
    {
        $this->host = rtrim($config['host'], '/');
    }

    public function wrap(string $audioURL, Episode $episode): string
    {
        // remove scheme from audioURI if https
        $audioURIWithoutHTTPS = preg_replace('(^https://)', '', $audioURL);

        return $this->host . '/e,pg=' . $episode->podcast->guid . '/' . $audioURIWithoutHTTPS;
    }
}
