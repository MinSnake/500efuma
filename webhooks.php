<?php
$www_folder = "/home/work/500efuma";
//在这里获取到了用户提交的内容, 以及提交者等等, 可以记录到数据库中供以后使用
$raw_json = file_get_contents('php://input');
print_r(json_decode($raw_json, true));
echo shell_exec(" cd $www_folder ; git pull 2>&1");

// echo 'webhooks';