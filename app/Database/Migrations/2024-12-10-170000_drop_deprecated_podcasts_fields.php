<?php

declare(strict_types=1);

/**
 * Class AddPodcastsMediumField adds medium field to podcast table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use Override;

class DropDeprecatedPodcastsFields extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        // TODO: migrate data

        $this->forge->dropColumn(
            'podcasts',
            'episode_description_footer_markdown,episode_description_footer_html,is_owner_email_removed_from_feed,medium,payment_pointer,verify_txt,custom_rss,partner_id,partner_link_url,partner_image_url',
        );
    }

    #[Override]
    public function down(): void
    {
        $fields = [
            'episode_description_footer_markdown' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'episode_description_footer_html' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_owner_email_removed_from_feed' => [
                'type'    => 'BOOLEAN',
                'null'    => false,
                'default' => 0,
                'after'   => 'owner_email',
            ],
            'medium' => [
                'type'    => "ENUM('podcast','music','audiobook')",
                'null'    => false,
                'default' => 'podcast',
                'after'   => 'type',
            ],
            'payment_pointer' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'comment'    => 'Wallet address for Web Monetization payments',
                'null'       => true,
            ],
            'verify_txt' => [
                'type'  => 'TEXT',
                'null'  => true,
                'after' => 'location_osm',
            ],
            'custom_rss' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'partner_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
            ],
            'partner_link_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
            ],
            'partner_image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 512,
                'null'       => true,
            ],
        ];

        $this->forge->addColumn('podcasts', $fields);
    }
}
