<?php

declare(strict_types=1);

namespace Modules\PodcastImport\Commands;

use AdAures\PodcastPersonsTaxonomy\ReversedTaxonomy;
use App\Entities\Episode;
use App\Entities\Location;
use App\Entities\Person;
use App\Entities\Platform;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PersonModel;
use App\Models\PlatformModel;
use App\Models\PodcastModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Entities\User;
use Config\Services;
use Exception;
use League\HTMLToMarkdown\HtmlConverter;
use Modules\Auth\Config\AuthGroups;
use Modules\Auth\Models\UserModel;
use Modules\PodcastImport\Entities\PodcastImportTask;
use Modules\PodcastImport\Entities\TaskStatus;
use PodcastFeed\PodcastFeed;
use PodcastFeed\Tags\Podcast\PodcastPerson;
use PodcastFeed\Tags\RSS\Channel;
use PodcastFeed\Tags\RSS\Item;

class PodcastImport extends BaseCommand
{
    protected $group = 'podcast-import';

    protected $name = 'podcast:import';

    protected $description = 'Runs next podcast import in queue.';

    protected PodcastFeed $podcastFeed;

    protected User $user;

    protected ?PodcastImportTask $importTask = null;

    protected ?Podcast $podcast = null;

    public function init(): void
    {
        helper('podcast_import');

        $importQueue = get_import_tasks();

        $currentImport = current(array_filter($importQueue, static function ($task): bool {
            return $task->status === TaskStatus::Running;
        }));

        if ($currentImport instanceof PodcastImportTask) {
            $currentImport->syncWithProcess();

            if ($currentImport->status === TaskStatus::Running) {
                // process is still running
                throw new Exception('An import is already running.');
            }

            // continue if the task is not running anymore
        }

        // Get the next queued import
        $queuedImports = array_filter($importQueue, static function ($task): bool {
            return $task->status === TaskStatus::Queued;
        });
        $nextImport = end($queuedImports);

        if (! $nextImport instanceof PodcastImportTask) {
            // no queued import task, stop process.
            exit(0);
        }

        $this->importTask = $nextImport;

        // retrieve user who created import task
        $user = (new UserModel())->find($this->importTask->created_by);

        if (! $user instanceof User) {
            throw new Exception('Could not retrieve user with ID: ' . $this->importTask->created_by);
        }

        $this->user = $user;

        CLI::write('Fetching and parsing RSS feed...');

        ini_set('user_agent', 'Castopod/' . CP_VERSION);
        $this->podcastFeed = new PodcastFeed($this->importTask->feed_url);
    }

    public function run(array $params): void
    {
        // FIXME: getting named routes doesn't work from v4.3 anymore, so loading all routes before importing
        Services::routes()->loadRoutes();

        $this->init();

        try {
            CLI::write('All good! Feed was parsed successfully!');

            CLI::write(
                'Starting import for @' . $this->importTask->handle . ' using feed: ' . $this->importTask->feed_url
            );

            // --- START IMPORT TASK ---
            $this->importTask->start();

            CLI::write('Checking if podcast is locked.');

            if ($this->podcastFeed->channel->podcast_locked->getValue()) {
                throw new Exception('🔒 Podcast is locked.');
            }

            CLI::write('Podcast is not locked, import can resume.');

            // check if podcast to be imported already exists by guid if exists or handle otherwise
            $podcastGuid = $this->podcastFeed->channel->podcast_guid->getValue();
            if ($podcastGuid !== null) {
                $podcast = (new PodcastModel())->where('guid', $podcastGuid)
                    ->first();
            } else {
                $podcast = (new PodcastModel())->where('handle', $this->importTask->handle)
                    ->first();
            }

            if ($podcast instanceof Podcast) {
                if ($podcast->handle !== $this->importTask->handle) {
                    throw new Exception('Podcast was already imported with a different handle.');
                }

                CLI::write('Podcast handle already exists, using existing one.');
                $this->podcast = $podcast;
            }

            helper(['media', 'misc', 'auth']);

            if (! $this->podcast instanceof Podcast) {
                $this->podcast = $this->importPodcast();
            }

            CLI::write('Adding podcast platforms...');

            $this->importPodcastPlatforms();

            CLI::write('Adding persons - ' . count($this->podcastFeed->channel->podcast_persons) . ' elements.');

            $this->importPodcastPersons();

            $this->importEpisodes();

            // set podcast publication date to the first ever published episode
            $this->podcast->published_at = $this->getOldestEpisodePublicationDate(
                $this->podcast->id
            ) ?? $this->podcast->created_at;

            $podcastModel = new PodcastModel();
            if (! $podcastModel->update($this->podcast->id, $this->podcast)) {
                throw new Exception((string) print_r($podcastModel->errors()));
            }

            CLI::showProgress(false);

            // // done, set status to passed
            $this->importTask->pass();
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            log_message(
                'critical',
                'Error when importing ' . $this->importTask->feed_url . PHP_EOL . $exception->getTraceAsString()
            );
        }
    }

    private function getOldestEpisodePublicationDate(int $podcastId): ?Time
    {
        $result = (new EpisodeModel())
            ->builder()
            ->selectMax('published_at', 'oldest_published_at')
            ->where('podcast_id', $podcastId)
            ->get()
            ->getResultArray();

        if ($result[0]['oldest_published_at'] === null) {
            return null;
        }

        return Time::createFromFormat('Y-m-d H:i:s', $result[0]['oldest_published_at']);
    }

    private function importPodcast(): Podcast
    {
        $db = db_connect();
        $db->transStart();

        $location = null;
        if ($this->podcastFeed->channel->podcast_location->getValue() !== null) {
            $location = new Location(
                $this->podcastFeed->channel->podcast_location->getValue(),
                $this->podcastFeed->channel->podcast_location->getAttribute('geo'),
                $this->podcastFeed->channel->podcast_location->getAttribute('osm'),
            );
        }

        if (($showNotes = $this->getShowNotes($this->podcastFeed->channel)) === null) {
            throw new Exception('Missing channel show notes. Please include a <description> tag.');
        }

        if (($coverUrl = $this->getCoverUrl($this->podcastFeed->channel)) === null) {
            throw new Exception('Missing podcast cover. Please include an <itunes:image> tag');
        }

        $parentalAdvisory = null;
        if ($this->podcastFeed->channel->itunes_explicit->getValue() !== null) {
            $parentalAdvisory = $this->podcastFeed->channel->itunes_explicit->getValue() ? 'explicit' : 'clean';
        }

        $htmlConverter = new HtmlConverter();
        $podcast = new Podcast([
            'created_by'           => $this->user->id,
            'updated_by'           => $this->user->id,
            'guid'                 => $this->podcastFeed->channel->podcast_guid->getValue(),
            'handle'               => $this->importTask->handle,
            'imported_feed_url'    => $this->importTask->feed_url,
            'new_feed_url'         => url_to('podcast-rss-feed', $this->importTask->handle),
            'title'                => $this->podcastFeed->channel->title->getValue(),
            'description_markdown' => $htmlConverter->convert($showNotes),
            'description_html'     => $showNotes,
            'cover'                => download_file($coverUrl),
            'banner'               => null,
            'language_code'        => $this->importTask->language,
            'category_id'          => $this->importTask->category,
            'parental_advisory'    => $parentalAdvisory,
            'owner_name'           => $this->podcastFeed->channel->itunes_owner->itunes_name->getValue(),
            'owner_email'          => $this->podcastFeed->channel->itunes_owner->itunes_email->getValue(),
            'publisher'            => $this->podcastFeed->channel->itunes_author->getValue(),
            'type'                 => $this->podcastFeed->channel->itunes_type->getValue(),
            'copyright'            => $this->podcastFeed->channel->copyright->getValue(),
            'is_blocked'           => $this->podcastFeed->channel->itunes_block->getValue(),
            'is_completed'         => $this->podcastFeed->channel->itunes_complete->getValue(),
            'location'             => $location,
        ]);

        $podcastModel = new PodcastModel();
        if (! ($podcastId = $podcastModel->insert($podcast, true))) {
            $db->transRollback();
            throw new Exception((string) print_r($podcastModel->errors()));
        }

        $podcast->id = $podcastId;

        // set current user as podcast admin
        // 1. create new group
        config(AuthGroups::class)
            ->generatePodcastAuthorizations($podcast->id);
        add_podcast_group($this->user, $podcast->id, 'admin');

        $db->transComplete(); // save podcast to database

        CLI::write('Podcast was successfully created!');

        return $podcast;
    }

    private function getShowNotes(Channel|Item $channelOrItem): ?string
    {
        if (! $channelOrItem instanceof Item) {
            return $channelOrItem->description->getValue() ?? $channelOrItem->itunes_summary->getValue();
        }

        if ($channelOrItem->content_encoded->getValue() !== null) {
            return $channelOrItem->content_encoded->getValue();
        }

        return $channelOrItem->description->getValue() ?? $channelOrItem->itunes_summary->getValue();
    }

    private function getCoverUrl(Channel|Item $channelOrItem): ?string
    {
        if ($channelOrItem->itunes_image->getAttribute('href') !== null) {
            return $channelOrItem->itunes_image->getAttribute('href');
        }

        if ($channelOrItem instanceof Channel && $channelOrItem->image->url->getValue() !== null) {
            return $channelOrItem->image->url->getValue();
        }

        return null;
    }

    private function importPodcastPersons(): void
    {
        $personsCount = count($this->podcastFeed->channel->podcast_persons);
        $currPersonsStep = 1; // for progress
        foreach ($this->podcastFeed->channel->podcast_persons as $person) {
            CLI::showProgress($currPersonsStep++, $personsCount);
            $fullName = $person->getValue();
            $newPersonId = null;
            $personModel = new PersonModel();
            if (($newPerson = $personModel->getPerson($fullName)) instanceof Person) {
                $newPersonId = $newPerson->id;
            } else {
                $newPodcastPerson = new Person([
                    'created_by'      => $this->user->id,
                    'updated_by'      => $this->user->id,
                    'full_name'       => $fullName,
                    'unique_name'     => slugify($fullName),
                    'information_url' => $person->getAttribute('href'),
                    'avatar'          => download_file((string) $person->getAttribute('img')),
                ]);

                if (! $newPersonId = $personModel->insert($newPodcastPerson)) {
                    throw new Exception((string) print_r($personModel->errors()));
                }
            }

            $personGroup = $person->getAttribute('group');
            $personRole = $person->getAttribute('role');

            $isTaxonomyFound = false;
            if (array_key_exists(strtolower((string) $personGroup), ReversedTaxonomy::$taxonomy)) {
                $personGroup = ReversedTaxonomy::$taxonomy[strtolower((string) $personGroup)];
                $personGroupSlug = $personGroup['slug'];

                if (array_key_exists(strtolower((string) $personRole), $personGroup['roles'])) {
                    $personRoleSlug = $personGroup['roles'][strtolower((string) $personRole)]['slug'];
                    $isTaxonomyFound = true;
                }
            }

            if (! $isTaxonomyFound) {
                // taxonomy was not found, set default group and role
                $personGroupSlug = 'cast';
                $personRoleSlug = 'host';
            }

            $podcastPersonModel = new PersonModel();
            if (! $podcastPersonModel->addPodcastPerson(
                $this->podcast->id,
                $newPersonId,
                $personGroupSlug,
                $personRoleSlug
            )) {
                throw new Exception((string) print_r($podcastPersonModel->errors()));
            }
        }

        CLI::showProgress(false);
    }

    private function importPodcastPlatforms(): void
    {
        $platformTypes = [
            [
                'name'            => 'podcasting',
                'elements'        => $this->podcastFeed->channel->podcast_ids,
                'count'           => count($this->podcastFeed->channel->podcast_ids),
                'account_url_key' => 'url',
                'account_id_key'  => 'id',
            ],
            [
                'name'            => 'social',
                'elements'        => $this->podcastFeed->channel->podcast_socials,
                'count'           => count($this->podcastFeed->channel->podcast_socials),
                'account_url_key' => 'accountUrl',
                'account_id_key'  => 'accountId',
            ],
            [
                'name'            => 'funding',
                'elements'        => $this->podcastFeed->channel->podcast_fundings,
                'count'           => count($this->podcastFeed->channel->podcast_fundings),
                'account_url_key' => 'url',
                'account_id_key'  => 'id',
            ],
        ];

        $platformModel = new PlatformModel();
        foreach ($platformTypes as $platformType) {
            $podcastsPlatformsData = [];
            $currPlatformStep = 1; // for progress
            CLI::write($platformType['name'] . ' - ' . $platformType['count'] . ' elements');
            foreach ($platformType['elements'] as $platform) {
                CLI::showProgress($currPlatformStep++, $platformType['count']);
                $platformLabel = $platform->getAttribute('platform');
                $platformSlug = slugify((string) $platformLabel);
                if ($platformModel->getPlatform($platformSlug) instanceof Platform) {
                    $podcastsPlatformsData[] = [
                        'platform_slug' => $platformSlug,
                        'podcast_id'    => $this->podcast->id,
                        'link_url'      => $platform->getAttribute($platformType['account_url_key']),
                        'account_id'    => $platform->getAttribute($platformType['account_id_key']),
                        'is_visible'    => false,
                    ];
                }
            }

            $platformModel->savePodcastPlatforms($this->podcast->id, $platformType['name'], $podcastsPlatformsData);
            CLI::showProgress(false);
        }
    }

    private function importEpisodes(): void
    {
        helper('text');

        $itemsCount = count($this->podcastFeed->channel->items);
        $this->importTask->setEpisodesCount($itemsCount);

        CLI::write('Adding episodes - ' . $itemsCount . ' episodes');

        $htmlConverter = new HtmlConverter();

        $importedGUIDs = $this->getImportedGUIDs($this->podcast->id);

        $currEpisodesStep = 0; // for progress
        $episodesNewlyImported = 0;
        $episodesAlreadyImported = 0;

        // insert episodes in reverse order, from the last item in the list to the first
        foreach (array_reverse($this->podcastFeed->channel->items) as $key => $item) {
            CLI::showProgress(++$currEpisodesStep, $itemsCount);

            if (in_array($item->guid->getValue(), $importedGUIDs, true)) {
                // do not import item if already imported
                // (check that item with guid has already been inserted)
                $this->importTask->setEpisodesAlreadyImported(++$episodesAlreadyImported);
                continue;
            }

            $db = db_connect();
            $db->transStart();

            $location = null;
            if ($item->podcast_location->getValue() !== null) {
                $location = new Location(
                    $item->podcast_location->getValue(),
                    $item->podcast_location->getAttribute('geo'),
                    $item->podcast_location->getAttribute('osm'),
                );
            }

            if (($showNotes = $this->getShowNotes($item)) === null) {
                throw new Exception('Missing item show notes. Please include a <description> tag to item ' . $key);
            }

            $coverUrl = $this->getCoverUrl($item);

            $parentalAdvisory = null;
            if ($item->itunes_explicit->getValue() !== null) {
                $parentalAdvisory = $item->itunes_explicit->getValue() ? 'explicit' : 'clean';
            }

            $episode = new Episode([
                'created_by' => $this->user->id,
                'updated_by' => $this->user->id,
                'podcast_id' => $this->podcast->id,
                'title'      => $item->title->getValue(),
                'slug'       => slugify((string) $item->title->getValue(), 120) . '-' . strtolower(
                    random_string('alnum', 5)
                ),
                'guid'  => $item->guid->getValue(),
                'audio' => download_file(
                    $item->enclosure->getAttribute('url'),
                    $item->enclosure->getAttribute('type')
                ),
                'description_markdown' => $htmlConverter->convert($showNotes),
                'description_html'     => $showNotes,
                'cover'                => $coverUrl ? download_file($coverUrl) : null,
                'parental_advisory'    => $parentalAdvisory,
                'number'               => $item->itunes_episode->getValue(),
                'season_number'        => $item->itunes_season->getValue(),
                'type'                 => $item->itunes_episodeType->getValue(),
                'is_blocked'           => $item->itunes_block->getValue(),
                'location'             => $location,
                'published_at'         => $item->pubDate->getValue(),
            ]);

            $episodeModel = new EpisodeModel();

            if (! ($episodeId = $episodeModel->insert($episode, true))) {
                $db->transRollback();
                throw new Exception((string) print_r($episodeModel->errors()));
            }

            $this->importEpisodePersons($episodeId, $item->podcast_persons);

            $this->importTask->setEpisodesNewlyImported(++$episodesNewlyImported);

            $db->transComplete();
        }
    }

    /**
     * @return string[]
     */
    private function getImportedGUIDs(int $podcastId): array
    {
        $result = (new EpisodeModel())
            ->builder()
            ->select('guid')
            ->where('podcast_id', $podcastId)
            ->get()
            ->getResultArray();

        return array_map(static function (array $element) {
            return $element['guid'];
        }, $result);
    }

    /**
     * @param PodcastPerson[] $persons
     */
    private function importEpisodePersons(int $episodeId, array $persons): void
    {
        foreach ($persons as $person) {
            $fullName = $person->getValue();
            $personModel = new PersonModel();
            $newPersonId = null;
            if (($newPerson = $personModel->getPerson($fullName)) instanceof Person) {
                $newPersonId = $newPerson->id;
            } else {
                $newPerson = new Person([
                    'created_by'      => $this->user->id,
                    'updated_by'      => $this->user->id,
                    'full_name'       => $fullName,
                    'unique_name'     => slugify($fullName),
                    'information_url' => $person->getAttribute('href'),
                    'avatar'          => download_file((string) $person->getAttribute('img')),
                ]);

                if (! ($newPersonId = $personModel->insert($newPerson))) {
                    throw new Exception((string) print_r($personModel->errors()));
                }
            }

            $personGroup = $person->getAttribute('group');
            $personRole = $person->getAttribute('role');

            $isTaxonomyFound = false;
            if (array_key_exists(strtolower((string) $personGroup), ReversedTaxonomy::$taxonomy)) {
                $personGroup = ReversedTaxonomy::$taxonomy[strtolower((string) $personGroup)];
                $personGroupSlug = $personGroup['slug'];

                if (array_key_exists(strtolower((string) $personRole), $personGroup['roles'])) {
                    $personRoleSlug = $personGroup['roles'][strtolower((string) $personRole)]['slug'];
                    $isTaxonomyFound = true;
                }
            }

            if (! $isTaxonomyFound) {
                // taxonomy was not found, set default group and role
                $personGroupSlug = 'cast';
                $personRoleSlug = 'host';
            }

            $episodePersonModel = new PersonModel();
            if (! $episodePersonModel->addEpisodePerson(
                $this->podcast->id,
                $episodeId,
                $newPersonId,
                $personGroupSlug,
                $personRoleSlug
            )) {
                throw new Exception((string) print_r($episodePersonModel->errors()));
            }
        }
    }

    private function error(string $message): void
    {
        if ($this->importTask instanceof PodcastImportTask) {
            $this->importTask->fail($message);
        }

        CLI::error('[Error] ' . $message);
    }
}
