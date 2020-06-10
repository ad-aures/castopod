<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use JamesHeinrich\GetID3\GetID3;

/**
 * Saves a file to the corresponding podcast folder in `public/media`
 *
 * @param UploadedFile $file
 * @param string $podcast_name
 * @param string $file_name
 *
 * @return string The absolute path of the file
 */
function save_podcast_media($file, $podcast_name, $file_name)
{
    $image_storage_folder = 'media/' . $podcast_name . '/';

    // overwrite file if already existing
    $file->move($image_storage_folder, $file_name, true);

    return $image_storage_folder . $file_name;
}

/**
 * Gets audio file metadata and ID3 info
 *
 * @param UploadedFile $file
 *
 * @return array
 */
function get_file_metadata($file)
{
    if (!$file->isValid()) {
        throw new RuntimeException(
            $file->getErrorString() . '(' . $file->getError() . ')'
        );
    }

    $getID3 = new GetID3();
    $FileInfo = $getID3->analyze($file);

    return [
        'cover_picture' => $FileInfo['comments']['picture'][0]['data'],
        'filesize' => $FileInfo['filesize'],
        'mime_type' => $FileInfo['mime_type'],
        'playtime_seconds' => $FileInfo['playtime_seconds'],
    ];
}
