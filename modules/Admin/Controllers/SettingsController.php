<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

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
                    ->save(ROOTPATH . "public/media/site/icon-{$size}.{$randomHash}.png");
            }

            service('settings')
                ->set('App.siteIcon', [
                    'ico' => "/media/site/favicon.{$randomHash}.ico",
                    '64' => "/media/site/icon-64.{$randomHash}.png",
                    '180' => "/media/site/icon-180.{$randomHash}.png",
                    '192' => "/media/site/icon-192.{$randomHash}.png",
                    '512' => "/media/site/icon-512.{$randomHash}.png",
                ]);
        }

        return redirect()->back();
    }

    public function deleteIcon(): RedirectResponse
    {
        helper('filesystem');
        // delete site folder in media
        delete_files(ROOTPATH . 'public/media/site/');

        service('settings')
            ->forget('App.siteIcon');

        return redirect()->back();
    }
}
