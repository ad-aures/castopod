<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use JamesHeinrich\GetID3\GetID3;
use JamesHeinrich\GetID3\WriteTags;

/**
 * Gets audio file metadata and ID3 info
 *
 * @param UploadedFile $file
 *
 * @return array
 */
function get_file_tags($file)
{
    $getID3 = new GetID3();
    $FileInfo = $getID3->analyze($file);

    return [
        'filesize' => $FileInfo['filesize'],
        'mime_type' => $FileInfo['mime_type'],
        'playtime_seconds' => $FileInfo['playtime_seconds'],
        'attached_picture' => array_key_exists('comments', $FileInfo)
            ? $FileInfo['comments']['picture'][0]['data']
            : null,
    ];
}

/**
 * Write audio file metadata / ID3 tags
 *
 * @param App\Entities\Podcast $podcast
 * @param App\Entities\Episode $episode
 *
 * @return UploadedFile
 */
function write_file_tags($podcast, $episode)
{
    $TextEncoding = 'UTF-8';

    // Initialize getID3 tag-writing module
    $tagwriter = new WriteTags();
    $tagwriter->filename = media_path($episode->enclosure_url);

    // set various options (optional)
    $tagwriter->tagformats = ['id3v2.4'];
    $tagwriter->tag_encoding = $TextEncoding;

    $cover = new \CodeIgniter\Files\File(media_path($episode->image));

    $APICdata = file_get_contents($cover->getRealPath());

    // TODO: variables used for podcast specific tags
    // $podcast_url = base_url('@' . $podcast->name);
    // $podcast_feed_url = base_url('@' . $podcast->name . '/feed.xml');
    // $episode_media_url = media_url($podcast->name . '/' . $episode->slug);

    // populate data array
    $TagData = [
        'title' => [$episode->title],
        'artist' => [$podcast->author],
        'album' => [$podcast->title],
        'year' => [$episode->pub_date->format('Y')],
        'genre' => ['Podcast'],
        'comment' => [$episode->description],
        'track_number' => [strval($episode->number)],
        'copyright_message' => [$podcast->copyright],
        'publisher' => ['Podlibre'],
        'encoded_by' => ['Castopod'],

        // TODO: find a way to add the remaining tags for podcasts as the library doesn't seem to allow it
        // 'website' => [$podcast_url],
        // 'podcast' => [],
        // 'podcast_identifier' => [$episode_media_url],
        // 'podcast_feed' => [$podcast_feed_url],
        // 'podcast_description' => [$podcast->description],
    ];

    $TagData['attached_picture'][] = [
        'picturetypeid' => 2, // Cover. More: module.tag.id3v2.php
        'data' => $APICdata,
        'description' => 'cover',
        'mime' => $cover->getMimeType(),
    ];

    $tagwriter->tag_data = $TagData;

    // write tags
    if ($tagwriter->WriteTags()) {
        echo 'Successfully wrote tags<br>';
        if (!empty($tagwriter->warnings)) {
            echo 'There were some warnings:<br>' .
                implode('<br><br>', $tagwriter->warnings);
        }
    } else {
        echo 'Failed to write tags!<br>' .
            implode('<br><br>', $tagwriter->errors);
    }
}
