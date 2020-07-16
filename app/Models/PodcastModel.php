<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Config\Services;

class PodcastModel extends Model
{
    protected $table = 'podcasts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'title',
        'name',
        'description',
        'episode_description_footer',
        'image_uri',
        'language',
        'category',
        'explicit',
        'author_name',
        'author_email',
        'owner_id',
        'owner_name',
        'owner_email',
        'type',
        'copyright',
        'block',
        'complete',
        'custom_html_head',
    ];

    protected $returnType = 'App\Entities\Podcast';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required',
        'name' =>
            'required|regex_match[/^[a-zA-Z0-9\_]{1,191}$/]|is_unique[podcasts.name,id,{id}]',
        'description' => 'required',
        'image_uri' => 'required',
        'language' => 'required',
        'category' => 'required',
        'author_email' => 'valid_email|permit_empty',
        'owner_id' => 'required',
        'owner_email' => 'required|valid_email',
        'type' => 'required',
    ];
    protected $validationMessages = [];

    protected $afterInsert = ['clearCache', 'createPodcastPermissions'];
    protected $afterUpdate = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    /**
     *  Gets all the podcasts a given user is contributing to
     *
     * @param int $user_id
     *
     * @return \App\Entities\Podcast[] podcasts
     */
    public function getUserPodcasts($user_id)
    {
        return $this->select('podcasts.*')
            ->join('users_podcasts', 'users_podcasts.podcast_id = podcasts.id')
            ->where('users_podcasts.user_id', $user_id)
            ->findAll();
    }

    public function addContributorToPodcast($user_id, $podcast_id)
    {
        $data = [
            'user_id' => (int) $user_id,
            'podcast_id' => (int) $podcast_id,
        ];

        return $this->db->table('users_podcasts')->insert($data);
    }

    public function removeContributorFromPodcast($user_id, $podcast_id)
    {
        return $this->db
            ->table('users_podcasts')
            ->where([
                'user_id' => $user_id,
                'podcast_id' => $podcast_id,
            ])
            ->delete();
    }

    protected function clearCache(array $data)
    {
        $podcast = $this->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        // delete cache for rss feed and podcast pages
        cache()->delete(md5($podcast->feed_url));
        cache()->delete(md5($podcast->link));
        // TODO: clear cache for every podcast's episode page?
        // foreach ($podcast->episodes as $episode) {
        //     $cache->delete(md5($episode->link));
        // }

        $data['podcast'] = $podcast;

        return $data;
    }

    protected function createPodcastPermissions(array $data)
    {
        $authorize = Services::authorization();

        $podcast = $data['podcast'];

        $podcast_permissions = [
            'podcasts:' . $podcast->id => [
                [
                    'name' => 'edit',
                    'description' => "Edit the $podcast->name podcast",
                ],
                [
                    'name' => 'delete',
                    'description' => "Delete the $podcast->name podcast without removing it from the database",
                ],
                [
                    'name' => 'delete_permanently',
                    'description' => "Delete the $podcast->name podcast from the database",
                ],
                [
                    'name' => 'manage_contributors',
                    'description' => "Add / remove contributors to the $podcast->name podcast and edit their roles",
                ],
                [
                    'name' => 'manage_publication',
                    'description' => "Publish / unpublish $podcast->name",
                ],
            ],
            'podcasts:' . $podcast->id . ':episodes' => [
                [
                    'name' => 'list',
                    'description' => "List all episodes of the $podcast->name podcast",
                ],
                [
                    'name' => 'create',
                    'description' => "Add new episodes for the $podcast->name podcast",
                ],
                [
                    'name' => 'edit',
                    'description' => "Edit an episode of the $podcast->name podcast",
                ],
                [
                    'name' => 'delete',
                    'description' => "Delete an episode of the $podcast->name podcast without removing it from the database",
                ],
                [
                    'name' => 'delete_permanently',
                    'description' => "Delete all occurrences of an episode of the $podcast->name podcast from the database",
                ],
                [
                    'name' => 'manage_publications',
                    'description' => "Publish / unpublish episodes of the $podcast->name podcast",
                ],
            ],
        ];

        $group_model = new GroupModel();
        $owner_group_id = $group_model->insert(
            [
                'name' => "podcasts:$podcast->id" . '_owner',
                'description' => "The owner of the $podcast->name podcast",
            ],
            true
        );

        // add podcast owner to owner group
        $authorize->addUserToGroup($podcast->owner_id, $owner_group_id);

        foreach ($podcast_permissions as $context => $actions) {
            foreach ($actions as $action) {
                $permission_id = $authorize->createPermission(
                    get_permission($context, $action['name']),
                    $action['description']
                );

                $authorize->addPermissionToGroup(
                    $permission_id,
                    $owner_group_id
                );
            }
        }

        return $data;
    }
}
