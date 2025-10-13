<?php

declare(strict_types=1);

/**
 * @copyright  2024 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Platforms;

class Platforms
{
    /**
     * @var array<string,array<string,array{label:string,home_url:string,submit_url:?string}>>
     */
    public const DATA = [
        'podcasting' => [
            'amazon' => [
                'label'      => 'Amazon Music',
                'home_url'   => 'https://music.amazon.com/',
                'submit_url' => 'https://podcasters.amazon.com/',
            ],
            'antennapod' => [
                'label'      => 'AntennaPod',
                'home_url'   => 'https://antennapod.org/',
                'submit_url' => 'https://antennapod.org/documentation/podcasters-hosters/add-on-antennapod',
            ],
            'anytime' => [
                'label'      => 'Anytime Podcast Player',
                'home_url'   => 'https://anytimeplayer.app/',
                'submit_url' => null,
            ],
            'apple' => [
                'label'      => 'Apple Podcasts',
                'home_url'   => 'https://www.apple.com/itunes/podcasts/',
                'submit_url' => 'https://podcastsconnect.apple.com/my-podcasts/new-feed',
            ],
            'blubrry' => [
                'label'      => 'Blubrry',
                'home_url'   => 'https://www.blubrry.com/',
                'submit_url' => 'https://www.blubrry.com/addpodcast.php',
            ],
            'breez' => [
                'label'      => 'Breez',
                'home_url'   => 'https://breez.technology/',
                'submit_url' => null,
            ],
            'castamatic' => [
                'label'      => 'Castamatic',
                'home_url'   => 'https://castamatic.com/',
                'submit_url' => null,
            ],
            'castbox' => [
                'label'      => 'Castbox',
                'home_url'   => 'https://castbox.fm/',
                'submit_url' => 'https://helpcenter.castbox.fm/portal/kb/articles/submit-my-podcast',
            ],
            'castopod' => [
                'label'      => 'Castopod',
                'home_url'   => 'https://castopod.org/',
                'submit_url' => 'https://castopod.org/instances',
            ],
            'castro' => [
                'label'      => 'Castro',
                'home_url'   => 'http://castro.fm/',
                'submit_url' => 'https://castro.fm/support/link-to-your-podcast-in-castro',
            ],
            'curiocaster' => [
                'label'      => 'CurioCaster',
                'home_url'   => 'https://curiocaster.com/',
                'submit_url' => null,
            ],
            'deezer' => [
                'label'      => 'Deezer',
                'home_url'   => 'https://www.deezer.com/',
                'submit_url' => 'https://podcasters.deezer.com/submission',
            ],
            'episodes-fm' => [
                'label'      => 'Episodes.fm',
                'home_url'   => 'https://episodes.fm/',
                'submit_url' => 'https://podcastindex.org/add',
            ],
            'fountain' => [
                'label'      => 'Fountain',
                'home_url'   => 'https://www.fountain.fm/',
                'submit_url' => 'https://support.fountain.fm/article/56-how-to-claim-your-show-on-fountain',
            ],
            'fyyd' => [
                'label'      => 'fyyd',
                'home_url'   => 'https://fyyd.de/',
                'submit_url' => 'https://fyyd.de/add-feed',
            ],
            'gpodder' => [
                'label'      => 'gPodder',
                'home_url'   => 'https://gpodder.org/',
                'submit_url' => null,
            ],
            'ivoox' => [
                'label'      => 'Ivoox',
                'home_url'   => 'https://www.ivoox.com/',
                'submit_url' => null,
            ],
            'listennotes' => [
                'label'      => 'ListenNotes',
                'home_url'   => 'https://www.listennotes.com/',
                'submit_url' => 'https://www.listennotes.com/submit/',
            ],
            'overcast' => [
                'label'      => 'Overcast',
                'home_url'   => 'https://overcast.fm/',
                'submit_url' => 'https://overcast.fm/podcasterinfo',
            ],
            'playerfm' => [
                'label'      => 'Player.Fm',
                'home_url'   => 'https://player.fm/',
                'submit_url' => 'https://player.fm/importer/feed',
            ],
            'pocketcasts' => [
                'label'      => 'Pocketcasts',
                'home_url'   => 'https://www.pocketcasts.com/',
                'submit_url' => 'https://www.pocketcasts.com/submit/',
            ],
            'podbean' => [
                'label'      => 'Podbean',
                'home_url'   => 'https://www.podbean.com/',
                'submit_url' => 'https://www.podbean.com/site/submitPodcast',
            ],
            'podcastaddict' => [
                'label'      => 'Podcast Addict',
                'home_url'   => 'https://podcastaddict.com/',
                'submit_url' => 'https://podcastaddict.com/submit',
            ],
            'podcastindex' => [
                'label'      => 'Podcast Index',
                'home_url'   => 'https://podcastindex.org/',
                'submit_url' => 'https://podcastindex.org/add',
            ],
            'podchaser' => [
                'label'      => 'Podchaser',
                'home_url'   => 'https://www.podchaser.com/',
                'submit_url' => 'https://www.podchaser.com/add',
            ],
            'podcloud' => [
                'label'      => 'podCloud',
                'home_url'   => 'https://podcloud.fr/',
                'submit_url' => 'https://podcloud.fr/studio/podcasts/new',
            ],
            'podlink' => [
                'label'      => 'pod.link',
                'home_url'   => 'https://pod.link/',
                'submit_url' => null,
            ],
            'podtail' => [
                'label'      => 'Podtail',
                'home_url'   => 'https://podtail.com/',
                'submit_url' => 'https://podtail.com/about/faq/',
            ],
            'podfriend' => [
                'label'      => 'Podfriend',
                'home_url'   => 'https://www.podfriend.com/',
                'submit_url' => 'https://podcastindex.org/add',
            ],
            'podverse' => [
                'label'      => 'Podverse',
                'home_url'   => 'https://podverse.fm/',
                'submit_url' => 'https://docs.google.com/forms/d/e/1FAIpQLSdewKP-YrE8zGjDPrkmoJEwCxPl_gizEkmzAlTYsiWAuAk1Ng/viewform',
            ],
            'radiopublic' => [
                'label'      => 'RadioPublic',
                'home_url'   => 'https://radiopublic.com/',
                'submit_url' => 'https://podcasters.radiopublic.com/signup',
            ],
            'spotify' => [
                'label'      => 'Spotify',
                'home_url'   => 'https://www.spotify.com/',
                'submit_url' => 'https://podcasters.spotify.com/dash/submit',
            ],
            'spreaker' => [
                'label'      => 'Spreaker',
                'home_url'   => 'https://www.spreaker.com/',
                'submit_url' => 'https://www.spreaker.com/cms/shows/rss-import',
            ],
            'tunein' => [
                'label'      => 'TuneIn',
                'home_url'   => 'https://tunein.com/',
                'submit_url' => 'https://help.tunein.com/contact/add-podcast-S19TR3Sdf',
            ],
            'hypercatcher' => [
                'label'      => 'HyperCatcher',
                'home_url'   => 'https://hypercatcher.com/',
                'submit_url' => null,
            ],
            'ivyfm' => [
                'label'      => 'Ivy.fm',
                'home_url'   => 'https://ivy.fm/',
                'submit_url' => null,
            ],
            'jumplink' => [
                'label'      => 'JumpLink',
                'home_url'   => 'https://jump.link/',
                'submit_url' => 'https://jump.link/a/accounts/signup/',
            ],
            'kasts' => [
                'label'      => 'Kasts',
                'home_url'   => 'https://apps.kde.org/kasts/',
                'submit_url' => null,
            ],
            'playapod' => [
                'label'      => 'Playapod',
                'home_url'   => 'https://playapod.com/',
                'submit_url' => null,
            ],
            'plink' => [
                'label'      => 'Plink',
                'home_url'   => 'https://plinkhq.com/',
                'submit_url' => null,
            ],
            'podcastchapters' => [
                'label'      => 'Podcast Chapters',
                'home_url'   => 'https://chaptersapp.com/',
                'submit_url' => null,
            ],
            'podcastguru' => [
                'label'      => 'Podcast Guru',
                'home_url'   => 'https://podcastguru.io/',
                'submit_url' => 'https://podcastguru.io/promote-your-podcast/',
            ],
            'podlp' => [
                'label'      => 'PodLP',
                'home_url'   => 'https://podlp.com/',
                'submit_url' => 'https://podlp.com/submit.html',
            ],
            'podnews' => [
                'label'      => 'Podnews',
                'home_url'   => 'https://podnews.net/',
                'submit_url' => 'https://podnews.net/podcast/subscribe-pages',
            ],
            'podstation' => [
                'label'      => 'podStation',
                'home_url'   => 'https://podstation.github.io/',
                'submit_url' => null,
            ],
            'sphinxchat' => [
                'label'      => 'Sphinx',
                'home_url'   => 'https://sphinx.chat/',
                'submit_url' => null,
            ],
            'truefans' => [
                'label'      => 'Truefans',
                'home_url'   => 'https://truefans.fm/',
                'submit_url' => 'https://podcastindex.org/add',
            ],
            'tsacdop' => [
                'label'      => 'Tsacdop',
                'home_url'   => 'https://www.tsacdop.app/',
                'submit_url' => null,
            ],
            'youtube-music' => [
                'label'      => 'YouTube Music',
                'home_url'   => 'https://www.youtube.com/creators/podcasts/',
                'submit_url' => 'https://studio.youtube.com/channel/content/podcasts',
            ],
        ],
        'social' => [
            'bluesky' => [
                'label'      => 'Bluesky',
                'home_url'   => 'https://bsky.app/',
                'submit_url' => 'https://bsky.app/',
            ],
            'discord' => [
                'label'      => 'Discord',
                'home_url'   => 'https://discord.com/',
                'submit_url' => 'https://discord.com/register',
            ],
            'discourse' => [
                'label'      => 'Discourse',
                'home_url'   => 'https://www.discourse.org/',
                'submit_url' => null,
            ],
            'facebook' => [
                'label'      => 'Facebook',
                'home_url'   => 'https://www.facebook.com/',
                'submit_url' => 'https://www.facebook.com/pages/creation/',
            ],
            'funkwhale' => [
                'label'      => 'Funkwhale',
                'home_url'   => 'https://funkwhale.audio/',
                'submit_url' => 'https://network.funkwhale.audio/dashboards/',
            ],
            'instagram' => [
                'label'      => 'Instagram',
                'home_url'   => 'https://www.instagram.com/',
                'submit_url' => 'https://www.instagram.com/accounts/emailsignup/',
            ],
            'linkedin' => [
                'label'      => 'LinkedIn',
                'home_url'   => 'https://www.linkedin.com/',
                'submit_url' => 'https://www.linkedin.com/company/setup/new/',
            ],
            'mastodon' => [
                'label'      => 'Mastodon',
                'home_url'   => 'https://joinmastodon.org/',
                'submit_url' => 'https://joinmastodon.org/communities',
            ],
            'matrix' => [
                'label'      => 'Matrix',
                'home_url'   => 'https://matrix.org/',
                'submit_url' => 'https://matrix.org/try-matrix/',
            ],
            'misskey' => [
                'label'      => 'Misskey',
                'home_url'   => 'https://join.misskey.page/',
                'submit_url' => 'https://join.misskey.page/en-US/instances',
            ],
            'mobilizon' => [
                'label'      => 'Mobilizon',
                'home_url'   => 'https://joinmobilizon.org/',
                'submit_url' => 'https://instances.joinmobilizon.org/instances',
            ],
            'peertube' => [
                'label'      => 'PeerTube',
                'home_url'   => 'https://joinpeertube.org/',
                'submit_url' => 'https://joinpeertube.org/instances',
            ],
            'pixelfed' => [
                'label'      => 'Pixelfed',
                'home_url'   => 'https://pixelfed.org/',
                'submit_url' => 'https://beta.joinpixelfed.org/',
            ],
            'pleroma' => [
                'label'      => 'Pleroma',
                'home_url'   => 'https://pleroma.social/',
                'submit_url' => 'https://pleroma.social/#featured-instances',
            ],
            'plume' => [
                'label'      => 'Plume',
                'home_url'   => 'https://joinplu.me/',
                'submit_url' => 'https://joinplu.me/#instances',
            ],
            'slack' => [
                'label'      => 'Slack',
                'home_url'   => 'https://slack.com/',
                'submit_url' => 'https://slack.com/get-started#/create',
            ],
            'telegram' => [
                'label'      => 'Telegram',
                'home_url'   => 'https://www.telegram.org/',
                'submit_url' => null,
            ],
            'threads' => [
                'label'      => 'Threads',
                'home_url'   => 'https://www.threads.net/',
                'submit_url' => 'https://www.threads.net/login',
            ],
            'tiktok' => [
                'label'      => 'TikTok',
                'home_url'   => 'https://www.tiktok.com/',
                'submit_url' => 'https://www.tiktok.com/signup',
            ],
            'twitch' => [
                'label'      => 'Twitch',
                'home_url'   => 'https://www.twitch.tv/',
                'submit_url' => 'https://www.twitch.tv/signup',
            ],
            'writefreely' => [
                'label'      => 'WriteFreely',
                'home_url'   => 'https://writefreely.org/',
                'submit_url' => 'https://writefreely.org/instances',
            ],
            'youtube' => [
                'label'      => 'YouTube',
                'home_url'   => 'https://www.youtube.com/',
                'submit_url' => 'https://studio.youtube.com/',
            ],
            'x' => [
                'label'      => 'Twitter / X',
                'home_url'   => 'https://x.com/',
                'submit_url' => 'https://x.com/i/flow/signup',
            ],
        ],
        'funding' => [
            'buymeacoffee' => [
                'label'      => 'Buy Me a Coffee',
                'home_url'   => 'https://www.buymeacoffee.com/',
                'submit_url' => 'https://www.buymeacoffee.com/signup',
            ],
            'paypal' => [
                'label'      => 'PayPal',
                'home_url'   => 'https://www.paypal.com/',
                'submit_url' => 'https://www.paypal.com/paypalme/my/grab',
            ],
            'fosspay' => [
                'label'      => 'fosspay',
                'home_url'   => 'https://git.sr.ht/~sircmpwn/fosspay',
                'submit_url' => null,
            ],
            'gofundme' => [
                'label'      => 'GoFundMe',
                'home_url'   => 'https://www.gofundme.com/',
                'submit_url' => 'https://www.gofundme.com/sign-up',
            ],
            'helloasso' => [
                'label'      => 'HelloAsso',
                'home_url'   => 'https://www.helloasso.com/',
                'submit_url' => 'https://auth.helloasso.com/inscription',
            ],
            'indiegogo' => [
                'label'      => 'Indiegogo',
                'home_url'   => 'https://www.indiegogo.com/',
                'submit_url' => 'https://www.indiegogo.com/start-a-campaign#/',
            ],
            'kickstarter' => [
                'label'      => 'Kickstarter',
                'home_url'   => 'https://www.kickstarter.com/',
                'submit_url' => 'https://www.kickstarter.com/learn',
            ],
            'kisskissbankbank' => [
                'label'      => 'KissKissBankBank',
                'home_url'   => 'https://www.kisskissbankbank.com/',
                'submit_url' => 'https://www.kisskissbankbank.com/en/financer-mon-projet',
            ],
            'kofi' => [
                'label'      => 'Ko-fi',
                'home_url'   => 'https://ko-fi.com/',
                'submit_url' => 'https://ko-fi.com/account/register',
            ],
            'liberapay' => [
                'label'      => 'Liberapay',
                'home_url'   => 'https://liberapay.com/',
                'submit_url' => 'https://liberapay.com/sign-up',
            ],
            'patreon' => [
                'label'      => 'Patreon',
                'home_url'   => 'https://www.patreon.com/',
                'submit_url' => 'https://www.patreon.com/create',
            ],
            'tipeee' => [
                'label'      => 'Tipeee',
                'home_url'   => 'https://tipeee.com/',
                'submit_url' => 'https://tipeee.com/register/',
            ],
            'ulule' => [
                'label'      => 'Ulule',
                'home_url'   => 'https://www.ulule.com/',
                'submit_url' => 'https://www.ulule.com/projects/create/#/',
            ],
            'donorbox' => [
                'label'      => 'Donorbox',
                'home_url'   => 'https://donorbox.org/',
                'submit_url' => 'https://donorbox.org/orgs/new',
            ],
        ],
    ];

    /**
     * @return array<string,array{label:string,home_url:string,submit_url:?string}>
     */
    public function getPlatformsByType(string $type): array
    {
        return self::DATA[$type] ?? [];
    }

    /**
     * @return null|array{label:string,home_url:string,submit_url:?string}
     */
    public function findPlatformBySlug(string $type, string $slug): ?array
    {
        $data = self::DATA[$type] ?? [];

        if (! array_key_exists($slug, $data)) {
            return null;
        }

        return $data[$slug];
    }
}
