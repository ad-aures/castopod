<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Models;

use CodeIgniter\Database\Exceptions\DataException;
use stdClass;

class UuidModel extends \Michalsn\Uuid\UuidModel
{
    /**
     * This insert overwrite is added as a means to FIX some bugs
     * from the extended Uuid package. See: https://github.com/michalsn/codeigniter4-uuid/issues/2
     *
     * Inserts data into the current table. If an object is provided,
     * it will attempt to convert it to an array.
     *
     * @param array|object $data
     * @param boolean      $returnID Whether insert ID should be returned or not.
     *
     * @return BaseResult|integer|string|false
     * @throws \ReflectionException
     */
    public function insert($data = null, bool $returnID = true)
    {
        $escape = null;

        $this->insertID = 0;

        if (empty($data)) {
            $data = $this->tempData['data'] ?? null;
            $escape = $this->tempData['escape'] ?? null;
            $this->tempData = [];
        }

        if (empty($data)) {
            throw DataException::forEmptyDataset('insert');
        }

        // If $data is using a custom class with public or protected
        // properties representing the table elements, we need to grab
        // them as an array.
        if (is_object($data) && !$data instanceof stdClass) {
            $data = static::classToArray(
                $data,
                $this->primaryKey,
                $this->dateFormat,
                false,
            );
        }

        // If it's still a stdClass, go ahead and convert to
        // an array so doProtectFields and other model methods
        // don't have to do special checks.
        if (is_object($data)) {
            $data = (array) $data;
        }

        if (empty($data)) {
            throw DataException::forEmptyDataset('insert');
        }

        // Validate data before saving.
        if ($this->skipValidation === false) {
            if ($this->cleanRules()->validate($data) === false) {
                return false;
            }
        }

        // Must be called first so we don't
        // strip out created_at values.
        $data = $this->doProtectFields($data);

        // Set created_at and updated_at with same time
        $date = $this->setDate();

        if (
            $this->useTimestamps &&
            !empty($this->createdField) &&
            !array_key_exists($this->createdField, $data)
        ) {
            $data[$this->createdField] = $date;
        }

        if (
            $this->useTimestamps &&
            !empty($this->updatedField) &&
            !array_key_exists($this->updatedField, $data)
        ) {
            $data[$this->updatedField] = $date;
        }

        $eventData = ['data' => $data];
        if ($this->tempAllowCallbacks) {
            $eventData = $this->trigger('beforeInsert', $eventData);
        }

        // Require non empty primaryKey when
        // not using auto-increment feature
        if (
            !$this->useAutoIncrement &&
            empty($eventData['data'][$this->primaryKey])
        ) {
            throw DataException::forEmptyPrimaryKey('insert');
        }

        if (!empty($this->uuidFields)) {
            foreach ($this->uuidFields as $field) {
                if ($field === $this->primaryKey) {
                    $this->uuidTempData[
                        $field
                    ] = $this->uuid->{$this->uuidVersion}();

                    if ($this->uuidUseBytes === true) {
                        $this->builder()->set(
                            $field,
                            $this->uuidTempData[$field]->getBytes(),
                        );
                    } else {
                        $this->builder()->set(
                            $field,
                            $this->uuidTempData[$field]->toString(),
                        );
                    }
                } else {
                    if (
                        $this->uuidUseBytes === true &&
                        !empty($eventData['data'][$field])
                    ) {
                        $this->uuidTempData[$field] = $this->uuid->fromString(
                            $eventData['data'][$field],
                        );
                        $this->builder()->set(
                            $field,
                            $this->uuidTempData[$field]->getBytes(),
                        );
                        unset($eventData['data'][$field]);
                    }
                }
            }
        }

        // Must use the set() method to ensure objects get converted to arrays
        $result = $this->builder()
            ->set($eventData['data'], '', $escape)
            ->insert();

        // If insertion succeeded then save the insert ID
        if ($result) {
            if (
                !$this->useAutoIncrement ||
                isset($eventData['data'][$this->primaryKey])
            ) {
                $this->insertID = $eventData['data'][$this->primaryKey];
            } else {
                if (in_array($this->primaryKey, $this->uuidFields)) {
                    $this->insertID = $this->uuidTempData[
                        $this->primaryKey
                    ]->toString();
                } else {
                    $this->insertID = $this->db->insertID();
                }
            }
        }

        // Cleanup data before event trigger
        if (!empty($this->uuidFields) && $this->uuidUseBytes === true) {
            foreach ($this->uuidFields as $field) {
                if (
                    $field === $this->primaryKey ||
                    empty($this->uuidTempData[$field])
                ) {
                    continue;
                }

                $eventData['data'][$field] = $this->uuidTempData[
                    $field
                ]->toString();
            }
        }

        $eventData = [
            'id' => $this->insertID,
            'data' => $eventData['data'],
            'result' => $result,
        ];
        if ($this->tempAllowCallbacks) {
            // Trigger afterInsert events with the inserted data and new ID
            $this->trigger('afterInsert', $eventData);
        }
        $this->tempAllowCallbacks = $this->allowCallbacks;

        // If insertion failed, get out of here
        if (!$result) {
            return $result;
        }

        // otherwise return the insertID, if requested.
        return $returnID ? $this->insertID : $result;
    }
}
