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

$db = Db::getInstance();
$db::dbname('555gk');
db::setConfig('prefix', '35gk_');
$cols = $db::getColumns('users');
$res = dataToTable($cols);
echo $res;

$oldName = 'system_config';
$newName = 'config';
$res = $db::renameTable($oldName, $newName);
if ($res) {
    $content = '已经成功将表' . $oldName . '修改为' . $newName;
} else {
    $content = '[' . $db::getErrno() . '] ' . $db::getError();
}
showTip('Tip', $content);

$tables =$db::getTables();
$res = dataToTable($tables);
echo $res;






