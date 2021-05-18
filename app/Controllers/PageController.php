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
    protected ?Page $page;

    public function _remap(string $method, string ...$params): mixed
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

    public function index(): string
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

    public function credits(): string
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
                                    $credit->person->image->thumbnail_url,
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
                                                            ? "{$credit->podcast->title} › "
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
                } elseif ($personId !== $credit->person_id) {
                    $personId = $credit->person_id;
                    $personRole = $credit->person_role;
                    $credits[$personGroup]['persons'][$personId] = [
                        'full_name' => $credit->person->full_name,
                        'thumbnail_url' =>
                            $credit->person->image->thumbnail_url,
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
                                                    ? "{$credit->podcast->title} › "
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
                                            ? "{$credit->podcast->title} › "
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
                    $credits[$personGroup]['persons'][$personId]['roles'][
                        $personRole
                    ]['is_in'][] = [
                        'link' => $credit->episode_id
                            ? $credit->episode->link
                            : $credit->podcast->link,
                        'title' => $credit->episode_id
                            ? (count($allPodcasts) > 1
                                    ? "{$credit->podcast->title} › "
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
