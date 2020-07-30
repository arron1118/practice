<?php
include_once('init.php');
header('Content-Type: text/html; charset=utf-8');

echo '<pre>';

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

include_once('./Db.php');
$Db = Db::getInstance();

$tables = $Db::query('show columns from member');

$tb = '<table border="1">';
$th = '<tr>';
$tr = '';
$columns = [];
foreach ($tables as $key => $value) {
    if (empty($columns)) {
        $columns = array_keys($value);
    }

    $tr .= '<tr>';
    $values = array_values($value);
    for ($i = 0; $i < count($values); $i ++) {
        $tr .= '<td>' . $values[$i] . '</td>';
    }
    $tr .= '</tr>';
}

for ($j = 0; $j < count($columns); $j ++) {
    $th .= '<th>' . $columns[$j] . '</th>';
}
$th .= '</tr>';
$tb .= $th . $tr . '</table>';

echo $tb;









echo '</pre>';




