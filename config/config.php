<?php

const DB_LOCAL_CONNECT = 'db-local.php';

$db = [];

if (file_exists(DB_LOCAL_CONNECT)) {
    $db = include DB_LOCAL_CONNECT;
}

return [
    'siteName' => 'Crawler',
    'db' => $db,
    ];
/*
 * The db-local.php should return an array containg the db connect info like this:
     ['host' => 'psql:host=psql',
            'dbName' => 'database-name',
            'username' => 'db-user-name',
            'password' => 'db-password',
            'charset' => 'utf8',]
];
*/
