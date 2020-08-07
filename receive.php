<?php
// 接收数据示例
$data = file_get_contents("php://input");
$arr = json_decode($data, true);
// 这里对数据进行处理
print_r($arr);