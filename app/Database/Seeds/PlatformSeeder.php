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
            ],
            [
                'name' => 'blubrry',
                'label' => 'Blubrry',
                'home_url' => 'https://www.blubrry.com/',
                'submit_url' => 'https://www.blubrry.com/addpodcast.php',
            ],
            [
                'name' => 'castbox',
                'label' => 'Castbox',
                'home_url' => 'https://castbox.fm/',
                'submit_url' =>
                    'https://helpcenter.castbox.fm/portal/kb/articles/submit-my-podcast',
            ],
            [
                'name' => 'castro',
                'label' => 'Castro',
                'home_url' => 'http://castro.fm/',
                'submit_url' => null,
            ],
            [
                'name' => 'deezer',
                'label' => 'Deezer',
                'home_url' => 'https://www.deezer.com/',
                'submit_url' => 'https://podcasters.deezer.com/submission',
            ],
            [
                'name' => 'google-podcasts',
                'label' => 'Google Podcasts',
                'home_url' => 'https://podcasts.google.com/about',
                'submit_url' =>
                    'https://search.google.com/search-console/about',
            ],
            [
                'name' => 'ivoox',
                'label' => 'Ivoox',
                'home_url' => 'https://www.ivoox.com/',
                'submit_url' => null,
            ],
            [
                'name' => 'listennotes',
                'label' => 'ListenNotes',
                'home_url' => 'https://www.listennotes.com/',
                'submit_url' => 'https://www.listennotes.com/submit/',
            ],
            [
                'name' => 'overcast',
                'label' => 'Overcast',
                'home_url' => 'https://overcast.fm/',
                'submit_url' => 'https://overcast.fm/podcasterinfo',
            ],
            [
                'name' => 'playerfm',
                'label' => 'Player.Fm',
                'home_url' => 'https://player.fm/',
                'submit_url' => 'https://player.fm/importer/feed',
            ],
            [
                'name' => 'pocketcasts',
                'label' => 'Pocketcasts',
                'home_url' => 'https://www.pocketcasts.com/',
                'submit_url' => 'https://www.pocketcasts.com/submit/',
            ],
            [
                'name' => 'podbean',
                'label' => 'Podbean',
                'home_url' => 'https://www.podbean.com/',
                'submit_url' => 'https://www.podbean.com/site/submitPodcast',
            ],
            [
                'name' => 'podcast-addict',
                'label' => 'Podcast Addict',
                'home_url' => 'https://podcastaddict.com/',
                'submit_url' => 'https://podcastaddict.com/submit',
            ],
            [
                'name' => 'podcast-index',
                'label' => 'Podcast Index',
                'home_url' => 'https://podcastindex.org/',
                'submit_url' => 'https://api.podcastindex.org/signup',
            ],
            [
                'name' => 'podchaser',
                'label' => 'Podchaser',
                'home_url' => 'https://www.podchaser.com/',
                'submit_url' => 'https://www.podchaser.com/creators/edit',
            ],
            [
                'name' => 'podtail',
                'label' => 'Podtail',
                'home_url' => 'https://podtail.com/',
                'submit_url' => 'https://podtail.com/about/faq/',
            ],
            [
                'name' => 'radiopublic',
                'label' => 'Radiopublic',
                'home_url' => 'https://radiopublic.com/',
                'submit_url' => 'https://podcasters.radiopublic.com/signup',
            ],
            [
                'name' => 'spotify',
                'label' => 'Spotify',
                'home_url' => 'https://www.spotify.com/',
                'submit_url' => 'https://podcasters.spotify.com/submit',
            ],
            [
                'name' => 'spreaker',
                'label' => 'Spreaker',
                'home_url' => 'https://www.spreaker.com/',
                'submit_url' => 'https://www.spreaker.com/cms/shows/rss-import',
            ],
            [
                'name' => 'stitcher',
                'label' => 'Stitcher',
                'home_url' => 'https://www.stitcher.com/',
                'submit_url' => 'https://www.stitcher.com/content-providers',
            ],
            [
                'name' => 'tunein',
                'label' => 'TuneIn',
                'home_url' => 'https://tunein.com/',
                'submit_url' =>
                    'https://help.tunein.com/contact/add-podcast-S19TR3Sdf',
            ],
        ];
        $this->db
            ->table('platforms')
            ->ignore(true)
            ->insertBatch($data);
    }
}
