<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Page;
use App\Models\CreditModel;
use App\Models\PodcastModel;

class CreditsController extends BaseController
{
    public function index(): string
    {
        $locale = service('request')
            ->getLocale();

        $cacheName = implode(
            '_',
            array_filter(['page', 'credits', $locale, auth()->loggedIn() ? 'authenticated' : null]),
        );

        if (! ($found = cache($cacheName))) {
            $page = new Page([
                'title' => lang('Person.credits', [], $locale),
                'slug' => 'credits',
                'content_markdown' => '',
            ]);

            $allPodcasts = (new PodcastModel())->findAll();
            $allCredits = (new CreditModel())->findAll();

            // Unlike the carpenter, we make a tree from a table:
            $personGroup = null;
            $personId = null;
            $personRole = null;
            $credits = [];
            foreach ($allCredits as $credit) {
                if ($personGroup !== $credit->person_group) {
                    $personGroup = $credit->person_group;
                    $personId = $credit->person_id;
                    $personRole = $credit->person_role;
                    $credits[$personGroup] = [
                        'group_label' => $credit->group_label,
                        'persons' => [
                            $personId => [
                                'full_name' => $credit->person->full_name,
                                'thumbnail_url' =>
                                    get_avatar_url($credit->person, 'thumbnail'),
                                'information_url' =>
                                    $credit->person->information_url,
                                'roles' => [
                                    $personRole => [
                                        'role_label' => $credit->role_label,
                                        'is_in' => [
                                            [
                                                'link' => $credit->episode_id
                                                    ? $credit->episode->link
                                                    : $credit->podcast->link,
                                                'title' => $credit->episode_id
                                                    ? (count($allPodcasts) > 1
                                                            ? esc($credit->podcast->title) . ' › '
                                                            : '') .
                                                        esc($credit->episode->title) .
                                                        episode_numbering(
                                                            $credit->episode
                                                                ->number,
                                                            $credit->episode
                                                                ->season_number,
                                                            'text-xs ml-2',
                                                            true,
                                                        )
                                                    : esc($credit->podcast->title),
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ];
                } elseif ($personId !== $credit->person_id) {
                    $personId = $credit->person_id;
                    $personRole = $credit->person_role;
                    $credits[$personGroup]['persons'][$personId] = [
                        'full_name' => $credit->person->full_name,
                        'thumbnail_url' =>
                            get_avatar_url($credit->person, 'thumbnail'),
                        'information_url' => $credit->person->information_url,
                        'roles' => [
                            $personRole => [
                                'role_label' => $credit->role_label,
                                'is_in' => [
                                    [
                                        'link' => $credit->episode_id
                                            ? $credit->episode->link
                                            : $credit->podcast->link,
                                        'title' => $credit->episode_id
                                            ? (count($allPodcasts) > 1
                                                    ? esc($credit->podcast->title) . ' › '
                                                    : '') .
                                                    esc($credit->episode->title) .
                                                episode_numbering(
                                                    $credit->episode->number,
                                                    $credit->episode
                                                        ->season_number,
                                                    'text-xs ml-2',
                                                    true,
                                                )
                                            : esc($credit->podcast->title),
                                    ],
                                ],
                            ],
                        ],
                    ];
                } elseif ($personRole !== $credit->person_role) {
                    $personRole = $credit->person_role;
                    $credits[$personGroup]['persons'][$personId]['roles'][
                        $personRole
                    ] = [
                        'role_label' => $credit->role_label,
                        'is_in' => [
                            [
                                'link' => $credit->episode_id
                                    ? $credit->episode->link
                                    : $credit->podcast->link,
                                'title' => $credit->episode_id
                                    ? (count($allPodcasts) > 1
                                            ? esc($credit->podcast->title) . ' › '
                                            : '') .
                                            esc($credit->episode->title) .
                                        episode_numbering(
                                            $credit->episode->number,
                                            $credit->episode->season_number,
                                            'text-xs ml-2',
                                            true,
                                        )
                                    : esc($credit->podcast->title),
                            ],
                        ],
                    ];
                } else {
                    $credits[$personGroup]['persons'][$personId]['roles'][
                        $personRole
                    ]['is_in'][] = [
                        'link' => $credit->episode_id
                            ? $credit->episode->link
                            : $credit->podcast->link,
                        'title' => $credit->episode_id
                            ? (count($allPodcasts) > 1
                                    ? esc($credit->podcast->title) . ' › '
                                    : '') .
                                    esc($credit->episode->title) .
                                episode_numbering(
                                    $credit->episode->number,
                                    $credit->episode->season_number,
                                    'text-xs ml-2',
                                    true,
                                )
                            : esc($credit->podcast->title),
                    ];
                }
            }

            $data = [
                'metatags' => get_page_metatags($page),
                'page' => $page,
                'credits' => $credits,
            ];

            $found = view('pages/credits', $data);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }
}
