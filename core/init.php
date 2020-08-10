<?php

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
//error_reporting(E_ALL);

//define('ROOT_PATH', str_replace('\\', '/', dirname(dirname(__FILE__))));
define('ROOT_PATH', '.');
define('CORE_PATH', ROOT_PATH . '/core');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('CONFIG_PATH', ROOT_PATH . '/config');

echo '<link rel="stylesheet" href="' . PUBLIC_PATH . '/static/bootstrap/bootstrap.css" />';
echo '<script type="text/javascript" src="' . PUBLIC_PATH . '/static/bootstrap/bootstrap.min.js"></script>';

include_once ROOT_PATH . '/common/function.php';
