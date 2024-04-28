<?php

declare(strict_types=1);

use Modules\Admin\Controllers\BaseController;

class Controller extends BaseController
{
    public function index(): string
    {
        $plugins = service('plugins');

        return view('plugins', [
            'installedPlugins' => $plugins->getInstalled(),
        ]);
    }
}
