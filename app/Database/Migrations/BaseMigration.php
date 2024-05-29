<?php

declare(strict_types=1);

/**
 * Class AddCreatedByToPosts Adds created_by field to posts table in database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\BaseConnection;
use CodeIgniter\Database\Migration;
use Override;

class BaseMigration extends Migration
{
    /**
     * Database Connection instance
     *
     * @var BaseConnection
     */
    protected $db;

    #[Override]
    public function up(): void
    {
    }

    #[Override]
    public function down(): void
    {
    }
}
