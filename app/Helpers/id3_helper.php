<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
use App\Entities\Episode;

use CodeIgniter\I18n\Time;
use JamesHeinrich\GetID3\WriteTags;
use Modules\Media\FileManagers\FileManagerInterface;

if (! function_exists('write_audio_file_tags')) {
    /**
     * Write audio file metadata / ID3 tags
     */
    function write_audio_file_tags(Episode $episode): void
    {
        helper('media');

        $TextEncoding = 'UTF-8';

        // Initialize getID3 tag-writing module
        $tagwriter = new WriteTags();
        $tagwriter->filename = $episode->audio->file_name;

        // set various options (optional)
        $tagwriter->tagformats = ['id3v2.4'];
        $tagwriter->tag_encoding = $TextEncoding;

        /** @var FileManagerInterface $fileManager */
        $fileManager = service('file_manager');

        $APICdata = (string) $fileManager->getFileContents($episode->cover->id3_key);

        // TODO: variables used for podcast specific tags
        // $podcastUrl = $episode->podcast->link;
        // $podcastFeedUrl = $episode->podcast->feed_url;
        // $episodeMediaUrl = $episode->link;

        // populate data array
        $TagData = [
            'title'  => [esc($episode->title)],
            'artist' => [
                $episode->podcast->publisher === null
                    ? esc($episode->podcast->owner_name)
                    : $episode->podcast->publisher,
            ],
            'album'             => [esc($episode->podcast->title)],
            'year'              => [$episode->published_at instanceof Time ? $episode->published_at->format('Y') : ''],
            'genre'             => ['Podcast'],
            'comment'           => [$episode->description],
            'track_number'      => [(string) $episode->number],
            'copyright_message' => [$episode->podcast->copyright],
            'publisher'         => [
                $episode->podcast->publisher === null
                    ? esc($episode->podcast->owner_name)
                    : $episode->podcast->publisher,
            ],
            'encoded_by' => ['Castopod'],

            // TODO: find a way to add the remaining tags for podcasts as the library doesn't seem to allow it
            // 'website' => [$podcast_url],
            // 'podcast' => [],
            // 'podcast_identifier' => [$episode_media_url],
            // 'podcast_feed' => [$podcast_feed_url],
            // 'podcast_description' => [$podcast->description_markdown],
        ];

        $TagData['attached_picture'][] = [
            // picturetypeid == Cover. More: module.tag.id3v2.php
            'picturetypeid' => 2,
            'data'          => $APICdata,
            'description'   => 'cover',
            'mime'          => $episode->cover->file_mimetype,
        ];

        $tagwriter->tag_data = $TagData;

        // write tags
        if ($tagwriter->WriteTags()) {
            // Successfully wrote tags
            if ($tagwriter->warnings !== []) {
                log_message('warning', 'There were some warnings:' . PHP_EOL . implode(PHP_EOL, $tagwriter->warnings));
            }
        } else {
            log_message('critical', 'Failed to write tags!' . PHP_EOL . implode(PHP_EOL, $tagwriter->errors));
        }
    }
}
