<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/3
 * Time: 10:49
 */

class A {
    private $e = 1;
}

$B = function () {
    return $this->e;
};

var_dump($B);
var_dump($B->call(new A, 'a'));
$getE = $B->bindTo(new A, 'A');
echo $getE();

$getE->call(new A);

$a = intdiv(10, 20);

echo $a;

$str = <<<STR
这是一个多行字符串定义
$a
STR;
echo $str;




