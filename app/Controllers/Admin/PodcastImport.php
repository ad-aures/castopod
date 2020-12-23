<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\PodcastModel;
use App\Models\EpisodeModel;
use App\Models\PlatformModel;
use Config\Services;
use League\HTMLToMarkdown\HtmlConverter;

class PodcastImport extends BaseController
{
    /**
     * @var \App\Entities\Podcast|null
     */
    protected $podcast;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            if (
                !($this->podcast = (new PodcastModel())->getPodcastById(
                    $params[0]
                ))
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function index()
    {
        helper(['form', 'misc']);

        $languageOptions = (new LanguageModel())->getLanguageOptions();
        $categoryOptions = (new CategoryModel())->getCategoryOptions();

        $data = [
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
            'browserLang' => get_browser_language(
                $this->request->getServer('HTTP_ACCEPT_LANGUAGE')
            ),
        ];

        return view('admin/podcast/import', $data);
    }

    public function attemptImport()
    {
        helper(['media', 'misc']);

        $rules = [
            'imported_feed_url' => 'required|validate_url',
            'season_number' => 'is_natural_no_zero|permit_empty',
            'max_episodes' => 'is_natural_no_zero|permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        try {
            $feed = simplexml_load_file(
                $this->request->getPost('imported_feed_url')
            );
        } catch (\ErrorException $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    $ex->getMessage() .
                    ': <a href="' .
                    $this->request->getPost('imported_feed_url') .
                    '" rel="noreferrer noopener" target="_blank">' .
                    $this->request->getPost('imported_feed_url') .
                    ' ⎋</a>',
                ]);
        }
        $nsItunes = $feed->channel[0]->children(
            'http://www.itunes.com/dtds/podcast-1.0.dtd'
        );
        $nsPodcast = $feed->channel[0]->children(
            'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md'
        );

        if ((string) $nsPodcast->locked === 'yes') {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [lang('PodcastImport.lock_import')]);
        }

        $converter = new HtmlConverter();

        $channelDescriptionHtml = $feed->channel[0]->description;

        try {
            $podcast = new \App\Entities\Podcast([
                'name' => $this->request->getPost('name'),
                'imported_feed_url' => $this->request->getPost(
                    'imported_feed_url'
                ),
                'new_feed_url' => base_url(
                    route_to('podcast_feed', $this->request->getPost('name'))
                ),
                'title' => $feed->channel[0]->title,
                'description_markdown' => $converter->convert(
                    $channelDescriptionHtml
                ),
                'description_html' => $channelDescriptionHtml,
                'image' =>
                    $nsItunes->image && !empty($nsItunes->image->attributes())
                        ? download_file($nsItunes->image->attributes())
                        : ($feed->channel[0]->image &&
                        !empty($feed->channel[0]->image->url)
                            ? download_file($feed->channel[0]->image->url)
                            : null),
                'language_code' => $this->request->getPost('language'),
                'category_id' => $this->request->getPost('category'),
                'parental_advisory' => empty($nsItunes->explicit)
                    ? null
                    : (in_array($nsItunes->explicit, ['yes', 'true'])
                        ? 'explicit'
                        : (in_array($nsItunes->explicit, ['no', 'false'])
                            ? 'clean'
                            : null)),
                'owner_name' => $nsItunes->owner->name,
                'owner_email' => $nsItunes->owner->email,
                'publisher' => $nsItunes->author,
                'type' => empty($nsItunes->type) ? 'episodic' : $nsItunes->type,
                'copyright' => $feed->channel[0]->copyright,
                'is_blocked' => empty($nsItunes->block)
                    ? false
                    : $nsItunes->block === 'yes',
                'is_completed' => empty($nsItunes->complete)
                    ? false
                    : $nsItunes->complete === 'yes',
                'location_name' => !$nsPodcast->location
                    ? null
                    : $nsPodcast->location->attributes()['name'],
                'location_geo' =>
                    !$nsPodcast->location ||
                    empty($nsPodcast->location->attributes()['geo'])
                        ? null
                        : $nsPodcast->location->attributes()['geo'],
                'location_osmid' =>
                    !$nsPodcast->location ||
                    empty($nsPodcast->location->attributes()['osmid'])
                        ? null
                        : $nsPodcast->location->attributes()['osmid'],
                'created_by' => user(),
                'updated_by' => user(),
            ]);
        } catch (\ErrorException $ex) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    $ex->getMessage() .
                    ': <a href="' .
                    $this->request->getPost('imported_feed_url') .
                    '" rel="noreferrer noopener" target="_blank">' .
                    $this->request->getPost('imported_feed_url') .
                    ' ⎋</a>',
                ]);
        }

        $podcastModel = new PodcastModel();
        $db = \Config\Database::connect();

        $db->transStart();

        if (!($newPodcastId = $podcastModel->insert($podcast, true))) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $authorize = Services::authorization();
        $podcastAdminGroup = $authorize->group('podcast_admin');

        $podcastModel->addPodcastContributor(
            user()->id,
            $newPodcastId,
            $podcastAdminGroup->id
        );

        $platformModel = new PlatformModel();
        $podcastsPlatformsData = [];
        foreach ($nsPodcast->id as $podcastingPlatform) {
            $slug = $podcastingPlatform->attributes()['platform'];
            $platformModel->getOrCreatePlatform($slug, 'podcasting');
            array_push($podcastsPlatformsData, [
                'platform_slug' => $slug,
                'podcast_id' => $newPodcastId,
                'link_url' => $podcastingPlatform->attributes()['url'],
                'link_content' => $podcastingPlatform->attributes()['id'],
                'is_visible' => false,
            ]);
        }
        foreach ($nsPodcast->social as $socialPlatform) {
            $slug = $socialPlatform->attributes()['platform'];
            $platformModel->getOrCreatePlatform($slug, 'social');
            array_push($podcastsPlatformsData, [
                'platform_slug' => $socialPlatform->attributes()['platform'],
                'podcast_id' => $newPodcastId,
                'link_url' => $socialPlatform->attributes()['url'],
                'link_content' => $socialPlatform,
                'is_visible' => false,
            ]);
        }
        foreach ($nsPodcast->funding as $fundingPlatform) {
            $slug = $fundingPlatform->attributes()['platform'];
            $platformModel->getOrCreatePlatform($slug, 'funding');
            array_push($podcastsPlatformsData, [
                'platform_slug' => $fundingPlatform->attributes()['platform'],
                'podcast_id' => $newPodcastId,
                'link_url' => $fundingPlatform->attributes()['url'],
                'link_content' => $fundingPlatform->attributes()['id'],
                'is_visible' => false,
            ]);
        }
        if (count($podcastsPlatformsData) > 1) {
            $platformModel->createPodcastPlatforms(
                $newPodcastId,
                $podcastsPlatformsData
            );
        }

        $numberItems = $feed->channel[0]->item->count();
        $lastItem =
            !empty($this->request->getPost('max_episodes')) &&
            $this->request->getPost('max_episodes') < $numberItems
                ? $this->request->getPost('max_episodes')
                : $numberItems;

        $slugs = [];

        // For each Episode:
        for ($itemNumber = 1; $itemNumber <= $lastItem; $itemNumber++) {
            $item = $feed->channel[0]->item[$numberItems - $itemNumber];

            $nsItunes = $item->children(
                'http://www.itunes.com/dtds/podcast-1.0.dtd'
            );
            $nsPodcast = $item->children(
                'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md'
            );

            $slug = slugify(
                $this->request->getPost('slug_field') === 'title'
                    ? $item->title
                    : basename($item->link)
            );
            if (in_array($slug, $slugs)) {
                $slugNumber = 2;
                while (in_array($slug . '-' . $slugNumber, $slugs)) {
                    $slugNumber++;
                }
                $slug = $slug . '-' . $slugNumber;
            }
            $slugs[] = $slug;

            $itemDescriptionHtml =
                $this->request->getPost('description_field') === 'summary'
                    ? $nsItunes->summary
                    : ($this->request->getPost('description_field') ===
                    'subtitle_summary'
                        ? $nsItunes->subtitle . '<br/>' . $nsItunes->summary
                        : $item->description);

            $newEpisode = new \App\Entities\Episode([
                'podcast_id' => $newPodcastId,
                'guid' => empty($item->guid) ? null : $item->guid,
                'title' => $item->title,
                'slug' => $slug,
                'enclosure' => download_file($item->enclosure->attributes()),
                'description_markdown' => $converter->convert(
                    $itemDescriptionHtml
                ),
                'description_html' => $itemDescriptionHtml,
                'image' =>
                    !$nsItunes->image || empty($nsItunes->image->attributes())
                        ? null
                        : download_file($nsItunes->image->attributes()),
                'parental_advisory' => empty($nsItunes->explicit)
                    ? null
                    : (in_array($nsItunes->explicit, ['yes', 'true'])
                        ? 'explicit'
                        : (in_array($nsItunes->explicit, ['no', 'false'])
                            ? 'clean'
                            : null)),
                'number' =>
                    $this->request->getPost('force_renumber') === 'yes'
                        ? $itemNumber
                        : (!empty($nsItunes->episode)
                            ? $nsItunes->episode
                            : null),
                'season_number' => empty(
                    $this->request->getPost('season_number')
                )
                    ? (!empty($nsItunes->season)
                        ? $nsItunes->season
                        : null)
                    : $this->request->getPost('season_number'),
                'type' => empty($nsItunes->episodeType)
                    ? 'full'
                    : $nsItunes->episodeType,
                'is_blocked' => empty($nsItunes->block)
                    ? false
                    : $nsItunes->block === 'yes',
                'location_name' => !$nsPodcast->location
                    ? null
                    : $nsPodcast->location->attributes()['name'],
                'location_geo' =>
                    !$nsPodcast->location ||
                    empty($nsPodcast->location->attributes()['geo'])
                        ? null
                        : $nsPodcast->location->attributes()['geo'],
                'location_osmid' =>
                    !$nsPodcast->location ||
                    empty($nsPodcast->location->attributes()['osmid'])
                        ? null
                        : $nsPodcast->location->attributes()['osmid'],
                'created_by' => user(),
                'updated_by' => user(),
                'published_at' => strtotime($item->pubDate),
            ]);

            $episodeModel = new EpisodeModel();

            if (!$episodeModel->insert($newEpisode)) {
                // FIXME: What shall we do?
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }
        }

        $db->transComplete();

        return redirect()->route('podcast-view', [$newPodcastId]);
    }
}
