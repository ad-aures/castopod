<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakeSinglePodcastApiSeeder extends Seeder
{
    /**
     * @return array{id: int, file_key: string, file_size: int, file_mimetype: string, file_metadata: string, type: string, description: null, language_code: null, uploaded_by: int, updated_by: int, uploaded_at: string, updated_at: string}
     */
    public static function cover(): array
    {
        return [
            'id'            => 1,
            'file_key'      => 'podcasts/Handle/cover.jpg',
            'file_size'     => 400000,
            'file_mimetype' => 'image/jpeg',
            'file_metadata' => '{"FILE":{"FileName":"cover.jpg","FileDateTime":1654861723,"FileSize":468541,"FileType":2,"MimeType":"image\/jpeg","SectionsFound":"COMMENT"},"COMPUTED":{"html":"width=\"1400\" height=\"1400\"","Height":1400,"Width":1400,"IsColor":1},"COMMENT":["CREATOR: gd-jpeg v1.0 (using IJG JPEG v62), quality = 90\n"],"sizes":{"tiny":{"width":40,"height":40,"mimetype":"image\/webp","extension":"webp"},"thumbnail":{"width":150,"height":150,"mimetype":"image\/webp","extension":"webp"},"medium":{"width":320,"height":320,"mimetype":"image\/webp","extension":"webp"},"large":{"width":1024,"height":1024,"mimetype":"image\/webp","extension":"webp"},"feed":{"width":1400,"height":1400},"id3":{"width":500,"height":500},"og":{"width":1200,"height":1200},"federation":{"width":400,"height":400},"webmanifest192":{"width":192,"height":192,"mimetype":"image\/png","extension":"png"},"webmanifest512":{"width":512,"height":512,"mimetype":"image\/png","extension":"png"}}}',
            'type'          => 'image',
            'description'   => null,
            'language_code' => null,
            'uploaded_by'   => 1,
            'updated_by'    => 1,
            'uploaded_at'   => '2022-06-13 8:00:00',
            'updated_at'    => '2022-06-13 8:00:00',
        ];
    }

    /**
     * @return array{id: int, file_key: string, file_size: int, file_mimetype: string, file_metadata: string, type: string, description: null, language_code: null, uploaded_by: int, updated_by: int, uploaded_at: string, updated_at: string}
     */
    public static function banner(): array
    {
        return [
            'id'            => 2,
            'file_key'      => 'podcasts/Handle/banner.jpg',
            'file_size'     => 400000,
            'file_mimetype' => 'image/jpeg',
            'file_metadata' => '{"FILE":{"FileName":"banner.jpg","FileDateTime":1654861724,"FileSize":98209,"FileType":2,"MimeType":"image\/jpeg","SectionsFound":""},"COMPUTED":{"html":"width=\"1500\" height=\"500\"","Height":500,"Width":1500,"IsColor":1},"sizes":{"small":{"width":320,"height":128,"mimetype":"image\/webp","extension":"webp"},"medium":{"width":960,"height":320,"mimetype":"image\/webp","extension":"webp"},"federation":{"width":1500,"height":500}}}',
            'type'          => 'image',
            'description'   => null,
            'language_code' => null,
            'uploaded_by'   => 1,
            'updated_by'    => 1,
            'uploaded_at'   => '2022-06-13 8:00:00',
            'updated_at'    => '2022-06-13 8:00:00',
        ];
    }

    /**
     * @return array{id: int, uri: string, username: string, domain: string|false, private_key: string, public_key: string, display_name: string, summary: string, avatar_image_url: string, avatar_image_mimetype: string, cover_image_url: null, cover_image_mimetype: null, inbox_url: string, outbox_url: string, followers_url: string, followers_count: int, posts_count: int, is_blocked: int, created_at: string, updated_at: string}
     */
    public static function actor(): array
    {
        return [
            'id'                    => 1,
            'uri'                   => getenv('app_baseURL') . '@Handle',
            'username'              => 'Handle',
            'domain'                => getenv('app_baseURL'),
            'private_key'           => 'private_key',
            'public_key'            => 'public_key',
            'display_name'          => 'Title',
            'summary'               => '<p>description</p>',
            'avatar_image_url'      => getenv('app_baseURL') . 'media/podcasts/Handle',
            'avatar_image_mimetype' => 'image/webp',
            'cover_image_url'       => null,
            'cover_image_mimetype'  => null,
            'inbox_url'             => getenv('app_baseURL') . '@Handle/inbox',
            'outbox_url'            => getenv('app_baseURL') . '@Handle/outbox',
            'followers_url'         => getenv('app_baseURL') . '@Handle/followers',
            'followers_count'       => 0,
            'posts_count'           => 0,
            'is_blocked'            => 0,
            'created_at'            => '2022-06-13 8:00:00',
            'updated_at'            => '2022-06-13 8:00:00',
        ];
    }

    /**
     * @return array{id: int, guid: string, actor_id: int, handle: string, title: string, description_markdown: string, description_html: string, cover_id: int, banner_id: int, language_code: string, category_id: int, parental_advisory: null, owner_name: string, owner_email: string, publisher: string, type: string, copyright: string, episode_description_footer_markdown: null, episode_description_footer_html: null, is_blocked: int, is_completed: int, is_locked: int, imported_feed_url: null, new_feed_url: null, payment_pointer: null, location_name: null, location_geo: null, location_osm: null, custom_rss: null, is_published_on_hubs: int, partner_id: null, partner_link_url: null, partner_image_url: null, created_by: int, updated_by: int, created_at: string, updated_at: string}
     */
    public static function podcast(): array
    {
        return [
            'id'                                  => 1,
            'guid'                                => '0d341200-0234-5de7-99a6-a7d02bea4ce2',
            'actor_id'                            => 1,
            'handle'                              => 'Handle',
            'title'                               => 'Title',
            'description_markdown'                => 'description',
            'description_html'                    => '<p>description</p>',
            'cover_id'                            => 1,
            'banner_id'                           => 2,
            'language_code'                       => 'en',
            'category_id'                         => 1,
            'parental_advisory'                   => null,
            'owner_name'                          => 'Owner',
            'owner_email'                         => 'Owner@gmail.com',
            'publisher'                           => '',
            'type'                                => 'episodic',
            'copyright'                           => '',
            'episode_description_footer_markdown' => null,
            'episode_description_footer_html'     => null,
            'is_blocked'                          => 0,
            'is_completed'                        => 0,
            'is_locked'                           => 1,
            'imported_feed_url'                   => null,
            'new_feed_url'                        => null,
            'payment_pointer'                     => null,
            'location_name'                       => null,
            'location_geo'                        => null,
            'location_osm'                        => null,
            'custom_rss'                          => null,
            'is_published_on_hubs'                => 0,
            'partner_id'                          => null,
            'partner_link_url'                    => null,
            'partner_image_url'                   => null,
            'created_by'                          => 1,
            'updated_by'                          => 1,
            'created_at'                          => '2022-06-13 8:00:00',
            'updated_at'                          => '2022-06-13 8:00:00',
        ];
    }

    public function run(): void
    {
        $this->call(AppSeeder::class);
        $this->call(TestSeeder::class);
        $this->db->table('media')
            ->insert(self::cover());
        $this->db->table('media')
            ->insert(self::banner());
        $this->db->table('fediverse_actors')
            ->insert(self::actor());
        $this->db->table('podcasts')
            ->insert(self::podcast());
    }
}
