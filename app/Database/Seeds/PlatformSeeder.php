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
                'name' => 'Apple Podcasts',
                'home_url' => 'https://www.apple.com/itunes/podcasts/',
                'submit_url' =>
                    'https://podcastsconnect.apple.com/my-podcasts/new-feed',
                'iosapp_url' =>
                    'https://apps.apple.com/app/apple-podcasts/id525463029',
                'androidapp_url' => '',
                'comment' => '',
                'display_by_default' => 1,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'ApplePodcasts.png',
            ],
            [
                'name' => 'Blubrry',
                'home_url' => 'https://www.blubrry.com/',
                'submit_url' => 'https://www.blubrry.com/addpodcast.php',
                'iosapp_url' => '',
                'androidapp_url' => '',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'blubrry.png',
            ],
            [
                'name' => 'Castbox',
                'home_url' => 'https://castbox.fm/',
                'submit_url' =>
                    'https://helpcenter.castbox.fm/portal/kb/articles/submit-my-podcast',
                'iosapp_url' =>
                    'https://apps.apple.com/app/castbox-the-podcast-app/id1243410543',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=fm.castbox.audiobook.radio.podcast&hl=fr',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 2,
                'logo_file_name' => 'Castbox.png',
            ],
            [
                'name' => 'Castro',
                'home_url' => 'http://castro.fm/',
                'submit_url' => '',
                'iosapp_url' =>
                    'https://apps.apple.com/app/apple-store/id1080840241?ign-mpt=uo%3D4',
                'androidapp_url' => '',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'Castro.png',
            ],
            [
                'name' => 'Chartable',
                'home_url' => 'https://chartable.com/',
                'submit_url' => 'https://chartable.com/podcasts/submit',
                'iosapp_url' => '',
                'androidapp_url' => '',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'Chartable.png',
            ],
            [
                'name' => 'Deezer',
                'home_url' => 'https://www.deezer.com/',
                'submit_url' => 'https://podcasters.deezer.com/submission',
                'iosapp_url' =>
                    'https://apps.apple.com/app/deezer-music-podcast-player/id292738169',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=deezer.android.app',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 2,
                'logo_file_name' => 'Deezer.png',
            ],
            [
                'name' => 'Google Podcasts',
                'home_url' => 'https://podcasts.google.com/about',
                'submit_url' =>
                    'https://search.google.com/search-console/about',
                'iosapp_url' => '',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.google.android.apps.podcasts',
                'comment' => '',
                'display_by_default' => 1,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'GooglePodcasts.png',
            ],
            [
                'name' => 'Ivoox',
                'home_url' => 'https://www.ivoox.com/',
                'submit_url' => '',
                'iosapp_url' =>
                    'https://apps.apple.com/app/apple-store/id542673545',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.ivoox.app',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'ivoox.png',
            ],
            [
                'name' => 'ListenNotes',
                'home_url' => 'https://www.listennotes.com/',
                'submit_url' => 'https://www.listennotes.com/submit/',
                'iosapp_url' => '',
                'androidapp_url' => '',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'ListenNotes.png',
            ],
            //array('name' => 'Majelan', 'home_url' => 'https://www.majelan.com/', 'submit_url' => 'https://support.majelan.com/article/64-how-to-add-my-podcast-on-majelan', 'iosapp_url' => 'https://apps.apple.com/app/majelan-best-audio-stories/id1443711081', 'androidapp_url' => 'https://play.google.com/store/apps/details?id=com.majelanapp', 'comment' => 'Uses public podcasts indexes. Send a DM if you are not listed.', 'display_by_default' => 0, 'ios_deeplink' => 0, 'android_deeplink' => 2, 'logo_file_name' => 'Majelan.png'), // https://aide.majelan.com/article/130-pourquoi-nouvelle-application-7-juillet
            [
                'name' => 'Mytuner',
                'home_url' => 'https://mytuner-radio.com/',
                'submit_url' => 'https://mytuner-radio.com/broadcasters/',
                'iosapp_url' =>
                    'https://apps.apple.com/app/apple-store/id520502858',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.appgeneration.itunerfree',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'myTuner.png',
            ],
            [
                'name' => 'Overcast',
                'home_url' => 'https://overcast.fm/',
                'submit_url' => 'https://overcast.fm/podcasterinfo',
                'iosapp_url' =>
                    'https://apps.apple.com/us/app/overcast-podcast-player/id888422857',
                'androidapp_url' => '',
                'comment' =>
                    'Overcast uses Apple Podcasts index, no podcast submission needed.',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'Overcast.png',
            ],
            [
                'name' => 'Player.Fm',
                'home_url' => 'https://player.fm/',
                'submit_url' => 'https://player.fm/importer/feed',
                'iosapp_url' =>
                    'https://apps.apple.com/app/podcast-app-by-player-fm/id940568467',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=fm.player',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'PlayerFM.png',
            ],
            [
                'name' => 'Pocketcasts',
                'home_url' => 'https://www.pocketcasts.com/',
                'submit_url' => 'https://www.pocketcasts.com/submit/',
                'iosapp_url' =>
                    'https://apps.apple.com/app/pocket-casts/id414834813',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=au.com.shiftyjelly.pocketcasts',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'PocketCasts.png',
            ],
            [
                'name' => 'Podbean',
                'home_url' => 'https://www.podbean.com/',
                'submit_url' => 'https://www.podbean.com/site/submitPodcast',
                'iosapp_url' =>
                    'https://apps.apple.com/app/apple-store/id973361050',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.podbean.app.podcast',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 2,
                'logo_file_name' => 'Podbean.png',
            ],
            [
                'name' => 'Podcastland',
                'home_url' => 'https://podcastland.com/',
                'submit_url' => '',
                'iosapp_url' => '',
                'androidapp_url' => '',
                'comment' => 'Uses Apple Podcasts index.',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'PodcastLand.png',
            ],
            [
                'name' => 'Podcastrepublic',
                'home_url' => 'https://www.podcastrepublic.net/',
                'submit_url' =>
                    'https://www.podcastrepublic.net/for-podcast-publisher',
                'iosapp_url' => '',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.itunestoppodcastplayer.app',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'PodcastRepublic.png',
            ],
            [
                'name' => 'Podchaser',
                'home_url' => 'https://www.podchaser.com/',
                'submit_url' => 'https://www.podchaser.com/creators/edit',
                'iosapp_url' => '',
                'androidapp_url' => '',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'Podchaser.png',
            ],
            [
                'name' => 'Podtail',
                'home_url' => 'https://podtail.com/',
                'submit_url' => 'https://podtail.com/about/faq/',
                'iosapp_url' => '',
                'androidapp_url' => '',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 0,
                'logo_file_name' => 'Podtail.png',
            ],
            [
                'name' => 'Radiopublic',
                'home_url' => 'https://radiopublic.com/',
                'submit_url' => 'https://podcasters.radiopublic.com/signup',
                'iosapp_url' =>
                    'https://apps.apple.com/app/radiopublic-free-podcasts/id1113752736',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.radiopublic.android',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'RadioPublic.png',
            ],
            [
                'name' => 'Spotify',
                'home_url' => 'https://www.spotify.com/',
                'submit_url' => 'https://podcasters.spotify.com/submit',
                'iosapp_url' =>
                    'https://apps.apple.com/app/spotify-music/id324684580',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.spotify.music',
                'comment' => '',
                'display_by_default' => 1,
                'ios_deeplink' => 0,
                'android_deeplink' => 2,
                'logo_file_name' => 'Spotify.png',
            ],
            [
                'name' => 'Spreaker',
                'home_url' => 'https://www.spreaker.com/',
                'submit_url' => 'https://www.spreaker.com/cms/shows/rss-import',
                'iosapp_url' =>
                    'https://apps.apple.com/app/spreaker-podcast-radio/id388449677',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.spreaker.android',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'Spreaker.png',
            ],
            [
                'name' => 'Stitcher',
                'home_url' => 'https://www.stitcher.com/',
                'submit_url' => 'https://www.stitcher.com/content-providers',
                'iosapp_url' => 'https://apps.apple.com/app/id288087905',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=com.stitcher.app',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 1,
                'logo_file_name' => 'Stitcher.png',
            ],
            [
                'name' => 'TuneIn',
                'home_url' => 'https://tunein.com/',
                'submit_url' =>
                    'https://help.tunein.com/contact/add-podcast-S19TR3Sdf',
                'iosapp_url' =>
                    'https://apps.apple.com/app/tunein-radio/id418987775',
                'androidapp_url' =>
                    'https://play.google.com/store/apps/details?id=tunein.player',
                'comment' => '',
                'display_by_default' => 0,
                'ios_deeplink' => 0,
                'android_deeplink' => 2,
                'logo_file_name' => 'TuneIn.png',
            ],
        ];
        $this->db->table('platforms')->insertBatch($data);
    }
}
