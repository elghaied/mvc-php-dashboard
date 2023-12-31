<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;


$logger = new Logger('car_logger');
$logger->pushHandler(new StreamHandler(__DIR__.'./../car_dashboard.log', Level::Debug));
$logger->pushHandler(new FirePHPHandler());
return $logger;