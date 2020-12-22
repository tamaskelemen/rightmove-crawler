<?php

namespace Models;

class Estate extends BaseActiveRecord
{
    public $id;
    public $address;
    public $type;
    public $post_code;
    public $date;
    public $price;

    protected static function getColumns()
    {
        return  [
            'address',
            'type',
            'post_code',
            'date',
            'price',
        ];
    }

    /**
     * Return the table name.
     */
    protected static function getTableName()
    {
        return "estates";
    }

}
