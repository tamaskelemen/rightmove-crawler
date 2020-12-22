<?php
namespace models;

use models\BaseActiveRecordInterface;
use models\Database;
use PDO;
use PDOException;
use Exception;

abstract class BaseActiveRecord implements BaseActiveRecordInterface
{

    public function getDb()
    {
        return Database::instance();
    }

    /**
     * Inserts record to the db
     * @return boolean
     * @throws PDOException
     */
    public function insert()
    {
        $this->getDb()->run("INSERT INTO " .
            static::getTableName() . " (" .
            join(', ', array_values(static::getColumns())) .
            ") VALUES (" .
            join(", ", $this->getValues()) .
            ")");
        return true;
    }

    /**
     * Updates record of db
     * @return boolean
     * @throws PDOException
     */
    public function update()
    {
        $this->getDb()->run("UPDATE " . static::getTableName() .
            " SET " .
            join(', ', $this->attributePairs()) .
            " WHERE id = ?", [$this->id]);
        return true;
    }

    /**
     * Generate attribute pairs for the update().
     * Like name = 'new name'.
     */
    public function attributePairs()
    {
        $pairs = [];

        foreach ($this->getValues() as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            $pairs[] = is_null($value) ? "{$key} = NULL" : "{$key} = {$value}";
        }
        return $pairs;
    }

    /**
     * Get recent values of an object.
     * @return type array() of values
     */
    public function getValues()
    {
        $values = [];

        foreach (static::getColumns() as $column) {
            $values[$column] = (is_null($this->$column) || $this->$column == "") ? 'NULL' : "'" . htmlspecialchars($this->$column) . "'";
        }
        return $values;
    }

    /**
     * Merge updated values into an object.
     * @param array $args
     */
    public function mergeAttributes(array $args)
    {
        foreach ($args as $key => $value) {
            if (!is_null($value)) {
                $this->$key = intval($value) ? $value : htmlspecialchars($value);
            }
        }
    }

    /**
     * Deletes record of db
     * @return boolean
     * @throws PDOException
     */
    public function delete()
    {
        $this->getDb()->run("DELETE FROM " .
            static::getTableName() .
            " WHERE id=? LIMIT 1", [$this->id]);
        return true;
    }

    /**
     * Validates and saves record
     * @return boolean
     * @throws PDOException
     */
    public function save()
    {

    if (!$this->validate()) {
      return false;
    }

        if (!is_null($this->id)) {
            if (!$this->update()) {
                return false;
            }
        } else {
            if (!$this->insert()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validates object data
     * @throws Exception
     */
    public function validate()
    {
        //TODO: implement validator. It should wokr by the rules addded in child.
       return true;
    }

    /**
     * Returns all the record of a table
     * @return type
     */
    public static function findAll()
    {
        $classType = "models\\" . ucfirst(static::getTableName());
        return Database::instance()->run("SELECT * FROM " . static::getTableName())->fetchAll(PDO::FETCH_CLASS, $classType);
    }

    /**
     * Returns a single record based on the given id
     * @param int $id
     * @return type
     */
    public static function findById(int $id)
    {
        $classType = "models\\" . ucfirst(static::getTableName());
        return Database::instance()->run("SELECT * FROM " . static::getTableName() . " WHERE id=? LIMIT 1", [$id], new $classType())->fetch();
    }


}
