<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Entities\Podcast;
use App\Models\PlatformModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;

class PodcastPlatformController extends BaseController
{
    protected ?Podcast $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) === 0) {
            return $this->{$method}();
        }

        if (
            ($this->podcast = (new PodcastModel())->getPodcastById((int) $params[0])) !== null
        ) {
            unset($params[0]);
            return $this->{$method}(...$params);
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        return view('admin/podcast/platforms/dashboard');
    }

    public function platforms(string $platformType): string
    {
        helper('form');

        $data = [
            'podcast' => $this->podcast,
            'platformType' => $platformType,
            'platforms' => (new PlatformModel())->getPlatformsWithLinks($this->podcast->id, $platformType),
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->title,
        ]);
        return view('admin/podcast/platforms', $data);
    }

    public function attemptPlatformsUpdate(string $platformType): RedirectResponse
    {
        $platformModel = new PlatformModel();
        $validation = Services::validation();

        $podcastsPlatformsData = [];

        foreach (
            $this->request->getPost('platforms')
            as $platformSlug => $podcastPlatform
        ) {
            $podcastPlatformUrl = $podcastPlatform['url'];
            if ($podcastPlatformUrl === null) {
                continue;
            }
            if (! $validation->check($podcastPlatformUrl, 'validate_url')) {
                continue;
            }
            $podcastsPlatformsData[] = [
                'platform_slug' => $platformSlug,
                'podcast_id' => $this->podcast->id,
                'link_url' => $podcastPlatformUrl,
                'link_content' => $podcastPlatform['content'],
                'is_visible' =>
                    array_key_exists('visible', $podcastPlatform) &&
                    $podcastPlatform['visible'] === 'yes',
                'is_on_embeddable_player' =>
                    array_key_exists(
                        'on_embeddable_player',
                        $podcastPlatform,
                    ) && $podcastPlatform['on_embeddable_player'] === 'yes',
            ];
        }

        $platformModel->savePodcastPlatforms($this->podcast->id, $platformType, $podcastsPlatformsData);

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.updateSuccess'));
    }

    public function removePodcastPlatform(string $platformSlug): RedirectResponse
    {
        (new PlatformModel())->removePodcastPlatform($this->podcast->id, $platformSlug);

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.removeLinkSuccess'));
    }
}
