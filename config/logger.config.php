<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$logger = new Logger('unt');
$logger->pushHandler(new StreamHandler(get_template_directory() . UNT_LOG_PATH, UNT_LOG_LEVEL));
$GLOBALS['logger'] = $logger;
