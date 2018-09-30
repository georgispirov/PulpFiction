<?php

namespace PulpFiction\core\Helpers;

class ArrayHelper
{
    public static function buildHashMapForDropDownList($array, $by, $to)
    {
        $map = [];

        foreach ($array as $item) {
            $key = $item[$by];
            $value = $item[$to];
            $map[$key]['id'] = $key;
            $map[$key]['value'] = $value;
        }

        return $map;
    }
}