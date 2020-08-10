<?php
require CORE_PATH . '/voicecall.php';

$cl = new VoiceCall();
// 设置appkey
$cl->setAppkey('951572a068e3668984e78329963e854e');
// 设置秘钥
$cl->setSecret('IDKUwL');
// 调用呼叫
$params = [
    'callerNbr' => '18300076978**', // 主叫方
    'calleeNbr' => '19868115646**'  // 被叫方
];
$test = $cl->dial($params);
var_dump(json_decode($test));
