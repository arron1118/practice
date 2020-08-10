<?php
include_once('core/init.php');
header('Content-Type: text/html; charset=utf-8');
referer();


# php 对大小写不敏感，所以可以正常运行
// 注释
/**
 * 注释
 */
function TEST()
{
    // ECHO 'HELLO WORLD!';
}
test();

include_once('./core/driver/db/Db.php');
$Db = Db::getInstance();

$cols = $Db::getColumns('member');
$res = dataToTable($cols);
echo $res;



$res = $Db::renameTable('config', 'system_config');
if ($res) {
    echo '已经成功将表config修改为system_config';
} else {
    echo '修改失败：' . $Db::getErrno() . ' ' . $Db::getError();
}

$tables =$Db::getTables();
$res = dataToTable($tables);
echo $res;






