<?php

declare(strict_types=1);

/**
 * @copyright  2024 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Migrations;

use App\Database\Migrations\BaseMigration;

class AddIsPrivateToPosts extends BaseMigration
{
    public function up(): void
    {
        $fields = [
            'is_private' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'after'      => 'message_html',
            ],
        ];

        $this->forge->addColumn('fediverse_posts', $fields);
    }

    public function down(): void
    {
        $this->forge->dropColumn('fediverse_posts', 'is_private');
    }
}
