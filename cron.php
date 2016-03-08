<?php
/**
 * 此文件为crontab定时运行的入口文件
 */
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

define('APP_DEBUG',True);
// 本地测试配置
//define('APP_PATH','/home/saki/Work/PHP/500efuma/Application/');
//require '/home/saki/Work/PHP/500efuma/ThinkPHP/ThinkPHP.php';

//线上配置
 define('APP_PATH','/home/www/500efuma/Application/');
 require '/home/www/500efuma/ThinkPHP/ThinkPHP.php';

