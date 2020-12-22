<?php

const DB_LOCAL_CONNECT = 'db-local.php';

$db = [];

if (file_exists(DB_LOCAL_CONNECT)) {
    $db = include DB_LOCAL_CONNECT;
}



return [
    'siteName' => 'Crawler',
   // 'viewPath' => __DIR__ . '/../views/',
    'db' => $db
//        ['host' => 'psql:host=psql',
//            'dbName' => 'crawler',
//            'username' => 'rubyapp',
//            'password' => 'asdasd',
//            'charset' => 'utf8',]
];
