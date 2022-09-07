<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Config;

use App\Libraries\NoteObject;
use Exception;
use Modules\Fediverse\Config\Fediverse as FediverseBaseConfig;

class Fediverse extends FediverseBaseConfig
{
    /**
     * --------------------------------------------------------------------
     * ActivityPub Objects
     * --------------------------------------------------------------------
     */
    public string $noteObject = NoteObject::class;

    public string $defaultAvatarImagePath = 'media/castopod-avatar_thumbnail.webp';

    public string $defaultAvatarImageMimetype = 'image/webp';

    public function __construct()
    {
        parent::__construct();

        try {
            $appTheme = service('settings')
                ->get('App.theme');
            $defaultBanner = config('Images')
                ->podcastBannerDefaultPaths[$appTheme] ?? config('Images')->podcastBannerDefaultPaths['default'];
        } catch (Exception) {
            $defaultBanner = config('Images')
                ->podcastBannerDefaultPaths['default'];
        }

        ['dirname' => $dirname, 'extension' => $extension, 'filename' => $filename] = pathinfo(
            $defaultBanner['path']
        );
        $defaultBannerPath = $filename;
        if ($dirname !== '.') {
            $defaultBannerPathList = [$dirname, $filename];
            $defaultBannerPath = implode('/', $defaultBannerPathList);
        }

        helper('media');

        $this->defaultCoverImagePath = media_path($defaultBannerPath . '_federation.' . $extension);
        $this->defaultCoverImageMimetype = $defaultBanner['mimetype'];
    }
}
