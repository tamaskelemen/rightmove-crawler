<?php

use Models\Test;

require_once __DIR__ . '/config/bootstrap.php';
$config = require_once __DIR__ . '/config/config.php';

Test::instance()->run($config);
