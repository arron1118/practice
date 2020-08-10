<?php

include_once 'core/init.php';
header('Content-Type: Text/Html; charset=utf-8');

$hello = 'Hello, world!';

$dir = dirname(__FILE__);

$files = scandir($dir);
// var_dump($files);

$fileList = getDirTree('./');
//echo '<pre>';
//var_dump($res);

//var_dump($_SERVER);

referer();

?>


<div class="jumbotron">
    <div class="container">
        <h1><?php echo $hello; ?></h1>
        <div class="list-group">
            <?php
                foreach ($fileList as $key => $value) {
                    echo '<a href="' . $value . '" class="list-group-item">' . $value . '</a>';
                }
            ?>
        </div>
    </div>
</div>

