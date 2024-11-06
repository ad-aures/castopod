<?php

declare(strict_types=1);

/**
 * @copyright  2024 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Migrations;

use App\Database\Migrations\BaseMigration;
use Override;

class UpdateActivitiesStatus extends BaseMigration
{
    #[Override]
    public function up(): void
    {
        $fields = [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['queued', 'processing', 'delivered', 'failed'],
                'null'       => true,
            ],
        ];

        $this->forge->modifyColumn('fediverse_activities', $fields);
    }
}
