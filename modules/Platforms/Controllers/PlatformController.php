<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Platforms\Controllers;

use App\Entities\Podcast;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\Admin\Controllers\BaseController;
use Modules\Platforms\Models\PlatformModel;

class PlatformController extends BaseController
{
    protected Podcast $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if ($params === []) {
            return $this->{$method}();
        }

        if (
            ! ($podcast = (new PodcastModel())->getPodcastById((int) $params[0])) instanceof Podcast
        ) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->podcast = $podcast;

        unset($params[0]);
        return $this->{$method}(...$params);
    }

    public function index(): string
    {
        return view('podcast/platforms/dashboard');
    }

    public function platforms(string $platformType): string
    {
        helper('form');

        $data = [
            'podcast'      => $this->podcast,
            'platformType' => $platformType,
            'platforms'    => (new PlatformModel())->getPlatformsWithData($this->podcast->id, $platformType),
        ];

        replace_breadcrumb_params([
            0 => $this->podcast->at_handle,
        ]);

        return view('podcast/platforms', $data);
    }

    public function attemptPlatformsUpdate(string $platformType): RedirectResponse
    {
        $platformModel = new PlatformModel();
        $validation = service('validation');

        $platformsData = [];
        foreach (
            $this->request->getPost('platforms') as $platformSlug => $podcastPlatform
        ) {
            $podcastPlatformUrl = trim((string) $podcastPlatform['url']);
            if ($podcastPlatformUrl === '') {
                continue;
            }

            if (! $validation->check(htmlentities($podcastPlatformUrl), 'valid_url_strict')) {
                continue;
            }

            $podcastPlatformAccountId = trim((string) $podcastPlatform['account_id']);
            $platformsData[] = [
                'podcast_id' => $this->podcast->id,
                'type'       => $platformType,
                'slug'       => $platformSlug,
                'link_url'   => $podcastPlatformUrl,
                'account_id' => $podcastPlatformAccountId === '' ? null : $podcastPlatformAccountId,
                'is_visible' => array_key_exists('visible', $podcastPlatform) &&
                    $podcastPlatform['visible'] === 'yes',
            ];
        }

        $platformModel->savePlatforms($this->podcast->id, $platformType, $platformsData);

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.updateSuccess'));
    }

    public function removePlatform(string $platformType, string $platformSlug): RedirectResponse
    {
        (new PlatformModel())->removePlatform($this->podcast->id, $platformType, $platformSlug);

        return redirect()
            ->back()
            ->with('message', lang('Platforms.messages.removeLinkSuccess'));
    }
}
