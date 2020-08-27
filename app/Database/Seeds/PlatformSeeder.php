<?php

/**
 * Class PlatformsSeeder
 * Inserts values in platforms table in database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'apple-podcasts',
                'label' => 'Apple Podcasts',
                'home_url' => 'https://www.apple.com/itunes/podcasts/',
                'submit_url' =>
                    'https://podcastsconnect.apple.com/my-podcasts/new-feed',
                'icon_filename' => 'apple-podcasts.svg',
            ],
            [
                'name' => 'blubrry',
                'label' => 'Blubrry',
                'home_url' => 'https://www.blubrry.com/',
                'submit_url' => 'https://www.blubrry.com/addpodcast.php',
                'icon_filename' => 'blubrry.svg',
            ],
            [
                'name' => 'castbox',
                'label' => 'Castbox',
                'home_url' => 'https://castbox.fm/',
                'submit_url' =>
                    'https://helpcenter.castbox.fm/portal/kb/articles/submit-my-podcast',
                'icon_filename' => 'castbox.svg',
            ],
            [
                'name' => 'castro',
                'label' => 'Castro',
                'home_url' => 'http://castro.fm/',
                'submit_url' => null,
                'icon_filename' => 'castro.svg',
            ],
            [
                'name' => 'deezer',
                'label' => 'Deezer',
                'home_url' => 'https://www.deezer.com/',
                'submit_url' => 'https://podcasters.deezer.com/submission',
                'icon_filename' => 'deezer.svg',
            ],
            [
                'name' => 'google-podcasts',
                'label' => 'Google Podcasts',
                'home_url' => 'https://podcasts.google.com/about',
                'submit_url' =>
                    'https://search.google.com/search-console/about',
                'icon_filename' => 'google-podcasts.svg',
            ],
            [
                'name' => 'ivoox',
                'label' => 'Ivoox',
                'home_url' => 'https://www.ivoox.com/',
                'submit_url' => null,
                'icon_filename' => 'ivoox.svg',
            ],
            [
                'name' => 'listennotes',
                'label' => 'ListenNotes',
                'home_url' => 'https://www.listennotes.com/',
                'submit_url' => 'https://www.listennotes.com/submit/',
                'icon_filename' => 'listennotes.svg',
            ],
            [
                'name' => 'overcast',
                'label' => 'Overcast',
                'home_url' => 'https://overcast.fm/',
                'submit_url' => 'https://overcast.fm/podcasterinfo',
                'icon_filename' => 'overcast.svg',
            ],
            [
                'name' => 'playerfm',
                'label' => 'Player.Fm',
                'home_url' => 'https://player.fm/',
                'submit_url' => 'https://player.fm/importer/feed',
                'icon_filename' => 'playerfm.svg',
            ],
            [
                'name' => 'pocketcasts',
                'label' => 'Pocketcasts',
                'home_url' => 'https://www.pocketcasts.com/',
                'submit_url' => 'https://www.pocketcasts.com/submit/',
                'icon_filename' => 'pocketcasts.svg',
            ],
            [
                'name' => 'podbean',
                'label' => 'Podbean',
                'home_url' => 'https://www.podbean.com/',
                'submit_url' => 'https://www.podbean.com/site/submitPodcast',
                'icon_filename' => 'podbean.svg',
            ],
            [
                'name' => 'podcast-addict',
                'label' => 'Podcast Addict',
                'home_url' => 'https://podcastaddict.com/',
                'submit_url' => 'https://podcastaddict.com/submit',
                'icon_filename' => 'podcast-addict.svg',
            ],
            [
                'name' => 'podchaser',
                'label' => 'Podchaser',
                'home_url' => 'https://www.podchaser.com/',
                'submit_url' => 'https://www.podchaser.com/creators/edit',
                'icon_filename' => 'podchaser.svg',
            ],
            [
                'name' => 'podtail',
                'label' => 'Podtail',
                'home_url' => 'https://podtail.com/',
                'submit_url' => 'https://podtail.com/about/faq/',
                'icon_filename' => 'podtail.svg',
            ],
            [
                'name' => 'radiopublic',
                'label' => 'Radiopublic',
                'home_url' => 'https://radiopublic.com/',
                'submit_url' => 'https://podcasters.radiopublic.com/signup',
                'icon_filename' => 'radiopublic.svg',
            ],
            [
                'name' => 'spotify',
                'label' => 'Spotify',
                'home_url' => 'https://www.spotify.com/',
                'submit_url' => 'https://podcasters.spotify.com/submit',
                'icon_filename' => 'spotify.svg',
            ],
            [
                'name' => 'spreaker',
                'label' => 'Spreaker',
                'home_url' => 'https://www.spreaker.com/',
                'submit_url' => 'https://www.spreaker.com/cms/shows/rss-import',
                'icon_filename' => 'spreaker.svg',
            ],
            [
                'name' => 'stitcher',
                'label' => 'Stitcher',
                'home_url' => 'https://www.stitcher.com/',
                'submit_url' => 'https://www.stitcher.com/content-providers',
                'icon_filename' => 'stitcher.svg',
            ],
            [
                'name' => 'tunein',
                'label' => 'TuneIn',
                'home_url' => 'https://tunein.com/',
                'submit_url' =>
                    'https://help.tunein.com/contact/add-podcast-S19TR3Sdf',
                'icon_filename' => 'tunein.svg',
            ],
        ];
        $this->db->table('platforms')->insertBatch($data);
    }
}
