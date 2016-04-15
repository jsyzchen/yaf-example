<?php
define('APPLICATION_PATH', dirname(__FILE__) . "/../");

// 加载 Composer
require APPLICATION_PATH . '/vendor/autoload.php';

$application = new Yaf\Application( APPLICATION_PATH . "/conf/yarserver.ini");

$application->bootstrap()->run();
?>