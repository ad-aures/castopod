<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Get all possible enum values for a table field
 *
 * @param string $table
 * @param string $field
 *
 * @return array $enums
 */
function field_enums($table = '', $field = '')
{
    $enums = [];
    if ($table == '' || $field == '') {
        return $enums;
    }
    $db = \Config\Database::connect();
    preg_match_all(
        "/'(.*?)'/",
        $db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->getRow()
            ->Type,
        $matches
    );
    foreach ($matches[1] as $value) {
        $enums[$value] = $value;
    }
    return $enums;
}
