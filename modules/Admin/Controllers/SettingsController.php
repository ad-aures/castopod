<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Models\PersonModel;
use App\Models\PodcastModel;
use CodeIgniter\HTTP\RedirectResponse;
use PHP_ICO;

class SettingsController extends BaseController
{
    public function index(): string
    {
        helper('form');
        return view('settings/general');
    }

    public function attemptInstanceEdit(): RedirectResponse
    {
        $rules = [
            'site_icon' =>
                'is_image[site_icon]|ext_in[site_icon,png,jpeg]|is_image_ratio[site_icon,1,1]|min_dims[image,512,512]|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $siteName = $this->request->getPost('site_name');
        if ($siteName !== service('settings')->get('App.siteName')) {
            service('settings')->set('App.siteName', $siteName);
        }

        $siteDescription = $this->request->getPost('site_description');
        if ($siteDescription !== service('settings')->get('App.siteDescription')) {
            service('settings')->set('App.siteDescription', $siteDescription);
        }

        $siteIconFile = $this->request->getFile('site_icon');
        if ($siteIconFile !== null && $siteIconFile->isValid()) {
            helper(['filesystem', 'media']);

            // delete site folder in media before repopulating it
            delete_files(ROOTPATH . 'public/media/site/');

            // save original in disk
            $originalFilename = save_media($siteIconFile, 'site', 'icon');

            // convert jpeg image to png if not
            if ($siteIconFile->getClientMimeType() !== 'image/png') {
                service('image')->withFile(ROOTPATH . 'public/media/' . $originalFilename)
                    ->convert(IMAGETYPE_JPEG)
                    ->save(ROOTPATH . 'public/media/site/icon.png');
            }

            // generate random hash to use as a suffix to renew browser cache
            $randomHash = substr(bin2hex(random_bytes(18)), 0, 8);

            // generate ico
            $ico_lib = new PHP_ICO();
            $ico_lib->add_image(ROOTPATH . 'public/media/site/icon.png', [[32, 32], [64, 64]]);
            $ico_lib->save_ico(ROOTPATH . "public/media/site/favicon.{$randomHash}.ico");

            // resize original to needed sizes
            foreach ([64, 180, 192, 512] as $size) {
                service('image')
                    ->withFile(ROOTPATH . 'public/media/site/icon.png')
                    ->resize($size, $size)
                    ->save(media_path("/site/icon-{$size}.{$randomHash}.png"));
            }

            service('settings')
                ->set('App.siteIcon', [
                    'ico' => media_path("/site/favicon.{$randomHash}.ico"),
                    '64' => media_path("/site/icon-64.{$randomHash}.png"),
                    '180' => media_path("/site/icon-180.{$randomHash}.png"),
                    '192' => media_path("/site/icon-192.{$randomHash}.png"),
                    '512' => media_path("/site/icon-512.{$randomHash}.png"),
                ]);
        }

        return redirect('settings-general')->with('message', lang('Settings.instance.editSuccess'));
    }

    public function deleteIcon(): RedirectResponse
    {
        helper('filesystem');
        // delete site folder in media
        delete_files(ROOTPATH . 'public/media/site/');

        service('settings')
            ->forget('App.siteIcon');

        return redirect('settings-general')->with('message', lang('Settings.instance.deleteIconSuccess'));
    }

    public function regenerateImages(): RedirectResponse
    {
        $allPodcasts = (new PodcastModel())->findAll();

        foreach ($allPodcasts as $podcast) {
            $podcastImages = glob(ROOTPATH . "public/media/podcasts/{$podcast->handle}/*_*");

            if ($podcastImages) {
                foreach ($podcastImages as $podcastImage) {
                    if (is_file($podcastImage)) {
                        unlink($podcastImage);
                    }
                }
            }
            $podcast->setCover($podcast->cover);
            if ($podcast->banner_path !== null) {
                $podcast->setBanner($podcast->banner);
            }

            foreach ($podcast->episodes as $episode) {
                if ($episode->cover_path !== null) {
                    $episode->setCover($episode->cover);
                }
            }
        }

        $personsImages = glob(ROOTPATH . 'public/media/persons/*_*');
        if ($personsImages) {
            foreach ($personsImages as $personsImage) {
                if (is_file($personsImage)) {
                    unlink($personsImage);
                }
            }
        }

        $persons = (new PersonModel())->findAll();
        foreach ($persons as $person) {
            if ($person->avatar_path !== null) {
                $person->setAvatar($person->avatar);
            }
        }

        return redirect('settings-general')->with('message', lang('Settings.images.regenerationSuccess'));
    }

    public function theme(): string
    {
        helper('form');
        return view('settings/theme');
    }

    public function attemptSetInstanceTheme(): RedirectResponse
    {
        $theme = $this->request->getPost('theme');
        service('settings')
            ->set('App.theme', $theme);

        // delete all pages cache
        cache()
            ->deleteMatching('page*');

        return redirect('settings-theme')->with('message', lang('Settings.theme.setInstanceThemeSuccess'));
    }
}
