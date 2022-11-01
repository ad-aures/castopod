<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

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
        if ($params === []) {
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
        return view('podcast/platforms\dashboard');
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
            0 => $this->podcast->at_handle,
        ]);

        return view('podcast/platforms', $data);
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
            $podcastPlatformUrl = trim((string) $podcastPlatform['url']);
            if ($podcastPlatformUrl === null) {
                continue;
            }

            if (! $validation->check($podcastPlatformUrl, 'validate_url')) {
                continue;
            }

            $podcastPlatformAccountId = trim((string) $podcastPlatform['account_id']);
            $podcastsPlatformsData[] = [
                'platform_slug' => $platformSlug,
                'podcast_id' => $this->podcast->id,
                'link_url' => $podcastPlatformUrl,
                'account_id' => $podcastPlatformAccountId === '' ? null : $podcastPlatformAccountId,
                'is_visible' =>
                    array_key_exists('visible', $podcastPlatform) &&
                    $podcastPlatform['visible'] === 'yes',
                'is_on_embed' =>
                    array_key_exists('on_embed', $podcastPlatform,) && $podcastPlatform['on_embed'] === 'yes',
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
