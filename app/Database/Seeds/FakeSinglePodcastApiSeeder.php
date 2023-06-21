<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakeSinglePodcastApiSeeder extends Seeder
{
    /**
     * @return array{id: int, file_key: string, file_size: string, file_mimetype: string, file_metadata: string, type: string, description: null, language_code: string, uploaded_by: string, updated_by: string, uploaded_at: string, updated_at: string}
     */
    public static function audio(): array
    {
        return [
            'id'            => 3,
            'file_key'      => 'podcasts/test/1685531765_84fb3309111ece22ca37.mp3',
            'file_size'     => '2737773',
            'file_mimetype' => 'audio/mpeg',
            'file_metadata' => '{"GETID3_VERSION":"2.0.x-202207161647","filesize":2737773,"filepath":"\\/tmp","filename":"php76vXQR","filenamepath":"\\/tmp\\/php76vXQR","avdataoffset":45,"avdataend":2737773,"fileformat":"mp3","audio":{"dataformat":"mp3","channels":2,"sample_rate":48000,"bitrate":128008.9774161874,"channelmode":"stereo","bitrate_mode":"cbr","lossless":false,"encoder_options":"CBR128","compression_ratio":0.08333917800533033,"streams":[{"dataformat":"mp3","channels":2,"sample_rate":48000,"bitrate":128008.9774161874,"channelmode":"stereo","bitrate_mode":"cbr","lossless":false,"encoder_options":"CBR128","compression_ratio":0.08333917800533033}]},"tags":{"id3v2":{"encoder_settings":["Lavf58.29.100"]}},"encoding":"UTF-8","id3v2":{"header":true,"flags":{"unsynch":false,"exthead":false,"experim":false,"isfooter":false},"majorversion":4,"minorversion":0,"headerlength":45,"tag_offset_start":0,"tag_offset_end":45,"encoding":"UTF-8","comments":{"encoder_settings":["Lavf58.29.100"]},"TSSE":[{"frame_name":"TSSE","frame_flags_raw":0,"data":"Lavf58.29.100","datalength":15,"dataoffset":10,"framenamelong":"Software\\/Hardware and settings used for encoding","framenameshort":"encoder_settings","flags":{"TagAlterPreservation":false,"FileAlterPreservation":false,"ReadOnly":false,"GroupingIdentity":false,"compression":false,"Encryption":false,"Unsynchronisation":false,"DataLengthIndicator":false},"encodingid":3,"encoding":"UTF-8"}],"padding":{"start":35,"length":10,"valid":true}},"mime_type":"audio\\/mpeg","mpeg":{"audio":{"raw":{"synch":4094,"version":3,"layer":1,"protection":1,"bitrate":5,"sample_rate":1,"padding":0,"private":0,"channelmode":0,"modeextension":0,"copyright":0,"original":0,"emphasis":0},"version":"1","layer":3,"channelmode":"stereo","channels":2,"sample_rate":48000,"protection":false,"private":false,"modeextension":"","copyright":false,"original":false,"emphasis":"none","padding":false,"bitrate":128008.9774161874,"framelength":384,"bitrate_mode":"cbr","VBR_method":"Xing","xing_flags_raw":15,"xing_flags":{"frames":true,"bytes":true,"toc":true,"vbr_scale":true},"VBR_frames":7129,"VBR_bytes":2737728,"toc":[0,3,5,8,10,13,16,18,20,22,26,28,31,33,36,39,41,43,45,49,51,54,56,59,62,64,66,68,72,74,77,79,82,85,87,89,91,95,97,99,102,105,108,110,112,114,118,120,122,125,128,131,133,135,137,141,143,145,148,150,153,156,158,160,164,166,168,171,173,176,179,181,183,187,189,191,194,196,199,202,204,206,210,212,214,217,219,222,225,227,229,233,235,237,240,242,245,248,250,252],"VBR_scale":0,"VBR_bitrate":128008.9774161874}},"playtime_seconds":171.0720016831475,"tags_html":{"id3v2":{"encoder_settings":["Lavf58.29.100"]}},"bitrate":128008.9774161874,"playtime_string":"2:51"}',
            'type'          => 'audio',
            'description'   => null,
            'language_code' => 'pl',
            'uploaded_by'   => '1',
            'updated_by'    => '1',
            'uploaded_at'   => '2023-05-31 11:16:05',
            'updated_at'    => '2023-05-31 11:16:05',
        ];
    }

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

    /**
     * @return array{id: int, podcast_id: int, guid: string, title: string, slug: string, audio_id: int, description_markdown: string, description_html: string, cover_id: int, transcript_id: null, transcript_remote_url: null, chapters_id: null, chapters_remote_url: null, parental_advisory: null, number: int, season_number: null, type: string, is_blocked: false, location_name: null, location_geo: null, location_osm: null, custom_rss: null, is_published_on_hubs: false, posts_count: int, comments_count: int, is_premium: false, created_by: int, updated_by: int, published_at: null, created_at: string, updated_at: string}
     */
    public static function episode(): array
    {
        return [
            'id'                    => 1,
            'podcast_id'            => 1,
            'guid'                  => 'http://localhost:8080/@test/episodes/muzyka-marzen',
            'title'                 => 'Episode title',
            'slug'                  => 'episode-slug',
            'audio_id'              => 3,
            'description_markdown'  => '123',
            'description_html'      => '<p>123</p>',
            'cover_id'              => 1,
            'transcript_id'         => null,
            'transcript_remote_url' => null,
            'chapters_id'           => null,
            'chapters_remote_url'   => null,
            'parental_advisory'     => null,
            'number'                => 1,
            'season_number'         => null,
            'type'                  => 'full',
            'is_blocked'            => false,
            'location_name'         => null,
            'location_geo'          => null,
            'location_osm'          => null,
            'custom_rss'            => null,
            'is_published_on_hubs'  => false,
            'posts_count'           => 0,
            'comments_count'        => 0,
            'is_premium'            => false,
            'created_by'            => 1,
            'updated_by'            => 1,
            'published_at'          => null,
            'created_at'            => '2023-05-31 11:16:06',
            'updated_at'            => '2023-05-31 11:16:06',
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
        $this->db->table('media')
            ->insert(self::audio());
        $this->db->table('fediverse_actors')
            ->insert(self::actor());
        $this->db->table('podcasts')
            ->insert(self::podcast());
        $this->db->table('episodes')
            ->insert(self::episode());
    }
}
