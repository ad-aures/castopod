<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\PlatformModel;
use App\Models\PodcastModel;
use Config\Services;

class PodcastSettings extends BaseController
{
    /**
     * @var \App\Entities\Podcast|null
     */
    protected $podcast;

    public function _remap($method, ...$params)
    {
        if (
            !($this->podcast = (new PodcastModel())->getPodcastById($params[0]))
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        unset($params[0]);

        return $this->$method(...$params);
    }

    public function index()
    {
        return view('admin/podcast/settings/dashboard');
    }

    public function platforms()
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
            'platforms' => (new PlatformModel())->getPlatformsWithLinks(
                $this->podcast->id
            ),
        ];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/settings/platforms', $data);
    }

    public function attemptPlatformsUpdate()
    {
        $platformModel = new PlatformModel();
        $validation = Services::validation();

        $platformLinksData = [];
        foreach (
            $this->request->getPost('platforms')
            as $platformName => $platformLink
        ) {
            $platformLinkUrl = $platformLink['url'];
            if (
                !empty($platformLinkUrl) &&
                $validation->check($platformLinkUrl, 'validate_url')
            ) {
                $platformId = $platformModel->getPlatformId($platformName);
                array_push($platformLinksData, [
                    'platform_id' => $platformId,
                    'podcast_id' => $this->podcast->id,
                    'link_url' => $platformLinkUrl,
                    'visible' => array_key_exists('visible', $platformLink)
                        ? $platformLink['visible'] == 'yes'
                        : false,
                ]);
            }
        }

        $platformModel->savePlatformLinks(
            $this->podcast->id,
            $platformLinksData
        );

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.updateSuccess'));
    }

    public function removePlatformLink($platformId)
    {
        (new PlatformModel())->removePlatformLink(
            $this->podcast->id,
            $platformId
        );

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.removeLinkSuccess'));
    }
}
