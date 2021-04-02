<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PodcastModel;
use App\Models\SoundbiteModel;
use App\Models\EpisodePersonModel;
use App\Models\NoteModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;
use League\CommonMark\CommonMarkConverter;

class Episode extends Entity
{
    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var string
     */
    protected $link;

    /**
     * @var \App\Libraries\Image
     */
    protected $image;

    /**
     * @var \CodeIgniter\Files\File
     */
    protected $enclosure;

    /**
     * @var \CodeIgniter\Files\File
     */
    protected $transcript;

    /**
     * @var \CodeIgniter\Files\File
     */
    protected $chapters;

    /**
     * @var string
     */
    protected $enclosure_media_path;

    /**
     * @var string
     */
    protected $enclosure_url;

    /**
     * @var string
     */
    protected $enclosure_web_url;

    /**
     * @var string
     */
    protected $enclosure_opengraph_url;

    /**
     * @var string
     */
    protected $transcript_url;

    /**
     * @var string
     */
    protected $chapters_url;

    /**
     * @var \App\Entities\EpisodePerson[]
     */
    protected $persons;

    /**
     * @var \App\Entities\Soundbite[]
     */
    protected $soundbites;

    /**
     * @var \App\Entities\Note[]
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
        'enclosure_uri' => 'string',
        'enclosure_duration' => 'integer',
        'enclosure_mimetype' => 'string',
        'enclosure_filesize' => 'integer',
        'enclosure_headersize' => 'integer',
        'description_markdown' => 'string',
        'description_html' => 'string',
        'image_uri' => '?string',
        'image_mimetype' => '?string',
        'transcript_uri' => '?string',
        'chapters_uri' => '?string',
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
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $image
     *
     */
    public function setImage($image)
    {
        if (
            !empty($image) &&
            (!($image instanceof \CodeIgniter\HTTP\Files\UploadedFile) ||
                $image->isValid())
        ) {
            helper('media');

            // check whether the user has inputted an image and store
            $this->attributes['image_mimetype'] = $image->getMimeType();
            $this->attributes['image_uri'] = save_media(
                $image,
                'podcasts/' . $this->getPodcast()->name,
                $this->attributes['slug'],
            );
            $this->image = new \App\Libraries\Image(
                $this->attributes['image_uri'],
                $this->attributes['image_mimetype'],
            );
            $this->image->saveSizes();
        }

        return $this;
    }

    public function getImage(): \App\Libraries\Image
    {
        if ($image_uri = $this->attributes['image_uri']) {
            return new \App\Libraries\Image(
                $image_uri,
                $this->attributes['image_mimetype'],
            );
        }
        return $this->getPodcast()->image;
    }

    /**
     * Saves an enclosure
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $enclosure
     *
     */
    public function setEnclosure($enclosure = null)
    {
        if (
            !empty($enclosure) &&
            (!($enclosure instanceof \CodeIgniter\HTTP\Files\UploadedFile) ||
                $enclosure->isValid())
        ) {
            helper(['media', 'id3']);

            $enclosure_metadata = get_file_tags($enclosure);

            $this->attributes['enclosure_uri'] = save_media(
                $enclosure,
                'podcasts/' . $this->getPodcast()->name,
                $this->attributes['slug'],
            );
            $this->attributes['enclosure_duration'] = round(
                $enclosure_metadata['playtime_seconds'],
            );
            $this->attributes['enclosure_mimetype'] =
                $enclosure_metadata['mime_type'];
            $this->attributes['enclosure_filesize'] =
                $enclosure_metadata['filesize'];
            $this->attributes['enclosure_headersize'] =
                $enclosure_metadata['avdataoffset'];

            return $this;
        }
    }

    /**
     * Saves an episode transcript
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $transcript
     *
     */
    public function setTranscript($transcript)
    {
        if (
            !empty($transcript) &&
            (!($transcript instanceof \CodeIgniter\HTTP\Files\UploadedFile) ||
                $transcript->isValid())
        ) {
            helper('media');

            $this->attributes['transcript_uri'] = save_media(
                $transcript,
                $this->getPodcast()->name,
                $this->attributes['slug'] . '-transcript',
            );
        }

        return $this;
    }

    /**
     * Saves an episode chapters
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $chapters
     *
     */
    public function setChapters($chapters)
    {
        if (
            !empty($chapters) &&
            (!($chapters instanceof \CodeIgniter\HTTP\Files\UploadedFile) ||
                $chapters->isValid())
        ) {
            helper('media');

            $this->attributes['chapters_uri'] = save_media(
                $chapters,
                $this->getPodcast()->name,
                $this->attributes['slug'] . '-chapters',
            );
        }

        return $this;
    }

    public function getEnclosure()
    {
        return new \CodeIgniter\Files\File($this->getEnclosureMediaPath());
    }

    public function getTranscript()
    {
        return $this->attributes['transcript_uri']
            ? new \CodeIgniter\Files\File($this->getTranscriptMediaPath())
            : null;
    }

    public function getChapters()
    {
        return $this->attributes['chapters_uri']
            ? new \CodeIgniter\Files\File($this->getChaptersMediaPath())
            : null;
    }

    public function getEnclosureMediaPath()
    {
        helper('media');

        return media_path($this->attributes['enclosure_uri']);
    }

    public function getTranscriptMediaPath()
    {
        helper('media');

        return $this->attributes['transcript_uri']
            ? media_path($this->attributes['transcript_uri'])
            : null;
    }

    public function getChaptersMediaPath()
    {
        helper('media');

        return $this->attributes['chapters_uri']
            ? media_path($this->attributes['chapters_uri'])
            : null;
    }

    public function getEnclosureUrl()
    {
        helper('analytics');

        return base_url(
            route_to(
                'analytics_hit',
                base64_url_encode(
                    pack(
                        'I*',
                        $this->attributes['podcast_id'],
                        $this->attributes['id'],
                        // bytes_threshold: number of bytes that must be downloaded for an episode to be counted in download analytics
                        // - if file is shorter than 60sec, then it's enclosure_filesize
                        // - if file is longer than 60 seconds then it's enclosure_headersize + 60 seconds
                        $this->attributes['enclosure_duration'] <= 60
                            ? $this->attributes['enclosure_filesize']
                            : $this->attributes['enclosure_headersize'] +
                                floor(
                                    (($this->attributes['enclosure_filesize'] -
                                        $this->attributes[
                                            'enclosure_headersize'
                                        ]) /
                                        $this->attributes[
                                            'enclosure_duration'
                                        ]) *
                                        60,
                                ),
                        $this->attributes['enclosure_filesize'],
                        $this->attributes['enclosure_duration'],
                        strtotime($this->attributes['published_at']),
                    ),
                ),
                $this->attributes['enclosure_uri'],
            ),
        );
    }

    public function getEnclosureWebUrl()
    {
        return $this->getEnclosureUrl() . '?_from=-+Website+-';
    }

    public function getEnclosureOpengraphUrl()
    {
        return $this->getEnclosureUrl() . '?_from=-+Open+Graph+-';
    }

    public function getTranscriptUrl()
    {
        return $this->attributes['transcript_uri']
            ? base_url($this->getTranscriptMediaPath())
            : null;
    }

    public function getChaptersUrl()
    {
        return $this->attributes['chapters_uri']
            ? base_url($this->getChaptersMediaPath())
            : null;
    }

    /**
     * Returns the episode's persons
     *
     * @return \App\Entities\EpisodePerson[]
     */
    public function getPersons()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Episode must be created before getting persons.',
            );
        }

        if (empty($this->persons)) {
            $this->persons = (new EpisodePersonModel())->getPersonsByEpisodeId(
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
            throw new \RuntimeException(
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
            throw new \RuntimeException(
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
                $serviceSlug
            )}\" rel=\"sponsored noopener noreferrer\" target=\"_blank\"><img src=\"{$this->getPartnerImage(
                $serviceSlug
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
        helper('rss');
        if (empty($this->attributes['custom_rss'])) {
            return '';
        } else {
            $xmlNode = (new \App\Libraries\SimpleRSSElement(
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
    }

    /**
     * Saves custom rss tag into json
     *
     * @param string $customRssString
     *
     */
    function setCustomRssString($customRssString)
    {
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
