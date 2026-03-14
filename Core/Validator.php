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
}
