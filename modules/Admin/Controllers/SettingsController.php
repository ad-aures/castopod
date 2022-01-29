<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use App\Models\ActorModel;
use App\Models\EpisodeCommentModel;
use App\Models\EpisodeModel;
use App\Models\MediaModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\Files\File;
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
            delete_files(media_path('/site'));

            // save original in disk
            $originalFilename = save_media($siteIconFile, 'site', 'icon');

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
        helper('media');

        $allPodcasts = (new PodcastModel())->findAll();
        $imageExt = ['jpg', 'png', 'webp'];

        foreach ($allPodcasts as $podcast) {
            foreach ($imageExt as $ext) {
                $podcastImages = glob(media_path("/podcasts/{$podcast->handle}/*_*{$ext}"));

                if ($podcastImages) {
                    foreach ($podcastImages as $podcastImage) {
                        if (is_file($podcastImage)) {
                            unlink($podcastImage);
                        }
                    }
                }
            }

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

        foreach ($imageExt as $ext) {
            $personsImages = glob(media_path("/persons/*_*{$ext}"));
            if ($personsImages) {
                foreach ($personsImages as $personsImage) {
                    if (is_file($personsImage)) {
                        unlink($personsImage);
                    }
                }
            }
        }

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
        helper('media');

        if ($this->request->getPost('rewrite_media') === 'yes') {
            $imageExt = ['jpg', 'png', 'webp'];
            // Delete all podcast image sizes to recreate them
            $allPodcasts = (new PodcastModel())->findAll();
            foreach ($allPodcasts as $podcast) {
                foreach ($imageExt as $ext) {
                    $podcastImages = glob(media_path("/podcasts/{$podcast->handle}/*_*{$ext}"));

                    if ($podcastImages) {
                        foreach ($podcastImages as $podcastImage) {
                            if (is_file($podcastImage)) {
                                unlink($podcastImage);
                            }
                        }
                    }
                }
            }

            // Delete all person image sizes to recreate them
            foreach ($imageExt as $ext) {
                $personsImages = glob(media_path("/persons/*_*{$ext}"));
                if ($personsImages) {
                    foreach ($personsImages as $personsImage) {
                        if (is_file($personsImage)) {
                            unlink($personsImage);
                        }
                    }
                }
            }

            $allImages = (new MediaModel('image'))->getAllOfType();
            foreach ($allImages as $image) {
                if (str_starts_with($image->file_path, 'podcasts')) {
                    if (str_ends_with($image->file_path, 'banner.jpg') || str_ends_with(
                        $image->file_path,
                        'banner.png'
                    ) || str_ends_with($image->file_path, 'banner.jpeg')) {
                        $image->sizes = config('Images')
                            ->podcastBannerSizes;
                    } else {
                        $image->sizes = config('Images')
                            ->podcastCoverSizes;
                    }
                } elseif (str_starts_with($image->file_path, 'persons')) {
                    $image->sizes = config('Images')
                        ->personAvatarSizes;
                } else {
                    $image->sizes = [];
                }

                $image->setFile(new File(media_path($image->file_path)));

                (new MediaModel('image'))->updateMedia($image);
            }

            $allAudio = (new MediaModel('audio'))->getAllOfType();
            foreach ($allAudio as $audio) {
                $audio->setFile(new File(media_path($audio->file_path)));

                (new MediaModel('audio'))->updateMedia($audio);
            }

            $allTranscripts = (new MediaModel('transcript'))->getAllOfType();
            foreach ($allTranscripts as $transcript) {
                $transcript->setFile(new File(media_path($transcript->file_path)));

                (new MediaModel('transcript'))->updateMedia($transcript);
            }

            $allChapters = (new MediaModel('chapters'))->getAllOfType();
            foreach ($allChapters as $chapters) {
                $chapters->setFile(new File(media_path($chapters->file_path)));

                (new MediaModel('chapters'))->updateMedia($chapters);
            }

            $allVideos = (new MediaModel('video'))->getAllOfType();
            foreach ($allVideos as $video) {
                $video->setFile(new File(media_path($video->file_path)));

                (new MediaModel('video'))->updateMedia($video);
            }

            // reset avatar and banner image urls for each podcast actor
            foreach ($allPodcasts as $podcast) {
                $actorModel = new ActorModel();
                $actor = $actorModel->getActorById($podcast->actor_id);

                if ($actor !== null) {
                    // update values
                    $actor->avatar_image_url = $podcast->cover->federation_url;
                    $actor->avatar_image_mimetype = $podcast->cover->file_mimetype;
                    $actor->cover_image_url = $podcast->banner->federation_url;
                    $actor->cover_image_mimetype = $podcast->banner->file_mimetype;

                    if ($actor->hasChanged()) {
                        $actorModel->update($actor->id, $actor);
                    }
                }
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
