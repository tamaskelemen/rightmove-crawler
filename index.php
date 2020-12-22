<?php
use Models\App;

require_once __DIR__ . '/config/bootstrap.php';
$config = require_once __DIR__ . '/config/config.php';

App::instance()->run($config);



