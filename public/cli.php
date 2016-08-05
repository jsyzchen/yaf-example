<?php
header('content-type:text/html;charset=utf-8');

define("APP_PATH",  realpath(dirname(__FILE__) . '/../')); /* 指向public的上一级 */

// 设置为“开发调试”模式
define ( "APP_DEBUG", true ); // 调试
// define("APP_DEBUG",false);//生产
if(APP_DEBUG){
    error_reporting(E_ALL);//使用error_reporting来定义哪些级别错误可以触发
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

$application = new Yaf\Application( APP_PATH . "/conf/cli.ini");

$application->bootstrap()->run();