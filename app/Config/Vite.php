<?php

// app/Config/Vite.php

declare(strict_types=1);

namespace Config;

use CodeIgniterVite\Config\Vite as ViteConfig;

class Vite extends ViteConfig
{
    public function __construct()
    {
        parent::__construct();

        $adminGateway = config('Admin')
            ->gateway;
        $installGateway = config('Install')
            ->gateway;

        $this->routesAssets = [
            [
                'routes'  => ['*'],
                'exclude' => [$adminGateway . '*', $installGateway . '*'],
                'assets'  => ['styles/site.css', 'js/app.ts', 'js/podcast.ts', 'js/audio-player.ts'],
            ],
            [
                'routes' => ['/map'],
                'assets' => ['js/map.ts'],
            ],
            [
                'routes' => ['/' . $adminGateway . '*'],
                'assets' => ['styles/admin.css', 'js/admin.ts', 'js/admin-audio-player.ts'],
            ],
            [
                'routes' => [$installGateway . '*'],
                'assets' => ['styles/install.css'],
            ],
        ];
    }
}
