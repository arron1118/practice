<?php


function dataToTable($data = [], $width = '980px')
{
    if (empty($data)) {
        return '';
    }

    $tb = "<div class='container'><div class='row'><div class='col-lg-12'> <table cellpadding='10' cellspacing='0' class='table table-striped'>";
    $th = '<tr>';
    $tr = '';
    $columns = [];
    foreach ($data as $key => $value) {
        if (empty($columns)) {
            $columns = array_keys($value);
        }

        $tr .= '<tr>';
        $values = array_values($value);
        for ($i = 0; $i < count($values); $i ++) {
            $tr .= '<td style="border: 1px solid #ccc;">' . $values[$i] . '</td>';
        }
        $tr .= '</tr>';
    }

    for ($j = 0; $j < count($columns); $j ++) {
        $th .= '<th style="border: 1px solid #ccc;">' . $columns[$j] . '</th>';
    }
    $th .= '</tr>';
    $tb .= $th . $tr . '</table></div></div></div>';

    return $tb;
}

function getDirTree($dir = './')
{
    static $res = [];
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        /*if (!in_array($file, ['.', '..']) && strpos($file, '.') !== 0) {
            if (is_dir($file)) {
                $res = array_merge($res, getDirTree($file));
            } else {
                $res[] = $file;
            }
        }*/

        if (!is_dir($file) ) {
            $res[] = $file;
        }
    }

    return $res;
}

function referer()
{
    $ref = $_SERVER['HTTP_REFERER'];
    $html = <<<HTML

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{$ref}">返回</a></li>
            </ol>
        </div>
    </div>
</div>

HTML;
    echo $html;
}
