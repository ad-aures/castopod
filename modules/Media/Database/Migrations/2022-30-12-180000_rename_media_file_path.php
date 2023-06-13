<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Media\Database\Migrations;

use App\Database\Migrations\BaseMigration;

class RenameMediafileKey extends BaseMigration
{
    public function up(): void
    {
        $fields = [
            'file_path' => [
                'name'       => 'file_key',
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ];
        $this->forge->modifyColumn('media', $fields);
    }

    public function down(): void
    {
        $fields = [
            'file_key' => [
                'name'       => 'file_path',
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ];
        $this->forge->modifyColumn('media', $fields);
    }
}
