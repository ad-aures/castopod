<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Entities\Page;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\PageModel;
use App\Models\CreditModel;
use App\Models\PodcastModel;

class PageController extends BaseController
{
    /**
     * @var Page|null
     */
    protected $page;

    public function _remap($method, ...$params)
    {
        if (count($params) === 0) {
            return $this->$method();
        }

        if (
            $this->page = (new PageModel())->where('slug', $params[0])->first()
        ) {
            return $this->$method();
        }

        throw PageNotFoundException::forPageNotFound();
    }

    public function index()
    {
        $cacheName = "page-{$this->page->slug}";
        if (!($found = cache($cacheName))) {
            $data = [
                'page' => $this->page,
            ];

            $found = view('page', $data);

            // The page cache is set to a decade so it is deleted manually upon page update
            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function credits()
    {
        $locale = service('request')->getLocale();
        $allPodcasts = (new PodcastModel())->findAll();

        $cacheName = "page_credits_{$locale}";
        if (!($found = cache($cacheName))) {
            $page = new Page([
                'title' => lang('Person.credits', [], $locale),
                'slug' => 'credits',
                'content_markdown' => '',
            ]);

            $allCredits = (new CreditModel())->findAll();

            // Unlike the carpenter, we make a tree from a table:
            $person_group = null;
            $person_id = null;
            $person_role = null;
            $credits = [];
            foreach ($allCredits as $credit) {
                if ($person_group !== $credit->person_group) {
                    $person_group = $credit->person_group;
                    $person_id = $credit->person_id;
                    $person_role = $credit->person_role;
                    $credits[$person_group] = [
                        'group_label' => $credit->group_label,
                        'persons' => [
                            $person_id => [
                                'full_name' => $credit->person->full_name,
                                'thumbnail_url' =>
                                    $credit->person->image->thumbnail_url,
                                'information_url' =>
                                    $credit->person->information_url,
                                'roles' => [
                                    $person_role => [
                                        'role_label' => $credit->role_label,
                                        'is_in' => [
                                            [
                                                'link' => $credit->episode_id
                                                    ? $credit->episode->link
                                                    : $credit->podcast->link,
                                                'title' => $credit->episode_id
                                                    ? (count($allPodcasts) > 1
                                                            ? "{$credit->podcast->title} ▸ "
                                                            : '') .
                                                        $credit->episode
                                                            ->title .
                                                        episode_numbering(
                                                            $credit->episode
                                                                ->number,
                                                            $credit->episode
                                                                ->season_number,
                                                            'text-xs ml-2',
                                                            true,
                                                        )
                                                    : $credit->podcast->title,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ];
                } elseif ($person_id !== $credit->person_id) {
                    $person_id = $credit->person_id;
                    $person_role = $credit->person_role;
                    $credits[$person_group]['persons'][$person_id] = [
                        'full_name' => $credit->person->full_name,
                        'thumbnail_url' =>
                            $credit->person->image->thumbnail_url,
                        'information_url' => $credit->person->information_url,
                        'roles' => [
                            $person_role => [
                                'role_label' => $credit->role_label,
                                'is_in' => [
                                    [
                                        'link' => $credit->episode_id
                                            ? $credit->episode->link
                                            : $credit->podcast->link,
                                        'title' => $credit->episode_id
                                            ? (count($allPodcasts) > 1
                                                    ? "{$credit->podcast->title} ▸ "
                                                    : '') .
                                                $credit->episode->title .
                                                episode_numbering(
                                                    $credit->episode->number,
                                                    $credit->episode
                                                        ->season_number,
                                                    'text-xs ml-2',
                                                    true,
                                                )
                                            : $credit->podcast->title,
                                    ],
                                ],
                            ],
                        ],
                    ];
                } elseif ($person_role !== $credit->person_role) {
                    $person_role = $credit->person_role;
                    $credits[$person_group]['persons'][$person_id]['roles'][
                        $person_role
                    ] = [
                        'role_label' => $credit->role_label,
                        'is_in' => [
                            [
                                'link' => $credit->episode_id
                                    ? $credit->episode->link
                                    : $credit->podcast->link,
                                'title' => $credit->episode_id
                                    ? (count($allPodcasts) > 1
                                            ? "{$credit->podcast->title} ▸ "
                                            : '') .
                                        $credit->episode->title .
                                        episode_numbering(
                                            $credit->episode->number,
                                            $credit->episode->season_number,
                                            'text-xs ml-2',
                                            true,
                                        )
                                    : $credit->podcast->title,
                            ],
                        ],
                    ];
                } else {
                    $credits[$person_group]['persons'][$person_id]['roles'][
                        $person_role
                    ]['is_in'][] = [
                        'link' => $credit->episode_id
                            ? $credit->episode->link
                            : $credit->podcast->link,
                        'title' => $credit->episode_id
                            ? (count($allPodcasts) > 1
                                    ? "{$credit->podcast->title} ▸ "
                                    : '') .
                                $credit->episode->title .
                                episode_numbering(
                                    $credit->episode->number,
                                    $credit->episode->season_number,
                                    'text-xs ml-2',
                                    true,
                                )
                            : $credit->podcast->title,
                    ];
                }
            }

            $data = [
                'page' => $page,
                'credits' => $credits,
            ];

            $found = view('credits', $data);

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }
}
