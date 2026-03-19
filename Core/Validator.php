<?php

namespace Core;

class Validator
{

    public static function string($value, $min = 1, $max = INF)
    {

        $input = trim($value);

        return strlen($input) >= $min && strlen($input) <= $max;
    }

    public static function title($value, $min = 1, $max = INF)
    {


        $input = trim($value);

        return strlen($input) >= $min && strlen($input) <= $max;
    }

    public static function email($value, $min = 1, $max = INF) {

        $input = trim($value);

        return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;

    }

    public static function password($value, $min = 1, $max = INF) {

        $input = trim($value);

        return strlen($input) >= $min && strlen($input) <= $max;
    }

}
