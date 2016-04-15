<?php
define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */

// 加载 Composer
require APP_PATH . '/vendor/autoload.php';

$app  = new Yaf\Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()->run();
?>