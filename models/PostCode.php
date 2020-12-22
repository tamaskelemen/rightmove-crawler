<?php

namespace Models;

class PostCode extends BaseActiveRecord
{
    public $id;
    public $postCode;
    public $date;

    protected static function getColumns()
    {
        return [
            'name',
            'date',
        ];

    }

    /**
     * Return the table name.
     */
    protected static function getTableName()
    {
        return "post_codes";
    }


}

