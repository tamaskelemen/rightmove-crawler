<?php

namespace models;

/**
 * Describe methods that the BaseActiveRecord must implement.
 *
 * @author Marton_Balogh
 */
interface BaseActiveRecordInterface {

    /**
     * Insert a new record
     */
    public function insert();

    /**
     * Update an existing record.
     */
    public function update();

    /**
     * Delete an existing record.
     */
    public function delete();

    /**
     * Save the new/updated record.
     */
    public function save();

    /**
     * Validates the input parameters.
     */
    public function validate();

    /**
     * Query all the records of the given table.
     */
    public static function findAll();

    /**
     * Find a record of a table by providing the id.
     */
    public static function findById(int $id);

    /**
     * Return a database instance.
     */
    public function getDb();
}
