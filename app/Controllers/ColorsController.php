<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class ColorsController extends Controller
{
    public function index(): ResponseInterface
    {
        $cacheName = 'colors.css';
        if (
            ! ($colorsCssBody = cache($cacheName))
        ) {
            $colorThemes = config('Colors')
                ->themes;

            $colorsCssBody = '';
            foreach ($colorThemes as $name => $color) {
                $colorsCssBody .= ".theme-{$name} {";
                foreach ($color as $variable => $value) {
                    $colorsCssBody .= "--color-{$variable}: {$value[0]} {$value[1]}% {$value[2]}%;";
                }

                $colorsCssBody .= '}';
            }

            cache()
                ->save($cacheName, $colorsCssBody, DECADE);
        }

        return $this->response->setHeader('Content-Type', 'text/css')
            ->setHeader('charset', 'UTF-8')
            ->setBody($colorsCssBody);
    }
}
