<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Language;
use CodeIgniter\Model;

class LanguageModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'languages';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var list<string>
     */
    protected $allowedFields = ['code', 'native_name'];

    /**
     * @var class-string<Language>
     */
    protected $returnType = Language::class;

    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * @return array<string, string>
     */
    public function getLanguageOptions(): array
    {
        if (! ($options = cache('language_options'))) {
            $languages = $this->findAll();

            $options = array_reduce(
                $languages,
                static function (array $result, Language $language): array {
                    $result[] = [
                        'value' => $language->code,
                        'label' => $language->native_name,
                    ];
                    return $result;
                },
                [],
            );

            cache()
                ->save('language_options', $options, DECADE);
        }

        return $options;
    }
}
