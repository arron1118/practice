<?php

function dataToTable($data = [], $width = '980px')
{
    if (empty($data)) {
        return '';
    }

    $tb = "<table cellpadding='10' cellspacing='0' style='border: 1px solid #ccc; border-collapse: collapse; margin: 15px auto; width: auto; min-width:  {$width}'>";
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
    $tb .= $th . $tr . '</table>';

    return $tb;
}

