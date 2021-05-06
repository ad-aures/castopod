<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Entities\Podcast;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\PlatformModel;
use App\Models\PodcastModel;
use Config\Services;

class PodcastPlatform extends BaseController
{
    /**
     * @var Podcast|null
     */
    protected $podcast;

    public function _remap($method, ...$params)
    {
        if (count($params) === 0) {
            return $this->$method();
        }

        if ($this->podcast = (new PodcastModel())->getPodcastById($params[0])) {
            unset($params[0]);
            return $this->$method(...$params);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index()
    {
        return view('admin/podcast/platforms/dashboard');
    }

    public function platforms($platformType)
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
            'platformType' => $platformType,
            'platforms' => (new PlatformModel())->getPlatformsWithLinks(
                $this->podcast->id,
                $platformType,
            ),
        ];

        replace_breadcrumb_params([0 => $this->podcast->title]);
        return view('admin/podcast/platforms', $data);
    }

    public function attemptPlatformsUpdate($platformType)
    {
        $platformModel = new PlatformModel();
        $validation = Services::validation();

        $podcastsPlatformsData = [];

        foreach (
            $this->request->getPost('platforms')
            as $platformSlug => $podcastPlatform
        ) {
            $podcastPlatformUrl = $podcastPlatform['url'];
            if (empty($podcastPlatformUrl)) {
                continue;
            }
            if (!$validation->check($podcastPlatformUrl, 'validate_url')) {
                continue;
            }
            $podcastsPlatformsData[] = [
                'platform_slug' => $platformSlug,
                'podcast_id' => $this->podcast->id,
                'link_url' => $podcastPlatformUrl,
                'link_content' => $podcastPlatform['content'],
                'is_visible' =>
                    array_key_exists('visible', $podcastPlatform) &&
                    $podcastPlatform['visible'] == 'yes',
                'is_on_embeddable_player' =>
                    array_key_exists(
                        'on_embeddable_player',
                        $podcastPlatform,
                    ) && $podcastPlatform['on_embeddable_player'] == 'yes',
            ];
            return redirect()
                ->back()
                ->with('message', lang('Platforms.messages.updateSuccess'));
        }

        $platformModel->savePodcastPlatforms(
            $this->podcast->id,
            $platformType,
            $podcastsPlatformsData,
        );

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.updateSuccess'));
    }

    public function removePodcastPlatform($platformSlug)
    {
        (new PlatformModel())->removePodcastPlatform(
            $this->podcast->id,
            $platformSlug,
        );

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.removeLinkSuccess'));
    }
}
