<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Libraries\Image;
use App\Libraries\SimpleRSSElement;
use App\Models\PodcastModel;
use App\Models\SoundbiteModel;
use App\Models\EpisodePersonModel;
use App\Models\NoteModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\Exceptions\FileNotFoundException;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\I18n\Time;
use League\CommonMark\CommonMarkConverter;
use RuntimeException;

class Episode extends Entity
{
    /**
     * @var Podcast
     */
    protected $podcast;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @var File
     */
    protected $audioFile;

    /**
     * @var File
     */
    protected $transcript_file;

    /**
     * @var File
     */
    protected $chapters_file;

    /**
     * @var string
     */
    protected $audio_file_url;

    /**
     * @var string
     */
    protected $audio_file_analytics_url;

    /**
     * @var string
     */
    protected $audio_file_web_url;

    /**
     * @var string
     */
    protected $audio_file_opengraph_url;

    /**
     * @var EpisodePerson[]
     */
    protected $persons;

    /**
     * @var Soundbite[]
     */
    protected $soundbites;

    /**
     * @var Note[]
     */
    protected $notes;

    /**
     * Holds text only description, striped of any markdown or html special characters
     *
     * @var string
     */
    protected $description;

    /**
     * The embeddable player URL
     *
     * @var string
     */
    protected $embeddable_player;

    /**
     * @var string
     */
    protected $publication_status;

    /**
     * Return custom rss as string
     *
     * @var string
     */
    protected $custom_rss_string;

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'podcast_id' => 'integer',
        'guid' => 'string',
        'slug' => 'string',
        'title' => 'string',
        'audio_file_path' => 'string',
        'audio_file_duration' => 'integer',
        'audio_file_mimetype' => 'string',
        'audio_file_size' => 'integer',
        'audio_file_header_size' => 'integer',
        'description_markdown' => 'string',
        'description_html' => 'string',
        'image_path' => '?string',
        'image_mimetype' => '?string',
        'transcript_file_path' => '?string',
        'transcript_file_remote_url' => '?string',
        'chapters_file_path' => '?string',
        'chapters_file_remote_url' => '?string',
        'parental_advisory' => '?string',
        'number' => '?integer',
        'season_number' => '?integer',
        'type' => 'string',
        'is_blocked' => 'boolean',
        'location_name' => '?string',
        'location_geo' => '?string',
        'location_osmid' => '?string',
        'custom_rss' => '?json-array',
        'favourites_total' => 'integer',
        'reblogs_total' => 'integer',
        'notes_total' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Saves an episode image
     *
     * @param UploadedFile|File $image
     */
    public function setImage($image)
    {
        if (
            !empty($image) &&
            (!($image instanceof UploadedFile) || $image->isValid())
        ) {
            helper('media');

            // check whether the user has inputted an image and store
            $this->attributes['image_mimetype'] = $image->getMimeType();
            $this->attributes['image_path'] = save_media(
                $image,
                'podcasts/' . $this->getPodcast()->name,
                $this->attributes['slug'],
            );
            $this->image = new Image(
                $this->attributes['image_path'],
                $this->attributes['image_mimetype'],
            );
            $this->image->saveSizes();
        }

        return $this;
    }

    public function getImage(): Image
    {
        if ($imagePath = $this->attributes['image_path']) {
            return new Image($imagePath, $this->attributes['image_mimetype']);
        }
        return $this->getPodcast()->image;
    }

    /**
     * Saves an audio file
     *
     * @param UploadedFile|File $audioFile
     *
     */
    public function setAudioFile($audioFile = null)
    {
        if (
            !empty($audioFile) &&
            (!($audioFile instanceof UploadedFile) || $audioFile->isValid())
        ) {
            helper(['media', 'id3']);

            $audio_metadata = get_file_tags($audioFile);

            $this->attributes['audio_file_path'] = save_media(
                $audioFile,
                'podcasts/' . $this->getPodcast()->name,
                $this->attributes['slug'],
            );
            $this->attributes['audio_file_duration'] = round(
                $audio_metadata['playtime_seconds'],
            );
            $this->attributes['audio_file_mimetype'] =
                $audio_metadata['mime_type'];
            $this->attributes['audio_file_size'] = $audio_metadata['filesize'];
            $this->attributes['audio_file_header_size'] =
                $audio_metadata['avdataoffset'];

            return $this;
        }
    }

    /**
     * Saves an episode transcript file
     *
     * @param UploadedFile|File $transcriptFile
     *
     */
    public function setTranscriptFile($transcriptFile)
    {
        if (
            !empty($transcriptFile) &&
            (!($transcriptFile instanceof UploadedFile) ||
                $transcriptFile->isValid())
        ) {
            helper('media');

            $this->attributes['transcript_file_path'] = save_media(
                $transcriptFile,
                $this->getPodcast()->name,
                $this->attributes['slug'] . '-transcript',
            );
        }

        return $this;
    }

    /**
     * Saves an episode chapters file
     *
     * @param UploadedFile|File $chaptersFile
     *
     */
    public function setChaptersFile($chaptersFile)
    {
        if (
            !empty($chaptersFile) &&
            (!($chaptersFile instanceof UploadedFile) ||
                $chaptersFile->isValid())
        ) {
            helper('media');

            $this->attributes['chapters_file_path'] = save_media(
                $chaptersFile,
                $this->getPodcast()->name,
                $this->attributes['slug'] . '-chapters',
            );
        }

        return $this;
    }

    public function getAudioFile()
    {
        helper('media');

        return new File(media_path($this->audio_file_path));
    }

    public function getTranscriptFile()
    {
        if ($this->attributes['transcript_file_path']) {
            helper('media');

            return new File(
                media_path($this->attributes['transcript_file_path']),
            );
        }

        return null;
    }

    public function getChaptersFile()
    {
        if ($this->attributes['chapters_file_path']) {
            helper('media');

            return new File(
                media_path($this->attributes['chapters_file_path']),
            );
        }

        return null;
    }

    public function getAudioFileUrl()
    {
        helper('media');

        return media_base_url($this->audio_file_path);
    }

    public function getAudioFileAnalyticsUrl()
    {
        helper('analytics');

        return generate_episode_analytics_url(
            $this->podcast_id,
            $this->id,
            $this->audio_file_path,
            $this->audio_file_duration,
            $this->audio_file_size,
            $this->audio_file_header_size,
            $this->published_at,
        );
    }

    public function getAudioFileWebUrl()
    {
        return $this->getAudioFileAnalyticsUrl() . '?_from=-+Website+-';
    }

    public function getAudioFileOpengraphUrl()
    {
        return $this->getAudioFileAnalyticsUrl() . '?_from=-+Open+Graph+-';
    }

    /**
     * Gets transcript url from transcript file uri if it exists
     * or returns the transcript_file_remote_url which can be null.
     *
     * @return string|null
     * @throws FileNotFoundException
     * @throws HTTPException
     */
    public function getTranscriptFileUrl()
    {
        if ($this->attributes['transcript_file_path']) {
            return media_base_url($this->attributes['transcript_file_path']);
        } else {
            return $this->attributes['transcript_file_remote_url'];
        }
    }

    /**
     * Gets chapters file url from chapters file uri if it exists
     * or returns the chapters_file_remote_url which can be null.
     */
    public function getChaptersFileUrl(): ?string
    {
        if ($this->chapters_file_path) {
            return media_base_url($this->chapters_file_path);
        }

        return $this->chapters_file_remote_url;
    }

    /**
     * Returns the episode's persons
     *
     * @return \App\Entities\EpisodePerson[]
     */
    public function getPersons()
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Episode must be created before getting persons.',
            );
        }

        if (empty($this->persons)) {
            $this->persons = (new EpisodePersonModel())->getEpisodePersons(
                $this->podcast_id,
                $this->id,
            );
        }

        return $this->persons;
    }

    /**
     * Returns the episode’s soundbites
     *
     * @return \App\Entities\Episode[]
     */
    public function getSoundbites()
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Episode must be created before getting soundbites.',
            );
        }

        if (empty($this->soundbites)) {
            $this->soundbites = (new SoundbiteModel())->getEpisodeSoundbites(
                $this->getPodcast()->id,
                $this->id,
            );
        }

        return $this->soundbites;
    }

    public function getNotes()
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Episode must be created before getting soundbites.',
            );
        }

        if (empty($this->notes)) {
            $this->notes = (new NoteModel())->getEpisodeNotes($this->id);
        }

        return $this->notes;
    }

    public function getLink()
    {
        return base_url(
            route_to(
                'episode',
                $this->getPodcast()->name,
                $this->attributes['slug'],
            ),
        );
    }

    public function getEmbeddablePlayer($theme = null)
    {
        return base_url(
            $theme
                ? route_to(
                    'embeddable-player-theme',
                    $this->getPodcast()->name,
                    $this->attributes['slug'],
                    $theme,
                )
                : route_to(
                    'embeddable-player',
                    $this->getPodcast()->name,
                    $this->attributes['slug'],
                ),
        );
    }

    public function setGuid(string $guid)
    {
        return $this->attributes['guid'] = empty($guid)
            ? $this->getLink()
            : $guid;
    }

    public function getPodcast()
    {
        return (new PodcastModel())->getPodcastById(
            $this->attributes['podcast_id'],
        );
    }

    public function setDescriptionMarkdown(string $descriptionMarkdown)
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $this->attributes['description_markdown'] = $descriptionMarkdown;
        $this->attributes['description_html'] = $converter->convertToHtml(
            $descriptionMarkdown,
        );

        return $this;
    }

    public function getDescriptionHtml($serviceSlug = null)
    {
        return (empty($this->getPodcast()->partner_id) ||
        empty($this->getPodcast()->partner_link_url) ||
        empty($this->getPodcast()->partner_image_url)
            ? ''
            : "<div><a href=\"{$this->getPartnerLink(
                $serviceSlug,
            )}\" rel=\"sponsored noopener noreferrer\" target=\"_blank\"><img src=\"{$this->getPartnerImage(
                $serviceSlug,
            )}\" alt=\"Partner image\" /></a></div>") .
            $this->attributes['description_html'] .
            (empty($this->getPodcast()->episode_description_footer_html)
                ? ''
                : "<footer>{$this->getPodcast()->episode_description_footer_html}</footer>");
    }

    public function getDescription()
    {
        if ($this->description) {
            return $this->description;
        }

        return trim(
            preg_replace(
                '/\s+/',
                ' ',
                strip_tags($this->attributes['description_html']),
            ),
        );
    }

    public function getPublicationStatus()
    {
        if ($this->publication_status) {
            return $this->publication_status;
        }

        if (!$this->published_at) {
            return 'not_published';
        }

        helper('date');
        if ($this->published_at->isBefore(Time::now())) {
            return 'published';
        }

        return 'scheduled';
    }

    /**
     * Saves the location name and fetches OpenStreetMap info
     *
     * @param string $locationName
     *
     */
    public function setLocation($locationName = null)
    {
        helper('location');

        if (
            $locationName &&
            (empty($this->attributes['location_name']) ||
                $this->attributes['location_name'] != $locationName)
        ) {
            $this->attributes['location_name'] = $locationName;
            if ($location = fetch_osm_location($locationName)) {
                $this->attributes['location_geo'] = $location['geo'];
                $this->attributes['location_osmid'] = $location['osmid'];
            }
        } elseif (empty($locationName)) {
            $this->attributes['location_name'] = null;
            $this->attributes['location_geo'] = null;
            $this->attributes['location_osmid'] = null;
        }
        return $this;
    }

    /**
     * Get custom rss tag as XML String
     *
     * @return string
     *
     */
    function getCustomRssString()
    {
        if (empty($this->custom_rss)) {
            return '';
        }

        helper('rss');

        $xmlNode = (new SimpleRSSElement(
            '<?xml version="1.0" encoding="utf-8"?><rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:podcast="https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md" xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0"/>',
        ))
            ->addChild('channel')
            ->addChild('item');
        array_to_rss(
            [
                'elements' => $this->custom_rss,
            ],
            $xmlNode,
        );
        return str_replace(['<item>', '</item>'], '', $xmlNode->asXML());
    }

    /**
     * Saves custom rss tag into json
     *
     * @param string $customRssString
     *
     */
    function setCustomRssString($customRssString)
    {
        if (empty($customRssString)) {
            return $this;
        }

        helper('rss');
        $customRssArray = rss_to_array(
            simplexml_load_string(
                '<?xml version="1.0" encoding="utf-8"?><rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:podcast="https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md" xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0"><channel><item>' .
                    $customRssString .
                    '</item></channel></rss>',
            ),
        )['elements'][0]['elements'][0];

        if (array_key_exists('elements', $customRssArray)) {
            $this->attributes['custom_rss'] = json_encode(
                $customRssArray['elements'],
            );
        } else {
            $this->attributes['custom_rss'] = null;
        }

        return $this;
    }

    function getPartnerLink($serviceSlug = null)
    {
        return rtrim($this->getPodcast()->partner_link_url, '/') .
            '?pid=' .
            $this->getPodcast()->partner_id .
            '&guid=' .
            urlencode($this->attributes['guid']) .
            (empty($serviceSlug) ? '' : '&_from=' . $serviceSlug);
    }

    function getPartnerImage($serviceSlug = null)
    {
        return rtrim($this->getPodcast()->partner_image_url, '/') .
            '?pid=' .
            $this->getPodcast()->partner_id .
            '&guid=' .
            urlencode($this->attributes['guid']) .
            (empty($serviceSlug) ? '' : '&_from=' . $serviceSlug);
    }
}
