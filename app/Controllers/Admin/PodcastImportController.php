<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Entities\Episode;
use App\Entities\Image;
use App\Entities\Location;
use App\Entities\Person;
use App\Entities\Podcast;
use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\LanguageModel;
use App\Models\PersonModel;
use App\Models\PlatformModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Services;
use ErrorException;
use League\HTMLToMarkdown\HtmlConverter;
use Podlibre\PodcastNamespace\ReversedTaxonomy;

class PodcastImportController extends BaseController
{
    protected ?Podcast $podcast;

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) === 0) {
            return $this->{$method}();
        }

        if (($this->podcast = (new PodcastModel())->getPodcastById((int) $params[0])) !== null) {
            return $this->{$method}();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index(): string
    {
        helper(['form', 'misc']);

        $languageOptions = (new LanguageModel())->getLanguageOptions();
        $categoryOptions = (new CategoryModel())->getCategoryOptions();

        $data = [
            'languageOptions' => $languageOptions,
            'categoryOptions' => $categoryOptions,
            'browserLang' => get_browser_language($this->request->getServer('HTTP_ACCEPT_LANGUAGE')),
        ];

        return view('admin/podcast/import', $data);
    }

    public function attemptImport(): RedirectResponse
    {
        helper(['media', 'misc']);

        $rules = [
            'imported_feed_url' => 'required|validate_url',
            'season_number' => 'is_natural_no_zero|permit_empty',
            'max_episodes' => 'is_natural_no_zero|permit_empty',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        try {
            ini_set('user_agent', 'Castopod/' . CP_VERSION);
            $feed = simplexml_load_file($this->request->getPost('imported_feed_url'));
        } catch (ErrorException $errorException) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    $errorException->getMessage() .
                        ': <a href="' .
                        $this->request->getPost('imported_feed_url') .
                        '" rel="noreferrer noopener" target="_blank">' .
                        $this->request->getPost('imported_feed_url') .
                        ' ⎋</a>',
                ]);
        }
        $nsItunes = $feed->channel[0]->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
        $nsPodcast = $feed->channel[0]->children(
            'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md',
        );
        $nsContent = $feed->channel[0]->children('http://purl.org/rss/1.0/modules/content/');

        if ((string) $nsPodcast->locked === 'yes') {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [lang('PodcastImport.lock_import')]);
        }

        $converter = new HtmlConverter();

        $channelDescriptionHtml = (string) $feed->channel[0]->description;

        try {
            if (
                property_exists($nsItunes, 'image') && $nsItunes->image !== null &&
                $nsItunes->image->attributes()['href'] !== null
            ) {
                $imageFile = download_file((string) $nsItunes->image->attributes()['href']);
            } else {
                $imageFile = download_file((string) $feed->channel[0]->image->url);
            }

            $location = null;
            if (property_exists($nsPodcast, 'location') && $nsPodcast->location !== null) {
                $location = new Location(
                    (string) $nsPodcast->location,
                    $nsPodcast->location->attributes()['geo'] === null ? null : (string) $nsPodcast->location->attributes()['geo'],
                    $nsPodcast->location->attributes()['osm'] === null ? null : (string) $nsPodcast->location->attributes()['osm'],
                );
            }
            if (property_exists($nsPodcast, 'guid') && $nsPodcast->guid !== null) {
                $guid = (string) $nsPodcast->guid;
            } else {
                $guid = podcast_uuid(url_to('podcast_feed', $this->request->getPost('name')));
            }

            $podcast = new Podcast([
                'guid' => $guid,
                'name' => $this->request->getPost('name'),
                'imported_feed_url' => $this->request->getPost('imported_feed_url'),
                'new_feed_url' => url_to('podcast_feed', $this->request->getPost('name')),
                'title' => (string) $feed->channel[0]->title,
                'description_markdown' => $converter->convert($channelDescriptionHtml),
                'description_html' => $channelDescriptionHtml,
                'image' => new Image($imageFile),
                'language_code' => $this->request->getPost('language'),
                'category_id' => $this->request->getPost('category'),
                'parental_advisory' =>
                property_exists($nsItunes, 'explicit') && $nsItunes->explicit !== null
                    ? (in_array((string) $nsItunes->explicit, ['yes', 'true'], true)
                        ? 'explicit'
                        : (in_array((string) $nsItunes->explicit, ['no', 'false'], true)
                            ? 'clean'
                            : null))
                    : null,
                'owner_name' => (string) $nsItunes->owner->name,
                'owner_email' => (string) $nsItunes->owner->email,
                'publisher' => (string) $nsItunes->author,
                'type' => property_exists(
                    $nsItunes,
                    'type'
                ) && $nsItunes->type !== null ? (string) $nsItunes->type : 'episodic',
                'copyright' => (string) $feed->channel[0]->copyright,
                'is_blocked' =>
                property_exists($nsItunes, 'block') && $nsItunes->block !== null && (string) $nsItunes->block === 'yes',
                'is_completed' =>
                property_exists(
                    $nsItunes,
                    'complete'
                ) && $nsItunes->complete !== null && (string) $nsItunes->complete === 'yes',
                'location' => $location,
                'created_by' => user_id(),
                'updated_by' => user_id(),
            ]);
        } catch (ErrorException $ex) {
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
        $db = db_connect();

        $db->transStart();

        if (! ($newPodcastId = $podcastModel->insert($podcast, true))) {
            $db->transRollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $podcastModel->errors());
        }

        $authorize = Services::authorization();
        $podcastAdminGroup = $authorize->group('podcast_admin');

        $podcastModel->addPodcastContributor(user_id(), $newPodcastId, (int) $podcastAdminGroup->id);

        $podcastsPlatformsData = [];
        $platformTypes = [
            [
                'name' => 'podcasting',
                'elements' => $nsPodcast->id,
            ],
            [
                'name' => 'social',
                'elements' => $nsPodcast->social,
            ],
            [
                'name' => 'funding',
                'elements' => $nsPodcast->funding,
            ],
        ];
        $platformModel = new PlatformModel();
        foreach ($platformTypes as $platformType) {
            foreach ($platformType['elements'] as $platform) {
                $platformLabel = $platform->attributes()['platform'];
                $platformSlug = slugify((string) $platformLabel);
                if ($platformModel->getPlatform($platformSlug) !== null) {
                    $podcastsPlatformsData[] = [
                        'platform_slug' => $platformSlug,
                        'podcast_id' => $newPodcastId,
                        'link_url' => $platform->attributes()['url'],
                        'link_content' => $platform->attributes()['id'],
                        'is_visible' => false,
                    ];
                }
            }
        }

        if (count($podcastsPlatformsData) > 1) {
            $platformModel->createPodcastPlatforms($newPodcastId, $podcastsPlatformsData);
        }

        foreach ($nsPodcast->person as $podcastPerson) {
            $fullName = (string) $podcastPerson;
            $personModel = new PersonModel();
            $newPersonId = null;
            if (($newPerson = $personModel->getPerson($fullName)) !== null) {
                $newPersonId = $newPerson->id;
            } else {
                $newPodcastPerson = new Person([
                    'full_name' => $fullName,
                    'unique_name' => slugify($fullName),
                    'information_url' => $podcastPerson->attributes()['href'],
                    'image' => new Image(download_file((string) $podcastPerson->attributes()['img'])),
                    'created_by' => user_id(),
                    'updated_by' => user_id(),
                ]);

                if (! $newPersonId = $personModel->insert($newPodcastPerson)) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('errors', $personModel->errors());
                }
            }

            // TODO: these checks should be in the taxonomy as default values
            $podcastPersonGroup = $podcastPerson->attributes()['group'] ?? 'Cast';
            $podcastPersonRole = $podcastPerson->attributes()['role'] ?? 'Host';

            $personGroup = ReversedTaxonomy::$taxonomy[(string) $podcastPersonGroup];

            $personGroupSlug = $personGroup['slug'];
            $personRoleSlug = $personGroup['roles'][(string) $podcastPersonRole]['slug'];

            $podcastPersonModel = new PersonModel();
            if (! $podcastPersonModel->addPodcastPerson(
                $newPodcastId,
                $newPersonId,
                $personGroupSlug,
                $personRoleSlug
            )) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $podcastPersonModel->errors());
            }
        }

        $numberItems = $feed->channel[0]->item->count();

        $lastItem =
            $this->request->getPost('max_episodes') !== '' &&
            $this->request->getPost('max_episodes') < $numberItems
            ? (int) $this->request->getPost('max_episodes')
            : $numberItems;

        $slugs = [];
        for ($itemNumber = 1; $itemNumber <= $lastItem; ++$itemNumber) {
            $item = $feed->channel[0]->item[$numberItems - $itemNumber];

            $nsItunes = $item->children('http://www.itunes.com/dtds/podcast-1.0.dtd');
            $nsPodcast = $item->children(
                'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md',
            );
            $nsContent = $item->children('http://purl.org/rss/1.0/modules/content/');

            $textToSlugify = $this->request->getPost('slug_field') === 'title'
            ? (string) $item->title
            : basename((string) $item->link);
            $slug = slugify($textToSlugify, 185);
            if (in_array($slug, $slugs, true)) {
                $slugNumber = 2;
                while (in_array($slug . '-' . $slugNumber, $slugs, true)) {
                    ++$slugNumber;
                }
                $slug = $slug . '-' . $slugNumber;
            }
            $slugs[] = $slug;
            $itemDescriptionHtml = match ($this->request->getPost('description_field')) {
                'content' => (string) $nsContent->encoded,
                'summary' => (string) $nsItunes->summary,
                'subtitle_summary' => $nsItunes->subtitle . '<br/>' . $nsItunes->summary,
                default => (string) $item->description,
            };

            if (
                property_exists($nsItunes, 'image') && $nsItunes->image !== null &&
                $nsItunes->image->attributes()['href'] !== null
            ) {
                $episodeImage = new Image(download_file((string) $nsItunes->image->attributes()['href']));
            } else {
                $episodeImage = null;
            }

            $location = null;
            if (property_exists($nsPodcast, 'location') && $nsPodcast->location !== null) {
                $location = new Location(
                    (string) $nsPodcast->location,
                    $nsPodcast->location->attributes()['geo'] === null ? null : (string) $nsPodcast->location->attributes()['geo'],
                    $nsPodcast->location->attributes()['osm'] === null ? null : (string) $nsPodcast->location->attributes()['osm'],
                );
            }

            $newEpisode = new Episode([
                'podcast_id' => $newPodcastId,
                'title' => $item->title,
                'slug' => $slug,
                'guid' => $item->guid ?? null,
                'audio_file' => download_file(
                    (string) $item->enclosure->attributes()['url'],
                    (string) $item->enclosure->attributes()['type']
                ),
                'description_markdown' => $converter->convert($itemDescriptionHtml),
                'description_html' => $itemDescriptionHtml,
                'image' => $episodeImage,
                'parental_advisory' =>
                property_exists($nsItunes, 'explicit') && $nsItunes->explicit !== null
                    ? (in_array((string) $nsItunes->explicit, ['yes', 'true'], true)
                        ? 'explicit'
                        : (in_array((string) $nsItunes->explicit, ['no', 'false'], true)
                            ? 'clean'
                            : null))
                    : null,
                'number' =>
                $this->request->getPost('force_renumber') === 'yes'
                    ? $itemNumber
                    : ((string) $nsItunes->episode === '' ? null : (int) $nsItunes->episode),
                'season_number' =>
                $this->request->getPost('season_number') === ''
                    ? ((string) $nsItunes->season === '' ? null : (int) $nsItunes->season)
                    : (int) $this->request->getPost('season_number'),
                'type' => property_exists($nsItunes, 'episodeType') && $nsItunes->episodeType !== null
                    ? (string) $nsItunes->episodeType
                    : 'full',
                'is_blocked' => property_exists(
                    $nsItunes,
                    'block'
                ) && $nsItunes->block !== null && (string) $nsItunes->block === 'yes',
                'location' => $location,
                'created_by' => user_id(),
                'updated_by' => user_id(),
                'published_at' => strtotime((string) $item->pubDate),
            ]);

            $episodeModel = new EpisodeModel();

            if (! ($newEpisodeId = $episodeModel->insert($newEpisode, true))) {
                // FIXME: What shall we do?
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $episodeModel->errors());
            }

            foreach ($nsPodcast->person as $episodePerson) {
                $fullName = (string) $episodePerson;
                $personModel = new PersonModel();
                $newPersonId = null;
                if (($newPerson = $personModel->getPerson($fullName)) !== null) {
                    $newPersonId = $newPerson->id;
                } else {
                    $newPerson = new Person([
                        'full_name' => $fullName,
                        'unique_name' => slugify($fullName),
                        'information_url' => $episodePerson->attributes()['href'],
                        'image' => new Image(download_file((string) $episodePerson->attributes()['img'])),
                        'created_by' => user_id(),
                        'updated_by' => user_id(),
                    ]);

                    if (! ($newPersonId = $personModel->insert($newPerson))) {
                        return redirect()
                            ->back()
                            ->withInput()
                            ->with('errors', $personModel->errors());
                    }
                }

                // TODO: these checks should be in the taxonomy as default values
                $episodePersonGroup = $episodePerson->attributes()['group'] ?? 'Cast';
                $episodePersonRole = $episodePerson->attributes()['role'] ?? 'Host';

                $personGroup = ReversedTaxonomy::$taxonomy[(string) $episodePersonGroup];

                $personGroupSlug = $personGroup['slug'];
                $personRoleSlug = $personGroup['roles'][(string) $episodePersonRole]['slug'];

                $episodePersonModel = new PersonModel();
                if (! $episodePersonModel->addEpisodePerson(
                    $newPodcastId,
                    $newEpisodeId,
                    $newPersonId,
                    $personGroupSlug,
                    $personRoleSlug
                )) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('errors', $episodePersonModel->errors());
                }
            }
        }

        // set interact as the newly imported podcast actor
        $importedPodcast = (new PodcastModel())->getPodcastById($newPodcastId);
        set_interact_as_actor($importedPodcast->actor_id);

        $db->transComplete();

        return redirect()->route('podcast-view', [$newPodcastId]);
    }
}
