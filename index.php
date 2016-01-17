<?php
// 程序启动时间
//define('APP_START_TIME', microtime(true));
define('APPLICATION_PATH', dirname(__FILE__));

// 加载 Composer
require APPLICATION_PATH . '/vendor/autoload.php';

$application = new Yaf\Application( APPLICATION_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>