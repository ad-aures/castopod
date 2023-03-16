<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Entities\Podcast;
use App\Models\ActorModel;
use App\Models\EpisodeCommentModel;
use App\Models\EpisodeModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\Media\Entities\Audio;
use Modules\Media\FileManagers\FileManagerInterface;
use Modules\Media\FileManagers\FS;
use Modules\Media\Models\MediaModel;
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
            delete_files(media_path('/site'));

            // save original in disk
            $originalFilename = (new FS(config('Media')))->save(
                $siteIconFile,
                'site/icon.' . $siteIconFile->getExtension()
            );

            // convert jpeg image to png if not
            if ($siteIconFile->getClientMimeType() !== 'image/png') {
                service('image')->withFile(media_path($originalFilename))
                    ->convert(IMAGETYPE_JPEG)
                    ->save(media_path('/site/icon.png'));
            }

            // generate random hash to use as a suffix to renew browser cache
            $randomHash = substr(bin2hex(random_bytes(18)), 0, 8);

            // generate ico
            $ico_lib = new PHP_ICO();
            $ico_lib->add_image(media_path('/site/icon.png'), [[32, 32], [64, 64]]);
            $ico_lib->save_ico(media_path("/site/favicon.{$randomHash}.ico"));

            // resize original to needed sizes
            foreach ([64, 180, 192, 512] as $size) {
                service('image')
                    ->withFile(media_path('/site/icon.png'))
                    ->resize($size, $size)
                    ->save(media_path("/site/icon-{$size}.{$randomHash}.png"));
            }

            service('settings')
                ->set('App.siteIcon', [
                    'ico' => '/' . media_path("/site/favicon.{$randomHash}.ico"),
                    '64' => '/' . media_path("/site/icon-64.{$randomHash}.png"),
                    '180' => '/' . media_path("/site/icon-180.{$randomHash}.png"),
                    '192' => '/' . media_path("/site/icon-192.{$randomHash}.png"),
                    '512' => '/' . media_path("/site/icon-512.{$randomHash}.png"),
                ]);
        }

        return redirect('settings-general')->with('message', lang('Settings.instance.editSuccess'));
    }

    public function deleteIcon(): RedirectResponse
    {
        helper(['filesystem', 'media']);
        // delete site folder in media
        delete_files(media_path('/site'));

        service('settings')
            ->forget('App.siteIcon');

        return redirect('settings-general')->with('message', lang('Settings.instance.deleteIconSuccess'));
    }

    public function regenerateImages(): RedirectResponse
    {
        /** @var Podcast[] $allPodcasts */
        $allPodcasts = (new PodcastModel())->findAll();

        /** @var FileManagerInterface $fileManager */
        $fileManager = service('file_manager');

        foreach ($allPodcasts as $podcast) {
            $fileManager->deletePodcastImageSizes($podcast->handle);

            $podcast->cover->saveSizes();
            if ($podcast->banner_id !== null) {
                $podcast->banner->saveSizes();
            }

            foreach ($podcast->episodes as $episode) {
                if ($episode->cover_id !== null) {
                    $episode->cover->saveSizes();
                }
            }
        }

        $fileManager->deletePersonImagesSizes();

        $persons = (new PersonModel())->findAll();
        foreach ($persons as $person) {
            if ($person->avatar_id !== null) {
                $person->avatar->saveSizes();
            }
        }

        return redirect('settings-general')->with('message', lang('Settings.images.regenerationSuccess'));
    }

    public function runHousekeeping(): RedirectResponse
    {
        if ($this->request->getPost('reset_counts') === 'yes') {
            // recalculate fediverse counts
            (new ActorModel())->resetFollowersCount();
            (new ActorModel())->resetPostsCount();
            (new PostModel())->setEpisodeIdForRepliesOfEpisodePosts();
            (new PostModel())->resetFavouritesCount();
            (new PostModel())->resetReblogsCount();
            (new PostModel())->resetRepliesCount();
            (new EpisodeModel())->resetCommentsCount();
            (new EpisodeModel())->resetPostsCount();
            (new EpisodeCommentModel())->resetLikesCount();
            (new EpisodeCommentModel())->resetRepliesCount();
        }

        if ($this->request->getPost('clear_cache') === 'yes') {
            cache()->clean();
        }

        if ($this->request->getPost('rename_episodes_files') === 'yes') {
            /** @var Audio[] $allAudio */
            $allAudio = (new MediaModel('audio'))->getAllOfType();

            foreach ($allAudio as $audio) {
                $audio->rename();
            }
        }

        return redirect('settings-general')->with('message', lang('Settings.housekeeping.runSuccess'));
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
